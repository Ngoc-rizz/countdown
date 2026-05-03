@props(['tasks'])
<section x-data="taskHandler({{ $tasks->toJson() }})" @pomodoro-completed.window="handleAutoUpdate()" class="task mt-6 w-full max-w-sm mx-auto">
    <div class="flex text-white justify-between items-center mb-6 px-2">
        <h1 class="font-bold text-2xl tracking-tight">Task</h1>
        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-md transition-all group active:scale-90">
            <i data-lucide="ellipsis-vertical" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
        </button>
    </div>

    <div class="task-section" x-init="$watch('tasks', () => refreshIcons())">
        <template x-for="task in tasks" :key="task.id">
            <div class="task-item w-full bg-white rounded-md p-3 mb-2 flex items-center space-x-3 transition-all duration-100 ease-in-out"
                @click="selectTask(task)"
                :class="[
                    typeof task !== 'undefined' && task.is_done == 1 ? 'is-done opacity-60 cursor-not-allowed' :
                    'cursor-move',
                    typeof task !== 'undefined' && task.is_done == 0 && selectedTaskId === task.id ?
                    ' border-black border-l-4' : ''
                ]">

                <div class="flex-shrink-0 cursor-pointer"
                    @click.prevent="typeof task !== 'undefined' && toggleDone(task)">
                    <i :data-lucide="typeof task !== 'undefined' && task.is_done == 1 ? 'check-circle' : 'circle'"
                        :class="typeof task !== 'undefined' && task.is_done == 1 ? 'text-green-500' : 'text-gray-400'"
                        class="w-5 h-5">
                    </i>
                </div>

                <div class="grow flex justify-between">
                    <span x-text="typeof task !== 'undefined' ? task.title : ''"></span>
                    <span
                        x-text="typeof task !== 'undefined' ? `${task.act_pomodoros}/${task.est_pomodoros}` : ''"></span>
                </div>

                <button @click="openEdit(task)"
                    class="p-2 bg-white/10 hover:bg-white/20 rounded-md transition-all group active:scale-90 cursor-pointer">
                    <i data-lucide="ellipsis-vertical" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
                </button>
            </div>
        </template>
    </div>
    <div class="w-full mb-5">
        <button @click="showModal = true"
            class="w-full py-4 border-2 border-dashed border-white/20 rounded-xl bg-black/10 text-white/60 hover:bg-black/20 hover:text-white transition-all flex items-center justify-center space-x-2 mb-10">
            <i data-lucide="plus-circle" class="w-5 h-5"></i>
            <span class="font-bold">Add Task</span>
        </button>

        <x-modules.pomodoro.modal />
    </div>
</section>
