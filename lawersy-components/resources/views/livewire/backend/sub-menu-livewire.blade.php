<div class="overflow-y-scroll">
    <div class="mt-4">
        @if ($message = Session::get('success'))
        <div class="bg-blue-800 text-white rounded-md p-2 my-2">

            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="flex justify-between items-center">
            <button wire:click="openModal()" class="px-5 mt-4 py-2 bg-gray-900 text-white hover:bg-gray-800 rounded-md">Add New</button>

             @if($isModal)
            @include('livewire.backend.modal.submenu.menuModal')
            @endif
            <select wire:model="filterMenu">
                <option value="">Select Menu</option>
                @foreach ($menu as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="block mt-5">
            <table class="w-full rounded-md bg-white text-center">
                <thead class="bg-gray-900">
                    <tr>
                        <th class="px-5 py-2 text-base text-white">No</th>
                        <th class="px-5 py-2 text-base text-white">Sub Menu</th>
                        <th class="px-5 py-2 text-base text-white">Menu</th>
                        <th class="px-5 py-2 text-base text-white">Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">

                    @forelse ($subMenu as $menu)
                    <tr class="hover:bg-gray-200">
                        <td class="px-5 py-2 text-base text-gray-900">{{$loop->iteration}}</td>
                        <td class="px-5 py-2 text-base text-gray-900">{{$menu->nama_sub_menu}}</td>
                        <td class="px-5 py-2 text-base text-gray-900">{{$menu->menu->name}}</td>
                        <td class="flex gap-3 py-2 w-20">
                            <button wire:click="editData({{$menu->id}})" class="bg-blue-900 px-5 py-1 text-white rounded-md">Edit</button>
                            <button wire:click.prevent="deleteId({{$menu->id}})" class="bg-red-900 px-5 py-1 text-white rounded-md">Hapus</button>
                            @if ($isDelete)
                            @include('livewire.backend.modal.submenu.deleteModalMenu')
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-5 py-2 text-base text-gray-900">No Data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
