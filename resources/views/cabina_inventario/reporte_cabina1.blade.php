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

    .terminar-cell {
        background-color: #FFA500; /* Naranja */
        color: #fff;
    }

    .cambio-cell {
        background-color: #FBD38D; /* Amarillo */
        color: #fff;
    }

    .stock-cell {
        background-color: #87caa1; /* Verde */
        color: #fff;
    }
  </style>
<body>
  <header>
    <h1>Inventario de Paradisus</h1>
    <h2>Cabina 1</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{$hoy}}
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

  <div id="content">
    <div style="background-color: #b06a9e; color:#fff; text-align: center;">
        <h1>Tabla comporativa del mes</h1>
    </div>

    <table class="table text-center">
        <thead style="background-color: #87b7ca; color: #fff">
            <tr>
                <th>Productos</th>
                <th>Semana <br> 1</th>
                <th>Semana <br> 2</th>
                <th>Semana <br> 3</th>
                <th>Semana <br> 4</th>
                <th>Semana <br> 5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $productosPorCabinaTerm = collect();
            @endphp

              @foreach ($productos_cabina1 as $producto)
                @php
                    $nombreProducto = $producto->nombre;
                    $numCabina = $producto->num_semana;
                    $estatus = $producto->estatus;

                    // Obtener o inicializar la colección para el producto
                    $productoCollection = $productosPorCabinaTerm->get($nombreProducto, collect([
                        1 => '',
                        2 => '',
                        3 => '',
                        4 => '',
                        5 => '',
                    ]));

                    // Actualizar el estatus solo si es 'Por Terminar'
                    if ($estatus == 'Por Terminar') {
                        $productoCollection->put($numCabina, 'Por Terminar');
                    }elseif($estatus == 'Se cambio'){
                        $productoCollection->put($numCabina, 'Se cambio');
                    }

                    // Actualizar la colección principal
                    $productosPorCabinaTerm->put($nombreProducto, $productoCollection);
                @endphp
            @endforeach

            @foreach ($productosPorCabinaTerm as $nombreProducto => $estatusPorCabina)
                <tr>
                    <td>{{$nombreProducto}}</td>
                    @for ($i = 1; $i <= $numCabina; $i++)
                        @php
                            $productoActual = $productos_cabina1
                                ->where('nombre', $nombreProducto)
                                ->where('num_semana', $i)
                                ->first();

                            if ($productoActual) {
                                $cantidad = $productoActual->cantidad;
                                $estatusProducto = $productoActual->estatus;
                            } else {
                                $cantidad = $productos->where('nombre', $nombreProducto)->first()->cantidad;
                                $estatusProducto = 'En stock';
                            }
                        @endphp
                        <td class="{{ $estatusProducto == 'Por Terminar' ? 'terminar-cell' : ($estatusProducto == 'Se cambio' ? 'cambio-cell' : 'stock-cell') }}">
                            {{$estatusProducto}} <br>
                            {{$cantidad}}
                        </td>
                    @endfor
                </tr>
            @endforeach



        </tbody>
    </table>

    <div class="page-break"></div>

  </div>
</body>
</html>
