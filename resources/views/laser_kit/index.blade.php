@extends('layouts.app')

@section('template_title')
    Paquete Laser
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="mb-3">Paquete Laser</h3>

                @can('servicios-create')
                <a class="btn btn-sm btn-success" href="{{ route('create_laser.kit') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    <i class="fa fa-fw fa-edit"></i> Crear </a>
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
                                <th>Num sesiones</th>
                                <th>Fecha Caducidad</th>
                            </tr>
                    </thead>

                    <tbody>
                        @foreach ($lasers_kits as $laser_kit)
                            <tr>
                                <td>{{ $laser_kit->id }}</td>

                                <td>{{ $laser_kit->nombre }}</td>
                                <td>{{ $laser_kit->precio }}</td>
                                <td>{{ $laser_kit->num_sesiones }}</td>
                                <td>{{ $laser_kit->fecha_caducidad }}</td>

                                <td>
                                    @can('servicios-edit')
                                        <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$laser_kit->id}}"><i class="fa fa-fw fa-edit"></i> </a>
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

@endsection
