@extends('layouts.admin')

@section('header')
    Tous les Rendez-vous
@endsection

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        
        @if($rendezvous->isEmpty())
            <p class="text-gray-500 text-center py-4">Aucun rendez-vous enregistré dans le système.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Heure</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médecin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motif</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rendezvous as $rdv)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rdv->patient)
                                        {{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}
                                    @else
                                        <span class="text-red-500 italic">Patient supprimé</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rdv->medecin)
                                        Dr. {{ $rdv->medecin->nom }}
                                    @else
                                        <span class="text-red-500 italic">Médecin supprimé</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $rdv->motif }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $rdv->statut === 'planifié' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $rdv->statut === 'confirmé' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $rdv->statut === 'annulé' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        {{ ucfirst($rdv->statut) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
