export const THEME_KEY = "pomo_theme";
export const RUNNING_KEY = "running_state";

export const PomoStorage = {
    saveRunningState(data) {
        const defaultState = {
            expiry: null, // Time when timer will finish
            timeLeft: null, // Time left
            mode: "pomodoro", // Mode of timer
            isRunning: false, // Is timer running
            timestamp: Date.now(),
        };

        localStorage.setItem(
            RUNNING_KEY,
            JSON.stringify({ ...defaultState, ...data }),
        );
    },
    startRunning(expiry, mode) {
        this.saveRunningState({
            expiry: expiry,
            mode: mode,
            isRunning: true,
        });
    },
    pauseRunning(timeLeft, mode) {
        this.saveRunningState({
            timeLeft: timeLeft,
            mode: mode,
            isRunning: false,
        });
    },
    saveTheme(color) {
        localStorage.setItem(THEME_KEY, color);
        document.documentElement.style.setProperty("--main-color", color);
    },
    getProgress() {
        return JSON.parse(localStorage.getItem(RUNNING_KEY));
    },

    clearProgress() {
        localStorage.removeItem(RUNNING_KEY);
    },
};
