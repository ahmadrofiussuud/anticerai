<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Anticerai') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="font-sans antialiased text-gray-700 bg-stone-50">
        <div class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
            <!-- Background Decorations -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                 <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-primary-200/20 blur-3xl"></div>
                 <div class="absolute top-[40%] -right-[10%] w-[40%] h-[40%] rounded-full bg-secondary-200/20 blur-3xl"></div>
            </div>

            <div class="relative z-10 text-center max-w-2xl px-6">
                <!-- Branding -->
                <div class="mb-8 flex justify-center">
                   <div class="w-16 h-16 bg-gradient-to-br from-primary-400 to-secondary-400 rounded-2xl flex items-center justify-center shadow-lg text-white text-3xl font-bold">
                       A
                   </div>
                </div>

                <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-gray-900 mb-6">
                    <span class="block">From Anti-Divorce</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-secondary-500">To Pro-Growth</span>
                </h1>
                
                <p class="mt-4 text-xl text-gray-500 mb-10 leading-relaxed">
                    Build a stronger, deeper connection with your partner. 
                    <br class="hidden md:block">Turn challenges into opportunities for intimacy.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-full px-8 py-3 bg-primary-600 text-white font-semibold shadow-md hover:bg-primary-500 transition focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="rounded-full px-8 py-3 bg-white text-gray-700 font-semibold shadow-sm border border-gray-200 hover:bg-gray-50 transition focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                            Log in
                        </a>
                        <a href="{{ route('register') }}" class="rounded-full px-8 py-3 bg-gradient-to-r from-primary-500 to-secondary-500 text-white font-semibold shadow-md hover:opacity-90 transition focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Start Journey
                        </a>
                    @endauth
                </div>
            </div>

            <div class="absolute bottom-6 text-sm text-gray-400">
                &copy; {{ date('Y') }} Anticerai. All rights reserved.
            </div>
        </div>
    </body>
</html>
