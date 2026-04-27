@props(['pomodoroSeconds' => 1500, 'breakSeconds' => 300])

<div x-data="timerHandler({
    pomodoroSeconds: {{ $pomodoroSeconds }},
    breakSeconds: {{ $breakSeconds }}
})" x-cloak
    class="bg-white/40 border border-white/40 p-8 rounded-md shadow-[0_20px_50px_rgba(0,0,0,0.1)] w-full max-w-sm mx-auto text-center transition-all duration-500">

    {{-- Tab Switcher --}}
    <div class="flex justify-center space-x-6 mb-10">
        <x-ui.button3D @click="setMode('pomodoro')"
            x-bind:class="{ 'bg-white !text-gray-800 font-semibold !border-gray-400': currentMode === 'pomodoro' }">
            Pomodoro
        </x-ui.button3D>

        <x-ui.button3D @click="setMode('break')"
            x-bind:class="{ 'bg-white !text-gray-800 font-semibold !border-gray-400': currentMode === 'break' }">
            Break
        </x-ui.button3D>
    </div>
    <div class="my-2">
        <span class="text-[10px] uppercase tracking-[0.3em] text-white font-bold"
            x-text="currentMode === 'pomodoro' ? 'Stay Focused' : 'Take a rest'"></span>
    </div>

    <div
        class="p-4 mb-10 rounded-md overflow-hidden h-28 lg:h-40 flex items-center justify-center bg-white/10 border border-white/40 shadow-[inset_0_2px_10px_rgba(0,0,0,0.05)] relative">
        <div class="absolute inset-0 bg-gradient-to-tr from-black/[0.02] to-transparent pointer-events-none"></div>

        <div x-show="!isChanging" x-transition:enter="transition ease-out duration-600"
            x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
            class="z-10">
            <span class="text-5xl lg:text-7xl font-light font-mono text-white/70 tracking-tight"
                x-text="formatTime()"></span>
        </div>
    </div>

    {{-- Control Buttons --}}
    <div class="flex items-center justify-center space-x-8">
        <button @click="resetTimer()"
            class="p-2 lg:p-3 bg-gray-100 text-gray-500 rounded-md border-b-2 border-gray-300 shadow-[0_4px_0_0_rgba(0,0,0,0.1)] active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all">
            <i data-lucide="rotate-ccw" class="w-4 h-4 lg:w-8 lg:h-8 "></i>
        </button>
        <button @click="isRunning ? pauseTimer() : startTimer()"
            class="flex items-center justify-center w-16 lg:w-32 h-8 lg:h-16 bg-gray-800 text-white rounded-md border-b-4 border-gray-950 shadow-[0_8px_0_0_rgba(0,0,0,0.2)] transition-all duration-100 hover:bg-gray-700 active:translate-y-1 active:border-b-0 active:shadow-none">
            <span x-show="!isRunning">
                <i data-lucide="play" class="w-4 h-4 lg:w-8 lg:h-8 fill-current"></i>
            </span>
            <span x-show="isRunning" x-cloak>
                <i data-lucide="pause" class="w-4 h-4 lg:w-8 lg:h-8 fill-current"></i>
            </span>
        </button>
        <button @click="skipMode()"
            class="p-2 lg:p-3 bg-gray-100 text-gray-500 rounded-md border-b-2 border-gray-300 shadow-[0_4px_0_0_rgba(0,0,0,0.1)] active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all">
            <i data-lucide="skip-forward" class="w-4 h-4 lg:w-8 lg:h-8 "></i>
        </button>

    </div>
</div>
