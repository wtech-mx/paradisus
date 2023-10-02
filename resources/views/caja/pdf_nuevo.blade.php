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
    <h2><img src="{{ asset('assets/icons/cajero-automatico.png') }}" alt="" width="35px"> </h2>
  </header>

  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
                Fecha: {{ date('d/n/y', strtotime($today)) }}
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
        <thead style="background-color: #000; color: #fff">
            <tr>
                <th>Ingresos <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="35px"> </th>
                <th>Egresos <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"> </th>
                <th>Total <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px"> </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    ${{ number_format($caja_rep->ingresos, 1, '.', ',') }}
                </td>
                <td>
                    ${{ number_format($caja_rep->egresos, 1, '.', ',') }}
                </td>
                <td>
                    ${{ number_format($caja_rep->total, 1, '.', ',') }}
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table text-center">
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <tr>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Transferencia <br> <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></td>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Clip <br> <img src="{{ asset('assets/icons/ml.png') }}" alt="" width="50x"></td>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Tarjeta <br> <img src="{{ asset('assets/icons/tarjeta-de-credito.png') }}" alt="" width="35px"></td>
        </tr>
        <tr>
            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
        </tr>
        <tr>
            <td>
                {{ $suma_filas_trans }}
            </td>

            <td>
                ${{ number_format($suma_pago_trans, 1, '.', ',') }}
            </td>

            <td>
                {{$suma_filas_mercado}}
            </td>

            <td>
                ${{ number_format($suma_pago_mercado, 1, '.', ',') }}
            </td>

            <td>
                {{$suma_filas_tarjeta}}
            </td>

            <td>
                ${{ number_format($suma_pago_tarjeta, 1, '.', ',') }}
            </td>
        </tr>
    </table>

    <h2 style="text-align: center;">
        Egresos <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"></h2>
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
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime( $item->fecha)) }}
                    </td>
                    <td>
                        ${{ number_format($item->egresos, 1, '.', ',') }}
                    </td>
                    <td>
                        {{ $item->concepto }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Productos <img src="{{ asset('assets/icons/productos.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Nota</th>
                <th>Cliente</th>
                <th>Monto</th>
                <th>Dinero Recibido</th>
                <th>For. Pago</th>
                <th>Dinero Recibido 2</th>
                <th>Monto 2</th>
                <th>For. Pago 2</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos_rep as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>

                        <td>
                            {{ $item->Client->name }}
                        </td>

                        <td>
                            ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        </td>
                        <td>
                            {{ $item->metodo_pago2 }}
                        </td>

                        <td>
                            ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        </td>
                        <td>
                            {{ $item->metodo_pago }}
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <h2 style="page-break-before: always; text-align: center;"> --}}
    <h2 style="text-align: center;">
        Servicios <img src="{{ asset('assets/icons/mascara-facial.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>#Nota</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Monto</th>
                <th>Dinero Recibido</th>
                <th>Restante</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $item)
                <tr>
                    <td>
                        {{ $item->id_nota }}
                    </td>
                    <td>
                        {{ $item->Notas->Client->name }}
                    </td>
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
                    <td>
                        ${{ number_format($item->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->restante, 1, '.', ',') }}
                    </td>
                    <td>
                        {{ $item->forma_pago }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Paquetes <img src="{{ asset('assets/icons/nuevo-producto.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>#Nota</th>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Monto</th>
                <th>Dinero Recibido</th>
                <th>Restante</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquetes as $item)
                <tr>
                    <td>
                        {{ $item->id_paquete }}
                    </td>
                    <td>
                        {{ $item->Paquetes->Client->name }}
                    </td>
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
                    <td>
                        ${{ number_format($item->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->Paquetes->restante, 1, '.', ',') }}
                    </td>
                    <td>
                        {{ $item->forma_pago }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Propinas <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="35px"></h2>
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
                    <td>
                        {{ $item->id_nota }}
                    </td>
                    @if($item->User == NULL)
                        <td>
                            {{ $item->User->name }}
                        </td>
                    @endif
                    <td>
                        ${{ number_format($item->propina, 1, '.', ',') }}
                    </td>
                    <td>
                        {{ $item->metdodo_pago }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
