<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Mon Espace Patient') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl shadow-lg mb-8 p-8 text-white transform transition-transform hover:scale-[1.01] duration-300">
                <div class="flex items-center gap-6">
                    <div class="bg-white/20 p-4 rounded-full backdrop-blur-sm">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-1">Bonjour, {{ Auth::user()->name }} !</h3>
                        <p class="text-blue-100 text-lg">Bienvenue sur votre portail médical. Comment allez-vous aujourd'hui ?</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Action Card 1 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Prendre un rendez-vous</h4>
                        <p class="text-gray-500 mb-6">Consultez les disponibilités de nos médecins et réservez le créneau qui vous convient.</p>
                        <a href="{{ route('rendezvous.create') }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-blue-600 border border-transparent rounded-xl font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Nouveau Rendez-vous
                        </a>
                    </div>
                </div>

                <!-- Action Card 2 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Mon Historique</h4>
                        <p class="text-gray-500 mb-6">Consultez vos rendez-vous à venir et l'historique de vos consultations passées.</p>
                        <a href="{{ route('rendezvous.index') }}" class="inline-flex items-center justify-center w-full px-4 py-3 bg-white border-2 border-indigo-100 text-indigo-600 rounded-xl font-semibold hover:bg-indigo-50 hover:border-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Voir mes rendez-vous
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
