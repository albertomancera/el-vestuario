<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-auto sm:px-6 lg:px-8">
            <div class="animate-fade-in-up bg-white rounded-3xl shadow-xl border border-gray-100 p-10 relative overflow-hidden">
                <div class="absolute top-0 left-0 p-6 opacity-5">
                    <svg class="w-24 h-24 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                
                <div class="text-center mb-10 relative z-10">
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Nuevo Equipo</h2>
                    <p class="text-sm text-gray-500 mt-2">Configura los datos base de tu plantilla</p>
                </div>

                <form action="{{ route('equipos.store') }}" method="POST" class="space-y-6 relative z-10">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Nombre de la Entidad</label>
                        <input type="text" name="nombre" id="nombre" required 
                               class="w-full rounded-2xl border-gray-200 bg-gray-50 py-4 px-6 focus:ring-indigo-500 font-bold text-gray-900"
                               placeholder="Ej: Rayo Vallecano TFG">
                    </div>

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">URL del Escudo (Opcional)</label>
                        <input type="text" name="escudo" id="escudo" 
                               class="w-full rounded-2xl border-gray-200 bg-gray-50 py-4 px-6 focus:ring-indigo-500 font-medium text-sm text-gray-600"
                               placeholder="https://ejemplo.com/escudo.png">
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1 tracking-widest uppercase text-sm mt-4">
                        Registrar Entidad
                    </button>
                    
                    <a href="{{ route('equipos.index') }}" class="block text-center text-xs font-bold text-gray-400 hover:text-indigo-600 transition uppercase tracking-widest mt-4">
                        Cancelar y Volver
                    </a>
                </form>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</x-app-layout>