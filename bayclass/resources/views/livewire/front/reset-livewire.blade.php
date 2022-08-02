@section('title' , 'Reset')

<div class="max-w-lg container mx-auto px-5">
    <div class="flex flex-col space-y-3 text-center my-4">
        <a href="/" class="text-3xl uppercase font-bold tracking-widest">BayuPM</a>
        <p class="text-base font-normal">Reset akun mu, agar kamu dapat melihat kelas lainnya jika lupa password.</p>
    </div>
    <div class="bg-white shadow-lg rounded-md p-4">
      <form action="#" method="post">
        <div class="flex flex-col space-y-4">
          <div class="flex flex-col gap-3">
            <label for="Email">Username</label>
            <input type="email" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500" placeholder="Email">
          </div>
          <div class="flex flex-col gap-3">
            <button type="submit" class="bg-zinc-800 hover:bg-zinc-500 text-white py-2 px-5 rounded-md">Reset</button>
          </div>
        </div>
      </form>
    </div>

    <div class="bg-white shadow-lg rounded-md p-4 mt-4">
      <p class="text-center">Sudah punya akun? <a href="{{route('masuk')}}" class="text-zinc-500 hover:text-zinc-700">Masuk</a></p>
    </div>
    <div class="bg-white shadow-lg rounded-md p-4 mt-4">
      <p class="text-center">Belum punya akun? <a href="{{route('daftar')}}" class="text-zinc-500 hover:text-zinc-700">Daftar</a></p>
    </div>
</div>