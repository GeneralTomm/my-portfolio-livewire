<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>
            @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
            .font-family-karla { font-family: karla; }
            .bg-sidebar { background: #3d68ff; }
            .cta-btn { color: #3d68ff; }
            .upgrade-btn { background: #1947ee; }
            .upgrade-btn:hover { background: #0038fd; }
            .active-nav-link { background: rgb(120, 211, 46); }
            .nav-item:hover { background: #1947ee; }
            .account-link:hover { background: #3d68ff; }
        </style>

        @trixassets
        @livewireStyles

    </head>
    <body class="bg-gray-100 font-family-karla flex">
        <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl overflow-y-auto">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>

            </div>
            <nav class="text-white text-base font-semibold pt-3">
                <a href="{{ route('dashboard') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('dashboard')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="{{ route('project') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('project')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Projects
                </a>
                <a href="{{ route('categories-project') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('categories-project')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Categories Projects
                </a>
                <a href="{{ route('services') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('services')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Services
                </a>
                <a href="{{ route('order-step') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('order-step')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Order Steps
                </a>
                <a href="{{ route('testimonial') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('testimonial')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Testimonial
                </a>
                <a href="{{ route('blog') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('blog')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Blog
                </a>
                <a href="{{ route('categories-blog') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('categories-blog')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Categories Blog
                </a>
                <a href="{{ route('about-me') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('about-me')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    About Me
                </a>
                <a href="{{ route('settings') }}" class="flex items-center active:text-blue-500 opacity-75 hover:opacity-100 py-4 pl-6 nav-item
                {{ (request()->is('settings')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-cog mr-3"></i>
                    Settings
                </a>
            </nav>
        </aside>

        <div class="relative w-full flex flex-col h-screen overflow-y-hidden">
            <!-- Desktop Header -->
            <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
                <div class="w-1/2"></div>
                <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                    <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                        <img src="{{ Auth::user()->profile_photo_url }}">
                    </button>
                    <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                    <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 account-link hover:text-white">Account</a>
                        <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                        this.closest('form').submit();" class="block px-4 py-2 account-link hover:text-white">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Mobile Header & Nav -->
            <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
                <div class="flex items-center justify-between">
                    <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>
                    <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                        <i x-show="!isOpen" class="fas fa-bars"></i>
                        <i x-show="isOpen" class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Dropdown Nav -->
                <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                    <a href="index.html" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Dashboard
                    </a>
                    <a href="blank.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                        <i class="fas fa-sticky-note mr-3"></i>
                        Blank Page
                    </a>
                </nav>
                <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-plus mr-3"></i> New Report
                </button> -->
            </header>

            <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
                <main class="w-full flex-grow p-6">
                    {{ $slot }}
                    <!-- Content goes here! 😁 -->
                </main>

                <footer class="w-full bg-white text-right p-4">
                    Built by <a target="_blank" href="https://davidgrzyb.com" class="underline">David Grzyb</a>.
                </footer>
            </div>

        </div>

        @stack('modals')

        @livewireScripts

        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
    <!-- Font Awesome -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    </body>
</html>
