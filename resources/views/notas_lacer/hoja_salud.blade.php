@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Facial/Corporal
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
                    Hoja de Salud para el tratamiento de <br> Depilacion Mediante Láser de Diodo
                </h5>

                <div class="row p-3">
                    <div class="col-8 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            NOMBRE COMPLETO :
                        </p>
                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-4 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            FECHA :
                        </p>
                        <input type="text" name="" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-8 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            FECHA DE NACIMIENTO :
                        </p>
                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">

                    </div>

                    <div class="col-4 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            TELÉFONO :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            DIRECCIÓN :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    {{-- <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            COSMETÓLOGA :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div> --}}


                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Se considera sano?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p1" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p1" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está actualmente bajo tratamiento médico?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p2" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p2" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" name="p3" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Toma alguna medicación?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p4" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p4" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" name="p5" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está Ud. Embarazada o desea quedarse?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p6" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p6" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" name="p7" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Toma algún tipo de anticonceptivo o sustitutivoHormonal?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p8" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p8" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" name="p9" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Padece algún tipo de trastorno hormonal?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p10" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p10" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" name="p11" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Padece alguno de los siguientes:
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p12" id="">
                            <label class="form-check-label" for="">
                                Hirsutismo
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="" >
                            <label class="form-check-label" for="">
                                Hipertricosis
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="3" >
                            <label class="form-check-label" for="3">
                                Alopecia
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="4" >
                            <label class="form-check-label" for="4">
                                Alteraciones menstruales
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="5" >
                            <label class="form-check-label" for="5">
                                Otros
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está o ha estado en tratamiento para alguna de las afecciones anteriores? <br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p13" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p13" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene alguna enfermedad relacionada a Fotosensibilidad como la Porfiria, Eritema,
                            Polimorfo, Urticaria solar o Lupus?<br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p14" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p14" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene Ud. Epilepsia?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p15" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p15" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene Ud. Alguna afección psíquica (comoEsquizofrenia, Sd Down, etc..)?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p16" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p16" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene algún implante metálico?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p17" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p17" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Padece alguna alergia? <br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p18" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p18" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" name="p19" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está en tratamiento para ello?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p20" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p20" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" name="p21" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene o ha tenido cáncer o alguna lesión Pre cancerosa?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p22" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p22" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Su piel se inflama o irrita con facilidad?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p23" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p23" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Ha tenido problemas de cicatrización?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p24" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p24" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Su piel ha cambiado de color tras formarseuna cicatriz?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p25" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p25" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Hace Ud. deporte?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p26" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p26" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene algún tatuaje o maquillaje permanente?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p27" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p27" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Se ha practicado algún tipo de peeling, Dermoabrasión, tratamientos con ácido u otro
Tipo de láser en el último mes?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p28" id="">
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p28" id="" >
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12">
                        <p> <br><br>
                            <strong>Observaciones:</strong> Cualquier cambio en el historial médico o medicaciones
                            debe ser notificado.
                        </p>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Firma :
                        </p>


                        <form method="POST" action="" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div id="sig"></div>

                            <textarea id="signed" name="signed" style="display: none"></textarea>

                            <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                            <button class="btn btn-sm btn-success">Guardar</button>
                        </form>

                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Firma :
                        </p>


                        <form method="POST" action="" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div id="sig2"></div>

                            <textarea id="signed2" name="signed2" style="display: none"></textarea>

                            <button id="clear2" class="btn btn-sm btn-danger ">Repetir</button>
                            <button class="btn btn-sm btn-success">Guardar</button>
                        </form>

                    </div>

              </div>

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
        var sig2 = $('#sig2').signature({syncField: '#signed2', syncFormat: 'PNG'});

        $('#clear').click(function (e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signed").val('');
        });

        $('#clear2').click(function (e) {
            e.preventDefault();
            sig2.signature('clear');
            $("#signed2").val('');
        });

    });

</script>
@endsection
