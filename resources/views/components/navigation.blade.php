<nav class="sticky top-0 z-50 bg-inherit ">
    <div class="border-b border-gray-300 max-w-7xl mx-auto px-4 flex justify-between h-20 py-2  items-center">
        <!-- Logo -->
        <a href="{{ route('pomodoro') }}" class="flex items-center space-x-2">
            <i data-lucide="focus" class="text-white w-7 h-7"></i>
            <span class="text-white">Pomofocus</span>
        </a>
        <div class="flex items-center gap-2 text-white">
            <!-- Menu -->
            <div class="flex items-center space-x-2 ">
                @foreach ($navItems as $item)
                    <x-ui.card-link href="{{ route($item['route']) }}"
                        class="{{ request()->routeIs($item['route']) ? 'bg-white/10 text-white' : 'border-white/10 text-gray-300' }} px-1 lg:px-2">

                        <i data-lucide="{{ $item['icon'] }}" class="w-5 h-5 "></i>
                        <span class="hidden text-xs md:inline">{{ __($item['name']) }}</span>
                    </x-ui.card-link>
                @endforeach
            </div>

            <!-- Auth -->
            <div class="flex items-center text-xs">
                @auth
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                            class="flex items-center space-x-2  p-0.5 rounded-md transition-all border border-white/20 text-white hover:bg-white/30">

                            @if (Auth::user()->avatar)
                                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                    class="w-8 h-8 object-cover rounded-lg">
                            @else
                                <div class="w-8 h-8 flex rounded-lg items-center justify-center ">
                                    <i data-lucide="user" class="w-5 h-5 text-white"></i>
                                </div>
                            @endif
                        </button>

                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-[60]">

                            <div class="px-4 py-2 border-b border-gray-50 mb-1">
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Account</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ Auth::user()->name }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 text-red-500 hover:bg-red-50 transition-colors">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 bg-white/20 px-1 lg:px-2 py-1 lg:py-2 rounded-lg transition-all border border-white/10 text-white">
                            <i data-lucide="user-round" class="w-5 h-5"></i>
                        </button>

                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100"
                            class="absolute right-0 mt-2 w-40 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-[60]">

                            <a href="{{ route('login') }}"
                                class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <i data-lucide="log-in" class="w-4 h-4 mr-2"></i> {{ __('Log In') }}
                            </a>

                            <a href="{{ route('register') }}"
                                class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-50">
                                <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i> {{ __('Register') }}
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
