import './bootstrap';
import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';
import { taskHandler, timerHandler } from './alpine/handlers/pomodoro';
import { reportHandler } from './alpine/handlers/report';
import { settingHandler } from './alpine/handlers/setting';
import configStore from './alpine/stores/config';

Alpine.store(configStore.name, configStore.store);
document.addEventListener('alpine:init', () => {
    Alpine.data('mainLayout', () => {
        return {
            themeColor: document.body.getAttribute('initial-color') || '#AF4949',
            init() {
                window.addEventListener('theme-change', (e) => {
                    this.themeColor = e.detail.color;
                })
            },
        }
    })
});

window.Alpine = Alpine;

Alpine.data('timerHandler', timerHandler);
Alpine.data('taskHandler', taskHandler);
Alpine.data('reportHandler', reportHandler);
Alpine.data('settingHandler', settingHandler);

Alpine.start();

createIcons({ icons });

