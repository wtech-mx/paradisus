@extends('layouts.app')

@section('template_title')
   Crear Nota
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Nota</h3>

                            <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
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
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-sesion" role="tab" aria-controls="pills-sesion" aria-selected="true" id="pills-sesion-tab">
                                        <i class="fa fa-calendar-day text-sm me-2"></i> Sesiones
                                    </a>

                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-extra" role="tab" aria-controls="pills-extra" aria-selected="true" id="pills-extra-tab">
                                        <i class="fa fa-money-bill text-sm me-2"></i> Extras
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-propina" role="tab" aria-controls="pills-propina" aria-selected="true" id="pills-propina-tab">
                                        <i class="fa fa-coin text-sm me-2"></i> Propina
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

                                            <div class="col-1">
                                                <label for="precio">Mas</label><br>
                                                <button class="btn btn-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseServicio" aria-expanded="false" aria-controls="collapseExample">
                                                    <img src="{{ asset('assets/icons/mas.png') }}" alt="" width="25px">
                                                </button>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="precio">Servicio</label><br>
                                                    <select class="form-control servicio1" data-toggle="select" id="servicio1" name="id_servicio" required>
                                                        <option value="">Seleccionar servicio</option>
                                                        @foreach ($servicio as $item)
                                                            <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                    <label for="name">Num *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="number" id="num1" name="num1" class="form-control" value="1">
                                                    </div>
                                            </div>

                                            <div class="col-3">
                                                    <label for="name">Precio *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" id="total" name="total1" class="form-control" readonly>
                                                    </div>
                                            </div>
                                            <div class="col-2">
                                                    <label>P. Descuento</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input type="text" class="form-control" id="totalConDescuento1" name="totalConDescuento1" disabled>
                                                    </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-check">
                                                    <label>¿Descuento?</label><br>
                                                    <input class="form-check-input" type="checkbox" name="check_desc1" id="check_desc1" value="1">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <label>Descuento adicional (%)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="number" id="descuento-adicional1" name="descuento" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        {{-- A G R E G A R  M A S  S E R V I C I O S --}}
                                        <div class="collapse" id="collapseServicio">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 2</label><br>
                                                            <select class="form-control servicio2" data-toggle="select" id="servicio2" name="id_servicio2">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label for="name">Num 2</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="num2" name="num2" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                            <label for="name">Total</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                                </span>
                                                                <input type="text" id="total22" name="total2" class="form-control" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento2" name="totalConDescuento2" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-check">
                                                            <label>¿Descuento?</label><br>
                                                            <input class="form-check-input" type="checkbox" name="check_desc2" id="check_desc2" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="name">Descuento adicional (%)</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="descuento-adicional2" name="descuento2" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 3</label><br>
                                                            <select class="form-control servicio3" data-toggle="select" id="servicio3" name="id_servicio3">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label for="name">Num 3</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="num3" name="num3" class="form-control" value="1">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="name">Total</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" id="total33" name="total3" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento3" name="totalConDescuento3" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-check">
                                                            <label>¿Descuento?</label><br>
                                                            <input class="form-check-input" type="checkbox" name="check_desc3" id="check_desc3" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="name">Descuento adicional (%)</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="descuento-adicional3" name="descuento3" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 4</label><br>
                                                            <select class="form-control servicio4" id="servicio4" name="id_servicio4">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label for="name">Num 4</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="num4" name="num4" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="name">Total</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" id="total44" name="total4" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento4" name="totalConDescuento4" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-check">
                                                            <label>¿Descuento?</label><br>
                                                            <input class="form-check-input" type="checkbox" name="check_desc4" id="check_desc4" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="name">Descuento adicional (%)</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="descuento-adicional4" name="descuento4" class="form-control">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="descuento">Nota</label>
                                            <textarea name="nota" id="nota" cols="10" rows="3" class="form-control"></textarea>
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
                                                    <input type="text" id="total-suma" name="total-suma" class="form-control" readonly>
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

                                    <div class="tab-pane fade" id="pills-sesion" role="tabpanel" aria-labelledby="pills-sesion-tab">
                                        <div class="row">

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$fechaActual}}">
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="fecha">Hora de inicio</label>
                                                    <input  id="start" name="start" type="time" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="fecha">Hora de Fin</label>
                                                    <input  id="end" name="end" type="time" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="">Selecionar Unidad</label>
                                                    <select class="form-control" id="resourceId" name="resourceId">
                                                         <option value="">Seleccione Unidad</option>
                                                         @for ($i = 1; $i <= $configuracion->modulos; $i++)
                                                            @php
                                                                $letra = chr($i + 64); // Convierte el número en su equivalente de letra ASCII (A = 1, B = 2, etc.)
                                                            @endphp
                                                         <option value="{{ $letra }}">{{ $letra }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-1">
                                                <div class="form-group">
                                                    <label for="num_sesion">sesion</label>
                                                    <input  id="sesion" name="sesion" type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="nota">Nota</label>
                                                    <textarea class="form-control" id="nota3" name="nota3" rows="1"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-extra" role="tabpanel" aria-labelledby="pills-extra-tab">
                                        <div id="formulario_2" class="mt-4">
                                            {{-- <button type="button" class="btn_clonar2 btn btn-secondary btn-sm">Agregar</button> --}}
                                            <div class="clonars2">
                                                <div class="row">

                                                    <div class="col-3">

                                                        <label for="total-suma">Concepto</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/carta_res.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input  id="concepto" name="concepto" type="text" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Precio</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/money.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input  id="precio" name="precio" type="number" class="form-control" >
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-propina" role="tabpanel" aria-labelledby="pills-propina-tab">
                                        <div id="formulario_3" class="mt-4">
                                            <div class="row">
                                                <div class="col-6">

                                                    <label for="total-suma">Seleccione Usuario</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/ama-de-casa.webp') }}" alt="" width="25px">
                                                        </span>
                                                        <select class="form-control " id="id_user_propina" name="id_user_propina" value="{{ old('id_user_propina') }}" required>
                                                            @foreach ($user as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col-3">
                                                    <label for="total-suma">Propina</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input  id="propina" name="propina" type="number" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-3">

                                                    <label for="total-suma">Metodo Pago</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                                                        </span>
                                                        <select id="forma_pago_propina" name="forma_pago_propina" class="form-control">
                                                            <option value="Efectivo">Efectivo</option>
                                                            <option value="Transferencia">Transferencia</option>
                                                            <option value="Mercado Pago">Mercado Pago</option>
                                                            <option value="Tarjeta">Tarjeta</option>
                                                            <option value="Gift Card">Gift Card</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
                $('.servicio1').select2();
                $('.servicio2').select2();
                $('.servicio3').select2();
                $('.servicio4').select2();
        });

    </script>

