<header class="bg-white p-3 shadow-sm sticky top-0 w-full z-10">
    <div class="max-w-6xl container mx-auto flex justify-between items-center px-5">
        <!-- Logo -->
        <div>
            <a href="/" class="font-extrabold uppercase text-2xl tracking-widest text-black">BayuPM</a>
        </div>

        <div class="lg:gap-4 gap-2 flex items-center">

            @auth
                <a href="{{route('dasbor')}}" class="bg-slate-900 py-2 px-5 hover:bg-slate-600 text-white rounded-md">Dasbor</a>
                
            @else
                <a href="{{route('masuk')}}" class="bg-slate-900 py-2 px-5 hover:bg-slate-600 text-white rounded-md">Masuk</a>
            @endauth
        </div>
    </div>
</header>