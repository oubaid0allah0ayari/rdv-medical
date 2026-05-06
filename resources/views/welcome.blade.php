<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'RDV Medical') }} - Votre santé, simplifiée</title>

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
        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #0ea5e9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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
<body class="antialiased bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass-panel shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-3 cursor-pointer transition transform hover:scale-105 duration-300">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-gray-900">Medi<span class="text-blue-600">Connect</span></span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out">Mon Espace</a>
                        @else
                            <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-blue-600 transition duration-150 ease-in-out">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">
                                    S'inscrire
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-bg min-h-screen flex items-center pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-50 text-blue-700 font-medium text-sm mb-6 border border-blue-100 shadow-sm">
                        <span class="flex h-2 w-2 rounded-full bg-blue-500"></span>
                        Plateforme médicale nouvelle génération
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight text-gray-900 mb-6">
                        Prenez soin de votre santé en <span class="gradient-text">un clic.</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Trouvez le bon spécialiste, prenez rendez-vous instantanément et gérez votre parcours de soins depuis une plateforme unique et sécurisée.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 shadow-xl hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all duration-300">
                                    Accéder au tableau de bord
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-xl hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all duration-300">
                                    Créer un compte
                                </a>
                                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-4 text-base font-semibold rounded-full text-gray-700 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 shadow-sm transform hover:-translate-y-1 transition-all duration-300">
                                    Se connecter
                                </a>
                            @endauth
                        @endif
                    </div>
                </div>

                <!-- Features Grid (Glassmorphism) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 relative">
                    <div class="glass-panel p-6 rounded-2xl shadow-xl transform transition-transform hover:-translate-y-2 duration-300">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Disponibilité 24/7</h3>
                        <p class="text-gray-600">Réservez vos consultations à tout moment, de jour comme de nuit.</p>
                    </div>
                    
                    <div class="glass-panel p-6 rounded-2xl shadow-xl transform transition-transform hover:-translate-y-2 duration-300 sm:mt-12">
                        <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Médecins Qualifiés</h3>
                        <p class="text-gray-600">Accédez aux profils complets et aux spécialités de nos praticiens.</p>
                    </div>

                    <div class="glass-panel p-6 rounded-2xl shadow-xl transform transition-transform hover:-translate-y-2 duration-300">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Sécurité des données</h3>
                        <p class="text-gray-600">Vos informations médicales sont cryptées et strictement confidentielles.</p>
                    </div>
                    
                    <div class="glass-panel p-6 rounded-2xl shadow-xl transform transition-transform hover:-translate-y-2 duration-300 sm:mt-12">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Rappels SMS/Email</h3>
                        <p class="text-gray-600">Ne manquez jamais une consultation grâce à nos notifications.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
