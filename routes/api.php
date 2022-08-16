<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin', [AdminController::class,'index']);
Route::post('/admin', [AdminController::class, 'store']);
Route::get('/admin/{id}', [AdminController::class, 'edit']);
Route::put('/admin/update/{id}', [AdminController::class, 'update']);
Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy']);

Route::get('/berita', [BeritaController::class,'index']);
Route::post('/berita', [BeritaController::class, 'store']);
Route::get('/berita/{id}', [BeritaController::class, 'edit']);
Route::put('/berita/update/{id}', [BeritaController::class, 'update']);
Route::delete('/berita/delete/{id}', [BeritaController::class, 'destroy']);
