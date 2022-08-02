<nav x-data="{show:false}" class="flex items-center justify-between flex-wrap bg-white md:px-20 px-8 p-3 shadow-sm sticky top-0 z-50
            dark:bg-black">
    <div class="flex items-center flex-shrink-0 text-red-500 mr-6">
        <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
        </svg>
        <a href="/" class="font-semibold text-xl tracking-tight dark:text-white">{{ $settings->nama_website }}</a>
    </div>

    <div class="block md:hidden">
        <button @click="show=!show"
            class="flex items-center px-3 py-2 rounded text-red-500 dark:text-white border-gray-200 hover:text-black dark:hover:text-red-500">
            <svg class="fill-current h-5 w-5" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
        </button>
    </div>
    <div @click.away="show = true" :class="{ 'block': show, 'hidden': !show }"
        class="w-full block flex-grow md:flex md:justify-end md:w-auto">
        <div class="md:flex items-center justify-center menu-link">
            <a href="/" class="block md:inline-block active text-sm px-4 py-2 dark:text-white
                        leading-none rounded text-gray-500 border-white hover:border-transparent
                        mt-4 md:mt-0">Beranda</a>
            <a href="/#tim"
                class="block md:inline-block text-sm px-4 py-2 dark:text-white dark:hover:text-red-500 leading-none rounded text-gray-500 border-white hover:border-transparent hover:text-red-500 mt-4 md:mt-0">Tim</a>
            <a href="/#departemen"
                class="block md:inline-block text-sm px-4 py-2 dark:text-white dark:hover:text-red-500 leading-none rounded text-gray-500 border-white hover:border-transparent hover:text-red-500 mt-4 md:mt-0">Departemen</a>
            <a href="{{ route('event-kami') }}"
                class="block md:inline-block text-sm px-4 py-2 dark:text-white dark:hover:text-red-500 leading-none rounded text-gray-500 border-white hover:border-transparent hover:text-red-500 mt-4 md:mt-0">Event</a>
            <a href="#"
                class="block md:inline-block text-sm px-4 py-2 dark:text-white dark:hover:text-red-500 leading-none rounded text-gray-500 border-white hover:border-transparent hover:text-red-500 mt-4 md:mt-0">Galeri</a>
            <a href="{{ route('kontak-kami') }}"
                class="block md:inline-block text-sm px-4 py-2 dark:text-white dark:hover:text-red-500 leading-none rounded text-gray-500 border-white hover:border-transparent hover:text-red-500 mt-4 md:mt-0">Kontak</a>
            <a href="https://api.whatsapp.com/send?phone={{ $settings->nomor_hp }}&text=Halo%20kak%2C%20mau%20nanya-nanya%20boleh%3F" class="flex bg-gray-200 px-3 py-2 dark:bg-white rounded items-center md:ml-2 md:mt-0 mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="red">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span class="text-sm font-normal ml-2"> Bayu Priyambada</span>
            </a>
            <button id="switchTheme"
                class="h-10 w-10 flex justify-center items-center focus:outline-none text-yellow-500">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

</nav>
