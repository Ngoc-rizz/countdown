import axios from "axios";

export const PomodoroService = {
    async sync(action, data) {
        try {
            const response = await axios.post(`/pomodoro/${action}`, {
                type: data.type,
                timeLeft: data.timeLeft,
                taskId: data.taskId,
            });

            return response.data;
        } catch (error) {}
    },
    async syncGuest(data) {
        return axios.post("/pomodoro/sync-guest", data);
    },
};
