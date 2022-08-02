<div>
    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                @if (session()->has('message'))
                <div class="bg-white shadow px-2 py-2 my-2 border-t-4 border-green-500">
                    <div class="text-black">
                        {{ session('message') }}
                    </div>
                </div>
                @endif
            </p>
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" wire:submit.prevent="AboutPage">
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Short Title</label>
                        <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="name" wire:model="short_title" type="text"  placeholder="Why About Me?">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Title Page</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" wire:model="title" type="text"  placeholder="About Me">
                    </div>
                    <div class="mt-2" wire:model.debounce.10000ms="description" wire:ignore>
                        <label class="block text-sm text-gray-600" for="email">Description</label>
                        <div class="body-content">
                            <input id="description" value="{{ $description }}" type="hidden" name="description">
                            <trix-editor input="description">
                            </trix-editor>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

</div>
</div>
</div>
