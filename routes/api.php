<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\NotasPedidos;

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


Route::get('/enviar-notas-pedidos', function () {
    // Traer los registros de la tabla NotasPedidos y ordenarlos por id
    $notas_pedidos = NotasPedidos::orderBy('id', 'DESC')->get();

    // Retornar los datos en formato JSON
    return response()->json([
        'success' => true,
        'message' => 'Datos enviados correctamente',
        'data' => $notas_pedidos
    ]);
});
