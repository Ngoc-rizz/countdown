import './bootstrap';
import { createIcons, icons } from 'lucide';
import Alpine from 'alpinejs';

// Khởi tạo icons ngay lập tức trước khi Alpine xử lý DOM
createIcons({ icons });

import {timerHandler, taskHandler} from './pomodoro';
import {reportHandler} from './report';

Alpine.data('timerHandler', timerHandler);
Alpine.data('taskHandler', taskHandler);
Alpine.data('reportHandler', reportHandler);

Alpine.start();

window.Alpine = Alpine;
window.createIcons = createIcons;