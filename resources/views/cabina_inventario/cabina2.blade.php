@extends('layouts.app')

@section('template_title')
    Inventario Cabina 2
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
                            <h3 class="mb-3">Inventario Cabina 2</h3>

                            @can('notas-pedido-create')

                            <a class="btn"  href="{{ route('inventario.create_vista') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                <i class="fa fa-fw fa-edit"></i> Crear
                            </a>

                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Mes</th>
                                            <th>Semana</th>
                                            <th>Fecha Edit</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($cabinas as $cabina)
                                                <tr class="text-center">
                                                    <td>{{ $cabina->id }}</td>
                                                    <td>
                                                        @php
                                                            $fechaCarbon = \Carbon\Carbon::createFromFormat('Y-m-d', $cabina->fecha);
                                                            $nombreMes = $fechaCarbon->locale('es')->monthName;
                                                            echo $nombreMes;
                                                        @endphp
                                                    </td>
                                                    <td>Semana {{ $cabina->num_semana }}</td>
                                                    <td>
                                                        @php
                                                            $fechaCarbon = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $cabina->updated_at);
                                                            $fechaActualizada = $fechaCarbon->format('Y-m-d');
                                                            echo $fechaActualizada;
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('inventario.edit_cabina2',$cabina->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
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

