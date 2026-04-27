<section x-data="taskHandler()" class="task mt-6 w-full max-w-sm mx-auto">
    <div class="flex text-white justify-between items-center mb-6 px-2">
        <h1 class="font-bold text-2xl tracking-tight">Task</h1>
        <button class="p-2 bg-white/10 hover:bg-white/20 rounded-md transition-all group active:scale-90">
            <i data-lucide="ellipsis-vertical" class="w-5 h-5 opacity-70 group-hover:opacity-100"></i>
        </button>
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
