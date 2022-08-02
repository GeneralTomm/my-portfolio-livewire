@section('judul', 'Home')
<div>
    <div class="mx-auto px-4 sm:px-6 lg:px-5 -4 m-3">
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
                @include('livewire.modal.modal-data-perusahaan')
                @endif
                <div class="bg-white shadow-md max-w-full px-2 py-2 my-2">
                    <div class="flex justify-end w-auto mt-3 px-2">
                        <input type="text"
                            class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            placeholder=" Search..." wire:model="search">

                        <select wire:model="DepartementSelected"
                            class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Choose Departement</option>
                            @foreach ($departement as $dp)
                            <option value="{{ $dp->id }}">{{ $dp->nama_departement }}</option>
                            @endforeach
                        </select>
                        <select wire:model="AreaSelected"
                            class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Choose Area</option>
                            @foreach ($area as $ar)
                            <option value="{{ $ar->id }}">{{ $ar->nama_area }}</option>
                            @endforeach
                        </select>
                        <select wire:model="SectionSelected"
                            class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Choose Section</option>
                            @foreach ($sections as $sections)
                            <option value="{{ $sections->id }}">{{ $sections->section }}</option>
                            @endforeach
                        </select>
                    </div>

                    <section class="text-gray-600 body-font max-w-full">
                        <div class="container px-5 py-10 mx-auto">
                            <div class="w-full mx-auto overflow-auto">
                                <table class="table-auto table-borderless w-full text-left whitespace-no-wrap">
                                    <thead>
                                        <tr class="text-center">

                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                No</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Name</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Departement</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Area</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Section</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Tipe</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Seksi</th>
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($dataPerusahaan->count()>0)
                                        @foreach ($dataPerusahaan as $dp)
                                        <tr class="text-center">
                                            <td class="px-2 py-3 text-sm">{{ $loop->iteration }}</td>
                                            <td class="px-2 py-3 text-sm">{{ $dp->name }}</td>
                                            <td class="px-2 py-3 text-sm">{{ $dp->departement->nama_departement }}</td>
                                            @if ($dp->area_id === null)
                                            <td class="px-2 py-3 text-sm"> Null </td>
                                            @else
                                            <td class="px-2 py-3 text-sm">{{ $dp->area->nama_area }}</td>
                                            @endif

                                            @if ($dp->section_id === null)
                                            <td class="px-2 py-3 text-sm">Null</td>
                                            @else
                                            <td class="px-2 py-3 text-sm">{{ $dp->section->section }}</td>
                                            @endif

                                            @if($dp->tipe_id === null)
                                            <td class="px-2 py-3 text-sm">Null</td>
                                            @else
                                            <td class="px-2 py-3 text-sm">{{ $dp->tipe->nama_tipe }}</td>
                                            @endif
                                            <td class="px-2 py-3 text-sm">{{ $dp->seksi }}</td>
                                            <td class="px-2 py-3 text-sm text-gray-900 flex">
                                                {{-- detail --}}
                                                @if($isModalData)
                                                @include('livewire.preview-data.modal-preview-dataPerusahaan')
                                                @endif
                                                <button wire:click="detail({{ $dp->id }})"
                                                    class="bg-blue-500 px-2 py-1 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </button>
                                                {{-- edit --}}
                                                <button wire:click="edit({{ $dp->id }})"
                                                    class="bg-yellow-500 px-2 py-1 text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                @if($konfirmasi === $dp->id)
                                                <button wire:click="hapus({{ $dp->id }})" class="bg-red-500 px-2 py-1 text-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                                {{-- batal --}}
                                                <button wire:click="batalMenghapus()" class="bg-blue-500 text-white px-2 py-1 inline-flex">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                                @else
                                                {{-- konfirmasi hapus --}}
                                                <button wire:click="konfirmasiHapusId({{ $dp->id }})"
                                                    class="bg-red-500 text-white px-2 py-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
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
                                            <td class="text-center" colspan="3">Tidak ada Departement</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{ $dataPerusahaan->links() }}
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</div>
