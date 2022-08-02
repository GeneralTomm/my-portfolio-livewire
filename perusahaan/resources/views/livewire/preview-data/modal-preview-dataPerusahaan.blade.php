<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center w-max-screen min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-blue-500 md:px-4 py-2 px-6 flex items-center justify-between">
                <span class="font-bold text-base text-white">Detail Data</span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button wire:click="CloseModalData()" type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-3 py-1 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            </div>

            <div class="md:px-4 px-2">
                <div class="flex flex-col items-center justify-between py-4">
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black ">
                            <h5 class="text-sm uppercase">Nip</h5>
                            <p class="leading-relaxed text-sm font-medium">{{ $nip }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Nama</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $name }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Departement</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $departement_data }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Section</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $section_data }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Tipe</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $tipe_data }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Area</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $area_data }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Seksi</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $seksi }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Alamat</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ $alamat }}</p>
                        </div>
                    </div>
                    <div class="bg-white shadow w-full my-2 px-4 py-2">
                        <div class="flex justify-between text-black">
                            <h5 class="text-sm uppercase">Tanggal</h5>
                            <p class="leading-relaxed text-sm font-medium capitalize">{{ date('d M Y',strtotime($tanggal)) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
