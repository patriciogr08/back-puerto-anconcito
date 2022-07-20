<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CobroGaritaController;
use App\Http\Controllers\HistorialCobroGaritaController;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\MailController;

use Illuminate\Support\Facades\Route;

Route::apiResource('/clientes', ClienteController::class)->names('api.clientes');
Route::apiResource('/cobroGarita', CobroGaritaController::class)->names('api.cobroGarita');

Route::get('/parametros/obtenerLista/{codigo}', [ParametroController::class, 'obtenerLista'])->name('api.parametro.obtenerListaParametros');
Route::post('/historialCobroGarita/aperturarTurnoCobro', [HistorialCobroGaritaController::class, 'aperturarTurnoCobro'])->name('api.historialCobroGarita.aperturarTurnoCobro');
Route::post('/historialCobroGarita/valoresTurno', [HistorialCobroGaritaController::class, 'valoresTurno'])->name('api.historialCobroGarita.valoresTurno');
Route::post('/historialCobroGarita/cerrarTurnoCorbo', [HistorialCobroGaritaController::class, 'cerrarTurnoCorbo'])->name('api.historialCobroGarita.cerrarTurnoCorbo');


/**
 * RUTA PARA ENVIAR CORREO CON SERVICIO SENDINBLUE
 */
Route::post('/correo/sendinblue', [MailController::class, 'enviarCorreo'])->name('api.v1.correo.sendinblue.enviarCorreo');
