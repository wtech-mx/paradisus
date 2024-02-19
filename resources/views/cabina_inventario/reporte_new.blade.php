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
    <h2>Inventario</h2>
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
    <div style="background-color: #b06a8b; color:#fff; text-align: center;">
        <h1 style="text-align: center;">Tablas comporativas de la semana</h1>
    </div>

    <h2 style="text-align: center;">Cambios</h2>
    <table class="table text-center">
        <thead style="background-color: #8b87ca; color: #fff">
            <tr>
                <th>Productos</th>
                <th>Cabina 1</th>
                <th>Cabina 3</th>
                <th>Cabina 4</th>
                <th>Cabina 5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $productosPorCabina = collect();
            @endphp

            @foreach ($productos_sem_cambios as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
                    $numCabina = $producto->num_cabina;
                    $estatus = $producto->estatus;

                    // Obtener o inicializar la colección para el producto
                    $productoCollection = $productosPorCabina->get($nombreProducto, collect([
                        1 => '',
                        3 => '',
                        4 => '',
                        5 => '',
                    ]));

                    // Actualizar el estatus solo si es 'Se cambio'
                    if ($estatus == 'Se cambio') {
                        $productoCollection->put($numCabina, 'si');
                    }

                    // Actualizar la colección principal
                    $productosPorCabina->put($nombreProducto, $productoCollection);
                @endphp
            @endforeach

            @foreach ($productosPorCabina as $nombreProducto => $estatusPorCabina)
                <tr>
                    <td>{{$nombreProducto}}</td>
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Por Terminar</h2>
    <table class="table text-center">
        <thead style="background-color: #8b87ca; color: #fff">
            <tr>
                <th>Productos</th>
                <th>Cabina 1</th>
                <th>Cabina 3</th>
                <th>Cabina 4</th>
                <th>Cabina 5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $productosPorCabinaTerm = collect();
            @endphp

            @foreach ($productos_sem_termino as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
                    $numCabina = $producto->num_cabina;
                    $estatus = $producto->estatus;

                    // Obtener o inicializar la colección para el producto
                    $productoCollection = $productosPorCabinaTerm->get($nombreProducto, collect([
                        1 => '',
                        3 => '',
                        4 => '',
                        5 => '',
                    ]));

                    // Actualizar el estatus solo si es 'Por Terminar'
                    if ($estatus == 'Por Terminar') {
                        $productoCollection->put($numCabina, 'si');
                    }

                    // Actualizar la colección principal
                    $productosPorCabinaTerm->put($nombreProducto, $productoCollection);
                @endphp
            @endforeach

            @foreach ($productosPorCabinaTerm as $nombreProducto => $estatusPorCabina)
                <tr>
                    <td>{{$nombreProducto}}</td>
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Resumen de la semana</h2>
    <table class="table text-center">
        <thead style="background-color: #8b87ca; color: #fff">
            <tr>
                <th>Productos</th>
                <th>Cabina 1</th>
                <th>Cabina 3</th>
                <th>Cabina 4</th>
                <th>Cabina 5</th>
            </tr>
        </thead>
        <tbody>
            @php
                $productosPorCabinaTerm = collect();
            @endphp

            @foreach ($productos_sem as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
                    $numCabina = $producto->num_cabina;
                    $estatus = $producto->estatus;
                    $cantidad = $producto->cantidad;

                    // Obtener o inicializar la colección para el producto
                    $productoCollection = $productosPorCabinaTerm->get($nombreProducto, collect([
                        'estatus' => collect([
                            1 => '',
                            3 => '',
                            4 => '',
                            5 => '',
                        ]),
                        'cantidad' => collect([
                            1 => '',
                            3 => '',
                            4 => '',
                            5 => '',
                        ]),
                    ]));

                    // Actualizar el estatus y la cantidad
                    if ($estatus == 'Por Terminar') {
                        $productoCollection['estatus'] = $productoCollection['estatus']->put($numCabina, 'Por Terminar');
                    } elseif ($estatus == 'Se cambio') {
                        $productoCollection['estatus'] = $productoCollection['estatus']->put($numCabina, 'Se cambio');
                    } else {
                        $productoCollection['estatus'] = $productoCollection['estatus']->put($numCabina, 'En stock');
                    }

                    $productoCollection['cantidad'] = $productoCollection['cantidad']->put($numCabina, $cantidad);

                    // Actualizar la colección principal
                    $productosPorCabinaTerm->put($nombreProducto, $productoCollection);
                @endphp
            @endforeach

            @foreach ($productosPorCabinaTerm as $nombreProducto => $data)
                <tr>
                    <td>{{$nombreProducto}}</td>
                    @foreach ($data['estatus'] as $estatus)
                        <td style="background-color:
                            @if ($estatus == 'Por Terminar')
                                #FFA500; /* Naranja */
                            @elseif ($estatus == 'Se cambio')
                                #FBD38D; /* Amarillo */
                            @else
                                #87caa1; /* Verde (En stock) */
                            @endif
                            ; color: #fff">
                            @if ($estatus == "" || $estatus == "En stock")
                                En stock
                            @else
                                {{$estatus}}
                            @endif
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td></td>
                    @foreach ($data['cantidad'] as $cantidad)
                        <td>{{$cantidad}}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <div style="background-color: #b06a9e; color:#fff; text-align: center;">
        <h1>Tablas comporativas del mes</h1>
    </div>

    <h2 style="text-align: center;">Cabina 1</h2>
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
                    $nombreProducto = str_slug($producto->nombre);
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
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[2]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Cabina 3</h2>
    <table class="table text-center">
        <thead style="background-color: #a5ca87; color: #fff">
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

            @foreach ($productos_cabina3 as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
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
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[2]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Cabina 4</h2>
    <table class="table text-center">
        <thead style="background-color: #cac087; color: #fff">
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

            @foreach ($productos_cabina4 as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
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
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[2]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Cabina 5</h2>
    <table class="table text-center">
        <thead style="background-color: #ca9a87; color: #fff">
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

            @foreach ($productos_cabina5 as $producto)
                @php
                    $nombreProducto = str_slug($producto->nombre);
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
                    <td>{{$estatusPorCabina[1]}}</td>
                    <td>{{$estatusPorCabina[2]}}</td>
                    <td>{{$estatusPorCabina[3]}}</td>
                    <td>{{$estatusPorCabina[4]}}</td>
                    <td>{{$estatusPorCabina[5]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

  </div>
</body>
</html>
