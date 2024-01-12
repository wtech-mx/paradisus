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
        <div class="col-md-6">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Bodega</h6>
                <a type="button" class="btn btn-sm btn-outline-warning" href="{{ route('productos_reporte.imprimir') }}">Imprimir</a>
                <a type="button" class="btn btn-sm btn-outline-warning" href="{{ route('reporte_inv.pdf') }}">Imprimir 2</a>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Cantidad</th>
                                <th>Producto</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosSemana as $producto)
                                    <tr>
                                        @if ($producto->cantidad == 0)
                                        <td>
                                            <input type="text" class="form-control input-cantidad" style="color: #e30000;background-color: #e3000040;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}" disabled>
                                        </td>
                                        @elseif ($producto->cantidad <= 2 && $producto->cantidad >= 0)
                                        <td>
                                            <input type="text" class="form-control input-cantidad" style="color: #c54003;background-color: #c764023b;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}" disabled>
                                        </td>
                                        @else
                                        <td>
                                            <input type="text" class="form-control input-cantidad" style="color: #70b06a;background-color: #6ab06d61;" data-id="{{ $producto->id }}" value="{{ $producto->cantidad }}" disabled>
                                        </td>
                                        @endif

                                        <td>{{ $producto->nombre }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Cabina 1</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Producto</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosinvSemana1 as $producto)
                                    <tr>
                                        <td>
                                            {{ $producto->Productos->nombre }}
                                        </td>

                                        @if ($producto->estatus == NULL)
                                            <td>{{ $producto->cantidad }}</td>
                                        @else
                                            <td>{{ $producto->estatus }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Cabina 2</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Producto</th>
                                <th>Estatus/Cantidad</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosinvSemana2 as $producto)
                                    <tr>
                                        <td>
                                            {{ $producto->Productos->nombre }}
                                        </td>

                                        @if ($producto->estatus == NULL)
                                            <td>{{ $producto->cantidad }}</td>
                                        @else
                                            <td>{{ $producto->estatus }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Cabina 3</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Producto</th>
                                <th>Estatus/Cantidad</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosinvSemana3 as $producto)
                                    <tr>
                                        <td>
                                            {{ $producto->Productos->nombre }}
                                        </td>

                                        @if ($producto->estatus == NULL)
                                            <td>{{ $producto->cantidad }}</td>
                                        @else
                                            <td>{{ $producto->estatus }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Cabina 4</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Producto</th>
                                <th>Estatus/Cantidad</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosinvSemana4 as $producto)
                                    <tr>
                                        <td>
                                            {{ $producto->Productos->nombre }}
                                        </td>

                                        @if ($producto->estatus == NULL)
                                            <td>{{ $producto->cantidad }}</td>
                                        @else
                                            <td>{{ $producto->estatus }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card">

                <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Productos editados Cabina 5</h6>
                </div>

                <div class="card-body pt-4 p-3">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="thead">
                            <tr>
                                <th>Producto</th>
                                <th>Estatus/Cantidad</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($productosinvSemana5 as $producto)
                                    <tr>
                                        <td>
                                            {{ $producto->Productos->nombre }}
                                        </td>

                                        @if ($producto->estatus == NULL)
                                            <td>{{ $producto->cantidad }}</td>
                                        @else
                                            <td>{{ $producto->estatus }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                </div>

            </div>
        </div>

      <div class="col-md-12 mt-3">
        <div class="card">

          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Productos stock</h6>
          </div>

          <div class="card-body pt-4 p-3">
            <div class="chart">
                <canvas id="polar-chart" class="chart-canvas" height="80" width="80"></canvas>
            </div>
          </div>

        </div>
      </div>

      <div class="col-md-12 mt-3">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Productos por agotar</h6>
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
<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

</script>
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



