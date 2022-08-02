<div class="flex flex-col gap-3 w-full lg:w-1/4">
    <div class="bg-white shadow-lg p-4 flex gap-3 items-center rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <h4 class="text-black lg:text-xl text-base font-semibold">Menu Anda </h4>
    </div>
    <div class="bg-white shadow-lg p-2 flex gap-3 justify-center items-center rounded-md sticky top-20">
        <div class="grid grid-cols-1 my-2 w-full space-y-3 ">
            <a href="{{ route('dasbor') }}" class=" {{ Request::is('dasbor') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                 Dasbor
            </a>
            <a href="{{ route('pilihan-kelas') }}" class=" {{ Request::is('pilihan-kelas') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                 Pilihan Kelas
            </a>
            <a href="{{ route('kategori-kelas') }}" class=" {{ Request::is('kategori-kelas*') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                 Kategori Kelas
            </a>
            <a href="{{ route('kelas-anda') }}" class=" {{ Request::is('kelas-anda') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                Kelas Saya
            </a>
            <a href="{{ route('kupon-bootcamp') }}" class=" {{ Request::is('kupon-bootcamp*') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                Kupon Bootcamp
            </a>
            <a href="#" class="hover:bg-slate-600 p-2 rounded-md w-full text-base hover:text-white ">
                Notifikasi Baru
            </a>
            <a href="{{ route('pengaturan') }}" class="{{ Request::is('pengaturan') ? 'bg-slate-600 p-2 rounded-md text-base w-full text-white' : 'hover:bg-slate-600 p-2 rounded-md text-base w-full hover:text-white' }}">
                Pengaturan
            </a>
            <livewire:front.logout />
        </div>
    </div>
    </div>