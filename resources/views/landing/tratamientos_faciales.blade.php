@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/tratamientos.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">TRATAMIENTOS FACIALES </h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">
                Nuestro extenso catalogo servicios incluye diversos tratamientos corporales divididos en : masajes, aparatologia, drenajes y mas. <br>
                Descrubre todo lo que tenemos para ofrecer y darte solo el mejor servicio,
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
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">Masaje Deportivo</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Masaje con movimientos de presión alta. Reduce el
                                riesgo de lesiones y acelera la recuperación muscular.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Masaje de cuerpo completo. <br>
                                2. Aromaterapia relajante <br>
                                3. Aceites relajantes <br>
                                4. Música terapéutica. <br>
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                50 Min
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $900.0 MN
                            </p>
                        </div>
                        <div class="col-4 my-auto">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/BRAZO FIRME.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/corporales/BRAZO FIRME.mp4') }}" type="video/mp4">
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

<section class="row p-2" style="background:#bc7988;">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselbrazo" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/DESPIGMENTACION CORPORAL.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/corporales/DESPIGMENTANTE CORPORAL NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselbrazo" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselbrazo" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div class="container ">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Masaje Descontracturante</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Masaje de cuerpo completo con movimientos de presión
                        alta. Ideal para liberar la tensión en articulaciones y
                        dolores musculares.                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Masaje de cuerpo completo <br>
                        2. Aromaterapia relajante <br>
                        3. Aceites relajantes <br>
                        4. Música terapéutica <br>
                    </p>
                </div>
                <div class="col-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $900.0 MN
                    </p>
                </div>
                <div class="col-4 my-auto">
                    <a href="" class="btn_comprar_paquete color_blanco">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">PMasaje Piedras Calientes</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Masaje terapéutico con piedras volcánicas a base
                                de calor
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Aromaterapia <br>
                                2. Música terpéutica <br>
                                3. Masaje terapéutico <br>
                                4. Aceite relax <br>
                                5. Ultrasonido <br>
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                80 Min
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $1,350.0 MN
                            </p>
                        </div>
                        <div class="col-4 my-auto">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselpompi" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/POMPILEVANTA.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/corporales/POMPILEVANTA .mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselpompi" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselpompi" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>

<section class="row p-2" style="background:#bc7988;">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselDespigmentacion" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/REDUCTIVO COLOMBIANO.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/corporales/reductivo.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Masaje Relajante</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Masaje terapéutico de cuerpo completo, con
                        movimientos de presión suave y ritmo lento que
                        ayuda a relajar los músculos del sistema nervioso.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Masaje de cuerpo completo <br>
                        2. Aromaterapia relajante <br>
                        3. Aceites relajantes <br>
                        4. Música terpéutica <br>
                    </p>
                </div>
                <div class="col-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $900.0 MN
                    </p>
                </div>
                <div class="col-4 my-auto">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">Masaje Antiestrés</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Masaje terapéutico con movimientos de presión
                                media, que ayudan a relajar los músculos y el
                                sistema nervioso.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Masaje de cuerpo completo <br>
                                2. Aromaterapia relajante <br>
                                3. Velas de Karité hechas de infusión relajante <br>
                                herbal o de café. <br>
                                4. Música terapéutica <br>
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                60 Min
                            </p>
                        </div>
                        <div class="col-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $900.0 MN
                            </p>
                        </div>
                        <div class="col-4 my-auto">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselpompilevanta" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/ANTICELULITICO PIERNAS CANSADAS.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/corporales/ANTICELULITICO NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>


<section class="parallax" style="background-image: url('{{ asset('assets/landing/parallax_cuerpo.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-2 my-2 text-center">
            <h3 class="display-5 fw-bold tittle_section_para">
                <br> Ciuda de tu cuerpo <br> Es el Templo que Habitas <br>
            </h3>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4 text_section_para">
                -
            </p>
            </div>
        </div>

    </div>

</section>

@endsection
