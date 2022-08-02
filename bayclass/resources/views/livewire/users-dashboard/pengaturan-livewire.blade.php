
<div>
    @section('title', 'Pengaturan')
    <section id="section1" class="max-w-6xl container mx-auto my-10 px-5">
        
        <div class="flex gap-4 lg:flex-row flex-col">
            @include('components.components-users.menu-components')
            <div class=" lg:w-3/4 overflow-hidden h-full flex flex-col space-y-5">
                <div class="flex flex-col gap-3">
                    <div class="bg-white shadow-lg p-4 flex gap-3 items-center rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <h4 class="text-black lg:text-xl text-base font-semibold">Halaman Pengaturan</h4>
                    </div>
                    <div class="flex gap-3">
                        <div class="lg:w-1/4 w-full h-full space-y-2">
                            <div class="bg-white p-3 h-full rounded-md shadow-lg  flex flex-col items-center  justify-center">
                                <img src="https://minimaltoolkit.com/images/randomdata/female/39.jpg" alt="Users" class="w-32 h-32 rounded-full">
                            </div>
                            <div class="bg-white p-3 h-full rounded-md shadow-lg  flex flex-col items-center  justify-center">
                                <span class="font-semibold text-base">{{ $name }}</span>
                            </div>
                            <div class="bg-white p-3 h-full rounded-md shadow-lg  flex flex-col items-center  justify-center">
                                <span class="font-semibold text-base">{{ $nomor_hp }}</span>
                            </div>
                            <div class="bg-white p-3 h-full rounded-md shadow-lg  flex flex-col items-center  justify-center">
                                <span class="font-semibold text-base">{{ $email }}</span>
                            </div>
                        </div>
                        <div class="bg-white p-3 rounded-md shadow-lg w-full lg:w-3/4">
                            <form wire:submit.prevent="perbaharuiUsers">
                                <div class="flex flex-col space-y-4">
                                    <div class="flex flex-col gap-3">
                                        <label for="Username">Username</label>
                                        <input type="text" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500"
                                            placeholder=" Username" wire:model.defer="name" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <label for="Email">Email</label>
                                        <input type="email" class="w-full border-2 border-zinc-500 bg-slate-200 rounded-md p-2 text-zinc-500"
                                            placeholder=" Email" value="{{ Auth::user()->email }}" readonly disabled>
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <label for="Hp">Nomor Handphone</label>
                                        <input type="text" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500"
                                            placeholder="Nomor Handphone" wire:model.defer="nomor_hp" value="{{ Auth::user()->nomor_hp }}">
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <label for="Password">Password Baru</label>
                                        <input type="password" class="w-full border-2 border-zinc-500 rounded-md p-2 text-zinc-500"
                                            placeholder="Password" wire:model.defer="password">
                                    </div>
                                    <div class="flex flex-col gap-3">
                                        <button type="submit" class="bg-zinc-800 hover:bg-zinc-500 text-white py-2 px-5 rounded-md">Perbaharui Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
</div>