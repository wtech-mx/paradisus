@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Jacuzzi
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
                <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@ :
                    <br>
                    {{$ConcentimientoFacial->Client->name}} {{$ConcentimientoFacial->Client->last_name}}
                </h5>
              </div>

              <div class="card-body px-lg-3 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>
                <form method="POST" action="{{ route('jacuzzi_consentimiento.user', $ConcentimientoFacial->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    @if ($ConcentimientoFacial->pregunta2 == NULL)
                        <h5>Consentimiento Jacuzzi</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Cuántas con alguna enfermedad de ETS? *</label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Si" id="pregunta1" name="pregunta1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="No" id="pregunta1" name="pregunta1">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    No
                                                </label>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Padeces actualmente algún tipo de hongo en la piel? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta2" name="pregunta2">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta2" name="pregunta2">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Has experimentado alguna infección en las zonas íntimas en los últimos 14 días? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta3" name="pregunta3">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta3" name="pregunta3">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Antes de ingresar al jacuzzi, ¿te has lavado y limpiado adecuadamente?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta4" name="pregunta4">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta4" name="pregunta4">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Estás al tanto de la temperatura predeterminada establecida para el jacuzzi en nuestro spa?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta5" name="pregunta5">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta5" name="pregunta5">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Eres consciente de que no se permite ajustar la temperatura del jacuzzi?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta6" name="pregunta6">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta6" name="pregunta6">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Estás dispuesto/a a seguir las pautas y recomendaciones de uso del jacuzzi en nuestro spa para garantizar tu seguridad y la de otros usuarios?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta7" name="pregunta7">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta7" name="pregunta7">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <hr style="background-color: #D9819C; height: 5px;">
                    <h5 style="color: #D9819C;">Terminos & Condiciones</h5>
                    <div class="row">
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Responsabilidad de Paradisus:</b>
                                <li>Se compromete a mantener el jacuzzi en condiciones sanitarias adecuadas y a la temperatura establecida para garantizar la seguridad y el bienestar de los usuarios.</li>
                                <li>Se reserva el derecho de negar el acceso al jacuzzi a cualquier persona que presente signos de enfermedad, infección o que no cumpla con las normas establecidas.</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Responsabilidad del cliente:</b>
                                <li><b>No</b> traer nada externo a lo que viene en el flayer <b>(vino o comida)</b></li>
                                <li>Se recomienda a los usuarios que utilicen traje de baño limpio y apropiado para el jacuzzi.</li>
                                <li>El usuario debe lavarse adecuadamente antes de ingresar al jacuzzi para minimizar el riesgo de contaminación y propagación de bacterias.</li>
                                <li><b>No</b> tener ninguna enfermedad o ETS.</li>
                                <li><b>No</b> contar con infecciónes , ni hongos.</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Uso adecuado del jacuzzi:</b>
                                <li>No se permite el uso del jacuzzi mientras se está bajo la influencia del alcohol, drogas o medicamentos que puedan afectar la capacidad del usuario para utilizarlo de manera segura.</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Notificación de síntomas o malestar:</b>
                                <li>Los usuarios deben notificar al personal del spa de inmediato si experimentan algún síntoma de infección, malestar o reacción adversa durante o después de utilizar el jacuzzi.</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Limitación de responsabilidad:</b>
                                <li>Paradisus no se hace responsable de cualquier lesión, enfermedad o daño sufrido por el usuario durante el uso del jacuzzi, a menos que se deba a negligencia grave por parte del spa.</li>
                            </ul>
                        </div>
                        <div class="col-5">
                            <ul>
                                <b style="color: #D9819C;">Cumplimiento de las normas:</b>
                                <li>Paradisus se reserva el derecho de tomar medidas, incluida la prohibición del acceso al jacuzzi, en caso de que se incumplan repetidamente las normas y pautas establecidas.</li>
                            </ul>
                        </div>
                    </div>

                    <hr style="background-color: #D9819C; height: 5px;">
                    <h5>Firma(s)</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="row">
                                    @if ($ConcentimientoFacial->pregunta2 == NULL)
                                        @for ($i=1; $i<=$ConsentimientoFirmasCorporal; $i++)
                                            <div class="col-4">
                                                <div id="sig_pago{{$i}}"></div>
                                                <br/><br/>
                                                <button id="clear_pago{{$i}}" class="btn btn-danger btn-sm">Repetir</button>
                                                <textarea id="signed_pago{{$i}}" name="signed_pago{{$i}}" style="display: none"></textarea>
                                            </div>
                                        @endfor
                                    @else
                                        @foreach ($firmas as $firma)
                                            <div class="col-4">
                                                <img src="{{asset('firma_consentimientob/'.$firma->firma)}}" alt="">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($ConcentimientoFacial->pregunta2 == NULL)
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    @endif

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('js_custom')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

<script type="text/javascript">
    var sig_pago1 = $('#sig_pago1').signature({syncField: '#signed_pago1', syncFormat: 'PNG'});

    $('#clear_pago1').click(function (e) {
        e.preventDefault();
        sig_pago1.signature('clear');
        $("#signed_pago1").val('');
    });

    var sig_pago2 = $('#sig_pago2').signature({syncField: '#signed_pago2', syncFormat: 'PNG'});

    $('#clear_pago2').click(function (e) {
        e.preventDefault();
        sig_pago2.signature('clear');
        $("#signed_pago2").val('');
    });

    var sig_pago3 = $('#sig_pago3').signature({syncField: '#signed_pago3', syncFormat: 'PNG'});

    $('#clear_pago3').click(function (e) {
        e.preventDefault();
        sig_pago3.signature('clear');
        $("#signed_pago3").val('');
    });

    var sig_pago4 = $('#sig_pago4').signature({syncField: '#signed_pago4', syncFormat: 'PNG'});

    $('#clear_pago4').click(function (e) {
        e.preventDefault();
        sig_pago4.signature('clear');
        $("#signed_pago4").val('');
    });

    var sig_pago5 = $('#sig_pago5').signature({syncField: '#signed_pago5', syncFormat: 'PNG'});

    $('#clear_pago5').click(function (e) {
        e.preventDefault();
        sig_pago5.signature('clear');
        $("#signed_pago5").val('');
    });

    var sig_pago6 = $('#sig_pago6').signature({syncField: '#signed_pago6', syncFormat: 'PNG'});

    $('#clear_pago6').click(function (e) {
        e.preventDefault();
        sig_pago6.signature('clear');
        $("#signed_pago6").val('');
    });

    var sig_pago7 = $('#sig_pago7').signature({syncField: '#signed_pago7', syncFormat: 'PNG'});

    $('#clear_pago7').click(function (e) {
        e.preventDefault();
        sig_pago7.signature('clear');
        $("#signed_pago7").val('');
    });

    var sig_pago8 = $('#sig_pago8').signature({syncField: '#signed_pago8', syncFormat: 'PNG'});

    $('#clear_pago8').click(function (e) {
        e.preventDefault();
        sig_pago8.signature('clear');
        $("#signed_pago8").val('');
    });

    var sig_pago9 = $('#sig_pago9').signature({syncField: '#signed_pago9', syncFormat: 'PNG'});

    $('#clear_pago9').click(function (e) {
        e.preventDefault();
        sig_pago9.signature('clear');
        $("#signed_pago9").val('');
    });

    var sig_pago10 = $('#sig_pago10').signature({syncField: '#signed_pago10', syncFormat: 'PNG'});

    $('#clear_pago10').click(function (e) {
        e.preventDefault();
        sig_pago10.signature('clear');
        $("#signed_pago10").val('');
    });

    var sig_pago11 = $('#sig_pago11').signature({syncField: '#signed_pago11', syncFormat: 'PNG'});

    $('#clear_pago11').click(function (e) {
        e.preventDefault();
        sig_pago11.signature('clear');
        $("#signed_pago11").val('');
    });

    var sig_pago12 = $('#sig_pago12').signature({syncField: '#signed_pago12', syncFormat: 'PNG'});

    $('#clear_pago12').click(function (e) {
        e.preventDefault();
        sig_pago12.signature('clear');
        $("#signed_pago12").val('');
    });

    var sig_pago13 = $('#sig_pago13').signature({syncField: '#signed_pago13', syncFormat: 'PNG'});

    $('#clear_pago13').click(function (e) {
        e.preventDefault();
        sig_pago13.signature('clear');
        $("#signed_pago13").val('');
    });
</script>
@endsection
