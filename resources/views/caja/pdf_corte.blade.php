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
    <h2>Corte <img src="{{ asset('assets/icons/cortar.png') }}" alt="" width="35px"> </h2>
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
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <tr>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Transferencia <br> <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></td>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Mercado Pago <br> <img src="{{ asset('assets/icons/ml.png') }}" alt="" width="50x"></td>
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
                $1,930
            </td>

            <td>
                {{$suma_filas_tarjeta}}
            </td>

            <td>
                ${{ number_format($suma_pago_tarjeta, 1, '.', ',') }}
            </td>
        </tr>
    </table>

    <h2 style="text-align: center;">Transferencia <img src="{{ asset('assets/icons/simbolos.png') }}" alt="" width="35px"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Nota/Cosme</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_trans as $trans)
                <tr>
                    <td>
                        {{ $trans->id }}
                    </td>
                    @if ($trans->metodo_pago2 == 'Transferencia')
                        <td>
                            ${{ number_format($trans->dinero_recibido2, 1, '.', ',') }}
                        </td>
                    @else
                        <td>
                            ${{ number_format($trans->dinero_recibido, 1, '.', ',') }}
                        </td>
                    @endif
                    <td>Producto</td>
                    <td>{{ date('d/n/y', strtotime($trans->fecha)) }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach

            @foreach ($total_servicios_trans as $trans)
                <tr>
                    <td>
                        {{ $trans->id }}
                    </td>
                    <td>
                        ${{ number_format($trans->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        Servicio
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime($trans->fecha)) }}
                    </td>
                    <td>
                        {{ $trans->nota }}
                    </td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_trans as $trans)
                <tr>
                    <td>
                        {{ $trans->id }}
                    </td>
                    <td>
                        ${{ number_format($trans->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        Paquete
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime($trans->fecha)) }}
                    </td>
                    <td>
                        {{ $trans->User->name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Mercado Pago <img src="{{ asset('assets/icons/ml.png') }}" alt="" width="50x"></h2>
    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Nota/Cosme</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_mercado as $trans)
                <tr>
                    <td>{{ $trans->id }}</td>
                    @if ($trans->metodo_pago2 == 'Mercado Pago')
                        <td>
                            ${{ number_format($trans->dinero_recibido2, 1, '.', ',') }}
                        </td>
                    @else
                        <td>
                            ${{ number_format($trans->dinero_recibido, 1, '.', ',') }}
                        </td>
                    @endif
                    <td>Producto</td>
                    <td>{{ date('d/n/y', strtotime($trans->fecha)) }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach

            @foreach ($total_servicios_mercado as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>${{ $item->pago }}</td>
                    <td>Servicio</td>
                    <td>{{ date('d/n/y', strtotime($item->fecha)) }}</td>
                    <td>{{ $item->nota }}</td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_mercado as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>${{ $item->pago }}</td>
                    <td>Paquete</td>
                    <td>{{ date('d/n/y', strtotime($item->fecha)) }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Tarjeta <img src="{{ asset('assets/icons/tarjeta-de-credito.png') }}" alt="" width="35px"></h2>

    <table class="table text-center">
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>ID</th>
                <th>Monto</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Nota/Cosme</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($total_producto_tarjeta as $trans)
                <tr>
                    <td>
                        {{ $trans->id }}
                    </td>
                    @if ($trans->metodo_pago2 == 'Tarjeta')
                        <td>
                            ${{ number_format($trans->dinero_recibido2, 1, '.', ',') }}
                        </td>
                    @else
                        <td>
                            ${{ number_format($trans->dinero_recibido, 1, '.', ',') }}
                        </td>
                    @endif
                    <td>
                        Producto
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime($trans->fecha)) }}
                    </td>
                    <td>
                        {{ $trans->User->name }}
                    </td>
                </tr>
            @endforeach

            @foreach ($total_servicios_tarjeta as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        ${{ number_format($item->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        Servicio
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime($item->fecha)) }}
                    </td>
                    <td>
                        {{ $item->nota }}
                    </td>
                </tr>
            @endforeach

            @foreach ($total_paquetes_tarjeta as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        ${{ number_format($item->pago, 1, '.', ',') }}
                    </td>
                    <td>
                        Paquete
                    </td>
                    <td>
                        {{ date('d/n/y', strtotime($item->fecha)) }}
                    </td>
                    <td>
                        {{ $item->User->name }}
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
                <th>#Nota</th>
                <th>User</th>
                <th>Monto</th>
                <th>Metodo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas_propinas as $item)
                <tr>
                    <td>{{ $item->id_nota }}</td>
                    <td>{{ $item->User->name }}</td>
                    <td>
                        ${{ number_format($propina, 1, '.', ',') }}
                    </td>
                    <td>{{ $item->metdodo_pago }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
