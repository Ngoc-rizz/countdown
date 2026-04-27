<x-app-layout>
    <div x-data="reportHandler()" class="w-full max-w-7xl mx-auto my-5  bg-gray-100 rounded-xl">
        <div class="flex w-full p-1 gap-1">
            {{-- Button Summary --}}
            <button @click="setTab('summary')"
                :class="activeTab === 'summary'
                    ?
                    'bg-white shadow-sm border-gray-200 text-[#de7979]' :
                    'text-gray-500 hover:bg-gray-200/50 border-transparent'"
                class="w-full flex items-center justify-center gap-3 py-3 rounded-lg font-bold border transition-all duration-200">
                <i data-lucide="chart-spline" class="w-5 h-5"></i>
                <span>Summary</span>
            </button>

            {{-- Button Detail --}}
            <button @click="setTab('detail')"
                :class="activeTab === 'detail'
                    ?
                    'bg-white shadow-sm border-gray-200 text-[#de7979]' :
                    'text-gray-500 hover:bg-gray-200/50 border-transparent'"
                class="w-full flex items-center justify-center gap-3 py-3 rounded-lg font-bold border transition-all duration-200">
                <i data-lucide="notepad-text" class="w-5 h-5"></i>
                <span>Detail</span>
            </button>
        </div>

        {{-- Tab Content --}}
        <div class="p-6 bg-white mt-1 rounded-xl min-h-[300px] border border-gray-100">
            <div x-show="activeTab === 'summary'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                <h3 class="text-gray-400 font-bold uppercase text-xs tracking-widest mb-4">Activity Summary</h3>
                {{-- Nội dung Summary --}}
                <p class="text-gray-600">Dữ liệu tổng quan của bạn sẽ hiện ở đây...</p>
            </div>

            <div x-show="activeTab === 'detail'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0"
                x-cloak>
                <h3 class="text-gray-400 font-bold uppercase text-xs tracking-widest mb-4">Detailed Log</h3>
                {{-- Nội dung Detail --}}
                <p class="text-gray-600">Danh sách chi tiết từng phiên làm việc...</p>
            </div>
        </div>
    </div>

</x-app-layout>
