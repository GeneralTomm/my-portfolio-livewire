@section('title' , 'Masuk')


<div class="max-w-lg container mx-auto px-5">
        <div class="flex flex-col space-y-3 text-center my-4">
            <a href="/" class="text-3xl font-bold uppercase tracking-widest">BayuPM</a>
            <p class="text-base font-normal">Login terlebih ya sobat coding, agar kamu dapat melihat kelas lainnya.</p>
        </div>
        <div class="bg-white shadow-lg rounded-md p-4">
          <form wire:submit.prevent="masukForm">
            <div class="flex flex-col space-y-4">
              <div class="flex flex-col gap-3">
                <label for="Email">Email</label>
                <input type="email" wire:model.defer="email" autocomplete="off" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Email">
                @error('email')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
              </div>
              <div class="flex flex-col gap-3">
                <label for="Password">Password</label>
                <input type="password" wire:model.defer="password" autocomplete="off" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Password">
              </div>
              <div class="flex flex-col gap-3">
                <button type="submit" class="bg-zinc-800 hover:bg-zinc-500 text-white py-2 px-5 rounded-md">Masuk</button>
              </div>
            </div>
          </form>
        </div>

        <div class="bg-white shadow-lg rounded-md p-4 mt-4">
          <p class="text-center">Belum punya akun? <a href="{{route('daftar')}}" class="text-zinc-500 hover:text-zinc-700">Daftar</a></p>
        </div>
        <div class="bg-white shadow-lg rounded-md p-4 mt-4">
          <p class="text-center">Lupa akun? <a href="{{route('reset')}}" class="text-zinc-500 hover:text-zinc-700">Reset</a></p>
        </div>
    </div>