import axios from "axios";
import { PomoStorage } from "../storage/storage";

export function settingHandler(url, initialData = {}) {
    return {
        loading: false,
        pomodoro: Math.floor((initialData.pomodoro ?? 1500) / 60),
        breakTime: Math.floor((initialData.breakTime ?? 300) / 60),
        autoCheck: initialData.autoCheck ?? false,
        soundEnabled: initialData.soundEnabled ?? false,
        themeColor: (initialData.themeColor ?? "#3b82f6").toUpperCase(),

        async saveSetting() {
            this.loading = true;
            try {
                const payload = {
                    pomodoro: this.pomodoro,
                    break: this.breakTime,
                    auto_check: this.autoCheck,
                    sound_enabled: this.soundEnabled,
                    theme_color: this.themeColor,
                };

                const response = await axios.post(url, payload);

                if (response.data) {
                    const settingsToStore = {
                        pomodoro: this.pomodoro,
                        breakTime: this.breakTime,
                        autoCheck: this.autoCheck,
                        soundEnabled: this.soundEnabled,
                        themeColor: this.themeColor,
                    };

                    PomoStorage.saveTheme(this.themeColor);

                    alert("Settings synced and saved successfully!");
                }
            } catch (error) {
                if (error.response?.status === 422) {
                    alert(Object.values(error.response.data.errors).flat()[0]);
                } else {
                    alert(
                        error.response?.data?.message ??
                            "Cloud save failed. Changes not applied.",
                    );
                }
            } finally {
                this.loading = false;
            }
        },
    };
}
