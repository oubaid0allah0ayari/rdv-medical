<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Messagerie Sécurisée') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Liste des contacts -->
            <div class="md:col-span-1 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 h-fit">
                <h3 class="font-bold text-lg text-gray-900 mb-4">Conversations Récentes</h3>
                @if($contacts->isEmpty())
                    <p class="text-gray-500 text-sm">Aucune conversation en cours.</p>
                @else
                    <ul class="space-y-3">
                        @foreach($contacts as $contact)
                            <li>
                                <a href="{{ route('chat.show', $contact->id) }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-blue-50 transition border border-transparent hover:border-blue-100">
                                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold">
                                        {{ substr($contact->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900">{{ $contact->name }}</p>
                                        <p class="text-xs text-gray-500 capitalize">{{ $contact->role }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Nouvelle conversation -->
            <div class="md:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-xl text-gray-900 mb-6">Démarrer une nouvelle discussion</h3>
                
                @if(auth()->user()->isPatient() && count($medecinsDispos) > 0)
                    <p class="mb-4 text-gray-600">Choisissez un praticien :</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($medecinsDispos as $m)
                            <a href="{{ route('chat.show', $m->id) }}" class="flex items-center p-4 border rounded-xl hover:shadow-md transition">
                                <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center font-bold mr-4">
                                    {{ substr($m->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $m->name }}</h4>
                                    <span class="text-xs text-indigo-600">Contacter</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @elseif(auth()->user()->isMedecin() && count($autresMedecins) > 0)
                    <p class="mb-4 text-gray-600">Discuter avec un confrère :</p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($autresMedecins as $m)
                            <a href="{{ route('chat.show', $m->id) }}" class="flex items-center p-4 border rounded-xl hover:shadow-md transition">
                                <div class="w-12 h-12 bg-teal-100 text-teal-600 rounded-full flex items-center justify-center font-bold mr-4">
                                    {{ substr($m->name, 0, 2) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900">{{ $m->name }}</h4>
                                    <span class="text-xs text-teal-600">Contacter</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <p class="mt-8 text-sm text-gray-500 italic">Note : Pour discuter avec un patient, passez par la fiche du patient ou attendez qu'il vous envoie un message.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
