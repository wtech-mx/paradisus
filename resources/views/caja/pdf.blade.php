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
  </style>
<body>
  <header>
    <h1>Reporte de Paradisus</h1>
    <h2>Caja</h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
               Fecha: {{$today}}
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

    <table class="table text-center">
        <thead style="background-color: #DDBBA2; color: #fff">
            <tr>
                <th>Ingresos</th>
                <th>Egresos</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $caja_rep->ingresos }}</td>
                <td>{{ $caja_rep->egresos }}</td>
                <td>{{ $caja_rep->total }}</td>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Egresos</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($caja as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->fecha }}</td>
                    <td>${{ $item->egresos }}</td>
                    <td>{{ $item->concepto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Nota</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos_rep as $item)

                <tr>
                    <td>{{ $item->id }}</td>
                    @if($item->Client == NULL)
                        <td>.</td>
                    @else
                        <td>{{ $item->Client->name }}</td>
                    @endif
                    @if ($item->metodo_pago2 == NULL)
                        <td>${{ $item->dinero_recibido }}</td>
                        <td>{{ $item->metodo_pago }}</td>
                    @else
                        <td>${{ $item->dinero_recibido2 }}</td>
                        <td>{{ $item->metodo_pago2 }}</td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <h2 style="page-break-before: always; text-align: center;"> --}}
    <h2 style="text-align: center;">
        Servicios</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>#Nota</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Monto</th>
                <th>Restante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $item)
                <tr>
                    <td>{{ $item->id_nota }}</td>
                    <td>{{ $item->Notas->Client->name }}</td>
                    <td>
                        @foreach($notas_paquetes as $paquete)
                                @if ($paquete->id_nota == $item->id_nota)
                                    {{$paquete->Servicios->nombre}}<br>

                                    @if($paquete->id_servicio2 != NULL || $paquete->id_servicio2 != 0)
                                        {{$paquete->Servicios2->nombre}}<br>
                                    @endif
                                    @if($paquete->id_servicio3 != NULL || $paquete->id_servicio3 != 0)
                                        {{$paquete->Servicios3->nombre}}<br>
                                    @endif
                                    @if($paquete->id_servicio4 != NULL || $paquete->id_servicio4 != 0)
                                        {{$paquete->Servicios4->nombre}}<br>
                                    @endif
                                @endif
                        @endforeach
                    </td>
                    <td>${{ $item->pago }}</td>
                    <td>${{ $item->restante }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Paquetes</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>#Nota</th>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Monto</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquetes as $item)
                <tr>
                    <td>{{ $item->id_paquete }}</td>
                    <td>{{ $item->Paquetes->Client->name }}</td>
                    <td>
                        @if ($item->Paquetes->num_paquete == 1)
                            figura Ideal c/Aparatología
                        @elseif ($item->Paquetes->num_paquete == 2)
                            Lipoescultura s/Cirugía
                        @elseif ($item->Paquetes->num_paquete == 3)
                            Moldeante & Reductivo
                        @elseif ($item->Paquetes->num_paquete == 4)
                            Drenante & Linfático
                        @elseif ($item->Paquetes->num_paquete == 5)
                            Glúteos Definido & Perfectos
                        @endif
                    </td>
                    <td>{{ $item->pago }}</td>
                    <td>{{ $item->nota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Propinas</h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Nota</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($propinasHoy as $item)

                <tr>
                    <td>{{ $item->id_nota }}</td>
                    @if($item->User == NULL)
                        <td>.</td>
                    @else
                        <td>{{ $item->User->name }}</td>
                    @endif
                    <td>${{ $item->propina }}</td>
                    <td>{{ $item->metdodo_pago }}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
