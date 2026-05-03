import "./bootstrap";
import Sortable from "sortablejs";
import Alpine from "alpinejs";
import { createIcons, icons } from "lucide";
import { reportHandler } from "./localstorage/handlers/reportHandler";
import { settingHandler } from "./localstorage/handlers/setting";
import { timerHandler } from "./localstorage/handlers/pomodoro";
import { taskHandler } from "./localstorage/handlers/taskHandler";

window.lucide = { createIcons, icons };

window.Sortable = Sortable;
window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("mainLayout", () => {
        return {
            themeColor:
                document.body.getAttribute("initial-color") || "#AF4949",
            init() {
                window.addEventListener("theme-change", (e) => {
                    this.themeColor = e.detail.color;
                });
            },
        };
    });
});

Alpine.data("timerHandler", timerHandler);
Alpine.data("reportHandler", reportHandler);
Alpine.data("settingHandler", settingHandler);
Alpine.data("taskHandler", taskHandler);

Alpine.start();

createIcons({ icons });
