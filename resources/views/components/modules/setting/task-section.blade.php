    <div class="p-8">
        <div class="flex items-center gap-3 mb-2">
            <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                <i data-lucide="clipboard-check" class="w-5 h-5"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg">Tasks</h3>
        </div>
        <x-ui.divider />

        <div class="space-y-2">
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                <div>
                    <p class="text-gray-800 font-bold">Auto-check Tasks</p>
                    <p class="text-xs text-gray-400">Mark tasks as done after focus session</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input x-model="autoCheck" type="checkbox" name="autoCheck" value="1" class="sr-only peer">
                    <div
                        class="w-12 h-7 bg-gray-200 rounded-full peer peer-checked:bg-green-500
                                    after:content-[''] after:absolute after:top-1 after:left-1
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all peer-checked:after:translate-x-5">
                    </div>
                </label>
            </div>
        </div>
    </div>
