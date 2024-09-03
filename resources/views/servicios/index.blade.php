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
                                <th>Act Descuento</th>
                                <th>Descuento</th>
                                <th>Acciones</th>
                            </tr>
                    </thead>

                    <tbody>
                        @foreach ($servicio as $servicios)
                            @include('servicios.edit')
                            <tr>
                                <td>{{ $servicios->id }}</td>

                                <td>{{ $servicios->nombre }}</td>
                                <td>{{ $servicios->precio }}</td>
                                <td>{{ $servicios->duracion }}</td>
                                <td>{{ $servicios->categoria }}</td>
                                <td>
                                    @can('servicios-edit')
                                    <input data-id="{{ $servicios->id }}" class="toggle-class" type="checkbox"
                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                    data-on="Active" data-off="InActive" {{ $servicios->act_descuento ? 'checked' : '' }}>
                                    @endcan
                                </td>
                                <td>{{ $servicios->descuento }}</td>

                                <td>

                                        @can('servicios-edit')
                                        <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$servicios->id}}"><i class="fa fa-fw fa-edit"></i> </a>
                                        @endcan

                                        @can('servicios-delete')
                                            <form method="POST" action="{{ route('servicio.update_ocultar', $servicios->id) }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <input type="hidden" name="estatus" value="ocultar">
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

    $(function() {
        $('.toggle-class').change(function() {
            var act_descuento = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('ChangeServicioStatus.servicio') }}',
                data: {
                    'act_descuento': act_descuento,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        })
    })
</script>

@endsection
