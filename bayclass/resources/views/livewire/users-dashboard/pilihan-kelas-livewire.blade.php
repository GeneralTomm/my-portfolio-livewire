
<div>
    @section('title', 'Pilihan Kelas')
    <section id="section1" class="max-w-6xl container mx-auto my-10 px-5">
        
        <div class="flex gap-4 lg:flex-row flex-col">
            @include('components.components-users.menu-components')
            <div class=" lg:w-3/4 overflow-hidden h-full flex flex-col space-y-5">
                <div class="flex flex-col gap-3">
                    <div class="bg-white shadow-lg p-4 flex gap-3 items-center rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <h4 class="text-black lg:text-xl text-base font-semibold">Halaman Pilihan Kelas</h4>
                    </div>
                    <div class="grid grid-cols-1 gap-2">
                        
                        
                        @if(isset($kelas))
                            {{ $kelas->links() }}
                            @forelse ($kelas as $k )
                            <div class="bg-white p-3 w-full flex md:flex-row flex-col gap-3">
                                <img src="https://dummyimage.com/350x350/000/fff" alt="Kelas" class="lg:w-48 w-full h-48 rounded-md">
                                <div class="flex flex-col gap-2">
                                    <div class="mt-1">
                                        <div class="flex justify-between items-center">
                                            <div class="flex gap-3">
                                                
                                                <span class="text-black text-sm font-medium py-1">
                                                    {{ $k['nama_kategori'] }}
                                                </span>
                                                <span class="text-black text-sm font-medium py-1">
                                                    {{ $k['nama_user'] }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-normal text-justify">
                                                    {{ $k['harga_kelas'] }}
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <h2 class="text-xl font-semibold truncate">{{ $k['nama_kelas'] }}</h2>
                                    <p class="text-sm font-normal text-justify">
                                        {{ substr($k['deskripsi_kelas'], 0, 200) }}
                                    </p>
                            
                                    <div class="mt-2 flex justify-end bottom-4">
                                        @if($k['dipilih_user_id'] == null)

                                        @if($konfirmasiValidasi === $k['id'])
                                            <button wire:click="konfirmasiValidasi({{ $k['id'] }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                                Validasi
                                            </button>
                                        @else
                                            <button wire:click="pilihKelas({{ $k['id'] }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                                                Pilih
                                            </button>
                                            
                                        @endif
                                        {{-- <button wire:click="validasiPilih()" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
                                            Pilih Kelas
                                        </button>
                                        <button wire:click="pilihKelas({{ $k['id'] }})" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
                                            Terima
                                        </button> --}}
                                        @else
                                        <button wire:click="pilihKelas({{ $k['id'] }})" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
                                            Akses Kelas
                                        </button>
                                        @endif
                                        {{-- <button wire:click="pilihKelas({{ $k['id'] }})" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded-full">
                                            Pilih Kelas
                                        </button> --}}
                                        {{-- <a href="#" class="bg-slate-900 px-5 py-1.5 text-white hover:bg-slate-500 rounded-md">Pilih Kelas</a> --}}
                                    </div>
                            
                                </div>
                            </div>
                            @empty
                            <div class="bg-white shadow-md rounded-md p-3">
                                <div class="text-center">
                                    <span>
                                        Tidak Ada Data
                                    </span>
                                </div>
                            </div>
                            @endforelse
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>