@section('title', $event->nama_event)
<div>
    <section class="text-gray-600 md:px-20 px-8 p-3 bg-white overflow-hidden">
        <div class="container px-5 py-10 mx-auto">
            <div class="text-center mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font text-gray-900 mb-4">{{ $event->nama_event }}</h1>
                <div class="flex mt-6 justify-center">
                    <div class="w-16 h-1 rounded-full bg-red-500 inline-flex dark:bg-black"></div>
                </div>
    
                <div class="flex justify-between mt-10">
                    <div class="lg:w-1/4 w-full">
                        <div class="bg-white px-3 py-3 shadow">
                            @if ($event->gambar)
                            <img src="{{ asset('storage/'.$event->gambar) }}" class="object-fill w-auto h-60">
                            @else
                            <img src="{{ asset('storage/default/gambar.jpg') }}" class="object-fill w-auto h-autp">
                            @endif
                        </div>
                        <div class="bg-white shadow flex items-center mt-5">
                            <div class="bg-gray-100 px-2 py-2 text-black flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold px-3">{{ $event->nama_event }}</p>
                        </div>
                        <div class="bg-white shadow flex items-center mt-5">
                            <div class="bg-gray-100 px-2 py-2 text-black flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold px-3">
                                {{ date('d', strtotime($event->acara_mulai)) }} -
                                {{ date('d M Y', strtotime($event->acara_selesai)) }}
                            </p>
                        </div>
                        <div class="bg-white shadow flex items-center mt-5">
                            <div class="bg-gray-100 px-2 py-2 text-black flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <a href="event/kategori-event.html">
                                <p class="text-sm font-bold px-3">{{ $event->kategorievent->nama_kategori }}</p>
                            </a>
                        </div>
                        <div class="bg-white shadow flex items-center mt-5">
                            <div class="bg-gray-100 px-2 py-2 text-black flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-bold px-3">{{ $event->alamat }}</p>
                        </div>
    
    
                    </div>
                    <div class="w-3/4 ml-10 text-left ">
                        <div class="flex justify-start mb-5">
                            <div class="bg-white shadow flex items-center justify-center">
                                <div class="bg-gray-100 px-2 py-2 text-black flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-bold px-3">Pendaftaran di{{ $event->pendaftaran }}!</p>
                            </div>
                        </div>
                        <!-- Deskrispi Event -->
                        <div class="bg-white shadow">
                            <div class="bg-gray-100 flex px-5 py-2">
                                <h1 class="text-base font-bold text-black">Deskripsi Event</h1>
                            </div>
                            <div class="tracking-wider text-justify font-light text-sm mt-2 px-5 py-4">
                               {!! $event->deskripsi !!}
                            </div>
                        </div>
                        <div class="bg-white shadow mt-5" x-data="{buka:false}">
                            <div class="bg-gray-100 flex px-5 py-2">
                                <button x-on:click="buka = ! buka">
                                    <h1 class="text-sm font-bold text-black">Syarat & Ketentuan Event</h1>
                                </button>
                            </div>
                            <p class="tracking-wider text-justify font-light text-xs mt-2 px-5 py-5" x-show="buka">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. A alias
                                magni numquam voluptatibus ullam nisi eveniet nesciunt dolorem voluptate quisquam?
                                Commodi
                                obcaecati aut, vitae deserunt facere provident sit, laboriosam nostrum voluptatibus
                                eaque
                                maxime. Praesentium ab repellat, voluptatum temporibus a, sit delectus officia amet vero
                                quasi inventore tenetur corporis mollitia ducimus?
                                <br><br>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. A alias
                                magni numquam voluptatibus ullam nisi eveniet nesciunt dolorem voluptate quisquam?
                                Commodi
                                obcaecati aut, vitae deserunt facere provident sit, laboriosam nostrum voluptatibus
                                eaque
                                maxime. Praesentium ab repellat, voluptatum temporibus a, sit delectus officia amet vero
                                quasi inventore tenetur corporis mollitia ducimus?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
