<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full mx-auto sm:px-6 lg:px-8">
            <div class="animate-fade-in-up bg-white rounded-3xl shadow-xl border border-gray-100 p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-5">
                    <svg class="w-24 h-24 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                
                <div class="text-center mb-10 relative z-10">
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">Acceso a Vestuario</h2>
                    <p class="text-sm text-gray-500 mt-2">Introduce el token proporcionado por tu capitán</p>
                </div>

                <form action="{{ route('equipos.joinStore') }}" method="POST" class="space-y-6 relative z-10">
                    @csrf
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Token de Invitación</label>
                        <input type="text" name="codigo" id="codigo" required 
                               class="w-full rounded-2xl border-gray-200 bg-gray-50 py-4 px-6 focus:ring-indigo-500 font-mono text-center uppercase tracking-[0.3em] font-black text-2xl text-indigo-900"
                               placeholder="XXXX-XXXX">
                        @error('codigo')
                            <p class="text-red-500 text-xs font-bold mt-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-gray-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-black transition transform hover:-translate-y-1 tracking-widest uppercase text-sm">
                        Verificar y Acceder
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