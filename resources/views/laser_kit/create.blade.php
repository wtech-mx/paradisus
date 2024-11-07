@extends('layouts.app')

@section('template_title')
    Paquete laser Crear
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
                        <form id="myForm" method="POST" action="{{ route('store_laser.kit') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <div class="form-group col-6">
                                        <h4 for="name">Nombre Paquete *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/firma-digital.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group col-6">
                                        <h4 for="name">Fecha de Finalizacion*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha_caducidad" name="fecha_caducidad" type="date" class="form-control" value="{{$fecha}}">
                                        </div>
                                    </div> --}}

                                    <div class="col-12 mt-2">
                                        <h2 style="color:#836262"><strong>Seleciona las zonas</strong> </h2>
                                    </div>

                                    <div class="col-1">
                                        <div class="form-group">
                                            <button class="mt-5" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-11">
                                        <div class="form-group">
                                            <div id="camposContainer">
                                                <div class="campo mt-3">
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <h4 for="">Zona</h4>
                                                            <div class="form-group">
                                                                <select name="id_laser_zona[]" class="form-select d-inline-block">
                                                                    <option value="">Seleccione Zona</option>
                                                                    @foreach ($zonas as $zona)
                                                                        <option value="{{ $zona->id }}">{{ $zona->zona }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-1">
                                                            <h4 for="name">-</h4>
                                                            <div class="input-group mb-3">
                                                                <button type="button" class="btn btn-danger btn-sm eliminarCampo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Numero de sesiones</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/prueba.webp') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="num_sesiones" name="num_sesiones" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="precio" name="precio" required>
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
                                <button type="submit" class="btn close-modal" id="saveButton" style="background: {{$configuracion->color_boton_save}}; color: #ffff; font-size: 17px;">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.producto').select2();

        // Al hacer clic en el botón de agregar
        $('#agregarCampo').click(function() {
            // Clonar la última fila `.campo`
            let nuevoCampo = $('.campo:first').clone();

            // Limpiar los valores del nuevo campo
            nuevoCampo.find('select').val(''); // Limpiar el valor del select

            // Agregar el nuevo campo al contenedor
            $('#camposContainer').append(nuevoCampo);
        });

        // Al hacer clic en el botón de eliminar
        $(document).on('click', '.eliminarCampo', function() {
            // Verificar si hay más de un campo antes de eliminar
            if ($('.campo').length > 1) {
                $(this).closest('.campo').remove();
            } else {
                alert("Debe haber al menos un campo.");
            }
        });
    });
</script>
@endsection
