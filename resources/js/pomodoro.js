export function timerHandler({ pomodoroSeconds, breakSeconds }) {
    return {
        pomodoroTime: pomodoroSeconds,
        breakTime: breakSeconds,
        timeLeft: pomodoroSeconds,
        timer: null,
        isRunning: false,
        currentMode: 'pomodoro',
        isChanging: false,

        formatTime() {
            const h = Math.floor(this.timeLeft / 3600);
            const m = Math.floor((this.timeLeft % 3600) / 60);
            const s = this.timeLeft % 60;
            
            const pad = (n) => String(n).padStart(2, '0');

            // Nếu không có giờ, chỉ hiển thị mm:ss cho gọn
            if (h === 0) return `${pad(m)}:${pad(s)}`;
            return `${pad(h)}:${pad(m)}:${pad(s)}`;
        },

        setMode(mode) {
            if (this.currentMode === mode && !this.isChanging) return;

            this.pauseTimer();
            this.isChanging = true;

            // Reset thời gian ngay lập tức để UI không bị khựng
            this.currentMode = mode;
            this.timeLeft = mode === 'pomodoro' ? this.pomodoroTime : this.breakTime;

            // Chờ một nhịp nhỏ để hiệu ứng CSS Slide-up kịp nhận diện
            setTimeout(() => {
                this.isChanging = false;
            }, 50);
        },

        startTimer() {
            if (this.isRunning) return;
            
            // Xóa mọi timer cũ trước khi tạo mới để tránh chạy nhanh gấp đôi
            if (this.timer) clearInterval(this.timer);

            this.isRunning = true;
            this.timer = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft--;
                } else {
                    this.handleFinished();
                }
            }, 1000);
        },

        pauseTimer() {
            this.isRunning = false;
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        resetTimer() {
            this.pauseTimer();
            this.timeLeft = this.currentMode === 'pomodoro' ? this.pomodoroTime : this.breakTime;
        },

        skipMode() {
            this.setMode(this.currentMode === 'pomodoro' ? 'break' : 'pomodoro');
        },

        handleFinished() {
            this.pauseTimer();
            this.skipMode();
            console.log('Chế độ đã được chuyển đổi!');
        }
    };
}

export function taskHandler() {
    return {
        showModal: false,
    };
}