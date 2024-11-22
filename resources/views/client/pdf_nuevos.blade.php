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
        header {
            position: fixed;
            left: 0px;
            top: -160px;
            right: 0px;
            height: 100px;
            background-color: #322338;
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
            border-bottom: 2px solid #322338;
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
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #F7EAED;
        }
  </style>
    @php
        use App\Models\User;
        use Carbon\Carbon;
    @endphp
<body>
  <header>
    <h1>Nuevos clientes
    </h1>
    <h2>Paradisus
    </h2>
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

  <div id="content" style="margin-top: 3rem">
    <table class="table table-bordered border-primary">
        <thead style="background-color: #322338; color: #fff">
            <tr>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Cosmetologa</th>
                <th>Estatus</th>
                <th>Fecha cita</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($HistorialVendidos as $item)
                @php
                $users = User::whereIn('resourceId', explode(', ', $item->resourceIds))->get();
                $userNames = $users->pluck('name')->implode(', ');
                @endphp
                <tr>
                    <td>{{ $item->Client->name }} {{ $item->Client->last_name }} <br> {{ $item->Client->phone }}</td>
                    <td>
                        {{ $item->Servicios_id->nombre }}
                        @if ($item->id_servicio2 != NULL)
                            <br> {{ $item->Servicios_id2->nombre }}
                        @endif
                    </td>
                    <td>{{ $userNames }}</td>
                    <td>{{ $item->estatus }}</td>
                    <td>{{ Carbon::parse($item->start)->locale('es')->translatedFormat('d F Y h:i a') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  </div>
</body>
</html>
