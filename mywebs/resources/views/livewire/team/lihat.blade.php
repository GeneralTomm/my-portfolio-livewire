<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-blue-100 w-full px-2 py-2 mb-2">
                <h3 class="font-bold">Detail Data Tim</h3>
            </div>
            <div class="grid grid-cols-1 divide-y divide-black m-4 ">
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Nama</h5>
                        <span class="font-medium text-sm ">{{ $nama }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Jabatan</h5>
                        <span class="font-medium text-sm ">{{ $jabatan }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Instagram</h5>
                        <span class="font-medium text-sm ">{{ $instagram }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Facebook</h5>
                        <span class="font-medium text-sm ">{{ $facebook }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Twitter</h5>
                        <span class="font-medium text-sm ">{{ $twitter }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Status</h5>
                        <span class="font-medium text-sm ">{{ $status }}</span>
                </div>
                <div class="m-2 flex justify-between items-center">
                        <h5 class="font-bold text-base">Gambar</h5>
                        <img src="{{ asset('storage/'.$this->gambar) }}" class="h-20 w-20 rounded-full">
                </div>
            </div>
            <div class="bg-red-100 flex justify-end m-4">
                <button wire:click="CloseDataTim()" class="bg-blue-100 px-2 py-1 my-2 mx-2 rounded ">Keluar</button>
            </div>
        </div>
    </div>
</div>

