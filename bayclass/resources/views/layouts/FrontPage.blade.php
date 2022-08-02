<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-cache-control" content="no-cache">
    <link rel="icon" href="{{ URL::asset('/favicon/favicon.png') }}" type="image/x-icon"/>
    {{-- <script src="/application-cbd3cd4.js" defer></script> --}}

    <title>@yield('title')</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ken-slider.css') }}">
    <script src="{{mix('js/app.js') }}" defer></script>


    <!-- Scripts -->
    @livewireStyles

</head>

<body class="bg-gray-100 font-quicksand">
    @include('livewire.components.header')
        {{ $slot }}
    @include('components.front.footer-components')
</body>
@livewireScripts

<script src="{{asset('js/ken-slider.js')}}" defer></script>
<script src="{{asset('js/ken-scripts.js')}}" defer></script>
<script src="{{asset('js/scripts.js')}}" defer></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
    data-turbolinks-eval="true" data-turbo-eval="false"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.all.min.js"></script>
<script>
    window.addEventListener('swal',function(e) {
    Swal.fire({
    title: e.detail.title,
    icon: e.detail.icon,
    timer: 3000,
    toast: true,
    position: 'top-right',
    toast: true,
    showConfirmButton: false,
    });
    });
    
</script>

</html>
