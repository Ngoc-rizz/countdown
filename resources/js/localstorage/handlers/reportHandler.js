export function reportHandler(summaryData, detailsData) {
    return {
        activeTab: "summary",
        summary: summaryData || {
            total_hours: 0,
            total_pomo_completed: 0,
            task_stats: [],
        },
        details: detailsData || {
            data: [],
        },

        formatTime(seconds) {
            if (!seconds || seconds == 0) return "0s";
            const s = parseInt(seconds);
            if (s < 60) return s + "s";
            const m = Math.floor(s / 60);
            const rs = s % 60;
            return rs > 0 ? `${m}m ${rs}s` : `${m}m`;
        },
    };
}
