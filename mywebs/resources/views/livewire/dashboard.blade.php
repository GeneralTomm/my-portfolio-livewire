<div class=" max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -4 m-3">

    <div class="flex md:flex-row flex-col justify-center">
        <a href="{{ route('departemen') }}" class="md:w-2/4 bg-green-500 hover:bg-yellow-700 px-3 py-3 m-3 text-white shadow-sm focus:ring-2 rounded flex flex-row justify-between cursor-pointer items-center">
            <div class="flex items-center">
                <span class=" bg-white rounded-md text-black px-2 py-2 font-bold">{{ $departemen->count() }}</span>
                <h3 class="justify-start m-2 text-xl">Departement</h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
        <a href="{{ route('kategoriEvent') }}" class="md:w-2/4 bg-red-500 hover:bg-yellow-700 px-3 py-3 m-3 text-white shadow-sm focus:ring-2 rounded flex flex-row justify-between cursor-pointer items-center">
            <div class="flex items-center">
                <span class=" bg-white rounded-md text-black px-2 py-2 font-bold">{{ $kategori->count() }}</span>
                <h3 class="justify-start m-2 text-xl">Kategori Event</h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
        <a href="{{ route('event') }}" class="md:w-2/4 bg-blue-500 hover:bg-yellow-700 px-3 py-3 m-3 text-white shadow-sm focus:ring-2 rounded flex flex-row justify-between cursor-pointer items-center">
            <div class="flex items-center">
                <span class=" bg-white rounded-md text-black px-2 py-2 font-bold">{{ $event->count() }}</span>
                <h3 class="justify-start m-2 text-xl">Event</h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>

        <a href="{{ route('tim') }}" class="md:w-2/4 bg-yellow-500 hover:bg-yellow-700 px-3 py-3 m-3 text-white shadow-sm focus:ring-2 rounded flex flex-row justify-between cursor-pointer items-center">
            <div class="flex items-center">
                <span class=" bg-white rounded-md text-black px-2 py-2 font-bold">{{ $tim->count() }}</span>
                <h3 class="justify-start m-2 text-xl">Tim</h3>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 cursor-pointer" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
</div>
