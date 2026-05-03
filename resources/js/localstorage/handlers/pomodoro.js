import { PomodoroService } from "../../service/pomodoroService";
import { PomoStorage } from "../storage/storage";

export function timerHandler(initialData) {
    return {
        // --- 1. STATE ---
        timeLeft: 0,
        timer: null,
        isRunning: false,
        currentMode: "pomodoro",
        isChanging: false,
        selectedTaskId: null,
        config: {
            pomodoro: initialData.pomodoro,
            breakTime: initialData.breakTime,
        },

        // --- 2. LIFECYCLE (Khởi tạo) ---
        async init() {
            if (window.isAuthenticated) {
                window.addEventListener("task-selected", async (e) => {
                    const { taskId, isAuto } = e.detail;
                    const initialTime = this.config.pomodoro;
                    if (
                        !isAuto &&
                        this.selectedTaskId &&
                        taskId &&
                        this.selectedTaskId !== taskId &&
                        this.timeLeft < initialTime
                    ) {
                        if (
                            !confirm(
                                "Đổi Task sẽ kết thúc phiên hiện tại và tính là 1 Pomodoro cho Task cũ. Tiếp tục?",
                            )
                        ) {
                            window.dispatchEvent(
                                new CustomEvent("revert-task-selection", {
                                    detail: { oldTaskId: this.selectedTaskId },
                                }),
                            );
                            return;
                        }

                        await this.sync("finish");
                        this.stopInterval();
                        this.resetToInitial();
                    }

                    this.selectedTaskId = taskId;

                    if (this.timeLeft === initialTime) {
                        this.resetToInitial();
                    }
                });

                const hasActiveSession = ["running", "paused"].includes(
                    initialData.status,
                );
                if (hasActiveSession) {
                    this.hydrateFromServer(initialData);
                } else {
                    this.resetToInitial();
                }
            }

            const saved = PomoStorage.getProgress();
            const now = Date.now();

            if (this.isValidLocalStorage(saved, now)) {
                this.hydrateFromLocalStorage(saved, now);
            } else {
                this.resetToInitial();
            }
        },
        async finishSession() {
            const oldTaskId = this.selectedTaskId;
            await this.sync("finish");
            this.stopInterval();
            this.resetToInitial();

            window.dispatchEvent(
                new CustomEvent("pomodoro-completed", {
                    detail: { taskId: oldTaskId },
                }),
            );
        },
        // --- 3. PUBLIC ACTIONS (Người dùng tương tác) ---
        async startTimer(isInitializing = false) {
            if (this.isRunning) return;

            const expiry = Date.now() + this.timeLeft * 1000;
            PomoStorage.startRunning(expiry, this.currentMode);

            this.isRunning = true;
            this.tick(expiry);

            if (!isInitializing && window.isAuthenticated) {
                await this.sync("start");
            }
        },

        pauseTimer() {
            this.stopInterval();
            this.isRunning = false;
            PomoStorage.pauseRunning(this.timeLeft, this.currentMode);

            if (window.isAuthenticated) this.sync("pause");
        },

        setMode(mode) {
            if (this.currentMode === mode && !this.isChanging) return;

            // Kiểm tra nếu đang làm dở mà chuyển mode
            const initialTime =
                this.config[
                    this.currentMode === "pomodoro" ? "pomodoro" : "breakTime"
                ];
            if (this.timeLeft < initialTime && this.timeLeft > 0) {
                if (
                    !confirm(
                        `Tiến trình ${this.currentMode} sẽ bị mất. Tiếp tục?`,
                    )
                )
                    return;
            }

            this.stopInterval();
            this.isRunning = false;
            this.isChanging = true;
            this.currentMode = mode;
            this.resetToInitial();

            setTimeout(() => (this.isChanging = false), 50);
        },

        // --- 4. INTERNAL LOGIC (Xử lý bên trong) ---
        tick(expiry) {
            this.stopInterval();
            this.timer = setInterval(() => {
                const diff = Math.round((expiry - Date.now()) / 1000);

                if (diff <= 0) {
                    this.timeLeft = 0;
                    this.handleFinished();
                } else {
                    this.timeLeft = diff;
                }
            }, 1000);
        },

        handleFinished() {
            this.stopInterval();
            this.isRunning = false;
            PomoStorage.clearProgress();

            if (window.isAuthenticated) {
                this.sync("finish");
                this.$dispatch("pomodoro-completed");
            }

            this.currentMode =
                this.currentMode === "pomodoro" ? "break" : "pomodoro";

            this.resetToInitial();
        },

        resetToInitial() {
            this.stopInterval();
            this.isRunning = false;
            this.timeLeft =
                this.currentMode === "pomodoro"
                    ? this.config.pomodoro
                    : this.config.breakTime;

            PomoStorage.clearProgress();
        },

        stopInterval() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        // --- 5. DATA HYDRATION & SYNC ---
        hydrateFromServer(data) {
            this.stopInterval();
            PomoStorage.clearProgress();

            this.config = {
                pomodoro: data.pomodoro,
                breakTime: data.breakTime,
            };
            this.currentMode = "pomodoro";
            this.timeLeft = data.timeLeft;
            this.isRunning = data.status === "running";

            if (this.isRunning) {
                const expiry = Date.now() + data.timeLeft * 1000;
                this.tick(expiry);
            }
        },

        hydrateFromLocalStorage(saved, now) {
            this.currentMode = saved.mode;
            if (saved.isRunning) {
                this.timeLeft = Math.round((saved.expiry - now) / 1000);
                this.startTimer(true);
            } else {
                this.timeLeft = saved.timeLeft;
            }
        },

        isValidLocalStorage(saved, now) {
            if (!saved) return false;
            return (
                (saved.isRunning && saved.expiry > now) ||
                (!saved.isRunning && saved.timeLeft > 0)
            );
        },

        async sync(action) {
            try {
                await PomodoroService.sync(action, {
                    type: this.currentMode,
                    timeLeft: this.timeLeft,
                    taskId: this.selectedTaskId,
                });
            } catch (err) {
                console.error(
                    `Sync ${action} failed:`,
                    err.response?.data || err.message,
                );
            }
        },

        // --- 6. GETTERS (Computed properties) ---
        get displayTime() {
            const h = Math.floor(this.timeLeft / 3600);
            const m = Math.floor((this.timeLeft % 3600) / 60);
            const s = this.timeLeft % 60;
            const pad = (n) => String(n).padStart(2, "0");

            return h > 0
                ? `${pad(h)}:${pad(m)}:${pad(s)}`
                : `${pad(m)}:${pad(s)}`;
        },
    };
}
