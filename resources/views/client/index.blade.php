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
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">


                            <h3 class="mb-3">Clientes</h3>

                            @can('client-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan

                            {{-- <form action="" method="post" enctype="multipart/form-data">
                                @csrf

                                <input type="file" name="file">

                                <button>Importar Usuarios</button>
                            </form> --}}

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            @include('client.create')
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
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

                                                <td>{{ $client->name }} <br>{{ $client->last_name }}</td>
                                                <td>{{ $client->age }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->email }}</td>

                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$client->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a>
                                                    @can('client-edit')
                                                        <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editClientModal{{$client->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a>
                                                    @endcan
                                                    @can('client-delete')
                                                        <form action="{{ route('clients.destroy',$client->id) }}" method="POST" style="display: contents">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
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
