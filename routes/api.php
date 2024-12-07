<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\RegistroVehiculoController;
use App\Http\Controllers\ReservaController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/perfil/{id}', [AuthController::class, 'getUserProfile']);
Route::put('/perfil/{id}', [AuthController::class, 'update']);
Route::get('/tipo-documentos', [AuthController::class, 'getUserDocumento']);
// Rutas API en Laravel
Route::get('/vehiculos-libres', [RegistroVehiculoController::class, 'vehiculosLibres']);
// Rutas para obtener sucursales en formato JSON
Route::get('/sucursales', [SucursalController::class, 'getAllSucursales']);

Route::post('/reservas', [ReservaController::class, 'store']);
Route::get('reservas/{userId}', [ReservaController::class, 'index']);
Route::delete('reservas/{id}', [ReservaController::class, 'destroy']);
Route::put('reservas/{id}', [ReservaController::class, 'update']);
