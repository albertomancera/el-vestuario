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
            
            <div class="md:col-span-2 space-y-6">
                
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
                                <li class="py-3 flex justify-between items-center hover:bg-gray-50 px-2 rounded transition">
                                    <div class="flex items-center space-x-4">
                                        @if($jugador->foto)
                                            <img src="{{ asset('storage/' . $jugador->foto) }}" alt="Foto de {{ $jugador->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
                                        @else
                                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center font-bold text-gray-600 shadow-sm">
                                                {{ substr($jugador->name, 0, 1) }}
                                            </div>
                                        @endif
                                        
                                        <div>
                                            <span class="font-bold text-gray-900 block">{{ $jugador->name }}</span>
                                            <span class="text-xs text-gray-500 font-medium">{{ $jugador->posicion ?? 'Sin posición' }}</span>
                                        </div>
                                    </div>

                                    <span class="text-xs {{ $jugador->pivot->rol === 'capitan' ? 'bg-yellow-100 text-yellow-800 border-yellow-200' : 'bg-gray-100 text-gray-800 border-gray-200' }} border uppercase tracking-wider font-bold px-3 py-1 rounded-full">
                                        {{ $jugador->pivot->rol }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Partidos Convocados</h3>
                    </div>
                    <div class="p-6">
                        @if($equipo->partidos->isEmpty())
                            <p class="text-gray-500 text-center py-4">No hay partidos programados.</p>
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

            <div class="space-y-6">
                
                @if($esCapitan)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-yellow-200">
                        <div class="p-6 bg-yellow-50">
                            <h3 class="text-sm font-bold text-yellow-800 uppercase tracking-wider mb-2 flex items-center">
                                👑 Solo Capitán
                            </h3>
                            <p class="text-xs text-gray-600 mb-3">Código de Invitación del equipo:</p>
                            <div class="bg-white border border-yellow-200 p-3 rounded text-center text-2xl font-mono tracking-widest font-bold text-gray-800 shadow-inner">
                                {{ $equipo->codigo_invitacion }}
                            </div>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <a href="{{ route('partidos.create', $equipo->id) }}" class="block text-center w-full bg-green-600 text-white font-bold py-3 px-4 rounded hover:bg-green-700 transition shadow-lg transform hover:scale-105">
                                📅 Convocar Nuevo Partido
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <p class="text-blue-800 font-medium">Solo el capitán puede convocar partidos e invitar a nuevos jugadores.</p>
                    </div>
                @endif

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <a href="{{ route('equipos.estadisticas', $equipo->id) }}" class="block text-center w-full bg-indigo-600 text-white font-bold py-2 px-4 rounded hover:bg-indigo-700 transition shadow">
                            📊 Ver Estadísticas
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>