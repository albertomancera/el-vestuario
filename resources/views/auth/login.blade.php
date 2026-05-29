<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-4 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-xs font-black text-gray-400 uppercase tracking-widest">{{ __('Password') }}</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full rounded-2xl border-gray-200 bg-gray-50 py-4 px-6 focus:ring-indigo-500 font-bold text-gray-900 transition-colors shadow-sm">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-red-500" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5">
            <label for="remember_me" class="ml-3 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</label>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1 tracking-widest uppercase text-sm mt-4">
            {{ __('Log in') }}
        </button>
    </form>

    <div class="mt-8 text-center border-t border-gray-100 pt-6">
        <p class="text-sm font-medium text-gray-500">
            ¿Aún no tienes cuenta? 
            <a href="{{ route('register') }}" class="font-black text-gray-900 hover:text-indigo-600 transition ml-1">Regístrate aquí</a>
        </p>
    </div>
</x-guest-layout>