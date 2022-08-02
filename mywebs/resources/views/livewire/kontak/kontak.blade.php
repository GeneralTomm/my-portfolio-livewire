<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">

    <div class="flex">
        <div class="mt-5 md:mt-0 md:col-span-2 w-full">
            <div class="bg-white shadow-md px-2 py-2 my-2">
                <div class="flex justify-end w-auto mt-5 px-5">
                    <input wire:model="search" type="search"
                        class="appearance-none block bg-white text-gray-700 border border-gray-200 rounded mx-2 py-1 px-2 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"" placeholder="
                        Cari Data">
                </div>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-10 mx-auto">
                        <div class="w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr class="text-center ">
                                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Nama</th>

                                        <th
                                            class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                            Deskripsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kontak as $kt)
                                        <tr class="text-center">

                                            <td class="px-2 py-3 text-sm">{{ $kt->nama }}</td>

                                            <td class="px-2 py-3 text-sm font-medium w-4/5">
                                                {{ $kt->pesan }}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            {{ $kontak->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

</div>
</div>
