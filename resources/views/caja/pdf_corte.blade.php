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
    <h2>Corte</h2>
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
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <colgroup span="2" width="100"></colgroup>
        <tr>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Transferencia</td>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Mercado Pago</td>
            <td colspan="2" style="background-color: #CA87A6; color: #fff; border: rgb(255, 255, 255) 1px solid;">Tarjeta</td>
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
            <td>{{ $suma_filas_trans }}</td>
            <td>${{ $suma_pago_trans}}</td>

            <td>{{ $suma_filas_mercado }}</td>
            <td>${{ $suma_pago_mercado}}</td>

            <td>{{ $suma_filas_tarjeta }}</td>
            <td>${{ $suma_pago_tarjeta}}</td>
        </tr>
    </table>

    <h2 style="text-align: center;">Transferencia</h2>
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
                    <td>{{ $trans->id }}</td>
                    <td>${{ $trans->total }}</td>
                    <td>Producto</td>
                    <td>{{ $trans->fecha }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach
            @foreach ($total_servicios_trans as $trans)
                <tr>
                    <td>{{ $trans->id }}</td>
                    <td>${{ $trans->pago }}</td>
                    <td>Servicio</td>
                    <td>{{ $trans->fecha }}</td>
                    <td>{{ $trans->nota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Mercado Pago</h2>
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
                    <td>${{ $trans->total }}</td>
                    <td>Producto</td>
                    <td>{{ $trans->fecha }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach
            @foreach ($total_servicios_mercado as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>${{ $item->pago }}</td>
                    <td>Servicio</td>
                    <td>{{ $item->fecha }}</td>
                    <td>{{ $item->nota }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">
        Tarjeta</h2>
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
                    <td>{{ $trans->id }}</td>
                    <td>${{ $trans->total }}</td>
                    <td>Producto</td>
                    <td>{{ $trans->fecha }}</td>
                    <td>{{ $trans->User->name }}</td>
                </tr>
            @endforeach
            @foreach ($total_servicios_tarjeta as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>${{ $item->pago }}</td>
                    <td>Servicio</td>
                    <td>{{ $item->fecha }}</td>
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
                    <td>{{ $item->propina }}</td>
                    <td>{{ $item->metdodo_pago }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
