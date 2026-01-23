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
    <body class="font-sans antialiased text-primary-800 bg-secondary-50">
        <div class="min-h-screen flex flex-col items-center justify-center relative overflow-hidden">
            <!-- Background Decorations -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none">
                 <!-- Subtle gradients matching the dashboard's "warm noise/gradient overlay" -->
                 <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-primary-200/20 blur-[100px] animate-float"></div>
                 <div class="absolute top-[40%] -right-[10%] w-[50%] h-[50%] rounded-full bg-secondary-200/40 blur-[100px] animate-float-delayed"></div>
            </div>

            <div class="relative z-10 text-center max-w-2xl px-6">
                <!-- Branding -->
                <div class="mb-8 flex justify-center">
                    <img src="{{ asset('images/logo_transparent.png') }}" alt="Amora Logo" class="h-24 w-auto drop-shadow-xl" />
                </div>

                <h1 class="text-5xl md:text-7xl font-bold tracking-tight text-primary-800 mb-6 font-display">
                    <span class="block mb-2">Dari Amora</span>
                    <span class="block text-primary-600">Menuju Pro-Tumbuh</span>
                </h1>
                
                <p class="mt-4 text-xl text-primary-400 mb-10 leading-relaxed font-sans max-w-lg mx-auto font-medium">
                    Bangun hubungan yang lebih kuat dan bermakna.
                    <br class="hidden md:block">Ubah tantangan menjadi peluang untuk intimasi.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-full px-8 py-3.5 bg-primary-700 text-white font-semibold shadow-xl shadow-primary-900/10 hover:bg-primary-800 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Ke Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="w-full sm:w-auto rounded-full px-8 py-3.5 bg-white text-primary-800 font-semibold shadow-sm border border-secondary-300 hover:bg-secondary-50 transition-all focus:outline-none focus:ring-2 focus:ring-secondary-400 focus:ring-offset-2">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="w-full sm:w-auto rounded-full px-8 py-3.5 bg-primary-700 text-white font-semibold shadow-xl shadow-primary-900/10 hover:bg-primary-800 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                            Mulai Perjalanan
                        </a>
                    @endauth
                </div>
            </div>

            <div class="absolute bottom-6 text-sm text-primary-400 font-sans">
                &copy; {{ date('Y') }} Amora. Seluruh hak cipta dilindungi.
            </div>
        </div>
    </body>
</html>
