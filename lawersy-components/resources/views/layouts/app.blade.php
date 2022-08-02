<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="smooth-scrolling">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="turbolinks-root" content="/app">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <script src="{{ mix('js/app.js') }}" defer></script>


        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
        <link rel="stylesheet" href="{{asset('css/prism.css')}}">
        <link rel="stylesheet" href="{{asset('css/font-quicksand.css')}}">

        @livewireStyles
    </head>
    <body class="antialiased body-class" x-data="{sidebar: false}">
        @include('components.backend.header')

        <div class=" lg:flex" x-data="{side: 'introduction' ,
            aktif : 'menu text-white active-menu',
            tidak : 'menu hover-active-menu'}">
            <div :class="{'translate-x-0 ease-in-out opacity-100 ' : sidebar === true, '-translate-x-full w-full opacity-0 ease-out' : sidebar === false}"
                @show="sidebar === !sidebar" class="bg-white shadow-sm p-4 w-52 overflow-hidden fixed h-screen overflow-y-auto
                inset-0 transform lg:transform-none lg:opacity-100 dark:bg-gray-800
                duration-200 flex-none lg:static">
                @include('components.backend.sidebar')
            </div>
            <main class="main-class">
                <div class="flex flex-col">
                    {{$slot}}
                </div>

            </main>
        </div>


    @livewireScripts


    </body>

    <script>
    document.getElementById('buttondark').addEventListener('click', function() {
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
     {{-- <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
</html>
