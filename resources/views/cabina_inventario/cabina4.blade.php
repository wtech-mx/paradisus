@extends('layouts.app')

@section('template_title')
    Inventario Cabina 4
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
                            <h3 class="mb-3">Inventario Cabina 4</h3>

                            @can('notas-pedido-create')
                            <a class="btn"  href="{{ route('inventario.create_vista') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                <i class="fa fa-fw fa-edit"></i> Crear
                            </a>
                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Num Semana</th>
                                            <th>Num Cabina</th>
                                            <th>Fecha Edit</th>
                                            <th>fecha</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($cabinas as $cabina)
                                                <tr>
                                                    <td>{{ $cabina->id }}</td>
                                                    <td>{{ $cabina->num_semana }}</td>
                                                    <td>{{ $cabina->num_cabina }}</td>
                                                    <td>{{ $cabina->fecha }}</td>
                                                    <td>Ver</td>
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

