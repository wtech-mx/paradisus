@extends('layouts.app')

@section('template_title')
    Reporte
@endsection

@section('script')
<script src="{{ asset('assets/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/js/highcharts-3d.js') }}"></script>
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            {{-- =============== C A R D   G R A F I C A =============================== --}}
            <div class="col-sm-6 mb-5">
                <div class="card bg-default">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

           {{-- =============== C A R D   P R O G R E S S =============================== --}}
            <div class="col-sm-6 mb-5">
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
                            <div class="progress-wrapper">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="progress-label">
                                            <span>Faciales</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="progress-percentage">
                                            <span>60%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar bg-default" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="progress-wrapper">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="progress-label">
                                            <span>Corporales</span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="progress-percentage">
                                            <span>30%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =============== C A R D   S E R V I C I O S =============================== --}}
            <div class="col-sm-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Servicios
                            </span>
                            @can('client-create')
                                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff"><i class="fa fa-cash"></i> Exportar</a>
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
                                            <th>Num Nota</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pago as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ $item->pago }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- =============== C A R D   P R O D U C T O S =============================== --}}
            <div class="col-sm-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Productos
                            </span>
                            @can('client-create')
                                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff"><i class="fa fa-cash"></i> Exportar</a>
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
                                            <th>Num Nota</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pago_pedidos as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
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

        </div>

    </div>
@endsection
@section('javascript')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection
