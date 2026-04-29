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
                    class="group relative h-6 w-6 rounded-xl border-2 transition-all overflow-hidden flex-shrink-0"
                    :class="themeColor === '{{ $color }}'
                        ?
                        'border-gray-600 ring-2 ring-gray-200 scale-110' :
                        'border-transparent hover:border-gray-300'"
                    style="background-color: {{ $color }}" @click="themeColor = '{{ $color }}'">

                    <div class="absolute inset-0 flex items-center justify-center transition-opacity bg-black/10"
                        :class="themeColor === '{{ $color }}' ? 'opacity-100' : 'opacity-0 group-hover:opacity-100'">
                        <i data-lucide="check" class="text-white w-5 h-5"></i>
                    </div>
                </button>
            @endforeach
            <div class="relative flex items-center gap-2 pl-4 border-l border-gray-200">
                <label for="themeColor" class="text-xs text-gray-500 font-medium">Custom:</label>
                <input type="color" id="themeColor" name="themeColor" x-model="themeColor"
                    class="h-6 w-6 cursor-pointer rounded-xl border-2 border-white shadow-sm appearance-none bg-transparent [&::-webkit-color-swatch-wrapper]:p-0 [&::-webkit-color-swatch]:rounded-xl [&::-webkit-color-swatch]:border-none">
            </div>

        </div>
    </div>
</div>
