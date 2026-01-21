<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-stone-700 antialiased bg-stone-50">
        <div class="min-h-screen flex flex-col pt-6 sm:pt-0 relative overflow-hidden">
             <!-- Background Blob -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10 pointer-events-none">
                <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-primary-100/50 blur-[120px]"></div>
                <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-secondary-100/50 blur-[120px]"></div>
            </div>

            <div class="flex-1 flex flex-col sm:justify-center items-center w-full">
                <div class="mb-4">
                    <a href="/" wire:navigate class="flex flex-col items-center group">
                        <x-application-logo class="w-20 h-20 fill-current text-primary-500 group-hover:scale-110 transition-transform duration-300" />
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-secondary-500 mt-2">Amora</span>
                    </a>
                </div>

                <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/70 backdrop-blur-xl shadow-glass border border-white/50 overflow-hidden sm:rounded-[2rem] transition-all hover:shadow-soft">
                    {{ $slot }}
                </div>
            </div>
            
            @include('layouts.footer')
        </div>
    </body>
</html>
