@extends('layouts.app')

@section('template_title')
    Notas Laser
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas Laser</h3>

                            @can('notas-create')
                                <a class="btn btn-sm btn-success" href="{{ route('crear.lacer') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>
                            @endcan

                        </div>
                    </div>

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
                                                    <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}<br>@can('client-list') {{ $notas->Client->phone }} @endcan</td>
                                                    <td>
                                                        {{$notas->tipo}}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($notas->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                    @if ($notas->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $notas->restante }}</label> </td>
                                                    @endif

                                                    <td>
                                                        @can('client-list')
                                                            <a type="button" class="btn btn-primary btn-sm" href="{{route('laser.pdf_laser', $notas->id)}}"style="color: #ffff">
                                                                <i class="fa fa-print"></i>
                                                            </a>

                                                            <a type="button" class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone=521{{ $notas->Client->phone }}&text=Hola%20Te%20mandamos%20recomendaciones%20del%20antes%20y%20despues%20de%20tu%20cita%20%3A%20%20{{route('index.recomendaciones')}}" target="_blank" style="color: #ffff">
                                                                <i class="fa fa-whatsapp"></i>
                                                            </a>
                                                        @endcan

                                                        <a class="btn btn-sm btn-success" href="{{ route('edit.lacer',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>

                                                        @can('client-list')
                                                        <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('edit_hoja_laser.lacer', $notas->Client->id) }}"><i class="fa fa-fw fa-pencil"></i> </a>
                                                        <a class="btn btn-sm btn-danger" target="_blank" href="{{ route('index_consentimiento.laser', $notas->Client->id) }}"><i class="fa fa-fw fa-file-text-o"></i> </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
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


