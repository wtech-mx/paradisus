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
                <a href="https://www.wa.link/tiys58" target="_blank" class="btn px-4 btn_cta">Ver Catalogo</a>
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,58.7C480,53,600,43,720,48C840,53,960,75,1080,74.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto ">
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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/ADIOS_ACNE.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,250.7C384,256,480,224,576,186.7C672,149,768,107,864,90.7C960,75,1056,85,1152,74.7C1248,64,1344,32,1392,16L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/ADIOS_IMPUREZAS.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>

</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,165.3C384,139,480,85,576,74.7C672,64,768,96,864,101.3C960,107,1056,85,1152,106.7C1248,128,1344,192,1392,224L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/ADIOS_MANCHAS.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/HIDRATACION_MAXIMA.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L60,170.7C120,181,240,203,360,202.7C480,203,600,181,720,160C840,139,960,117,1080,96C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">MI ROSTRO PERFECTO</h3>
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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3000.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/MI_ROSTRO_PERFECTO.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,256L60,250.7C120,245,240,235,360,202.7C480,171,600,117,720,101.3C840,85,960,107,1080,144C1200,181,1320,235,1380,261.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
    <div class="col-12 mt-5 mb-5">
           <h3 class="tittle_lase_section text-center">Paquetes Corporales</h3>
    </div>
</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,32L60,32C120,32,240,32,360,58.7C480,85,600,139,720,170.7C840,203,960,213,1080,186.7C1200,160,1320,96,1380,64L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left color_blanco">Brazos definidos</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 color_blanco">INCLUYE</h3>
                            <p class="subtext_lase color_blanco">
                                · 5 Sesiones de Vacumterapia <br>
                                · 2 Sesiones de Electroestimulación <br>
                                · 2 Sesiones de Radiofrecuencia <br>
                                · 3 Sesiones de Maderoterpia o Manual <br>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                                De : $5,200.0 <br>
                                <strong>A : $4,800.0</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/BRAZOS_DEFINIDOS.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,64L60,74.7C120,85,240,107,360,117.3C480,128,600,128,720,122.7C840,117,960,107,1080,138.7C1200,171,1320,245,1380,282.7L1440,320L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/MOLDEANTE_Y_REDUCTIVO.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left ">Modelante y Reductivo</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <h3 class="service_title mb-3 ">INCLUYE</h3>
                            <p class="subtext_lase ">
                                · 6 Sesiones de Reductivo Colombiano <br>
                                · 6 Sesiones de Vacumterapia <br>
                                ·6 Sesiones de Electroestimulación <br>
                            </p>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                                De : $6,000.0 <br>
                                <strong>A : $5,400.0</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,64L60,69.3C120,75,240,85,360,80C480,75,600,53,720,80C840,107,960,181,1080,186.7C1200,192,1320,128,1380,96L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
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
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/PIERNAS_DE_10.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,224L60,186.7C120,149,240,75,360,37.3C480,0,600,0,720,5.3C840,11,960,21,1080,32C1200,43,1320,53,1380,58.7L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/DESPIGMENTACI_N_CORPORAL.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,64L60,64C120,64,240,64,360,58.7C480,53,600,43,720,48C840,53,960,75,1080,74.7C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>
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
                        <div class="col-6 mb-3">
                            <a href="" class="btn_comprar_paquete">
                                Comprar paquete
                            </a>
                        </div>
                        <div class="col-6 mb-3">
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
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/paquetes/TU_FIGURA_IDEAL_CON_APARATOLOGIA.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>
            </div>

          </div>
    </div>
</section>

@endsection
