<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Mes Rendez-vous') }}
            </h2>
            <a href="{{ route('rendezvous.create') }}" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-500 border border-transparent rounded-full font-semibold text-sm text-white hover:from-blue-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Nouveau Rendez-vous
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl relative shadow-sm flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="block sm:inline font-medium">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
                <div class="p-8">
                    @if($rendezvous->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-blue-50 text-blue-300 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Aucun rendez-vous</h3>
                            <p class="text-gray-500 max-w-sm mx-auto">Vous n'avez pas encore de rendez-vous médical planifié. Cliquez sur le bouton en haut à droite pour prendre un rendez-vous.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($rendezvous as $rdv)
                                <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-lg transition-shadow duration-300 relative overflow-hidden group">
                                    <div class="absolute top-0 left-0 w-2 h-full 
                                        {{ $rdv->statut === 'planifié' ? 'bg-yellow-400' : '' }}
                                        {{ $rdv->statut === 'confirmé' ? 'bg-green-400' : '' }}
                                        {{ $rdv->statut === 'terminé' ? 'bg-gray-400' : '' }}
                                        {{ $rdv->statut === 'annulé' ? 'bg-red-400' : '' }}
                                    "></div>
                                    
                                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-6 pl-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                <div class="flex items-center gap-2 text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full text-sm font-bold">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    {{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}
                                                </div>
                                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider
                                                    {{ $rdv->statut === 'planifié' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                    {{ $rdv->statut === 'confirmé' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $rdv->statut === 'terminé' ? 'bg-gray-100 text-gray-800' : '' }}
                                                    {{ $rdv->statut === 'annulé' ? 'bg-red-100 text-red-800' : '' }}
                                                ">
                                                    {{ $rdv->statut }}
                                                </span>
                                            </div>
                                            
                                            <h4 class="text-xl font-extrabold text-gray-900 mt-2">Dr. {{ $rdv->medecin->nom }}</h4>
                                            <p class="text-blue-600 font-medium text-sm">{{ $rdv->medecin->specialite }}</p>
                                            
                                            <div class="mt-4 text-gray-600">
                                                <span class="font-semibold text-gray-800">Motif :</span> {{ $rdv->motif }}
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end gap-3 border-t md:border-t-0 md:border-l border-gray-100 pt-4 md:pt-0 md:pl-6">
                                            @if($rdv->statut !== 'annulé' && $rdv->statut !== 'terminé')
                                                <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="w-full md:w-auto text-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm font-medium">
                                                    Modifier
                                                </a>
                                                <form action="{{ route('rendezvous.destroy', $rdv->id) }}" method="POST" class="w-full md:w-auto" onsubmit="return confirm('Voulez-vous vraiment annuler ce rendez-vous ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full md:w-auto text-center px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition text-sm font-medium">
                                                        Annuler
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                    @if($rdv->reponse_medecin)
                                        <div class="mt-6 ml-4 bg-blue-50/80 rounded-xl p-4 border border-blue-100 flex items-start gap-4">
                                            <div class="bg-white p-2 rounded-full shadow-sm text-blue-500">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-blue-900 mb-1">Message du Dr. {{ $rdv->medecin->nom }} :</p>
                                                <p class="text-sm text-blue-800">{{ $rdv->reponse_medecin }}</p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
