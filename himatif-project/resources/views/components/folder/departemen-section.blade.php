<div>
    <section class="text-gray-600 md:px-20 px-8 p-3" id="departemen">
        <div class="container px-5 py-24 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">Departemen Himatif</h1>
                <div class="flex mt-6 justify-center">
                    <div class="w-16 h-1 rounded-full bg-red-500 inline-flex dark:bg-black"></div>
                </div>
            </div>
            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6">
                @forelse ($departemen as $dp)
                    
                <div
                    class="p-4 md:w-1/3 flex flex-col text-center items-center group dark:hover:bg-black rounded-lg hover:bg-white hover:border-transparent">
                    <div
                        class="w-20 h-20 inline-flex items-center justify-center rounded-full dark:bg-white bg-indigo-100 text-indigo-500 mb-5 flex-shrink-0">
                        <img src="{{ asset('storage/'.$dp->gambar) }}" class="object-fill w-full">
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-gray-900 text-lg title-font font-bold mb-3 dark:group-hover:text-white">
                            {{ $dp->nama }}
                        </h2>
                        <p class="leading-relaxed text-base dark:group-hover:text-white">
                            {{ $dp->deskripsi }}
                        </p>

                    </div>
                </div>
                @empty
                <div class="bg-gray-100 px-2 py-2 w-full text-center">Tidak ada Data</div>
                @endforelse
            </div>

        </div>
    </section>
</div>
