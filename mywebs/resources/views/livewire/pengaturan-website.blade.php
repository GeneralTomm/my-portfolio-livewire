<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">
    @if (session()->has('message'))
    <div class="bg-green-200 px-2 py-2 my-2">
            <div class="text-white">
                {{ session('message') }}
            </div>
    </div>
    @endif
    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">

            <form wire:submit.prevent="updatePengaturan" method="POST">
                @csrf
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700" >
                                Nama Website
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                type="text" wire:model="nama_website" value="{{ $pengaturan->nama_website }}">
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Url Facebook
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="url_facebook" type="text" wire:model="url_facebook">
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Url Youtube
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="url_youtube" type="text" wire:model="url_youtube">
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Url Instagram
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="url_instagram" type="text" wire:model="url_instagram">
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Deskripsi Website
                            </label>
                            <textarea
                             id="deskripsi" wire:model="deskripsi"
                             class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" cols="30" rows="2">

                            </textarea>
                        </div>

                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Email
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="email" type="email" wire:model="email">
                        </div>
                        <div class="col-span-6 sm:col-span-12">
                            <label class="block font-medium text-sm text-gray-700">
                                Nomor handphone
                            </label>
                            <input
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                                id="nomor_hp" type="number" wire:model="nomor_hp" pattern="[0-9]>
                        </div>

                    </div>
                </div>

                <div
                    class="flex items-center justify-start px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</div>
