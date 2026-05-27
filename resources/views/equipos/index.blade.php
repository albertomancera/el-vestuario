<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Equipos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6 flex space-x-4">
                <a href="{{ route('equipos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 font-bold transition">
                    + Crear Equipo
                </a>
                <a href="{{ route('equipos.join') }}" class="bg-gray-800 text-white px-4 py-2 rounded shadow hover:bg-gray-900 font-bold transition">
                    Unirse con Código
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($equipos->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">Aún no perteneces a ningún equipo.</p>
                            <p class="text-sm text-gray-400">¡Crea uno nuevo o usa un código de invitación para unirte al vestuario de tus amigos!</p>
                        </div>
                    @else
                        <ul class="divide-y divide-gray-200">
                            @foreach($equipos as $equipo)
                                <li class="py-4 flex justify-between items-center hover:bg-gray-50 px-2 rounded transition">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                                            {{ substr($equipo->nombre, 0, 1) }}
                                        </div>
                                        <span class="font-bold text-lg">{{ $equipo->nombre }}</span>
                                    </div>
                                    <a href="{{ route('equipos.show', $equipo->id) }}" class="text-blue-600 font-semibold hover:underline">
                                        Entrar al vestuario &rarr;
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>