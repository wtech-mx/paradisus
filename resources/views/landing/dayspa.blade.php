@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/tratamientos.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">DAYS SPA </h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">

              </p>

              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn px-4 btn_cta">Ver Catalogo</button>
              </div>
            </div>
          </div>

    </div>

</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                               $900.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS.jpg') }}" class="img_corporales p-3" alt="">
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

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselPersonaFav" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/CUMPLE CON TU PERSONA.jpg') }}" class="img_corporales p-3" alt="">
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


    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,800.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,700.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouseaniversario" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY SPA ANIVERSARIO.jpg') }}" class="img_corporales p-3" alt="">
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

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselDespedidaSolteras" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DAY SPA DESPEDIDA DE SOLTERA.jpg') }}" class="img_corporales p-3" alt="">
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


    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $10,125.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $2,000.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselsespedidadomicilio" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/DESPEDIDA SOLTERA DOMICILIO.jpg') }}" class="img_corporales p-3" alt="">
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
