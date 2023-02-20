@extends('layouts.app')

@section('template_title')
   Crear Paquete Tu figura Ideal c/Aparatología
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-3">Crear Paquete</h3>

                        <a class="btn"  href="{{ route('paquetes_pedidos.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>

                <div class="card-body" >

                    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                <i class="ni ni-folder-17 text-sm me-2"></i> Paqute
                            </a>

                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" id="pills-profile-tab">
                                <i class="ni ni-credit-card text-sm me-2"></i> Pago
                            </a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('notas.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="tab-content" id="pills-tabContent">
                            {{-- tab de paquete --}}
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

                                <div class="form-group">
                                    <label for="descuento">Nota</label>
                                    <textarea name="nota" id="nota" cols="10" rows="3" class="form-control"></textarea>
                                </div>


                                <div class="col-12">
                                    <div class="row">

                                        {{-- Cards --}}
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body pt-2">
                                                          <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                            Sesión de 2 HRS
                                                          </span>
                                                            <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                SESIÓN 01
                                                            </a>
                                                          <p class="card-description mb-4" style="font-size:12px;">
                                                            - Cavitación Corporal <br>
                                                            - Radiofrecuencia Corporal <br>
                                                            - Pompilevanta c/ Vacumterapia <br>
                                                            - Mesoterapia Corporal <br>
                                                          </p>

                                                          <div class="author align-items-center">
                                                            <div class="name ps-3">
                                                              <span>Nota</span>
                                                              <div class="stats">
                                                                <textarea name="nota_paquete" id="nota_paquete" cols="12" rows="3" class="form-control"></textarea>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body pt-2">
                                                           <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> FECHA:</span> <br>

                                                            <strong>Talla</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Abdomen</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Cintura</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Cintura</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body pt-2">
                                                          <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                            Sesión de 2 HRS
                                                          </span>
                                                            <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                SESIÓN 01
                                                            </a>
                                                          <p class="card-description mb-4" style="font-size:12px;">
                                                            - Cavitación Corporal <br>
                                                            - Radiofrecuencia Corporal <br>
                                                            - Pompilevanta c/ Vacumterapia <br>
                                                            - Mesoterapia Corporal <br>
                                                          </p>

                                                          <div class="author align-items-center">
                                                            <div class="name ps-3">
                                                              <span>Nota</span>
                                                              <div class="stats">
                                                                <textarea name="nota_paquete" id="nota_paquete" cols="12" rows="3" class="form-control"></textarea>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="card">
                                                        <div class="card-body pt-2">
                                                           <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> FECHA:</span> <br>

                                                            <strong>Talla</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Abdomen</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Cintura</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                            <strong>Cintura</strong>
                                                            <div class="d-flex justify-content-evenly">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="" name="" type="number" class="form-control" value="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            {{-- tab de Pago --}}
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
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn " data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 1.5rem">Cancelar</button>
                    <button type="submit" class="btn  close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff;margin-right: 3rem">Guardar</button>
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

        });
    </script>

@endsection
