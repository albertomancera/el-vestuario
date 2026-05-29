<x-app-layout>
    <x-slot name="header">
        @php
            $fechaFormateada = \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y');
            $horaFormateada = \Carbon\Carbon::parse($partido->hora)->format('H:i');
            $urlPartido = route('partidos.show', [$equipo->id, $partido->id]);
            $textoMensaje = "Convocatoria: {$equipo->nombre}\nLugar: {$partido->lugar}\nFecha: {$fechaFormateada} - {$horaFormateada}\nConfirmar aquí: {$urlPartido}";
            $enlaceWhatsApp = "https://api.whatsapp.com/send?text=" . urlencode($textoMensaje);
        @endphp

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-gray-900 leading-tight tracking-tight">
                    Detalles del Encuentro
                </h2>
                <p class="text-sm text-gray-500 mt-1 font-medium">Gestión de acta y convocatoria</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ $enlaceWhatsApp }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 transition shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.414 0 .004 5.412.001 12.049a11.82 11.82 0 001.578 5.91L0 24l6.102-1.6a11.81 11.81 0 005.936 1.587h.005c6.634 0 12.046-5.412 12.049-12.051a11.83 11.83 0 00-3.68-8.52z"/></svg>
                    Convocatoria
                </a>
                <a href="{{ route('equipos.show', $equipo->id) }}" class="text-sm font-semibold text-gray-500 hover:text-indigo-600 transition-colors">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="animate-fade-in-up bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden grid grid-cols-1 lg:grid-cols-3">
                <div class="lg:col-span-2 p-8">
                    <div class="flex items-center space-x-2 mb-4">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <h3 class="text-2xl font-black text-gray-900">{{ $partido->lugar }}</h3>
                    </div>
                    <div class="flex flex-wrap gap-6 text-gray-500 font-medium">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}
                        </div>
                    </div>
                    
                    <div id="mapa-partido" class="h-56 w-full mt-6 rounded-xl border border-gray-100 shadow-inner z-0"></div>
                </div>
                
                <div class="bg-gray-50 p-8 flex flex-col justify-center items-center text-center border-l border-gray-100">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Coste de Reserva</p>
                    <p class="text-5xl font-black text-indigo-600 mb-2">{{ number_format($partido->coste_pista, 2) }} €</p>
                    @if($partido->usuarios->count() > 0)
                        <p class="text-sm font-bold text-gray-500">
                            {{ number_format($partido->coste_pista / $partido->usuarios->count(), 2) }}€ por persona
                        </p>
                    @endif
                </div>
            </div>

            @if($clima)
                <div class="animate-fade-in-up delay-100 bg-white border border-gray-100 rounded-2xl p-6 flex items-center justify-between shadow-sm">
                    <div class="flex items-center space-x-4">
                        <div class="bg-indigo-50 rounded-full p-2">
                            <img src="https://openweathermap.org/img/wn/{{ $clima['weather'][0]['icon'] }}@2x.png" class="w-12 h-12">
                        </div>
                        <div>
                            <p class="text-xs font-black text-indigo-600 uppercase tracking-widest">Pronóstico Local</p>
                            <p class="text-gray-900 font-bold capitalize text-lg">{{ $clima['weather'][0]['description'] }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-4xl font-black text-gray-900">{{ round($clima['main']['temp']) }}°C</p>
                        <p class="text-xs text-gray-400 font-bold">Humedad: {{ $clima['main']['humidity'] }}%</p>
                    </div>
                </div>
            @endif

            <div class="animate-fade-in-up delay-200">
                @if($partido->cronica_cerrada)
                    <div class="bg-gray-900 rounded-3xl p-8 shadow-xl relative overflow-hidden">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        </div>
                        <div class="flex justify-around items-center relative z-10">
                            <div class="text-center">
                                <p class="text-indigo-400 text-xs font-black uppercase tracking-widest mb-2">Local</p>
                                <p class="text-2xl font-black text-white">{{ $equipo->nombre }}</p>
                            </div>
                            <div class="flex items-center space-x-4">
                                <span class="text-6xl font-black text-white tabular-nums">{{ $partido->goles_equipo }}</span>
                                <span class="text-gray-600 text-4xl font-light">-</span>
                                <span class="text-6xl font-black text-white tabular-nums">{{ $partido->goles_rival }}</span>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-500 text-xs font-black uppercase tracking-widest mb-2">Visitante</p>
                                <p class="text-2xl font-black text-gray-400">Rival</p>
                            </div>
                        </div>

                        @php $goleadores = $partido->usuarios()->wherePivot('goles', '>', 0)->get(); @endphp
                        @if($goleadores->count() > 0)
                            <div class="mt-8 pt-6 border-t border-gray-800 text-center">
                                <div class="flex flex-wrap justify-center gap-4">
                                    @foreach($goleadores as $goleador)
                                        <span class="bg-gray-800 text-gray-300 px-4 py-1.5 rounded-lg text-sm font-bold border border-gray-700">
                                            {{ $goleador->name }} ({{ $goleador->pivot->goles }} {{ $goleador->pivot->goles > 1 ? 'Goles' : 'Gol' }})
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    @php $esCapitan = $equipo->usuarios()->where('user_id', auth()->id())->first()?->pivot?->rol === 'capitan'; @endphp
                    @if($esCapitan)
                        <div class="bg-white border-2 border-indigo-600/20 rounded-2xl p-8 shadow-sm">
                            <h4 class="text-lg font-black text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Cerrar Acta del Partido
                            </h4>
                            <form action="{{ route('partidos.resultado', [$equipo->id, $partido->id]) }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid grid-cols-2 gap-8">
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $equipo->nombre }}</label>
                                        <input type="number" name="goles_equipo" min="0" value="0" class="w-full text-2xl font-black rounded-xl border-gray-200 focus:ring-indigo-500" required>
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest">Goles Rival</label>
                                        <input type="number" name="goles_rival" min="0" value="0" class="w-full text-2xl font-black rounded-xl border-gray-200 focus:ring-indigo-500" required>
                                    </div>
                                </div>

                                @if($partido->usuarios->count() > 0)
                                    <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Goles Individuales</p>
                                        <div class="space-y-3">
                                            @foreach($partido->usuarios as $jugador)
                                                <div class="flex justify-between items-center bg-white p-3 rounded-lg border border-gray-100">
                                                    <span class="font-bold text-gray-700">{{ $jugador->name }}</span>
                                                    <input type="number" name="goles_jugadores[{{ $jugador->id }}]" value="0" min="0" class="w-20 text-center rounded-lg border-gray-200 py-1">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-xl hover:bg-black transition shadow-lg tracking-widest uppercase text-sm">
                                    Finalizar y Publicar Acta
                                </button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in-up delay-300">
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h4 class="font-black text-gray-900 uppercase tracking-widest text-xs">Convocatoria Activa</h4>
                        <span class="bg-indigo-600 text-white text-[10px] font-black px-2 py-0.5 rounded">{{ $partido->usuarios->count() }} Confirmados</span>
                    </div>
                    <div class="p-6 flex-1">
                        @if(!$partido->cronica_cerrada)
                            <form action="{{ route('partidos.apuntarse', [$equipo->id, $partido->id]) }}" method="POST" class="mb-6">
                                @csrf
                                <button type="submit" class="w-full py-3 rounded-xl font-black text-sm uppercase tracking-widest transition {{ $partido->usuarios->contains(auth()->user()->id) ? 'bg-red-50 text-red-600 border border-red-100 hover:bg-red-100' : 'bg-indigo-600 text-white shadow-md hover:bg-indigo-700' }}">
                                    {{ $partido->usuarios->contains(auth()->user()->id) ? 'Abandonar Lista' : 'Confirmar Asistencia' }}
                                </button>
                            </form>
                        @endif
                        <ul class="space-y-3">
                            @foreach($partido->usuarios as $jugador)
                                <li class="flex items-center p-2 rounded-lg hover:bg-gray-50">
                                    <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center font-black text-gray-500 text-xs mr-3">
                                        {{ substr($jugador->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-700">{{ $jugador->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm flex flex-col">
                    <div class="p-6 border-b border-gray-50">
                        <h4 class="font-black text-gray-900 uppercase tracking-widest text-xs">Muro del Partido</h4>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="space-y-4 max-h-64 overflow-y-auto mb-6 pr-2">
                            @foreach($partido->comentarios()->with('user')->latest()->get() as $comentario)
                                <div class="bg-gray-50 p-4 rounded-xl relative">
                                    <div class="flex justify-between items-start mb-1">
                                        <span class="font-black text-indigo-600 text-xs">{{ $comentario->user->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $comentario->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-700 font-medium leading-relaxed">{{ $comentario->mensaje }}</p>
                                </div>
                            @endforeach
                        </div>
                        <form action="{{ route('partidos.comentar', [$equipo->id, $partido->id]) }}" method="POST" class="mt-auto">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" name="mensaje" class="flex-1 rounded-xl border-gray-100 bg-gray-50 focus:ring-indigo-500 text-sm font-medium" placeholder="Escribe al equipo..." required autocomplete="off">
                                <button type="submit" class="bg-indigo-600 text-white p-3 rounded-xl hover:bg-indigo-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let lugar = "{{ $partido->lugar }}";
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(lugar)}`)
                .then(r => r.json()).then(data => {
                    if (data && data.length > 0) {
                        let lat = data[0].lat, lon = data[0].lon;
                        let map = L.map('mapa-partido').setView([lat, lon], 15);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
                        L.marker([lat, lon]).addTo(map).bindPopup(`<b>${lugar}</b>`).openPopup();
                    } else {
                        document.getElementById('mapa-partido').style.display = 'none';
                    }
                });
        });
    </script>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>