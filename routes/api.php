<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\LoginController;

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
//Probar la API
Route::get('/prueba', [ApiController::class, 'prueba']); 
//Iniciar sesión
Route::post('/login', [LoginController::class, 'Login']);
//Cerrar sesión
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);
//Registro
Route::post('/register', [LoginController::class, 'register']);
//Obtener la lista de favoritos
Route::middleware('auth:sanctum')->get('/watchlists', [ApiController::class, 'getWatchlists']);
//Agregar a favoritos
Route::middleware('auth:sanctum')->post('/watchlists', [ApiController::class, 'addWatchlist']);
//Eliminar de favoritos
Route::middleware('auth:sanctum')->delete('/watchlists/{imdbId}', [ApiController::class, 'deleteWatchlist']);
//Obtener un favorito específico
Route::middleware('auth:sanctum')->get('/watchlists/{media_type}/{imdbId}', [ApiController::class, 'getWatchlistId']);
