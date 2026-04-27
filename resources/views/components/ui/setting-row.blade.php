@props(['label', 'name', 'value', 'unit' => ''])

<div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition-all group">
    <span class="text-gray-600 font-medium group-hover:text-gray-900">{{ $label }}</span>
    <div
        class="flex items-center bg-gray-100 rounded-lg px-3 py-1 border border-transparent focus-within:border-gray-300 focus-within:bg-white transition-all">
        <input type="number" name="{{ $name }}" value="{{ $value }}" min="0"
            class="w-12 bg-transparent border-none p-0 text-right focus:ring-0 font-bold text-gray-800">
        @if ($unit)
            <span class="ml-1 text-gray-400 text-xs font-bold">{{ $unit }}</span>
        @endif
    </div>
</div>
