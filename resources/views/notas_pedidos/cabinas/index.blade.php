@extends('layouts.app')

@section('template_title')
    Cambio Cabinas
@endsection
@section('css')
<style>
    .cabina-1 {
        background-color: #bc4749;
        color: white
    }

    .cabina-2 {
        background-color: #3E6990;
        color: white
    }

    .cabina-3 {
        background-color: #AABD8C;
    }

    .cabina-4 {
        background-color: #E9E3B4;
    }

    .cabina-5 {
        background-color: #F39B6D;
        color: white
    }

    .cabina-6 {
        background-color: #213555;
        color: white
    }

    .cabina-7 {
        background-color: #3E5879;
        color: white
    }

    .cabina-8 {
        background-color: #D8C4B6;
        color: #213555;
    }

    .cabina-9 {
        background-color: #4F1C51;
        color: white;
    }
</style>
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
                            <h3 class="mb-3">Cambio Cabinas</h3>

                            @can('notas-pedido-create')
                            <a class="btn btn-sm btn-success" href="{{ route('notas_cabinas.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                        {{-- <form method="GET" action="{{ route('notas_cabinas.index') }}" class="mb-4">
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
                        </form> --}}

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
                                        Entregadas
                                      </button>
                                    </li>

                                  </ul>
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                        <table class="table table-flush" id="datatable-search2">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Cabina</th>
                                                    <th>Fecha</th>
                                                    <th>Fecha Aprobada</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>

                                                <tbody class="text-center">
                                                    @foreach ($nota_pedido as $notas)
                                                        <tr>
                                                            <td>{{ $notas->id }}</td>
                                                            <td>
                                                                @if ($notas->cabina == 8)
                                                                    <p class="cabina-{{ $notas->cabina }}">Exfoliación de pies </p>
                                                                @elseif ($notas->cabina == 7)
                                                                    <p class="cabina-{{ $notas->cabina }}">Exfoliación de manos </p>
                                                                @elseif ($notas->cabina == 6)
                                                                    <p class="cabina-{{ $notas->cabina }}">Recepción </p>
                                                                @elseif ($notas->cabina == 9)
                                                                    <p class="cabina-{{ $notas->cabina }}">Laser </p>
                                                                @else
                                                                    <p class="cabina-{{ $notas->cabina }}">{{ $notas->cabina }} </p>
                                                                @endif
                                                            </td>
                                                            <td>{{ $notas->fecha }}</td>
                                                            <td>{{ $notas->fecha_aprobado }}</td>
                                                            <td>
                                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('reposicion.liga', ['id' => $notas->id]) }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>

                                        </table>
                                    </div>

                                    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                        <table class="table table-flush" id="datatable-search">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Cabina</th>
                                                    <th>Fecha</th>
                                                    <th>Fecha Aprobada</th>
                                                    <th>Fecha Entregada</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>

                                                <tbody class="text-center">
                                                    @foreach ($nota_pedidoEnviada as $notas)
                                                        <tr>
                                                            <td>{{ $notas->id }}</td>
                                                            <td>
                                                                @if ($notas->cabina == 8)
                                                                    <p class="cabina-{{ $notas->cabina }}">Exfoliación de pies </p>
                                                                @elseif ($notas->cabina == 7)
                                                                    <p class="cabina-{{ $notas->cabina }}">Exfoliación de manos </p>
                                                                @elseif ($notas->cabina == 6)
                                                                    <p class="cabina-{{ $notas->cabina }}">Recepción </p>
                                                                @elseif ($notas->cabina == 9)
                                                                    <p class="cabina-{{ $notas->cabina }}">Laser </p>
                                                                @else
                                                                    <p class="cabina-{{ $notas->cabina }}">{{ $notas->cabina }} </p>
                                                                @endif
                                                            </td>
                                                            <td>{{ $notas->fecha }}</td>
                                                            <td>{{ $notas->fecha_aprobado }}</td>
                                                            <td>{{ $notas->preparado_hora_y_guia }}</td>
                                                            <td>
                                                                <a class="btn btn-xs btn-info text-white" target="_blank" href="{{ route('reposicion.liga', ['id' => $notas->id]) }}">
                                                                    <i class="fa fa-pencil"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
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
