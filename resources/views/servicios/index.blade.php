@extends('layouts.app')

@section('template_title')
    Servicios
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="mb-3">Servicios</h3>

                @can('servicios-create')
                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    Nuevo Servicio
                </a>
                @endcan

            </div>
        </div>

        @can('servicios-list')
        <div class="table-responsive">
            @include('servicios.create')
          <table class="table table-flush" id="datatable-search">
            <thead class="thead-light">
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
                        <td>{{ $servicios->id }}</td>

                        <td>{{ $servicios->nombre }}</td>
                        <td>{{ $servicios->precio }}</td>
                        <td>{{ $servicios->duracion }}</td>
                        <td>{{ $servicios->categoria }}</td>
                        {{-- <td>{{ $servicios->act_descuento }}</td> --}}
                        <td>{{ $servicios->descuento }}</td>

                        <td>

                                <a class="btn btn-sm btn-primary " data-toggle="modal" data-target="#showDataModal{{$servicios->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> </a>
                                @can('servicios-edit')
                                <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal{{$servicios->id}}"><i class="fa fa-fw fa-edit"></i> </a>
                                @endcan

                                @can('servicios-delete')
                                    <form action="{{ route('servicio.destroy',$servicios->id) }}" method="POST" style="display: contents;">
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
        @endcan
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
