<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RDV Médical') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Inter', sans-serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .hero-bg {
                background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
                position: relative;
                overflow: hidden;
            }
            .hero-bg::before {
                content: '';
                position: absolute;
                top: -10%; left: -10%; width: 50%; height: 50%;
                background: radial-gradient(circle, rgba(56,189,248,0.3) 0%, rgba(255,255,255,0) 70%);
                z-index: 0;
                border-radius: 50%;
                animation: pulse 8s infinite alternate;
            }
            @keyframes pulse {
                0% { transform: scale(1) translate(0, 0); }
                100% { transform: scale(1.1) translate(20px, 20px); }
            }
        </style>
    </head>
    <body class="antialiased text-gray-800 hero-bg min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <div class="z-10 mt-8">
            <a href="/" class="flex items-center gap-3 cursor-pointer transition transform hover:scale-105 duration-300">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <span class="font-bold text-4xl tracking-tight text-gray-900">Medi<span class="text-blue-600">Connect</span></span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-10 px-8 py-10 glass-panel shadow-2xl overflow-hidden sm:rounded-3xl z-10">
            {{ $slot }}
        </div>
        
        <p class="mt-8 text-sm text-gray-500 font-medium z-10 pb-8">© {{ date('Y') }} MediConnect. Tous droits réservés.</p>

    </body>
</html>
