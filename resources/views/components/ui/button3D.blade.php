@props([
    'size' => 'md',
    'variant' => 'light',
])

@php
    $baseClasses =
        'flex items-center justify-center transition-all duration-100 font-medium active:translate-y-1 active:border-b-0 active:shadow-none';

    $variants = [
        'light' => 'bg-gray-100 text-gray-500 border-gray-300 shadow-[0_4px_0_0_rgba(0,0,0,0.1)] hover:bg-white',
        'dark' => 'bg-gray-800 text-white border-gray-950 shadow-[0_6px_0_0_rgba(0,0,0,0.2)] hover:bg-gray-700',
    ];

    $sizes = [
        'sm' => 'p-2 lg:p-3 rounded-md border-b-2',
        'md' => 'px-6 py-2 rounded-lg border-b-2 w-full',
        'lg' => 'w-16 lg:w-32 h-8 lg:h-16 rounded-md border-b-4',
    ];
@endphp

{{-- Sử dụng $attributes->merge để Alpine có thể truyền class từ ngoài vào --}}
<button {{ $attributes->merge(['class' => "$baseClasses {$variants[$variant]} {$sizes[$size]}"]) }}>
    {{ $slot }}
</button>
