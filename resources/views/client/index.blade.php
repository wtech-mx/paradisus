@extends('layouts.app')

@section('template_title')
    Client
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Client') }}
                            </span>
                            @can('client-create')
                                <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Nuevo Cliente
                                </div>
                            @endcan
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            @include('client.create')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                        @include('client.show')
                                        @include('client.edit')
                                            <tr>
                                                <td>{{ ++$i }}</td>

                                                <td>{{ $client->name }}</td>
                                                <td>{{ $client->last_name }}</td>
                                                <td>{{ $client->age }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->email }}</td>

                                                <td>
                                                        <div class="btn btn-sm btn-primary " data-toggle="modal" data-target="#showDataModal{{$client->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> Ver</div>
                                                    @can('client-edit')
                                                        <div class="btn btn-sm btn-success" data-toggle="modal" data-target="#editClientModal{{$client->id}}"><i class="fa fa-fw fa-edit"></i> Editar</div>
                                                    @endcan
                                                    @can('client-delete')
                                                        <form action="{{ route('clients.destroy',$client->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
                {!! $clients->links() !!}
            </div>
        </div>
    </div>
@endsection
