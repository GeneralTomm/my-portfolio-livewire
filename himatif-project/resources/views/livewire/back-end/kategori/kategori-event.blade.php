@section('judul', 'Kategori-event')

<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">

    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">
            <button wire:click="OpenKategoriEventModal()"
                class="bg-blue-100 px-2 py-2 text-sm text-black font-medium hover:bg-blue-300 rounded">Tambah
                Kategori</button>
            @if ($isModalOpen)
            @include('livewire.back-end.kategori.modal')
            @endif
            <div class="bg-white shadow-md px-2 py-2 my-2">
                <div class="flex justify-end w-auto mt-5 px-5">
                    <input type="text"
                        class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500""
                        placeholder="Search Kategori..." wire:model="search">

                </div>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr class="text-center ">
                                        <th
                                            class=" px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                                            Nama Kategori</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Slug</th>

                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Status Kategori</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategoriEvent as $kategori)
                                    <tr class="text-center">

                                        <td class="px-2 py-3 text-sm">{{ $kategori->nama_kategori }}</td>
                                        <td class="px-2 py-3 text-sm">{{ $kategori->slug }}</td>
                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            @if ($kategori->status === 'aktif')
                                            <span class="bg-blue-100 px-2 py-1">Aktif</span></td>
                                        @else
                                        <span class="bg-red-100 px-2 py-1">Tidak Aktif</span></td>
                                        @endif
                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            <button wire:click="edit({{ $kategori->id }})"
                                                class="bg-green-100 mx-2 px-2 py-1">Edit</button>
                                            <button wire:click="hapus({{ $kategori->id }})"
                                                class="bg-red-100 px-2 py-1">Hapus</button>
                                        </td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

</div>
</div>
