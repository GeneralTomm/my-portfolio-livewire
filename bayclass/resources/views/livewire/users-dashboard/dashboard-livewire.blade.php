<div>
    
    @section('title', 'Dasbor')

    
    <div class="max-w-6xl container mx-auto px-5 mt-2">
        <div class="bg-white p-3 w-full shadow-lg rounded-md">
            <h3 class="text-base font-normal">Selamat datang kembali di dasbor anda, <span class="font-bold">{{ $name
                    }}</span></h3>
        </div>
    </div>
    <section id="section1" class="max-w-6xl container mx-auto my-10 px-5">
        
        <div class="flex gap-4 lg:flex-row flex-col">
            @include('components.components-users.menu-components')
            <div class=" lg:w-3/4 overflow-hidden h-full flex flex-col space-y-5">
                <div class="flex flex-col gap-3">
                    <div class="bg-white shadow-lg p-4 flex gap-3 items-center rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <h4 class="text-black lg:text-xl text-base font-semibold">Halaman Dasbor</h4>
                    </div>
                    <div class="bg-white shadow-lg p-4 flex flex-col gap-3 justify-center items-center rounded-md">
                        <span class="text-base font-normal">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis debitis laudantium doloremque harum deserunt saepe excepturi voluptates. Quos quo ipsa ab. Voluptates quod veritatis totam, sapiente labore nostrum nisi. Sapiente?</span>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</div>