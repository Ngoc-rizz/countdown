import Alpine from "alpinejs";
import axios from "axios";

export function settingHandler(url, initialData = {}) {
    try {
        Alpine.store('config')?.update?.(initialData);
    } catch (e) {
        console.warn("Alpine Store 'config' not ready ");
    }

    return {
        loading: false,
        pomodoro: initialData.pomodoro ?? 25,
        break_time: initialData.break ?? 5,
        autoCheck: initialData.autoCheck ?? false,
        soundEnabled: initialData.soundEnabled ?? false,
        themeColor: (initialData.themeColor ?? '#3b82f6').toUpperCase(),

        async saveSetting() {
            this.loading = true;
            
            const payload = {
                pomodoro: this.pomodoro,
                break: this.break_time,
                auto_check: this.autoCheck,
                sound_enabled: this.soundEnabled,
                theme_color: this.themeColor,
            };

            try {
                const response = await axios.post(url, payload);
                
                if(response.data) {
                    Alpine.store('config')?.update?.({
                        ...payload,
                        themeColor: payload.theme_color
                    });

                    alert('Setting updated successfully');
                }
            } catch (error) {
                if(error.response?.status === 422) {
                    alert(Object.values(error.response.data.errors).flat()[0]);
                } else {
                    alert(error.response?.data?.message ?? 'Something went wrong. Please try again later');
                }
            } finally {
                this.loading = false;
            }
        },
    };
}