<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <form method="POST" wire:submit.prevent="createData">
            <div class="mt-4">
                <label for="name" class="text-base font-semibold">Sub Menu</label>
                <input wire:model="nama_sub_menu" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
            </div>
            <div class="mt-4">
                <label for="name" class="text-base font-semibold">Choose Menu</label>
                <select wire:model="menu_id" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option value="">Choose Menu</option>
                    @foreach ($menu as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>

             <div class=" mt-4">
                <button type="submit" class="bg-blue-900 px-5 py-2 text-white rounded-md">Save</button>
                <button type="button" wire:click.prevent="closeModal" class="bg-red-900 px-5 py-2 text-white rounded-md">Cancel</button>
            </div>
        </form>
      </div>

    </div>
  </div>
</div>
