@section('judul', 'Departemen')
<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">

    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">
            <button wire:click="OpenModalDepartemen()"
                class="bg-blue-100 px-2 py-2 text-sm text-black font-medium hover:bg-blue-300 rounded">Tambah
                Departemen</button>
            @if ($isModalOpen)
            @include('livewire.back-end.departement.modal')
            @endif
            <div class="bg-white shadow-md px-2 py-2 my-2">
                <div class="flex justify-end w-auto mt-5 px-5">
                    <input wire:model="search"
                        class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Cari Departemen">
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
                                            Nama</th>

                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Deskripsi</th>
                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemen as $dp)
                                    <tr class="text-center">
                                        <td class="px-2 py-2">
                                            @if ($dp->gambar)
                                            <img src="{{ asset('storage/' . $dp->gambar) }}"
                                                class="w-12 h-12 rounded justify-center">
                                            @else
                                            <span>Tidak ada Gambar</span>
                                            @endif
                                        </td>
                                        <td class="px-2 py-3 text-sm">{{ $dp->nama }}</td>

                                        <td class="px-2 py-3 text-sm font-bold">
                                            {{ $dp->deskripsi }}</td>

                                        <td class="px-2 py-3 text-sm text-gray-900">
                                            <button wire:click="edit({{ $dp->id }})"
                                                class="bg-green-100 mx-2 px-2 py-1">Edit</button>
                                            <button wire:click="hapus({{ $dp->id }})"
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
