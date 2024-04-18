<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ClipController extends Controller
{
    public function index()
    {
        // Define las fechas de inicio y fin para obtener las transacciones
        $from = '2024-02-22T00:00:00Z';
        $to = '2024-02-22T23:59:59Z';
        // Define el tamaño de la página (cantidad de resultados por página)
        $size = 100;

        // Define las credenciales de la API
        $apiKey = '16c730c3-02af-4c99-aa58-4a670d6bebea';
        $clave = 'e8cacb7e-2ffd-48d8-81f0-8cf4bd5eb3fc';

        // Genera el token de autorización
        $token = base64_encode($apiKey . ':' . $clave);

        // Realiza la solicitud GET a la API de Clip
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . '$token'
        ])->get('https://api.payclip.com/payment', [
            'from' => $from,
            'to' => $to,
            'size' => $size
        ]);

        dd($response);

        // Verifica si la solicitud fue exitosa
        if ($response->successful()) {
            // Obtiene los datos de las transacciones
            $transactions = $response->json()['results'];
            // Devuelve la vista con los datos de las transacciones
            return view('clip.index', ['transactions' => $transactions]);
        } else {
            // Si la solicitud falla, devuelve un mensaje de error
            return response()->json(['error' => 'Error al obtener las transacciones'], $response->status());
        }
    }
}
