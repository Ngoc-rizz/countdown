<x-app-layout>
    <div x-data="reportHandler()" class="w-full max-w-7xl mx-auto h-full flex flex-col rounded-md bg-white ">
        <div>
            <div class="p-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-orange-100 text-orange-600 rounded-lg">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <span class="text-gray-700 font-bold uppercase tracking-wider">Timer</span>
                </div>

                <x-ui.divider />

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-ui.setting-row label="Focus" name="pomodoro" value="25" unit="min" />
                    <x-ui.setting-row label="Break" name="break" value="5" unit="min" />
                </div>
            </div>

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
                            <input type="checkbox" class="sr-only peer">
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

            <div class="p-8">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                        <i data-lucide="palette" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg">Theme</h3>
                </div>
                <x-ui.divider />

                <div class="space-y-3 flex flex-col gap-4 lg:flex-row justify-between">
                    <div class="text-gray-700 font-bold">Colors Theme</div>

                    <div class="flex items-center gap-4">
                        @foreach (['#EF4444', '#3B82F6', '#10B981', '#1F2937'] as $color)
                            <button type="button"
                                class="group relative h-6 w-6 rounded-xl border-2 border-transparent hover:border-gray-300 transition-all overflow-hidden flex-shrink-0"
                                style="background-color: {{ $color }}"
                                onclick="document.getElementById('customColor').value = '{{ $color }}'">
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/10">
                                    <i data-lucide="check" class="text-white w-5 h-5"></i>
                                </div>
                            </button>
                        @endforeach
                        <div class="relative flex items-center gap-2 pl-4 border-l border-gray-200">
                            <label for="customColor" class="text-xs text-gray-500 font-medium">Custom:</label>
                            <input type="color" id="customColor" name="theme_color" value="#3B82F6"
                                class="h-6 w-6 cursor-pointer rounded-xl border-2 border-white shadow-sm appearance-none bg-transparent [&::-webkit-color-swatch-wrapper]:p-0 [&::-webkit-color-swatch]:rounded-xl [&::-webkit-color-swatch]:border-none">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 flex justify-end gap-4 font-bold text-white">
            <button
                class="p-2 lg:p-3 bg-red-500 rounded-md border-b-2 border-gray-300 active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all">
                Cancel
            </button>
            <button
                class="p-2 lg:p-3 bg-green-500 rounded-md border-b-2 border-gray-300 active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all">
                Save Settings
            </button>
        </div>
    </div>
</x-app-layout>
