@extends('layouts.admin')

@section('header')
    Gestion des Médecins
@endsection

@section('content')
<div class="mb-4 flex justify-end">
    <a href="{{ route('medecins.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Ajouter un Médecin
    </a>
</div>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        @if($medecins->isEmpty())
            <p class="text-gray-500 text-center py-4">Aucun médecin enregistré.</p>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom & Prénom</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Spécialité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($medecins as $medecin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900">Dr. {{ $medecin->nom }} {{ $medecin->prenom }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $medecin->specialite }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $medecin->email }}</div>
                                <div class="text-sm text-gray-500">{{ $medecin->telephone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('medecins.edit', $medecin->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Modifier</a>
                                <form action="{{ route('medecins.destroy', $medecin->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer ce médecin supprimera également tous ses rendez-vous. Continuer ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
