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

            <form method="POST" action="{{ route('update_hoja_salud.lacer', $hoja_salud->id) }}" id="" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="row p-3">
                    <div class="col-8 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            NOMBRE COMPLETO :
                        </p>
                        <input type="text" class="form-control" value="{{ $client->name }} {{ $client->last_name }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" disabled>
                    </div>

                    <div class="col-4 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            FECHA :
                        </p>
                        <input type="date" name="fecha" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-4 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            TELÉFONO :
                        </p>

                        <input type="text" value="{{ $client->phone }}" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" disabled>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Se considera sano?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p1" id="p1_si" value="si" {{ $hoja_salud->p1 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p1_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p1" id="p1_no" value="no" {{ $hoja_salud->p1 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p1_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está actualmente bajo tratamiento médico?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p2" id="p2_si" value="si" {{ $hoja_salud->p2 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p2_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p2" id="p2_no" value="no" {{ $hoja_salud->p2 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p2_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" name="p3" value="{{ $hoja_salud->p3 }}" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Toma alguna medicación?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p4" id="p4_si" value="si" {{ $hoja_salud->p4 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p4_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p4" id="p4_no" value="no" {{ $hoja_salud->p4 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p4_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" value="{{ $hoja_salud->p5 }}" name="p5" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está Ud. Embarazada o desea quedarse?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p6" id="p6_si" value="si" {{ $hoja_salud->p6 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p6_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p6" id="p6_no" value="no" {{ $hoja_salud->p6 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p6_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" name="p7" value="{{ $hoja_salud->p7 }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Toma algún tipo de anticonceptivo o sustitutivo Hormonal?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p8" id="p8_si" value="si" {{ $hoja_salud->p8 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p8_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p8" id="p8_no" value="no" {{ $hoja_salud->p8 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p8_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" name="p9" value="{{ $hoja_salud->p9 }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Padece algún tipo de trastorno hormonal?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p10" id="p10_si" value="si" {{ $hoja_salud->p10 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p10_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p10" id="p10_no" value="no" {{ $hoja_salud->p10 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p10_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" name="p11" value="{{ $hoja_salud->p11 }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Padece alguno de los siguientes:
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p12" id="p12_Hirsutismo" value="Hirsutismo" {{ $hoja_salud->p12 === 'Hirsutismo' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p12_Hirsutismo">
                                Hirsutismo
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="p12_Hipertricosis" value="Hipertricosis" {{ $hoja_salud->p12 === 'Hipertricosis' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p12_Hipertricosis">
                                Hipertricosis
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="p12_Alopecia" value="Alopecia" {{ $hoja_salud->p12 === 'Alopecia' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p12_Alopecia">
                                Alopecia
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="p12_Alteraciones_menstruales" value="Alteraciones menstruales" {{ $hoja_salud->p12 === 'Alteraciones menstruales' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p12_Alteraciones_menstruales">
                                Alteraciones menstruales
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p12" id="p12_Otros" value="Otros" {{ $hoja_salud->p12 === 'Otros' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p12_Otros">
                                Otros
                            </label>
                        </div>
                    </div>


                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está o ha estado en tratamiento para alguna de las afecciones anteriores? <br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p13" id="p13_si" value="si" {{ $hoja_salud->p13 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p13_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p13" id="p13_no" value="no" {{ $hoja_salud->p13 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p13_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene alguna enfermedad relacionada a Fotosensibilidad como la Porfiria, Eritema,
                            Polimorfo, Urticaria solar o Lupus?<br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p14" id="p14_si" value="si" {{ $hoja_salud->p14 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p14_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p14" id="p14_no" value="no" {{ $hoja_salud->p14 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p14_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene Ud. Epilepsia?
                        </p> <br>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p15" id="p15_si" value="si" {{ $hoja_salud->p15 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p15_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p15" id="p15_no" value="no" {{ $hoja_salud->p15 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p15_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene Ud. Alguna afección psíquica (comoEsquizofrenia, Sd Down, etc..)?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p16" id=""  value="si" {{ $hoja_salud->p16 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="">
                              Si
                            </label>
                          </div>

                          <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p16" id=""  value="no" {{ $hoja_salud->p16 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="">
                              No
                            </label>
                          </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene algún implante metálico?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p17" id="p17_si" value="si" {{ $hoja_salud->p17 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p17_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p17" id="p17_no" value="no" {{ $hoja_salud->p17 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p17_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Padece alguna alergia? <br>
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p18" id="p18_si" value="si" {{ $hoja_salud->p18 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p18_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p18" id="p18_no" value="no" {{ $hoja_salud->p18 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p18_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control" name="p19" value="{{ $hoja_salud->p19 }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Está en tratamiento para ello?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p20" id="p20_si" value="si" {{ $hoja_salud->p20 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p20_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p20" id="p20_no" value="no" {{ $hoja_salud->p20 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p20_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-6 mt-3">
                        <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            Cual :
                        </p>

                        <input type="text" class="form-control"  name="p21" value="{{ $hoja_salud->p21 }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene o ha tenido cáncer o alguna lesión pre cancerosa?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p22" id="p22_si" value="si" {{ $hoja_salud->p22 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p22_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p22" id="p22_no" value="no" {{ $hoja_salud->p22 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p22_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Su piel se inflama o irrita con facilidad?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p23" id="p23_si" value="si" {{ $hoja_salud->p23 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p23_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p23" id="p23_no" value="no" {{ $hoja_salud->p23 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p23_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Ha tenido problemas de cicatrización?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p24" id="p24_si" value="si" {{ $hoja_salud->p24 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p24_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p24" id="p24_no" value="no" {{ $hoja_salud->p24 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p24_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Su piel ha cambiado de color tras formarse una cicatriz?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p25" id="p25_si" value="si" {{ $hoja_salud->p25 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p25_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p25" id="p25_no" value="no" {{ $hoja_salud->p25 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p25_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Hace Ud. deporte?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p26" id="p26_si" value="si" {{ $hoja_salud->p26 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p26_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p26" id="p26_no" value="no" {{ $hoja_salud->p26 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p26_no">
                                No
                            </label>
                        </div>
                    </div>


                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Tiene algún tatuaje o maquillaje permanente?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p27" id="p27_si" value="si" {{ $hoja_salud->p27 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p27_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p27" id="p27_no" value="no" {{ $hoja_salud->p27 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p27_no">
                                No
                            </label>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                            -¿Se ha practicado algún tipo de peeling, dermoabrasión, tratamientos con ácido u otro tipo de láser en el último mes?
                        </p>

                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="radio" name="p28" id="p28_si" value="si" {{ $hoja_salud->p28 === 'si' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p28_si">
                                Si
                            </label>
                        </div>

                        <div class="form-check" style="display: inline-block; margin-left:1rem;">
                            <input class="form-check-input" type="radio" name="p28" id="p28_no" value="no" {{ $hoja_salud->p28 === 'no' ? 'checked' : '' }}>
                            <label class="form-check-label" for="p28_no">
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

                    @if($hoja_salud->firma != NULL )

                        <div class="col-12">
                            <img class="mx-auto" src="{{asset('firmaCosme/'. $hoja_salud->firma)}}" alt="">
                        </div>

                    @else

                        <div class="col-12 mt-3">
                            <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                Firma :
                            </p>

                                <div id="sig"></div>

                                <textarea id="signed" name="firma" style="display: none"></textarea>

                                <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>

                                <img src="{{asset('firmaCosme/'. $hoja_salud->firma)}}" alt="">

                                <button type="submit" class="btn " style="background: {{$configuracion->color_boton_save}}; color: #ffff">
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
