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

    <table style="">
        <thead style="background-color: #CD6155; color: #fff">
            <tr>
                <th>Inicio de Caja del Dia con : <img src="{{ asset('assets/icons/manana.png') }}" alt="" width="35px"> </th>
                <th>Fin de caja del dia con : <img src="{{ asset('assets/icons/pm.png') }}"alt="" width="35px"> </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <strong> ${{ number_format($caja_rep->inicio, 1, '.', ',') }}</strong>
                </th>

                <th>
                    <strong> ${{ number_format($caja_rep->total, 1, '.', ',') }}</strong>
                </th>
            </tr>
        </tbody>
    </table>


    <table class="table text-center">
        <thead style="background-color: #000; color: #fff">
            <tr>
                <th><p class="text-center"> Caja Ingresos  <br><img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="35px"> </p></th>
                <th><p class="text-center"> Caja Egresos  <br><img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"> </p></th>
                <th><p class="text-center"> Caja Ingresos - egresos = <br>(Total de caja) <br><img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px"> </p></th>
            </tr>
        </thead>
        <tbody>
            <tr style="font-size: 14px">
                <td>
                    <p class="text-center">
                        ${{ number_format($caja_rep->ingresos, 1, '.', ',') }}
                    </p>
                </td>

                <td>
                    <p class="text-center">
                        ${{ number_format($caja_rep->egresos, 1, '.', ',') }}
                    </p>
                </td>

                <td>
                    <p class="text-center">
                        ${{ number_format($caja_rep->total, 1, '.', ',') }}
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    @php
        $resta = $caja_rep->ingresos - $caja_rep->inicio ;
        $efectivo = $resta - $caja_dia_suma_cambios->total;
        if($efectivo > 0){
        $total_efectivo = $efectivo;
        }else{
        $total_efectivo = 0;
        }
    @endphp
    <h2 style="text-align: center;">Total de ingresos del dia  <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"> <br>
        @php
            $totalingresos =  $suma_pago_trans + $total_efectivo +  $suma_pago_tarjeta;
        @endphp

        <strong> ${{ number_format($totalingresos, 1, '.', ',') }}</strong>

    </h2>

    <h2 style="text-align: center;">No de Servicos y ventas  <img src="{{ asset('assets/icons/skincare.png') }}" alt="" width="35px"> <br>
        @php
            $totalsumaservent = $suma_filas_trans + $suma_filas_mercado + $suma_filas_tarjeta
        @endphp
        {{ $totalsumaservent }}
    </h2>

    <table class="table text-center">
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>

        <tr>
            <td colspan="2" style="background-color: #2ECC71; color: #fff; border: rgb(255, 255, 255) 1px solid;">Transferencia <br> <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></td>
            <td colspan="2" style="background-color: #2ECC71; color: #fff; border: rgb(255, 255, 255) 1px solid;">Efectivo<br> <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="50x"></td>
            <td colspan="2" style="background-color: #2ECC71; color: #fff; border: rgb(255, 255, 255) 1px solid;">Tarjeta <br> <img src="{{ asset('assets/icons/tarjeta-de-credito.png') }}" alt="" width="35px"></td>
        </tr>
        <tr>
            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>

            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>

            <td style="border: rgb(255, 255, 255) 1px solid;">Serv/Venta</td>
            <td style="border: rgb(255, 255, 255) 1px solid;">Total</td>
        </tr>

        <tr style="font-size: 14px">
            <td>
                {{ $suma_filas_trans }}
            </td>

            <td>
                <strong>${{ number_format($suma_pago_trans, 1, '.', ',') }}</strong>
            </td>

            <td>
                {{$suma_filas_mercado}}
            </td>

            <td>
                <strong>${{ number_format($total_efectivo, 1, '.', ',') }}</strong>
            </td>

            <td>
                {{$suma_filas_tarjeta}}
            </td>

            <td>
                <strong>${{ number_format($suma_pago_tarjeta, 1, '.', ',') }}</strong>
            </td>
        </tr>
    </table>

    <h2 style="text-align: center;"> <br>Graficas <br>
    </h2>

    <table>
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Grafica Caja</th>
                <th>Grafica de Metodos de pago</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart}}">
                </th>

                <th>
                    <img src="{{$chartmp}}">
                </th>
            </tr>
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Apertura de Caja : <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Concepto</th>
                <th>Ver imagen / Ir a la nota</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($caja as $item)
                <tr style="font-size: 14px">
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
                    <td>
                        @if($item->foto == NULL)
                            @php
                                $texto = $item->concepto;
                                // Otra opción de texto
                                // $texto = "Cambio nota servicio: 2967";

                                // Usamos una expresión regular para buscar los dígitos al final del texto
                                if (preg_match('/Cambio nota productos: (\d{3,4})/', $texto, $matches)) {
                                    $tipo = "Productos";
                                    $digitos = $matches[1];
                                    $enlaceHTML = "<a href='" . route('notas_pedidos.edit', $digitos) . "'>Ver Pedido $digitos</a>";
                                    echo  $enlaceHTML;
                                } elseif (preg_match('/Cambio nota servicio: (\d{3,4})/', $texto, $matches)) {
                                    $tipo = "Servicio";
                                    $digitos = $matches[1];
                                    $enlaceHTML = "<a href='" . route('notas.edit', $digitos) . "'>Ver Servicio $digitos</a>";
                                    echo  $enlaceHTML;
                                }
                            @endphp
                        @else
                            <a href="{{asset('foto_retiros/'.$item->foto)}}">
                                Abrir imagen
                            </a>

                        @endif
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
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Total</th>
                <th>Abono</th>
                <th>Dinero Recibido</th>
                <th>Cambio</th>
                <th>Restante</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $item)
                <tr style="font-size: 14px">
                    <td>
                        <p class="text-sm">
                        {{ $item->Notas->Client->name }} <br> {{ $item->Notas->Client->last_name }} <br><a href="{{ route('notas.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_nota }}</a>
                        </p>
                    </td>
                    <td >
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
                        <p class="text-sm">
                        ${{ number_format($item->Notas->precio, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->pago, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ $item->cambio }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->restante, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        {{ $item->forma_pago }}
                        </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Paquetes <img src="{{ asset('assets/icons/nuevo-producto.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #F39C12; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Paquete</th>
                <th>Total</th>
                <th>Abono</th>
                <th>Dinero Recibido</th>
                <th>Cambio</th>
                <th>Restante</th>
                <th>For. Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paquetes as $item)
                <tr style="font-size: 14px">
                    <td>
                        {{ $item->Paquetes->Client->name }} <br> {{ $item->Paquetes->Client->last_name }} <br>
                        @if ($item->Paquetes->num_paquete == 1)
                            <a href="{{ route('edit_paquete_uno.edit_uno',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 2)
                            <a href="{{ route('edit_paquete_dos.edit_dos',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 3)
                            <a href="{{ route('edit_paquete_tres.edit_tres',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 4)
                            <a href="{{ route('edit_paquete_cuatro.edit_cuatro',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 5)
                            <a href="{{ route('edit_paquete_cinco.edit_cinco',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @endif
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
                        ${{ number_format($item->Paquetes->monto, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                    </td>
                    <td>
                        ${{ number_format($item->cambio, 1, '.', ',') }}
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
        Productos <img src="{{ asset('assets/icons/productos.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #27AE60; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Total</th>
                <th>Dinero Recibido</th>
                <th>For. Pago</th>
                <th>Cambio</th>
                <th>Producto(s)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos_rep as $item)
            @php
                $pedidos = $item->Pedido;
            @endphp

                <tr style="font-size: 14px">

                        <td>
                            {{ $item->Client->name }} <br> {{ $item->Client->last_name }} <br>
                            <a href="{{ route('notas_pedidos.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id }}</a>
                        </td>
                        <td>
                            ${{ number_format($item->total, 1, '.', ',') }}
                        </td>
                        <td>
                            ${{ number_format($item->dinero_recibido, 1, '.', ',') }} <br>
                            @if ($item->dinero_recibido2 !== NULL)
                             ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                            @endif
                        </td>
                        <td>
                            {{ $item->metodo_pago }}<br>
                            @if ($item->metodo_pago2 !== NULL)
                               {{ $item->metodo_pago2 }}
                            @endif
                        </td>

                        <td>
                            ${{ number_format($item->cambio, 1, '.', ',') }}
                        </td>

                        <td>
                            <ul>
                                @foreach ($pedidos as $pedido)
                                    <li>
                                        {{ $pedido->concepto}}
                                    </li>
                                @endforeach
                            </ul>
                        </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Propinas <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #7F8C8D; color: #fff">
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

    <h2 style="text-align: center;">Transferencia <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #E74C3C; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Abono</th>
                <th>Dinero Recibido</th>
                <th>Cambio</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_trans as $item)
                @php
                    $pedidos = $item->Pedido;
                @endphp
                <tr>
                    <td>
                        {{ $item->Client->name }} <br> {{ $item->Client->last_name }} <br>
                        <a href="{{ route('notas_pedidos.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id }}</a>
                    </td>
                    <td>
                        <ul>
                            @foreach ($pedidos as $pedido)
                                <li>
                                    {{ $pedido->concepto}}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($item->metodo_pago2 == 'Transferencia')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>
                    <td>
                        @if ($item->metodo_pago2 == 'Transferencia')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>
                    <td>
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>
                    <td>Producto</td>
                </tr>
            @endforeach

            @foreach ($total_servicios_trans as $item)
                <tr>
                    <td>
                        <p class="text-sm">
                        {{ $item->Notas->Client->name }} <br> {{ $item->Notas->Client->last_name }} <br><a href="{{ route('notas.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_nota }}</a>
                        </p>
                    </td>
                    <td >
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
                        <p class="text-sm">
                        ${{ number_format($item->pago, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ $item->cambio }}
                        </p>
                    </td>
                    <td>
                        Servicio
                    </td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_trans as $item)
                <tr>
                    <td>
                        {{ $item->Paquetes->Client->name }} <br> {{ $item->Paquetes->Client->last_name }} <br>
                        @if ($item->Paquetes->num_paquete == 1)
                            <a href="{{ route('edit_paquete_uno.edit_uno',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 2)
                            <a href="{{ route('edit_paquete_dos.edit_dos',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 3)
                            <a href="{{ route('edit_paquete_tres.edit_tres',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 4)
                            <a href="{{ route('edit_paquete_cuatro.edit_cuatro',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 5)
                            <a href="{{ route('edit_paquete_cinco.edit_cinco',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @endif
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
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>
                    <td>
                        Paquete
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Efectivo <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="50x"></h2>
    <table class="table text-center">
        <thead style="background-color: #9B59B6; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Abono</th>
                <th>Dinero Recibido</th>
                <th>Cambio</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_mercado as $item)
                @php
                    $pedidos = $item->Pedido;
                @endphp
                <tr>
                    <td>
                        {{ $item->Client->name }} <br> {{ $item->Client->last_name }} <br>
                        <a href="{{ route('notas_pedidos.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id }}</a>
                    </td>

                    <td>
                        <ul>
                            @foreach ($pedidos as $pedido)
                                <li>
                                    {{ $pedido->concepto}}
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <td>
                        @if ($item->metodo_pago2 == 'Efectivo')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>

                    <td>
                        @if ($item->metodo_pago2 == 'Efectivo')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>

                    <td>
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>

                    <td>Producto</td>
                </tr>
            @endforeach

            @foreach ($total_servicios_mercado as $item)
                <tr>
                    <td>
                        <p class="text-sm">
                        {{ $item->Notas->Client->name }} <br> {{ $item->Notas->Client->last_name }} <br><a href="{{ route('notas.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_nota }}</a>
                        </p>
                    </td>
                    <td >
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
                        <p class="text-sm">
                        ${{ number_format($item->pago, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                            ${{ number_format($item->cambio, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                            Servicio
                        </p>
                    </td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_mercado as $item)
                <tr>
                    <td>
                        {{ $item->Paquetes->Client->name }} <br> {{ $item->Paquetes->Client->last_name }} <br>
                        @if ($item->Paquetes->num_paquete == 1)
                            <a href="{{ route('edit_paquete_uno.edit_uno',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 2)
                            <a href="{{ route('edit_paquete_dos.edit_dos',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 3)
                            <a href="{{ route('edit_paquete_tres.edit_tres',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 4)
                            <a href="{{ route('edit_paquete_cuatro.edit_cuatro',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 5)
                            <a href="{{ route('edit_paquete_cinco.edit_cinco',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @endif
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
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>
                    <td>
                        Paquete
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Tarjeta <img src="{{ asset('assets/icons/tarjeta-de-credito.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #2980B9; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Abono</th>
                <th>Dinero Recibido</th>
                <th>Cambio</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_tarjeta as $item)
                @php
                    $pedidos = $item->Pedido;
                @endphp
                <tr>
                    <td>
                        {{ $item->Client->name }} <br> {{ $item->Client->last_name }} <br>
                        <a href="{{ route('notas_pedidos.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id }}</a>
                    </td>
                    <td>
                        <ul>
                            @foreach ($pedidos as $pedido)
                                <li>
                                    {{ $pedido->concepto}}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        @if ($item->metodo_pago2 == 'Tarjeta')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>
                    <td>
                        @if ($item->metodo_pago2 == 'Tarjeta')
                                ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                        @else
                                ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        @endif
                    </td>
                    <td>
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>
                    <td>Producto</td>
                </tr>
            @endforeach

            @foreach ($total_servicios_tarjeta as $item)
                <tr>
                    <td>
                        <p class="text-sm">
                        {{ $item->Notas->Client->name }} <br> {{ $item->Notas->Client->last_name }} <br><a href="{{ route('notas.edit',$item->id) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_nota }}</a>
                        </p>
                    </td>
                    <td >
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
                        <p class="text-sm">
                        ${{ number_format($item->pago, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                        </p>
                    </td>
                    <td>
                        <p class="text-sm">
                        ${{ $item->cambio }}
                        </p>
                    </td>
                    <td>
                        Servicio
                    </td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_tarjeta as $item)
                <tr>
                    <td>
                        {{ $item->Paquetes->Client->name }} <br> {{ $item->Paquetes->Client->last_name }} <br>
                        @if ($item->Paquetes->num_paquete == 1)
                            <a href="{{ route('edit_paquete_uno.edit_uno',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 2)
                            <a href="{{ route('edit_paquete_dos.edit_dos',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 3)
                            <a href="{{ route('edit_paquete_tres.edit_tres',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 4)
                            <a href="{{ route('edit_paquete_cuatro.edit_cuatro',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @elseif ($item->Paquetes->num_paquete == 5)
                            <a href="{{ route('edit_paquete_cinco.edit_cinco',$item->id_paquete) }}" target="_blank" style="color: blue;text-decoration:underline;"> #Nota: {{ $item->id_paquete }}</a>
                        @endif
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
                        ${{ number_format($item->cambio, 1, '.', ',') }}
                    </td>
                    <td>
                        Paquete
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Bitácora de Cambios <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></h2>

    <table class="table table-bordered">
        <tbody>
            @php
                $contador = 1;
            @endphp
            @foreach($bitacora as $registro)
                <tr>
                    <td colspan="4"><strong>Modificación {{ $contador++ }}</strong></td>
                </tr>
                <tr>
                    <td>ID Nota:</td>
                    <td>Usuario:</td>
                    <td>Tipo:</td>
                    <td>Fecha:</td>
                </tr>
                <tr>
                    <td>{{ $registro->id_nota }}</td>
                    <td>{{ $registro->usuario }}</td>
                    <td>{{ $registro->tipo }}</td>
                    <td>{{ $registro->fecha }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <strong>Antes:</strong><br>
                        @php
                            $antes = json_decode($registro->antes, true);
                            foreach ($antes as $key => $value) {
                                echo $key . ': ' . $value . '<br>';
                            }
                        @endphp
                    </td>
                    <td colspan="2" style="text-align: left;">
                        <strong>Después:</strong><br>
                        @php
                            $despues = json_decode($registro->despues, true);
                            foreach ($despues as $key => $value) {
                                echo $key . ': ' . $value . '<br>';
                            }
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </div>
</body>
</html>
