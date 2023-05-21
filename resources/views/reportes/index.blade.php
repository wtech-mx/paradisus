@extends('layouts.app')

@section('template_title')
    Reporte
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
<style>
    .grafica_syle{
        width: 30px;
        margin-left: 10px;
        border-radius: 9px;
        font-variant: diagonal-fractions;
        display: inline-block;
    }
</style>
@endsection
@section('content')

@include('layouts.header')

@php
    $fechaActual = date('d/m/Y');
@endphp

    <div class="container-fluid">
        <div class="row">
            {{-- =============== C A R D   S E R V I C I O S =============================== --}}
            <div class="col-sm-12 mb-5">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                               <strong>
                                Reportes
                               </strong>
                            </span>
                        </div>

                        <form class="row mt-5" action="{{ route('advance_search') }}" method="GET" >
                            <div class="col-2 ml-3">
                                <label class="form-label">Del</label>
                                <div class="input-group">
                                    <input name="fecha" class="form-control"
                                        type="date" >
                                </div>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Al</label>
                                <div class="input-group">
                                    <input  name="fecha2" type="date" class="form-control" >
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="form-label">Tipo</label>
                                <div class="input-group">
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="" selected>Todos</option>
                                        <option value="NOTA SERVICIO">NOTA SERVICIO</option>
                                        <option value="NOTA PRODUCTOS">NOTA PRODUCTOS</option>
                                        <option value="NOTA PAQUETE">NOTA PAQUETE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="form-label">Pago</label>
                                <div class="input-group">
                                    <select class="form-control" name="metodo_pago" id="metodo_pago">
                                        <option value="" selected>Todos</option>
                                        <option value="Mercado Pago">Mercado Pago</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Gift Card">Gift Card</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                            @can('client-create')
                                <button class="btn btn-sm mt-4" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                <a type="button" class="btn btn-sm mt-4 bg-gradient-success" href="{{ route('reporte.index') }}"><i class="fa fa-cash"></i> Limpiar</a>
                            @endcan
                            </div>
                        </form>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            @include('caja.create')
                            <div class="table-responsive">
                                <table class="table table-hover text-center" id="orden_servicio">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Num Nota</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Restante</th>
                                            <th class="text-center">Metodo de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reporte as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>

                                                @if ($item->tipo == 'NOTA SERVICIO')
                                                <td>{{ $item->id_nota }}</td>
                                                <td> <label class="badge" style="color: #7500e3;background-color: #7500e36c;">NOTA SERVICIO</label> </td>
                                                @elseif ($item->tipo == 'NOTA PRODUCTOS')
                                                <td>{{ $item->id_producto }}</td>
                                                <td> <label class="badge" style="color: #004fe3;background-color: #0062e36c;">NOTA PRODUCTOS</label> </td>
                                                @else
                                                <td>{{ $item->id_paquete }}</td>
                                                <td> <label class="badge" style="color: #e300aa;background-color: #e3009f6c;">NOTA PAQUETE</label> </td>
                                                @endif
                                                <td>${{ $item->monto }}</td>
                                                <td>${{ $item->pago }}</td>
                                                <td><b>${{ $item->restante }}</b></td>
                                                <td><b>{{ $item->metodo_pago }}</b></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h4 class="text-center mt-3 mb-2">Graficas </h4>
                                </div>

                                <div class="col-4 mt-5">
                                    <h4 class="text-center mt-2">NOTAS SERVICIOS </h4>
                                    @php
                                        $total = $totalNotaTrans + $totalNotaTarjeta + $totalNotaEfectivo;
                                        $totalformateado = number_format($total, 1, '.', ',');
                                    @endphp
                                    <p class="text-center mb-3"><strong>${{ $totalformateado }}</strong></p>
                                    <div class="d-flex justify-content-around">
                                        @php
                                            $totalPagadoFormattedTrans = number_format($totalNotaTrans, 1, '.', ',');
                                            $totalPagadoFormattedTarjeta = number_format($totalNotaTarjeta, 1, '.', ',');
                                            $totalPagadoFormattedEfectivo = number_format($totalNotaEfectivo, 1, '.', ',');
                                        @endphp
                                        <h6>Transferencia:<div class="grafica_syle" style="background: #2152ff;">-</div></br>$ {{ $totalPagadoFormattedTrans }}</h6>
                                        <h6>Tarjeta:<div class="grafica_syle" style="background: #3A416F;">-</div></br>$ {{ $totalPagadoFormattedTarjeta }}</h6>
                                        <h6>Efectivo:<div class="grafica_syle" style="background: #f53939;">-</div></br>$ {{ $totalPagadoFormattedEfectivo }}</h6>
                                    </div>
                                    <div class="chart">
                                        <canvas id="polar-chart" class="chart-canvas" height="80" width="80"></canvas>
                                    </div>
                                </div>

                                <div class="col-4 mt-5">
                                    <h4 class="text-center mt-2">NOTAS PRODUCTOS </h4>
                                    @php
                                    $totalproduct = $totalProductoTrans + $totalProductoTarjeta + $totalProductoEfectivo;
                                    $totalformateadoproduct = number_format($totalproduct, 1, '.', ',');
                                    @endphp
                                    <p class="text-center mb-3"><strong>${{ $totalformateadoproduct }}</strong></p>
                                    <div class="d-flex justify-content-around">
                                        @php
                                            $totalPagadoProductoFormattedTrans = number_format($totalProductoTrans, 1, '.', ',');
                                            $totalPagadoProductoFormattedTarjeta = number_format($totalProductoTarjeta, 1, '.', ',');
                                            $totalPagadoProductoFormattedEfectivo = number_format($totalProductoEfectivo, 1, '.', ',');
                                        @endphp
                                        <h6>Transferencia:<div class="grafica_syle" style="background: #2152ff;">-</div></br>$ {{ $totalPagadoProductoFormattedTrans }}</h6>
                                        <h6>Tarjeta:<div class="grafica_syle" style="background: #3A416F;">-</div></br>$ {{ $totalPagadoProductoFormattedTarjeta }}</h6>
                                        <h6>Efectivo:<div class="grafica_syle" style="background: #f53939;">-</div></br>$ {{ $totalPagadoProductoFormattedEfectivo }}</h6>
                                    </div>
                                    <div class="chart">
                                        <canvas id="polar-chart2" class="chart-canvas" height="80" width="80"></canvas>
                                    </div>
                                </div>

                                <div class="col-4 mt-5">
                                    <h4 class="text-center mt-2">NOTAS PAQUETES </h4>
                                    @php
                                    $totalpaquetes = $totalPaqueteTrans + $totalPaqueteTarjeta + $totalPaqueteEfectivo;
                                    $totalformateadopaquetes = number_format($totalpaquetes, 1, '.', ',');
                                    @endphp
                                    <p class="text-center mb-3"><strong>${{ $totalformateadopaquetes }}</strong></p>
                                    <div class="d-flex justify-content-around">
                                        @php
                                            $totalPagadoPaquetesFormattedTrans = number_format($totalPaqueteTrans, 1, '.', ',');
                                            $totalPagadoPaquetesFormattedTarjeta = number_format($totalPaqueteTarjeta, 1, '.', ',');
                                            $totalPagadoPaquetesFormattedEfectivo = number_format($totalPaqueteEfectivo, 1, '.', ',');
                                        @endphp
                                        <h6>Transferencia:<div class="grafica_syle" style="background: #2152ff;">-</div></br>$ {{ $totalPagadoPaquetesFormattedTrans }}</h6>
                                        <h6>Tarjeta:<div class="grafica_syle" style="background: #3A416F;">-</div></br>$ {{ $totalPagadoPaquetesFormattedTarjeta }}</h6>
                                        <h6>Efectivo:<div class="grafica_syle" style="background: #f53939;">-</div></br>$ {{ $totalPagadoPaquetesFormattedEfectivo }}</h6>
                                    </div>
                                    <div class="chart">
                                        <canvas id="polar-chart3" class="chart-canvas" height="80" width="80"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endcan
                </div>
            </div>


        </div>
    </div>
