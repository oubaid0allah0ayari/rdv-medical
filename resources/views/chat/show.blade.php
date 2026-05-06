<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-4">
            <a href="{{ route('chat.index') }}" class="text-gray-500 hover:text-gray-900">&larr;</a>
            <span>{{ $contact->name }}</span>
            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full capitalize">{{ $contact->role }}</span>
        </h2>
    </x-slot>

    <div class="py-6 bg-gray-50 min-h-screen flex flex-col">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 w-full flex-1 flex flex-col">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 flex-1 flex flex-col h-[70vh]">
                
                <!-- Zone des messages -->
                <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-slate-50" id="chat-box">
                    @if($messages->isEmpty())
                        <div class="text-center text-gray-400 mt-10">
                            Envoyez le premier message à {{ $contact->name }}...
                        </div>
                    @endif

                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[75%] rounded-2xl px-5 py-3 {{ $msg->sender_id === auth()->id() ? 'bg-blue-600 text-white rounded-br-none shadow-md' : 'bg-white border border-gray-200 text-gray-800 rounded-bl-none shadow-sm' }}">
                                <p class="text-sm whitespace-pre-wrap">{{ $msg->content }}</p>
                                <span class="text-[10px] block mt-1 {{ $msg->sender_id === auth()->id() ? 'text-blue-200' : 'text-gray-400' }} text-right">
                                    {{ $msg->created_at->format('d/m à H:i') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Formulaire d'envoi -->
                <div class="p-4 bg-white border-t border-gray-200">
                    <form action="{{ route('chat.store', $contact->id) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="text" name="content" class="flex-1 rounded-full border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 px-6" placeholder="Écrivez votre message..." required autocomplete="off" autofocus>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 shadow-md transition-transform hover:scale-105">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Script pour scroller en bas automatiquement -->
    <script>
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
</x-app-layout>
