@extends('layouts.admin')

@section('header')
    Modifier un Médecin
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg max-w-3xl mx-auto">
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

        <form method="POST" action="{{ route('medecins.update', $medecin->id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="nom" class="block text-gray-700 text-sm font-bold mb-2">Nom :</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $medecin->nom) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="prenom" class="block text-gray-700 text-sm font-bold mb-2">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $medecin->prenom) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>

            <div class="mb-4">
                <label for="specialite" class="block text-gray-700 text-sm font-bold mb-2">Spécialité :</label>
                <input type="text" name="specialite" id="specialite" value="{{ old('specialite', $medecin->specialite) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label for="telephone" class="block text-gray-700 text-sm font-bold mb-2">Téléphone :</label>
                    <input type="text" name="telephone" id="telephone" value="{{ old('telephone', $medecin->telephone) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email de contact :</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $medecin->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('medecins.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Annuler</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Mettre à jour
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
