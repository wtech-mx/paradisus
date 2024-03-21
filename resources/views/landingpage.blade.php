@extends('layouts.app_landing')

@section('content')

<style>

.carousel-control-prev, .carousel-control-next {
    width: 7%;
}

</style>

<section class="parallax" style="background-image: url('{{ asset('assets/landing/bg1.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero"> ¡BIENVENIDAS AL PARAÍSO!</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">
                ¿Te gustaría pasar un momento especial, relajarte, consentirte, cuídarte y
                amarte, en un ambiente totalmente pensado en tu bienestar?
              </p>

              <p class="text_hero">Llegaste al lugar indicado!</p>

              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn px-4 btn_cta">Agendar una cita</button>
              </div>
            </div>
          </div>

    </div>

  </section>

  <section class="row">
        <div class="col-6 my-auto">

            <div class="container p-5">
                <h3 class="tittle_paradisus_section text-center">Paradisus</h3>
                <p class="text-center subtext_paradisus">
                    Nuestra misión y compromiso con ustedes
                    es, brindarles un excelente servicio, con los
                    mejores productos, instalaciones y aparatología
                    de Vanguardia, siempre pensando en el bienestar
                    y comodidad de nuestros clientes.
                </p>
            </div>

        </div>

        <div class="col-6">
            <div id="carouselExample" class="carousel slide">

                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{ asset('assets/landing/CARRUSEL_FOTOS/carusel_1.webp') }}" class="d-block w-100 p-5" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="{{ asset('assets/landing/CARRUSEL_FOTOS/carusel_2.webp') }}" class="d-block w-100 p-5" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="{{ asset('assets/landing/CARRUSEL_FOTOS/carusel_3.webp') }}" class="d-block w-100 p-5" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="{{ asset('assets/landing/CARRUSEL_FOTOS/carusel_4.webp') }}" class="d-block w-100 p-5" alt="...">
                  </div>

                  <div class="carousel-item ">
                    <img src="{{ asset('assets/landing/CARRUSEL_FOTOS/carusel_5.webp') }}" class="d-block w-100 p-5" alt="...">
                  </div>

                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 40px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                    <span class="visually-hidden">Antes</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 40px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                    <span class="visually-hidden">Despues</span>
                </button>

              </div>
        </div>

  </section>

  <section class="parallax" style="background-image: url('{{ asset('assets/landing/bg2.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-2 my-2 text-center">
            <h1 class="display-5 fw-bold tittle_section_para">Invierte en ti, <br> sin culpa.</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead mb-4 text_section_para">
                Cuidarte no es un Lujo, es una necesidad
              </p>
            </div>
          </div>

    </div>

  </section>

  <section class="row">

    <div class="col-12">
        <div class="d-flex justify-content-center">
            <h3 class="box_tittle mt-5 mb-5">Productos</h3>
        </div>
    </div>

    <div class="col-12">

        <div id="carouselProducts" class="carousel slide">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselProducts" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselProducts" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselProducts" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">

              <div class="carousel-item active">

                <div class="row">

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/ACIDO-HIALURONICO-SHAMPOO.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/acnes-shampoo.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/ACNEYING.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                </div>

              </div>

              <div class="carousel-item ">

                <div class="row">

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BB-ANTIAGING-60ML.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BLACK-MASK.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BTOX-SERUM-CREAM.webp') }}" class="d-block m-auto" alt="..." style="width:200px">
                    </div>

                </div>

              </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProducts" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselProducts" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                <span class="visually-hidden">Despues</span>
            </button>

          </div>

    </div>

</section>

<section class="row mt-5">

    <div class="col-6">
        <img src="{{ asset('assets/landing/logo_democosmetics.png') }}" class="d-block m-auto" alt="..." style="width:200px">

    </div>

    <div class="col-6 my-auto">
        <div class="container">
            <p class="text-center text_subfooter">
                Trabajamos de la mano con los productos de: <br>
                <strong>Naturales Ain Spa Dermocosmetics.</strong> <br>
                Empresa líder en su ramo, de productos Dermocosmecéuticos,
                con más de 30 años en el mercado y avalada ante <strong>COFEPRIS</strong>
            </p>
        </div>
    </div>

</section>

@endsection
