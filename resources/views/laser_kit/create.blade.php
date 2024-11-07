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
                        <form id="myForm" method="POST" action="{{ route('bundle.store') }}" enctype="multipart/form-data" role="form">
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

                                    <div class="form-group col-6">
                                        <h4 for="name">Fecha de Finalizacion*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="fecha_fin" name="fecha_fin" type="date" class="form-control" value="{{$fecha}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <h4 for="name">Imagen de portada*</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/picture.png') }}" alt="" width="35px">
                                            </span>
                                            <input id="foto" name="foto" type="file" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Categoria</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/icons/clic.png')}}" alt="" width="30px" >
                                            </span>
                                            <select name="categoria" id="categoria" class="form-select" required>
                                                <option value="">Seleciona una opcion</option>
                                                <option value="NAS">NAS</option>
                                                <option value="Cosmica">Cosmica</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 mt-2">
                                        <h2 style="color:#836262"><strong>Seleciona los productos</strong> </h2>
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
                                                            <h4 for="">Producto</h4>
                                                            <div class="form-group">
                                                                <select name="campo[]" class="form-select d-inline-block producto">
                                                                    <option value="">Seleccione products</option>
                                                                    @foreach ($products as $product)
                                                                        <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}" data-imagen="{{ $product->imagenes }}">{{ $product->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <h4 for="name">Cantidad *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/clic2.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="campo3[]" class="form-control d-inline-block cantidad" >
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-2" style="display: none">
                                                            <h4 for="name">Descuento (%)</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="number" name="descuento_prod[]" class="form-control d-inline-block descuento_prod" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-3">
                                                            <h4 for="name">Subtotal *</h4>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="35px">
                                                                </span>
                                                                <input type="text" name="campo4[]" class="form-control d-inline-block subtotal" readonly>
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
                                        <h4 for="name">Subtotal *</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control total" type="text" id="total" name="total" value="0" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Descuento</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="number" id="descuento" name="descuento" value="0">
                                        </div>
                                    </div>

                                    <div class="form-group col-4">
                                        <h4 for="name">Total</h4>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                            </span>
                                            <input class="form-control" type="text" id="totalDescuento" name="totalDescuento" >
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <h4 for="name">Comentario de promocion /kit</h4>
                                            <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="3"></textarea>
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

@endsection
