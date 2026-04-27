<div x-show="showModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/70"
    x-transition:enter="transition opacity duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition opacity duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div @click.away="showModal = false" x-show="showModal"
        class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-2xl origin-center"
        x-transition:enter="transition transform duration-300" x-transition:enter-start="opacity-0 scale-y-75"
        x-transition:enter-end="opacity-100 scale-y-100" x-transition:leave="transition transform duration-200"
        x-transition:leave-start="opacity-100 scale-y-100" x-transition:leave-end="opacity-0 scale-y-75"
        x-data="{ est: 1 }">

        <div class="p-8">
            <input type="text" placeholder="What are you working on?"
                class="w-full text-xl font-bold border-none focus:ring-0 placeholder:text-gray-300 text-gray-700 mb-8 p-0 bg-transparent">

            <div class="mb-8">
                <div class="flex justify-between items-center mb-4">
                    <label class="text-sm font-bold text-gray-500 uppercase tracking-wider">Target Journey</label>
                    <span class="text-xs font-mono bg-gray-100 px-2 py-1 rounded text-gray-600"
                        x-text="est + ' Rounds'"></span>
                </div>

                <div class="flex space-x-1.5 h-3 w-full mb-6">
                    <template x-for="i in parseInt(est)" :key="'active-' + i">
                        <div
                            class="h-full flex-1 rounded-full bg-gradient-to-r from-orange-400 to-red-500 shadow-sm animate-pulse transition-all">
                        </div>
                    </template>
                    <template x-for="i in (8 - parseInt(est))" :key="'empty-' + i">
                        <div class="h-full flex-1 rounded-full bg-gray-100 transition-all"></div>
                    </template>
                </div>

                <div class="relative w-full px-2">
                    <input type="range" min="1" max="8" x-model="est"
                        class="w-full h-1.5 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-gray-800">
                    <div class="flex justify-between mt-2 text-[10px] text-gray-400 font-bold px-1">
                        <span>SHORT</span>
                        <span>LONG TASK</span>
                    </div>
                </div>
            </div>

            <div class="relative group">
                <textarea placeholder="Add a quick note..."
                    class="w-full bg-gray-50 border-none rounded-xl p-4 text-sm focus:ring-2 focus:ring-gray-200 min-h-[100px] placeholder:text-gray-400"></textarea>
            </div>
        </div>

        <div class="bg-gray-50 px-8 py-6 flex justify-between items-center">
            <button @click="showModal = false" class="text-gray-300 hover:text-red-500 transition-colors">
                <i data-lucide="trash-2" class="w-6 h-6"></i>
            </button>

            <div class="flex space-x-4">
                <button @click="showModal = false"
                    class="px-6 py-2 text-gray-400 font-bold hover:text-gray-600 transition-colors">
                    Cancel
                </button>
                <button
                    class="px-8 py-2 bg-gray-800 text-white rounded-xl font-bold shadow-md hover:bg-gray-900 active:scale-95 transition-all">
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
