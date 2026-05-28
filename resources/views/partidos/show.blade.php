<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles del Partido
            </h2>
            <a href="{{ route('equipos.show', $equipo->id) }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Volver al Vestuario</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="border-b border-gray-200 pb-6 mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">📍 {{ $partido->lugar }}</h3>
                        <p class="text-gray-600 mt-2 text-lg">
                            📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }} &nbsp;|&nbsp; 
                            ⏰ {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">Coste Pista</p>
                        <p class="text-3xl font-black text-green-600">{{ $partido->coste_pista }} €</p>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-bold text-gray-800">Jugadores Apuntados</h4>
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $partido->usuarios->count() }} confirmados
                        </span>
                    </div>
                    
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 mb-6 flex justify-between items-center shadow-inner">
                        <div>
                            @if($partido->usuarios->count() > 0)
                                <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">A pagar por persona</p>
                                <p class="text-2xl font-black text-blue-600">
                                    {{ number_format($partido->coste_pista / $partido->usuarios->count(), 2) }} €
                                </p>
                            @else
                                <p class="text-gray-500 font-medium">Sé el primero en apuntarte a este partido.</p>
                            @endif
                        </div>

                        <form action="{{ route('partidos.apuntarse', [$equipo->id, $partido->id]) }}" method="POST">
                            @csrf
                            @if($partido->usuarios->contains(auth()->user()->id))
                                <button type="submit" class="bg-red-500 text-white font-bold py-3 px-6 rounded hover:bg-red-600 transition shadow">
                                    ❌ Darme de baja
                                </button>
                            @else
                                <button type="submit" class="bg-green-500 text-white font-bold py-3 px-6 rounded hover:bg-green-600 transition shadow transform hover:scale-105">
                                    ✅ ¡Me apunto a jugar!
                                </button>
                            @endif
                        </form>
                    </div>

                    @if($partido->usuarios->count() > 0)
                        <ul class="divide-y divide-gray-200 border-t border-b border-gray-200">
                            @foreach($partido->usuarios as $jugador)
                                <li class="py-3 flex items-center space-x-3">
                                    @if($jugador->foto)
                                        <img src="{{ asset('storage/' . $jugador->foto) }}" alt="Foto de {{ $jugador->name }}" class="w-10 h-10 rounded-full object-cover border border-gray-300 shadow-sm">
                                    @else
                                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center font-bold text-blue-600 shadow-sm">
                                            {{ substr($jugador->name, 0, 1) }}
                                        </div>
                                    @endif
                                    
                                    <span class="font-bold text-gray-900 text-lg">{{ $jugador->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>