<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
            
            <div class="w-full sm:max-w-md animate-fade-in-up bg-white rounded-3xl shadow-xl border border-gray-100 p-10 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none">
                    <svg class="w-32 h-32 text-indigo-900" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
                </div>

                <div class="text-center mb-10 relative z-10">
                    <div class="w-16 h-16 bg-indigo-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg transform rotate-3 hover:rotate-0 transition duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 tracking-tight">
                        {{ request()->routeIs('register') ? 'Crear Cuenta' : 'Bienvenido' }}
                    </h2>
                    <p class="text-sm text-gray-500 mt-2 font-medium">
                        {{ request()->routeIs('register') ? 'Únete para gestionar tus equipos y partidos' : 'Accede a tu panel de gestión deportiva' }}
                    </p>
                </div>

                <div class="relative z-10">
                    {{ $slot }}
                </div>
                
            </div>
        </div>

        <style>
            .animate-fade-in-up { opacity: 0; animation: fadeInUp 0.6s ease-out forwards; }
            @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        </style>
    </body>
</html>