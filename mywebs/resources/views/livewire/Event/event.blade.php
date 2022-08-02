<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">
    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">
            <button wire:click="OpenModalEvent()" class="bg-blue-100 px-2 py-2 text-sm text-black font-medium hover:bg-blue-300 rounded">Tambah
                Acara</button>
            @if ($isModalOpen)
            @include('livewire.Event.create')
            @endif
            <div class="bg-white shadow-md px-2 py-2 my-2">
                <div class="flex justify-end w-auto mt-5 px-5">
                    <input wire:model="search" type="search" class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"" placeholder="Cari Data">
                    <select wire:model="cariKategori" class="block appearance-none bg-white border border-gray-200 text-gray-700 py-1 px-2 pr-8 mx-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="">Pilih Kategori</option>
                        @foreach ($Kategori_event as $kategori )
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <select wire:model="perhalaman" class="block appearance-none bg-white border border-gray-200 text-gray-700 py-1 px-2 pr-8 mx-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                    </select>
                     <select wire:model="sortBy" class="block appearance-none bg-white border border-gray-200 text-gray-700 py-1 px-2 pr-8 mx-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="asc">Asc</option>
                        <option value="desc">Desc</option>
                    </select>
                    <select wire:model="cariPendaftaran" class="block appearance-none bg-white border border-gray-200 text-gray-700 py-1 px-2 pr-8 mx-2 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        <option value="">Pilih Pendaftaran</option>
                        <option value="buka">Buka</option>
                        <option value="tutup">Tutup</option>
                    </select>
                </div>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr class="text-center ">
                                        <th
                                            class=" px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                            Gambar</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Judul</th>

                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Tanggal Acara</th>
                                        <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Kategori</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Pendaftaran</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($Acara->count()>0)
                                    @foreach ($Acara as $acara)
                                    <tr class="text-center">
                                        <td class="px-2 py-2">
                                            @if ($acara->gambar)
                                            <img src="{{ asset('storage/'.$acara->gambar) }}" class="w-12 h-12 rounded justify-center">
                                            @else
                                            <span>Tidak ada Gambar</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 text-sm">{{ $acara->nama_event }}</td>
                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            {{ date('d', strtotime($acara->acara_mulai)) }} - {{ date('d M Y', strtotime($acara->acara_selesai)) }}
                                        </td>
                                        <td class="px-2 py-3 text-sm font-bold">{{ $acara->kategorievent->nama_kategori }}</td>
                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            @if ($acara->pendaftaran === 'buka')
                                            <span class="bg-blue-100 px-2 py-1">Buka</span></td>
                                            @else
                                            <span class="bg-red-100 px-2 py-1">Tutup</span></td>
                                            @endif
                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            <button wire:click="edit({{ $acara->id }})" class="bg-green-100 mx-2 px-2 py-1">Edit</button>
                                            <button wire:click="hapus({{ $acara->id }})" class="bg-red-100 px-2 py-1">Hapus</button>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="flex justify-center text-center">
                                        <td class="justify-center text-center">Tidak ada event</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            {{ $Acara->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

</div>
</div>


