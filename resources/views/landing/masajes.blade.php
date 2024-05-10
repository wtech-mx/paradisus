@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/tratamientos.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">MASAJES </h1>
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

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouseparejas" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE MAMA E HIJA.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouseparejas" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouseparejas" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE MEJORES AMIGAS TRIO.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouseparejas" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE PAREJA.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

            </div>


            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouseparejas" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouseparejas" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/MASAJE MEJORES AMIGAS.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
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
                    <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                    <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                        $1,300.0
                    </a>
                </div>

            </div>
        </div>
</div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
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
                            <a href="" class="btn_comprar_paquete text-center w-100 mb-2 mb-md-3 mb-lg-4">Agendar</a>

                            <a href="" class="btn_comprar_paquete text-center w-100" style="color:#fff;">
                                $1,300.0
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
                        <img src="{{ asset('assets/landing/experiencias/MASAJE MEJORES AMIGAS TRIO.jpg') }}" class="img_corporales p-3" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/experiencias/DAY SPA CUMPLEAÑOS 2024.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
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

@endsection
