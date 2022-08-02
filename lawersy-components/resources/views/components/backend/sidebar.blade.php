<div class="flex flex-col">
    <div class="grids">
        <a href="{{route('dashboard')}}" :class="{{ request()->is('dashboard') ? 'aktif' : 'tidak' }}"> Dashboard</a>
        <div x-data="{menu: false}">
            <button class="flex justify-between items-center" @click="menu = !menu" :class="{{ request()->is('menu*', 'sub-menu*') ? 'aktif' : 'tidak' }}">
                Master Menu
                <svg xmlns="http://www.w3.org/2000/svg" :class="{'rotate-180' : menu}" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div class="grids-1" x-show="menu">
                <a href="{{route('menu')}}" class="menu {{request()->is('menu*') ? 'active-menu' : 'hover-active-menu'}}"> All Menu</a>
                <a href="{{route('submenu')}}" class="menu {{request()->is('sub-menu*') ? 'active-menu' : 'hover-active-menu'}}"> Sub Menu</a>
            </div>
        </div>
    </div>
</div>


