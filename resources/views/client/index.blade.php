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
                            @include('consentimiento.modal_create')
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('clients_consentimiento.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="precio">Cliente</label><br>
                                            <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client">
                                                <option>Seleccionar cliente</option>
                                                @foreach ($clients as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-2">
                                                <label for="num">Numero de personas</label><br>
                                                <input id="num_personas" name="num_personas" type="number" class="form-control" >
                                        </div>
                                        <div class="col-3">
                                            <label for="num"></label><br>
                                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                        </div>
                                    </div>
                                </form>

                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Estatus</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $client)
                                        @include('client.show')
                                        @include('client.edit')
                                            <tr>
                                                <td>{{ $client->id }}</td>

                                                <td>{{ $client->name }} <br>{{ $client->last_name }}</td>
                                                <td>{{ $client->age }}</td>
                                                <td>{{ $client->phone }}</td>
                                                <td>{{ $client->email }}</td>

                                                <td>
                                                    @if(!empty($client->ConcentimientoFacial->id ))
                                                        @if ($client->ConcentimientoFacial->pregunta2 == NULL)
                                                            <a href="{{ route('clients_consen.cosme',$client->ConcentimientoFacial->id) }}" class="badge badge-pill" style="color: #e30800;background-color: #e31a0040;" target="_blank" >No Realizado </a>
                                                        @else
                                                            <a href="{{ route('clients_consen.cosme',$client->ConcentimientoFacial->id) }}" class="badge badge-pill" style="color: #00e300;background-color: #48e30040;" target="_blank" >Completado </a>
                                                        @endif
                                                    @endif
                                                </td>

                                                <td>
                                                    @if(!empty($client->ConcentimientoFacial->id ))
                                                    <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('clients_consen.user',$client->ConcentimientoFacial->id) }}"><i class="fas fa-signature"></i></a>
                                                    @endif

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

@section('select2')
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">
        $(document).ready(function() {
            $('.cliente').select2();
        });
  </script>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
