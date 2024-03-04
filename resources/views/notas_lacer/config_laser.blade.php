@foreach ($configuraciones_laser as $configuracion_laser)
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
                                @if ($configuracion_laser->area == 'Face')
                                    <input class="form-check-input" type="radio" value="Face" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Face" disabled>
                                @endif

                                <label class="form-check-label text-white" for="area">
                                    Face
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/arm.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Arm')
                                    <input class="form-check-input" type="radio" value="Arm" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Arm" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
                                    Arm
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/armpit.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Armpit')
                                    <input class="form-check-input" type="radio" value="Armpit" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Armpit" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
                                    Armpit
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/back.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Back')
                                    <input class="form-check-input" type="radio" value="Back" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Back" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
                                    Back
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/abdomen.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Abdomen')
                                    <input class="form-check-input" type="radio" value="Abdomen" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Abdomen" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
                                    Abdomen
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/bikini.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Bikini')
                                    <input class="form-check-input" type="radio" value="Bikini" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Bikini" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
                                    Bikini
                                </label>
                            </div>
                        </div>

                        <div class="container_cards">
                            <img src="{{ asset('assets/img/leg.jpg') }}"  style="width: 110px;display:block">

                            <div class="form-check" style="display:block;">
                                @if ($configuracion_laser->area == 'Leg')
                                    <input class="form-check-input" type="radio" value="Leg" checked disabled>
                                @else
                                    <input class="form-check-input" type="radio" value="Leg" disabled>
                                @endif
                                <label class="form-check-label text-white" for="area">
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
                            @if ($configuracion_laser->skyn_type == 'I')
                                <input class="form-check-input" type="radio" value="I" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="I" id="skyn_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="skin">
                            I
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #a98a6b!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->skyn_type == 'II')
                                <input class="form-check-input" type="radio" value="II" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="II" id="skyn_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="skin_ii">
                            II
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #DEB977!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->skyn_type == 'III')
                                <input class="form-check-input" type="radio" value="III" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="III" id="skyn_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="skin_iii">
                            III
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #CBC8C3!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->skyn_type == 'IV')
                                <input class="form-check-input" type="radio" value="IV" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="IV" id="skyn_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="skin_iv">
                            IV
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->skyn_type == 'V')
                                <input class="form-check-input" type="radio" value="V" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="V" id="skyn_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="skin_v">
                            V
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->skyn_type == 'VI')
                                <input class="form-check-input" type="radio" value="VI" id="skyn_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="VI" id="skyn_type" disabled>
                            @endif
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
                            @if ($configuracion_laser->hair_type == 'Black')
                                <input class="form-check-input" type="radio" value="Black" id="hair_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Black" id="hair_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Black
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #a98a6b!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_type == 'Brown')
                                <input class="form-check-input" type="radio" value="Brown" id="hair_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Brown" id="hair_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Brown
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #DEB977!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_type == 'Blond')
                                <input class="form-check-input" type="radio" value="Blond" id="hair_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Blond" id="hair_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Blond
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #CBC8C3!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_type == 'Grey')
                                <input class="form-check-input" type="radio" value="Grey" id="hair_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Grey" id="hair_type" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Grey
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-color: #DBE2DB!important">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_type == 'White')
                                <input class="form-check-input" type="radio" value="White" id="hair_type" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="White" id="hair_type" disabled>
                            @endif
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
                            @if ($configuracion_laser->hair_density == 'Thin')
                                <input class="form-check-input" type="radio" value="Thin" id="hair_density" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Thin" id="hair_density" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Thin
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hd2.png') }}')">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_density == 'Middle')
                                <input class="form-check-input" type="radio" value="Middle" id="hair_density" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Middle" id="hair_density" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Middle
                        </label>
                    </div>


                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/hd3.png') }}')">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_density == 'Tick')
                                <input class="form-check-input" type="radio" value="Tick" id="hair_density" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Tick" id="hair_density" disabled>
                            @endif
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
                            @if ($configuracion_laser->hair_tickness == 'Ligth')
                                <input class="form-check-input" type="radio" value="Ligth" id="hair_tickness" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Ligth" id="hair_tickness" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Ligth
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/at2.png') }}')">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_tickness == 'Middel')
                                <input class="form-check-input" type="radio" value="Middel" id="hair_tickness" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Middel" id="hair_tickness" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Middel
                        </label>
                    </div>

                    <div class="contenedor_ovalo">
                        <div class="contendor_hijo_ovalo" style="background-position-y: 40px;background-size: contain;background-repeat: no-repeat;background-image: url('{{ asset('assets/img/at3.png') }}')">
                        </div>

                        <div class="form-check mt-3" style="display:block;margin-left: 7px;">
                            @if ($configuracion_laser->hair_tickness == 'Bold')
                                <input class="form-check-input" type="radio" value="Bold" id="hair_tickness" checked disabled>
                            @else
                                <input class="form-check-input" type="radio" value="Bold" id="hair_tickness" disabled>
                            @endif
                        </div>

                        <label class="form-check-label text-white" for="haircolor_Black">
                            Bold
                        </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endforeach
