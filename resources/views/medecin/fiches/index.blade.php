<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dossier Complet : ') }} {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Formulaire Création Fiche -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Ajouter une fiche</h3>
                        <form action="{{ route('medecin.fiches.store', $patient->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Titre de la fiche / Motif</label>
                                <input type="text" name="titre" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Ex: Consultation du...">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Compte-rendu détaillé</label>
                                <textarea name="contenu" rows="6" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Saisir les notes ici..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                                Enregistrer la fiche
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Historique des Fiches & Partage -->
                <div class="lg:col-span-2 space-y-6">
                    @if($fiches->isEmpty())
                        <div class="bg-white rounded-2xl p-8 text-center text-gray-500 border border-gray-100 shadow-sm">
                            <p>Aucune fiche médicale n'existe pour ce patient actuellement.</p>
                        </div>
                    @endif

                    @foreach($fiches as $fiche)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900">{{ $fiche->titre }}</h4>
                                    <p class="text-sm text-gray-500">
                                        Rédigé le {{ $fiche->created_at->format('d/m/Y') }} par <span class="font-semibold text-gray-700">Dr. {{ $fiche->auteur->nom }}</span>
                                    </p>
                                </div>
                                <div class="text-sm">
                                    @if($fiche->medecinsPartages->count() > 0)
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-xs font-semibold">
                                            Partagée avec {{ $fiche->medecinsPartages->count() }} confrère(s)
                                        </span>
                                    @else
                                        <span class="bg-gray-200 text-gray-600 py-1 px-3 rounded-full text-xs font-semibold">
                                            Privée
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="prose max-w-none text-gray-800 font-mono text-sm whitespace-pre-wrap">{{ $fiche->contenu }}</div>
                            </div>

                            <!-- Section Partage (Visible uniquement par l'auteur) -->
                            @if($fiche->medecin_id === auth()->user()->medecin->id && count($autresMedecins) > 0)
                                <div class="bg-indigo-50 px-6 py-4 border-t border-indigo-100">
                                    <form action="{{ route('medecin.fiches.partager', $fiche->id) }}" method="POST" class="flex items-center gap-4">
                                        @csrf
                                        <label class="text-sm font-semibold text-indigo-800 whitespace-nowrap">Partager avec :</label>
                                        <select name="medecin_id" class="flex-1 rounded-md border-indigo-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                            @foreach($autresMedecins as $m)
                                                @if(!$fiche->medecinsPartages->contains($m->id))
                                                    <option value="{{ $m->id }}">Dr. {{ $m->nom }} ({{ $m->specialite }})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-1.5 px-4 rounded-md text-sm font-medium shadow-sm transition">
                                            Partager
                                        </button>
                                    </form>
                                    @if($fiche->medecinsPartages->count() > 0)
                                        <div class="mt-3 text-xs text-indigo-700">
                                            Déjà partagée avec : 
                                            @foreach($fiche->medecinsPartages as $mp)
                                                <span class="font-bold mr-2">Dr. {{ $mp->nom }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endif

                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
