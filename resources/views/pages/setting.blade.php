<x-app-layout>
    <section x-data="settingHandler('{{ route('settings.update') }}', @js($settings))"
        class="w-full h-full mb-20 lg:mb-0 max-w-7xl mx-auto flex flex-col rounded-md bg-white ">
        <form @submit.prevent="saveSetting">
            <div>
                <x-modules.setting.timer-section />
                <x-modules.setting.task-section />
                <x-modules.setting.sound-section />
                <x-modules.setting.theme-section />
            </div>

            <div class="p-6 flex justify-end gap-4 font-bold text-white">
                <button
                    class="p-2 lg:p-3 bg-red-500 rounded-md border-b-2 border-gray-300 active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all">
                    Cancel
                </button>
                <button type="submit" :disabled="loading"
                    class="p-2 lg:p-3 bg-green-500 rounded-md border-b-2 border-gray-300 active:translate-y-0.5 active:border-b-0 active:shadow-none transition-all flex items-center justify-center min-w-[120px]">

                    <div x-show="loading" class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>

                    <span x-show="!loading">Save Settings</span>
                </button>
            </div>
        </form>
    </section>
</x-app-layout>
