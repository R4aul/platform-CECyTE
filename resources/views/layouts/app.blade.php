<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <!--Texto enriquesido-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

       <!--Swet alert 2-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @stack('css')
        
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <!-- Contenedor principal con flexbox -->
        <div class="min-h-screen bg-gray-200 flex">
            <!-- Sidebar -->
            @include('nav-teaching') 

            <!-- Contenido principal -->
            <main class="justify-center w-full">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @stack('js')
        @livewireScripts

    </body>
</html>
