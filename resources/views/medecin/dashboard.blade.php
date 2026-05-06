<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900 tracking-tight">
                {{ __('Agenda - Dr.') }} <span class="text-indigo-600">{{ $medecin->nom }}</span>
            </h2>
            <a href="{{ route('medecin.horaires') }}" class="inline-flex items-center justify-center px-6 py-2.5 border border-transparent text-sm font-semibold rounded-full text-indigo-700 bg-indigo-50 hover:bg-indigo-100 hover:text-indigo-800 transition-all duration-200 shadow-sm hover:shadow">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Gérer mes horaires
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

            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/40 sm:rounded-3xl border border-gray-100">
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-8 border-b border-gray-100 pb-4">
                        <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Mes consultations à venir</h3>
                    </div>

                    @if($rendezvous->isEmpty())
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Agenda vide</h3>
                            <p class="text-gray-500 max-w-sm mx-auto">Vous n'avez aucun rendez-vous planifié pour le moment.</p>
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($rendezvous as $rdv)
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300">
                                    <div class="flex flex-col md:flex-row justify-between md:items-start gap-4 mb-6">
                                        <div class="flex gap-4">
                                            <!-- Date Badge -->
                                            <div class="flex flex-col items-center justify-center bg-indigo-50 rounded-xl px-4 py-2 border border-indigo-100 min-w-[80px]">
                                                <span class="text-indigo-900 font-bold text-lg">{{ \Carbon\Carbon::parse($rdv->date)->format('d') }}</span>
                                                <span class="text-indigo-600 font-semibold text-xs uppercase">{{ \Carbon\Carbon::parse($rdv->date)->format('M') }}</span>
                                                <span class="text-indigo-800 font-bold text-sm mt-1">{{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</span>
                                            </div>
                                            
                                            <!-- Patient Info -->
                                            <div>
                                                <h4 class="text-xl font-bold text-gray-900 mb-1">
                                                    {{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}
                                                </h4>
                                                <p class="text-gray-600 text-sm mb-2"><span class="font-semibold text-gray-800">Motif :</span> {{ $rdv->motif }}</p>
                                                
                                                <div class="flex gap-3 mt-3">
                                                    <a href="{{ route('medecin.dossier.index', $rdv->patient->id) }}" class="inline-flex items-center text-indigo-600 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg text-sm font-semibold transition">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                        Dossier Médical
                                                    </a>
                                                    <a href="{{ route('chat.show', $rdv->patient->user_id) }}" class="inline-flex items-center text-blue-600 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-sm font-semibold transition">
                                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                                        Chatter
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col items-end gap-2">
                                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider
                                                {{ $rdv->statut === 'planifié' ? 'bg-yellow-100 text-yellow-800 border border-yellow-200' : '' }}
                                                {{ $rdv->statut === 'confirmé' ? 'bg-green-100 text-green-800 border border-green-200' : '' }}
                                                {{ $rdv->statut === 'terminé' ? 'bg-gray-100 text-gray-800 border border-gray-200' : '' }}
                                                {{ $rdv->statut === 'annulé' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}
                                            ">
                                                {{ $rdv->statut }}
                                            </span>
                                        </div>
                                    </div>

                                    @if($rdv->message_patient)
                                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mb-4 text-sm flex gap-3">
                                            <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                            <div>
                                                <p class="text-gray-900 font-semibold mb-0.5">Note du patient :</p>
                                                <p class="text-gray-600 italic">"{{ $rdv->message_patient }}"</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Formulaire de réponse / statut -->
                                    <form action="{{ route('medecin.rdv.reponse', $rdv->id) }}" method="POST" class="mt-4 bg-gray-50/50 p-4 rounded-xl border border-gray-100">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Réponse / Consigne (Optionnel)</label>
                                                <input type="text" name="reponse_medecin" value="{{ $rdv->reponse_medecin }}" placeholder="Ex: Veuillez apporter vos dernières analyses..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Statut du RDV</label>
                                                <select name="statut" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm font-medium">
                                                    <option value="planifié" {{ $rdv->statut == 'planifié' ? 'selected' : '' }}>Planifié</option>
                                                    <option value="confirmé" {{ $rdv->statut == 'confirmé' ? 'selected' : '' }}>Confirmé</option>
                                                    <option value="terminé" {{ $rdv->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
                                                    <option value="annulé" {{ $rdv->statut == 'annulé' ? 'selected' : '' }}>Annulé</option>
                                                </select>
                                            </div>
                                            <div>
                                                <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white text-sm font-bold py-2.5 px-4 rounded-lg shadow-md transition transform hover:-translate-y-0.5">
                                                    Mettre à jour
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
