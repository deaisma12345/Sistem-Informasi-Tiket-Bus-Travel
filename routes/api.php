<?php

use App\Http\Controllers\Api\categoryController;
use App\Http\Controllers\Api\pemesananController;
use App\Http\Controllers\Api\ruteController;
use App\Http\Controllers\Api\transportasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('transportasi', [transportasiController::class, 'index']);
Route::get('transportasi/{id}', [transportasiController::class, 'show']);
Route::post('transportasi', [transportasiController::class, 'store']);
Route::put('transportasi/{id}', [transportasiController::class, 'update']);
Route::delete('transportasi/{id}', [transportasiController::class, 'destroy']);

Route::get('category', [categoryController::class, 'index']);
Route::get('category/{id}', [categoryController::class, 'show']);
Route::post('category', [categoryController::class, 'store']);
Route::put('category/{id}', [categoryController::class, 'update']);
Route::delete('category/{id}', [categoryController::class, 'destroy']);

Route::get('pemesanan', [pemesananController::class, 'index']);
Route::get('pemesanan/{id}', [pemesananController::class, 'show']);
Route::post('pemesanan', [pemesananController::class, 'store']);
Route::put('pemesanan/{id}', [pemesananController::class, 'update']);
Route::delete('pemesanan/{id}', [pemesananController::class, 'destroy']);

Route::get('rute', [ruteController::class, 'index']);
Route::get('rute/{id}', [ruteController::class, 'show']);
Route::post('rute', [ruteController::class, 'store']);
Route::put('rute/{id}', [ruteController::class, 'update']);
Route::delete('rute/{id}', [ruteController::class, 'destroy']);
