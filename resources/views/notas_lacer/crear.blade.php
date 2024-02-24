@extends('layouts.app')

@section('template_title')
   Crear Nota Lacer
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Nota Lacer</h3>

                            <a class="btn"  href="{{ route('index.lacer') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>

                        </div>
                    </div>

                    <div class="card-body">

                            <ul class="nav nav-pills nav-fill p-1 mb-5" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" id="pills-profile-tab">
                                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                                    </a>
                                </li>

                            </ul>

                        <form method="POST" action="{{ route('notas.store') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                        <div class="row">

                                            <div class="col-6 form-group ">
                                                <label for="nombre">Seleccione Cosmetologa</label>
                                                <select class="form-control user" id="id_user[]" name="id_user[]" value="{{ old('submarca') }}" required>
                                                    @foreach ($user as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="precio">Nuevo cliente</label><br>
                                                        <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                            Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                        </button>
                                                    </div>
                                                    <div class="col-9">

                                                        <div class="form-group">
                                                            <label for="name">Cliente *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                                </span>

                                                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                                                    <option>Seleccionar cliente</option>
                                                                    @foreach ($client as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} / {{ $item->phone }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="row">


                                                            <div class="col-4">
                                                                <label for="name">Nombre(s) *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="name" name="name" type="text" class="form-control" placeholder="Nombre o Nombres">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="name">Apellido(s) *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/letter.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellidos">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="name">Telefono *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/phone.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="phone" name="phone" type="text" class="form-control" type="tel" minlength="10" maxlength="10" placeholder="555555555">
                                                                </div>
                                                            </div>

                                                            {{-- <div class="col-4">
                                                                <label for="name">Correo (Opcional)</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/correo-electronico.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="email" name="email" type="email" class="form-control" placeholder="correo@correo.com">
                                                                </div>
                                                            </div> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="form-group">
                                                <label>Tipo de servicio:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="sesion" value="sesion">
                                                    <label class="form-check-label" for="sesion">Sesión</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="paquete" value="paquete">
                                                    <label class="form-check-label" for="paquete">Paquete</label>
                                                </div>
                                            </div>

                                            <div class="form-group" id="sesionSelect" style="display:none;">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Zona 1</label><br>
                                                        <select class="form-control zona" data-toggle="select" id="zona_select_1" name="zona_select_1" required>
                                                            <option value="">Seleccionar zona</option>
                                                            <option value="zona1">zona1</option>
                                                            <option value="zona2">zona2</option>
                                                            <option value="zona3">zona3</option>
                                                            <option value="zona4">zona4</option>
                                                            <option value="zona5">zona5</option>
                                                            <option value="zona6">zona6</option>
                                                            <option value="zona7">zona7</option>
                                                            <option value="zona8">zona8</option>
                                                            <option value="zona9">zona9</option>
                                                            <option value="zona10">zona10</option>
                                                            <option value="zona11">zona11</option>
                                                            <option value="zona112">zona12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Cantidad 1</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="cantidad_1" name="cantidad_1" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Subtotal 1</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" id="subtotal_1" name="subtotal_1" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Zona 2</label><br>
                                                        <select class="form-control zona" data-toggle="select" id="zona_select_2" name="zona_select_2" required>
                                                            <option value="">Seleccionar zona</option>
                                                            <option value="zona1">zona1</option>
                                                            <option value="zona2">zona2</option>
                                                            <option value="zona3">zona3</option>
                                                            <option value="zona4">zona4</option>
                                                            <option value="zona5">zona5</option>
                                                            <option value="zona6">zona6</option>
                                                            <option value="zona7">zona7</option>
                                                            <option value="zona8">zona8</option>
                                                            <option value="zona9">zona9</option>
                                                            <option value="zona10">zona10</option>
                                                            <option value="zona11">zona11</option>
                                                            <option value="zona112">zona12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Cantidad 2</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="cantidad_2" name="cantidad_2" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Subtotal 2</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" id="subtotal_2" name="subtotal_2" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Zona 3</label><br>
                                                        <select class="form-control zona" data-toggle="select" id="zona_select_3" name="zona_select_3" required>
                                                            <option value="">Seleccionar zona</option>
                                                            <option value="zona1">zona1</option>
                                                            <option value="zona2">zona2</option>
                                                            <option value="zona3">zona3</option>
                                                            <option value="zona4">zona4</option>
                                                            <option value="zona5">zona5</option>
                                                            <option value="zona6">zona6</option>
                                                            <option value="zona7">zona7</option>
                                                            <option value="zona8">zona8</option>
                                                            <option value="zona9">zona9</option>
                                                            <option value="zona10">zona10</option>
                                                            <option value="zona11">zona11</option>
                                                            <option value="zona112">zona12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Cantidad 3</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="cantidad_3" name="cantidad_3" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Subtotal 3</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" id="subtotal_3" name="subtotal_3" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Zona 4</label><br>
                                                        <select class="form-control zona" data-toggle="select" id="zona_select_4" name="zona_select_4" required>
                                                            <option value="">Seleccionar zona</option>
                                                            <option value="zona1">zona1</option>
                                                            <option value="zona2">zona2</option>
                                                            <option value="zona3">zona3</option>
                                                            <option value="zona4">zona4</option>
                                                            <option value="zona5">zona5</option>
                                                            <option value="zona6">zona6</option>
                                                            <option value="zona7">zona7</option>
                                                            <option value="zona8">zona8</option>
                                                            <option value="zona9">zona9</option>
                                                            <option value="zona10">zona10</option>
                                                            <option value="zona11">zona11</option>
                                                            <option value="zona112">zona12</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Cantidad 3</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="cantidad_4" name="cantidad_4" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Subtotal 3</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" id="subtotal_4" name="subtotal_4" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="paqueteSelect" style="display:none;">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Tipo paquete</label><br>
                                                        <select class="form-control" data-toggle="select" id="paquete_select" name="paquete_select" required>
                                                            <option value="">Seleccionar servicio</option>
                                                            <option value="1">Paquete 1</option>
                                                            <option value="2">Paquete 2</option>
                                                            <option value="3">Paquete 3</option>
                                                            <option value="4">Paquete 4</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="zonasSelect" style="display:none;">
                                                <label for="zona_select">Selecciona una zona:</label>
                                                <select class="form-control zona_paquete" id="zona_paquete" name="zona_paquete">
                                                    <!-- Opciones para las zonas -->
                                                </select>

                                                <label for="zona_paquete_2">Selecciona otra zona:</label>
                                                <select class="form-control zona_paquete2" id="zona_paquete_2" name="zona_paquete_2" style="margin-top: 10px;">
                                                    <!-- Opciones para las zonas -->
                                                </select>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="col-4">

                                                <label for="total-suma">Total a Pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" id="total_suma" name="total_suma" class="form-control" readonly>
                                                </div>

                                            </div>

                                            <div class="col-4">
                                                <label for="total-suma">Restante</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/money.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" id="restante" name="restante" class="form-control" readonly>
                                                </div>

                                            </div>

                                            <div class="col-4">
                                                <label for="total-suma">Cambio</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" id="cambio" name="cambio" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-2">

                                                <label for="total-suma">Fecha</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                </div>

                                            </div>

                                            <div class="col-2">

                                                <label for="total-suma">Cajera</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/skincare.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select class="form-control"  data-toggle="select" id="cosmetologa" name="cosmetologa" required>
                                                        <option value="">Seleccionar cosme</option>
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Monto a pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cash-machine.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="pago" name="pago" type="number" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-2">

                                                <label for="num_sesion">Metodo Pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select id="forma_pago" name="forma_pago" class="form-control">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                        <option value="Nota">Nota</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nota">Nota</label>
                                                    <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">

                                                <label for="total-suma">Comprobante de pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/picture.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>

                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Guardar
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">

        $(document).ready(function() {
            $('.user').select2();
            $('.cliente').select2();
            $('.zona').select2();
            $('.zona_paquete').select2();
            $('.zona_paquete2').select2();
        });

    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sesionSelect = document.getElementById('sesionSelect');
        var paqueteSelect = document.getElementById('paqueteSelect');
        var zonasSelect = document.getElementById('zonasSelect');
        var paqueteSelectElement = $('#paquete_select');
        var zonaSelect = document.getElementById('zona_paquete');
        var totalSumaInput = $('#total_suma');
        var zonasSelect1 = $('#zona_select_1');
        var zonasSelect2 = $('#zona_select_2');
        var zonasSelect3 = $('#zona_select_3');
        var zonasSelect4 = $('#zona_select_4');

        var totalSumaInput1 = $('#subtotal_1');
        var totalSumaInput2 = $('#subtotal_2');
        var totalSumaInput3 = $('#subtotal_3');
        var totalSumaInput4 = $('#subtotal_4');

        var cantidadInput1 = $('#cantidad_1');
        var cantidadInput2 = $('#cantidad_2');
        var cantidadInput3 = $('#cantidad_3');
        var cantidadInput4 = $('#cantidad_4');

        // Inicializar las cantidades a 1 por defecto
        cantidadInput1.val(1);
        cantidadInput2.val(1);
        cantidadInput3.val(1);
        cantidadInput4.val(1);

        function updateZonasSelect(paqueteValue) {
            // Limpiar las opciones anteriores
            $('#zona_paquete, #zona_paquete_2').empty();

            // Agregar nuevas opciones según el paquete seleccionado
            if (paqueteValue === '1') {
                addOptionsToSelect('Zona 1', 'Zona 2', 'Zona 3');
                totalSumaInput.val(2160);
            } else if (paqueteValue === '2') {
                addOptionsToSelect('Zona 4', 'Zona 5', 'Zona 6');
                totalSumaInput.val(3690);
            } else if (paqueteValue === '3') {
                addOptionsToSelect('Zona 7', 'Zona 8', 'Zona 9');
                totalSumaInput.val(12000);
            } else if (paqueteValue === '4') {
                addOptionsToSelect('Zona 10', 'Zona 11', 'Zona 12');
                totalSumaInput.val(15000);
            }

            // Actualizar los select usando Bootstrap Select
            $('.zona_paquete').selectpicker('refresh');
        }

        function addOptionsToSelect(value1, value2, value3) {
            var options = [value1, value2, value3];

            options.forEach(function (value) {
                var option = document.createElement('option');
                option.text = value;
                $('#zona_paquete').append(option);
                $('#zona_paquete_2').append(option.cloneNode(true));
            });
        }

        $('input[name="tipo_servicio"]').on('change', function () {
            if ($('#sesion').prop('checked')) {
                sesionSelect.style.display = 'block';
                paqueteSelect.style.display = 'none';
                zonasSelect.style.display = 'none';
                totalSumaInput.val('');
            } else if ($('#paquete').prop('checked')) {
                sesionSelect.style.display = 'none';
                paqueteSelect.style.display = 'block';
                zonasSelect.style.display = 'block';
                // Lógica para llenar el segundo select según la selección de paquete
                updateZonasSelect(paqueteSelectElement.val());
            }
        });

        paqueteSelectElement.change(function () {
            if ($('#paquete').prop('checked')) {
                // Lógica para llenar el segundo select y establecer el valor del input según la selección de paquete
                updateZonasSelect(paqueteSelectElement.val());
            }
        });

        zonasSelect1.on('change', function () {
            // Lógica para calcular subtotal y cantidad según la selección de zona
            updateSubtotalAndCantidad(zonasSelect1.val(), totalSumaInput1, cantidadInput1);
        });

        zonasSelect2.on('change', function () {
            // Lógica para calcular subtotal y cantidad según la selección de zona
            updateSubtotalAndCantidad(zonasSelect2.val(), totalSumaInput2, cantidadInput2);
        });

        zonasSelect3.on('change', function () {
            // Lógica para calcular subtotal y cantidad según la selección de zona
            updateSubtotalAndCantidad(zonasSelect3.val(), totalSumaInput3, cantidadInput3);
        });

        zonasSelect4.on('change', function () {
            // Lógica para calcular subtotal y cantidad según la selección de zona
            updateSubtotalAndCantidad(zonasSelect4.val(), totalSumaInput4, cantidadInput4);
        });

        cantidadInput1.on('input', function () {
            updateSubtotalAndCantidad(zonasSelect1.val(), totalSumaInput1, cantidadInput1);
            updateTotalSesiones();
        });

        cantidadInput2.on('input', function () {
            updateSubtotalAndCantidad(zonasSelect2.val(), totalSumaInput2, cantidadInput2);
            updateTotalSesiones();
        });

        cantidadInput3.on('input', function () {
            updateSubtotalAndCantidad(zonasSelect3.val(), totalSumaInput3, cantidadInput3);
            updateTotalSesiones();
        });

        cantidadInput4.on('input', function () {
            updateSubtotalAndCantidad(zonasSelect4.val(), totalSumaInput4, cantidadInput4);
            updateTotalSesiones();
        });

        function updateTotalSesiones() {
            var totalSesiones = parseInt(totalSumaInput1.val()) || 0;
            totalSesiones += parseInt(totalSumaInput2.val()) || 0;
            totalSesiones += parseInt(totalSumaInput3.val()) || 0;
            totalSesiones += parseInt(totalSumaInput4.val()) || 0;

            $('#total_suma').val(totalSesiones);
        }

        function updateSubtotalAndCantidad(selectedZona, totalSumaInput, cantidadInput) {
            var subtotal = 0;
            var cantidad = parseInt(cantidadInput.val()) || 1;

            switch (selectedZona) {
                case 'zona1':
                case 'zona2':
                case 'zona3':
                    subtotal = 200 * cantidad;
                    break;
                case 'zona4':
                case 'zona5':
                case 'zona6':
                    subtotal = 400 * cantidad;
                    break;
                case 'zona7':
                case 'zona8':
                case 'zona9':
                    subtotal = 900 * cantidad;
                    break;
                case 'zona10':
                case 'zona11':
                case 'zona12':
                    subtotal = 1200 * cantidad;
                    break;
                default:
                    subtotal = 0;
                    break;
            }

            totalSumaInput.val(subtotal);
        }

        // Inicializar los selects de Bootstrap
        $('.zona_paquete').selectpicker();

        // Inicializar los select de Bootstrap
        $(zonaSelect).selectpicker();
    });
</script>

@endsection
