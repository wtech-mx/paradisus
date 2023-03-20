@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Brow Bar
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">

@endsection

@section('content')

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

    @media only screen and (max-width: 450px) {
        .text-res {
        font-size: 12px
    }
    }

</style>

<main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9">
            <div class="card border-0 mb-0">

              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@:
                    <br>
                    {{$ConcentimientoFacial->Client->name}} {{$ConcentimientoFacial->Client->last_name}}
                </h5>
              </div>

              <div class="card-body px-lg-3 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>
                    <h5>Consentimiento Brow Bar</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Que servicio es el que vas a realizarte?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta1}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Es la primera vez que te realizas este tratamiento?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta2}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Si te haz realizado antes este procedimiento y presentaste reacción o mala pigmentación, ¿Hay algo importante que debas mencionar?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta3}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Hace cuanto te realizaste ese proceso?</label>
                                <p class="text-res">En respuesta otra: En caso de tener algún problema de la piel, menciónalo. <br>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta4}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estás en algún tratamiento dermatológico?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta5}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Utilizas algún producto o tratamiento que contenga ácido glicolico y/o retinol?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta6}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estas en algún tratamiento de transplante de vello?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta7}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estas en algún tratamiento de depilación láser o luz pulsada?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta8}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Te haz realizado en los últimos 15 días peeling o microdermoabrasión?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta9}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estás embarazada?</label>
                                <div class="row">
                                    <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta10}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estás en etapa de lactancia?</label>
                                    <div class="row">
                                        <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta11}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Estás en ciclo de menstruación u ovulación?</label>
                                    <div class="row">
                                        <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta12}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Padeces de alguna alteración hormonal?</label>
                                    <div class="row">
                                        <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta13}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Presentas alguna enfermedad en los ojos?</label>
                                    <div class="row">
                                        <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta14}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Sufres de alergias en general?</label>
                                    <div class="row">
                                        <textarea name="" id="" cols="5" rows="3" disabled>{{$ConcentimientoFacial->pregunta15}}</textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <hr style="background-color: #D9819C; height: 5px;">
                    <h5>Firma(s)</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                        @foreach ($firmas as $firma)
                                            <div class="col-4">
                                                <img src="{{asset('firma_consentimientob/'.$firma->firma)}}" alt="">
                                            </div>
                                        @endforeach
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
  </main>

@endsection
