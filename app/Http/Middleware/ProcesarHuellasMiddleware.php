<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\HuellaService;

class ProcesarHuellasMiddleware
{
    protected $huellaSvc;

    public function __construct(HuellaService $huellaSvc)
    {
        $this->huellaSvc = $huellaSvc;
    }

    public function handle($request, Closure $next)
    {
        // Ejecuta la lógica antes de procesar la petición
        $this->huellaSvc->procesarNuevasHuellas();

        return $next($request);
    }
}
