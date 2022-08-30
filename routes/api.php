<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KomplainController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StatusKomplainController;
use App\Http\Controllers\SukaController;
use App\Http\Controllers\BalasanController;
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

Route::post('/sanctum/token', [LoginController::class, 'login'])->name('login.token');
Route::post('/admin/login', [\App\Http\Controllers\Auth\LoginAdminController::class, 'login'])->name('admin.login');
Route::get('/penduduk-search/{nik}', [PendudukController::class, 'searchPendudukByNik']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/admin', [AdminController::class, 'index']);
Route::middleware('auth:sanctum')->post('/admin', [AdminController::class, 'store']);
Route::middleware('auth:sanctum')->get('/admin/{id}', [AdminController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/admin/update/{id}', [AdminController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/admin/delete/{id}', [AdminController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/berita', [BeritaController::class, 'index']);
Route::middleware('auth:sanctum')->post('/berita', [BeritaController::class, 'store']);
Route::middleware('auth:sanctum')->post('/berita-balasan', [BeritaController::class, 'addBalasan']);
Route::middleware('auth:sanctum')->get('/berita-balasan/{id}', [BeritaController::class, 'getBalasan']);
Route::middleware('auth:sanctum')->get('/berita/{id}', [BeritaController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/berita/update/{id}', [BeritaController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/berita/delete/{id}', [BeritaController::class, 'destroy']);

Route::get('/penduduk', [PendudukController::class, 'index']);
Route::post('/penduduk', [PendudukController::class, 'store']);
Route::get('/penduduk/{id}', [PendudukController::class, 'edit']);
Route::put('/penduduk/update/{id}', [PendudukController::class, 'update']);
Route::delete('/penduduk/delete/{id}', [PendudukController::class, 'destroy']);

Route::get('/pengguna', [PenggunaController::class, 'index']);
Route::post('/pengguna', [PenggunaController::class, 'store']);
Route::get('/pengguna/{id}', [PenggunaController::class, 'edit']);
Route::put('/pengguna/update/{id}', [PenggunaController::class, 'update']);
Route::delete('/pengguna/delete/{id}', [PenggunaController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/komplain', [KomplainController::class, 'index']);
Route::middleware('auth:sanctum')->post('/komplain', [KomplainController::class, 'store']);
Route::middleware('auth:sanctum')->get('/komplain/{id}', [KomplainController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/komplain/update/{id}', [KomplainController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/komplain/delete/{id}', [KomplainController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/komplain/by/{kategori}', [KomplainController::class, 'getKomplainByKategori']);

Route::middleware('auth:sanctum')->get('/status-komplain', [StatusKomplainController::class, 'index']);
Route::middleware('auth:sanctum')->post('/status-komplain', [StatusKomplainController::class, 'store']);
Route::middleware('auth:sanctum')->get('/status-komplain/{id}', [StatusKomplainController::class, 'edit']);
Route::middleware('auth:sanctum')->put('/status-komplain/update/{id}', [StatusKomplainController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/status-komplain/delete/{id}', [StatusKomplainController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/suka', [SukaController::class, 'index']);
Route::middleware('auth:sanctum')->get('/status-suka/{id}', [SukaController::class, 'checkStatusLike']);
Route::middleware('auth:sanctum')->post('/suka', [SukaController::class, 'store']);
Route::middleware('auth:sanctum')->get('/suka/{id}', [SukaController::class, 'edit']);

Route::middleware('auth:sanctum')->get('/balasan/{idKomplain}', [BalasanController::class, 'index']);
Route::middleware('auth:sanctum')->post('/balasan', [BalasanController::class, 'store']);
Route::middleware('auth:sanctum')->get('/balasan/edit/{id}', [BalasanController::class, 'edit']);
