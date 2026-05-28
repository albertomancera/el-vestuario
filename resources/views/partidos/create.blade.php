<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Convocar Partido para: {{ $equipo->nombre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('partidos.store', $equipo->id) }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha del Partido</label>
                            <input type="date" name="fecha" id="fecha" required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>
                        <div>
                            <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                            <input type="time" name="hora" id="hora" required 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="lugar" class="block text-sm font-medium text-gray-700">Lugar / Pista</label>
                        <input type="text" name="lugar" id="lugar" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                               placeholder="Ej. Polideportivo Municipal">
                    </div>

                    <div class="mb-6">
                        <label for="coste_pista" class="block text-sm font-medium text-gray-700">Coste Total de la Pista (€)</label>
                        <input type="number" step="0.01" name="coste_pista" id="coste_pista" required 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                               placeholder="Ej. 12.50">
                        <p class="text-xs text-gray-500 mt-1">Este coste se dividirá luego entre los jugadores que asistan.</p>
                    </div>

                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('equipos.show', $equipo->id) }}" class="text-gray-600 hover:text-gray-900">
                            Cancelar
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded shadow hover:bg-green-700 font-bold transition">
                            Confirmar Convocatoria
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>