<div>
    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            <p class="text-xl pb-6 flex items-center">
                @if (session()->has('message'))
                <div class="bg-white shadow px-2 py-2 my-2 border-t-4 border-yellow-500">
                    <div class="text-black">
                        {{ session('message') }}
                    </div>
                </div>
                @endif
            </p>
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" wire:submit.prevent="SettingsUpdate" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name Website</label>
                        <input class="w-full px-5 py-4 text-gray-700 bg-gray-200 rounded" id="name" wire:model="name_website" type="text"  placeholder="Your Name Website">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Email</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="email" wire:model="email" type="email"  placeholder="Example : example@gmail.com">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Phone</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="phone" wire:model="phone" type="number"  placeholder="Example : 0812xxxxx" min="0">
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Url Facebook</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" wire:model="facebook" type="url"  placeholder="Example : www.example.com" >
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Url LinkedIn</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" wire:model="linkedin" type="url"  placeholder="Example : www.example.com" >
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Url Instagram</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" wire:model="instagram" type="url"  placeholder="Example : www.example.com" >
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Url Tiktok</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" wire:model="tiktok" type="url"  placeholder="Example : www.example.com" >
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Address</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" wire:model="address" type="text"  placeholder="Jalan Anoa 2,Cikarang baru" >
                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="message">Description</label>
                        <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded" id="message" wire:model="description" rows="6"  placeholder="Your inquiry.."></textarea>
                    </div>
                    <div class="mt-2" x-data="{imagesName:null , imagesPreview:null}">
                        <label class=" block text-sm text-gray-600" for="message">Description</label>
                        <input class="hidden"
                        wire:model="images"
                        type="file"
                        x-ref="images"
                        x-on:change="
                                imagesName = $refs.images.files[0].name;
                                const reader = new FileReader();
                                reader.onload = (e) => {
                                    imagesPreview = e.target.result;
                                };
                                reader.readAsDataURL($refs.images.files[0]);
                        " />
                    <div class="mt-2" x-show="! imagesPreview">
                        <img src="{{asset('storage/logo/'.$this->images)}}" class="rounded-full h-20 w-20 object-cover">
                    </div>
                    <div class="mt-2" x-show="imagesPreview">
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                                x-bind:style="'background-image: url(\'' + imagesPreview + '\');'">
                        </span>
                    </div>
                    <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.images.click()">
                        {{ __('Select A New Photo') }}
                    </x-jet-secondary-button>

                    <div class="mt-2">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded text-base" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>

</div>
</div>
</div>
