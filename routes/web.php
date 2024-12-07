<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Middleware\LoadUserPermissions;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\TipoVehiculoController;
use App\Http\Controllers\GrupoVehiculoController;
use App\Http\Controllers\MarcaVehiculoController;
use App\Http\Controllers\AccesorioVehiculoController;
use App\Http\Controllers\GraficoVehiculoController;
use App\Http\Controllers\ModeloVehiculoController;
use App\Http\Controllers\RegistroVehiculoController;
use App\Http\Controllers\EquipamientoVehiculoController;
use App\Http\Controllers\TarifaController;
use App\Http\Controllers\TarifaCombustibleController;
use App\Http\Controllers\ExtraClienteController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteEmpresaController;
use App\Http\Controllers\ClienteParticularController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ValidatorClienteController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TipoCarnetController;
use App\Http\Controllers\CanalventaController;
use App\Http\Controllers\Auth\LoginController;

// Ruta principal
Route::get('/', function () {
    return redirect()->route('login'); // Cambia 'login' por el nombre de tu ruta de login
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    LoadUserPermissions::class,
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // Rutas de registro

    Route::resource('usergroups', UserGroupController::class);
    Route::get('usergroups/create', [UserGroupController::class, 'create'])->name('usergroups.create');
    Route::resource('tipovehiculo', TipoVehiculoController::class);
    Route::resource('grupovehiculo', GrupoVehiculoController::class);
    Route::resource('marcavehiculo', MarcaVehiculoController::class);
    Route::resource('accesoriovehiculo', AccesorioVehiculoController::class);
    Route::resource('equipamientovehiculo', EquipamientoVehiculoController::class);
    Route::resource('graficovehiculo', GraficoVehiculoController::class);
    Route::resource('modelovehiculo', ModeloVehiculoController::class);

    Route::put('/modelovehiculo/{id}', [ModeloVehiculoController::class, 'update'])->name('modelovehiculo.update');
    Route::get('/modelovehiculo/{id}/edit', [ModeloVehiculoController::class, 'edit'])->name('modelovehiculo.edit');
    Route::resource('registrovehiculo', RegistroVehiculoController::class);
    Route::put('/registrovehiculo/{id}', [RegistroVehiculoController::class, 'update'])->name('registrovehiculo.update');
    Route::get('/registrovehiculo/{id}/edit', [RegistroVehiculoController::class, 'edit'])->name('registrovehiculo.edit');
    Route::delete('/delete-file/{file}', [RegistroVehiculoController::class, 'deleteFile'])->name('deleteFile');
    Route::resource('llavevehiculo', QrCodeController::class);
    Route::get('/llavevehiculo/{id}/edit', [QrCodeController::class, 'edit'])->name('llavevehiculo.edit');
    Route::put('/llavevehiculo/{id}', [QrCodeController::class, 'update'])->name('llavevehiculo.update');
    Route::get('/llavevehiculo/etiqueta/{id}', [QrCodeController::class, 'showEtiqueta'])->name('llavevehiculo.showEtiqueta');



    Route::resource('tarifas', TarifaController::class);
    Route::resource('tarifacombustible', TarifaCombustibleController::class);
    Route::resource('extracliente', ExtraClienteController::class);

    Route::resource('users', UserController::class);
    Route::get('/users/data/{id}', [UserController::class, 'getUserData']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::resource('clientesempresa', ClienteEmpresaController::class);
    Route::get('/get-ciudades', [ClienteEmpresaController::class, 'getCiudadesByPais'])->name('getCiudadesByPais');
    Route::put('/clientesempresa/{user}', [ClienteEmpresaController::class, 'update']);
    Route::get('/clientesempresa/data/{id}', [ClienteEmpresaController::class, 'getUserData']);
    Route::resource('clientesparticular', ClienteParticularController::class);
    Route::get('/get-ciudades2', [ClienteParticularController::class, 'getCiudadesByPais2'])->name('getCiudadesByPais2');
    Route::put('/clientesparticular/{user}', [ClienteParticularController::class, 'update']);
    Route::get('/clientesparticular/data/{id}', [ClienteParticularController::class, 'getUserData2']);
    Route::resource('proveedores', ProveedorController::class);
    Route::get('/get-ciudades3', [ProveedorController::class, 'getCiudadesByPais3'])->name('getCiudadesByPais3');
    Route::put('/proveedores/{user}', [ProveedorController::class, 'update']);
    Route::get('/proveedores/data/{id}', [ProveedorController::class, 'getUserData2']);
    Route::resource('surcursales', SucursalController::class);
    Route::resource('tipocarnet', TipoCarnetController::class);
    Route::resource('canalventa', CanalventaController::class);
    Route::get('/tarifas2', [TarifaController::class, 'getTarifasBySucursal'])->name('getTarifasBySucursal');;
});
Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('forgot-password', [PasswordResetController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
Route::get('/send-test-email', [TestController::class, 'sendTestEmail']);
