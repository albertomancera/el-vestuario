<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight">
                    Rendimiento
                </h2>
                <p class="text-sm text-gray-500 mt-1 font-medium">Análisis global de {{ $equipo->nombre }}</p>
            </div>
            <a href="{{ route('equipos.show', $equipo->id) }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al Vestuario
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="animate-fade-in-up bg-white rounded-2xl p-8 border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-5">
                        <svg class="w-20 h-20 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest relative z-10">Partidos Disputados</p>
                    <p class="text-5xl font-black text-gray-900 mt-4 relative z-10">{{ $totalPartidos }}</p>
                </div>

                <div class="animate-fade-in-up delay-100 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-5">
                        <svg class="w-20 h-20 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest relative z-10">Fichas Activas</p>
                    <p class="text-5xl font-black text-gray-900 mt-4 relative z-10">{{ $totalJugadores }}</p>
                </div>

                <div class="animate-fade-in-up delay-200 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm relative overflow-hidden">
                    <div class="absolute right-0 top-0 p-4 opacity-5">
                        <svg class="w-20 h-20 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest relative z-10">Inversión Total</p>
                    <p class="text-5xl font-black text-indigo-600 mt-4 relative z-10">{{ number_format($gastoTotal, 2) }} €</p>
                </div>
            </div>

            <div class="animate-fade-in-up delay-300 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden max-w-4xl mx-auto">
                <div class="p-8 border-b border-gray-50 bg-white flex items-center">
                    <svg class="w-6 h-6 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Ranking de Asistencia</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">Clasificación por número de convocatorias atendidas</p>
                    </div>
                </div>
                
                <div class="p-0">
                    <ul class="divide-y divide-gray-50">
                        @foreach($ranking as $index => $jugador)
                            <li class="p-6 flex items-center justify-between hover:bg-gray-50 transition-colors">
                                <div class="flex items-center space-x-6">
                                    <div class="w-10 text-center">
                                        @if($index == 0) 
                                            <span class="text-3xl font-black text-yellow-500">1</span>
                                        @elseif($index == 1) 
                                            <span class="text-3xl font-black text-gray-400">2</span>
                                        @elseif($index == 2) 
                                            <span class="text-3xl font-black text-amber-700">3</span>
                                        @else 
                                            <span class="text-xl font-bold text-gray-300">{{ $index + 1 }}</span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center space-x-4">
                                        @if($jugador->foto)
                                            <img src="{{ asset('storage/' . $jugador->foto) }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center font-black text-gray-400 text-lg">
                                                {{ substr($jugador->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="font-black text-gray-900 text-lg">{{ $jugador->name }}</span>
                                    </div>
                                </div>
                                <div class="bg-indigo-50 text-indigo-700 font-bold px-4 py-2 rounded-lg text-sm border border-indigo-100">
                                    {{ $jugador->partidos_count }} PJ
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>