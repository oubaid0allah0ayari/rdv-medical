@extends('layouts.admin')

@section('header_title', 'Vue d\'ensemble')

@section('content')
    <!-- Widgets Statistiques -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Widget 1 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Patients</p>
                    <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_patients'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-400 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Widget 2 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Praticiens</p>
                    <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_medecins'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Widget 3 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Rendez-vous (Total)</p>
                    <h3 class="text-4xl font-black text-gray-900">{{ $stats['total_rendezvous'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-400 to-teal-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Widget 4 -->
        <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex justify-between items-center">
                <div>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">RDV Aujourd'hui</p>
                    <h3 class="text-4xl font-black text-amber-600">{{ $stats['rdv_aujourdhui'] }}</h3>
                </div>
                <div class="w-14 h-14 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau global des Rendez-vous -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-3xl border border-gray-100">
        <div class="p-8 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-900">Activité Récente (Tous les Rendez-vous)</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Patient</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Médecin</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Date & Heure</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Motif</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-50">
                    @foreach($rendezvous as $rdv)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs mr-3">
                                        {{ substr($rdv->patient->nom, 0, 1) }}
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">{{ $rdv->patient->nom }} {{ $rdv->patient->prenom }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Dr. {{ $rdv->medecin->nom }}</div>
                                <div class="text-xs text-gray-500">{{ $rdv->medecin->specialite }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') }}</div>
                                <div class="text-xs font-semibold text-gray-500 bg-gray-100 inline-block px-2 py-0.5 rounded">{{ \Carbon\Carbon::parse($rdv->heure)->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800 max-w-xs truncate">{{ $rdv->motif }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full 
                                    {{ $rdv->statut === 'planifié' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $rdv->statut === 'confirmé' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $rdv->statut === 'terminé' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $rdv->statut === 'annulé' ? 'bg-red-100 text-red-800' : '' }}
                                ">
                                    {{ $rdv->statut }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if($rendezvous->isEmpty())
            <div class="p-8 text-center text-gray-500">
                Aucun rendez-vous enregistré sur la plateforme.
            </div>
        @endif
    </div>
@endsection
