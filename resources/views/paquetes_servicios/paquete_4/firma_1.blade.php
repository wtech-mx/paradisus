@extends('clientes.layout.app')


@section('template_title')
    Usuarios
@endsection

@section('client_app')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{ width: 100% !important; height: auto;}
</style>

<main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7">
            <div class="card border-0 mb-0">

              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@ :
                    <br>
                    {{$paquete->Client->name }} {{ $paquete->Client->last_name }}
                </h5>
              </div>

              <div class="card-body px-lg-3 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Paquete:</label>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="ni ni-collection"></i></span>
                                <input class="form-control" type="text" value="Drenante & Linfático" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Fecha Inicial</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            <input class="form-control" type="text" value="{{ $paquete->fecha_inicial }}" disabled>
                            </div>
                        </div>
                    </div>

                </div>

                    <hr style="background-color: #D9819C; height: 2px;">
                        <div class="row">

                            <div class="row">
                                <div class="col-12">

                                    <nav>
                                        <h6 class="text-center">
                                            Sesiones
                                        </h6>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                          <button class="nav-link active" id="nav-uno-tab" data-bs-toggle="tab" data-bs-target="#nav-uno" type="button" role="tab" aria-controls="nav-uno" aria-selected="true"> 1</button>
                                          <button class="nav-link" id="nav-dos-tab" data-bs-toggle="tab" data-bs-target="#nav-dos" type="button" role="tab" aria-controls="nav-dos" aria-selected="false">2</button>
                                          <button class="nav-link" id="nav-tres-tab" data-bs-toggle="tab" data-bs-target="#nav-tres" type="button" role="tab" aria-controls="nav-tres" aria-selected="false">3</button>
                                          <button class="nav-link " id="nav-cuatro-tab" data-bs-toggle="tab" data-bs-target="#nav-cuatro" type="button" role="tab" aria-controls="nav-cuatro" aria-selected="true">4</button>
                                          <button class="nav-link" id="nav-cinco-tab" data-bs-toggle="tab" data-bs-target="#nav-cinco" type="button" role="tab" aria-controls="nav-cinco" aria-selected="false">5</button>

                                        </div>
                                    </nav>
                                      <div class="tab-content" id="nav-tabContent">

                                        <div class="tab-pane fade show active" id="nav-uno" role="tabpanel" aria-labelledby="nav-uno-tab">
                                            <div class="row mt-3">
                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 01</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete->fecha1 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete->talla1_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->talla1_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Abdomen</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->abdomen1_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->abdomen1_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Cintura</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cintura1_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cintura1_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                <div class="col-12">
                                                    <strong>Cadera</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cadera1_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cadera1_d }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <strong>Perzonalizado</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->gluteo1_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->gluteo1_d }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete->firma1 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                                <div id="sig"></div>
                                                                <br/><br/>
                                                                <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                                                <textarea id="signed" name="signed" style="display: none"></textarea>
                                                                <br/>
                                                                <button class="btn btn-primary">Save</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete->firma1)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-dos" role="tabpanel" aria-labelledby="nav-dos-tab">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 02</strong>
                                                </div>

                                                <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete->fecha2 }}
                                                </div>

                                                <div class="col-12">
                                                     <strong>Talla</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete->talla2_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->talla2_d }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                <div class="col-12">
                                                     <strong>Abdomen</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->abdomen2_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->abdomen2_d }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <strong>Cintura</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cintura2_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cintura2_d }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <strong>Cadera</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cadera2_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->cadera2_d }}" disabled>
                                                        </div>
                                                     </div>
                                                </div>

                                                <div class="col-12">
                                                    <strong>Perzonalizado</strong>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete->gluteo2_a }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo2_d }}" disabled>
                                                     </div>
                                                     </div>
                                                </div>


                                                <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete->firma2 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                                <div id="sig2"></div>
                                                                <br/><br/>
                                                                <button id="clear2" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed2" name="signed2" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete->firma2)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-tres" role="tabpanel" aria-labelledby="nav-tres-tab">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 03</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete->fecha3 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">


                                                     <input class="form-control"  type="text" value="{{ $paquete->talla3_a }}" disabled>
                                                     </div>
                                                 </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->talla3_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Abdomen</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->abdomen3_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->abdomen3_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Cintura</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cintura3_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cintura3_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>


                                                 <div class="col-12">
                                                     <strong>Cadera</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cadera3_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cadera3_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizado</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo3_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo3_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>


                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete->firma3 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig3"></div>
                                                                        <br/><br/>
                                                                <button id="clear3" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed3" name="signed3" style="display: none"></textarea>

                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete->firma3)}}" alt="">
                                                    @endif
                                                 </div>


                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-cuatro" role="tabpanel" aria-labelledby="nav-cuatro-tab">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 04</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete->fecha4 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">


                                                     <input class="form-control"  type="text" value="{{ $paquete->talla4_a }}" disabled>
                                                     </div>
                                                 </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->talla4_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Abdomen</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->abdomen4_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->abdomen4_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Cintura</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cintura4_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cintura4_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>


                                                 <div class="col-12">
                                                     <strong>Cadera</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cadera4_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->cadera4_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizado</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo4_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo4_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>


                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete->firma4 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig4"></div>
                                                                        <br/><br/>
                                                                <button id="clear4" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed4" name="signed4" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete->firma4)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="nav-cinco" role="tabpanel" aria-labelledby="nav-cinco-tab">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 05</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete2->fecha5 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete2->talla5_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->talla5_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Abdomen</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen5_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen5_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Cintura</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura5_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura5_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Cadera</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera5_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera5_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizado</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo5_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo5_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete2->firma5 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete2->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig5"></div>
                                                                        <br/><br/>
                                                                <button id="clear5" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed5" name="signed5" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete2->firma5)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                      </div>

                                </div>
                            </div>


                        </div>


                    <div class="card-header bg-transparent">
                        <h5 class="text-dark text-center mt-2 mb-3">Ubicación <br>
                        </h5>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60214.95713782746!2d-99.24951146734244!3d19.39360992523693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffd944963ec3%3A0xb529339c57f86ca6!2sPARADISUS%20SPA!5e0!3m2!1ses-419!2smx!4v1673892200177!5m2!1ses-419!2smx" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

  <script type="text/javascript">

      var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});
      $('#clear').click(function (e) {
          e.preventDefault();
          sig.signature('clear');
          $("#signed").val('');
      });

      var sig2 = $('#sig2').signature({syncField: '#signed2', syncFormat: 'PNG'});
      $('#clear2').click(function (e) {
          e.preventDefault();
          sig2.signature('clear');
          $("#signed2").val('');
      });

      var sig3 = $('#sig3').signature({syncField: '#signed3', syncFormat: 'PNG'});
      $('#clear3').click(function (e) {
          e.preventDefault();
          sig3.signature('clear');
          $("#signed3").val('');
      });

      var sig4 = $('#sig4').signature({syncField: '#signed4', syncFormat: 'PNG'});
      $('#clear4').click(function (e) {
          e.preventDefault();
          sig4.signature('clear');
          $("#signed4").val('');
      });
      var sig5 = $('#sig5').signature({syncField: '#signed5', syncFormat: 'PNG'});
      $('#clear5').click(function (e) {
          e.preventDefault();
          sig5.signature('clear');
          $("#signed5").val('');
      });

      var sig6 = $('#sig6').signature({syncField: '#signed6', syncFormat: 'PNG'});
      $('#clear6').click(function (e) {
          e.preventDefault();
          sig6.signature('clear');
          $("#signed6").val('');
      });



  </script>


@endsection
