@section('judul', 'Tipe')
<div>

    <div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">
        <div class="flex">
            <div class="mt-5 md:mt-0 md:col-span-2 w-full">
                @if (session()->has('message'))
                <div class="bg-green-500 px-2 py-2 my-2">
                    <div class="text-white">
                        {{ session('message') }}
                    </div>
                </div>
                @endif

                <button wire:click="OpenModal()"
                    class="bg-blue-500 px-2 py-2 text-sm text-white font-medium hover:bg-blue-300 rounded">Add New</button>
                @if ($isModalOpen)
                @include('livewire.modal.modal-tipe')
                @endif
                <div class="bg-white shadow-md px-2 py-2 my-2">
                    <div class="flex justify-end w-auto mt-5 px-5">
                        <input type="text"
                            class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500""
                        placeholder="Search..." wire:model="search">

                    </div>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-10 mx-auto">
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-center">

                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                No</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Name Tipe</th>
                                            <th
                                                class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($tipee->count()>0)
                                        @foreach ($tipee as $tipe)
                                        <tr class="text-center">
                                            <td class="px-2 py-3 text-sm">{{ $loop->iteration }}</td>
                                            <td class="px-2 py-3 text-sm">{{ $tipe->nama_tipe }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900">
                                                <button wire:click="edit({{ $tipe->id }})" class="bg-yellow-500 mx-2 px-2 py-1 text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                @if ($konfirmasi === $tipe->id)
                                                {{-- hapus --}}
                                                <button wire:click="hapus({{ $tipe->id }})" class="bg-red-500 px-2 py-1 text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                                {{-- batal --}}
                                                <button wire:click="batalMenghapus()" class="bg-blue-500 text-white px-2 py-1 inline-flex">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                                @else
                                                {{-- konfirmasi hapus --}}
                                                <button wire:click="konfirmasiHapusId({{ $tipe->id }})" class="bg-red-500 text-white px-2 py-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </button>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td class="text-center" colspan="3">Tidak ada Tipe</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $tipee->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

</div>
