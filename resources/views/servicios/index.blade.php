@extends('layouts.app')

@section('template_title')
    Servicios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Servicios
                            </span>
                            @can('servicios-create')
                            <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Nuevo Servicio
                            </div>
                            @endcan
                        </div>
                    </div>
                    @can('servicios-list')
                        <div class="card-body">
                            @include('servicios.create')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Duración</th>
                                            <th>Categoria</th>
                                            {{-- <th>Act Descuento</th> --}}
                                            <th>Descuento</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($servicio as $servicios)
                                        @include('servicios.show')
                                        @include('servicios.edit')
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $servicios->nombre }}</td>
                                                <td>{{ $servicios->precio }}</td>
                                                <td>{{ $servicios->duracion }}</td>
                                                <td>{{ $servicios->categoria }}</td>
                                                {{-- <td>{{ $servicios->act_descuento }}</td> --}}
                                                <td>{{ $servicios->descuento }}</td>

                                                <td>

                                                        <div class="btn btn-sm btn-primary " data-toggle="modal" data-target="#showDataModal{{$servicios->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> Ver</div>
                                                        @can('servicios-edit')
                                                            <div class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal{{$servicios->id}}"><i class="fa fa-fw fa-edit"></i> Editar</div>
                                                        @endcan
                                                        @can('servicios-delete')
                                                            <form action="{{ route('servicio.destroy',$servicios->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                            </form>
                                                        @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
                {!! $servicio->links() !!}
            </div>
        </div>
    </div>
@endsection
