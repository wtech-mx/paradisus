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
            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicios
                    </a>

                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                        <i class="ni ni-credit-card text-sm me-2"></i> Promociones
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                @include('servicios.show')
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

                                                <a class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$servicios->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> </a>
                                                @can('servicios-edit')
                                                <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$servicios->id}}"><i class="fa fa-fw fa-edit"></i> </a>
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
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                                @foreach ($servicio_promo as $servicios)
                                @include('servicios.show')
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

                                                <a class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$servicios->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> </a>
                                                @can('servicios-edit')
                                                <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$servicios->id}}"><i class="fa fa-fw fa-edit"></i> </a>
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
                </div>
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
