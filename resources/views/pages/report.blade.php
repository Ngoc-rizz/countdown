<x-app-layout>
    <div x-data="reportHandler({{ Js::from($summary) }}, {{ Js::from($details) }})" class="w-full max-w-7xl mx-auto my-5 bg-gray-100 rounded-xl overflow-hidden">

        {{-- Điều hướng Tab --}}
        <div class="flex w-full p-1 gap-1 bg-gray-200/50">
            <button @click="activeTab = 'summary'"
                :class="activeTab === 'summary' ? 'bg-white shadow-sm text-[#de7979]' : 'text-gray-500'"
                class="w-full py-3 rounded-lg font-bold transition-all">
                Summary
            </button>
            <button @click="activeTab = 'detail'"
                :class="activeTab === 'detail' ? 'bg-white shadow-sm text-[#de7979]' : 'text-gray-500'"
                class="w-full py-3 rounded-lg font-bold transition-all">
                Detail
            </button>
        </div>

        <div class="p-6 bg-white min-h-[400px]">
            {{-- Nội dung Summary --}}
            <div x-show="activeTab === 'summary'">
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="p-4 bg-red-50 rounded-xl">
                        <p class="text-xs text-red-400 font-bold uppercase">Hours Focused</p>
                        <p class="text-3xl font-black text-red-600" x-text="summary.total_hours"></p>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <p class="text-xs text-blue-400 font-bold uppercase">Finished Sessions</p>
                        <p class="text-3xl font-black text-blue-600" x-text="summary.total_pomo_completed"></p>
                    </div>
                </div>

                <h4 class="text-gray-400 text-xs font-bold uppercase mb-3">Tasks Breakdown</h4>
                <div class="space-y-2">
                    <template x-for="task in summary.task_stats" :key="task.id">
                        <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="font-medium text-gray-700" x-text="task.title"></span>
                            <span class="font-bold text-gray-900" x-text="formatTime(task.total_time)"></span>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Nội dung Detail --}}
            <div x-show="activeTab === 'detail'" x-cloak>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-gray-400 border-b">
                            <th class="py-2 text-left">Date</th>
                            <th class="py-2 text-left">Task</th>
                            <th class="py-2 text-right">Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="pomo in details.data" :key="pomo.id">
                            <tr class="border-b border-gray-50">
                                <td class="py-3" x-text="new Date(pomo.start_time).toLocaleDateString()"></td>
                                <td class="py-3" x-text="pomo.task ? pomo.task.title : 'No Task'"></td>
                                <td class="py-3 text-right font-bold" x-text="formatTime(pomo.actual_duration)"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app-layout>
