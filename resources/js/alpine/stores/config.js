const configStore = {
    name: 'config',
    store: {
        pomodoro: 25,
        break_time: 5,
        autoCheck: false,
        soundEnabled: false,
        themeColor: '#3b82f6',
    },
    update(data) {
        if (!data) return;
        this.pomodoro = data.pomodoro ?? this.pomodoro;
        this.break_time = data.break ?? this.break_time;
        this.autoCheck = data.auto_check ?? this.autoCheck;
        this.soundEnabled = data.sound_enabled ?? this.soundEnabled;
        this.themeColor = data.theme_color ?? this.themeColor;
    }
}

export default configStore