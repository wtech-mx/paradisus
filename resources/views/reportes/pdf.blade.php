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
    <h2>Servicios</h2>
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
        <thead style="background-color: #CA87A6; color: #fff">
            <tr>
                <th>Nota</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Monto</th>
                <th>For. Pago</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $item)
                <tr>
                    <td>{{ $item->id_nota }}</td>
                    <td>{{ $item->Notas->Client->name }}</td>
                    <td> <b>{{ $item->Notas->Servicios->nombre }}</b> </td>
                    <td>${{ $item->pago }}</td>
                    <td>{{ $item->forma_pago }}</td>
                    <td>{{ $item->fecha }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <h2 style="page-break-before: always; text-align: center;">
    Reporte de Cosmes</h2>
    </p>
    @foreach ($servicios_cosmes as $item)
        @if($item->id_user)
            <table class="table text-center">
                <thead style="background-color: #CA87A6; color: #fff">
                    <tr>
                        <th>Nota</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Monto</th>
                        <th>For. Pago</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ $item->id_nota }}</td>
                            <td>{{ $item->id_user }}</td>

                        </tr>
                </tbody>
            </table>
        @endif
    @endforeach --}}

  </div>
</body>
</html>
