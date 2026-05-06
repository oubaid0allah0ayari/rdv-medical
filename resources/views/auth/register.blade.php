<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Créer un compte</h2>
        <p class="text-sm text-gray-500 mt-2 font-medium">Rejoignez-nous pour prendre votre premier rendez-vous.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nom complet" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="name" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-colors" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Jean Dupont" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Adresse Email" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <input id="email" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-colors" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="votre@email.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Mot de passe" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="password" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-colors" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" class="text-gray-700 font-bold" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <input id="password_confirmation" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-colors" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform transition-all hover:-translate-y-0.5 active:translate-y-0">
                Créer mon compte
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600 font-medium">
                Déjà inscrit ? 
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-cyan-500 transition-colors">Se connecter</a>
            </p>
        </div>
    </form>
</x-guest-layout>
