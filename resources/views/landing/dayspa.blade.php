@extends('layouts.app_landing')

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

                    <div class="col-6  col-md-2 col-lg-2">
                        <p class="text-center">
                            <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_CORPORALES.png') }}" class="" alt="..." style="width: 150px">
                            </a>
                            <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                <br>Masajes con tu <br> Persona favorita
                            </a>
                        </p>
                    </div>

                    <div class="col-12  col-md-2 col-lg-2 border_selecionador" >

                        <p class="text-center">
                            <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                <img src="{{ asset('assets/landing/ICONOS_BOTONES/icono-anillo.png') }}" class="" alt="..." style="width: 150px">
                            </a>
                            <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                <br>Day Spa
                            </a>
                        </p>
                        <img src="{{ asset('assets/landing/ICONOS_BOTONES/click.png') }}" id="movingImage" style="position: relative;width: 90px;top: -146px;left: 80px;">

                    </div>

            </div>

        </div>

    </div>

</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-1 my-auto animated-slide-in">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">Day Spa</h3>
                    <h2 class="service_title mb-3">Cumpleaños</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase">
                                1. Masaje en brazos, pies, cuello,
                                hombros y escote. <br>
                                2. Facial HIdratante. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante y aromaterapia. <br>
                                5. Flor, tarjeta y pastel de cumpleaños. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                               $900.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-2 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY_SPA_CUMPLE.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>


<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-2 my-auto">
        <div id="carouselPersonaFav" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY_SPA CUMPLE_CON_TU_PERSONA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselPersonaFav" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselPersonaFav" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>


    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-1 my-auto animated-slide-in">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Day Spa</h3>
                    <h2 class="service_title mb-3 color_blanco">Cumpleaños con tu persona favorita</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase color_blanco">
                                1. Masaje en brazos, pies, cuello,
                                hombros y escote. <br>
                                2. Facial HIdratante. <br>
                                3. Exfoliación de manos. <br>
                                4. Música Relajante y aromaterapia. <br>
                                5. Flor, tarjeta y pastel de cumpleaños. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                                $1,800.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2">

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-1 my-auto animated-slide-in">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">Day Spa</h3>
                    <h2 class="service_title mb-3">Aniversario</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos. <br>
                                4. Vino & chocolates en nuestra
                                zona de descaso. <br>
                                5. Flor y pastel de aniversario. <br>
                                6. Foto de pareja digital con fecha del aniversario. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                                $1,700.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-2 my-auto">
        <div id="carouseaniversario" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY_SPA_ANIVERSARIO.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA ANIVERSARIO 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouseaniversario" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouseaniversario" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,250.7C384,256,480,224,576,186.7C672,149,768,107,864,90.7C960,75,1056,85,1152,74.7C1248,64,1344,32,1392,16L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-1 my-auto animated-slide-in">
        <div id="carouselDespedidaSolteras" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DESPEDIDA_SOLTERA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DESPEDIDA SOLTERA.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDespedidaSolteras" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDespedidaSolteras" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>


    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-2 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Day Spa</h3>
                    <h2 class="service_title mb-3 color_blanco">Despedida de Soltera</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase color_blanco">
                                1. Masaje a elegir. <br>
                                2. Facial Nutritivo. <br>
                                3. Exfoliación de manos. <br>
                                4. Vino & chocolates. <br>
                                5. Cuarzos para todas. <br>
                                6.Música relajante y aromaterapia. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                                $10,125.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,165.3C384,139,480,85,576,74.7C672,64,768,96,864,101.3C960,107,1056,85,1152,106.7C1248,128,1344,192,1392,224L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-2 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">Day Spa</h3>
                    <h2 class="service_title mb-3">Despedida de Soltera a domicilio</h2>
                    <div class="row">

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase">
                                1. Masaje cuerpo completo. <br>
                                2. Facial nutritivo. <br>
                                3. Exfoliación de manos. <br>
                                4. Cinta y Velo “Bride to be” para <br>
                                la novia. <br>
                                5. Cuarzos para todas. <br><br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                                $1,600.0
                            </a>
                        </div>

                        <div class="col-12 col-sm-12 col-md-9 col-lg-9 my-auto">
                            <p class="subtext_lase">
                                OPCIÓN 2: Todo lo anterior +  <br>
                                1.Noche de juegos Poker Room Paradisus <br>
                                2. 2 charolas de quesos y jamón (+ 10 px, 4 charolas) <br>
                                3. Globos BRIDE. <br>
                            </p>
                        </div>

                        <div class="col-12 col-sm-12 col-md-3 col-lg-3 my-auto">
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-4 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center mb-4 w-100" style="color:#fff;">
                                $2,000.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-1 my-auto animated-slide-in">
        <div id="carouselsespedidadomicilio" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DESPEDIDA_SOLTERA_A_DOMICILIO.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DESPEDIDA SOLTERA DOMICILIO.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>


            <button class="carousel-control-prev" type="button" data-bs-target="#carouselsespedidadomicilio" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselsespedidadomicilio" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>

@endsection
