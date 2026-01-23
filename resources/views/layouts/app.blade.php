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
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-slate-50">
        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script type="module">
            import mermaid from "https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.esm.min.mjs";
            mermaid.initialize({ 
                startOnLoad: false, 
                theme: 'base',
                themeVariables: {
                    primaryColor: '#4A6741',
                    lineColor: '#C67C5C',
                    tertiaryColor: '#FDFBF7'
                }
            });
            window.mermaid = mermaid;
        </script>
        <script>
            function decodeHtmlEntities(text) {
                var textArea = document.createElement('textarea');
                textArea.innerHTML = text;
                return textArea.value;
            }

            window.renderMarkdown = function(text) {
                if (typeof marked === 'undefined') return text;
                const renderer = new marked.Renderer();
                renderer.code = function({ text, lang }) {
                    if (lang === 'mermaid') {
                        return '<div class="mermaid">' + decodeHtmlEntities(text) + '</div>';
                    }
                    return '<pre><code class="language-' + lang + '">' + text + '</code></pre>';
                };
                return marked.parse(text, { renderer: renderer });
            }
        </script>
        <div class="min-h-screen relative overflow-x-hidden bg-[#FAFAFA]">
             <!-- Subtle Warm Noise/Gradient Overlay -->
            <div class="fixed inset-0 z-[-1] opacity-60 pointer-events-none" style="background: radial-gradient(circle at 0% 0%, #fff1f2 0%, transparent 50%), radial-gradient(circle at 100% 100%, #fffbeb 0%, transparent 50%);"></div>

            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.footer')
        </div>
    </body>
</html>
