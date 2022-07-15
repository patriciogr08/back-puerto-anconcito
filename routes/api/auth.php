<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('api.auth.logout');
