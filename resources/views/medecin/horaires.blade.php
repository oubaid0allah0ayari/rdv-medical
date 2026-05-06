<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('medecin.dashboard') }}" class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-bold text-3xl text-gray-900 tracking-tight">
                {{ __('Mes Horaires de Travail') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen flex flex-col">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 w-full flex-1 flex flex-col">
            
            <div class="bg-white overflow-hidden shadow-xl shadow-gray-200/40 sm:rounded-3xl border border-gray-100 p-10 relative">
                
                <div class="text-center mb-8">
                    <div class="w-16 h-16 bg-indigo-50 text-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-extrabold text-gray-900">Définissez vos horaires</h3>
                    <p class="text-gray-500 mt-2 text-sm">Ces horaires seront affichés aux patients lors de leur prise de rendez-vous. Le système empêchera automatiquement les réservations en dehors de cette plage horaire.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl shadow-sm">
                        <ul class="list-disc pl-5 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('medecin.horaires.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Heure de début</label>
                            <input type="time" name="heure_debut" value="{{ \Carbon\Carbon::parse($medecin->heure_debut)->format('H:i') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg font-bold text-gray-900 py-3" required>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Heure de fin</label>
                            <input type="time" name="heure_fin" value="{{ \Carbon\Carbon::parse($medecin->heure_fin)->format('H:i') }}" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-lg font-bold text-gray-900 py-3" required>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex justify-end">
                        <button type="submit" class="w-full md:w-auto px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-indigo-500/30 transition transform hover:-translate-y-0.5">
                            Enregistrer mes horaires
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
