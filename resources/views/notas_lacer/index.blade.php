@extends('layouts.app')

@section('template_title')
    Notas Lacer
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas Lacer</h3>

                            @can('notas-create')
                                <a class="btn btn-sm btn-success" href="{{ route('crear.lacer') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>
                            @endcan

                            <a class="btn btn-sm btn-success" href="{{ route('index_sesiones.laser') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Vista de sesiones
                            </a>

                            <a class="btn btn-sm btn-success" href="{{ route('index_consentimiento.laser') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Vista de Concentiemiento
                            </a>

                            <a class="btn btn-sm btn-success" href="{{ route('imagen_depiladora.laser') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i>Imagen deiladora
                            </a>

                            <a class="btn btn-sm btn-success" href="{{ route('hoja_salud.laser') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Hoja de Salud
                            </a>

                        </div>
                    </div>
                    @can('notas-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($nota_lacer as $notas)
                                            <tr>
                                                    <td>{{ $notas->id }}</td>
                                                    <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}<br> {{ $notas->Client->phone }}</td>
                                                    <td>
                                                        {{$notas->servicio}}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($notas->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                    @if ($notas->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $notas->restante }}</label> </td>
                                                    @endif

                                                    <td>
                                                            <a type="button" class="btn btn-primary btn-sm" href=""style="color: #ffff">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                    </td>
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

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection

