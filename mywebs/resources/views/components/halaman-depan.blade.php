<nav x-data="{show:false}"
    class="container mx-auto lg:px-12 md:px-8 px-5 flex items-center justify-between flex-wrap bg-red-500 p-4">
    <div class="flex items-center flex-shrink-0 text-white mr-6">
        <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z" />
        </svg>
        <a href="/" class="font-bold text-2xl tracking-tight">{{ $pengaturan->nama_website }}</a>
    </div>
    <div class="block md:hidden">
        <button @click="show=!show"
            class="flex items-center px-3 py-2 border rounded text-gray-100 border-gray-200 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
            </svg>
        </button>
    </div>
    <div @click.away="show = false" :class="{ 'block': show, 'hidden': !show }"
        class="w-full block flex-grow md:flex md:justify-end md:w-auto">
        <div class="flex items-center">
            <a href="#"
                class="block md:inline-block text-sm px-4 py-2 leading-none rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 md:mt-0">Home</a>
            <a href=""
                class="block md:inline-block text-sm px-4 py-2 leading-none rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 md:mt-0">Services</a>
            <a href="{{ route('kontaks') }}"
                class="block md:inline-block text-sm px-4 py-2 leading-none rounded text-white border-white hover:border-transparent hover:text-black hover:bg-white mt-4 md:mt-0">Kontak</a>

            <a href="https://api.whatsapp.com/send?phone={{ $pengaturan->nomor_hp }}&text=Halo%20kak%2C%20mau%20nanya-nanya%20boleh%3F"
                target="_blank" class="flex bg-white px-3 py-2 rounded items-center md:ml-2 mt-2 md:mt-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="red">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <span class="text-sm font-normal ml-2"> Bayu</span>
            </a>
        </div>
    </div>
</nav>
