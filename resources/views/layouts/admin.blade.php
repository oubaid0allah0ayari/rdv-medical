<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administration</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 flex h-screen overflow-hidden selection:bg-indigo-500 selection:text-white">

    <!-- Sidebar (Panneau de gauche stylisé) -->
    <aside class="w-72 bg-slate-900 flex flex-col shadow-2xl relative z-20">
        <!-- En-tête Sidebar -->
        <div class="h-20 flex items-center px-8 bg-slate-950 border-b border-slate-800">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg mr-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
            <h1 class="text-white text-xl font-bold tracking-tight">Admin<span class="text-indigo-400">Panel</span></h1>
        </div>

        <!-- Menu de Navigation -->
        <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
            <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mb-4">Général</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="font-medium text-sm">Vue d'ensemble</span>
            </a>

            <a href="{{ route('medecins.index') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('medecins.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-900/50' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('medecins.*') ? 'text-white' : 'text-slate-400 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="font-medium text-sm">Gestion des Médecins</span>
            </a>
        </nav>

        <!-- Profil Admin (Bas) -->
        <div class="p-4 bg-slate-950 border-t border-slate-800">
            <div class="flex items-center px-4 py-3">
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-white font-bold text-xs mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">Administrateur</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2.5 text-sm font-semibold text-rose-400 hover:text-white hover:bg-rose-500 rounded-lg transition duration-200 group">
                    <svg class="w-4 h-4 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- Contenu Principal -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-slate-50 relative">
        <!-- Topbar simple -->
        <header class="h-20 bg-white/80 backdrop-blur-md shadow-sm flex items-center justify-between px-8 z-10 sticky top-0">
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">@yield('header_title', 'Administration')</h2>
            <div class="flex items-center gap-4">
                <span class="bg-indigo-50 text-indigo-700 px-4 py-1.5 rounded-full text-sm font-bold shadow-sm">
                    {{ date('d M Y') }}
                </span>
            </div>
        </header>

        <!-- Scrollable Content -->
        <div class="flex-1 overflow-y-auto p-8 relative">
            @if(session('success'))
                <div class="mb-8 bg-teal-50 border border-teal-200 text-teal-800 px-6 py-4 rounded-2xl shadow-sm flex items-start gap-3 relative">
                    <svg class="w-6 h-6 text-teal-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-medium leading-relaxed">{!! nl2br(e(session('success'))) !!}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-8 bg-rose-50 border border-rose-200 text-rose-800 px-6 py-4 rounded-2xl shadow-sm flex items-center gap-3 relative">
                    <svg class="w-6 h-6 text-rose-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-medium">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
