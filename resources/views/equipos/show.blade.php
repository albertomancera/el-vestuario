<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Vestuario: {{ $equipo->nombre }}
            </h2>
            <a href="{{ route('equipos.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Volver a Mis Equipos</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Columna Izquierda: Info y Jugadores -->
            <div class="md:col-span-2 space-y-6">
                
                <!-- Lista de Jugadores -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-800">Plantilla del Equipo</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            {{ $jugadores->count() }} Jugadores
                        </span>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach($jugadores as $jugador)
                                <li class="py-3 flex justify-between items-center">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600">
                                            {{ substr($jugador->name, 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $jugador->name }}</span>
                                    </div>
                                    <span class="text-sm text-gray-500 uppercase tracking-wider font-semibold">
                                        {{ $jugador->pivot->rol }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- NUEVA CAJA DE PARTIDOS -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Partidos Convocados</h3>
                    </div>
                    <div class="p-6">
                        @if($equipo->partidos->isEmpty())
                            <p class="text-gray-500 text-center py-4">No hay partidos programados. ¡Anímate a convocar uno!</p>
                        @else
                            <ul class="divide-y divide-gray-200">
                                @foreach($equipo->partidos as $partido)
                                    <li class="py-4 flex justify-between items-center hover:bg-gray-50 px-2 rounded transition">
                                        <div>
                                            <p class="font-bold text-gray-800 text-lg">
                                                📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }} a las {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">
                                                📍 {{ $partido->lugar }} &nbsp;|&nbsp; 💰 Total: {{ $partido->coste_pista }} €
                                            </p>
                                        </div>
                                        <a href="{{ route('partidos.show', [$equipo->id, $partido->id]) }}" class="bg-blue-100 text-blue-700 px-4 py-2 rounded font-bold hover:bg-blue-200 transition whitespace-nowrap">
                                            Ver Detalles &rarr;
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Columna Derecha: Panel de Control -->
            <div class="space-y-6">
                <!-- Código de Invitación -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Código de Invitación</h3>
                        <div class="bg-gray-100 p-3 rounded text-center text-2xl font-mono tracking-widest font-bold text-gray-800">
                            {{ $equipo->codigo_invitacion }}
                        </div>
                        <p class="text-xs text-gray-500 mt-2 text-center">Comparte este código con tus amigos para que se unan al equipo.</p>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex flex-col space-y-3">
                        <a href="{{ route('partidos.create', $equipo->id) }}" class="block text-center w-full bg-green-600 text-white font-bold py-2 px-4 rounded hover:bg-green-700 transition shadow">
                            📅 Convocar Partido
                        </a>
                        <button class="w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition shadow">
                            📊 Ver Estadísticas
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>