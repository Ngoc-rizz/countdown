export function reportHandler() {
    return {
        activeTab: 'summary',

        setTab(tab) {
            this.activeTab = tab;
        }
    };
}