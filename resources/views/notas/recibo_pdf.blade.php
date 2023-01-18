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
    .subheader p {
      text-align: right;
    }
    .subheader .izq {
      text-align: left;
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
      text-align: center;
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
    <h1>Paradisus SPA</h1>
    <h2>Recibo de Servicio</h2>
  </header>

  <div class="subheader">
    <div class="izq">
       <b style="color: #CA87A6; font-size:28px">{{$notas_pedidos->Client->name}} {{ $notas_pedidos->Client->last_name }}</b> <br>
       <b style="color: #CA87A6">Fecha:</b>  {{$today}} <br>
       <b style="color: #CA87A6">Num. Nota:</b>  {{$notas_pedidos->id}}
     </div>
  </div>

  <footer>
    <table>
      <tr>
        <td>
          <p>
            <i class="ni ni-phone"></i>
            Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México, CDMX
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
                <td>g</td>
                <td>d</td>
                <td>g</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
