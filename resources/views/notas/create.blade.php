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

                            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
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

                        <form method="POST" action="{{ route('notas.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="form-group">
                                            <label for="nombre">Seleccione Cosmetologa</label>
                                            <select class="form-control " id="id_user[]" name="id_user[]" multiple value="{{ old('submarca') }}" required>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-2">
                                                <label for="precio">Nuevo cliente</label><br>
                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    Agregar
                                                </button>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="precio">Cliente</label><br>
                                                    <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client" value="{{ old('submarca') }}">
                                                        <option>Seleccionar cliente</option>
                                                        @foreach ($client as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <h6 for="precio">Ficha Clínica</h6><br>
                                            <div class="col-2">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" value="1">
                                                    <label class="custom-control-label" for="customRadio1">figura Ideal c/Aparatología</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2" value="2">
                                                <label class="custom-control-label" for="customRadio2">Lipoescultura s/Cirugía</label>
                                              </div>
                                            </div>
                                            <div class="col-2">
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3" value="3">
                                                <label class="custom-control-label" for="customRadio3">Moldeante & Reductivo</label>
                                              </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-check mb-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio4" value="4">
                                                    <label class="custom-control-label" for="customRadio4">Drenante & Linfático</label>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio5" value="5">
                                                <label class="custom-control-label" for="customRadio5">Glúteos Definido & Perfectos</label>
                                              </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre *</label>
                                                            <input  id="name" name="name" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="nombre">Apellido</label>
                                                            <input  id="last_name" name="last_name" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="nombre">Telefono *</label>
                                                            <input  id="phone" name="phone" type="number" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nombre">Correo</label>
                                                            <input  id="email" name="email" type="email" class="form-control">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-1">
                                                <label for="precio">Mas</label><br>
                                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseServicio" aria-expanded="false" aria-controls="collapseExample">
                                                    +
                                                </button>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="precio">Servicio</label><br>
                                                    <select class="form-control servicio" data-toggle="select" id="id_servicio" name="id_servicio" required>
                                                        <option value="">Seleccionar servicio</option>
                                                        @foreach ($servicio as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="precio">Num</label>
                                                        <input type="number" id="num" name="num" class="form-control" value="1">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-check">
                                                    <label class="custom-control-label" for="descuento" style="font-size: 15px;">10%</label><br>
                                                    <input class="form-check-input" type="checkbox" name="descuento" id="descuento" value="1">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-check">
                                                    <label class="custom-control-label" for="descuento" style="font-size: 15px;">5%</label><br>
                                                    <input class="form-check-input" type="checkbox" name="descuento_5" id="descuento_5" value="1">
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-check">
                                                    <label class="custom-control-label" for="descuento" style="font-size: 15px;">50%</label><br>
                                                    <input class="form-check-input" type="checkbox" name="descuento_50" id="descuento_50" value="1">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- A G R E G A R  M A S  S E R V I C I O S --}}
                                        <div class="collapse" id="collapseServicio">
                                            <div class="card card-body">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 2</label><br>
                                                            <select class="form-control servicio2" data-toggle="select" id="servicio2" name="id_servicio2">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 2</label>
                                                                <input type="number" id="num2" name="num2" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento2" style="font-size: 15px;">10%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento2" id="descuento2" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento2" style="font-size: 15px;">5%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento2_5" id="descuento2_5" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento2" style="font-size: 15px;">50%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento2_50" id="descuento2_50" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 3</label><br>
                                                            <select class="form-control servicio3" data-toggle="select" id="servicio3" name="id_servicio3">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 3</label>
                                                                <input type="number" id="num3" name="num3" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento3" style="font-size: 15px;">10%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento3" id="descuento3" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento3" style="font-size: 15px;">5%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento3_5" id="descuento3_5" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento3" style="font-size: 15px;">50%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento3_50" id="descuento3_50" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 4</label><br>
                                                            <select class="form-control servicio4" id="servicio4" name="id_servicio4">
                                                                <option value="">Seleccionar servicio</option>
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 4</label>
                                                                <input type="number" id="num4" name="num4" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento4" style="font-size: 15px;">10%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento4" id="descuento4" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento4" style="font-size: 15px;">5%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento4_5" id="descuento4_5" value="1">
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        <div class="form-check">
                                                            <label class="custom-control-label" for="descuento4" style="font-size: 15px;">50%</label><br>
                                                            <input class="form-check-input" type="checkbox" name="descuento4_50" id="descuento4_50" value="1">
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

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="fecha">Fecha</label>
                                                            <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="fecha">Cosme</label>
                                                            <select class="form-control"  data-toggle="select" id="cosmetologa" name="cosmetologa">
                                                                <option value="">Seleccionar</option>
                                                                @foreach ($user as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="pago">Pago</label>
                                                            <input  id="pago" name="pago" type="text" class="form-control" required>
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
                                                                <option value="Nota">Nota</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="nota">Nota</label>
                                                            <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nota">Foto</label>
                                                            <input type="file" id="foto" class="form-control" name="foto">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                </div>
                                    </div>

                                    <div class="tab-pane fade" id="pills-sesion" role="tabpanel" aria-labelledby="pills-sesion-tab">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$fechaActual}}">
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="num_sesion">Num sesion</label>
                                                    <input  id="sesion" name="sesion" type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-5">
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

                                    <div class="tab-pane fade" id="pills-propina" role="tabpanel" aria-labelledby="pills-propina-tab">
                                        <div id="formulario_3" class="mt-4">
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

    <script type="text/javascript">

            $(document).ready(function() {
                $('.cliente').select2();
                $('.servicio').select2();
                $('.servicio2').select2();
                $('.servicio3').select2();
                $('.servicio4').select2();

                // $(".cliente").select2({
                //     dropdownParent: $("#createDataModal")
                // });

                // $(".servicio").select2({
                //     dropdownParent: $("#createDataModal")
                // });

                // $(".servicio2").select2({
                //     dropdownParent: $("#createDataModal")
                // });

                // $(".servicio3").select2({
                //     dropdownParent: $("#createDataModal")
                // });

                // $(".servicio4").select2({
                //     dropdownParent: $("#createDataModal")
                // });
        });

    </script>

@endsection
