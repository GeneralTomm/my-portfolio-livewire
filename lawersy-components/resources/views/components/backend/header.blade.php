<div>
    <header class="header-class dark:bg-gray-500" >
    <div class="container lg:px-0 px-3">
        <div class="flex gap-3 justify-between items-center">
            <div class="flex gap-2 items-center">
                <button class="lg:hidden" @click.away="sidebar = !sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                    <a href="{{route('dashboard')}}" class="lg:h1-version-normal h1-version-small">
                        <span class="uppercase tracking-widest">Lowersy</span>
                    </a>
            </div>
            <div class="flex gap-4 items-center">
                <a href="/" class=" flex gap-3 items-center dark:bg-gray-900 dark:hover:bg-gray-500 hover:bg-gray-900 hover:text-white bg-white shadow-md rounded-md p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span class="text-sm font-semibold">
                        View Website

                    </span>
                </a>
                <div class="relative" x-data="{ open: false }">
                    <button x-on:click="open = !open" class="hover:bg-gray-900 p-2 rounded-md hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                        </svg>
                    </button>

                    <div class=" absolute right-2 mt-7 " x-show="open "
                    x-on:click.away="open = !open">
                        <div class=" w-52">
                            <div class="grids">
                                <a href="{{route('profile.show')}}" class=" flex items-center gap-3 dark:bg-gray-900 dark:hover:bg-gray-500 hover:bg-gray-900 hover:text-white bg-white shadow-md rounded-md p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                    <span class="lg:text-sm text-base">{{ Auth::user()->name}}</span>
                                </a>
                                <button id="buttondark" class="flex gap-3 dark:bg-gray-900 dark:hover:bg-gray-500 hover:bg-gray-900 hover:text-white items-center bg-white shadow-md rounded-md p-3">
                                    <svg clas xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path class="!open" stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                                    </svg>
                                    <span class="lg:text-sm text-base">Dark Mode</span>
                                </button>

                                <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <div class="flex items-center gap-3 dark:bg-gray-900 dark:hover:bg-gray-500 hover:bg-gray-900 hover:text-white bg-white shadow-md rounded-md p-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <a href="{{ route('logout') }}"
                                                        @click.prevent="$root.submit();">
                                                {{ __('Log Out') }}
                                            </a>

                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
</div>
