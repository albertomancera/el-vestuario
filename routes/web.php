<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;

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

Route::resource('equipos', EquipoController::class)->middleware(['auth', 'verified']);