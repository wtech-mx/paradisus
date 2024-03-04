
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
@endsection


<style>

    body{
       background-color: #191c2d;
        padding: 30px;
    }

    .tiitle_sibcards{

    }

    .contendor_hijo_ovalo{
        background-color: #000;
        width: 35px;
        height: 120px;
        border-radius: 9px;
    }

</style>
@php $counter = 1; @endphp

    <div class="row justify-content-center" >
        <div class="col-12 ">
            <form method="POST" action="{{ route('store_config.laser') }}" enctype="multipart/form-data" role="form" id="tuFormulario">
                @csrf
                <input  id="id_client" name="id_client" type="text" value="{{$nota_laser->id_client}}" class="form-control" style="display: none">
                <div id="formulario" class="mt-4">
                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar otra area</button>
                    <div class="clonars">
                        <div class="row" style="background-color: #557B8E;border-radius: 9px;">
                            <div class="col-12">
                                <h5 class=" text-center text-white mt-3 mb-3" style="font-weight: 800;font-size: 30px;">
                                    Area
                                </h5>

                                <div class="row">
                                    <div class="col-12 px-5">
                                        <div class="d-flex justify-content-between">

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/face.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Face" id="flexRadioFace{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Face
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/arm.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Arm" id="flexRadioArm{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Arm
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/armpit.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Armpit" id="flexRadioArmpit{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Armpit
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/back.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Back" id="flexRadioBack{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Back
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/abdomen.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Abdomen" id="flexRadioAbdomen{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Abdomen
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/bikini.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Bikini" id="flexRadioBikini{{ $counter }}">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1">
                                                        Bikini
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="container_cards">
                                                <img src="{{ asset('assets/img/leg.jpg') }}"  style="width: 110px;display:block">

                                                <div class="form-check" style="display:block;">
                                                    <input class="form-check-input" type="radio" name="area[]" value="Leg">
                                                    <label class="form-check-label text-white" for="flexRadioDefault1" id="flexRadioLeg{{ $counter }}">
                                                        Leg
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3" style="">
                            <div class="col-4">
                                <div class="card_sub me-1 " style="background-color: #2E3E58;border-radius: 9px;">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="tex-center text-white tiitle_sibcards" >SKYN TYPE</h5>
                                    </div>

                                    <hr style="  border: 3px solid #36c5e5;border-radius: 5px;">

                                    <div class="d-flex justify-content-around">

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="I" id="flexRadioI{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin">
                                                I
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #a98a6b!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="II" id="flexRadioII{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin_ii">
                                                II
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #DEB977!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="III" id="flexRadioIII{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin_iii">
                                                III
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #CBC8C3!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="IV" id="flexRadioIV{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin_iv">
                                                IV
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="V" id="flexRadioV{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin_v">
                                                V
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="skyn_type[]" value="VI" id="flexRadioVI{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="skin_vi">
                                                VI
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="card_sub me-1 " style="background-color: #2E3E58;border-radius: 9px;">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="tex-center text-white tiitle_sibcards" >HAIR TYPE</h5>
                                    </div>

                                    <hr style="  border: 3px solid #36c5e5;border-radius: 5px;">

                                    <div class="d-flex justify-content-around">

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_type[]" value="Black" id="flexRadioBlack{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Black
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #a98a6b!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_type[]" value="Brown" id="flexRadioBrown{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Brown
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #DEB977!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_type[]" value="Blond" id="flexRadioBlond{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Blond
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #CBC8C3!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_type[]" value="Grey" id="flexRadioGrey{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Grey
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_type[]" value="White" id="flexRadioWhite{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                White
                                            </label>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="col-2">
                                <div class="card_sub me-1 " style="background-color: #2E3E58;border-radius: 9px;">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="tex-center text-white tiitle_sibcards" >HAIR DENSITY</h5>
                                    </div>
                                    <hr style="  border: 3px solid #36c5e5;border-radius: 5px;">

                                    <div class="d-flex justify-content-around">

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hd1.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_density[]" value="Thin" id="flexRadioThin{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Thin
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hd2.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_density[]" value="Middle" id="flexRadioMiddle{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Middle
                                            </label>
                                        </div>


                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hd3.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_density[]" value="Tick" id="flexRadioTick{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Tick
                                            </label>
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <div class="col-2">
                                <div class="card_sub me-1 " style="background-color: #2E3E58;border-radius: 9px;">
                                    <div class="d-flex justify-content-center">
                                        <h5 class="tex-center text-white tiitle_sibcards" >HAIR TICKNESS</h5>
                                    </div>

                                    <hr style="  border: 3px solid #36c5e5;border-radius: 5px;">


                                    <div class="d-flex justify-content-around">

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/at1.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_tickness[]" value="Ligth" id="flexRadioLigth{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Ligth
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/at2.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_tickness[]" value="Middel" id="flexRadioMiddel{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Middel
                                            </label>
                                        </div>

                                        <div class="contenedor_ovalo">
                                            <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/at3.png') }}')">
                                            </div>

                                            <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                                                <input class="form-check-input" type="radio" name="hair_tickness[]" value="Bold" id="flexRadioBold{{ $counter }}">
                                            </div>

                                            <label class="form-check-label text-white" for="haircolor_Black">
                                                Bold
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="btnGuardar" type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                    Guardar
                </button>
            </form>

        </div>
    </div>

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

    <script type="text/javascript">
    var counter = 1;
        // ============= Agregar mas inputs dinamicamente =============
        $('.clonar').click(function() {
          // Clona el .input-group
          var $clone = $('#formulario .clonars').last().clone();

        // Incrementar el contador y actualizar IDs y nombres
        counter++;
        $clone.find('[id]').each(function () {
            var newId = $(this).attr('id') + counter;
            $(this).attr('id', newId);
        });

        $clone.find('[name]').each(function () {
            var newName = $(this).attr('name') + counter;
            $(this).attr('name', newName);
        });

          // Agrega lo clonado al final del #formulario
          $clone.appendTo('#formulario');

          // Muestra la alerta de duplicado con éxito
          alert('Duplicado con éxito');
        });

        document.addEventListener('DOMContentLoaded', function () {
            var btnGuardar = document.getElementById('btnGuardar');
            var form = document.getElementById('tuFormulario');

            btnGuardar.addEventListener('click', function () {
                // Deshabilita el botón después de hacer clic
                btnGuardar.disabled = true;
                // Envía el formulario después de deshabilitar el botón
                form.submit();
            });
        });

    </script>
@endsection
