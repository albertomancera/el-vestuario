<x-app-layout>
    <x-slot name="header">
        @php
            $fechaFormateada = \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y');
            $horaFormateada = \Carbon\Carbon::parse($partido->hora)->format('H:i');
            $urlPartido = route('partidos.show', [$equipo->id, $partido->id]);
            
            $textoMensaje = "⚽ ¡Nuevo partido de {$equipo->nombre}!\n📍 Lugar: {$partido->lugar}\n📅 Día: {$fechaFormateada} a las {$horaFormateada}\n\n👇 ¡Entra en la app para apuntarte!\n{$urlPartido}";
            
            // Codificamos el texto para que los espacios y saltos de línea funcionen en la URL
            $enlaceWhatsApp = "https://api.whatsapp.com/send?text=" . urlencode($textoMensaje);
        @endphp

        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detalles del Partido
            </h2>
            <div class="flex items-center space-x-4">
                <a href="{{ $enlaceWhatsApp }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded-lg font-bold text-sm hover:bg-green-600 transition shadow-sm flex items-center">
                    <span class="mr-2 text-lg">💬</span> Avisar por WhatsApp
                </a>
                
                <a href="{{ route('equipos.show', $equipo->id) }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Volver al Vestuario</a>
            </div>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="border-b border-gray-200 pb-6 mb-6 flex justify-between items-center">
                    <div class="w-2/3">
                        <h3 class="text-2xl font-bold text-gray-900">📍 <span id="nombre-lugar">{{ $partido->lugar }}</span></h3>
                        <p class="text-gray-600 mt-2 text-lg">
                            📅 {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }} &nbsp;|&nbsp; 
                            ⏰ {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                        </p>
                        
                        <div id="mapa-partido" class="h-48 w-full mt-4 rounded-lg border-2 border-gray-200 shadow-inner z-0"></div>
                        <p id="mapa-error" class="text-sm text-red-500 mt-2 hidden">No se pudo encontrar la ubicación exacta en el mapa.</p>
                    </div>
                    <div class="text-right w-1/3">
                        <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">Coste Pista</p>
                        <p class="text-3xl font-black text-green-600">{{ $partido->coste_pista }} €</p>
                    </div>
                </div>

                @if($clima)
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="bg-white rounded-full p-2 shadow-sm">
                                <img src="https://openweathermap.org/img/wn/{{ $clima['weather'][0]['icon'] }}@2x.png" alt="Icono clima" class="w-12 h-12">
                            </div>
                            <div>
                                <p class="text-sm font-bold text-blue-800 uppercase tracking-wider">Pronóstico del Clima</p>
                                <p class="text-blue-900 capitalize">{{ $clima['weather'][0]['description'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-3xl font-black text-blue-700">{{ round($clima['main']['temp']) }}°C</p>
                            <p class="text-xs text-blue-600 font-medium">Humedad: {{ $clima['main']['humidity'] }}%</p>
                        </div>
                    </div>
                @endif

                <div class="mb-8">
                    @if($partido->cronica_cerrada)
                        <div class="bg-gray-900 text-white rounded-xl p-6 text-center shadow-md border-b-4 border-yellow-500">
                            <p class="text-xs uppercase tracking-widest text-yellow-400 font-bold mb-1">🏁 RESULTADO FINAL</p>
                            <div class="flex justify-center items-center space-x-6 my-2">
                                <div class="text-right w-1/3">
                                    <p class="text-lg font-bold text-white">{{ $equipo->nombre }}</p>
                                </div>
                                <div class="bg-gray-800 px-5 py-2 rounded-lg text-4xl font-black text-yellow-400 font-mono tracking-wider shadow-inner border border-gray-700">
                                    {{ $partido->goles_equipo }} - {{ $partido->goles_rival }}
                                </div>
                                <div class="text-left w-1/3">
                                    <p class="text-lg font-bold text-gray-400">Equipo Rival</p>
                                </div>
                            </div>

                            @php
                                $goleadores = $partido->usuarios()->wherePivot('goles', '>', 0)->get();
                            @endphp
                            @if($goleadores->count() > 0)
                                <div class="mt-4 border-t border-gray-800 pt-3 max-w-md mx-auto">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">⚽ GOLEADORES DEL EQUIPO</p>
                                    <div class="space-y-1 text-sm">
                                        @foreach($goleadores as $goleador)
                                            <p class="text-gray-300">
                                                <span class="font-bold text-white">{{ $goleador->name }}</span> ({{ $goleador->pivot->goles }} {{ $goleador->pivot->goles > 1 ? 'goles' : 'gol' }})
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        @php
                            $esCapitan = $equipo->usuarios()->where('user_id', auth()->id())->first()?->pivot?->rol === 'capitan';
                        @endphp
                        @if($esCapitan)
                            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-5 shadow-sm">
                                <h4 class="text-base font-bold text-yellow-800 mb-1 flex items-center">
                                    👑 Registrar Acta del Partido (Solo Capitán)
                                </h4>
                                <p class="text-xs text-gray-600 mb-4">Finaliza el encuentro guardando el marcador definitivo y los goles del equipo.</p>

                                <form action="{{ route('partidos.resultado', [$equipo->id, $partido->id]) }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Goles {{ $equipo->nombre }}</label>
                                            <input type="number" name="goles_equipo" min="0" value="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Goles Rival</label>
                                            <input type="number" name="goles_rival" min="0" value="0" class="w-full rounded-lg border-gray-300 shadow-sm focus:ring-yellow-500 focus:border-yellow-500" required>
                                        </div>
                                    </div>

                                    @if($partido->usuarios->count() > 0)
                                        <p class="text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Asignar Goles a Convocados:</p>
                                        <div class="space-y-2 bg-white p-3 rounded-lg border border-gray-200 max-h-40 overflow-y-auto mb-4">
                                            @foreach($partido->usuarios as $jugador)
                                                <div class="flex justify-between items-center text-sm">
                                                    <span class="font-medium text-gray-800">{{ $jugador->name }}</span>
                                                    <input type="number" name="goles_jugadores[{{ $jugador->id }}]" value="0" min="0" class="w-16 rounded-md border-gray-300 shadow-sm text-center h-8 py-0 focus:ring-yellow-500 focus:border-yellow-500">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <button type="submit" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg transition shadow text-sm">
                                        🏁 Publicar Marcador y Cerrar Partido
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>

                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-bold text-gray-800">Jugadores Apuntados</h4>
                        <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full">
                            {{ $partido->usuarios->count() }} confirmados
                        </span>
                    </div>
                    
                    @if(!$partido->cronica_cerrada)
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
                    @endif

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

                <div class="mt-10 border-t border-gray-200 pt-8">
                    <h4 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <span class="text-2xl mr-2">💬</span> Muro del Partido
                    </h4>

                    <div class="space-y-4 mb-6 max-h-96 overflow-y-auto pr-2">
                        @forelse($partido->comentarios()->with('user')->latest()->get() as $comentario)
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 shadow-sm">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="flex items-center space-x-2">
                                        @if($comentario->user->foto)
                                            <img src="{{ asset('storage/' . $comentario->user->foto) }}" class="w-6 h-6 rounded-full object-cover">
                                        @else
                                            <div class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center font-bold text-indigo-600 text-xs">
                                                {{ substr($comentario->user->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <span class="font-bold text-gray-900 text-sm">{{ $comentario->user->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-400 font-medium">{{ $comentario->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 ml-8">{{ $comentario->mensaje }}</p>
                            </div>
                        @empty
                            <div class="text-center py-6 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <p class="text-gray-500 text-sm font-medium">No hay comentarios todavía. ¡Sé el primero en romper el hielo!</p>
                            </div>
                        @endforelse
                    </div>

                    <form action="{{ route('partidos.comentar', [$equipo->id, $partido->id]) }}" method="POST" class="mt-4">
                        @csrf
                        <div class="flex gap-3">
                            <input type="text" name="mensaje" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="Escribe un mensaje al equipo..." required autocomplete="off">
                            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-indigo-700 transition shadow">
                                Enviar
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lugarBusqueda = "{{ $partido->lugar }}";
            
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(lugarBusqueda)}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        let lat = data[0].lat;
                        let lon = data[0].lon;
                        
                        let map = L.map('mapa-partido').setView([lat, lon], 15);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors'
                        }).addTo(map);
                        
                        L.marker([lat, lon]).addTo(map)
                            .bindPopup(`<b>${lugarBusqueda}</b>`)
                            .openPopup();
                    } else {
                        document.getElementById('mapa-partido').style.display = 'none';
                        document.getElementById('mapa-error').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error buscando el mapa:', error);
                });
        });
    </script>
</x-app-layout>