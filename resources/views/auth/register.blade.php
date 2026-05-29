<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-3.5 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div>
            <label for="email" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-3.5 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div>
            <label for="password" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-3.5 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-3.5 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-black transition transform hover:-translate-y-1 tracking-widest uppercase text-sm mt-6">
            {{ __('Register') }}
        </button>
    </form>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-sm font-medium text-gray-500">
            ¿Ya tienes cuenta? 
            <a href="{{ route('login') }}" class="font-black text-indigo-600 hover:text-indigo-800 transition ml-1">Inicia sesión</a>
        </p>
    </div>
</x-guest-layout>