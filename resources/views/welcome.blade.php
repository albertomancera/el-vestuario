<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma de Gestión Deportiva</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,700,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 selection:bg-indigo-500 selection:text-white">

    <nav class="absolute top-0 left-0 w-full z-50 px-6 py-6 sm:px-12 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center shadow-lg transform -rotate-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
            </div>
            <span class="font-black text-xl tracking-tight text-gray-900">SportManager</span>
        </div>

        @if (Route::has('login'))
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ url('/equipos') }}" class="font-bold text-sm text-gray-700 hover:text-indigo-600 transition">
                        Ir a mi Panel &rarr;
                    </a>
                @else
                    <a href="{{ route('login') }}" class="font-bold text-sm text-gray-600 hover:text-indigo-600 transition">
                        Acceder
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-gray-900 text-white px-5 py-2.5 rounded-xl font-bold text-sm hover:bg-black transition shadow-md transform hover:-translate-y-0.5 hidden sm:inline-block">
                            Crear Cuenta
                        </a>
                    @endif
                @endauth
            </div>
        @endif
    </nav>

    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <svg class="absolute right-0 top-0 transform translate-x-1/3 -translate-y-1/4 text-indigo-50 opacity-50 w-3/4 h-auto pointer-events-none" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                <circle cx="50" cy="50" r="50" />
            </svg>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 sm:px-12 text-center">
            <div class="animate-fade-in-up">
                <span class="bg-indigo-100 text-indigo-700 text-xs font-black px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 inline-block border border-indigo-200 shadow-sm">
                    Plataforma de Gestión Integral
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-gray-900 tracking-tighter mb-8 leading-tight">
                    Tu vestuario deportivo, <br class="hidden md:block">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">
                        llevado al siguiente nivel.
                    </span>
                </h1>
                <p class="mt-4 max-w-2xl text-lg md:text-xl text-gray-500 mx-auto font-medium mb-10 leading-relaxed">
                    Organiza partidos, gestiona presupuestos de pistas, consulta pronósticos meteorológicos en tiempo real y controla la asistencia de tu plantilla desde un único panel corporativo.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black shadow-lg hover:bg-indigo-700 hover:shadow-xl transition transform hover:-translate-y-1 tracking-widest uppercase text-sm">
                        Comenzar ahora
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-white text-gray-900 border border-gray-200 px-8 py-4 rounded-2xl font-black shadow-sm hover:bg-gray-50 transition tracking-widest uppercase text-sm">
                        Ya tengo cuenta
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 sm:px-12">
            <div class="text-center mb-16 animate-fade-in-up delay-100">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Tecnología al servicio del deporte</h2>
                <p class="mt-4 text-gray-500 font-medium">Herramientas profesionales integradas en tu día a día.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition transform hover:-translate-y-1 animate-fade-in-up delay-100">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 mb-3">Geolocalización</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">Integración total con mapas interactivos para ubicar con precisión las instalaciones deportivas de cada convocatoria.</p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition transform hover:-translate-y-1 animate-fade-in-up delay-200">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 mb-3">Datos Meteorológicos</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">Consumo de APIs externas en tiempo real para anticipar el pronóstico del clima antes de cada encuentro.</p>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 hover:shadow-lg transition transform hover:-translate-y-1 animate-fade-in-up delay-300">
                    <div class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-gray-900 mb-3">Gestión de Roles</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">Sistema de permisos avanzado. División de gastos automatizada y control de actas exclusivo para capitanes.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 py-10 text-center border-t border-gray-800">
        <p class="text-gray-500 text-sm font-medium">
            &copy; {{ date('Y') }} Desarrollo de Aplicación de Gestión Deportiva.
        </p>
    </footer>

    <style>
        .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.8s ease-out forwards; }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</body>
</html>