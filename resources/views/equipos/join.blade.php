<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Unirse a un Equipo
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('equipos.joinStore') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="codigo" class="block text-sm font-medium text-gray-700">Código de Invitación</label>
                        <input type="text" name="codigo" id="codigo" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 font-mono text-center uppercase tracking-widest text-xl"
                               placeholder="EJ: B348CFFB">
                        
                        @error('codigo')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('equipos.index') }}" class="text-gray-600 hover:text-gray-900">Cancelar</a>
                        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded shadow hover:bg-gray-900 font-bold transition">
                            Entrar al Vestuario
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>