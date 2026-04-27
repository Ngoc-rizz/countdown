@props([
    'label' => null,
    'orientation' => 'horizontal',
])

@if ($orientation === 'horizontal')
    <div class="relative flex py-1 items-center">
        <div class="flex-grow border-t border-gray-200"></div>
        @if ($label)
            <span class="flex-shrink mx-4 text-gray-400 text-lg font-bold uppercase tracking-wider">
                {{ $label }}
            </span>
            <div class="flex-grow border-t h-[2px] border-gray-500"></div>
        @endif
    </div>
@else
    <div class="relative h-full flex justify-center py-2">
        <div class="w-px bg-gray-200 h-full"></div>
    </div>
@endif
