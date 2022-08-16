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

Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/admin', [AdminController::class, 'index']);
Route::middleware('auth:sanctum')->post('/admin', [AdminController::class, 'store']);
Route::middleware('auth:sanctum')->get('/admin/{id}', [AdminController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/admin/update/{id}', [AdminController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/admin/delete/{id}', [AdminController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/berita', [BeritaController::class, 'index']);
Route::middleware('auth:sanctum')->post('/berita', [BeritaController::class, 'store']);
Route::middleware('auth:sanctum')->get('/berita/{id}', [BeritaController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/berita/update/{id}', [BeritaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/berita/delete/{id}', [BeritaController::class, 'destroy']);
