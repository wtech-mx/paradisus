@extends('layouts.app')

@section('template_title')
    Reporte
@endsection

@section('content')

@include('layouts.header')

    <div class="container-fluid">
        <div class="row">
            {{-- =============== C A R D   G R A F I C A =============================== --}}
            {{-- <div class="col-sm-6 mb-3">
                <div class="card">

                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Ventas</h6>
                      <div class="d-flex align-items-center">
                        <span class="badge badge-md badge-dot me-4">
                          <i class="bg" style="background: #D4BA7A"></i>
                          <span class="text-dark text-xs">Productos</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                          <i class="bg" style="background: #99696a"></i>
                          <span class="text-dark text-xs">Servicios</span>
                        </span>
                      </div>
                    </div>

                    <div class="card-body p-3">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                        </figure>
                    </div>
                  </div>
            </div> --}}

           {{-- =============== C A R D   P R O G R E S S =============================== --}}
            {{-- <div class="col-sm-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Estadistica por mes
                            </span>
                        </div>
                    </div>
                        <div class="card-body">
                            @foreach($servicios_individual as $serv)
                                @if ($serv->mes ==  $MesActual)

                                    <div class="row mb-3">
                                            <div class="progress-wrapper">
                                                <div class="row">
                                                    <div class="col-10">
                                                        <div class="progress-label">
                                                            <span>{{$serv->Servicios->nombre}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="progress-percentage">
                                                            <span>#{{$serv->filas}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$serv->filas}}%; background-color: {{$serv->Servicios->color}};"></div>
                                                </div>
                                            </div>
                                    </div>
                                @endif
                             @endforeach
                        </div>
                </div>
            </div> --}}

            {{-- =============== C A R D   S E R V I C I O S =============================== --}}
            <div class="col-sm-6 mb-5">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Servicios
                            </span>
                            @can('client-create')
                                <a type="button" class="btn btn-sm bg-gradient-success" href="{{ route('reporte.print_serv') }}"><i class="fa fa-cash"></i> Exportar</a>
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
                                <a type="button" class="btn btn-sm bg-gradient-secondary" href="{{ route('reporte.print_prod') }}"><i class="fa fa-cash"></i> Exportar</a>
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