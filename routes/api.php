<?php

use App\Http\Controllers\AsientosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PeliculasControllador;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TarjetaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Authentication routes
Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/getId', [AuthController::class, 'getId']);

// Pelicula routes
Route::post('/insertarPelicula', [PeliculasControllador::class, 'insertarPelicula']);
Route::post('/insertarEstreno', [PeliculasControllador::class, 'insertarEstreno']);
Route::get('/peliculas', [PeliculasControllador::class, 'obtenerPeliculas']);
Route::get('/estrenos', [PeliculasControllador::class, 'obtenerEstrenos']);
Route::get('/peliculas/detalles', [PeliculasControllador::class, 'obtenerPeliculasConDetalles']);
Route::delete('/borrarPeliculas', [PeliculasControllador::class, 'borrarPeliculas']);
Route::delete('/borrarEstrenos', [PeliculasControllador::class, 'borrarEstrenos']);

// Asientos routes
Route::get('/asientos/{idPelicula}', [AsientosController::class, 'getAsientos']);
Route::post('/reservarAsientos', [AsientosController::class, 'reservarAsientos']);

// Reservas routes
// Ruta para obtener las reservas de un usuario
Route::middleware('auth:sanctum')->get('/reservasPorUsuario', [ReservaController::class, 'getReservasPorUsuario']);
Route::get('pelicula/{idPelicula}', [ReservaController::class, 'getPeliculaPorId']);


// Ruta para cancelar una reserva
Route::middleware('auth:sanctum')->post('/cancelarReserva/{id}', [ReservaController::class, 'cancelarReserva']);

Route::middleware('auth:api')->group(function () {
    Route::get('/reservas/{usuarioId}', [ReservaController::class, 'obtenerReservas']);
});

Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'getUserProfile']);



Route::middleware('auth:sanctum')->group(function () {
    // Rutas para las tarjetas
    Route::post('/tarjetas', [TarjetaController::class, 'store']);
    Route::get('/tarjetas/{userId}', [TarjetaController::class, 'getTarjetasPorUsuario']);
    Route::delete('/tarjetas/{tarjetaId}', [TarjetaController::class, 'deleteTarjeta']);
});




