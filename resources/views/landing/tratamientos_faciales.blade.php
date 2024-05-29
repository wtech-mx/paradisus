@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/bg2.webp') }}');">
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
                    <h3 class="service_title mb-3">Facial Antiacné</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento ideal para disminuir gradualmente el acné,
                                secuelas y manchas
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de rostro 2. Exfoliación <br>
                                3. Vapor de ozono <br>
                                4. Extracción de espinillas <br>
                                5. Loción Astringente
                                6. Aparatología Alta frecuencia <br>
                                7. Línea liposome con coctelería
                                de geles. <br>
                                8. Mascarilla Acneying <br>
                                9. Crema y protector solar. <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                50 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $825.0 MN
                            </p>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
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
                        <img src="{{ asset('assets/landing/faciales/ANTIACNE.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/facialeses/BRAZO FIRME.mp4') }}" type="video/mp4">
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

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselbrazo" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/faciales/MICRODEROABRASION.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/DESPIGMENTANTE CORPORAL NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}

            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselbrazo" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselbrazo" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div class="container ">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Microdermoabrasión</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Ideal para una piel más joven, suave y limpia.
                        Disminuye arrugas y cicatrices.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1.Limpieza de rostro. <br>
                        2. Shampoo Silicio <br>
                        3. Exfoliación con Gold Scrub Uva <br>
                        4. Microdermoabrasión. <br>
                        5. Mascarilla <br>
                        6. Crema y protector solar. <br>
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $1,200.0 MN
                    </p>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
                    <a href="" class="btn_comprar_paquete color_blanco">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">Limpieza Profunda</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento idea para mejorar la salud y el
                                aspecto de la piel del rostro
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de rostro <br>
                                2. Exfoliación con Gold Scrub Uva <br>
                                3. Vapor de ozono <br>
                                4. Extracción de espinillas <br>
                                5. Loción de azuleno <br>
                                6. Aparatología alta frecuencia <br>
                                7. Mascarilla Natural Mask <br>
                                8. Crema y pantalla solar <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                60 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $825.0 MN
                            </p>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
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
                        <img src="{{ asset('assets/landing/faciales/LIMPIEZA_PROFUNDA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/POMPILEVANTA .mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>
{{--
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselpompi" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselpompi" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,149.3C384,139,480,117,576,106.7C672,96,768,96,864,106.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselDespigmentacion" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/faciales/ANTIEDAD.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/reductivo.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Antiedad</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Tratamiento ideal para todo tipo de piel, oxigenante,
                        reparador y calmante.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Limpieza de rostro <br>
                        2. Exfoliación <br>
                        3. Loción Antiaging <br>
                        4. Aplicación de línea Liposome <br>
                        5. Coctelería de geles Antiedad <br>
                        6. Mascarilla Oro 24k regenerante <br>
                        7. Crema hidratante y Pantalla solar <br>

                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        50 min
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $975.0 MN
                    </p>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,160L60,170.7C120,181,240,203,360,202.7C480,203,600,181,720,160C840,139,960,117,1080,96C1200,75,1320,53,1380,42.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">Hidratante</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento ideal para todo tipo de piel,
                                reparador para rostro y cuello.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de glúteos. <br>
                                2. Exfoliación. <br>
                                3. Loción Hidratante <br>
                                4. Mascarilla Natural Mask <br>
                                5. Loción Azuleno <br>
                                6. Crema hidratante y Pantalla Solar <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                60 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $825.0 MN
                            </p>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
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
                        <img src="{{ asset('assets/landing/faciales/HIDRATANTE.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/ANTICELULITICO NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,165.3C384,139,480,85,576,74.7C672,64,768,96,864,101.3C960,107,1056,85,1152,106.7C1248,128,1344,192,1392,224L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselDespigmentacion" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/faciales/PELLING_SKIN_SCRUBBER.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/reductivo.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">

        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Peeling Skin Scrubber</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Exfolia, limpia, hidrata y apoya a la
                        regeneración celular
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Limpieza de rostro <br>
                        2. Exfoliación <br>
                        3. Uso de Vapor de Ozono <br>
                        4. Loción y Mascarilla Azuleno <br>
                        5. Gel Liposomado <br>
                        6. Pantalla Solar <br>
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $1200.0 MN
                    </p>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,186.7C384,181,480,171,576,165.3C672,160,768,160,864,160C960,160,1056,160,1152,133.3C1248,107,1344,53,1392,26.7L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">FACIALES</h3>
                    <h3 class="service_title mb-3">Piel Radiante con cromoterapia</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Logra producir más colágeno y suaviza el aspecto de
                                tus poros e impefecciones, mejorando la textura de
                                la piel
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de rostro <br>
                                2. Shampoo Silicio <br>
                                3. Exfoliación <br>
                                4. Extracción de comedones <br>
                                5. Loción y mascarilla azuleno <br>
                                6. Cromoterapia <br>
                                7. Loción BB Antiaging <br>
                                8. Crema y protector Solar <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                60 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-4 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $900.0 MN
                            </p>
                        </div>
                        <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
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
                        <img src="{{ asset('assets/landing/faciales/PIEL_RADIANTE_CON_CROMO.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/ANTICELULITICO NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselpompilevanta" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>
</section>

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselDespigmentacion" class="carousel slide">


            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/faciales/DESPIGMENTANTE.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0" alt="">
                    </div>
                </div>

                {{-- <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay>
                            <source src="{{ asset('assets/landing/faciales/reductivo.mov') }}" type="video/mp4">
                        </video>
                    </div>
                </div> --}}
            </div>

            {{-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDespigmentacion" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button> --}}

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">FACIALES</h3>
            <h3 class="service_title mb-3 color_blanco">Despigmentante</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Ideal para manchas, despigmentación para
                        pieles maduras y/o sensibles.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Limpieza de rostro <br>
                        2. Exfoliación con ácido láctico <br>
                        3. Loción de Azuleno <br>
                        4. Aplicación de AHA’S (ácido glicólico) <br>
                        5. Tónico Hidratante <br>
                        6. Mascarilla Facial Ice <br>
                        7. Crema hidratante y Protector Solar <br>
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-6 col-md-4 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $975.0 MN
                    </p>
                </div>
                <div class="col-12 col-md-4 col-lg-4 mb-4 mb-md-0 mb-lg-0">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

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
