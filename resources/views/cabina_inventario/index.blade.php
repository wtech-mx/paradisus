@extends('layouts.app')

@section('template_title')
    Reporte Inventario
@endsection

@section('content')
<div class="container-fluid my-5 py-2">

    <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-4 col-6">
                <div class="card">
                    <div class="card-header mx-4 p-3 text-center">
                        <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                            <i class="fa fa-cube opacity-10"></i>
                        </div>
                    </div>
                    <div class="card-body pt-0 p-3 text-center">
                        <h6 class="text-center mb-0">Total</h6>
                        <span class="text-xs">Productos por agotar</span>
                        <hr class="horizontal dark my-3">
                        <h5 class="mb-0">{{$productos_por_agotar}}</h5>
                    </div>
                </div>
            </div>

           <div class="col-lg-4 col-md-6 col-sm-4 col-6">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                      <i class="fa fa-cubes opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Productos con stock</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$productos_stock}}</h5>
                  </div>
                </div>
           </div>

           <div class="col-lg-4 col-md-6 col-sm-4 col-6">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-danger shadow text-center border-radius-lg">
                      <i class="fa fa-ban opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Agotados</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$productos_agotado}}</h5>
                  </div>
                </div>
           </div>

    </div>

    <div class="row mt-4">
      <div class="col-md-12">
        <div class="card">

          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Pructos</h6>
          </div>

          <div class="card-body pt-4 p-3">
            <div class="chart">
                <canvas id="polar-chart" class="chart-canvas" height="80" width="80"></canvas>
            </div>
          </div>

        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Productos Por agotar</h6>
          </div>
          <div class="card-body pt-4 p-3">
            <canvas id="bar-chart" class="chart-canvas" height="80" width="80"></canvas>
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

<!-- Aquí coloca el código JavaScript -->
<script>
    var ctx10 = document.getElementById("polar-chart").getContext("2d");
    var bar = document.getElementById("bar-chart").getContext("2d");

    new Chart(ctx10, {
        type: "bar",
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode($data) !!},
                backgroundColor: {!! json_encode($backgroundColor) !!},
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

    new Chart(bar, {
        type: "bar",
        data: {
            labels: {!! json_encode($labels2) !!},
            datasets: [{
                label: 'Cantidad',
                data: {!! json_encode($data2) !!},
                backgroundColor: {!! json_encode($backgroundColor2) !!},
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



