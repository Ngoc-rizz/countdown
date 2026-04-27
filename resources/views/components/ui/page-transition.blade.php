@props([
    'duration' => 'duration-500',
    'delay' => 'delay-100',
    'distance' => 'translate-y-6',
])

<div x-data="{ loaded: false }" x-init="setTimeout(() => loaded = true, 50)" class="relative w-full h-full overflow-hidden">

    <div x-show="loaded" x-cloak x-transition:enter="transition ease-out {{ $duration }} {{ $delay }}"
        x-transition:enter-start="opacity-0 {{ $distance }}" x-transition:enter-end="opacity-100 translate-y-0 "
        {{ $attributes->merge(['class' => 'w-full p-4 overflow-y-auto max-h-screen mb-4']) }}>
        {{ $slot }}
    </div>
</div>
