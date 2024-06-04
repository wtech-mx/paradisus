@extends('layouts.app_landing')

@section('template_title')
    Masajes
@endsection


@section('content')

<section class="row">
    <div class="col-12 my-auto">

        <div class="container p-0 p-sm-0 p-md-3 p-lg-5">

            <h4 class="service_title text-center mt-4 mb-4">¿CÓMO QUIERES RELAJARTE HOY?</h4>

            <div class="row d-flex justify-content-between">

                    <div class="col-6  col-md-2 col-lg-2">
                        <p class="text-center">
                            <a href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_EXPERIENCIAS.png') }}" class="" alt="..." style="width: 150px">
                            </a>
                            <a  href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                <br>Experiencias
                            </a>
                        </p>
                    </div>

                    <div class="col-6  col-md-2 col-lg-2 border_selecionador"  >
                        <p class="text-center">
                            <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_CORPORALES.png') }}" class="" alt="..." style="width: 150px">
                            </a>
                            <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                <br>Masajes con tu <br> Persona favorita
                            </a>
                        </p>
                        <img src="{{ asset('assets/landing/ICONOS_BOTONES/click.png') }}" id="movingImage" style="position: relative;width: 90px;top: -146px;left: 80px;">

                    </div>

                    <div class="col-12  col-md-2 col-lg-2">

                        <p class="text-center">
                            <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                <img src="{{ asset('assets/landing/ICONOS_BOTONES/icono-anillo.png') }}" class="" alt="..." style="width: 150px">
                            </a>
                            <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                <br>Day Spa
                            </a>
                        </p>

                    </div>

            </div>

        </div>

    </div>

</section>

<section class="row p-2" style="background-color: #CB95A2">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Masaje</h3>
                    <h2 class="service_title mb-3 color_blanco">Mamá e Hija</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase color_blanco">
                                INCLUYE: <br>
                                1. Masaje de cuerpo Completo. <br>
                                2. Aromaterapia. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante. <br>
                                5. Obsequio, Cuarzo Familiar. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="https://www.wa.link/tiys58" target="_blank" class="btn_comprar_paquete text-center w-100 mb-3 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div id="carouseparejas" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE_MAMA_E_HIJA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

            </div>

          </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,149.3C384,139,480,117,576,106.7C672,96,768,96,864,106.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-2 order-lg-2 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE_HERMANAS.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>


            </div>




          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-1 order-lg-1 my-auto animated-slide-in">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">Masaje</h3>
                    <h2 class="service_title mb-3">Hermanas</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase">
                                INCLUYE: <br>
                                1. Masaje de cuerpo Completo. <br>
                                2. Aromaterapia. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante. <br>
                                5. Obsequio, Cuarzo de Amistad <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="https://www.wa.link/tiys58" target="_blank" class="btn_comprar_paquete text-center w-100 mb-3 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,186.7C384,181,480,171,576,165.3C672,160,768,160,864,160C960,160,1056,160,1152,133.3C1248,107,1344,53,1392,26.7L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Masaje</h3>
                    <h2 class="service_title mb-3 color_blanco">Pareja</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase color_blanco">
                                INCLUYE: <br>
                                1. Masaje de cuerpo Completo. <br>
                                2. Aromaterapia. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante. <br>
                                5. Obsequio, Cuarzo Familiar. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="https://www.wa.link/tiys58" target="_blank" class="btn_comprar_paquete text-center w-100 mb-3 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div id="carouseparejas" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE_PAREJA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

            </div>




          </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-2 order-lg-2 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE_MEJORES_AMIGAS.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>


            </div>
          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div class="container">
            <h3 class="tittle_lase_section text-left">Masaje</h3>
            <h2 class="service_title mb-3">Mejores Amigas</h2>
            <div class="row">

                <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                    <p class="subtext_lase">
                        INCLUYE: <br>
                        1. Masaje de cuerpo Completo. <br>
                        2. Aromaterapia. <br>
                        3. Exfoliación de manos. <br>
                        4. Música Relajante. <br>
                        5. Obsequio, Cuarzo de Amistad <br>
                    </p>
                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                    <a href="https://www.wa.link/tiys58" target="_blank" class="btn_comprar_paquete text-center w-100 mb-3 mb-md-3 mb-lg-4">Agendar</a>

                    <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                        $1,300.0
                    </a>
                </div>

            </div>
        </div>
</div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"  style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,256L48,240C96,224,192,192,288,176C384,160,480,160,576,176C672,192,768,224,864,224C960,224,1056,192,1152,165.3C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Masaje</h3>
                    <h2 class="service_title mb-3 color_blanco">Mejores Amigas trío</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase color_blanco">
                                INCLUYE: <br>
                                1. Masaje de cuerpo Completo. <br>
                                2. Aromaterapia. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante. <br>
                                5. Obsequio, Cuarzo de Amistad <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="https://www.wa.link/tiys58" target="_blank" class="btn_comprar_paquete text-center w-100 mb-3 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/Mejores_Amigas_trío.png') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>


            </div>




          </div>
    </div>
</section>

@endsection
