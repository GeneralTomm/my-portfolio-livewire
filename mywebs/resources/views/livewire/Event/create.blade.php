<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form method="POST" encyptype="multipart/form-data">
                @csrf
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Nama Event</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Input Nama Event" wire:model="nama_event">
                            @error('nama_event') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                            <input type="text"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Cikarang,Jawabarat" wire:model="alamat">
                            @error('alamat') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4" wire:model.debounce.10000ms="deskripsi" wire:ignore>
                            <label for="exampleFormControlInput2"
                                class="block text-gray-700 text-sm font-bold mb-2">Deskripsi</label>
                                <div class="body-content">
                                    <input id="deskripsi" value="{{ $deskripsi }}" type="hidden" name="deskripsi">
                                    <trix-editor input="deskripsi">
                                    </trix-editor>
                                </div>

                            @error('deskripsi') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="flex justify-between">
                            <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2">Acara Mulai</label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput2" wire:model="acara_mulai" type="date">
                                @error('acara_mulai') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2">Acara Selesai</label>
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="exampleFormControlInput2" wire:model="acara_selesai" type="date">
                                @error('acara_selesai') <span class="text-red-500">{{ $message }}</span>@enderror
                            </div>

                        </div>
                        <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2">Gambar</label>
                                <input type="file" wire:model="gambar" class=" appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">

                                @error('gambar') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2">Kategori Event</label>
                                <select wire:model="kategorievent_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($Kategori_event as $kategori )
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>

                                @error('pendaftaran') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-4">
                                <label for="exampleFormControlInput2"
                                    class="block text-gray-700 text-sm font-bold mb-2">Status Pendaftaran</label>
                                <select wire:model="pendaftaran" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <option value="">Pilih Status</option>
                                    <option value="buka">Buka</option>
                                    <option value="tutup">Tutup</option>
                                </select>

                                @error('pendaftaran') <span class="text-red-500">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="simpan()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Simpan
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="CloseModalEvent()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Close
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>


