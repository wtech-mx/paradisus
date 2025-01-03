<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\NotasPedidos;
use App\Models\Pedido;

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
    // Definir los estatus que deseas filtrar
    $estatusPermitidos = ['Preparado', 'Enviado', 'Aprobada'];

    // Traer los registros de la tabla NotasPedidos con los estatus especificados y ordenarlos por id
    $notas_pedidos = NotasPedidos::with(['user', 'client','pedidos'])
        ->whereIn('estatus', $estatusPermitidos)
        ->orderBy('id', 'DESC')
        ->get();

    // Retornar los datos en formato JSON
    return response()->json([
        'success' => true,
        'message' => 'Datos enviados correctamente',
        'data' => $notas_pedidos
    ]);
});

Route::patch('/actualizar-notas-pedidos/{id}', function (Request $request, $id) {
    // Buscar el registro que se quiere actualizar
    $notaPedido = NotasPedidos::find($id);

    if (!$notaPedido) {
        return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
    }

    // Actualizar los campos con los datos recibidos desde Platform
    $notaPedido->update($request->all());

    // Responder con un mensaje de éxito
    return response()->json(['success' => true, 'message' => 'Registro actualizado correctamente']);
});

Route::patch('/actualizar-producto/{id}', function (Request $request, $producto_id) {
    // Buscar el registro que se quiere actualizar
    $notaPedido = Pedido::find($producto_id);

    if (!$notaPedido) {
        return response()->json(['success' => false, 'message' => 'Registro no encontrado'], 404);
    }

    if ($notaPedido->escaneados < $notaPedido->cantidad) {
        $notaPedido->escaneados = intval($notaPedido->escaneados) + 1; // Convierte escaneados a entero y suma 1
        if (intval($notaPedido->escaneados) === intval($notaPedido->cantidad)) { // Convierte cantidad a entero para comparar
            $notaPedido->estatus = 1; // Marca como completo
        }
            $notaPedido->update();
    }

    // Responder con un mensaje de éxito
    return response()->json(['success' => true, 'message' => 'Registro actualizado correctamente']);
});
