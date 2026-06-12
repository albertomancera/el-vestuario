<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight flex items-center">
                    @if($equipo->escudo)
                        <img src="{{ $equipo->escudo }}" alt="Escudo" class="w-10 h-10 rounded-lg object-contain bg-white border border-gray-200 mr-3 shadow-md">
                    @else
                        <span class="bg-indigo-600 text-white w-10 h-10 rounded-lg flex items-center justify-center mr-3 text-xl shadow-md">
                            {{ strtoupper(substr($equipo->nombre, 0, 1)) }}
                        </span>
                    @endif
                    {{ $equipo->nombre }}
                </h2>
                <p class="text-sm text-gray-500 mt-1 font-medium">Panel general del equipo</p>
            </div>
            <a href="{{ route('equipos.index') }}" class="inline-flex items-center text-sm font-semibold text-gray-600 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a Mis Equipos
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div class="animate-fade-in-up bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-lg font-black text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Plantilla Oficial
                        </h3>
                        <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-3 py-1 rounded-full border border-indigo-100">
                            {{ $jugadores->count() }} Miembros
                        </span>
                    </div>
                    <div class="p-0">
                        <ul class="divide-y divide-gray-50">
                            @foreach($jugadores as $jugador)
                                <li class="p-4 flex justify-between items-center hover:bg-gray-50 transition-colors duration-150">
                                    <div class="flex items-center space-x-4">
                                        @if($jugador->foto)
                                            <img src="{{ asset('storage/' . $jugador->foto) }}" alt="Foto" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-sm">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center font-black text-gray-500 shadow-sm border-2 border-white">
                                                {{ strtoupper(substr($jugador->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        
                                        <div>
                                            <span class="font-bold text-gray-900 block">{{ $jugador->name }}</span>
                                            <span class="text-sm text-gray-500 font-medium">{{ $jugador->posicion ?? 'Sin posición definida' }}</span>
                                        </div>
                                    </div>

                                    @if($jugador->pivot->rol === 'capitan')
                                        <span class="text-[10px] bg-gray-900 text-white uppercase tracking-widest font-bold px-2.5 py-1 rounded border border-gray-700">
                                            Capitán
                                        </span>
                                    @else
                                        <span class="text-[10px] bg-gray-100 text-gray-600 uppercase tracking-widest font-bold px-2.5 py-1 rounded border border-gray-200">
                                            Jugador
                                        </span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="animate-fade-in-up delay-100 bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-black text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Calendario de Partidos
                        </h3>
                    </div>
                    <div class="p-0">
                        @if($equipo->partidos->where('cronica_cerrada', false)->isEmpty())
                            <div class="p-8 text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-gray-500 font-medium">No hay encuentros programados en este momento.</p>
                            </div>
                        @else
                            <ul class="divide-y divide-gray-50">
                                @foreach($equipo->partidos->where('cronica_cerrada', false) as $partido)
                                    <li class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center hover:bg-gray-50 transition-colors duration-150 gap-4">
                                        <div>
                                            <p class="font-bold text-gray-900 text-lg mb-1 flex items-center">
                                                {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }} 
                                                <span class="mx-2 text-gray-300">|</span> 
                                                {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                                            </p>
                                            <p class="text-sm text-gray-500 flex items-center">
                                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                {{ $partido->lugar }} 
                                                <span class="mx-2">&bull;</span> 
                                                Presupuesto: {{ number_format($partido->coste_pista, 2) }} €
                                            </p>
                                        </div>
                                        <a href="{{ route('partidos.show', [$equipo->id, $partido->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-bold text-sm text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors w-full sm:w-auto justify-center shadow-sm">
                                            Ver Acta Oficial
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
                    <div class="animate-fade-in-up delay-200 bg-gray-900 rounded-2xl shadow-lg overflow-hidden border border-gray-800 relative">
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-5"></div>
                        
                        <div class="p-6 relative z-10">
                            <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Administración
                            </h3>
                            
                            <div class="mb-6">
                                <p class="text-sm text-gray-400 font-medium mb-2">Token de acceso para jugadores:</p>
                                <div class="bg-black/50 border border-gray-700 p-4 rounded-xl text-center flex items-center justify-between group">
                                    <span class="text-2xl font-mono tracking-[0.2em] font-black text-white">
                                        {{ $equipo->codigo_invitacion }}
                                    </span>
                                </div>
                            </div>
                            
                            <a href="{{ route('partidos.create', $equipo->id) }}" class="flex items-center justify-center w-full bg-indigo-600 text-white font-bold py-3.5 px-4 rounded-xl hover:bg-indigo-500 transition-colors duration-200 shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                Nueva Convocatoria
                            </a>

                            <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="mt-4" onsubmit="return confirm('ATENCIÓN: ¿Estás seguro de que quieres borrar el equipo entero y todos sus partidos? Esta acción no se puede deshacer.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center w-full bg-red-50 text-red-600 border border-red-200 font-bold py-3.5 px-4 rounded-xl hover:bg-red-100 transition-colors duration-200 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Borrar Equipo Definitivamente
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="animate-fade-in-up delay-200 bg-white border border-gray-200 rounded-2xl p-6 text-center shadow-sm">
                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-gray-600 font-medium text-sm">El capitán es el único autorizado para emitir nuevas convocatorias y gestionar el token de acceso.</p>
                    </div>
                @endif

                <div class="animate-fade-in-up delay-300 space-y-4">
                    <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl">
                        <div class="p-6">
                            <a href="{{ route('equipos.estadisticas', $equipo->id) }}" class="flex items-center justify-between w-full p-4 rounded-xl border-2 border-indigo-50 bg-white hover:bg-indigo-50 hover:border-indigo-100 transition-colors group">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-gray-900">Rendimiento</span>
                                        <span class="block text-xs text-gray-500 font-medium">Análisis de estadísticas</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white overflow-hidden shadow-sm border border-gray-100 rounded-2xl">
                        <div class="p-6">
                            <a href="{{ route('equipos.resultados', $equipo->id) }}" class="flex items-center justify-between w-full p-4 rounded-xl border-2 border-indigo-50 bg-white hover:bg-indigo-50 hover:border-indigo-100 transition-colors group">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </div>
                                    <div>
                                        <span class="block font-bold text-gray-900">Historial de Partidos</span>
                                        <span class="block text-xs text-gray-500 font-medium">Ver actas anteriores</span>
                                    </div>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-indigo-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app-layout>