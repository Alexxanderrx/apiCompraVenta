<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\TransaccionController;
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

Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/cliente/{id}', [ClienteController::class, 'getById']);
Route::post('/cliente', [ClienteController::class, 'create']);
Route::put('/cliente/{id}', [ClienteController::class, 'update']);
Route::delete('/cliente/{id}', [ClienteController::class, 'delete']);

Route::get('/trabajador', [TrabajadorController::class, 'index']);
Route::get('/trabajador/{id}', [TrabajadorController::class, 'getById']);
Route::post('/trabajador', [TrabajadorController::class, 'create']);
Route::put('/trabajador/{id}', [TrabajadorController::class, 'update']);
Route::delete('/trabajador/{id}', [TrabajadorController::class, 'delete']);

Route::get('/transaccion', [TransaccionController::class, 'index']);
Route::get('/transaccion/{id}', [TransaccionController::class, 'getById']);
Route::post('/transaccion', [TransaccionController::class, 'create']);
Route::put('/transaccion/{id}', [TransaccionController::class, 'update']);
Route::delete('/transaccion/{id}', [TransaccionController::class, 'delete']);
