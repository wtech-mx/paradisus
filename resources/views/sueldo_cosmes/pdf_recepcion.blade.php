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
    <h1>Sueldo <br> {{$recepcion_pagos->name}}</h1>
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
        <table class="table table-flush" id="datatable-search">
            <thead class="thead">
                <tr>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Comision</th>
                </tr>
            </thead>
                <tbody>
                    @php
                        $totalIngresos = 0;
                        $totalDescuentos = 0;
                        $totalBonoComida = 0;
                    @endphp

                    <tr>
                        <td>{{$fechaLunes}}</td>

                        @if ($recepcion_pagos->id == 16)
                            <td>Sueldo Fin de semana</td>
                        @else
                            <td>Sueldo Semanal</td>
                        @endif
                        <td>${{$recepcion_pagos->sueldo_base}}</td>
                        <td></td>
                    </tr>

                    @foreach ($paquetes as $paquete)
                        @if ($recepcion_pagos->id == $paquete->id_cosme)
                        @php
                            $totalBonoComida = 130;
                        @endphp
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($paquete->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                <td>Bono de comida</td>
                                <td>$130</td>
                                <td>
                                    <form method="POST" action="{{ route('pagos.quitar', $recepcion_pagos->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <input type="text" id="paquetes" name="paquetes" value="0" style="display: none">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas quitarlo?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach

                    @foreach ($regcosmessum as $item)
                        @if ($recepcion_pagos->id == $item->id_cosme)
                            @php
                                $totalIngresos = $item->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $item->id_cosme)->where('tipo', 'Extra')->sum('monto');
                                $totalDescuentos = $item->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $item->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                                $color = $item->tipo === 'Extra' ? 'green' : 'red';
                            @endphp
                            <tr style="color: {{$color}}">
                                <td>{{$item->fecha}}</td>
                                <td>{{$item->concepto}}</td>
                                <td>${{$item->monto}}</td>
                                <td>{{$item->tipo}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td>Total:</td>
                        <td></td>
                        <td>
                            @php
                                $resultadoFormateado = number_format(
                                    ($recepcion_pagos->sueldo_base + $totalIngresos + $totalBonoComida) - $totalDescuentos,
                                    2, // Número de decimales
                                    '.', // Separador decimal
                                    ',' // Separador de miles
                                );
                            @endphp
                            <b>${{$resultadoFormateado}}</b></td>
                    </tr>
                </tbody>
        </table>

    </div>
  </div>
</body>
</html>