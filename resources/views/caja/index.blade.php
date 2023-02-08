@extends('layouts.app')

@section('template_title')
    Caja
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            @php
                $total_ing = 0;
                $total_ing =  $pago_suma->total +  $pago_pedidos_suma->total + $caja->ingresos;

                $total_egresos = 0;
                $total_egresos = $total_ing - $caja_dia_suma->total;
            @endphp
                {{-- =============== C A R D   T O T A L E S =============================== --}}
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Total') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- =============== I N G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos</p>
                                            <h5 class="font-weight-bolder">
                                                ${{ $total_ing }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle" style="background: {{$configuracion->color_iconos_sidebar}}; color: #ffff">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== E G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Egresos</p>
                                            <h5 class="font-weight-bolder">
                                                ${{ $caja_dia_suma->total }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== T O T A L =============================== --}}

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Total</p>
                                            <h5 class="font-weight-bolder">
                                            ${{ $total_egresos }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== S A L D O  I N I C I A L =============================== --}}

                            @if ($caja == NULL)
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="card  mb-4">
                                        <div class="card-body p-3">
                                            <form method="POST" action="{{ route('caja.caja_inicial') }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Saldo inicial en caja</p>
                                                            <input name="ingresos" id="ingresos" type="number" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <p></p>
                                                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            {{-- =============== C A R D   I N G R E S O S =============================== --}}
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Ingresos
                            </span>
                            @can('client-create')
                                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff"><i class="fa fa-cash"></i> Retirar</a>
                            @endcan
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            @include('caja.create')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Num Nota</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pago as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #7500e3;background-color: #7500e36c;">Nota Servicio</label> </td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ $item->pago }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($pago_pedidos as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #004fe3;background-color: #0062e36c;">Nota Pedido</label> </td>
                                                <td>{{ $item->id }}</td>
                                                <td>${{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- =============== C A R D   E G R E S O S =============================== --}}
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Egresos
                            </span>
                            @can('client-create')
                                <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('caja.print_caja') }}">Caja Reporte</a>
                                <a type="button" class="btn btn-sm btn-outline-warning" href="{{ route('caja.print_corte') }}">Corte</a>
                            @endcan
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Concepto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caja_dia as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td>${{ $item->egresos }}</td>
                                                <td>{{ $item->concepto }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js_custom')

<script src="{{ asset('assets/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/js/highcharts-3d.js') }}"></script>

<script type="text/javascript">
    var noTer = '{{$caja_dia_suma->total}}';
    var Ter = '{{$total_ing}}';
    var Fecha = '{{$fechaActual}}';

    Highcharts.chart('container2', {
        chart: {
            type: 'column',
        },
        title: {
            text: 'Grafica del Dia'
        },
        accessibility: {
            announceNewData: {
                enabled: true
            }
        },
        xAxis: {
        type: 'category'
        },
        yAxis: {
            title: {
                text: 'Capital'
            }

        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '${point.y:.0f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>${point.y:.0f}</b>'
        },
        series: [{
            name: Fecha,
            colorByPoint: true,
            data: [
                {
                    name: "Ingresos",
                    y: + Ter,
                    drilldown: "Ingresos"
                },
                {
                    name: "Egresos",
                    y: + noTer,
                    drilldown: "Egresos"
                },
            ]
        }]
    });
</script>

@endsection
