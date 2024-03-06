@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Laser {{$consentimiento->Client->name}}
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">

@endsection

@section('content')

<style>

    body{
        background-color: #ccc;
        padding: 30px;
    }

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
    <div class="page-header min-vh-100" style="backgorund:#000;">
      <span class="mask bg-gradient-dark opacity-6" style="    background: #ccc;"></span>
      <div class="container" style="    background: #ccc;">
        <div class="row justify-content-center">

          <div class="col-12 col-md-9 p-3">
            <div class="card border-0 mb-0">

                <h5 class=" text-center mt-5 mb-3" style="color:#C45584;font-weight: 800;font-size: 30px;">
                    Consentimiento Informado  para el tratamiento de <br> Depilación mediante Láser de Diodo
                </h5>
                <form method="POST" action="{{ route('update_consentimiento.lacer', $consentimiento->Client->id) }}" id="" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">

                    <div class="row p-3">
                        <div class="col-8 mt-3">
                            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Nombre :
                            </p>
                            <input value="{{$consentimiento->Client->name}} {{$consentimiento->Client->last_name}}" type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                        </div>

                        <div class="col-4 mt-3">
                            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Edad :
                            </p>
                            <input value="{{$consentimiento->edad}}" type="number" name="edad" id="edad" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                        </div>

                        <div class="col-8 mt-3">
                            <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Domicilio:
                            </p>
                            <input value="{{$consentimiento->domicilio}}" type="text" name="domicilio" id="domicilio" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">

                        </div>

                        <div class="col-4 mt-3">
                            <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Telefono :
                            </p>

                            <input value="{{$consentimiento->Client->phone}}" type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                        </div>

                        <div class="col-12 mt-3">
                            <p>
                                Autorizo a realizarme la depilación con láser. El láser sólo es efectivo en un porcentaje de pelos
                                por lo queexistirá la necesidad de efectuar varias sesiones para completar todo el
                                tratamiento, el número desesiones necesarias para la eliminación de la mayor parte del
                                pelo (nunca se elimina la totalidad del pelo) se sitúa entre 5 y 8, pudiendo ser mayor en algunas
                                ocasiones. <br><br>

                                La depilación de la cara en las personas de entre 18 y 35 años puede ser especialmente
                                resistente al tratamienpor el hecho de que el hirsutismo que afecta a esta región hace surgir pelo
                                nuevo a mayor velocidad del que elláser es capaz de eliminarlo. En estos casos las personas
                                que se someten a este procedimiento debenadvertir de este hecho antes de comenzar con
                                el proceso de la depilación, y deben asumir que el númerode sesiones necesarias para la
                                eliminación del pelo de esta región puede llegar a ser superior a lasrequeridas en
                                circunstancias normales o en otras regiones del cuerpo. <br><br>

                                Es importante tener en cuenta que la eliminación de pelo podría ser prolongada e incluso
                                permanente. Sinembargo, algunos pacientes podrían no completar la pérdida de pelo, incluso
                                con varios tratamientos láser. <br><br>

                                Es importante tener en cuenta que la eliminación de pelo podría ser prolongada e incluso
                                permanente. Sinembargo, algunos pacient es podrían no completar la pérdida de pelo, incluso
                                con varios tratamientos láser. <br><br>

                                Los siguientes puntos han sido tratados conmigo:<br><br>
                                ·El beneficio potencial del procedimiento propuesto.<br>
                                ·La probabilidad de éxito.<br>
                                ·Las consecuencias anticipadas son razonables si no se siguen las instrucciones pre y post<br>
                                tratamiento.<br>
                                ·Las complicaciones/riesgos más comunes, con el procedimiento propuesto y período de
                                curaconsecuente; incluyendo (pero no únicamente) infección, cicatrización, recurrencia de pelo,
                                ampollas y cambiosde pigmentación.<br><br>

                                Acepto los siguientes posibles riesgos/experiencias derivados del tratamiento con el Láser: <br><br>

                                <strong style="color:#E14C86;">Incomodidad:</strong> Se podría experimentar alguna incomodidaddurante el tratamiento. Doy mi
                                permiso para laadministración de Anestesia si lo consideran apropiado. Me han advertido que los
                                efectos secundarios queocasionalmente podrían surgir son: el enrojecimiento de la zona
                                después de la sesión, hipopigmentación, hiperpigmentación o raramente aparición de
                                pequeñas ampollas o vesículas en las zonas tratadas. <br><br>

                                <strong style="color:#E14C86;">Cura de la herida:</strong> También se me ha explicado que en ciertas ocasiones, especialmente
                                cuando la piel está muy blanca o ligeramente bronceada, el tratamiento con Láser podría
                                provocar hinchazón, ampollas, costra de color granate, escamas o incluso quemaduras de
                                primer grado en las zonas tratadas. Estas costras se desprenden posteriormente dejando
                                la piel tratada algo menos pigmentada que el resto. Esta región recupera su color normal con la
                                exposición solar, sin dejar secuela alguna, que podría necesitar de una a tres semanas para
                                curar. Una vez que la superficie se haya curado, se podría quedar rosada y sensible al sol
                                durante un período adicional de dos a cuatro semanas (incluso más en algunos pacientes) <br><br>

                                <strong style="color:#E14C86;">Contusiones, hinchazones, infecciones:</strong> Con algunos láseres, podrían aparecer
                                contusiones en el área de tratamiento. Además, se podría notar algo de hinchazón,
                                especialmente cuando se trata de la cara. Finalmente, la infección de la piel también es posible
                                cuando se desarrolle el tratamiento. <br><br>

                                <strong style="color:#E14C86;">Cambios de Pigmentación (color de la piel):</strong> Durante el tratamiento, existe la posibilidad
                                de que el área tratada se aclare u oscurezca, con respecto a la piel de alrededor. Normalmente
                                esto es temporal, pero en rara ocasión podría ser permanente.<br><br>

                                <strong style="color:#E14C86;">Cicatrización:</strong> La cicatrización sucede raramente,pero es una posibilidad cuando se
                                interrumpe la superficie de la piel. Para minimizar las posibilidades de cicatrización, es
                                importante que siga las instrucciones post-operativas cuidadosamente.<br><br>

                            <strong style="color:#E14C86;">Exposiciín Ocular:</strong> Se dará protección ocular. Es importante mantener esta protección
                                en todo momento durante el tratamiento para proteger los ojos de una exposición accidental al
                                láser. <br><br>

                                <strong style="color:#E14C86;">CONOCIMIENTO</strong><br><br>

                            Se me ha explicado los cuidados que debo seguir para evitar estos efectos secundarios,
                            como evitar el uso de maquillaje sobre la cara, o sustancias inflamables que pudieran
                            reaccionar con la luz del láser como ocurre con el alcohol o la acetona. Por todo ello y
                            porque comprendo y entiendo la información que se me han facilitado, y porque he
                            consultado las dudas que me han surgido entorno a este tratamiento, doy mi consentimiento
                            para que se me aplique el mismo. <br><br>

                            <strong>
                                ENTIENDO QUE TODOS LOS PAGOS PARA EL PROCEDIMIENTO ARRIBA MENCIONADO NO SON
                                REEMBOLSABLES UNA VEZ REALIZADO EL TRATAMIENTO. ABAJO FIGURA MÍ FIRMA YCERTIFICO
                                QUE HE LEÍDO Y ENTENDIDO PERFECTAMENTE LOS CONTENIDOS DE ESTA AUTORIZACIÓN:
                            </strong>

                            </p>
                        </div>

                        <div class="col-12 mt-3">
                            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Firma :
                            </p>


                                <div id="sig"></div>

                                <textarea id="signed" name="firma" style="display: none"></textarea>

                                <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>

                                <img src="{{asset('firmaCosme/'. $consentimiento->firma)}}" alt="">

                        </div>
                    </div>
                    <button type="submit" class="btn " style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                        Guardar
                    </button>
                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('js_custom')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>



<script type="text/javascript" class="init">

    $(document).ready(function(){
        $('#example').DataTable();
        $('#historial').DataTable();

        var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});

        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signed").val('');
        });

    });

</script>
@endsection
