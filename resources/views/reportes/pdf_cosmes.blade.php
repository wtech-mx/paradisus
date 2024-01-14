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
    }

    td, th {
    text-align: center;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #F7EAED;
    }

    .page-break {
       page-break-before: always;
    }
  </style>
<body>
  <header>
    <h1>Reporte de Paradisus</h1>
    <h2>Venta Cosmes</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{$diaActual}}
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>

    <h2 style="text-align: center;">Ventas Totales</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Cosme</th>
                <th>Monto Vendido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infoUsuarios as $item)
                @if ($item->User->puesto == 'Cosme')
                    @php
                        $total_precio1 = $item->total_precio;
                        $total_precio2 = $infoUsuarios_productos->where('id_user', $item->id_user)->sum('total_precio');
                        $total_precio3 = $infoUsuarios_paquetes->where('id_user1', $item->id_user)->sum('total_precio');

                        $total = $total_precio1 + $total_precio2 + $total_precio3;
                        $resultadoFormateado = number_format($total, 2, '.', ',');
                    @endphp
                    <tr>
                        <td>{{ $item->User->name }}</td>
                        <td>${{ $resultadoFormateado }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2 style="text-align: center;">Ventas Servicios</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Cosme</th>
                <th>Monto Vendido</th>
                <th>Numero de notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infoUsuarios as $item)
                @php
                    $resultadoFormateado = number_format($item->total_precio, 2,'.',',');
                @endphp
                @if ($item->User->puesto == 'Cosme')
                    <tr>
                        <td>{{ $item->User->name }}</td>
                        <td>${{ $resultadoFormateado }}</td>
                        <td>{{ $item->cantidad_notas }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2 style="text-align: center;">Ventas Productos</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Cosme</th>
                <th>Monto Vendido</th>
                <th>Numero de notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infoUsuarios_productos as $item)
                @php
                    $resultadoFormateado = number_format($item->total_precio, 2,'.',',');
                @endphp
                @if ($item->User->puesto == 'Cosme')
                    <tr>
                        <td>{{ $item->User->name }}</td>
                        <td>${{ $resultadoFormateado }}</td>
                        <td>{{ $item->cantidad_notas }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <h2 style="text-align: center;">Ventas Paquetes</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Cosme</th>
                <th>Monto Vendido</th>
                <th>Numero de notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($infoUsuarios_paquetes as $item)
                @php
                    $resultadoFormateado = number_format($item->total_precio, 2,'.',',');
                @endphp
                @if ($item->User1->puesto == 'Cosme')
                    <tr>
                        <td>{{ $item->User1->name }}</td>
                        <td>${{ $resultadoFormateado }}</td>
                        <td>{{ $item->cantidad_notas }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

  </div>
</body>
</html>
