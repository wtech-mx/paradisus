@extends('clientes.layout.app')


@section('template_title')
    Usuarios
@endsection

@section('client_app')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<style>
    .kbw-signature {
        width: 100%;
        height: 200px;
    }
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
                    @foreach ($client as $item)
                    <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                     @endforeach
                    <br>
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
                                <input class="form-control" type="text" value="Tu figura Ideal c/Aparatología" disabled>
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
                                          <button class="nav-link active" id="nav-uno-tab" data-bs-toggle="tab" data-bs-target="#nav-uno" type="button" role="tab" aria-controls="nav-uno" aria-selected="true"> Uno</button>
                                          <button class="nav-link" id="nav-dos-tab" data-bs-toggle="tab" data-bs-target="#nav-dos" type="button" role="tab" aria-controls="nav-dos" aria-selected="false">Dos</button>
                                          <button class="nav-link" id="nav-tres-tab" data-bs-toggle="tab" data-bs-target="#nav-tres" type="button" role="tab" aria-controls="nav-tres" aria-selected="false">Tres</button>
                                          <button class="nav-link " id="nav-cuatro-tab" data-bs-toggle="tab" data-bs-target="#nav-cuatro" type="button" role="tab" aria-controls="nav-cuatro" aria-selected="true">Cuatro</button>
                                          <button class="nav-link" id="nav-cinco-tab" data-bs-toggle="tab" data-bs-target="#nav-cinco" type="button" role="tab" aria-controls="nav-cinco" aria-selected="false">Cinco</button>
                                          <button class="nav-link" id="nav-seis-tab" data-bs-toggle="tab" data-bs-target="#nav-seis" type="button" role="tab" aria-controls="nav-seis" aria-selected="false">seis</button>

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

                                                     <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                     <input class="form-control"  type="text" value="{{ $paquete->talla1_a }}" disabled>
                                                     </div>
                                                 </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
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
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->abdomen1_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
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
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->cintura1_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
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
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->cadera1_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->cadera1_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                     <strong>Gluteos</strong>
                                                  </div>

                                                  <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Antes</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo1_a }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-md-6">
                                                     <div class="form-group">
                                                     <label for="example-text-input" class="form-control-label">Despues</label>
                                                     <div class="input-group mb-4">
                                                         <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                                         <input class="form-control" type="text" value="{{ $paquete->gluteo1_d }}" disabled>
                                                     </div>
                                                     </div>
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>
                                                    <img src="{{asset('foto_servicios/'.$item->foto)}}" alt="">
                                                    <img src="{{asset('signatures/'.$paquete->firma1)}}" alt="">
                                                 </div>

                                                 <div class="col-12">
                                                    <strong>Firma</strong>

                                                    <form method="POST" action="{{ route('paquetes_firma.store_firma', $paquete->id) }}" enctype="multipart/form-data" role="form">
                                                        @csrf
                                                            <div id="sig"></div>
                                                            <br/><br/>
                                                            <button id="clear" class="btn btn-danger btn-sm">Clear</button>
                                                            <textarea id="signature" name="signed" style="display: none"></textarea>
                                                        </div>
                                                        <br/>
                                                        <button class="btn btn-primary">Save</button>
                                                    </form>
                                                 </div>


                                            </div>

                                        </div>

                                        <div class="tab-pane fade" id="nav-dos" role="tabpanel" aria-labelledby="nav-dos-tab">

                                        </div>

                                        <div class="tab-pane fade" id="nav-tres" role="tabpanel" aria-labelledby="nav-tres-tab">

                                        </div>

                                        <div class="tab-pane fade" id="nav-cuatro" role="tabpanel" aria-labelledby="nav-cuatro-tab">

                                        </div>

                                        <div class="tab-pane fade" id="nav-cinco" role="tabpanel" aria-labelledby="nav-cinco-tab">

                                        </div>

                                        <div class="tab-pane fade" id="nav-seis" role="tabpanel" aria-labelledby="nav-seis-tab">

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

  <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

  <script type="text/javascript">
      var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
      $('#clear').click(function (e) {
          e.preventDefault();
          sig.signature('clear');
          $("#signature64").val('');
      });
  </script>


@endsection
