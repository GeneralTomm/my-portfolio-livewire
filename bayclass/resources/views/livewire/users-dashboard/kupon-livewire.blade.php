<div>
    @section('title', 'Kupon Bootcamp')
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
                        <h4 class="text-black lg:text-xl text-base font-semibold">Halaman Kupon [ Background Merah ]</h4>
                    </div>
                   
                    @if(isset($kuponCode))
                        {{ $kuponCode->links() }}
                        @foreach ($kuponCode as $item)
                        <div class="bg-white shadow-lg p-4 flex lg:flex-row flex-col gap-3 justify-between items-center rounded-md">
                            <div>
                                <span class="text-base font-normal">
                                    {{ $item['nama_kupon'] }}
                                </span>
                            </div>
                            <div>
                                <span class="text-base font-normal bg-red-500 p-3 text-white rounded-md">
                                    {{ Str::upper($item['kode_kupon']) }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                        
                    @endif
                </div>

            </div>
        </div>
    </section>
</div>