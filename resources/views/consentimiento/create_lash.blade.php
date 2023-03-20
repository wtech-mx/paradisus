@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Lash Lifting
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
                <form method="POST" action="{{ route('lash_consentimiento.user', $ConcentimientoFacial->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    @if ($ConcentimientoFacial->pregunta2 == NULL)
                        <h5>Consentimiento Lash Lifting</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Que servicio es el que vas a realizarte? *</label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Lash Lifting Básico" id="renales" name="renales">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Lash Lifting Básico
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Lash Lifting Doble" id="digestivas" name="digestivas">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Lash Lifting  Doble
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Otros:</label>
                                                <input id="pregunta1_otro" name="pregunta1_otro" type="text" class="form-control" >
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Es la primera vez que te realizas este tratamiento? *</label>
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
                                    <label for="example-text-input" class="form-control-label">Si te haz realizado antes este procedimiento y presentaste reacción, ¿Hay algo importante que debas mencionar? *</label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-group">
                                                <input id="pregunta3" name="pregunta3" type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Hace cuanto te realizaste ese proceso?</label>
                                        <div class="form-group">
                                            <input id="pregunta4" name="pregunta4" type="text" class="form-control" >
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Responde que tan sensibles son tus ojos.</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Nada sensible" id="pregunta5" name="pregunta5">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Nada sensible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Sensible" id="pregunta5" name="pregunta5">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Sensible
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Muy Sensible" id="pregunta5" name="pregunta5">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Muy Sensible
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">¿Estás en algún tratamiento oftalmológico?</label>
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
                                    <label for="example-text-input" class="form-control-label">¿Utilizas algún producto en los ojos?</label>
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">En los últimos 3 meses ¿Te haz realizado cirugía ocular?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta8" name="pregunta8">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta8" name="pregunta8">
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
                                    <label for="example-text-input" class="form-control-label">¿Estas embarazada?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta9" name="pregunta9">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta9" name="pregunta9">
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
                                    <label for="example-text-input" class="form-control-label">¿Estas en etapa de lactancia?</label>
                                    <p>En caso de estar embarazada o en etapa de lactancia es importante que tu médico te de una hoja indicando que puedes realizar los tratamientos estéticos solicitados.</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta10" name="pregunta10">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta10" name="pregunta10">
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
                                    <label for="example-text-input" class="form-control-label">¿Estás en ciclo de menstruación u ovulación? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta11" name="pregunta11">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta11" name="pregunta11">
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
                                    <label for="example-text-input" class="form-control-label">¿Padeces de alguna alteración hormonal? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta12" name="pregunta12">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta12" name="pregunta12">
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
                                    <label for="example-text-input" class="form-control-label">¿Presentas alguna enfermedad en los ojos? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta13" name="pregunta13">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta13" name="pregunta13">
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
                                    <label for="example-text-input" class="form-control-label">¿Sufres de alergias en general? *</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Si" id="pregunta14" name="pregunta14">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="No" id="pregunta14" name="pregunta14">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif
                    <hr style="background-color: #D9819C; height: 5px;">
                    <h5>Terminos & Condiciones</h5>
                    <div class="row">
                        <div class="col-4">
                            <ul>
                                <b style="color: #D9819C;">Consecuencias o Riesgos:</b>
                                <li>Puede presentar reacciones a un producto cosmetológico.</li>
                                <li>No seguir las recomendaciones de la cosmetóloga puede retrasar el resultado del tratamiento.</li>
                                <li>Por el incumplimiento de sesiones no se verán los resultados esperados.</li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul>
                                <b style="color: #D9819C;">La cosmetóloga para garantizar el tratamiento se compromete a:</b>
                                <li>Poner en práctica su ética y conocimiento por el beneficio del paciente.</li>
                                <li>Cumplir con las normas de bioseguridad.</li>
                                <li>Explicarle al paciente los procedimientos.</li>
                            </ul>
                        </div>
                        <div class="col-4">
                            <ul>
                                <b style="color: #D9819C;">El paciente para ver resultados se compromete a:</b>
                                <li>Cumplir con todas las citas sin perder la secuencia de las sesiones acordadas.</li>
                                <li>Seguir las recomendaciones y productos sugeridos.</li>
                                <li>Realizar los pagos acordados.</li>
                                <li>Mejorar su estilo de vida.</li>
                            </ul>
                        </div>
                        <div class="col-8">
                            <ul>
                                <b style="color: #D9819C;">Paradisus SPA te informa:</b>
                                <p>En caso de omitir alguno de estos problemas, las cosmetólogas informarán de inmediato a recepción por haber omitido la información, tendras que retirarte de las instalaciones sin devolución monetaria alguna.</p>
                                <b>Se me ha explicado la naturaleza, propósito, ventajas, molestias y complicaciones que pueden presentarse en el tratamiento, todas las inquietudes han sido contestadas de manera satisfactoria & no me queda ninguna duda, certifico que la información aquí contenida es verdadera y correcta. Deslindo a Paradisus Spa de cualquier enfermedad que yo tenga, o haya escondido al contestar este consentimiento. Acepto que con este documento.</b>
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
                                                <img src="{{asset('firma_consentimientol/'.$firma->firma)}}" alt="">
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
