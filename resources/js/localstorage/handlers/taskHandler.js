import axios from "axios";
import { sortableHandler } from "./sortable-handler";
export function taskHandler(initialTasks) {
    return {
        showModal: false,
        tasks: initialTasks || [],
        title: "",
        est: 1,
        note: "",
        activeMenu: null,
        selectedTaskId: null,
        init() {
            const listContainer = this.$el.querySelector(".task-section");
            if (listContainer) {
                sortableHandler(listContainer, {
                    filter: ".is-done",
                    onMove: (evt) => {
                        return evt.related.className.indexOf("is-done") === -1;
                    },
                    onEnd: (evt) => this.handlerReorder(evt),
                });
            }

            const firstIncompleteTask = this.tasks.find((t) => t.is_done == 0);
            if (firstIncompleteTask) {
                this.selectTask(firstIncompleteTask);
            }
        },
        selectFirstIncomplete() {
            const firstTask = this.tasks.find((t) => t.is_done == 0);
            if (firstTask) {
                this.selectedTaskId = firstTask.id;
                window.dispatchEvent(
                    new CustomEvent("task-selected", {
                        detail: { taskId: firstTask.id, isAuto: true },
                    }),
                );
                this.refreshIcons();
            }
        },
        async handlerReorder(evt) {
            if (evt.oldIndex === evt.newIndex) return;

            const list = [...this.tasks];

            const moved = list.splice(evt.oldIndex, 1)[0];
            list.splice(evt.newIndex, 0, moved);

            this.tasks = list;

            try {
                await this.reorderApi(
                    this.tasks.map((task, index) => ({
                        id: task.id,
                        position: index,
                    })),
                );
            } catch (error) {
                alert("Không thể cập nhật thứ tự.");
            }
        },
        selectTask(task) {
            if (task.is_done) return;

            this.selectedTaskId =
                this.selectedTaskId === task.id ? null : task.id;

            window.dispatchEvent(
                new CustomEvent("task-selected", {
                    detail: { taskId: this.selectedTaskId },
                }),
            );
        },
        async handleAutoUpdate() {
            const activeTask = this.tasks.find((t) => t.is_done == 0);
            if (!activeTask) return;
            activeTask.act_pomodoros++;

            if (activeTask.act_pomodoros >= activeTask.est_pomodoros) {
                activeTask.is_done = 1;
                activeTask.act_pomodoros = activeTask.est_pomodoros;
            }
            try {
                await this.updateTaskApi(activeTask.id, {
                    ...activeTask,
                });
                this.refreshIcons();
            } catch (error) {
                console.error("Auto update failed", error);
            }
        },
        async reorderApi(tasks) {
            return axios.post("/tasks/reorder", { tasks });
        },
        async toggleDone(task) {
            const previous = task.is_done;
            task.is_done = !task.is_done;
            try {
                await this.updateTaskApi(task.id, {
                    title: task.title,
                    est_pomodoros: task.est_pomodoros,
                    note: task.note,
                    is_done: task.is_done,
                });
            } catch (error) {
                task.is_done = previous;
                alert("Không thể cập nhật trạng thái.");
            }
        },

        refreshIcons() {
            this.$nextTick(() => {
                if (window.lucide) {
                    window.lucide.createIcons({
                        icons: window.lucide.icons,
                    });
                }
            });
        },
        openEdit(task) {
            this.title = task.title;
            this.est = task.est_pomodoros;
            this.note = task.note;
            this.showModal = true;
            this.activeMenu = task.id;
        },
        async deleteTask() {
            const idToDelete = this.activeMenu;
            if (!idToDelete) return;

            if (!confirm("Do you want to delete this task?")) return;

            try {
                await axios.delete(`/tasks/delete/${idToDelete}`);

                this.tasks = this.tasks.filter(
                    (task) => task.id.toString() !== idToDelete.toString(),
                );

                this.activeMenu = null;
                this.showModal = false;
            } catch (error) {
                console.error("Delete Error:", error);
                alert("Không thể xóa task. Vui lòng thử lại.");
            }
        },
        async saveTask() {
            if (!this.title.trim()) return;

            try {
                if (!this.activeMenu) {
                    const response = await axios.post("/tasks", {
                        title: this.title,
                        est_pomodoros: this.est,
                        note: this.note,
                    });
                    const newTask = response.data.task;
                    this.tasks.unshift(newTask);
                    this.selectTask(newTask);
                } else {
                    await this.updateTaskApi(this.activeMenu, {
                        title: this.title,
                        est_pomodoros: this.est,
                        note: this.note,
                    });
                }

                this.resetForm();
                this.showModal = false;
            } catch (error) {
                alert("Có lỗi xảy ra khi lưu task.");
            }
        },
        async updateTaskApi(id, data) {
            try {
                const response = await axios.put(`/tasks/${id}`, data);

                const index = this.tasks.findIndex((t) => t.id === id);
                if (index !== -1) {
                    this.tasks.splice(index, 1, response.data.task);
                }

                this.refreshIcons();
                return response.data.task;
            } catch (error) {
                console.error("Update failed:", error);
                throw error;
            }
        },
        resetForm() {
            this.title = "";
            this.est = 1;
            this.note = "";
            this.activeMenu = null;
        },
    };
}
