<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('medecin.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-gray-900 tracking-tight">
                {{ __('Dossier Patient') }}
            </h2>
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

            <!-- En-tête Patient -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-8 flex items-center gap-6">
                <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-2xl flex items-center justify-center text-3xl font-bold shadow-lg">
                    {{ substr($patient->nom, 0, 1) }}{{ substr($patient->prenom, 0, 1) }}
                </div>
                <div class="flex-1">
                    <h3 class="text-3xl font-extrabold text-gray-900 mb-1">{{ $patient->nom }} {{ $patient->prenom }}</h3>
                    <p class="text-gray-500 font-medium">
                        <span class="mr-4"><i class="text-indigo-400 mr-1">📞</i> {{ $patient->telephone }}</span>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Infos Fixes du Patient -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 sticky top-24">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-blue-50 p-2 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Constantes & Infos</h3>
                        </div>

                        <form action="{{ route('medecin.dossier.update', $patient->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="grid grid-cols-2 gap-4 mb-5">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Taille (cm)</label>
                                    <input type="number" name="taille" value="{{ old('taille', $patient->taille) }}" class="w-full bg-transparent border-0 border-b-2 border-gray-200 focus:border-indigo-500 focus:ring-0 px-0 text-lg font-bold text-gray-900">
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Poids (kg)</label>
                                    <input type="number" step="0.1" name="poids" value="{{ old('poids', $patient->poids) }}" class="w-full bg-transparent border-0 border-b-2 border-gray-200 focus:border-indigo-500 focus:ring-0 px-0 text-lg font-bold text-gray-900">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Maladies Chroniques</label>
                                <textarea name="maladies_chroniques" rows="2" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-medium" placeholder="Diabète, Hypertension...">{{ old('maladies_chroniques', $patient->maladies_chroniques) }}</textarea>
                            </div>

                            <div class="mb-6">
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Allergies Connues</label>
                                <textarea name="allergies" rows="2" class="w-full rounded-xl border-red-100 bg-red-50 focus:border-red-500 focus:ring-red-500 text-sm font-medium text-red-900" placeholder="Pénicilline, Arachides...">{{ old('allergies', $patient->allergies) }}</textarea>
                            </div>

                            <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-3 px-4 rounded-xl shadow-md transition">
                                Mettre à jour les infos
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Historique des Remarques -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Ajouter une Remarque -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-3xl shadow-md p-1">
                        <div class="bg-white rounded-[22px] p-6">
                            <h4 class="font-bold text-indigo-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Nouvelle observation clinique
                            </h4>
                            <form action="{{ route('medecin.dossier.remarque', $patient->id) }}" method="POST">
                                @csrf
                                <textarea name="contenu" rows="4" class="w-full rounded-xl border-gray-200 bg-gray-50 focus:border-indigo-500 focus:ring-indigo-500 mb-4 text-sm font-medium placeholder-gray-400" required placeholder="Saisissez le compte-rendu de la consultation ici..."></textarea>
                                <div class="flex justify-end">
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-6 rounded-xl shadow-md transition transform hover:-translate-y-0.5">
                                        Ajouter au dossier
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-10 mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">Historique des consultations</h3>
                        <span class="bg-gray-200 text-gray-700 py-1 px-3 rounded-full text-sm font-bold">{{ $remarques->count() }}</span>
                    </div>

                    @if($remarques->isEmpty())
                        <div class="bg-white rounded-3xl p-12 text-center text-gray-400 border border-gray-100 shadow-sm">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="text-lg font-medium">Le dossier médical est vierge.</p>
                        </div>
                    @endif

                    <!-- Liste des Remarques (Timeline style) -->
                    <div class="space-y-6 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-200 before:to-transparent">
                        @foreach($remarques as $remarque)
                            <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-indigo-100 text-indigo-600 shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 font-bold text-xs">
                                    {{ substr($remarque->medecin->nom, 0, 2) }}
                                </div>
                                
                                <div class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-5 rounded-2xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition">
                                    <div class="flex items-center justify-between mb-3 border-b border-gray-50 pb-2">
                                        <div>
                                            <p class="font-bold text-gray-900">Dr. {{ $remarque->medecin->nom }}</p>
                                            <p class="text-xs font-semibold text-indigo-500">{{ $remarque->medecin->specialite }}</p>
                                        </div>
                                        <div class="text-xs font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded-md">
                                            {{ $remarque->created_at->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    <p class="text-gray-700 text-sm whitespace-pre-wrap leading-relaxed">{{ $remarque->contenu }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
