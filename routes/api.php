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
Route::get('usuario/', [usuarioController::class, 'index']);
Route::post('usuario/', [usuarioController::class, 'store']);
Route::get('usuario/{id_usuario}', [usuarioController::class, 'show']);
Route::put('usuario/{id_usuario}', [usuarioController::class, 'update']);
Route::delete('usuario/{id_usuario}', [usuarioController::class, 'destroy']);


// route historial_emp
Route::get('historial_emp/{id_usuario},{fecha}', [historial_empController::class, 'historialUsuario']);
Route::get('historial_emp/', [historial_empController::class, 'index']);
Route::post('historial_emp/', [historial_empController::class, 'store']);
Route::get('historial_emp/{id', [historial_empController::class, 'show']);
Route::put('historial_emp/{id_historial_emp}', [historial_empController::class, 'update']);
Route::delete('historial_emp/{id_historial_emp}', [historial_empController::class, 'destroy']);