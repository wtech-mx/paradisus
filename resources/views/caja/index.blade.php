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
                <div class="card">

                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Traffic channels</h6>
                      <div class="d-flex align-items-center">
                        <span class="badge badge-md badge-dot me-4">
                          <i class="bg-primary"></i>
                          <span class="text-dark text-xs">Organic search</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                          <i class="bg-dark"></i>
                          <span class="text-dark text-xs">Referral</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                          <i class="bg-info"></i>
                          <span class="text-dark text-xs">Social media</span>
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
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="card  mb-4">
                                  <div class="card-body p-3">
                                    <div class="row">
                                      <div class="col-8">
                                        <div class="numbers">
                                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos</p>
                                          <h5 class="font-weight-bolder">
                                            ${{ $total_ingreso }}
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
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="card  mb-4">
                                  <div class="card-body p-3">
                                    <div class="row">
                                      <div class="col-8">
                                        <div class="numbers">
                                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Egresos</p>
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
                            {{-- =============== T O T A L =============================== --}}

                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="card  mb-4">
                                  <div class="card-body p-3">
                                    <div class="row">
                                      <div class="col-8">
                                        <div class="numbers">
                                          <p class="text-sm mb-0 text-uppercase font-weight-bold">Total</p>
                                          <h5 class="font-weight-bolder">
                                            ${{ $total }}
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
                               Egresos
                            </span>
                            @can('client-create')
                            <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModa" style="background: {{$configuracion->color_boton_add}}; color: #ffff"><i class="fa fa-close"></i>  Cerrar caja</a>
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


@section('js_custom')

<script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>

<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");


    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    // Line chart
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Organic Search",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#5e72e4",
            borderColor: "#5e72e4",
            borderWidth: 3,
            backgroundColor: gradientStroke1,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6
          },
          {
            label: "Referral",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#3A416F",
            borderColor: "#3A416F",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
            maxBarThickness: 6
          },
          {
            label: "Direct",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 2,
            pointBackgroundColor: "#17c1e8",
            borderColor: "#17c1e8",
            borderWidth: 3,
            backgroundColor: gradientStroke2,
            data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
            maxBarThickness: 6
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });

  </script>

@endsection
