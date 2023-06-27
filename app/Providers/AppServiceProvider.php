<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Configuracion;
use Illuminate\Support\ServiceProvider;
use DateTime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $configuracion = Configuracion::first();

            $fechaActual = date('Y-m-d');

            $clients = Client::orderBy('id','DESC')->get();


            // Obtener el mes actual
            $mesActual = date('m');

            // Obtener el año actual
            $añoActual = date('Y');

            // Crear una instancia del objeto DateTime para el primer día del mes actual
            $primerDiaMes = new DateTime("$añoActual-$mesActual-01");

            // Obtener el último día del mes actual
            $ultimoDiaMes = new DateTime($primerDiaMes->format('Y-m-t'));

            // Contador de miércoles
            $contadorMiercoles = 0;

            // Iterar desde el primer día hasta el último día del mes
            while ($primerDiaMes <= $ultimoDiaMes) {
                // Verificar si el día actual es miércoles (formato 'N': 1 para lunes, 2 para martes, etc.)
                if ($primerDiaMes->format('N') == 3) {
                    $contadorMiercoles++;
                }

                // Avanzar al siguiente día
                $primerDiaMes->modify('+1 day');
            }


            $view->with(['configuracion' => $configuracion, 'fechaActual' => $fechaActual, 'clients' => $clients,'contadorMiercoles' => $contadorMiercoles]);
        });
    }
}
