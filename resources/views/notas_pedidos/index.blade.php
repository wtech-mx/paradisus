@extends('layouts.app')

@section('template_title')
    Notas Pedidos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Notas Pedidos</h3>

                            @can('notas-pedido-create')
                            <a class="btn btn-sm btn-success" href="{{ route('notas_pedidos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                        <form method="GET" action="{{ route('notas_pedidos.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="start_date">Fecha de inicio:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-5">
                                    <label for="end_date">Fecha de fin:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                                </div>
                            </div>
                        </form>

                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                        Realizadas
                                      </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                        Cancelados
                                      </button>
                                    </li>

                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <table class="table table-flush" id="datatable-search2">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>

                                                    <th>Cosme</th>
                                                    <th>Cliente</th>
                                                    <th>Total</th>
                                                    <th>Metodo Pago</th>
                                                    {{-- <th>Estatus</th> --}}
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>

                                                <tbody>
                                                    @foreach ($nota_pedido as $notas)
                                                        <tr>
                                                            <td>{{ $notas->id }}</td>

                                                            <td>
                                                                @php
                                                                    $words = explode(' ', $notas->User->name);
                                                                    $chunks = array_chunk($words, 2);
                                                                    foreach ($chunks as $chunk) {
                                                                        echo implode(' ', $chunk) . '<br>';
                                                                    }
                                                                @endphp
                                                            </td>

                                                            {{-- <td>{{ $notas->User->name }}</td> --}}
                                                            <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}</td>
                                                            <td>${{ $notas->total }} mxn</td>
                                                            @if ($notas->metodo_pago == "Mercado Pago")
                                                            <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">{{ $notas->metodo_pago }}</label> </td>
                                                            @elseif ($notas->metodo_pago == "Transferencia")
                                                            <td> <label class="badge" style="color: #072146;background-color: #0721463b;">{{ $notas->metodo_pago }}</label> </td>
                                                            @else
                                                            <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">{{ $notas->metodo_pago }}</label> </td>
                                                            @endif

                                                            {{-- <td>
                                                                <a type="button" class="btn btn-success btn-xs" data-bs-toggle="modal" data-bs-target="#exampleModal_{{$notas->id }}">
                                                                    Realizados
                                                                </a>
                                                            </td> --}}
                                                            {{-- <td>{{ $notas->fecha }}</td> --}}
                                                            <td>
                                                                @php
                                                                $fecha =  $notas->fecha;
                                                                $fecha_timestamp = strtotime($fecha);
                                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                                @endphp
                                                                {{$fecha_formateada}}
                                                            </td>

                                                            <td>

                                                                    {{-- <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                                    @can('notas-pedido-edit')
                                                                        <a class="btn btn-xs btn-success" href="{{ route('notas_pedidos.edit',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                                    @endcan
                                                                        <a type="button" class="btn btn-primary btn-xs" href="{{route('notas_pedidos.imprimir',$notas->id)}}"style="color: #ffff">
                                                                            <i class="fa fa-print"></i>
                                                                        </a>
                                                                    @can('notas-pedido-delete')
                                                                        <form id="myFormEstatus" method="POST" action="{{ route('update_estatus.pedido',  $notas->id) }}" enctype="multipart/form-data" role="form">
                                                                         @csrf
                                                                            @method('PATCH')
                                                                            <input type="hidden" value="Cancelada"name="estatus_cotizacion" >
                                                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash"></i> </button>
                                                                        </form>
                                                                    @endcan
                                                                    {{-- <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_pedido_{{ $notas->id }}">
                                                                       Productos
                                                                    </a> --}}
                                                            </td>
                                                        </tr>
                                                        {{-- @include('notas_pedidos.modal_estatus') --}}
                                                    @endforeach
                                                </tbody>

                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <table class="table table-flush" id="datatable-search">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>

                                                    <th>Cosme</th>
                                                    <th>Cliente</th>
                                                    <th>Total</th>
                                                    <th>Metodo Pago</th>
                                                    <th>Fecha</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>

                                                <tbody>
                                                    @foreach ($nota_pedidoCancelado as $notas)
                                                        <tr>
                                                            <td>{{ $notas->id }}</td>
                                                            <td>
                                                                @php
                                                                    $words = explode(' ', $notas->User->name);
                                                                    $chunks = array_chunk($words, 2);
                                                                    foreach ($chunks as $chunk) {
                                                                        echo implode(' ', $chunk) . '<br>';
                                                                    }
                                                                @endphp
                                                            </td>

                                                            <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}</td>
                                                            <td>${{ $notas->total }} mxn</td>
                                                            @if ($notas->metodo_pago == "Mercado Pago")
                                                            <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">{{ $notas->metodo_pago }}</label> </td>
                                                            @elseif ($notas->metodo_pago == "Transferencia")
                                                            <td> <label class="badge" style="color: #072146;background-color: #0721463b;">{{ $notas->metodo_pago }}</label> </td>
                                                            @else
                                                            <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">{{ $notas->metodo_pago }}</label> </td>
                                                            @endif


                                                            <td>
                                                                @php
                                                                $fecha =  $notas->fecha;
                                                                $fecha_timestamp = strtotime($fecha);
                                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                                @endphp
                                                                {{$fecha_formateada}}
                                                            </td>
                                                            <td>

                                                                    {{-- <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                                    @can('notas-pedido-edit')
                                                                        <a class="btn btn-xs btn-success" href="{{ route('notas_pedidos.edit',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                                    @endcan
                                                                        <a type="button" class="btn btn-primary btn-xs" href="{{route('notas_pedidos.imprimir',$notas->id)}}"style="color: #ffff">
                                                                            <i class="fa fa-print"></i>
                                                                        </a>

                                                                    {{-- <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_pedido_{{ $notas->id }}">
                                                                       Productos
                                                                    </a> --}}
                                                            </td>
                                                        </tr>
                                                        @include('notas_pedidos.modal_estatus')
                                                    @endforeach
                                                </tbody>

                                        </table>
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
<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
      searchable: true,
      fixedHeight: false
    });

</script>
@endsection


@section('js_custom')
<script>
    function abrir(url,largo,altura) {
    open(url,'','top=100,left=100,width='+largo+',height='+altura+'') ;
    }
</script>

@endsection
