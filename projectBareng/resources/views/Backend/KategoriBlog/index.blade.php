<x-app-layout>

    @if(session()->has('success'))
        <div class="bg-white shadow-sm p-2 rounded-md text-black">
            <span class="text-base">{{ session()->get('success') }}</span>
        </div>
    @endif

    <div class="my-4">
        <a href="{{route('kategori-blogs.create')}}" class="bg-blue-500 px-5 py-2 rounded-md text-white">Tambah Data</a>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden ">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    #
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Nama Kategori
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Warna Kategori
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                           @forelse ($kategoriBlogs as $kategori)
                               <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                       {{$loop->iteration}}</td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">
                                        {{$kategori['nama_kategori']}}</td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <span class="p-3 bg-[{{$kategori['hexa_colors']}}]">{{$kategori['hexa_colors']}}</span></td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if($kategori['status'] == 1)
                                            <span class="bg-green-200 p-2 text-white rounded-md">Aktif</span>
                                            @else
                                            <span class="bg-red-200 p-2 text-white rounded-md">Tidak</span>
                                        @endif
                                    </td>
                                    <td class="py-4 flex gap-3 items-center w-24 ">
                                        <a href="" class="bg-yellow-500 px-5 py-1 rounded-md text-white">Ubah</a>
                                        <a href="" class="bg-red-500 px-5 py-1 rounded-md text-white">Hapus</a>
                                    </td>
                                </tr>
                           @empty
                               <tr class="text-center">
                                   <td colspan="4" class="py-3">Tidak ada</td>
                               </tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
