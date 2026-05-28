<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PartidoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/equipos/unirse', [EquipoController::class, 'join'])->name('equipos.join')->middleware(['auth', 'verified']);
Route::post('/equipos/unirse', [EquipoController::class, 'joinStore'])->name('equipos.joinStore')->middleware(['auth', 'verified']);

// Rutas para los partidos de un equipo
Route::get('/equipos/{equipo}/partidos/crear', [PartidoController::class, 'create'])->name('partidos.create')->middleware(['auth', 'verified']);
Route::post('/equipos/{equipo}/partidos', [PartidoController::class, 'store'])->name('partidos.store')->middleware(['auth', 'verified']);
Route::get('/equipos/{equipo}/partidos/{partido}', [PartidoController::class, 'show'])->name('partidos.show')->middleware(['auth', 'verified']);
Route::post('/equipos/{equipo}/partidos/{partido}/apuntarse', [PartidoController::class, 'apuntarse'])->name('partidos.apuntarse')->middleware(['auth', 'verified']);
Route::get('/equipos/{equipo}/estadisticas', [EquipoController::class, 'estadisticas'])->name('equipos.estadisticas')->middleware(['auth', 'verified']);
Route::post('/equipos/{equipo}/partidos/{partido}/comentar', [PartidoController::class, 'comentar'])->name('partidos.comentar')->middleware(['auth', 'verified']);
Route::post('/equipos/{equipo}/partidos/{partido}/resultado', [PartidoController::class, 'guardarResultado'])->name('partidos.resultado')->middleware(['auth', 'verified']);

Route::resource('equipos', EquipoController::class)->middleware(['auth', 'verified']);