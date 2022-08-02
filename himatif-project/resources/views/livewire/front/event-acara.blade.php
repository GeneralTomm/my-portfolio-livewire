<div>
    <section class="text-gray-600 md:px-20 px-8 p-3 bg-white overflow-hidden">
        <div class="container px-5 py-10 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">Event Himatif</h1>
                <div class="flex mt-6 justify-center">
                    <div class="w-16 h-1 rounded-full bg-red-500 inline-flex dark:bg-black"></div>
                </div>
            </div>

            <div class="flex mb-10">
                <div class="bg-gray-100 shadow border-black w-full px-10 mx-4 py-3 rounded-md text-center">
                    <input wire:model="search"
                        class="border border-green-400 py-1 focus:outline-none px-2 focus:ring-2 focus:ring-red-500 focus:border-transparent rounded"
                        placeholder="Cari Event" type="search">
                    <select wire:model="PilihEvent" class="border border-green-400 py-1 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent rounded">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoriEvents as $kategori )
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="-my-8 divide-y-2 divide-gray-100">
                @if(count($events)>0)
                @foreach ($events as $event )
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex relative">
                        <img src="{{ asset('storage/'.$event->gambar) }}" class="w-auto h-auto rounded-md">
                        <div class="absolute bottom-0 right-0 flex p-2 bg-red-500 text-white dark:bg-black flex-col">
                            <span class="text-sm">
                                {{ date('d', strtotime($event->acara_mulai)) }} -
                                {{ date('d M Y', strtotime($event->acara_selesai)) }}
                            </span>
                        </div>
                    </div>
                    <div class="md:flex-grow p-4">
                        <div class="flex justify-between align-middle items-center mb-3">
                            <h2 class="text-2xl font-medium text-gray-900 title-font mb-2">{{ $event->nama_event }}</h2>
                            <span
                                class="bg-blue-100 text-black tracking-wider text-sm px-2 py-1 rounded">{{ $event->kategorievent->nama_kategori }}</span>
                        </div>
                        <p class="leading-relaxed">{!! $event->deskripsi !!} </p>
                        <a href="{{ route('event-show',$event->slug) }}"
                            class="text-black rounded bg-gray-100 px-2 py-1 dark:bg-black dark:text-white inline-flex items-center mt-4">
                            Detail Event
                            <svg class="w-4 h-4 ml-2 animate-bounce" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
                @else
                <div class="bg-white shadow px-2 py-2 text-center font-medium text-base">Tidak ada Event</div>
                @endif
            </div>
            {{ $events->links() }}
        </div>
    </section>
</div>
