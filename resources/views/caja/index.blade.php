@extends('layouts.app')

@section('template_title')
    Caja
@endsection

@section('script')
<script src="{{ asset('assets/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/js/highcharts-3d.js') }}"></script>
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            @php
                $total_ingreso = 0;
                $pago_total = 0;
                foreach ($pago as $item){
                    $pago_total = $total_ingreso + $item->pago;
                }
                $pedidos_total = 0;
                foreach ($pago_pedidos as $item){
                    $pedidos_total = $total_ingreso + $item->total;
                }

                $total_ingreso = $pago_total + $pedidos_total;
                $total_egresos = 0;
                foreach ($caja_dia as $item){
                    $total_egresos = $total_egresos + $item->egresos;
                }

                $total = $total_ingreso - $total_egresos;
            @endphp
            {{-- =============== C A R D   G R A F I C A =============================== --}}
            <div class="col-sm-6">
                <div class="card bg-default">
                    <div class="card-body">
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>

           {{-- =============== C A R D   T O T A L E S =============================== --}}
            <div class="col-sm-6">
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
                            <div class="col-6">
                                <div style="width: 13rem;">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Ingresos</h5>
                                                    <span class="h2 font-weight-bold mb-0">${{ $total_ingreso }}</span>
                                                </div>
                                                <div class="col-auto">
                                                <div class="icon icon-shape rounded-circle shadow" style="background: {{$configuracion->color_iconos_sidebar}}; color: #ffff">
                                                    <i class="ni ni-cloud-download-95"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- =============== E G R E S O S =============================== --}}
                            <div class="col-6">
                                <div style="width: 13rem;">
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <h5 class="card-title text-uppercase text-muted mb-0">Egresos</h5>
                                                    <span class="h2 font-weight-bold mb-0">${{ $total_egresos }}</span>
                                                </div>
                                                <div class="col-auto">
                                                <div class="icon icon-shape rounded-circle shadow" style="background: {{$configuracion->color_principal}}; color: #ffff">
                                                    <i class="ni ni-cloud-upload-96"></i>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- =============== T O T A L =============================== --}}
                            <div style="width: 18rem;">
                                <div class="card card-stats">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">Total</h5>
                                                <span class="h2 font-weight-bold mb-0">${{ $total }}</span>
                                            </div>
                                            <div class="col-auto">
                                            <div class="icon icon-shape rounded-circle shadow" style="background: {{$configuracion->color_principal}}; color: #ffff">
                                                <i class="ni ni-chart-pie-35"></i>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                {{ __('Ingresos') }}
                            </span>
                            @can('client-create')
                                <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Retirar
                                </div>
                            @endcan
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            @include('caja.create')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id">
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
                                {{ __('Egresos') }}
                            </span>
                            @can('client-create')
                            <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModa" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Cerrar caja
                            </div>
                        @endcan
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id">
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
