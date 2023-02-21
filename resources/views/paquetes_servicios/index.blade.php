@extends('layouts.app')

@section('template_title')
    Paquetes
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
                            <h3 class="mb-3">Paquetes</h3>

                            @can('notas-pedido-create')
                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#showDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                </a>
                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Paquete</th>
                                            <th>Fecha</th>
                                            {{-- <th>Sesion</th> --}}
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($paquetes as $paquete)
                                                <tr class="text-center">
                                                    <td>{{$paquete->id}}</td>

                                                    <td>{{$paquete->Client->name }} {{ $paquete->Client->last_name }}</td>
                                                    @if ($paquete->num_paquete == 1)
                                                        <td>figura Ideal c/Aparatología</td>
                                                    @elseif ($paquete->num_paquete == 2)
                                                        <td>Lipoescultura s/Cirugía</td>
                                                    @elseif ($paquete->num_paquete == 3)
                                                        <td>Moldeante & Reductivo</td>
                                                    @elseif ($paquete->num_paquete == 4)
                                                        <td>Drenante & Linfático</td>
                                                    @elseif ($paquete->num_paquete == 5)
                                                        <td>Glúteos Definido & Perfectos</td>
                                                    @endif

                                                    <td>{{$paquete->fecha_inicial}}</td>

                                                    {{-- @if ($paquete->id_user1 == null)
                                                        <td>1ra Sesion</td>
                                                    @elseif ($paquete->id_user2 == null)
                                                        <td>2da Sesion</td>
                                                    @elseif ($paquete->id_user3 == null)
                                                        <td>3ra Sesion</td>
                                                    @endif --}}
                                                    <td>
                                                        {{-- <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></button> --}}
                                                        @can('notas-edit')
                                                            <a class="btn btn-sm btn-success" href="#"><i class="fa fa-fw fa-edit"></i> </a>
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
@include('paquetes_servicios.show')
@endsection
