@extends('layouts.app')

@section('template_title')
   Editar Paquete
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-3">Editar Paquete: Tu figura Ideal c/Aparatología</h3>

                        <a class="btn"  href="{{ route('paquetes_servicios.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>

                <div class="card-body" >
                    <a type="button" class="btn btn-sm" target="_blank"
                    href="https://wa.me/52{{$paquete->Client->phone}}?text=Hola%20{{$paquete->Client->name}}%20{{$paquete->Client->last_name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $paquete->fecha1 }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0{{ route('firma_paquete_uno.firma_edit_uno', $paquete->id) }}}"
                    style="background: #00BB2D; color: #ffff">
                    <i class="fa fa-whatsapp"></i> </a> Enviar Link para firmar

                    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                <i class="ni ni-folder-17 text-sm me-2"></i> Paquete
                            </a>

                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" id="pills-profile-tab">
                                <i class="ni ni-credit-card text-sm me-2"></i> Pago
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-condiciones" role="tab" aria-controls="pills-condiciones" aria-selected="true" id="pills-condiciones-tab">
                                <i class="ni ni-credit-card text-sm me-2"></i> Condiciones
                            </a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('paquetes_servicios.update', $paquete->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="tab-content" id="pills-tabContent">
                            {{-- tab de paquete --}}
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="precio">Cliente</label><br>
                                            <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}">
                                                <option value="{{ $paquete->Client->id }}">{{ $paquete->Client->name }} {{ $paquete->Client->last_name }}</option>
                                                @foreach ($client as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input  id="num_paquete" name="num_paquete" type="text" value="1" style="display: none">
                                    <input  id="id_servicio" name="id_servicio" type="text" value="151" style="display: none">

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="precio">Fecha</label><br>
                                            <input  id="fecha_inicial" name="fecha_inicial" type="date" class="form-control" value="{{ $paquete->fecha_inicial }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">

                                        {{-- Card 1--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
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
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas1" id="notas1" cols="15" rows="3" class="form-control">{{ $paquete->notas1 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user1" name="id_user1" value="{{ old('id_user1') }}" required>
                                                                    <option value="{{ $paquete->User1->id }}">{{ $paquete->User1->name }}</option>
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha1" name="fecha1" type="date" class="form-control" value="{{ $paquete->fecha1 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla1_a" name="talla1_a" type="text" class="form-control" value="{{ $paquete->talla1_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla1_d" name="talla1_d" type="text" class="form-control" value="{{ $paquete->talla1_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen1_a" name="abdomen1_a" type="text" class="form-control" value="{{ $paquete->abdomen1_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen1_d" name="abdomen1_d" type="text" class="form-control" value="{{ $paquete->abdomen1_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura1_a" name="cintura1_a" type="text" class="form-control" value="{{ $paquete->cintura1_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura1_d" name="cintura1_d" type="text" class="form-control" value="{{ $paquete->cintura1_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera1_a" name="cadera1_a" type="text" class="form-control" value="{{ $paquete->cadera1_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera1_d" name="cadera1_d" type="text" class="form-control" value="{{ $paquete->cadera1_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo1_a" name="gluteo1_a" type="text" class="form-control" value="{{ $paquete->gluteo1_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo1_d" name="gluteo1_d" type="text" class="form-control" value="{{ $paquete->gluteo1_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete->firma1)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 1--}}

                                        {{-- Card 2--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 02
                                                                    </a>
                                                                <p class="card-description mb-4" style="font-size:12px;">
                                                                    - Cavitación Corporal <br>
                                                                    - Radiofrecuencia Corporal <br>
                                                                    - Pompilevanta c/ Vacumterapia <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas2" id="notas2" cols="15" rows="3" class="form-control">{{ $paquete->notas2 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user2" name="id_user2" value="{{ old('id_user2') }}">

                                                                    @if ($paquete->id_user2 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete->User2->id }}">{{ $paquete->User2->name }}</option>
                                                                    @endif
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha2" name="fecha2" type="date" class="form-control" value="{{ $paquete->fecha2 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla2_a" name="talla2_a" type="text" class="form-control" value="{{ $paquete->talla2_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla2_d" name="talla2_d" type="text" class="form-control" value="{{ $paquete->talla2_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen2_a" name="abdomen2_a" type="text" class="form-control" value="{{ $paquete->abdomen2_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen2_d" name="abdomen2_d" type="text" class="form-control" value="{{ $paquete->abdomen2_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura2_a" name="cintura2_a" type="text" class="form-control" value="{{ $paquete->cintura2_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura2_d" name="cintura2_d" type="text" class="form-control" value="{{ $paquete->cintura2_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera2_a" name="cadera2_a" type="text" class="form-control" value="{{ $paquete->cadera2_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera2_d" name="cadera2_d" type="text" class="form-control" value="{{ $paquete->cadera2_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo2_a" name="gluteo2_a" type="text" class="form-control" value="{{ $paquete->gluteo2_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo2_d" name="gluteo2_d" type="text" class="form-control" value="{{ $paquete->gluteo2_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete->firma2)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 2--}}

                                        {{-- Card 3--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 03
                                                                    </a>
                                                                <p class="card-description mb-4" style="font-size:12px;">
                                                                    - Cavitación Corporal <br>
                                                                    - Radiofrecuencia Corporal <br>
                                                                    - Pompilevanta c/ Vacumterapia <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas3" id="notas3" cols="15" rows="3" class="form-control">{{ $paquete->notas3 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user3" name="id_user3" value="{{ old('id_user3') }}">
                                                                    @if ($paquete->id_user3 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete->User3->id }}">{{ $paquete->User3->name }}</option>
                                                                    @endif
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha3" name="fecha3" type="date" class="form-control" value="{{ $paquete->fecha3 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla3_a" name="talla3_a" type="text" class="form-control" value="{{ $paquete->talla3_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla3_d" name="talla3_d" type="text" class="form-control" value="{{ $paquete->talla3_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen3_a" name="abdomen3_a" type="text" class="form-control" value="{{ $paquete->abdomen3_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen3_d" name="abdomen3_d" type="text" class="form-control" value="{{ $paquete->abdomen3_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura3_a" name="cintura3_a" type="text" class="form-control" value="{{ $paquete->cintura3_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura3_d" name="cintura3_d" type="text" class="form-control" value="{{ $paquete->cintura3_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera3_a" name="cadera3_a" type="text" class="form-control" value="{{ $paquete->cadera3_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera3_d" name="cadera3_d" type="text" class="form-control" value="{{ $paquete->cadera3_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo3_a" name="gluteo3_a" type="text" class="form-control" value="{{ $paquete->gluteo3_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo3_d" name="gluteo3_d" type="text" class="form-control" value="{{ $paquete->gluteo3_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete->firma3)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 3--}}

                                        {{-- Card 4--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 04
                                                                    </a>
                                                                <p class="card-description mb-4" style="font-size:12px;">
                                                                    - Cavitación Corporal <br>
                                                                    - Radiofrecuencia Corporal <br>
                                                                    - Pompilevanta c/ Vacumterapia <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas4" id="notas4" cols="15" rows="3" class="form-control">{{ $paquete->notas4 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user4" name="id_user4" value="{{ old('id_user4') }}">
                                                                    @if ($paquete->id_user4 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete->User4->id }}">{{ $paquete->User4->name }}</option>
                                                                    @endif
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha4" name="fecha4" type="date" class="form-control" value="{{ $paquete->fecha4 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla4_a" name="talla4_a" type="text" class="form-control" value="{{ $paquete->talla4_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla4_d" name="talla4_d" type="text" class="form-control" value="{{ $paquete->talla4_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen4_a" name="abdomen4_a" type="text" class="form-control" value="{{ $paquete->abdomen4_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen4_d" name="abdomen4_d" type="text" class="form-control" value="{{ $paquete->abdomen4_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura4_a" name="cintura4_a" type="text" class="form-control" value="{{ $paquete->cintura4_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura4_d" name="cintura4_d" type="text" class="form-control" value="{{ $paquete->cintura4_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera4_a" name="cadera4_a" type="text" class="form-control" value="{{ $paquete->cadera4_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera4_d" name="cadera4_d" type="text" class="form-control" value="{{ $paquete->cadera4_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo4_a" name="gluteo4_a" type="text" class="form-control" value="{{ $paquete->gluteo4_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo4_d" name="gluteo4_d" type="text" class="form-control" value="{{ $paquete->gluteo4_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete->firma4)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 4--}}

                                        {{-- Card 5--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 05
                                                                    </a>
                                                                <p class="card-description mb-4" style="font-size:12px;">
                                                                    - Cavitación Corporal <br>
                                                                    - Radiofrecuencia Corporal <br>
                                                                    - Pompilevanta c/ Vacumterapia <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas5" id="notas5" cols="15" rows="3" class="form-control">{{ $paquete2->notas5 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user5" name="id_user5" value="{{ old('id_user5') }}">
                                                                    @if ($paquete2->id_user5 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete2->User5->id }}">{{ $paquete2->User5->name }}</option>
                                                                    @endif
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha5" name="fecha5" type="date" class="form-control" value="{{ $paquete2->fecha5 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla5_a" name="talla5_a" type="text" class="form-control" value="{{ $paquete2->talla5_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla5_d" name="talla5_d" type="text" class="form-control" value="{{ $paquete2->talla5_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen5_a" name="abdomen5_a" type="text" class="form-control" value="{{ $paquete2->abdomen5_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen5_d" name="abdomen5_d" type="text" class="form-control" value="{{ $paquete2->abdomen5_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura5_a" name="cintura5_a" type="text" class="form-control" value="{{ $paquete2->cintura5_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura5_d" name="cintura5_d" type="text" class="form-control" value="{{ $paquete2->cintura5_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera5_a" name="cadera5_a" type="text" class="form-control" value="{{ $paquete2->cadera5_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera5_d" name="cadera5_d" type="text" class="form-control" value="{{ $paquete2->cadera5_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo5_a" name="gluteo5_a" type="text" class="form-control" value="{{ $paquete2->gluteo5_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo5_d" name="gluteo5_d" type="text" class="form-control" value="{{ $paquete2->gluteo5_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete2->firma5)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 5--}}

                                        {{-- Card 6--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 06
                                                                    </a>
                                                                <p class="card-description mb-4" style="font-size:12px;">
                                                                    - Cavitación Corporal <br>
                                                                    - Radiofrecuencia Corporal <br>
                                                                    - Pompilevanta c/ Vacumterapia <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas6" id="notas6" cols="15" rows="3" class="form-control">{{ $paquete2->notas6 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user6" name="id_user6" value="{{ old('id_user6') }}">
                                                                    @if ($paquete2->id_user6 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete2->User6->id }}">{{ $paquete2->User6->name }}</option>
                                                                    @endif
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                        </div>
                                                        <div class="col-8">
                                                            <input  id="fecha6" name="fecha6" type="date" class="form-control" value="{{ $paquete2->fecha6 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla6_a" name="talla6_a" type="text" class="form-control" value="{{ $paquete2->talla6_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla6_d" name="talla6_d" type="text" class="form-control" value="{{ $paquete2->talla6_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen6_a" name="abdomen6_a" type="text" class="form-control" value="{{ $paquete2->abdomen6_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen6_d" name="abdomen6_d" type="text" class="form-control" value="{{ $paquete2->abdomen6_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura6_a" name="cintura6_a" type="text" class="form-control" value="{{ $paquete2->cintura6_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura6_d" name="cintura6_d" type="text" class="form-control" value="{{ $paquete2->cintura6_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera6_a" name="cadera6_a" type="text" class="form-control" value="{{ $paquete2->cadera6_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera6_d" name="cadera6_d" type="text" class="form-control" value="{{ $paquete2->cadera6_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Gluteos</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo6_a" name="gluteo6_a" type="text" class="form-control" value="{{ $paquete2->gluteo6_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo6_d" name="gluteo6_d" type="text" class="form-control" value="{{ $paquete2->gluteo6_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete2->firma6)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 6--}}

                                    </div>
                                </div>

                            </div>

                            {{-- tab de Pago --}}
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="row text-center">
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Usuario</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Pago</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Firma</div>


                                                <p style="display: none">{{ $resultado = 0; }}</p>
                                                @foreach ($pago as $item)
                                                    <input  id="pago_id" name="pago_id" type="hidden"  class="form-control" value="{{$item->id}}">
                                                    <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                                    <div class="col-2 py-2" ><input name="fecha_pago" type="date" class="form-control text-center" id="fecha_pago"
                                                            value="{{$item->fecha}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2" >
                                                        <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa" disabled>
                                                            <option value="{{$item->cosmetologa}}">{{ $item->User->name }}</option>
                                                            @foreach ($user as $cosmes)
                                                                <option value="{{ $cosmes->id }}" >{{ $cosmes->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-2 py-2" >
                                                        <input name="pago" type="number" class="form-control text-center" id="pago"
                                                            value="{{$item->pago}}" disabled></div>

                                                    <div class="col-2 py-2" ><input name="forma_pago" type="text" class="form-control text-center" id="forma_pago"
                                                        value="{{$item->forma_pago}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2" ><textarea class="form-control text-center" name="nota" id="nota" cols="3" rows="1" disabled>{{$item->nota}}</textarea>

                                                    </div>

                                                    <div class="col-1 py-2">
                                                        @if ($item->foto == NULL)
                                                            <a href=""></a>
                                                        @else
                                                            <a target="_blank" href="{{asset('foto_paquetes/'.$item->foto)}}">Ver</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-1 py-2">
                                                        @if ($item->firma == NULL)
                                                            <a href=""></a>
                                                        @else
                                                            <a target="_blank" href="{{asset('firma_pago/'.$item->firma)}}">Ver</a>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="total-suma">Total a Pagar</label>
                                                    <input type="text" id="total-suma" name="total-suma" class="form-control" readonly value="{{$paquete->monto}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Saldo a favor</label>
                                                    <input type="text" class="form-control" readonly value="$ {{ $resultado; }} MXN">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Restante</label>
                                                    <input type="text" id="restante" name="restante_paquetes" class="form-control" readonly value="{{$paquete->restante}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Cambio</label>
                                                    <input type="text" id="cambio" name="cambio" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Cosme</label>
                                                    <select class="form-control"  data-toggle="select" id="id_user" name="id_user">
                                                        <option value="{{ $paquete2->talla1_a }}">Seleccionar</option>
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="pago">Pago</label>
                                                    <input  id="nuevo-pago" name="pago" type="text" class="form-control">
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
                                                        <option value="Gift Card">Gift Card</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <label for="nota">Nota</label>
                                                    <textarea class="form-control" id="nota_pago" name="nota_pago" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nota">Foto</label>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div id="sig_pago"></div>
                                                <br/><br/>
                                                <button id="clear_pago" class="btn btn-danger btn-sm">Repetir</button>
                                                <textarea id="signed_pago" name="signed_pago" style="display: none"></textarea>
                                            </div>
                                            <hr>
                                        </div>
                            </div>

                            {{-- tab de Condiciones --}}
                            <div class="tab-pane fade" id="pills-condiciones" role="tabpanel" aria-labelledby="pills-condiciones-tab">

                                <h5>Politicas & Condiciones</h5>

                                <div class="row">
                                    <div class="col-12">
                                        <ul class="list-group mt-5 mb-5" style="margin-left: 3rem">
                                            <li>Las sesiones únicamente deberán ser agendadas de <b>Lunes a Viernes.</b> </li>
                                            <li>Al realizar tu pago se agendarán, el número de sesiones y fechas del paquete seleccionado. </li>
                                            <li>NO HAY REEEMBOLSOS DE ANTICIPOS. </li>
                                            <li>Solo tienes oportunidad de <b>re-agendar UNA sesión</b> con un mínimo de <b>3 días de anticipo.</b> </li>
                                            <li>En caso de fallar más de una de las sesiones, ya <b>NO se reagendará</b> y tendrás que volverla a pagar, independiente del costo de tu paquete.</li>
                                        </ul>
                                    </div>

                                    <div class="col-12">
                                        <strong>He leído todas las cláusulas y estoy de acuerdo.</strong><br/>
                                        @if ($paquete->firma == NULL)
                                                    <div id="sig_ini"></div>
                                                    <br/><br/>
                                                    <button id="clear_ini" class="btn btn-danger btn-sm">Repetir</button>
                                                    <textarea id="signed_ini" name="signed_ini" style="display: none"></textarea>
                                        @else
                                            <img src="{{asset('condiciones_paquetes/'.$paquete->firma)}}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff;margin-right: 3rem">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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

    var sig_pago = $('#sig_pago').signature({syncField: '#signed_pago', syncFormat: 'PNG'});

    $('#clear_pago').click(function (e) {
        e.preventDefault();
        sig_pago.signature('clear');
        $("#signed_pago").val('');
    });
</script>
@endsection
@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $('.cliente').select2();

        });

        // Obtén la referencia al elemento de pago y al campo de cambio
        var inputPago = $('#nuevo-pago');
        var inputCambio = $('#cambio');
        var restanteInicial; // Variable global para almacenar el valor inicial de restante

        // Llamar a calcularRestante al cargar la página de edición
        $(document).ready(function() {
            restanteInicial = parseInt($('#restante').val()) || 0; // Obten el valor inicial de #restante
            calcularRestante();
        });

        function calcularRestante() {
            var pagosExistentes = 0;
            $('.pago-existente').each(function() {
                pagosExistentes += parseInt($(this).val()) || 0;
            });

            var nuevoPago = parseInt(inputPago.val()) || 0;
            var restante = restanteInicial - pagosExistentes; // Utiliza el valor inicial de restante
            console.log('restante', restante);
            $('#restante').val(restante);

            // Calcula el cambio correctamente
            var cambio = 0;
            if (nuevoPago >= restante) {
                cambio = nuevoPago - restante;
                restante = 0;
            } else {
                restante -= nuevoPago; // Reduce el restante por el valor del nuevo pago
            }

            console.log('cambio', cambio);
            $('#restante').val(restante);
            inputCambio.val(cambio); // Actualiza el campo de cambio
        }


        // Agregar evento de cambio en el campo de nuevo pago
        inputPago.on('input', function() {
            calcularRestante();
        });



    </script>



@endsection
