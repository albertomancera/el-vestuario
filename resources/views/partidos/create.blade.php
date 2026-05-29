<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-xl w-full mx-auto sm:px-6 lg:px-8">
            <div class="animate-fade-in-up bg-white rounded-3xl shadow-xl border border-gray-100 p-10">
                
                <div class="text-center mb-10">
                    <span class="bg-indigo-100 text-indigo-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block">
                        {{ $equipo->nombre }}
                    </span>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Nueva Convocatoria</h2>
                    <p class="text-sm text-gray-500 mt-2">Configura los detalles del próximo encuentro</p>
                </div>

                <form action="{{ route('partidos.store', $equipo->id) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Fecha</label>
                            <input type="date" name="fecha" required 
                                   class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 focus:ring-indigo-500 font-bold text-gray-700 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Hora</label>
                            <input type="time" name="hora" required 
                                   class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 focus:ring-indigo-500 font-bold text-gray-700 text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Instalación Deportiva</label>
                        <input type="text" name="lugar" required 
                               class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 focus:ring-indigo-500 font-bold text-gray-900"
                               placeholder="Ej. Polideportivo Municipal">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Coste de Reserva (€)</label>
                        <input type="number" step="0.01" name="coste_pista" required 
                               class="w-full rounded-xl border-gray-200 bg-gray-50 py-3 px-4 focus:ring-indigo-500 font-black text-indigo-600 text-xl"
                               placeholder="0.00">
                        <p class="text-xs font-bold text-gray-400 mt-2">El sistema dividirá este coste automáticamente entre los asistentes confirmados.</p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 flex flex-col space-y-4">
                        <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-xl shadow-md hover:bg-indigo-700 transition transform hover:-translate-y-1 tracking-widest uppercase text-sm">
                            Generar Convocatoria Oficial
                        </button>
                        <a href="{{ route('equipos.show', $equipo->id) }}" class="text-center text-xs font-bold text-gray-400 hover:text-indigo-600 transition uppercase tracking-widest">
                            Cancelar Operación
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>