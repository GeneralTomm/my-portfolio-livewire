<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyBusiness</title>
    <meta name="author" content="Bayu Priyambada">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }

        .bg-sidebar {
            background: #3d68ff;
        }

        .cta-btn {
            color: #3d68ff;
        }

        .upgrade-btn {
            background: #1947ee;
        }

        .upgrade-btn:hover {
            background: #0038fd;
        }

        .active-nav-link {
            background: #1947ee;
        }

        .nav-item:hover {
            background: #1947ee;
        }

        .account-link:hover {
            background: #3d68ff;
        }
    </style>
</head>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="{{ route('home') }}"
                class="text-white text-2xl font-semibold uppercase hover:text-gray-300">MyBusiness</a>

        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route("home") }}"
                class="flex items-center text-white py-4 pl-6 nav-item {{ (request()->is('home')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Home
            </a>
            <a href="{{ route('section') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ (request()->is('section')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-sticky-note mr-3"></i>
                Section
            </a>
            <a href="{{ route('departemen') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ (request()->is('departemen')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-sticky-note mr-3"></i>
                departement
            </a>
            <a href="{{ route('area') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ (request()->is('area')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-sticky-note mr-3"></i>
                Area
            </a>
            <a href="{{ route('tipe') }}"
                class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item {{ (request()->is('tipe')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-sticky-note mr-3"></i>
                Tipe
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen"
                    class="realtive z-10 rounded overflow-hidden px-4 py-1 text-white bg-blue-500 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <h4>{{ Auth::user()->name }}</h4>
                </button>
                <button x-show="isOpen" @click="isOpen = false"
                    class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="{{ route('profile.show') }}"
                        class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Support</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="block px-4 py-2 account-link hover:text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>

                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html"
                    class="text-white text-3xl font-semibold uppercase hover:text-gray-300">MyBusiness</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="{{ route('home') }}" class="flex items-center text-white py-2 pl-4 nav-item
                    {{ (request()->is('home')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Home
                </a>
                <a href="{{ route('section') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item
                    {{ (request()->is('section')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Section
                </a>
                <a href="{{ route('departemen') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item
                    {{ (request()->is('departemen')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Departement
                </a>
                <a href="{{ route('area') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item
                    {{ (request()->is('area')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Area
                </a>
                <a href="{{ route('tipe') }}" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item
                    {{ (request()->is('tipe')) ? 'active-nav-link' : '' }}">
                    <i class="fas fa-sticky-note mr-3"></i>
                    Tipe
                </a>
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>

        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-3">
                {{  $slot }}
            </main>

        </div>


    </div>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"
        integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    @stack('modals')

    @livewireScripts
</body>

</html>
