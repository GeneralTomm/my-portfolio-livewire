<div>
    <h1 class="w-full text-3xl text-black pb-6">
        @section('title', 'Settings')
    </h1>

    <div class="flex flex-wrap">
        <div class="w-full my-6 pr-0 lg:pr-2">
            @if (session()->has('message'))
            <div class="bg-green-500 px-2 py-2 border-t-2 border-red-200 text-sm text-black">
                {{ session('message') }}
            </div>
            @endif
            <div class="leading-loose">
                <form class="p-10 bg-white rounded shadow-xl" wire:submit.prevent="updateSettings" method="POST">
                    @csrf
                    <div class="">
                        <label class="block text-sm text-gray-600" for="name">Name Website</label>
                        <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded"
                        wire:model="name_website"
                        type="text"
                        placeholder="Name Website">
                        @error('name_website') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600" for="email">Email</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded"
                        wire:model="email" type="email"
                        placeholder="Your Email">
                        @error('email') <span class="error">{{ $message }}</span> @enderror

                    </div>
                    <div class="mt-2">
                        <label class=" block text-sm text-gray-600" for="message">Description</label>
                        <textarea class="w-full px-5 py-2 text-gray-700 bg-gray-200 rounded"
                        wire:model="description"
                        rows="3"
                        placeholder="Your Description..">
                        </textarea>
                        @error('description') <span class="error">{{ $message }}</span> @enderror

                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600">Phone</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded"
                        wire:model="phone" type="number"
                        placeholder="Phone Number">
                        @error('phone') <span class="error">{{ $message }}</span> @enderror

                    </div>
                    <div class="mt-2">
                        <label class="block text-sm text-gray-600">Address</label>
                        <input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded"
                        wire:model="address" type="text"
                        placeholder="Address">
                        @error('address') <span class="error">{{ $message }}</span> @enderror

                    </div>
                    <div class="mt-6">
                        <button class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
</div>
