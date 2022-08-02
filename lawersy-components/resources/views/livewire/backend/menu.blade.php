<div>
    <div class="mt-4">
        @if ($message = Session::get('success'))
        <div class="bg-blue-800 text-white rounded-md p-2 my-2">

            <strong>{{ $message }}</strong>
        </div>
        @endif
        <button wire:click="openModal()" class="px-5 mt-4 py-2 bg-gray-900 text-white hover:bg-gray-800 rounded-md">Add New</button>

        @if($isModal)
        @include('livewire.backend.modal.menu.menuModal')
        @endif
        <div class="block mt-5">
            <table class="w-full rounded-md bg-white text-center">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-5 py-2 text-base text-white">No</th>
                        <th class="px-5 py-2 text-base text-white">Name Menu</th>
                        <th class="px-5 py-2 text-base text-white">Status</th>
                        <th class="px-5 py-2 text-base text-white">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($menus as $menu)
                    <tr>
                        <td class="px-5 py-2 text-base text-gray-900">{{$loop->iteration}}</td>
                        <td class="px-5 py-2 text-base text-gray-900">{{$menu->name}}</td>
                        <td class="px-5 py-2 text-base text-gray-900">
                            @if ($menu->status == 1)
                                <span class="bg-blue-500 p-2">Active</span>
                            @else
                                <span class="bg-red-500 p-2">Non Active</span>
                            @endif
                        </td>
                        <td class="flex gap-3 py-2 w-20">
                            <button wire:click="editData({{$menu->id}})" class="bg-blue-900 px-5 py-1 text-white rounded-md">Edit</button>
                            <button wire:click.prevent="deleteId({{$menu->id}})" class="bg-red-900 px-5 py-1 text-white rounded-md">Hapus</button>
                            @if ($isDelete)
                            @include('livewire.backend.modal.menu.deleteModalMenu')
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
