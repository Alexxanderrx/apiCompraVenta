<?php

use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraDetallesController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\TransaccionController;
use App\Http\Controllers\VentaDetallesController;
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

Route::get('/venta', [VentaDetallesController::class, 'index']);
Route::get('/venta/{id}', [VentaDetallesController::class, 'getById']);
Route::post('/venta', [VentaDetallesController::class, 'create']);
Route::put('/venta/{id}', [VentaDetallesController::class, 'update']);
Route::delete('/venta/{id}', [VentaDetallesController::class, 'delete']);

Route::get('/compra', [CompraDetallesController::class, 'index']);
Route::get('/compra/{id}', [CompraDetallesController::class, 'getById']);
Route::post('/compra', [CompraDetallesController::class, 'create']);
Route::put('/compra/{id}', [CompraDetallesController::class, 'update']);
Route::delete('/compra/{id}', [CompraDetallesController::class, 'delete']);

Route::get('/articulo', [ArticuloController::class, 'index']);
Route::get('/articulo/{id}', [ArticuloController::class, 'getById']);
Route::post('/articulo', [ArticuloController::class, 'create']);
Route::put('/articulo/{id}', [ArticuloController::class, 'update']);
Route::delete('/articulo/{id}', [ArticuloController::class, 'delete']);