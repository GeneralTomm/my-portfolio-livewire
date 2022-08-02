<div>
    @section('title' ,'Categories Projects')
    <h1 class="text-3xl text-black pb-6">Tables</h1>
    <div>
        @if($isModalOpen)
            @include('livewire.modal.modal-categories-project')
        @endif
        <button wire:click="openDataModal()" class="bg-blue-500 rounded px-2 py-1 text-base text-white hover:bg-blue-300">
            Create New
        </button>
    </div>
    @if (session()->has('message'))
            <div class="bg-white shadow border-t-4 border-green-500 px-2 py-1 text-black text-sm">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="w-full mt-6">
        <div class="bg-white overflow-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">#</th>
                        <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name Categories Project</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Slug</th>
                        <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @if(count($categories)> 0)
                    @foreach ($categories as $category )
                    <tr>
                        <td class="w-1/3 text-left py-3 px-4">{{ $loop->iteration }}</td>
                        <td class="w-1/3 text-left py-3 px-4">{{ $category->name_categories_project }}</td>
                        <td class="text-left py-3 px-4">
                            {{ $category->slug }}</td>
                        <td class="text-left py-3 px-4">
                        <button class="bg-blue-300 text-black text-sm px-2 py-1 rounded" wire:click="edit({{ $category->id }})">Edit</button>
                        <button class="bg-red-300 text-black text-sm px-2 py-1 rounded" wire:click="trash({{ $category->id }})">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="4" class="text-center font-medium text-sm">Not Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
</div>
