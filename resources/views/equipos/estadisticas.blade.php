<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Estadísticas: {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('equipos.show', $equipo->id) }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Volver al Vestuario</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-blue-500">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Partidos Convocados</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $totalPartidos }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-green-500">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Jugadores en Plantilla</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ $totalJugadores }}</p>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b-4 border-yellow-500">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Gasto Total Pistas</p>
                    <p class="text-4xl font-black text-gray-900 mt-2">{{ number_format($gastoTotal, 2) }} €</p>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-bold text-gray-800">🏆 Ranking de Asistencia</h3>
                    <p class="text-sm text-gray-500">Jugadores que a más partidos se han apuntado.</p>
                </div>
                <div class="p-6">
                    <ul class="divide-y divide-gray-200">
                        @foreach($ranking as $index => $jugador)
                            <li class="py-4 flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-8 text-center font-bold text-xl">
                                        @if($index == 0) 🥇
                                        @elseif($index == 1) 🥈
                                        @elseif($index == 2) 🥉
                                        @else <span class="text-gray-400">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    
                                    @if($jugador->foto)
                                        <img src="{{ asset('storage/' . $jugador->foto) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover shadow-sm">
                                    @else
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600 shadow-sm">
                                            {{ substr($jugador->name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <span class="font-bold text-gray-900 text-lg">{{ $jugador->name }}</span>
                                </div>
                                <div class="text-right text-gray-600 font-medium bg-gray-100 px-4 py-2 rounded-lg">
                                    {{ $jugador->partidos_count }} partidos
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>