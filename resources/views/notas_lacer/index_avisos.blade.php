@extends('clientes.layout.app')


@section('template_title')
Aviso  Laser {{$consentimiento->Client->name}}
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
                    Aviso <br> Depilación mediante Láser de Diodo
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
                                📌 Aviso Importante para Clientas de Depilación Láser <br><br>
                                    Querida clienta, <br>

                                    En Paradisus Spa trabajamos con compromiso y respeto hacia tu tiempo y resultados. Por eso, queremos recordarte lo siguiente:<br><br>

                                    🔹 Tu cita es tu responsabilidad. Si no asistes o cancelas sin previo aviso, se considerará como falta.<br>
                                    🔹 En caso de faltar a tu sesión, la garantía en tu tratamiento quedará anulada.<br>
                                    🔹 Para conservar tu garantía, es indispensable que acudas puntualmente a todas tus citas programadas o avises con al menos 24 horas de anticipación.<br><br>

                                    🙌 Gracias por ayudarnos a mantener un servicio responsable, organizado y efectivo para todas.<br><br>

                            </p>
                        </div>

                        @if($consentimiento->firma_aviso != NULL )

                            <div class="col-12">
                                <img class="mx-auto" src="{{asset('firmaCosme/'. $consentimiento->firma_aviso)}}" alt="">
                            </div>

                        @else

                            <div class="col-12 mt-3">
                                <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                    Firma :
                                </p>

                                    <div id="sig"></div>
                                    <textarea id="signed" name="firma_aviso" style="display: none"></textarea>
                                    <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>


                                <button type="submit" class="btn mx-auto" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Guardar
                                </button>
                            </div>

                        @endif

                    </div>

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
