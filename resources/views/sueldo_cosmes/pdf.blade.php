<!doctype html>
<html lang="en">

<head>
  <style>
    body{
      font-family: sans-serif;
    }

    @page {
      margin: 160px 50px;
    }

    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 100px;
      background-color: #CA87A6;
      color: #fff;
      text-align: center;
    }

    header h1{
      margin: 10px 0;
    }

    header h2{
      margin: 0 0 10px 0;
    }

    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #CA87A6;
    }

    footer .page:after {
      content: counter(page);
    }

    footer table {
      width: 100%;
    }

    footer p {
      text-align: right;
    }

    footer .izq {
      text-align: left;
    }

    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border-radius: 6px;

    }

    td, th {
    text-align: center;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #F7EAED;
    }



  </style>
<body>
  <header>
    <h1>Sueldo <br> {{$cosme->name}}</h1>
  </header>

  <footer>
    <table>
      <tr>
        <td>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>

  <div id="content">
    <div class="row">

        <div class="col-12 mb-3 mt-3">
            <h3 class="">Tabla de Sueldo de la semana - {{ \Carbon\Carbon::parse($fechaInicioSemana)->format('d \d\e F \d\e\l Y') }}</h3>
        </div>
        <table class="table table-flush" id="historial">
            <thead class="thead">
                <tr style="background: #CA87A6; color: #fff">
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Comision</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @php
                        $totalBono = 0;
                        $totalSueldo = 0;
                        $totalCubierta = 0;
                        $totalNotas = 0;
                        $totalPaquetes = 0;
                        $totalGeneral = 0;
                        $totalcosmessum = 0;
                        $totalIngresos = 0;
                        $totalDescuentos = 0;
                        $sumaTotales = 0;
                        $sumaServicios = 0;
                        $sumaPedidos = 0;
                        $comision = 0;
                        $totalBonoComida = 0;
                        $paqueteFac = 0;

                        // Calcular la suma de totales
                        foreach ($notasPedidos as $notaPedido) {
                            if ($cosme->id == $notaPedido->id_user) {
                                $sumaPedidos += $notaPedido->total;
                            }
                        }

                        foreach ($notasServicios as $notaServicio) {
                            if ($cosme->id == $notaServicio->NotasCosmes->id_user) {
                                $sumaServicios += $notaServicio->primer_pago;
                            }
                        }

                        $sumaTotales = $sumaPedidos + $sumaServicios;

                        // Calcular la comisión según la lógica proporcionada
                        if ($sumaTotales >= 2000 && $sumaTotales < 3000) {
                            $comision = $sumaTotales * 0.03;
                        } elseif ($sumaTotales >= 3000 && $sumaTotales < 4000) {
                            $comision = $sumaTotales * 0.05;
                        } elseif ($sumaTotales >= 4000 && $sumaTotales < 7000) {
                            $comision = $sumaTotales * 0.06;
                        } elseif ($sumaTotales >= 7000 && $sumaTotales < 8000) {
                            $comision = $sumaTotales * 0.07;
                        } elseif ($sumaTotales >= 8000 && $sumaTotales < 9000) {
                            $comision = $sumaTotales * 0.08;
                        } elseif ($sumaTotales >= 9000 && $sumaTotales < 10000) {
                            $comision = $sumaTotales * 0.09;
                        } elseif ($sumaTotales >= 10000) {
                            $comision = $sumaTotales * 0.10;
                        }
                    @endphp
                    @foreach ($paquetesFaciales as $notaServicio)
                        @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                        @php
                            $paqueteFac = 350;
                        @endphp
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                            <td>Paquete Facial Vendido: #{{$notaServicio->id}}</td>
                            <td><b>$350</b></td>
                            <td></td>
                        </tr>
                        @endif
                    @endforeach
                    @foreach ($paquetes as $paquete)
                        @if ($cosme->id == $paquete->id_cosme)
                        @php
                            $totalBonoComida = 130;
                        @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($paquete->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                <td>Bono de comida</td>
                                <td>$130</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($registroSueldoSemanal as $puntualidad)
                        @if ($cosme->id == $puntualidad->id_cosme)
                        @php
                            $totalBono = 150;
                        @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($puntualidad->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                <td>Bono de puntualidad</td>
                                <td>$150</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($registros_sueldo as $sueldo_base)
                        @php
                            $totalSueldo += $sueldo_base->monto_pago;
                        @endphp

                            <tr>
                                <td>{{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                @if ($sueldo_base->monto_pago == '1000')
                                    <td>Sueldo base <br> + Comision</td>
                                @elseif($sueldo_base->cosmetologo_cubriendo != NULL)
                                    <td>Se cubrio a: <br> {{$sueldo_base->cosmetologoCubriendo->name}}</td>
                                @else
                                    <td>Sueldo base</td>
                                @endif
                                <td>${{$sueldo_base->monto_pago}}</td>
                                <td>Hr Entrada: {{ \Carbon\Carbon::parse($sueldo_base->hora_inicio)->format('h A') }} <br>
                                    Hr Salida: {{ \Carbon\Carbon::parse($sueldo_base->hora_fin)->format('h A') }} <br>
                                <b> Hrs Trabajadas: {{$sueldo_base->horas_trabajadas}}</b>
                                </td>
                            </tr>
                    @endforeach
                    @foreach ($paquetes_vendidos as $paquete_vendido)
                        @if ($cosme->id == $paquete_vendido->id_cosme)
                            @php
                                $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $cosme->id)->count() * 350;

                                $totalPaquetes = $sumaPaquetes;
                            @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($paquete_vendido->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                <td>Paquete Vendido</td>
                                <td>$350</td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                    @foreach ($regcosmessum as $cosmessum)
                        @if ($cosme->id == $cosmessum->id_cosme)
                        @php
                            $totalIngresos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Extra')->sum('monto');
                            $totalDescuentos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                            $color = $cosmessum->tipo === 'Extra' ? 'green' : 'red';
                        @endphp
                            <tr style="color: {{$color}}">
                                <td>{{ \Carbon\Carbon::parse($cosmessum->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                <td>{{$cosmessum->concepto}}</td>
                                <td>${{$cosmessum->monto}}</td>
                                <td><b>{{$cosmessum->tipo}}</b></td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F \d\e\l Y') }}</td>
                        <td>Total vendido: <b>${{ number_format($sumaTotales, 2) }}</b> </td>
                        <td>${{ $comision }}</td>
                        <td>
                        </td>
                    </tr>
                </tbody>
        </table>

        <h1 style="text-align: center;">Total a Pagar: <br>
            @php
                $resultadoFormateado = number_format(
                    ($paqueteFac + $totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum + $totalIngresos + $comision + $totalBonoComida) - $totalDescuentos,
                    2, // Número de decimales
                    '.', // Separador decimal
                    ',' // Separador de miles
                );
            @endphp
            ${{$resultadoFormateado}}
        </h1>


        <div class="col-12 mb-3 mt-3">
            <h3 class="">Hora de comida</h3>
        </div>
        <table class="table table-flush" id="historial">
            <thead class="thead">
                <tr style="background: #CA87A6; color: #fff">
                    <th>Fecha</th>
                    <th>Hora comida Ida</th>
                    <th>Hora comida Regreso</th>
                    <th></th>
                </tr>
            </thead>
                <tbody>
                    @foreach ($registros_sueldo as $sueldo_base)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                            <td>{{$sueldo_base->hora_inicio_comida}}</td>
                            <td>{{$sueldo_base->hora_fin_comida}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
        </table>

        @if ($notasPedidosVacia)
        @else
            <div class="col-12 mb-3 mt-3">
                <h3 class="">Productos Vendidos de la semana - {{ \Carbon\Carbon::parse($fechaInicioSemana)->format('d \d\e F \d\e\l Y') }}</h3>
            </div>
                <table class="table table-flush" id="historial">
                    <thead class="thead">
                        <tr style="background: #CA87A6; color: #fff">
                            <th>Fecha</th>
                            <th>Numero de nota</th>
                            <th>Total vendido</th>
                            <th></th>
                        </tr>
                    </thead>
                        <tbody>
                            @foreach ($notasPedidos as $notaPedido)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($notaPedido->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                    <td>{{$notaPedido->id}}</td>
                                    <td>${{$notaPedido->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
        @endif
        <img src="{{asset('firmaCosme/'. $registroSueldoSemanalActual->firma)}}" style="text-align: center;">
        <h4 style="text-align: center;">Firma <br>{{$cosme->name}}</h4>
    </div>
  </div>
</body>
</html>
