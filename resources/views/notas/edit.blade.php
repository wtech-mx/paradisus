@extends('layouts.app')

@section('template_title')
   Editar Notas
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Editar Nota</h3>

                            <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#servicioedit{{$notas->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                                    </a>

                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pagoedit{{$notas->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-condiciones{{$notas->id}}" role="tab" aria-controls="pills-condiciones" aria-selected="true" id="pills-condiciones-tab">
                                        <i class="fa fa-file text-sm me-2"></i> Condiciones
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#extra{{$notas->id}}" role="tab" aria-controls="extra" aria-selected="true" id="extra-tab">
                                        <i class="fa fa-money-bill text-sm me-2"></i> Extras
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-sesion{{$notas->id}}" role="tab" aria-controls="pills-sesion" aria-selected="true" id="pills-sesion-tab">
                                        <i class="fa fa-calendar-day text-sm me-2"></i> Sesiones
                                    </a>
                                </li>
                            </ul>

                            <form method="POST" action="{{ route('notas.update', $notas->id) }}" id="miFormulario" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="col-3">
                                                <div class="form-group mt-3">
                                                    @if ($notas->anular == 1)
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="anular" style="font-size: 15px;">Anular Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="anular" id="anular" value="{{$notas->anular}}" checked>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="anular" style="font-size: 15px;">Anular Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="anular" id="anular" value="1">
                                                            </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-3 mt-3">
                                                <a type="button" class="btn btn-primary btn-sm" href="{{route('notas.usuario_imprimir', $notas->id)}}"style="color: #ffff">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <input class="" type="hidden" name="id_notas_cosmes" id="id_notas_cosmes" value="{{ $notas->NotasCosmes->id }}">
                                        <div class="tab-pane fade in active show" id="servicioedit{{$notas->id}}">
                                            <div class="form-group">
                                                <label for="nombre">Cosmetologas</label>
                                                <select  id="id_user[]" name="id_user[]" class="js-example-basic-multiple form-control user" >
                                                    @foreach ($user as $item)
                                                        @if ($notas->NotasCosmes->id_user == $item->id)
                                                        <option selected value="{{$item->id }}">{{$item->name}}</option>
                                                        @endif
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                    {{-- @foreach($nota_cosme as $item)
                                                        <option value="{{$item->id }}">{{$item->User->name}}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Cliente</label>
                                                <select class="form-control input-edit-car cliente" id="id_client" name="id_client"
                                                    value="{{ old('id_client') }}" >
                                                    <option value="{{ $notas->id_client }}">{{ $notas->Client->name }} {{ $notas->Client->last_name }}</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} / {{ $item->phone }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="precio">Servicio</label>
                                                        <select class="form-control servicio_search servicio1_paquetes" id="servicio1_paquetes" name="id_servicio" data-toggle="select" data-id="{{ $notas->Paquetes->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive" >
                                                            <option value="{{ $notas->Paquetes->id_servicio }}" data-precio="{{ $notas->Paquetes->Servicios->precio }}" data-descuento="{{ $notas->Paquetes->Servicios->descuento }}" data-act-descuento="{{ $notas->Paquetes->Servicios->act_descuento }}">{{ $notas->Paquetes->Servicios->nombre }}</option>
                                                            @foreach ($servicio as $item)
                                                                <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="precio">Num</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/hashtag.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="number" id="num1_paquetes" name="num1_paquetes" class="form-control" value="{{ $notas->Paquetes->num }}" >
                                                            <input type="hidden" id="id_notas_paquetes" name="id_notas_paquetes" class="form-control" value="{{ $notas->Paquetes->id }}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="precio">Precio</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" id="total1_paquetes" name="total1_paquetes" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label>P. Descuento</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" id="totalConDescuento1_paquetes" name="totalConDescuento1_paquetes" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-check">
                                                        <label>¿Descuento?</label><br>
                                                        <input class="form-check-input" type="checkbox" name="check_desc1" id="check_desc1" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="descuento">Descuento %</label><br>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input class="form-control" type="number" name="descuento-adicional1_paquetes" id="descuento-adicional1_paquetes" value="{{$notas->Paquetes->descuento}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- M A S  S E R V I C I O S --}}
                                            <div class="card card-body">
                                                {{-- D O S  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 2</label><br>
                                                            <select class="form-control servicio2_paquetes servicio2" data-toggle="select" id="servicio2_paquetes" name="id_servicio2" >
                                                                @if ($notas->Paquetes->id_servicio2 == NULL || $notas->Paquetes->id_servicio2 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio2 }}" data-precio="{{ $notas->Paquetes->Servicios2->precio }}" data-descuento="{{ $notas->Paquetes->Servicios2->descuento }}" data-act-descuento="{{ $notas->Paquetes->Servicios2->act_descuento }}">{{ $notas->Paquetes->Servicios2->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-group">
                                                            <label for="precio">Num 2</label>
                                                                <input type="number" id="num2_paquetes" name="num2_paquetes" class="form-control" value="{{ $notas->Paquetes->num2 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Total</label>
                                                            <input type="text" id="total2_paquetes" name="total2_paquetes" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento2_paquetes" name="totalConDescuento2_paquetes" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="descuento">Descuento %</label><br>
                                                            <input class="form-control" type="number" name="descuento-adicional2_paquetes" id="descuento-adicional2_paquetes" value="{{$notas->Paquetes->descuento2}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- T R E S  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 3</label><br>
                                                            <select class="form-control servicio3_paquetes servicio3" data-toggle="select" id="servicio3_paquetes" name="id_servicio3" >
                                                                @if ($notas->Paquetes->id_servicio3 == NULL || $notas->Paquetes->id_servicio3 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio3 }}" data-precio="{{ $notas->Paquetes->Servicios3->precio }}" data-descuento="{{ $notas->Paquetes->Servicios3->descuento }}" data-act-descuento="{{ $notas->Paquetes->Servicios3->act_descuento }}">{{ $notas->Paquetes->Servicios3->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-group">
                                                            <label for="precio">Num 3</label>
                                                                <input type="number" id="num3_paquetes" name="num3_paquetes" class="form-control" value="{{ $notas->Paquetes->num3 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Total</label>
                                                            <input type="text" id="total3_paquetes" name="total3_paquetes" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento3_paquetes" name="totalConDescuento3_paquetes" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="descuento">Descuento %</label><br>
                                                            <input class="form-control" type="number" name="descuento-adicional3_paquetes" id="descuento-adicional3_paquetes" value="{{$notas->Paquetes->descuento3}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- C U A T R O  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 4</label><br>
                                                            <select class="form-control servicio4_paquetes servicio4" id="servicio4_paquetes" name="id_servicio4" >
                                                                @if ($notas->Paquetes->id_servicio4 == NULL || $notas->Paquetes->id_servicio4 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio4 }}" data-precio="{{ $notas->Paquetes->Servicios4->precio }}" data-descuento="{{ $notas->Paquetes->Servicios4->descuento }}" data-act-descuento="{{ $notas->Paquetes->Servicios4->act_descuento }}">{{ $notas->Paquetes->Servicios4->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}" data-descuento="{{ $item->descuento }}" data-act-descuento="{{ $item->act_descuento }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-group">
                                                            <label for="precio">Num 4</label>
                                                                <input type="number" id="num4_paquetes" name="num4_paquetes" class="form-control" value="{{ $notas->Paquetes->num4 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Total</label>
                                                            <input type="text" id="total4_paquetes" name="total4_paquetes" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label>Descuento</label>
                                                            <input type="text" class="form-control" id="totalConDescuento4_paquetes" name="totalConDescuento4_paquetes" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="descuento">Descuento %</label><br>
                                                            <input class="form-control" type="number" name="descuento-adicional4_paquetes" id="descuento-adicional4_paquetes" value="{{$notas->Paquetes->descuento4}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- E N D  M A S  S E R V I C I O S --}}

                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="nota">Nota</label>
                                                <textarea name="nota" id="nota" cols="10" rows="3" class="form-control" >{{$notas->nota}}</textarea>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pagoedit{{$notas->id}}" >
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="editarCampos">Editar Campos de pago</label>

                                                    <input class="form-check-input" type="radio" id="editarCamposNo" name="editarsi"  value="no">
                                                    <label  class="form-check-label" for="editarCamposNo">No</label>

                                                    <input class="form-check-input" type="radio" id="editarCamposSi" name="editarsi" value="si">
                                                    <label  class="form-check-label" for="editarCamposSi">Sí</label>
                                                </div>
                                            </div>

                                            <div class="row text-center container_pagos">
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Usuario</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Pago</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Dinero recibido</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>

                                                <p style="display: none">{{ $resultado = 0; }}</p>

                                                @foreach ($pago as $item)

                                                    <input id="pago_{{ $item->id }}" name="pago_id_edit[]" type="hidden" class="form-control" value="{{ $item->id }}">


                                                    <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                                    <div class="col-2 py-2 p-1" >
                                                        <input name="fecha_pago_edit[]" type="date" class="form-control text-center" id="fecha_pago" value="{{$item->fecha}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2 p-1" >
                                                        <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                            <option value="{{$item->cosmetologa}}">{{ $item->User->name }}</option>
                                                            @foreach ($user as $cosmes)
                                                                <option value="{{ $cosmes->id }}" >{{ $cosmes->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-1 py-2 p-1" >
                                                        <input name="pago_edit[]" type="number" class="form-control text-center pago-existente" id="pago_{{ $item->id }}" value="{{$item->pago}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2 p-1" >
                                                        <input name="dinero_recibido_edit[]" type="number" class="form-control text-center" id="pago_{{ $item->id }}" value="{{$item->dinero_recibido}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2 p-1" >
                                                        <select class="form-control toggle-class" id="cosmetologa" name="forma_pago_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                            <option value="{{$item->forma_pago}}">{{$item->forma_pago}}</option>
                                                            <option value="Efectivo">Efectivo</option>
                                                            <option value="Transferencia">Transferencia</option>
                                                            <option value="Mercado Pago">Mercado Pago</option>
                                                            <option value="Tarjeta">Tarjeta</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-2 py-2 p-1" >
                                                        <textarea class="form-control text-center" name="nota_edit[]" id="nota[]" cols="3" rows="1" disabled>{{$item->nota}}</textarea>
                                                    </div>

                                                    @if ($item->foto == NULL)
                                                        <a href=""></a>
                                                    @else
                                                        <div class="col-1 py-2 p-1">
                                                            <a target="_blank" href="{{asset('foto_servicios/'.$item->foto)}}">Ver</a>
                                                        </div>
                                                    @endif

                                                @endforeach

                                            </div>

                                            <div class="mt-4">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="total-suma">Total a Pagar</label>
                                                            <input type="text" id="total-suma" name="total-suma" class="form-control" readonly value="{{$notas->precio}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="restante">Saldo a favor</label>
                                                            <input type="text" id="saldo-favor" class="form-control" readonly value="$ {{ $resultado; }} MXN">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="restante">Restante</label>
                                                            <input type="text" id="restante-edit" name="restante_paquetes" class="form-control" readonly value="{{$notas->restante}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="restante">Cambio</label>
                                                            <input type="text" id="cambio-edit" name="cambio" class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="fecha">Fecha</label>
                                                            <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="fecha">Usuario</label>
                                                            <select class="form-control"  data-toggle="select" id="cosmetologa" name="cosmetologa" value="">
                                                                @foreach ($user as $cosmes)
                                                                    <option value="{{ $cosmes->id }}">{{ $cosmes->name }}</option>
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
                                                            <input  id="nuevo-pago" name="pago" type="number" class="form-control" >
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Dinero recibido</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input  id="dinero-recibido-edit" name="dinero_recibido" type="number" class="form-control" >
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago" name="forma_pago" class="form-control">
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
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
                                                        <div class="form-group">
                                                            <label for="nota">Foto</label>
                                                            <input type="file" id="foto" class="form-control" name="foto">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-sesion{{$notas->id}}" role="tabpanel" aria-labelledby="pills-sesion-tab">
                                            @foreach ($sesiones as $alerta)
                                                <div class="row">
                                                    @php
                                                        $fechaFormateada = Carbon::parse($alerta->start)->locale('es')->isoFormat('dddd D [de] MMMM');
                                                        $horaFormateada = Carbon::parse($alerta->start)->format('g:i A');
                                                    @endphp

                                                    <div class="col-3">
                                                        <label for="total-suma">Fecha sesion</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" value="{{$fechaFormateada}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label for="total-suma">Hora sesion</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" value="{{$horaFormateada}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <label for="total-suma">Estatus</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/change.png') }}" alt="" width="25px">
                                                            </span>
                                                            <input type="text" class="form-control" value="{{$alerta->estatus}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <label for="total-suma">Descripcion</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/icons/cuaderno.webp') }}" alt="" width="25px">
                                                            </span>
                                                            <textarea class="form-control" cols="10" rows="3" disabled>{{$alerta->descripcion}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="tab-pane fade" id="pills-condiciones{{$notas->id}}" role="tabpanel" aria-labelledby="pills-condiciones-tab">

                                            <h5>Politicas & Condiciones</h5>

                                            <div class="row">
                                                <div class="col-12">
                                                    <ul class="list-group mt-5 mb-5" style="margin-left: 3rem">
                                                        <li>Al apartar tu paquete no habrá reembolsos de anticipos o abonos.</li>
                                                        <li>Solo tienes oportunidad de <b>re-agendar UNA sesión</b> con un mínimo de <b>3 días de anticipo.</b> </li>
                                                        <li>En caso de fallar más de una de las sesiones, ya <b>NO se reagendará</b> y tendrás que volverla a pagar, independiente del costo de tu paquete.</li>
                                                    </ul>
                                                </div>

                                                <div class="col-12">
                                                    <strong>He leído todas las cláusulas y estoy de acuerdo.</strong><br/>
                                                    @if ($notas->firma == NULL)
                                                        <div id="sig_ini"></div>
                                                        <br/><br/>
                                                        <button id="clear_ini" class="btn btn-danger btn-sm">Repetir</button>
                                                        <textarea id="signed_ini" name="signed_ini" style="display: none"></textarea>
                                                    @else
                                                        <img src="{{asset('firmas_notas/'.$notas->firma)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="extra{{$notas->id}}" role="tabpanel" aria-labelledby="extra-tab">
                                            @foreach ($notas_extras as $index => $item)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="concepto_{{ $index }}">Concepto</label>
                                                            <input  id="concepto_{{ $index }}" name="concepto[]" type="text" class="form-control" value="{{$item->concepto}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="precio_{{ $index }}">Precio</label>
                                                            <input  id="precio_{{ $index }}" name="precio[]" type="number" class="form-control" value="{{$item->precio}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div id="formulario3" class="mt-4">
                                                {{-- <button type="button" class="clonar3 btn btn-secondary btn-sm">Agregar</button> --}}
                                                <div class="clonars3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="descripcion">Concepto</label>
                                                                <input  id="concepto" name="concepto" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Precio</label>
                                                                <input  id="precio" name="precio" type="number" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="propina{{$notas->id}}" role="tabpanel" aria-labelledby="propina-tab">
                                            @foreach ($notas_propinas as $index => $item)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="id_user_propina_{{ $index }}">Seleccione Usuario</label>
                                                            <select class="form-control" id="id_user_propina_{{ $index }}" name="id_user_propina[]" value="{{ old('id_user_propina') }}" required disabled>
                                                                <option value="{{ $item->id_user }}">{{ $item->User->name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Propina</label>
                                                            <input type="number" id="propina_{{ $index }}" name="propina[]" class="form-control" value="{{$item->propina}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago_propina" name="forma_pago_propina" class="form-control" disabled>
                                                                <option value="{{ $item->metdodo_pago }}">{{ $item->metdodo_pago }}</option>
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
                                                                <option value="Gift Card">Gift Card</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div id="formulario3" class="mt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombre">Seleccione Usuario</label>
                                                            <select class="form-control " id="id_user_propina" name="id_user_propina" value="{{ old('id_user_propina') }}" required>
                                                                @foreach ($user as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="Propina">Propina</label>
                                                            <input  id="propina" name="propina" type="number" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago_propina" name="forma_pago_propina" class="form-control">
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
                                                            </select>
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
                                                Actualizar
                                            </button>
                                            <div class="d-flex justify-content-center">
                                                <div class="spinner-border" role="status" id="preloader" style="display:none">
                                                     <span class="visually-hidden">Loading...</span>
                                                 </div>
                                            </div>
                                        </div>
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

    <script>

            $(document).ready(function() {
                $('.user').select2();
                $('.servicio_search').select2();
                $('.cliente').select2();
                $('.servicio2').select2();
                $('.servicio3').select2();
                $('.servicio4').select2();
                $('.cosme_sesion_edit').select2();


            // Obtiene los radio buttons de editar campos
            var radioEditarNo = document.getElementById('editarCamposNo');
            var radioEditarSi = document.getElementById('editarCamposSi');

            // Escucha el evento de cambio en el radio button
            radioEditarNo.addEventListener('change', toggleCampos);
            radioEditarSi.addEventListener('change', toggleCampos);

            // Función para cambiar el estado de los campos
            function toggleCampos() {
                // Obtiene todos los elementos de tipo input, select y textarea dentro de la fila
                var campos = document.querySelectorAll('.container_pagos input, .container_pagos select, .container_pagos textarea');

                // Itera sobre los campos y cambia el estado disabled según el estado del radio button
                campos.forEach(function(campo) {
                    campo.disabled = !radioEditarSi.checked; // Habilita/deshabilita según el estado del radio button 'Sí'
                });
            }

            // Llama a la función al cargar la página para aplicar el estado inicial
            toggleCampos();
        });

        // Obtén la referencia a los elementos de nuevo-pago, cambio-edit, dinero-recibido-edit y restante-edit
        var inputNuevoPago = $('#nuevo-pago');
        var inputCambioEdit = $('#cambio-edit');
        var inputDineroRecibidoEdit = $('#dinero-recibido-edit');
        var inputRestanteEdit = $('#restante-edit');
        var precioDesdeDB = parseFloat("<?php echo $notas->precio; ?>");
        $('#total-suma').val(precioDesdeDB);
        console.log('precio', precioDesdeDB);

        function calcularCambio() {
            var nuevoPago = parseFloat(inputNuevoPago.val()) || 0;
            var dineroRecibidoEdit = parseFloat(inputDineroRecibidoEdit.val()) || 0;

            var cambio = 0;

            if (dineroRecibidoEdit > nuevoPago) {
                cambio = dineroRecibidoEdit - nuevoPago;
            }

            inputCambioEdit.val(cambio);
        }

        function calcularRestante() {
            var cambiosRealizados = false;
            var pagosExistentes = 0;
            $('.pago-existente').each(function() {
                pagosExistentes += parseFloat($(this).val()) || 0;
            });

            var nuevoPago = parseFloat(inputNuevoPago.val()) || 0;
            if (cambiosRealizados) {
                var totalSuma = parseFloat($('#total-suma').val()) || 0;
            }else{
                var totalSuma = parseFloat("<?php echo $notas->precio; ?>") || 0;
            }

            console.log('saldo', pagosExistentes);
            var restante = totalSuma - pagosExistentes - nuevoPago;

            inputRestanteEdit.val(restante);
        }

        // Escucha el evento 'input' en los campos de nuevo-pago y dinero-recibido-edit
        inputNuevoPago.on('input', function() {
            calcularCambio();
            calcularRestante();
        });

        inputDineroRecibidoEdit.on('input', function() {
            calcularCambio();
            calcularRestante();
        });

        // Calcula el cambio y el restante al cargar la página
        calcularCambio();
        calcularRestante();

            // Configura el evento change para el checkbox
            $('#totalConDescuento1_paquetes').change(function() {
                calcularTotalServicio();
            });
            $('#totalConDescuento2_paquetes').change(function() {
                calcularTotalServicio();
            });
            $('#totalConDescuento3_paquetes').change(function() {
                calcularTotalServicio();
            });
            $('#totalConDescuento4_paquetes').change(function() {
                calcularTotalServicio();
            });

        $(document).ready(function() {
          function calcularTotalServicio(servicioNumber) {
            var selectedService = $('.servicio' + servicioNumber + '_paquetes option:selected');
            var precio = selectedService.data('precio');
            var descuento = selectedService.data('descuento');
            var actDescuento = selectedService.data('act-descuento');
            var cantidad = parseInt($('#num' + servicioNumber + '_paquetes').val());
            var descuentoAdicional = parseInt($('#descuento-adicional' + servicioNumber + '_paquetes').val()) || 0;
            var checkDesc = $('#totalConDescuento' + servicioNumber + '_paquetes').is(':checked');
            console.log('numSer',servicioNumber);
            // Calcular el subtotal usando el precio
            if (checkDesc && descuento > 0) {
                    subtotal = cantidad * descuento; // Aplicar descuento si el checkbox está marcado y hay un descuento
                } else {
                    subtotal = cantidad * precio;
                }
                    console.log('sub',subtotal);

            // Mostrar el precio en "total1_paquetes"
            $('#total' + servicioNumber + '_paquetes').val(precio);

            // Mostrar el descuento en "totalConDescuento1_paquetes"
            $('#totalConDescuento' + servicioNumber + '_paquetes').val(descuento);

            // Calcular el total con descuento adicional
            var descuentoTotal = (subtotal * descuentoAdicional) / 100;
            var total = subtotal - descuentoTotal;

            $('#total' + servicioNumber + '_paquetes').val(total);
          }

          function calcularTotales() {
            var cambiosRealizados = false;
            calcularTotalServicio(1);
            calcularTotalServicio(2);
            calcularTotalServicio(3);
            calcularTotalServicio(4);

            // Calcular el total de suma
            var totalSuma = 0;

            $('.form-control[id^="total"][id$="_paquetes"]').each(function() {
                var valorTotal = parseFloat($(this).val());
                if (!isNaN(valorTotal)) {
                    totalSuma += valorTotal;
                }
            });


            // Sumar los precios de las notas extras
            $('input[name="precio[]"]').each(function() {
                var precio = parseFloat($(this).val());
                if (!isNaN(precio)) {
                totalSuma += precio;
                }
            });

            // Sumar las propinas
            $('input[name="propina[]"]').each(function() {
                var propina = parseFloat($(this).val());
                if (!isNaN(propina)) {
                totalSuma += propina;
                }
            });

            if (cambiosRealizados) {
                $('#total-suma').val(totalSuma);
            }else{
                $('#total-suma').val(precioDesdeDB);
            }
            calcularRestante();
          }

            $('.servicio1_paquetes, #num1_paquetes, #descuento-adicional1_paquetes').change(calcularTotales);
            $('.servicio2_paquetes, #num2_paquetes, #descuento-adicional2_paquetes').change(calcularTotales);
            $('.servicio3_paquetes, #num3_paquetes, #descuento-adicional3_paquetes').change(calcularTotales);
            $('.servicio4_paquetes, #num4_paquetes, #descuento-adicional4_paquetes').change(calcularTotales);

            $('#nuevo-pago').change(calcularRestante); // Llamar a calcularRestante al cambiar el valor del nuevo pago

            // Llamar a calcularTotales al cargar la página de edición
            calcularTotales();

            // Llamar a calcularRestante al cargar la página de edición
            calcularRestante();

            // Agregar evento de cambio en el campo de nuevo pago
            inputPago.on('input', function() {
                calcularRestante();
            });
        });

        function sumarPreciosAdicionales() {
            var totalServicios = 0;
            var cambiosRealizados = false;
            if(cambiosRealizados){
                $('.form-control[id^="total"][id$="_paquetes"]').each(function() {
                    var valorTotal = parseFloat($(this).val());
                    if (!isNaN(valorTotal)) {
                    totalServicios += valorTotal;
                    }
                });
            }else{
                totalServicios = precioDesdeDB;
            }


            var totalAdicionales = 0;
            $('input[id="precio"]').each(function() {
                var precio = parseFloat($(this).val());
                if (!isNaN(precio)) {
                totalAdicionales += precio;
                }
            });

            var totalPropinas = 0;
            $('input[id="propina"]').each(function() {
                var propina = parseFloat($(this).val());
                if (!isNaN(propina)) {
                totalPropinas += propina;
                }
            });

            var totalSuma = totalServicios + totalAdicionales + totalPropinas;
            $('#total-suma').val(totalSuma);
            calcularRestante();
        }

        // Llamar a sumarPreciosAdicionales al cargar la página de edición
        sumarPreciosAdicionales();

        // Agregar evento de cambio en el campo de precio
        $('input[id="precio"]').change(sumarPreciosAdicionales);

        // Agregar evento de cambio en el campo de propina
        $('input[id="propina"]').change(sumarPreciosAdicionales);


        $(document).ready(function () {
            $("#miFormulario").on("submit", function (event) {
                event.preventDefault(); // Evita el envío predeterminado del formulario

                // Deshabilitar el botón de enviar y mostrar el preloader
                $("#miFormulario button[type=submit]").prop("disabled", true);
                $("#preloader").show(); // Asegúrate de tener un elemento con id "preloader" en tu HTML para mostrar el preloader

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
                            // Habilitar el botón de enviar y ocultar el preloader en caso de error
                            $("#miFormulario button[type=submit]").prop("disabled", false);
                            $("#preloader").hide();

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
                                    location.reload();
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
                                    location.reload();
                                });
                            }

                        }
                    } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
            }
        });

    </script>

@endsection


@section('js_custom')
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

    <script type="text/javascript">
        var sig_ini = $('#sig_ini').signature({syncField: '#signed_ini', syncFormat: 'PNG'});

        $('#clear_ini').click(function (e) {
            e.preventDefault();
            sig_ini.signature('clear');
            $("#signed_ini").val('');
        });
    </script>
@endsection
