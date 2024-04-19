<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ClipController extends Controller
{
    public function index()
    {
        // Define las credenciales de la API
        $apiKey = '23bb7433-1bae-4f0d-92f9-dc96990a8efb';
        $clave = 'd9a61a7b-2658-41d2-96b8-f6d235dfb5e9';

        // Genera el token de autorización
        $token = base64_encode($apiKey . ':' . $clave);

        // Define el rango de fechas de la semana actual
        $firstDayOfWeek = date('Y-m-d', strtotime('monday this week')) . 'T00:00:00Z';
        $lastDayOfWeek = date('Y-m-d', strtotime('sunday this week')) . 'T23:59:59Z';

        // Realiza la solicitud GET a la API de Clip
        $client = new Client();

        $response = $client->request('GET', 'https://api.payclip.com/payments', [
            'headers' => [
                'Authorization' => 'Basic ' . $token,
                'accept' => 'application/json',
            ],
            'query' => [
                'from' => $firstDayOfWeek,
                'to' => $lastDayOfWeek,
            ],
        ]);

        $body = $response->getBody();

        // Decodificar el cuerpo si es JSON
        $data = json_decode($body, true);

        // Ordenar los resultados por fecha de la más reciente a la más antigua
        usort($data['results'], function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return view('clip.index', ['data' => $data]);
    }

    public function buscador(Request $request) {
        // Define las credenciales de la API
        $apiKey = '23bb7433-1bae-4f0d-92f9-dc96990a8efb';
        $clave = 'd9a61a7b-2658-41d2-96b8-f6d235dfb5e9';

        // Genera el token de autorización
        $token = base64_encode($apiKey . ':' . $clave);

        // Define el rango de fechas de la semana actual

        $from = $request->get('fecha_inicio'). 'T00:00:00Z';;
        $to = $request->get('fecha_fin').'T23:59:59Z';

        // Realiza la solicitud GET a la API de Clip
        $client = new Client();

        $response = $client->request('GET', 'https://api.payclip.com/payments', [
            'headers' => [
                'Authorization' => 'Basic ' . $token,
                'accept' => 'application/json',
            ],
            'query' => [
                'from' => $from,
                'to' => $to,
            ],
        ]);

        $body = $response->getBody();

        // Decodificar el cuerpo si es JSON
        $data = json_decode($body, true);

        // Ordenar los resultados por fecha de la más reciente a la más antigua
        usort($data['results'], function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return view('clip.index', ['data' => $data]);
    }
}
