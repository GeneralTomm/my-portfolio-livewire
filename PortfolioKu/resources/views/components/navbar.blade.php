<div>
    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Admin</a>

        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="{{ route('dashboard') }}" class="flex items-center text-white py-4 pl-6 nav-item
            {{ (request()->is('dashboard')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('projects') }}" class="flex items-center text-white py-4 pl-6 nav-item
            {{ (request()->is('projects')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-cog mr-3"></i>
                Projects
            </a>
            <a href="{{ route('categories-project') }}" class="flex items-center text-white py-4 pl-6 nav-item
            {{ (request()->is('categories-project')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-cog mr-3"></i>
                Categories Projects
            </a>
            <a href="{{ route('settings') }}" class="flex items-center text-white py-4 pl-6 nav-item
            {{ (request()->is('settings')) ? 'active-nav-link' : '' }}">
                <i class="fas fa-cog mr-3"></i>
                Settings
            </a>
    </aside>
</div>
