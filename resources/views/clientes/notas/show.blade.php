@extends('clientes.layout.app')


@section('template_title')
    Usuarios
@endsection

@section('client_app')

@foreach ($nota_cosme as $nota)
@php
    $cadena = $nota->User->name;
    $cadenaExplode = explode(" ", $cadena);
    $ultimoElemento = end($cadenaExplode);
@endphp
@endforeach

<main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7">
            <div class="card border-0 mb-0">

              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@ : <br> {{ $notas_pedidos->Client->name }} {{ $notas_pedidos->Client->last_name }}
                </h5>
              </div>

              <div class="card-body px-lg-5 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="example-text-input" class="form-control-label">Servicios</label>
                            <div class="input-group mb-4">
                                <span class="input-group-text"><i class="ni ni-collection"></i></span>
                                @foreach($notas_paquetes as $item)
                                        <input class="form-control" type="text" value="{{ $item->Servicios->nombre }}" disabled>
                                        @if($item->id_servicio2 != NULL || $item->id_servicio2 != 0)
                                        <input class="form-control" type="text" value="{{ $item->Servicios2->nombre }}" disabled>
                                        @endif
                                        @if($item->id_servicio3 != NULL || $item->id_servicio3 != 0)
                                        <input class="form-control" type="text" value="{{ $item->Servicios3->nombre }}" disabled>
                                        @endif
                                        @if($item->id_servicio4 != NULL || $item->id_servicio4 != 0)
                                        <input class="form-control" type="text" value="{{ $item->Servicios4->nombre }}" disabled>
                                        @endif
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Cosmetologa</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                            <input class="form-control" type="text" value="{{  $ultimoElemento }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Restante</label>
                            <div class="input-group mb-4">
                            <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                            <input class="form-control" type="text" value="${{ $notas_pedidos->restante }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                    @foreach ($pago as $item)
                    <hr style="background-color: #D9819C; height: 2px;">
                        <div class="row">

                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Fecha</label>
                                <div class="input-group mb-4">
                                <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                <input class="form-control"  type="date" value="{{ $item->fecha }}" disabled>
                                </div>
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Num. sesión</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    <input class="form-control" type="text" value="{{ $item->num_sesion }}" disabled>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Pago</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    <input class="form-control" type="text" value="${{ $item->pago }}" disabled>
                                </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Met. Pago</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="ni ni-credit-card"></i></span>
                                    <input class="form-control" type="text" value="{{ $item->forma_pago }}" disabled>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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


@endsection
