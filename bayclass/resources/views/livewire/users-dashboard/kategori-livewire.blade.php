<div>
    @section('title', 'Kategori Kelas')
    <section id="section1" class="max-w-6xl container mx-auto my-10 px-5">

        <div class="flex gap-4 lg:flex-row flex-col">
            @include('components.components-users.menu-components')
            <div class=" lg:w-3/4 overflow-hidden h-full flex flex-col space-y-5">
                <div class="flex flex-col gap-3">
                    <div class="bg-white shadow-lg p-4 flex gap-3 items-center rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <h4 class="text-black lg:text-xl text-base font-semibold">Halaman Kategori Kelas
                        </h4>
                    </div>

                    <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
                        {{-- @dump($kategoriKelas) --}}
                        @if(isset($kategoriKelas))

                            @foreach ($kategoriKelas as $item)
                            <div class="bg-white shadow-lg p-4 rounded-md text-center">
                                <div>
                                    <span class="text-base font-normal">
                                        {{ $item['nama_kategori'] }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            
                        @endif
                    </div>

                    {{-- {{ $kategoriKelas->links() }} --}}
                    
                </div>

            </div>
        </div>
    </section>
</div>