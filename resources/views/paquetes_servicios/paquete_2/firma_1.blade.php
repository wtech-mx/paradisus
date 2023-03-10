@extends('clientes.layout.app')


@section('template_title')
    Usuarios
@endsection

@section('client_app')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css')}}">
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{ width: 100% !important; height: auto;}

    .tab-pane{
        padding: 15px 15px 15px 15px;
    }
    .custom_col{

    }
    .icon-bar {
  position: fixed;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
  z-index: 10;
  right: 0;
}

.icon-bar a {
  display: block;
  text-align: center;
  padding: 16px;
  transition: all 0.3s ease;
  color: white;
  font-size: 20px;
}

.icon-bar a:hover {
  background-color: #000;
}
.content {
  margin-left: 75px;
  font-size: 30px;
}

.facebook {
  background: #D7819D;
  color: white;
}
</style>
<div class="icon-bar">
    <a href="#nav-uno" class="facebook">
        1
    </a>

    <a href="#nav-dos" class="facebook">
        2
    </a>

    <a href="#nav-tres" class="facebook">
        3
    </a>

    <a href="#nav-cuatro" class="facebook">
        4
    </a>

    <a href="#nav-cinco" class="facebook">
        5
    </a>
    <a href="#nav-seis" class="facebook">
        6
    </a>
  </div>

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
                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                <input class="form-control" type="text" value="Lipoescultura s/Cirugía" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Fecha Inicial</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            <input class="form-control" type="text" value="{{ $paquete->fecha_inicial }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Precio</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fa fa-coins"></i></span>
                            <input class="form-control" type="text" value="${{ $paquete->monto }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Pago Restante</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            <input class="form-control" type="text" value="${{ $paquete->restante }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                    <hr style="background-color: #D9819C; height: 2px;">
                        <div class="row">

                            <div class="row">
                                <div class="col-12">

                                    <nav>
                                        <h5 class="text-center">
                                            Sesiones
                                        </h5>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                          <a class="nav-link" href="#nav-uno" >1</a>
                                          <a class="nav-link" href="#nav-dos" >2</a>
                                          <a class="nav-link" href="#nav-tres" >3</a>
                                          <a class="nav-link" href="#nav-cuatro" >4</a>
                                          <a class="nav-link" href="#nav-cinco" >5</a>
                                          <a class="nav-link" href="#nav-seis" >6</a>
                                          <a class="nav-link" href="#nav-siete" >7</a>
                                          <a class="nav-link" href="#nav-ocho" >8</a>
                                          <a class="nav-link" href="#nav-nueve" >9</a>
                                          <a class="nav-link" href="#nav-diez">10</a>

                                        </div>
                                    </nav>

                                        <div class="tab-pane" id="nav-uno">
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
                                                    <strong>Perzonalizada</strong>
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
                                                                <button id="clear" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed" name="signed" style="display: none"></textarea>
                                                                <br/>
                                                                <button class="btn btn-primary">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete->firma1)}}" alt="">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-dos">
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
                                                    <strong>Perzonalizada</strong>
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

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-tres">
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
                                                     <strong>Perzonalizada</strong>
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

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-cuatro">
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
                                                     <strong>Perzonalizada</strong>
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

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-cinco">
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
                                                     <strong>Perzonalizada</strong>
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

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-seis">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 06</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete2->fecha6 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">
                                                     <input class="form-control"  type="text" value="{{ $paquete2->talla6_a }}" disabled>
                                                     </div>
                                                 </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete2->talla6_d }}" disabled>
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
                                                         <input class="form-control" type="text" value="{{ $paquete2->abdomen6_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete2->abdomen6_d }}" disabled>
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
                                                         <input class="form-control" type="text" value="{{ $paquete2->cintura6_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete2->cintura6_d }}" disabled>
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
                                                         <input class="form-control" type="text" value="{{ $paquete2->cadera6_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">

                                                         <input class="form-control" type="text" value="{{ $paquete2->cadera6_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizada</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete2->gluteo6_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <input class="form-control" type="text" value="{{ $paquete2->gluteo6_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>


                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete2->firma6 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete2->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig6"></div>
                                                                        <br/><br/>
                                                                <button id="clear6" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed6" name="signed6" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete2->firma6)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-siete">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 07</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete2->fecha7 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete2->talla7_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->talla7_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen7_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen7_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura7_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura7_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera7_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera7_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizada</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo7_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo7_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete2->firma7 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete2->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig7"></div>
                                                                        <br/><br/>
                                                                <button id="clear7" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed7" name="signed7" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete2->firma7)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-ocho">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 08</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete2->fecha8 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete2->talla8_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->talla8_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen8_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->abdomen8_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura8_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cintura8_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera8_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->cadera8_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizada</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo8_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete2->gluteo8_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete2->firma8 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete2->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig8"></div>
                                                                        <br/><br/>
                                                                <button id="clear8" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed8" name="signed8" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete2->firma8)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-nueve">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 09</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete3->fecha9 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete3->talla9_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->talla9_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->abdomen9_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->abdomen9_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->cintura9_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->cintura9_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->cadera9_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->cadera9_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizada</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->gluteo9_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->gluteo9_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete3->firma9 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete3->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig9"></div>
                                                                        <br/><br/>
                                                                <button id="clear9" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed9" name="signed9" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete3->firma9)}}" alt="">
                                                    @endif
                                                 </div>
                                            </div>
                                        </div>

                                        <hr style="background-color: #D9819C; height: 2px;">
                                        <div class="tab-pane" id="nav-diez">
                                            <div class="row mt-3">

                                                <div class="col-6 mb-3">
                                                    <strong>SESIÓN 010</strong>
                                                 </div>

                                                 <div class="col-6 mb-3">
                                                     <strong>Fecha:</strong> {{ $paquete3->fecha10 }}
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Talla</strong>
                                                  </div>

                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control"  type="text" value="{{ $paquete3->talla10_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->talla10_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->abdomen10_a }}" disabled>
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->abdomen10_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->cintura10_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->cintura10_d }}" disabled>
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
                                                            <input class="form-control" type="text" value="{{ $paquete3->cadera10_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->cadera10_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Perzonalizada</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Antes</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->gluteo10_a }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                        <label for="example-text-input" class="form-control-label">Despues</label>
                                                        <div class="input-group mb-4">
                                                            <input class="form-control" type="text" value="{{ $paquete3->gluteo10_d }}" disabled>
                                                        </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    @if ($paquete3->firma10 == NULL)
                                                        <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete3->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <div id="sig10"></div>
                                                                        <br/><br/>
                                                                <button id="clear10" class="btn btn-danger btn-sm">Repetir</button>
                                                                <textarea id="signed10" name="signed10" style="display: none"></textarea>
                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                        </form>
                                                    @else
                                                        <img src="{{asset('signatures/'.$paquete3->firma10)}}" alt="">
                                                    @endif
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
<script type="text/javascript" href="{{ asset('assets/js/jquery.signature.js')}}"></script>

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

      var sig7 = $('#sig7').signature({syncField: '#signed7', syncFormat: 'PNG'});
      $('#clear7').click(function (e) {
          e.preventDefault();
          sig7.signature('clear');
          $("#signed7").val('');
      });

      var sig8 = $('#sig8').signature({syncField: '#signed8', syncFormat: 'PNG'});
      $('#clear8').click(function (e) {
          e.preventDefault();
          sig8.signature('clear');
          $("#signed8").val('');
      });

      var sig9 = $('#sig9').signature({syncField: '#signed9', syncFormat: 'PNG'});
      $('#clear9').click(function (e) {
          e.preventDefault();
          sig9.signature('clear');
          $("#signed9").val('');
      });

      var sig8 = $('#sig10').signature({syncField: '#signed10', syncFormat: 'PNG'});
      $('#clear10').click(function (e) {
          e.preventDefault();
          sig10.signature('clear');
          $("#signed10").val('');
      });
  </script>


@endsection
