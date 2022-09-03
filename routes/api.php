<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\empleadoController;
use App\Http\Controllers\usuarioController;
use App\Http\Controllers\historial_empController;

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

Route::group([
], function ($router) {
    Route::apiResource('empleado', empleadoController::class);
    //Route::apiResource('usuario', usuarioController::class);
    //Route::apiResource('historial_emp', historial_empController::class);
});
// route Usuario
Route::get('usuario/{usuario},{contrasena}', [usuarioController::class, 'verificarUsuario']);
Route::get('usuario/{id_usuario}', [usuarioController::class, 'show']);

// route historial_emp
Route::get('historial_emp/{id_usuario},{fecha}', [historial_empController::class, 'historialUsuario']);
Route::get('historial_emp/{id}', [historial_empController::class, 'show']);