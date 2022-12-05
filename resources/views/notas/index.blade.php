@extends('layouts.app')

@section('template_title')
    Notas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Notas
                            </span>

                            <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Nueva Nota
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @include('notas.create')
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table_id">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

										<th>Usuario</th>
										<th>Cliente</th>
										<th>Servicio</th>
										<th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nota as $notas)
                                    @include('notas.show')
                                    @include('notas.edit')
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $notas->User->name }}</td>
											<td>{{ $notas->Client->name }} {{ $notas->Client->last_name }}</td>
											<td>{{ $notas->Servicios->nombre }}</td>
											<td>{{ $notas->fecha }}</td>

                                            <td>

                                                    <div class="btn btn-sm btn-primary " data-toggle="modal" data-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> Ver</div>
                                                    <div class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal{{$notas->id}}"><i class="fa fa-fw fa-edit"></i> Editar</div>
                                                <form action="{{ route('servicio.destroy',$notas->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $nota->links() !!}
            </div>
        </div>
    </div>
@endsection
