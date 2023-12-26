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
                        <h3 class="mb-3">Editar Paquete: Piernas de 10 Anticelulítico & Reafirmante</h3>

                        <a class="btn"  href="{{ route('paquetes_servicios.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>

                <div class="card-body" >
                    <a type="button" class="btn btn-sm" target="_blank"
                    href="https://wa.me/52{{$paquete->Client->phone}}?text=Hola%20{{$paquete->Client->name}}%20{{$paquete->Client->last_name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADia:%20{{ $paquete->fecha1 }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0{{ route('firma_paquete_cinco.firma_edit_cinco', $paquete->id) }}}"
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
                                    <input  id="num_paquete" name="num_paquete" type="text" value="6" style="display: none">
                                    <input  id="id_servicio" name="id_servicio" type="text" value="276" style="display: none">

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
                                                                <select class="form-control " id="id_user1" name="id_user1" value="{{ old('id_user1') }}">
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

                                        {{-- Card 7--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 07
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
                                                                    <textarea name="notas7" id="notas7" cols="15" rows="3" class="form-control">{{ $paquete2->notas7 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user7" name="id_user7" value="{{ old('id_user7') }}">
                                                                    @if ($paquete2->id_user7 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete2->User7->id }}">{{ $paquete2->User7->name }}</option>
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
                                                            <input  id="fecha7" name="fecha7" type="date" class="form-control" value="{{ $paquete2->fecha7 }}">
                                                        </div>
                                                        <strong>Piernas</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo7_a" name="gluteo7_a" type="text" class="form-control" value="{{ $paquete2->gluteo7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo7_d" name="gluteo7_d" type="text" class="form-control" value="{{ $paquete2->gluteo7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete2->firma7)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 7--}}

                                        {{-- Card 8--}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 08
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
                                                                    <textarea name="notas8" id="notas8" cols="15" rows="3" class="form-control">{{ $paquete2->notas8 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user8" name="id_user8" value="{{ old('id_user8') }}">
                                                                    @if ($paquete2->id_user8 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete2->User8->id }}">{{ $paquete2->User8->name }}</option>
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
                                                            <input  id="fecha8" name="fecha8" type="date" class="form-control" value="{{ $paquete2->fecha8 }}">
                                                        </div>
                                                        <strong>Piernas</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo8_a" name="gluteo8_a" type="text" class="form-control" value="{{ $paquete2->gluteo8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo8_d" name="gluteo8_d" type="text" class="form-control" value="{{ $paquete2->gluteo8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete2->firma8)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 8--}}

                                        {{-- Card 9 --}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 09
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
                                                                    <textarea name="notas9" id="notas9" cols="15" rows="3" class="form-control">{{ $paquete3->notas9 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user9" name="id_user9" value="{{ old('id_user9') }}">
                                                                    @if ($paquete3->id_user9 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete3->User9->id }}">{{ $paquete3->User9->name }}</option>
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
                                                            <input  id="fecha9" name="fecha9" type="date" class="form-control" value="{{ $paquete3->fecha9 }}">
                                                        </div>
                                                        <strong>Piernas</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo9_a" name="gluteo9_a" type="text" class="form-control" value="{{ $paquete3->gluteo9_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo9_d" name="gluteo9_d" type="text" class="form-control" value="{{ $paquete3->gluteo9_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete3->firma9)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 9 --}}

                                        {{-- Card 10 --}}
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                                                    Sesión de 2 HRS
                                                                </span>
                                                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                        SESIÓN 10
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
                                                                    <textarea name="notas10" id="notas10" cols="15" rows="3" class="form-control">{{ $paquete3->notas10 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user10" name="id_user10" value="{{ old('id_user10') }}">
                                                                    @if ($paquete3->id_user10 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete3->User10->id }}">{{ $paquete3->User10->name }}</option>
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
                                                            <input  id="fecha10" name="fecha10" type="date" class="form-control" value="{{ $paquete3->fecha10 }}">
                                                        </div>
                                                        <strong>Piernas</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo10_a" name="gluteo10_a" type="text" class="form-control" value="{{ $paquete3->gluteo10_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo10_d" name="gluteo10_d" type="text" class="form-control" value="{{ $paquete3->gluteo10_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <img src="{{asset('signatures/'.$paquete3->firma10)}}" alt="">
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 10 --}}

                                    </div>
                                </div>

                            </div>

                            {{-- tab de Pago --}}
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            @include('paquetes_servicios.seccion_pago_edit')

                                            <div class="col-6">
                                                <div id="sig-pago5"></div>
                                                <br/><br/>
                                                <button id="clear-pago5" class="btn btn-danger btn-sm">Repetir</button>
                                                <textarea id="signed_pago5" name="signed_pago5" style="display: none"></textarea>
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
                                            <div id="sig-ini5"></div>
                                            <br/><br/>
                                            <button id="clear-ini5" class="btn btn-danger btn-sm">Repetir</button>
                                            <textarea id="signed_ini5" name="signed_ini5" style="display: none"></textarea>
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
    var sig_ini5 = $('#sig-ini5').signature({syncField: '#signed_ini5', syncFormat: 'PNG'});

    $('#clear-ini5').click(function (e) {
        e.preventDefault();
        sig_ini5.signature('clear');
        $("#signed_ini5").val('');
    });

    var sig2 = $('#sig-pago5').signature({syncField: '#signed_pago5', syncFormat: 'PNG'});

    $('#clear-pago5').click(function (e) {
        e.preventDefault();
        sig2.signature('clear');
        $("#signed_pago5").val('');
    });
</script>
@endsection
@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

  @include('paquetes_servicios.script_edit')

@endsection
