import Sortable from "sortablejs";

export function sortableHandler(el, options = {}) {
    return new Sortable(el, {
        animation: 150,
        ghostClass: "bg-white/10",
        chosenClass: "opacity-50",
        ...options,
    });
}
