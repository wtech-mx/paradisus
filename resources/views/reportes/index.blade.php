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
            <div class="col-sm-6 mb-3">
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
                      <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                      </div>
                    </div>
                  </div>
            </div>

           {{-- =============== C A R D   P R O G R E S S =============================== --}}
            <div class="col-sm-6 mb-3">
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
                                @if ($serv->mes ==  $fechaActual)
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
@section('js_custom')

<script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>

<script>
        const dato = {!! json_encode($pedidos_total) !!};
        const cData = JSON.parse(dato)
        console.log(cData);

        const ctx = document.getElementById('chart-line').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: cData.total,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

</script>
@endsection
