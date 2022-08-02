@section('title' , 'Daftar')

<div class="max-w-lg container mx-auto px-5 py-10">
    <div class="flex flex-col space-y-3 text-center my-4">
        <a href="/" class="text-3xl uppercase font-bold tracking-widest">BayuPM</a>
        <p class="text-base font-normal">Daftar terlebih ya sobat coding, agar kamu dapat melihat kelas lainnya.</p>
    </div>
    <div class="bg-white shadow-lg rounded-md p-4">
        @if (session()->has('message'))
            <div class="bg-green-500 p-2 text-white">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="daftarUsers">
        <div class="flex flex-col space-y-4">
            <div class="flex flex-col gap-3">
            <label for="Username"> Username</label>
            <input type="text" wire:model.defer="name" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Username">
            @error('name')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            </div>
            <div class="flex flex-col gap-3">
            <label for="Email">Email</label>
            <input type="email" wire:model.defer="email" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Email">
            @error('email')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            </div>
            <div class="flex flex-col gap-3">
            <label for="Hp">Nomor Handphone</label>
            <input type="tel" wire:model.defer="nomor_hp" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Nomor Handphone">
            <span class="text-xs font-extralight">Contoh: 08123456789</span>
            @error('nomor_hp')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            </div>
            <div class="flex flex-col gap-3">
            <label for="Password">Password</label>
            <input type="password" wire:model.defer="password" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Password">
            @error('password')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            </div>
            <div class="flex flex-col gap-3">
            <label for="Konfirmasi Password">Konfirmasi Password</label>
            <input type="password" wire:model.defer="password_confirmation" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Konfirmasi Password">
            @error('password_confirmation')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
            @enderror
            </div>
            <div class="flex flex-col gap-3">
            <button type="submit" class="bg-zinc-800 hover:bg-zinc-500 text-white py-2 px-5 rounded-md">Daftar</button>
            </div>
        </div>
        </form>
    </div>

    <div class="bg-white shadow-lg rounded-md p-4 mt-4">
        <p class="text-center">Sudah punya akun? <a href="{{route('masuk')}}" class="text-zinc-500 hover:text-zinc-700">Masuk</a></p>
    </div>
    <div class="bg-white shadow-lg rounded-md p-4 mt-4">
        <p class="text-center">Lupa akun? <a href="{{route('reset')}}" class="text-zinc-500 hover:text-zinc-700">Reset</a></p>
    </div>
</div>