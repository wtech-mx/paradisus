@extends('layouts.app')

@section('template_title')
    Edit Paquete laser
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('update_laser.kit', $lasers_kits->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="row">

                                    <div class="col-12 mt-2 mb-3">
                                        <h2 style="color:#836262"><strong>Editar Paquete laser </strong> </h2>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Nombre Paquete *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$lasers_kits->nombre}}">
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <h5 style="color:#836262"><strong>Zonas Selecionadas</strong> </h5>
                                    </div>

                                    @foreach ($lasers_kits_zonas as  $laser_kit_zona)
                                        <div class="row campo3" data-id="{{ $laser_kit_zona->id }}">
                                            <div class="col-4">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control d-inline-block" value="{{ $laser_kit_zona->Laser->zona }}" readonly>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="form-group col-4">
                                        <h4 for="name">Numero de sesiones</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/prueba.webp') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="num_sesiones" name="num_sesiones" value="{{$lasers_kits->num_sesiones}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="precio" name="precio" value="{{$lasers_kits->precio}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Desactivar Paquete</h4>
                                        <div class="input-group mb-3">
                                            <select name="vencido" class="form-select d-inline-block">
                                                <option value="No">No</option>
                                                <option value="Si">Si</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
@endsection
