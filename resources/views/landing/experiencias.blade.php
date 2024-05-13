@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/bg1.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">EXPERIENCIAS</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">
                Nuestras experiencias son creadas para que pases un
                momento único, junto a tu o tus personas favoritas,
                o siemplemente tú sola/o en un ambiente de paz,
                armonía, relajación y mimos.
              </p>

              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a type="button" class="btn px-4 btn_cta" href="{{ route('index_contacto.landingpage') }}">Solicitar informacion</a>
              </div>
            </div>
          </div>

    </div>

</section>

  <section class="row">
        <div class="col-12 my-auto">

            <div class="container p-0 p-sm-0 p-md-3 p-lg-5">

                <h4 class="service_title text-center mt-3">¿CÓMO QUIERES RELAJARTE HOY?</h4>

                <div class="row d-flex justify-content-between">

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_EXPERIENCIAS.png') }}" class="w-100" alt="...">
                                </a>
                                <a  href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                    Experiencias
                                </a>
                            </p>
                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_CORPORALES.png') }}" class="w-100" alt="...">
                                </a>
                                <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                    Masajes con tu <br> Persona favorita
                                </a>
                            </p>
                        </div>


                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/icono-anillo.png') }}" class="w-100" alt="...">
                                </a>
                                <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                    Day Spa
                                </a>
                            </p>
                        </div>

                </div>

            </div>

        </div>

  </section>

  <section class="row p-2">
    <div class="col-12 mt-5 mb-5">
           <h3 class="tittle_lase_section text-center">Experiencias con tus <br>personas favoritas</h3>
    </div>
</section>


<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Mamá e Hija</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos y pies. <br>
                                4. Vino & choclates en nuestra
                                zona de descanso. <br>
                                5. Aromaterapia & música relajante. <br>
                                6. Obsequio, Cuarzo familiar. <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Agendar Experiencia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $2,100.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP MAMA E HIJA.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>
            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2" style="">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/EXP HERMANAS.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>
            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left ">Hermanas</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos y pies. <br>
                                4. Vino & choclates en nuestra
                                zona de descanso. <br>
                                5. Aromaterapia & música relajante. <br>
                                6. Obsequio, Cuarzo familiar. <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Agendar Experiencia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $2,100.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Mejores Amigas</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos y pies. <br>
                                4. Vino & choclates en nuestra
                                zona de descanso. <br>
                                5. Aromaterapia & música relajante. <br>
                                6. Obsequio, Cuarzo de amistad. <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Agendar Experiencia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $2,100.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP MEJORES AMIGAS.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>
            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2" style="">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/EXP PAREJA.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>
            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left ">Pareja</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos y pies. <br>
                                4. Vino & choclates en nuestra
                                zona de descanso. <br>
                                5. Aromaterapia & música relajante. <br>
                                6. Obsequio, Cuarzo de amor. <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Agendar Experiencia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3,150.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Mejores Amigas Trío</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                1. Masaje a elegir. <br>
                                2. Facial a elegir. <br>
                                3. Exfoliación de manos y pies. <br>
                                4. Vino & choclates en nuestra
                                zona de descanso. <br>
                                5. Aromaterapia & música relajante. <br>
                                6. Obsequio, Cuarzo de amistad. <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Agendar Experiencia
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3,150.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP MEJORES AMIGAS TRIO.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>
            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselMini" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselMini" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="parallax" style="background-image: url('{{ asset('assets/landing/parallax_cuerpo.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-2 my-2 text-center">
            <h3 class="display-5 fw-bold tittle_section_para">
                <br> Desconéctense del mundo <br> y entren al paraiso<br>
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
