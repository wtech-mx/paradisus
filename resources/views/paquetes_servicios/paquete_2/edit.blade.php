@extends('layouts.app')

@section('template_title')
   Editar Paquete
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-3">Editar Paquete: Lipoescultura s/cirugía</h3>

                        <a class="btn"  href="{{ route('paquetes_servicios.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>

                <div class="card-body" >

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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma1" name="firma1" type="text" class="form-control" value="{{ $paquete->firma1 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma2" name="firma2" type="text" class="form-control" value="{{ $paquete->firma2 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma3" name="firma3" type="text" class="form-control" value="{{ $paquete->firma3 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma4" name="firma4" type="text" class="form-control" value="{{ $paquete->firma4 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma5" name="firma5" type="text" class="form-control" value="{{ $paquete2->firma5 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma6" name="firma6" type="text" class="form-control" value="{{ $paquete2->firma6 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas7" id="notas7" cols="15" rows="3" class="form-control">{{ $paquete->notas7 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user7" name="id_user7" value="{{ old('id_user7') }}">
                                                                    @if ($paquete->id_user7 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete->User7->id }}">{{ $paquete->User7->name }}</option>
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
                                                            <input  id="fecha7" name="fecha7" type="date" class="form-control" value="{{ $paquete->fecha7 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla7_a" name="talla7_a" type="text" class="form-control" value="{{ $paquete->talla7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla7_d" name="talla7_d" type="text" class="form-control" value="{{ $paquete->talla7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen7_a" name="abdomen7_a" type="text" class="form-control" value="{{ $paquete->abdomen7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen7_d" name="abdomen7_d" type="text" class="form-control" value="{{ $paquete->abdomen7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura7_a" name="cintura7_a" type="text" class="form-control" value="{{ $paquete->cintura7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura7_d" name="cintura7_d" type="text" class="form-control" value="{{ $paquete->cintura7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera7_a" name="cadera7_a" type="text" class="form-control" value="{{ $paquete->cadera7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera7_d" name="cadera7_d" type="text" class="form-control" value="{{ $paquete->cadera7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Personalizada</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo7_a" name="gluteo7_a" type="text" class="form-control" value="{{ $paquete->gluteo7_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo7_d" name="gluteo7_d" type="text" class="form-control" value="{{ $paquete->gluteo7_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma7" name="firma7" type="text" class="form-control" value="{{ $paquete->firma7 }}">
                                                            </div>
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="notas8" id="notas8" cols="15" rows="3" class="form-control">{{ $paquete->notas8 }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " id="id_user8" name="id_user8" value="{{ old('id_user8') }}">
                                                                    @if ($paquete->id_user8 == NULL)
                                                                        <option value="">Seleccionar cosme</option>
                                                                    @else
                                                                        <option value="{{ $paquete->User8->id }}">{{ $paquete->User8->name }}</option>
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
                                                            <input  id="fecha8" name="fecha8" type="date" class="form-control" value="{{ $paquete->fecha8 }}">
                                                        </div>
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla8_a" name="talla8_a" type="text" class="form-control" value="{{ $paquete->talla8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla8_d" name="talla8_d" type="text" class="form-control" value="{{ $paquete->talla8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen8_a" name="abdomen8_a" type="text" class="form-control" value="{{ $paquete->abdomen8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen8_d" name="abdomen8_d" type="text" class="form-control" value="{{ $paquete->abdomen8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura8_a" name="cintura8_a" type="text" class="form-control" value="{{ $paquete->cintura8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura8_d" name="cintura8_d" type="text" class="form-control" value="{{ $paquete->cintura8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera8_a" name="cadera8_a" type="text" class="form-control" value="{{ $paquete->cadera8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera8_d" name="cadera8_d" type="text" class="form-control" value="{{ $paquete->cadera8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Personalizada</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="gluteo8_a" name="gluteo8_a" type="text" class="form-control" value="{{ $paquete->gluteo8_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="gluteo8_d" name="gluteo8_d" type="text" class="form-control" value="{{ $paquete->gluteo8_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Firma</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma8" name="firma8" type="text" class="form-control" value="{{ $paquete->firma8 }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 8--}}

                                        {{-- Card 9--}}
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla9_a" name="talla9_a" type="text" class="form-control" value="{{ $paquete3->talla9_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla9_d" name="talla9_d" type="text" class="form-control" value="{{ $paquete3->talla9_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen9_a" name="abdomen9_a" type="text" class="form-control" value="{{ $paquete3->abdomen9_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen9_d" name="abdomen9_d" type="text" class="form-control" value="{{ $paquete3->abdomen9_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura9_a" name="cintura9_a" type="text" class="form-control" value="{{ $paquete3->cintura9_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura9_d" name="cintura9_d" type="text" class="form-control" value="{{ $paquete3->cintura9_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera9_a" name="cadera9_a" type="text" class="form-control" value="{{ $paquete3->cadera9_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera9_d" name="cadera9_d" type="text" class="form-control" value="{{ $paquete3->cadera9_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma9" name="firma9" type="text" class="form-control" value="{{ $paquete3->firma9 }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 9--}}

                                        {{-- Card 10--}}
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
                                                                    - Vacumterapia Personalizada <br>
                                                                    - Electroestimulación <br>
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
                                                        <strong>Talla</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="talla10_a" name="talla10_a" type="text" class="form-control" value="{{ $paquete3->talla10_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="talla10_d" name="talla10_d" type="text" class="form-control" value="{{ $paquete3->talla10_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Abdomen</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="abdomen10_a" name="abdomen10_a" type="text" class="form-control" value="{{ $paquete3->abdomen10_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="abdomen10_d" name="abdomen10_d" type="text" class="form-control" value="{{ $paquete3->abdomen10_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cintura</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cintura10_a" name="cintura10_a" type="text" class="form-control" value="{{ $paquete3->cintura10_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cintura10_d" name="cintura10_d" type="text" class="form-control" value="{{ $paquete3->cintura10_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Cadera</strong>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="cadera10_a" name="cadera10_a" type="text" class="form-control" value="{{ $paquete3->cadera10_a }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="fecha">Despues</label>
                                                                <input  id="cadera10_d" name="cadera10_d" type="text" class="form-control" value="{{ $paquete3->cadera10_d }}">
                                                            </div>
                                                        </div>
                                                        <strong>Personalizada</strong>
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
                                                            <div class="form-group">
                                                                <label for="fecha">Antes</label>
                                                                <input  id="firma10" name="firma10" type="text" class="form-control" value="{{ $paquete3->firma10 }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        {{--End Card 10--}}

                                    </div>
                                </div>

                            </div>

                            {{-- tab de Pago --}}
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div class="row">
                                            <div class="row text-center">
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Usuario</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Pago</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>


                                                <p style="display: none">{{ $resultado = 0; }}</p>
                                                @foreach ($pago as $item)
                                                    <input  id="pago_id" name="pago_id" type="hidden"  class="form-control" value="{{$item->id}}">
                                                    <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                                    <div class="col-2 py-2" ><input name="fecha_pago" type="date" class="form-control text-center" id="fecha_pago"
                                                            value="{{$item->fecha}}" disabled>
                                                    </div>

                                                    <div class="col-3 py-2" >
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

                                                    @if ($item->foto == NULL)
                                                        <a href=""></a>
                                                    @else
                                                        <div class="col-1 py-2">
                                                            <a target="_blank" href="{{asset('foto_paquetes/'.$item->foto)}}">Abrir Imagen</a>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <h5><strong>Saldo a favor:</strong>  $ {{ $resultado; }} .00  MXN</h5>
                                            <h5><strong>Restante:</strong>  ${{$paquete->restante}} .00  MXN</h5>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="">
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
                                                    <input  id="pago" name="pago" type="text" class="form-control">
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

@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
            $(document).ready(function() {
                $('.cliente').select2();

        });
    </script>

@endsection