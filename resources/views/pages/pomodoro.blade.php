<x-app-layout>
    <x-slot:title>
        Pomodoro
    </x-slot:title>
    <div class="flex justify-center flex-col mt-10 mx-4 overflow-x-hidden ">
        <x-modules.pomodoro.timer />
        <x-modules.pomodoro.task />
    </div>
</x-app-layout>
