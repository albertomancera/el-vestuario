<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight">
                    Mis Equipos
                </h2>
                <p class="text-sm text-gray-500 mt-2 font-medium">Gestiona tus plantillas, tácticas y próximos partidos</p>
            </div>
            
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('equipos.join') }}" class="btn-carga inline-flex items-center justify-center px-5 py-2.5 font-bold text-gray-700 bg-white border border-gray-300 rounded-xl shadow-sm hover:bg-gray-50 hover:text-indigo-600 transition-all duration-200">
                    Unirse con Código
                </a>
                <a href="{{ route('equipos.create') }}" class="btn-carga inline-flex items-center justify-center px-5 py-2.5 font-bold text-white bg-indigo-600 rounded-xl shadow-md hover:bg-indigo-700 hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    Crear Equipo
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if($equipos->isEmpty())
                <div class="equipo-card opacity-0 translate-y-8 transition-all duration-700 ease-out bg-white rounded-3xl shadow-sm border border-gray-100 p-12 text-center max-w-2xl mx-auto mt-10">
                    <div class="w-20 h-20 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Sin equipos asignados</h3>
                    <p class="text-gray-500 mb-8 leading-relaxed">Crea un nuevo equipo para empezar a convocar partidos, o utiliza un código de acceso proporcionado por tu capitán.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('equipos.create') }}" class="btn-carga inline-flex items-center justify-center px-8 py-3 font-bold text-white bg-indigo-600 rounded-xl shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-1">
                            Crear equipo
                        </a>
                        <a href="{{ route('equipos.join') }}" class="btn-carga inline-flex items-center justify-center px-8 py-3 font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">
                            Introducir código
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-4">
                    @foreach($equipos as $equipo)
                        <div class="equipo-card opacity-0 translate-y-8 transition-all duration-700 ease-out bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transform hover:-translate-y-1 flex flex-col group">
                            
                            <div class="h-28 bg-gradient-to-br from-gray-800 to-gray-900 relative">
                                @php
                                    $usuarioPivot = $equipo->usuarios->where('id', auth()->id())->first();
                                    $rol = $usuarioPivot ? $usuarioPivot->pivot->rol : 'jugador';
                                @endphp
                                <div class="absolute top-4 right-4 z-10">
                                    @if($rol === 'capitan')
                                        <span class="bg-indigo-600 text-white text-xs font-black px-3 py-1.5 rounded-md shadow-sm tracking-widest uppercase">
                                            Capitán
                                        </span>
                                    @else
                                        <span class="bg-white/10 backdrop-blur-md text-gray-300 text-xs font-bold px-3 py-1.5 rounded-md border border-white/20 tracking-widest uppercase">
                                            Jugador
                                        </span>
                                    @endif
                                </div>
                                <div class="absolute inset-0 bg-black opacity-10 group-hover:opacity-0 transition-opacity duration-300"></div>
                            </div>

                            <div class="p-6 flex-1 flex flex-col relative pt-12">
                                <div class="absolute -top-12 left-6 w-20 h-20 bg-white rounded-2xl shadow-lg flex items-center justify-center border-4 border-white text-3xl font-black text-indigo-600 transform group-hover:scale-105 transition-transform duration-300">
                                    {{ strtoupper(substr($equipo->nombre, 0, 1)) }}
                                </div>

                                <h3 class="text-2xl font-black text-gray-900 mb-2 truncate" title="{{ $equipo->nombre }}">
                                    {{ $equipo->nombre }}
                                </h3>
                                
                                <div class="flex items-center text-gray-500 text-sm mb-6 font-medium">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    {{ $equipo->usuarios->count() }} {{ $equipo->usuarios->count() === 1 ? 'miembro' : 'miembros' }}
                                </div>

                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    <a href="{{ route('equipos.show', $equipo->id) }}" class="w-full flex items-center justify-between px-4 py-3 bg-gray-50 hover:bg-gray-900 text-gray-700 hover:text-white font-bold rounded-xl transition-colors duration-200 group/btn">
                                        <span>Acceder al panel</span>
                                        <svg class="w-5 h-5 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Animación en cascada para las tarjetas
            const cards = document.querySelectorAll('.equipo-card');
            cards.forEach((card, index) => {
                // Añadimos un pequeño retraso progresivo (100ms) a cada tarjeta
                setTimeout(() => {
                    card.classList.remove('opacity-0', 'translate-y-8');
                    card.classList.add('opacity-100', 'translate-y-0');
                }, 100 + (index * 100));
            });

            // 2. Efecto de carga en los botones de acción
            const botones = document.querySelectorAll('.btn-carga');
            botones.forEach(boton => {
                boton.addEventListener('click', function() {
                    // Evitar múltiples clics
                    if (this.classList.contains('pointer-events-none')) return;
                    
                    // Sustituir el texto por un spinner SVG
                    const anchoOriginal = this.offsetWidth;
                    this.style.width = `${anchoOriginal}px`; // Mantener el ancho para que no pegue un salto
                    this.innerHTML = `<svg class="animate-spin h-5 w-5 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                      </svg>`;
                    this.classList.add('opacity-75', 'pointer-events-none');
                });
            });
        });
    </script>
</x-app-layout>