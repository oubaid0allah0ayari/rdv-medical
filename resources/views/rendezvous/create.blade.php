<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('rendezvous.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Planifier une consultation') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl relative shadow-sm">
                    <div class="font-bold mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Il y a un problème avec votre demande :
                    </div>
                    <ul class="list-disc pl-5 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white shadow-xl shadow-gray-200/50 sm:rounded-3xl border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-12">
                    
                    <form action="{{ route('rendezvous.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <!-- Étape 1 : Le Praticien -->
                        <div class="border-b border-gray-100 pb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                                Choix du médecin
                            </h3>
                            <div>
                                <label for="medecin_id" class="block text-sm font-medium text-gray-700 mb-2">Sélectionnez le professionnel de santé :</label>
                                <select name="medecin_id" id="medecin_id" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-medium text-gray-800" required>
                                    <option value="" disabled selected>-- Choisir un médecin --</option>
                                    @foreach($medecins as $medecin)
                                        <option value="{{ $medecin->id }}" {{ old('medecin_id') == $medecin->id ? 'selected' : '' }}>
                                            Dr. {{ $medecin->nom }} ({{ $medecin->specialite }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Étape 2 : Date et Heure -->
                        <div class="border-b border-gray-100 pb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span>
                                Date et Heure
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Date souhaitée :</label>
                                    <input type="date" name="date" id="date" value="{{ old('date') }}" min="{{ date('Y-m-d') }}" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800" required>
                                </div>
                                <div>
                                    <label for="heure" class="block text-sm font-medium text-gray-700 mb-2">Heure :</label>
                                    <input type="time" name="heure" id="heure" value="{{ old('heure') }}" class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800" required>
                                </div>
                            </div>
                        </div>

                        <!-- Étape 3 : Détails -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span>
                                Motif de la visite
                            </h3>
                            <div class="space-y-6">
                                <div>
                                    <label for="motif" class="block text-sm font-medium text-gray-700 mb-2">Motif principal :</label>
                                    <input type="text" name="motif" id="motif" value="{{ old('motif') }}" placeholder="Ex: Consultation générale, Renouvellement d'ordonnance..." class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800" required>
                                </div>
                                <div>
                                    <label for="message_patient" class="block text-sm font-medium text-gray-700 mb-2">Message pour le médecin <span class="text-gray-400 font-normal">(Optionnel)</span> :</label>
                                    <textarea name="message_patient" id="message_patient" rows="3" placeholder="Symptômes, précisions supplémentaires..." class="block w-full rounded-xl border-gray-300 bg-gray-50 py-3 px-4 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-gray-800">{{ old('message_patient') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 flex items-center justify-end gap-4">
                            <a href="{{ route('rendezvous.index') }}" class="font-medium text-gray-600 hover:text-gray-900 transition">
                                Annuler
                            </a>
                            <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-full text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 shadow-xl hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all duration-300">
                                Confirmer le rendez-vous
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Aide Horaires -->
            <div class="mt-8 bg-blue-50 rounded-2xl p-6 border border-blue-100">
                <div class="flex items-start gap-4">
                    <div class="bg-white p-2 rounded-full text-blue-600 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-2">Aide : Horaires des médecins</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                            @foreach($medecins as $m)
                                <div>
                                    <span class="font-semibold text-blue-800">Dr. {{ $m->nom }} :</span>
                                    <p class="text-sm text-blue-700 whitespace-pre-line">De {{ \Carbon\Carbon::parse($m->heure_debut)->format('H:i') }} à {{ \Carbon\Carbon::parse($m->heure_fin)->format('H:i') }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
