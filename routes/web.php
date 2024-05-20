<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TallerController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectoFotoController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('talleres', TallerController::class);
    Route::get('talleres/{id}/citas', [TallerController::class, 'citas'])->name('talleres.citas');
    Route::get('citas/create', [CitaController::class, 'create'])->name('citas.create');
    Route::post('citas', [CitaController::class, 'store'])->name('citas.store');
    Route::resource('servicios', ServicioController::class);
    Route::post('calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
});
