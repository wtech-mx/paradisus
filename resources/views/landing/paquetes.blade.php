@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/paquetes/IMAGEN PORTADA PAQUETES.jpg') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">PAQUETES COMPLETOS</h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">
                Si prefieres un plan armado para tus necesidades, tmabién
                contamos con paquetes faciales y corporales, armados para
                zonas más específicas y si lo deseas, también podemos
                personalizar algún paquete que se adecúe a lo que buscas.
              </p>

              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn px-4 btn_cta">Ver Catalogo</button>
              </div>
            </div>
          </div>

    </div>

</section>

<section class="row p-2">
    <div class="col-12 mt-5 mb-5">
           <h3 class="tittle_lase_section text-center">Paquetes Faciales</h3>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Adiós al Acné</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                · 5 Sesiones Facial Antiacné <br>
                                · 1 Sesión Facial Antiacné de regalo <br>
                                · 1 Solución Facial Antiacné de regalo <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/ADIOS ACNE.jpg') }}" class="img_corporales p-3" alt="">
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
                        <img src="{{ asset('assets/landing/paquetes/ADIOS IMPUREZAS.jpg') }}" class="img_corporales p-3" alt="">
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
                    <h3 class="tittle_lase_section text-left ">Adiós impurezas</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                · 5 Sesiones Limpieza Profunda <br>
                                · 1 Sesión Limpieza Profunda de regalo <br>
                                · 1 Mascarilla contra impurezas de regalo <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Adiós Manchas</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                5 Sesiones Facial Despigmentante <br>
                                · 1 Sesión Facial Despigmentante de regalo <br>
                                · 1 Loción White de regalo <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/ADIOS MANCHAS.jpg') }}" class="img_corporales p-3" alt="">
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
                        <img src="{{ asset('assets/landing/paquetes/HIDRATACION MAXIMA.jpg') }}" class="img_corporales p-3" alt="">
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
                    <h3 class="tittle_lase_section text-left ">Hidratación Máxima</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                · 5 Sesiones Facial Hidratante <br>
                                · 1 Sesión Facial Hidratante de regalo <br>
                                · 1 Loción Hidratante de regalo <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">MI ROSTRO PERFECTO POST</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                · 3 Sesiones Microdermoabrasión, Ultrasonido
                                y Mascarilla Plástica <br>
                                · 2 Sesiones Piel Radiante con Cromoterapia <br>
                                · 1 Sesión Facial Peeling con Skin Scrubber <br>
                                · 1 Facial a elegir de regalo <br>
                                · 1 Shampoo Facial de regalo <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/MI ROSTRO PERFECTO POST.jpg') }}" class="img_corporales p-3" alt="">
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

<section class="row p-2">
    <div class="col-12 mt-5 mb-5">
           <h3 class="tittle_lase_section text-center">Paquetes Corporales</h3>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Brazos definidos</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">

                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $ MN</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/BRAZOS DEFINIDOS.jpg') }}" class="img_corporales p-3" alt="">
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
                        <img src="{{ asset('assets/landing/paquetes/MOLDEANTE Y REDUCTIVO.jpg') }}" class="img_corporales p-3" alt="">
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
                    <h3 class="tittle_lase_section text-left ">Modelante y Reductivo</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">

                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Piernas de 1o</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                · 5 Sesiones Anticelulíticas Manual o
                                con Maderoterapia <br>
                                · 5 Sesiones Aparatología (personalizada) <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                                De : $4,900.0 <br>
                                <strong>A : $3,400.0</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/PIERNAS DE 10.jpg') }}" class="img_corporales p-3" alt="">
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
                        <img src="{{ asset('assets/landing/paquetes/MOLDEANTE Y REDUCTIVO.jpg') }}" class="img_corporales p-3" alt="">
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
                    <h3 class="tittle_lase_section text-left ">Despigmentación Corporal</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                · 5 Sesiones Dermapen Corporal <br>
                                · 5 Sesiones Fangoterapia con ácidos <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                                De : $4,000.0 <br>
                                <strong>A : $3,400.0</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Tu figura ideal con Aparatología</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                · 5 Sesiones RXZ Cavitación Corporal <br>
                                · 5 Sesiones Radiofrecuencia Corporal <br>
                                · 5 Sesiones Pompilevanta con Vacumterapia <br>
                            </p>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                                De : $10,350.0 <br>
                                <strong>A : $7,000.0</strong>
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
                        <img src="{{ asset('assets/landing/paquetes/TU FIGURA IDEAL.jpg') }}" class="img_corporales p-3" alt="">
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

@endsection
