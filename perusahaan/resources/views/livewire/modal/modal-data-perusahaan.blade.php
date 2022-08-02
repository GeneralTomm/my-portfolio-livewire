<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center max-w-max-screen min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form method="POST">
                @csrf
                <div class="bg-white px-5 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label
                                class="block text-gray-700 text-sm font-bold mb-2">Nip</label>
                            <input type="number" onKeyPress="if(this.value.length==15) return false;" pattern="^[0-9]$"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter Number Nip"
                                wire:model="nip">
                            @error('nip') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your name" wire:model="name"
                                onchange="this.value = this.value.toUpperCase();" style="text-transform: lowercase;">
                            @error('name') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Seksi</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter Seksi" wire:model="seksi">
                            @error('seksi') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="flex md:flex-row flex-col items-center justify-between">
                        <div class="mb-4">
                            <label  class="block text-gray-700 text-sm font-bold mb-2">Departement</label>
                            <select wire:model="departement_id"
                                class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Choose Departement</option>
                                @foreach ($departement as $dp)
                                <option value="{{ $dp->id }}">{{ $dp->nama_departement }}</option>
                                @endforeach
                            </select>
                            @error('departement_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label  class="block text-gray-700 text-sm font-bold mb-2">Section</label>
                            <select wire:model="section_id"
                                class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Choose Section</option>
                                @foreach ($sections as $s)
                                <option value="{{ $s->id }}">{{ $s->section }}</option>
                                @endforeach
                            </select>
                            @error('section_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Area</label>
                            <select wire:model="area_id"
                                class="shadow appearance-none border rounded w-full py-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Choose Area</option>
                                @foreach ($area as $a)
                                <option value="{{ $a->id }}">{{ $a->nama_area }}</option>
                                @endforeach
                            </select>
                            @error('area_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>

                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Tipe</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center" wire:model="tipe_id">
                                    @foreach ($tipe as $t)
                                    <input type="radio" class="form-radio" wire:model="tipe_id" value="{{ $t->id }}">
                                    <span class="ml-2 text-sm">{{ $t->nama_tipe }}</span>
                                    @endforeach
                                </label>
                            </div>
                            @error('tipe_id') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label  class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                placeholder="Enter your address" wire:model="alamat">
                            @error('alamat') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Date</label>
                            <input type="date"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                wire:model="tanggal">
                            @error('tanggal') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="simpan()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Save
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="CloseModal()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
