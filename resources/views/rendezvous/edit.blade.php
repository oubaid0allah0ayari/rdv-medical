<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le rendez-vous') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('rendezvous.update', $rendezvous->id) }}">
                        @csrf
                        @method('PUT') <!-- Très important pour les modifications en Laravel -->

                        <!-- Médecin -->
                        <div class="mb-4">
                            <label for="medecin_id" class="block text-gray-700 text-sm font-bold mb-2">Choisir un médecin :</label>
                            <select name="medecin_id" id="medecin_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @foreach($medecins as $medecin)
                                    <option value="{{ $medecin->id }}" {{ (old('medecin_id', $rendezvous->medecin_id) == $medecin->id) ? 'selected' : '' }}>
                                        Dr. {{ $medecin->nom }} {{ $medecin->prenom }} - {{ $medecin->specialite }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date :</label>
                            <input type="date" name="date" id="date" value="{{ old('date', $rendezvous->date) }}" min="{{ date('Y-m-d') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Heure -->
                        <div class="mb-4">
                            <label for="heure" class="block text-gray-700 text-sm font-bold mb-2">Heure :</label>
                            <input type="time" name="heure" id="heure" value="{{ old('heure', \Carbon\Carbon::parse($rendezvous->heure)->format('H:i')) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <!-- Motif -->
                        <div class="mb-6">
                            <label for="motif" class="block text-gray-700 text-sm font-bold mb-2">Motif de consultation :</label>
                            <input type="text" name="motif" id="motif" value="{{ old('motif', $rendezvous->motif) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Mettre à jour
                            </button>
                            <a href="{{ route('rendezvous.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                                Annuler
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
