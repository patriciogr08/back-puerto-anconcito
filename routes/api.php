<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobroGaritaController;
use App\Http\Controllers\ControlEmpleadosController;
use App\Http\Controllers\HistorialCobroGaritaController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/clientes', ClienteController::class)->names('api.clientes');
Route::apiResource('/cobroGarita', CobroGaritaController::class)->names('api.cobroGarita');
Route::apiResource('/users', UserController::class)->names('api.users');
Route::apiResource('/controlEmpleados', ControlEmpleadosController::class)->names('api.controlEmpleados');
Route::apiResource('/parametros', ParametroController::class)->names('api.parametros');
Route::apiResource('/roles', RoleController::class)->names('api.roles');

Route::get('/parametros/obtenerLista/{codigo}', [ParametroController::class, 'obtenerLista'])->name('api.parametros.obtenerListaParametros');
Route::get('/parametros/lista/obtenerPadres', [ParametroController::class, 'obtenerPadres'])->name('api.parametros.obtenerPadres');
Route::get('/clientes/buscarCliente/{identificacion}', [ClienteController::class, 'buscarCliente'])->name('api.clientes.buscarCliente');
Route::get('/controlEmpleados/usuarios/obtenerUsuarios', [ControlEmpleadosController::class, 'obtenerUsuarios'])->name('api.controlEmpleados.obtenerUsuarios');

Route::post('/historialCobroGarita/aperturarTurnoCobro', [HistorialCobroGaritaController::class, 'aperturarTurnoCobro'])->name('api.historialCobroGarita.aperturarTurnoCobro');
Route::post('/historialCobroGarita/valoresTurno', [HistorialCobroGaritaController::class, 'valoresTurno'])->name('api.historialCobroGarita.valoresTurno');
Route::post('/historialCobroGarita/cerrarTurnoCorbo', [HistorialCobroGaritaController::class, 'cerrarTurnoCorbo'])->name('api.historialCobroGarita.cerrarTurnoCorbo');

Route::post('/parametros/crear/Hijo', [ParametroController::class, 'storeHijo'])->name('api.parametros.storeHijo');
Route::post('/parametros/crear/Padre', [ParametroController::class, 'storePadre'])->name('api.parametros.storePadre');

Route::put('/users/asignarRol/{user}', [UserController::class, 'asignarRol'])->name('api.users.asignarRol');
Route::put('/users/removerRol/{user}', [UserController::class, 'removerRol'])->name('api.users.removerRol');


/**
 * RUTA PARA ENVIAR CORREO CON SERVICIO SENDINBLUE
 */
Route::post('/correo/sendinblue', [MailController::class, 'enviarCorreo'])->name('api.v1.correo.sendinblue.enviarCorreo');
   