@endsection
@section('datatable')
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
            $('#orden_servicio').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excel',
                    'pdf',
                    'colvis'
                ],
                responsive: true,
                stateSave: true,

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        });

    // polar chart
    var ctx10 = document.getElementById("polar-chart").getContext("2d");
    var ctx11 = document.getElementById("polar-chart2").getContext("2d");
    var ctx12 = document.getElementById("polar-chart3").getContext("2d");

    new Chart(ctx10, {
    //   type: "pie",
      type: "polarArea",
      data: {
        labels: [
          'Transferencia',
          'Tarjeta',
          'Efectivo',
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [{{ $totalNotaTrans }}, {{ $totalNotaTarjeta }}, {{ $totalNotaEfectivo }},],
          backgroundColor: ["#2152ff", "#3A416F", "#f53939"],
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });


    new Chart(ctx11, {
    //   type: "pie",
      type: "polarArea",
      data: {
        labels: [
          'Transferencia',
          'Tarjeta',
          'Efectivo',
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [{{ $totalProductoTrans }}, {{ $totalProductoTarjeta }}, {{ $totalProductoEfectivo }},],
          backgroundColor: ["#2152ff", "#3A416F", "#f53939"],
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });


    new Chart(ctx12, {
    //   type: "pie",
      type: "polarArea",
      data: {
        labels: [
          'Transferencia',
          'Tarjeta',
          'Efectivo',
        ],
        datasets: [{
          label: 'My First Dataset',
          data: [{{ $totalPaqueteTrans }}, {{ $totalPaqueteTarjeta }}, {{ $totalPaqueteEfectivo }},],
          backgroundColor: ["#2152ff", "#3A416F", "#f53939"],
        }]
      },
      options: {
        plugins: {
          legend: {
            display: false,
          }
        }
      }
    });
</script>
@endsection