<script>
    // Obtener el precio del servicio seleccionado y calcular el total al cambiar el servicio o la cantidad
    $('.servicio1, #num1, #descuento-adicional1').change(function() {
        var selectedService = $('.servicio1 option:selected');
        var precio = selectedService.data('precio');
        var descuento = selectedService.data('descuento');
        var actDescuento = selectedService.data('act-descuento');
        var cantidad = parseInt($('#num1').val());
        var descuentoAdicional = parseInt($('#descuento-adicional1').val()) || 0; // Descuento adicional ingresado

        // Calcular el subtotal usando el precio
        var subtotal = cantidad * precio;

        $('#total').val(precio);

        $('#totalConDescuento1').val(descuento);

        var descuentoTotal = (subtotal * descuentoAdicional) / 100;
        var total = subtotal - descuentoTotal;

        $('#total').val(total);
    });

    // Obtener el precio del servicio seleccionado y calcular el total al cambiar el servicio o la cantidad
    $('.servicio2, #num2, #descuento-adicional2').change(function() {
        var selectedService = $('.servicio2 option:selected');
        var precio = selectedService.data('precio');
        var descuento = selectedService.data('descuento');
        var actDescuento = selectedService.data('act-descuento');
        var cantidad = parseInt($('#num2').val());
        var descuentoAdicional = parseInt($('#descuento-adicional2').val()) || 0; // Descuento adicional ingresado

        // Calcular el subtotal usando el precio
        var subtotal = cantidad * precio;

        $('#total22').val(precio);

        $('#totalConDescuento2').val(descuento);

        var descuentoTotal = (subtotal * descuentoAdicional) / 100;
        var total = subtotal - descuentoTotal;

        $('#total22').val(total);
    });

    // Obtener el precio del servicio seleccionado y calcular el total al cambiar el servicio o la cantidad
    $('.servicio3, #num3, #descuento-adicional3').change(function() {
        var selectedService = $('.servicio3 option:selected');
        var precio = selectedService.data('precio');
        var descuento = selectedService.data('descuento');
        var actDescuento = selectedService.data('act-descuento');
        var cantidad = parseInt($('#num3').val());
        var descuentoAdicional = parseInt($('#descuento-adicional3').val()) || 0; // Descuento adicional ingresado

        // Calcular el subtotal usando el precio
        var subtotal = cantidad * precio;

        $('#total33').val(precio);

        $('#totalConDescuento3').val(descuento);

        var descuentoTotal = (subtotal * descuentoAdicional) / 100;
        var total = subtotal - descuentoTotal;

        $('#total33').val(total);
    });

    // Obtener el precio del servicio seleccionado y calcular el total al cambiar el servicio o la cantidad
    $('.servicio4, #num4, #descuento-adicional4').change(function() {
        var selectedService = $('.servicio4 option:selected');
        var precio = selectedService.data('precio');
        var descuento = selectedService.data('descuento');
        var actDescuento = selectedService.data('act-descuento');
        var cantidad = parseInt($('#num4').val());
        var descuentoAdicional = parseInt($('#descuento-adicional4').val()) || 0; // Descuento adicional ingresado

        // Calcular el subtotal usando el precio
        var subtotal = cantidad * precio;

        $('#total44').val(precio);

        $('#totalConDescuento4').val(descuento);

        var descuentoTotal = (subtotal * descuentoAdicional) / 100;
        var total = subtotal - descuentoTotal;

        $('#total44').val(total);
    });

    // Configura el evento change para el checkbox
    $('#check_desc1').change(function() {
        calcularTotal();
    });
    $('#check_desc2').change(function() {
        calcularTotal();
    });
    $('#check_desc3').change(function() {
        calcularTotal();
    });
    $('#check_desc4').change(function() {
        calcularTotal();
    });

    function calcularTotal() {
        var totalSuma = 0;

        for (var i = 1; i <= 4; i++) {
            var selectedService = $('.servicio' + i + ' option:selected');
            var precio = selectedService.data('precio');
            var descuento = selectedService.data('descuento');
            var actDescuento = selectedService.data('act-descuento');
            var cantidad = parseInt($('#num' + i).val());
            var descuentoAdicional = parseInt($('#descuento-adicional' + i).val()) || 0;
            var checkDesc = $('#check_desc' + i).is(':checked');

            if (!isNaN(cantidad) && !isNaN(descuentoAdicional)) {
                if (checkDesc && descuento > 0) {
                    subtotal = cantidad * descuento; // Aplicar descuento si el checkbox está marcado y hay un descuento
                } else {
                    subtotal = cantidad * precio;
                }
                    console.log(subtotal);
                var descuentoTotal = (subtotal * descuentoAdicional) / 100; // Calcular descuento adicional
                var total = subtotal - descuentoTotal;

                $('#total' + i).val(total);

                if (!isNaN(total)) {
                    totalSuma += total;
                }
            }
        }

        var precio = parseFloat($('#precio').val()) || 0;
        var propina = parseFloat($('#propina').val()) || 0;

        var nuevoTotal = totalSuma + precio + propina;

        $('#total-suma').val(nuevoTotal.toFixed(2));
    }

    // Llamar a la función calcularTotal() al cargar la página para mostrar el total inicial
    calcularTotal();

    // Vincular el evento change a todos los campos relacionados para actualizar los totales al cambiar la selección o la cantidad
    $('.servicio1, #num1, #descuento-adicional1, .servicio2, #num2, #descuento-adicional2, .servicio3, #num3, #descuento-adicional3, .servicio4, #num4, #descuento-adicional4, #precio, #propina').change(function() {
    calcularTotal();
    });

    // Obtén la referencia a los elementos de pago, cambio, y dinero recibido
    var inputPago = $('#pago');
    var inputCambio = $('#cambio');
    var inputDineroRecibido = $('#dinero_recibido');

    // Función para calcular cambio y restante
    function calcularCambioYRestante() {
        // Obtiene el valor del pago
        var pago = parseFloat(inputPago.val()) || 0;

        // Obtiene el valor del total a pagar
        var totalAPagar = parseFloat($('#total-suma').val()) || 0;

        // Calcula el restante solo en función del pago
        var restante = totalAPagar - pago;

        // Establece el valor del restante en el campo correspondiente
        $('#restante').val(restante);

        // Obtiene el valor del dinero recibido
        var dineroRecibido = parseFloat(inputDineroRecibido.val()) || 0;

        // Calcula el cambio solo si el dinero recibido es mayor que el pago
        var cambio = (dineroRecibido > pago) ? dineroRecibido - pago : 0;

        // Establece el valor del cambio en el campo correspondiente
        inputCambio.val(cambio);
    }

    // Escucha el evento 'input' en los campos de pago y dinero recibido
    inputPago.on('input', calcularCambioYRestante);
    inputDineroRecibido.on('input', calcularCambioYRestante);


    // inicio de funcion ajax impresion caja y tiket

    $(document).ready(function () {
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
                                .EscribirTexto("Servicio: " + recibo.notas_paquetes + "\n")
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
                                   window.location.href = '/notas/servicios/edit/' + recibo.id;
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
                                .EscribirTexto("Servicio: " + recibo.notas_paquetes + "\n")
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
                                    window.location.href = '/notas/servicios/edit/' + recibo.id;
                                });
                            }

                        }
                    } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            window.location.href = '/notas/servicios/edit/' + recibo.id;
                        }, 1000);
                    }
            }


        });


</script>
@endsection
