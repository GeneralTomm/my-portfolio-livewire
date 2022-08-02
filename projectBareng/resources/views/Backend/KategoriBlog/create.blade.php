<x-app-layout>

    <div class="my-4">
        <a href="{{route('kategori-blogs.index')}}" class="bg-blue-500 px-5 py-2 rounded-md text-white">Kembali</a>
    </div>

    <div class="bg-white shadow-sm p-4 rounded-md">
        <h2 class="text-2xl font-bold">Tambah Kategori Baru</h2>
        <form action="{{route('kategori-blogs.store')}}" method="POST" class="my-5">
            @csrf
            <div class="flex flex-col gap-2 mt-4">
                <label for="nama_kategori">Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-input rounded-md px-4">
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <label for="nama_kategori">Hexa Colors</label>
                <input type="text" name="hexa_colors" class="form-input rounded-md px-4">
            </div>
            <div class="flex flex-col gap-2 mt-4">
                <label for="nama_kategori"> Status</label>
                <select name="status" class="rounded-md px-4">
                    <option value="">Pilih Status</option>
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
                </select>
            </div>
            <div class="flex mt-4">
                <button class="bg-green-500 px-5 py-2 text-white rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
