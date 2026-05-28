<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="posicion" value="Posición en el campo" />
            <select id="posicion" name="posicion" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">Selecciona tu posición...</option>
                <option value="Portero" {{ old('posicion', $user->posicion) == 'Portero' ? 'selected' : '' }}>Portero</option>
                <option value="Defensa" {{ old('posicion', $user->posicion) == 'Defensa' ? 'selected' : '' }}>Defensa</option>
                <option value="Centrocampista" {{ old('posicion', $user->posicion) == 'Centrocampista' ? 'selected' : '' }}>Centrocampista</option>
                <option value="Delantero" {{ old('posicion', $user->posicion) == 'Delantero' ? 'selected' : '' }}>Delantero</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('posicion')" />
        </div>

        <div>
            <x-input-label for="foto" value="Foto de Perfil (Opcional)" />
            <input type="file" id="foto" name="foto" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
            
            @if($user->foto)
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-2">Foto actual:</p>
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto de perfil" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200">
                </div>
            @endif
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>