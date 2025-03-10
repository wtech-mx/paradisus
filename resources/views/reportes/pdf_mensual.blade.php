<!doctype html>
<html lang="en">
<head>
  <style>
    body{
      font-family: sans-serif;
    }
    h1{
        text-align: center;
        color: #ef6351;
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

  <main>
    <h1>Reporte Mensual</h1>
    <h2 style="color: #f7a399">Índice</h2>

      <a style="color: #f38375; font-size: 20px" href="#resumen-general">1. Resumen General</a><br><br>
      <a style="color: #f38375; font-size: 20px" href="#clientes">2. Clientes</a><br><br>
      <a style="color: #f38375; font-size: 20px" href="#servicios-paquetes">3. Servicios y Paquetes</a><br><br>
      <a style="color: #f38375; font-size: 20px" href="#cosmetologas">4. Cosmetólogas</a><br><br>
      <a style="color: #f38375; font-size: 20px" href="#pagos">5. Pagos</a><br><br>
      <!-- Agrega más elementos del índice según sea necesario -->


    <div class="page-break"></div>
    <h2 id="resumen-general" style="color: #fb6f92">1. Resumen General</h2>
    <li>Total de citas agendadas:</li>
    <table>
        <thead>
            <tr>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chart}}" style="width: 40%">
                </th>

                <th>
                    <p style="color: #f28482">Mes Actual</p>
                    <p style="color: #84a59d">Mes Anterior</p>
                    <p style="color: #f5cac3">Hace 2 meses</p>
                </th>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Total de citas realizadas</th>
                <th>Total de citas canceladas</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chartCitasRealizadas}}" style="width: 70%">
                </th>

                <th>
                    <img src="{{$chartCitasCanceladas}}" style="width: 70%"><br>
                    <label style="color: #f28482">Mes Actual</label><br>
                    <label style="color: #84a59d">Mes Anterior</label><br>
                    <label style="color: #f5cac3">Hace 2 meses</label><br>
                </th>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>
    <h2 id="clientes" style="color: #1a759f">2. Clientes</h2>
    <table>
        <thead>
            <tr>
                <th>Clientes nuevos</th>
                <th>Clientes recurrentes</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chartclientesNuevos}}" style="width: 60%"><br>
                    <label style="color: #168aad">Mes Actual</label><br>
                    <label style="color: #34a0a4">Mes Anterior</label><br>
                    <label style="color: #52b69a">Hace 2 meses</label><br>
                </th>

                <th>
                    <img src="{{$chartclientesRecurrentes}}" style="width: 70%">
                </th>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th>Servicios más solicitados por clientes nuevos</th>
                <th>Servicios más solicitados por clientes recurrentes</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chartServiciosMasSolicitados}}" style="width: 80%">
                </th>

                <th>
                    <img src="{{$chartServiciosMasSolicitadosRecurrentes}}" style="width: 80%">
                </th>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>
    <h2 id="servicios-paquetes" style="color: #344e41">3. Servicios y Paquetes</h2>
    <li>5 Servicios <b>faciales</b> mas vendidos</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
            <tr style="background: #dad7cd; color: #588157">
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $serviciosFacialesMesActual[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosFacialesMesActual[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosFacialesMesAnterior[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosFacialesMesAnterior[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosFacialesDosMesesAtras[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosFacialesDosMesesAtras[$i]->total ?? '-' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <div class="page-break"></div>
    <li>5 Servicios <b>corporales</b> mas vendidos</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
            <tr style="background: #dad7cd; color: #588157">
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $serviciosCorporalesMesActual[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosCorporalesMesActual[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosCorporalesMesAnterior[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosCorporalesMesAnterior[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosCorporalesDosMesesAtras[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosCorporalesDosMesesAtras[$i]->total ?? '-' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <li>5 <b>Experiencias</b> mas vendidos</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
            <tr style="background: #dad7cd; color: #588157">
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $serviciosexperienciasMesActual[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosexperienciasMesActual[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosexperienciasMesAnterior[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosexperienciasMesAnterior[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosexperienciasDosMesesAtras[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosexperienciasDosMesesAtras[$i]->total ?? '-' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <div class="page-break"></div>
    <li>5 <b>Paquetes</b> mas vendidos</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
            <tr style="background: #dad7cd; color: #588157">
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Servicio</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $serviciosPaquetesMesActual[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosPaquetesMesActual[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosPaquetesMesAnterior[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosPaquetesMesAnterior[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosPaquetesDosMesesAtras[$i]->nombre ?? '-' }}</td>
                    <td>{{ $serviciosPaquetesDosMesesAtras[$i]->total ?? '-' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <li>5 Zonas <b>Laser</b> mas vendidos</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
            <tr style="background: #dad7cd; color: #588157">
                <th>Zona</th>
                <th>Cantidad</th>
                <th>Zona</th>
                <th>Cantidad</th>
                <th>Zona</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>{{ $serviciosLaserMesActual[$i]->zona ?? '-' }}</td>
                    <td>{{ $serviciosLaserMesActual[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosLaserMesAnterior[$i]->zona ?? '-' }}</td>
                    <td>{{ $serviciosLaserMesAnterior[$i]->total ?? '-' }}</td>
                    <td>{{ $serviciosLaserDosMesesAtras[$i]->zona ?? '-' }}</td>
                    <td>{{ $serviciosLaserDosMesesAtras[$i]->total ?? '-' }}</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <li>Ticket promedio por cliente (cuánto gasta cada cliente en promedio)</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #3a5a40; color: white">
                <th colspan="2">Mes actual</th>
                <th colspan="2">Mes anterior</th>
                <th colspan="2">Hace 2 meses</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">${{ number_format($ticketPromedioMesActual, 2, '.', ',') }}</td>
                <td colspan="2">${{ number_format($ticketPromedioMesAnterior, 2, '.', ',') }}</td>
                <td colspan="2">${{ number_format($ticketPromedioHaceDosMeses, 2, '.', ',') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>
    <h2 id="cosmetologas" style="color: #e76f51">4. Cosmetólogas</h2>
    <li>Número de servicios realizados por cada cosmetóloga</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #f4a261; color: white">
                <th>Cosmetóloga</th>
                <th>Mes Actual</th>
                <th>Mes Anterior</th>
                <th>Hace 2 Meses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($serviciosPorCosmetologaMesActual as $servicio)
                <tr>
                    <td>{{ $servicio->cosmetologa }}</td>
                    <td>{{ $servicio->total }}</td>
                    <td>{{ $serviciosPorCosmetologaMesAnterior->firstWhere('cosmetologa', $servicio->cosmetologa)->total ?? '-' }}</td>
                    <td>{{ $serviciosPorCosmetologaDosMesesAtras->firstWhere('cosmetologa', $servicio->cosmetologa)->total ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <li>Ingresos generados por cada cosmetóloga</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #e9c46a; color: white">
                <th>Cosmetóloga</th>
                <th>Mes Actual</th>
                <th>Mes Anterior</th>
                <th>Hace 2 Meses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingresosPorCosmetologaMesActual as $ingreso)
                <tr>
                    <td>{{ $ingreso['cosmetologa'] }}</td>
                    <td>${{ number_format($ingreso['total'], 2, '.', ',') }}</td>
                    <td>
                        @if(isset($MesAnterioringresosPorCosmetologaMesActual->firstWhere('cosmetologa', $ingreso['cosmetologa'])['total']))
                            ${{ number_format($MesAnterioringresosPorCosmetologaMesActual->firstWhere('cosmetologa', $ingreso['cosmetologa'])['total'], 2, '.', ',') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(isset($HaceDosMesesingresosPorCosmetologaMesActual->firstWhere('cosmetologa', $ingreso['cosmetologa'])['total']))
                            ${{ number_format($HaceDosMesesingresosPorCosmetologaMesActual->firstWhere('cosmetologa', $ingreso['cosmetologa'])['total'], 2, '.', ',') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <li>Cosmetólogas con más cancelaciones</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #2a9d8f; color: white">
                <th>Cosmetóloga</th>
                <th>Mes Actual</th>
                <th>Mes Anterior</th>
                <th>Hace 2 Meses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cosmetologasConMasCancelacionesMesActual as $cosme)
                <tr>
                    <td>{{ $cosme->cosmetologa }}</td>
                    <td>{{ $cosme->total_cancelaciones }}</td>
                    <td>{{ $cosmetologasConMasCancelacionesMesAnterior->firstWhere('cosmetologa', $cosme->cosmetologa)->total_cancelaciones ?? '-' }}</td>
                    <td>{{ $cosmetologasConMasCancelacionesDosMesesAtras->firstWhere('cosmetologa', $cosme->cosmetologa)->total_cancelaciones ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>
    <h2 id="pagos" style="color: #800f2f">5. Pagos</h2>
    <li>Total de ingresos del mes</li>
    <table>
        <thead>
            <tr>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th>
                    <img src="{{$chartPagos}}" style="width: 40%">
                </th>

                <th>
                    <p style="color: #a4133c">Mes Actual ${{ number_format($totalPagosMesActual, 2, '.', ',') }}</p>
                    <p style="color: #c9184a">Mes Anterior ${{ number_format($totalPagosMesAnterior, 2, '.', ',') }}</p>
                    <p style="color: #ff4d6d">Hace 2 meses ${{ number_format($totalPagosDosMesesAtras, 2, '.', ',') }}</p>
                </th>
            </tr>
        </tbody>
    </table>

    <li>Ingresos por tipo de pago</li>
    <table>
        <thead>
            <tr style="background: #ff758f; color: white">
                <th>Metodo de pago</th>
                <th>Monto</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Efectivo</td>
                <td>${{ number_format($totalPagosEfectivoMesActual, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td>Tarjeta</td>
                <td>${{ number_format($totalPagosTarjetaMesActual, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td>Transferencia</td>
                <td>${{ number_format($totalPagosTransferenciaMesActual, 2, '.', ',') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>
    {{-- <h2 style="color: #0d1321">8. Indicadores Especiales</h2>
    <li>Citas ocupadas vs citas disponibles</li>
    <table class="table table-bordered">
        <thead>
            <tr style="background: #1d2d44; color: white">
                <th>Mes</th>
                <th>Citas Agendadas</th>
                <th>Lugares Libres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($espaciosPorMes as $mes => $espacios)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($mes . '-01')->translatedFormat('F Y') }}</td>
                    <td>{{ $citas[$mes] ?? 0 }}</td>
                    <td>{{ $espacios - ($citas[$mes] ?? 0) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
  </main>

</body>
</html>
