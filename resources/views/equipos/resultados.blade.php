<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight">
                    Historial de Resultados
                </h2>
                <p class="text-sm text-gray-500 mt-1 font-medium">Registro oficial de encuentros finalizados de {{ $equipo->nombre }}</p>
            </div>
            <a href="{{ route('equipos.show', $equipo->id) }}" class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al Vestuario
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="animate-fade-in-up bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 border-b border-gray-50 bg-white flex items-center">
                    <svg class="w-6 h-6 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    <div>
                        <h3 class="text-xl font-black text-gray-900">Actas Cerradas</h3>
                        <p class="text-sm text-gray-500 font-medium mt-1">Todos los partidos que ya se han disputado.</p>
                    </div>
                </div>

                <div class="p-0 bg-gray-50">
                    @if($partidos->isEmpty())
                        <div class="p-12 text-center bg-white">
                            <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-1">Aún no hay resultados</h4>
                            <p class="text-gray-500 text-sm">Los partidos aparecerán aquí una vez que el capitán cierre el acta con los goles definitivos.</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-100">
                            @foreach($partidos as $partido)
                                <li class="p-6 bg-white hover:bg-indigo-50/50 transition-colors flex flex-col md:flex-row items-center justify-between gap-6">
                                    
                                    <div class="w-full md:w-1/3 flex flex-col justify-center text-center md:text-left">
                                        <span class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">
                                            {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                                        </span>
                                        <span class="text-sm font-bold text-gray-700 truncate" title="{{ $partido->lugar }}">
                                            {{ $partido->lugar }}
                                        </span>
                                    </div>

                                    <div class="w-full md:w-1/3 flex items-center justify-center space-x-2 sm:space-x-4 my-3 md:my-0">
                                        <div class="text-right flex-1 md:w-24 md:flex-none">
                                            <span class="font-black text-gray-900 truncate block">{{ substr($equipo->nombre, 0, 10) }}</span>
                                        </div>
                                        
                                        <div class="bg-gray-900 px-5 py-2 rounded-xl shadow-sm border border-gray-800 flex items-center justify-center whitespace-nowrap min-w-[100px]">
                                            <span class="text-2xl font-black text-white">{{ $partido->goles_equipo }}</span>
                                            <span class="text-gray-500 text-xl font-light mx-3">-</span>
                                            <span class="text-2xl font-black text-white">{{ $partido->goles_rival }}</span>
                                        </div>

                                        <div class="text-left flex-1 md:w-24 md:flex-none">
                                            <span class="font-black text-gray-500 block truncate">Rival</span>
                                        </div>
                                    </div>

                                    <div class="w-full md:w-1/3 flex justify-center md:justify-end">
                                        <a href="{{ route('partidos.show', [$equipo->id, $partido->id]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 rounded-lg font-bold text-sm text-gray-700 hover:bg-gray-50 hover:text-indigo-600 transition-colors shadow-sm">
                                            Ver Acta Oficial
                                        </a>
                                    </div>

                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>