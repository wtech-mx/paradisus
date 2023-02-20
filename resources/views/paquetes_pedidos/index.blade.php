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
                            <h3 class="mb-3">Crear Paquetes</h3>

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
                                        <tr>
                                            <th>No</th>

                                            <th>Cosme</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Metodo Pago</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    @if (Auth::user()->hasRole('cosmetologa'))
                                    <tbody>

                                    </tbody>
                                    @else
                                        <tbody>

                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>

            </div>
        </div>
    </div>
@include('paquetes_pedidos.show')
@endsection

@section('datatable')

@endsection


@section('js_custom')

@endsection
