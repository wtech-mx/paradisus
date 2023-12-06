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
    <h1>Sueldos Cosmes</h1>
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
    @foreach ($user_pagos as $user_pago)
        <h2 style="text-align: center;">{{$user_pago->name}}</h2>
        <table class="table text-center">
            <thead style="background-color: #E74C3C; color: #fff">
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Comision</th>
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
                @endphp
                @foreach ($registros_puntualidad as $puntualidad)
                    @if ($user_pago->id == $puntualidad->cosmetologo_id)
                    @php
                        $totalBono += 150;
                    @endphp
                        <tr>
                            <td>{{$puntualidad->fecha}}</td>
                            <td>Bono de puntualidad</td>
                            <td>$150</td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($registros_sueldo as $sueldo_base)
                    @if ($user_pago->id == $sueldo_base->cosmetologo_id)
                    @php
                        $totalSueldo += $sueldo_base->monto_pago;
                    @endphp

                        <tr>
                            <td>{{$sueldo_base->fecha}}</td>
                            @if ($sueldo_base->monto_pago == '1000')
                                <td>Sueldo base <br> + Comision</td>
                            @else
                                <td>Sueldo base</td>
                            @endif
                            <td>${{$sueldo_base->monto_pago}}</td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($paquetes_vendidos as $paquete_vendido)
                    @if ($user_pago->id == $paquete_vendido->id_cosme)
                        @php
                            $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $user_pago->id)->count() * 350;

                            $totalPaquetes = $sumaPaquetes;
                        @endphp
                        <tr>
                            <td>{{$paquete_vendido->fecha_inicial}}</td>
                            <td>Paquete Vendido</td>
                            <td>$350</td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($registros_cubriendose as $cubierta)
                    @if ($user_pago->id == $cubierta->cosmetologo_id)
                    @php
                        $totalCubierta += $cubierta->cosmetologoCubriendo->sueldo_base;
                    @endphp
                        <tr>
                            <td>{{$cubierta->fecha}}</td>
                            <td>Se cubrio a: <br> {{$cubierta->cosmetologoCubriendo->name}}</td>
                            <td>${{$cubierta->cosmetologoCubriendo->sueldo_base}}</td>
                        </tr>
                    @endif
                @endforeach
                @foreach ($regcosmessum as $cosmessum)
                    @if ($user_pago->id == $cosmessum->id_cosme)
                    @php
                        $totalcosmessum += $cosmessum->monto;
                    @endphp
                        <tr>
                            <td>{{$cosmessum->fecha}}</td>
                            <td>{{$cosmessum->concepto}}</td>
                            <td>${{$cosmessum->monto}}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td>Total:</td>
                    <td></td>
                    <td><b>${{$totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum}}</b></td>
                </tr>
            </tbody>
        </table>
    @endforeach
  </div>
</body>
</html>
