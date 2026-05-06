<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dossier Médical : ') }} {{ $patient->nom }} {{ $patient->prenom }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Info Patient -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8 flex items-center gap-6">
                <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl font-bold">
                    {{ substr($patient->nom, 0, 1) }}{{ substr($patient->prenom, 0, 1) }}
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $patient->nom }} {{ $patient->prenom }}</h3>
                    <p class="text-gray-500">
                        Date de naissance : {{ $patient->date_naissance ? \Carbon\Carbon::parse($patient->date_naissance)->format('d/m/Y') : 'Non renseignée' }} <br>
                        Téléphone : {{ $patient->telephone }}
                    </p>
                </div>
            </div>

            <!-- Dossier Médical Partagé -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="bg-yellow-50 border-b border-yellow-100 p-4">
                    <p class="text-yellow-800 text-sm flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Ce dossier médical est partagé et visible par tous les praticiens ayant consulté ce patient.
                    </p>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('medecin.patient.update', $patient->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="dossier_medical" class="block text-sm font-bold text-gray-700 mb-2">Notes médicales, antécédents, traitements en cours :</label>
                            <textarea id="dossier_medical" name="dossier_medical" rows="12" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-mono text-sm leading-relaxed" placeholder="Renseignez ici l'historique médical du patient...">{{ old('dossier_medical', $patient->dossier_medical) }}</textarea>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('medecin.dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">&larr; Retour à l'agenda</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                                Mettre à jour le dossier
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
