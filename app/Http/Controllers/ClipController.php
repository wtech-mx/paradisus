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

            // Define el rango de fechas
            $from = '2024-04-18T00:00:00Z';
            $to = '2024-04-18T23:59:59Z';

            // Realiza la solicitud GET a la API de Clip
            $client = new Client();

            $response =  $client->request('GET', 'https://api.payclip.com/payments', [
                'headers' => [
                    'Authorization' => 'Basic '.$token,
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

            return view('clip.index', ['data' => $data]);


    }
}
