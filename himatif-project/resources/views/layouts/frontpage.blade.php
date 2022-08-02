<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @livewireStyles
</head>

<body>
    <div class="font-sans bg-gray-100 antialiased">
        <x-navbar></x-navbar>
        {{ $slot }}
    </div>
    <x-footer></x-footer>

    @livewireScripts
</body>
<script src="{{ mix('js/app.js') }}" defer></script>
{{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script> --}}
<script>
    document.getElementById('switchTheme').addEventListener('click', function() {
        let htmlClasses = document.querySelector('html').classList;
        if(localStorage.theme == 'dark') {
        htmlClasses.remove('dark');
        localStorage.removeItem('theme')
        } else {
        htmlClasses.add('dark');
        localStorage.theme = 'dark';
        }
        });

        if (localStorage.theme === 'dark' || (!'theme' in localStorage && window.matchMedia('(prefers-color-scheme:dark)').matches)) {
        document.querySelector('html').classList.add('dark')
        } else if (localStorage.theme === 'dark') {
        document.querySelector('html').classList.add('dark')
        }

</script>
</html>
