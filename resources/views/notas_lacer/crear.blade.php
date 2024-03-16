@extends('layouts.app')

@section('template_title')
   Crear Nota Laser
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Nota Laser</h3>

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

                        <form method="POST" action="{{ route('store.lacer') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                        <div class="row">

                                            <div class="col-6 form-group ">
                                                <label for="nombre">Seleccione Cosmetologa</label>
                                                <select class="form-control user" id="id_user" name="id_user" value="{{ old('id_user') }}" >
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

                                            <div class="form-group col-12">
                                                <label>Tipo de servicio:</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="sesion" value="sesion">
                                                    <label class="form-check-label" for="sesion">Sesión</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="paquete" value="paquete">
                                                    <label class="form-check-label" for="paquete">Paquete</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="tipo_servicio" id="personalizado" value="personalizado">
                                                    <label class="form-check-label" for="personalizado">Personalizado</label>
                                                </div>
                                            </div>

                                            <div class="form-group" id="sesionSelect" style="display:none;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 1</label><br>
                                                            <select class="form-control zona_select_1" data-toggle="select" id="zona_select_1" name="zona_select_1" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio="{{ $zona->precio_sesion }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Cantidad 1</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="cantidad_1" name="cantidad_1" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Subtotal 1</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="subtotal_1" name="subtotal_1" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    {{-- ============ Zona 2 --}}
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 2</label><br>
                                                            <select class="form-control zona_select_2" data-toggle="select" id="zona_select_2" name="zona_select_2" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio="{{ $zona->precio_sesion }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Cantidad 2</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="cantidad_2" name="cantidad_2" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Subtotal 2</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="subtotal_2" name="subtotal_2" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                            {{-- ============ Zona 3 --}}
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 3</label><br>
                                                            <select class="form-control zona_select_3" data-toggle="select" id="zona_select_3" name="zona_select_3" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio="{{ $zona->precio_sesion }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Cantidad 3</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="cantidad_3" name="cantidad_3" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Subtotal 3</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="subtotal_3" name="subtotal_3" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                        {{-- ============ Zona 4 --}}
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 4</label><br>
                                                            <select class="form-control zona_select_4" data-toggle="select" id="zona_select_4" name="zona_select_4" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio="{{ $zona->precio_sesion }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Cantidad 4</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="cantidad_4" name="cantidad_4" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Subtotal 4</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="subtotal_4" name="subtotal_4" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="paqueteSelect" style="display:none;">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="precio">Tipo paquete</label><br>
                                                        <select class="form-control" data-toggle="select" id="paquete_select" name="paquete_select">
                                                            <option value="">Seleccionar servicio</option>
                                                            <option value="Zona Mini">Zona Mini</option>
                                                            <option value="Zonas Pequeñas">Zonas Pequeñas</option>
                                                            <option value="Zonas Medianas">Zonas Medianas</option>
                                                            <option value="Zonas Grandes">Zonas Grandes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group" id="zonasSelect" style="display:none;">
                                                <label for="zona_select">Selecciona una zona:</label>
                                                <select class="form-control zona_paquete_1" id="zona_paquete_1" name="zona_paquete_1">
                                                    <!-- Opciones para las zonas -->
                                                </select>

                                                <label for="zona_paquete_2">Selecciona otra zona:</label>
                                                <select class="form-control zona_paquete_2" id="zona_paquete_2" name="zona_paquete_2" style="margin-top: 10px;">
                                                    <!-- Opciones para las zonas -->
                                                </select>
                                            </div>

                                            <div class="form-group" id="personalizadoSelect" style="display:none;">
                                                <div class="row">

                                                    <div class="col-6">
                                                        <label for="total-suma">Precio</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" id="precio_sugerido" name="precio_sugerido" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        {{-- <label for="total-suma">Precio Final</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" id="precio_personalizado" name="precio_personalizado" >
                                                        </div> --}}
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 1</label><br>
                                                            <select class="form-control zona_personalizado_1" id="zona_personalizado_1" name="zona_personalizado_1" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio-paquete="{{ $zona->costo_paquete }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 2</label><br>
                                                            <select class="form-control zona_personalizado_2" id="zona_personalizado_2" name="zona_personalizado_2" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio-paquete="{{ $zona->costo_paquete }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 3</label><br>
                                                            <select class="form-control zona_personalizado_3" id="zona_personalizado_3" name="zona_personalizado_3" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio-paquete="{{ $zona->costo_paquete }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="precio">Zona 4</label><br>
                                                            <select class="form-control zona_personalizado_4" id="zona_personalizado_4" name="zona_personalizado_4" >
                                                                <option value="">Seleccionar zona</option>
                                                                @foreach ($zonas as $zona)
                                                                    <option value="{{$zona->id}}" data-precio-paquete="{{ $zona->costo_paquete }}">{{$zona->zona}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
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
                                                    <input type="number" id="total_suma" name="total_suma" class="form-control" readonly>
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
                                                    <select class="form-control"  data-toggle="select" id="cosmetologa" name="cosmetologa" >
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
                                                    <input  id="pago" name="pago" type="number" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control" >
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
            $('.zona_select_1').select2();
            $('.zona_paquete_1').select2();
            $('.zona_paquete_2').select2();
            $('.zona_personalizado_1').select2();
            $('.zona_personalizado_2').select2();
            $('.zona_personalizado_3').select2();
            $('.zona_personalizado_4').select2();
        });

    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var sesionSelect = document.getElementById('sesionSelect');
        var paqueteSelect = document.getElementById('paqueteSelect');
        var zonasSelect = document.getElementById('zonasSelect');
        var personalizadoSelect = document.getElementById('personalizadoSelect');
        var paqueteSelectElement = $('#paquete_select');
        var zonaSelect = document.getElementById('zona_paquete_1');
        var totalSumaInput = $('#total_suma');

        var pagoInput = $('#pago');
        var restanteInput = $('#restante');
        var dineroRecibidoInput = $('#dinero_recibido');
        var cambioInput = $('#cambio');

        var precioSugeridoInput = document.getElementById('precio_sugerido');

        // Agrega un evento al campo de pago para realizar la resta
            pagoInput.on('input', function () {
                updateRestante();
            });

        // Agrega un evento al campo de dinero_recibido para realizar la resta
            dineroRecibidoInput.on('input', function () {
                updateCambio();
            });

        // ============================== Radio tipo de servicio Personalizado ==============================
            $('#zona_personalizado_1, #zona_personalizado_2, #zona_personalizado_3, #zona_personalizado_4').change(function() {
                var select1 = $('#zona_personalizado_1')[0];
                var select2 = $('#zona_personalizado_2')[0];
                var select3 = $('#zona_personalizado_3')[0];
                var select4 = $('#zona_personalizado_4')[0];

                var precioTotal = 0;

                // Función para calcular la suma de las opciones seleccionadas
                function calcularSuma(select) {
                    for (var i = 0; i < select.selectedOptions.length; i++) {
                        var selectedOption = select.selectedOptions[i];
                        var precioPaquete = parseFloat(selectedOption.getAttribute('data-precio-paquete'));
                        if (!isNaN(precioPaquete)) {
                            precioTotal += precioPaquete / 2;
                        }
                    }
                }

                // Calcular la suma para ambos selectores
                calcularSuma(select1);
                calcularSuma(select2);
                calcularSuma(select3);
                calcularSuma(select4);

                // Actualizar el valor del input de precio sugerido
                var precioSugerido = precioTotal.toFixed(2);
                $('#precio_sugerido').val(precioSugerido);

                // Actualizar el valor del input total_suma
                $('#total_suma').val(precioSugerido);
            });

        // ============================== Radio tipo de servicio PAQUETES ==============================
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
                } else if ($('#personalizado').prop('checked')) {
                    sesionSelect.style.display = 'none';
                    paqueteSelect.style.display = 'none';
                    zonasSelect.style.display = 'none';
                    personalizadoSelect.style.display = 'block';
                }
            });


        // ============================== Radio tipo de servicio SESIONES ==============================
            $('.zona_select_1, #cantidad_1').change(function() {
                var selectedService = $('.zona_select_1 option:selected');
                var precio = selectedService.data('precio');
                var cantidad = parseInt($('#cantidad_1').val());

                // Calcular el subtotal usando el precio
                var subtotal = cantidad * precio;

                $('#subtotal_1').val(subtotal);
            });

            $('.zona_select_2, #cantidad_2').change(function() {
                var selectedService = $('.zona_select_2 option:selected');
                var precio = selectedService.data('precio');
                var cantidad = parseInt($('#cantidad_2').val());

                // Calcular el subtotal usando el precio2
                var subtotal = cantidad * precio;

                $('#subtotal_2').val(subtotal);
            });

            $('.zona_select_3, #cantidad_3').change(function() {
                var selectedService = $('.zona_select_3 option:selected');
                var precio = selectedService.data('precio');
                var cantidad = parseInt($('#cantidad_3').val());

                // Calcular el subtotal usando el precio
                var subtotal = cantidad * precio;

                $('#subtotal_3').val(subtotal);
            });

            $('.zona_select_4, #cantidad_4').change(function() {
                var selectedService = $('.zona_select_4 option:selected');
                var precio = selectedService.data('precio');
                var cantidad = parseInt($('#cantidad_4').val());

                // Calcular el subtotal usando el precio
                var subtotal = cantidad * precio;

                $('#subtotal_4').val(subtotal);
            });

            function calcularTotal() {
                var totalSumaInput = 0;

                for (var i = 1; i <= 4; i++) {
                    var selectedService = $('.zona_select_' + i + ' option:selected');
                    var precio = selectedService.data('precio');
                    var cantidad = parseInt($('#cantidad_' + i).val());

                    if (!isNaN(cantidad)) {
                            subtotal = cantidad * precio;
                            console.log(precio);
                            console.log(subtotal);
                            console.log(cantidad);

                        $('#subtotal_' + i).val(subtotal);

                        if (!isNaN(subtotal)) {
                            totalSumaInput += subtotal;
                            $('#total_suma').val(totalSumaInput);
                            console.log(totalSumaInput);
                        }
                    }
                }
            }
            $('.zona_select_1, #cantidad_1,.zona_select_2, #cantidad_2,.zona_select_3, #cantidad_3,.zona_select_4, #cantidad_4').change(function() {
                calcularTotal();
            });
        // ============================== Paquetes ==============================
            function updateZonasSelect(tipoZona) {
                // Limpiar las opciones anteriores
                $('#zona_paquete_1, #zona_paquete_2').empty();

                // Realizar solicitud AJAX para obtener datos del servidor
                $.ajax({
                    url: `/notas/laser/get-zonas/${tipoZona}`,
                    method: 'GET',
                    success: function (data) {
                        // Agregar nuevas opciones según los datos obtenidos
                        addOptionsToSelect(data);

                        // Actualizar el select usando Bootstrap Select
                        $('.zona_paquete_1').selectpicker('refresh');
                    },
                    error: function (error) {
                        console.error(error);
                    }
                });
            }

            paqueteSelectElement.change(function () {
                if ($('#paquete').prop('checked')) {
                    // Obtener el tipo de zona desde el valor seleccionado
                    var tipoZona = paqueteSelectElement.val();

                    // Lógica para llenar el segundo select y establecer el valor del input según la selección de paquete
                    updateZonasSelect(tipoZona);
                }
            });

            function addOptionsToSelect(values) {
                var zonaPaqueteSelect = $('#zona_paquete_1');
                var zonaPaquete2Select = $('#zona_paquete_2');

                // Limpiar las opciones anteriores
                zonaPaqueteSelect.empty();
                zonaPaquete2Select.empty();

                values.forEach(function (item) {
                    var option = $('<option>').text(item.zona).attr('value', item.id);
                    zonaPaqueteSelect.append(option);

                    var clonedOption = option.clone();
                    zonaPaquete2Select.append(clonedOption);
                    $('#total_suma').val(item.costo_paquete);
                });

                // Actualizar los select usando Bootstrap Select
                $('.zona_paquete_1').selectpicker('refresh');
            }

        // ============================== Pagos ==============================
            function updateRestante() {
                var totalSuma = parseInt(totalSumaInput.val()) || 0;
                var pago = parseInt(pagoInput.val()) || 0;

                var restante = totalSuma - pago;

                // Asegurarse de que el restante no sea negativo
                restante = restante < 0 ? 0 : restante;

                restanteInput.val(restante);
            }

            function updateCambio() {
                var pago = parseInt(pagoInput.val()) || 0;
                var dineroRecibido = parseInt(dineroRecibidoInput.val()) || 0;

                var cambio = dineroRecibido - pago;

                // Asegurarse de que el cambio no sea negativo
                cambio = cambio < 0 ? 0 : cambio;

                cambioInput.val(cambio);
            }

            // Funcion AJAX

            $("#miFormulario").on("submit", function (event) {
                event.preventDefault(); // Evita el envío predeterminado del formulario

                // Realiza la solicitud POST usando AJAX
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: async function(response) { // Agrega "async" aquí
                        // El formulario se ha enviado correctamente, ahora realiza la impresión
                        imprimirRecibo(response);

                    },
                    error: function (xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';

                            // Itera a través de los errores y agrega cada mensaje de error al mensaje final
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    var errorMessages = errors[key].join('<br>'); // Usamos <br> para separar los mensajes
                                    errorMessage += '<strong>' + key + ':</strong><br>' + errorMessages + '<br>';
                                }
                            }
                            console.log(errorMessage);
                            // Muestra el mensaje de error en una SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: 'Faltan Campos',
                                html: errorMessage, // Usa "html" para mostrar el mensaje con formato HTML
                            });
                    }
                });

            });

            // Función para imprimir el recibo
            async function imprimirRecibo(response) {

                        const userAgent = navigator.userAgent;
                        // Obtén los datos del recibo de la respuesta AJAX
                        const recibo = response.recibo;
                        // Empezar a usar el plugin
                        const formaPago = $("#forma_pago").val();
                    if (/Windows/i.test(userAgent)) {

                        if(formaPago === 'Efectivo'){

                            const conector = new ConectorPluginV3();
                            console.log(recibo);

                            conector.Pulso(parseInt(48), parseInt(60), parseInt(120));

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                                .EscribirTexto("Cosmetologa: " + recibo.cosmetologa + "\n")
                                .EscribirTexto("Total: $" + recibo.Total + "\n")
                                .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                                .EscribirTexto("Servicio Laser")

                                .EscribirTexto("-------------------------")
                                .Feed(1);

                            for (const pago of recibo.pago) {
                                conector
                                .EscribirTexto(" Fecha: " + pago.fecha + "\n")
                                .EscribirTexto(" Pago: $" + pago.pago + "\n")
                                .EscribirTexto(" Cambio: $" + pago.cambio + "\n")
                                .EscribirTexto(" Met. Pago: " + pago.forma_pago + "\n")
                                .EscribirTexto("-------------------------")
                                conector.Feed(1);
                            }

                            const respuesta = await conector.imprimirEn(recibo.nombreImpresora);

                            if (!respuesta) {
                                alert("Error al imprimir ticket: " + respuesta);
                            } else {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Guardado con exito',
                                    text: 'Impresion de ticket y apertura de caja',
                                }).then(() => {
                                    // Recarga la página
                                   window.location.href = '/notas/laser/pdf/' + recibo.id;
                                });
                            }

                        }else{

                            const conector = new ConectorPluginV3();
                            console.log(recibo);

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                                .EscribirTexto("Cosmetologa: " + recibo.cosmetologa + "\n")
                                .EscribirTexto("Total: $" + recibo.Total + "\n")
                                .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                                .EscribirTexto("Servicio Laser")
                                .EscribirTexto("-------------------------")
                                .Feed(1);

                            for (const pago of recibo.pago) {
                                conector
                                .EscribirTexto(" Fecha: " + pago.fecha + "\n")
                                .EscribirTexto(" Pago: $" + pago.pago + "\n")
                                .EscribirTexto(" Cambio: $" + pago.cambio + "\n")
                                .EscribirTexto(" Met. Pago: " + pago.forma_pago + "\n")
                                .EscribirTexto("-------------------------")
                                conector.Feed(1);
                            }

                            const respuesta = await conector.imprimirEn(recibo.nombreImpresora);

                            if (!respuesta) {
                                alert("Error al imprimir ticket: " + respuesta);
                            } else {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Guardado con exito',
                                    text: 'Impresion de ticket',
                                }).then(() => {
                                    // Recarga la página
                                    window.location.href = '/notas/laser/edit/' + recibo.id;
                                });
                            }

                        }
                    } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            window.location.href = '/notas/laser/edit/' + recibo.id;
                        }, 1000);
                    }
            }
    });
</script>


@endsection
