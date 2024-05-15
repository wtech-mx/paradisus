@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/tratamientos.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">TRATAMIENTOS CORPORALES </h1>
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

<section class="row p-2 ">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left ">CORPORALES</h3>
                    <h3 class="service_title mb-3">Brazo Firme RXZ</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento ideal para redur la falcidez, tensión y pegar
                                la piel mediante un masaje reductivo en zona de brazos.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Masaje reductivo en brazos. <br>
                                2. Gel calorífico. <br>
                                3. Aceite de Café <br>
                                4. Drenaje en brazos con vendas. <br>
                                5. Crema modeladora con algas
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                45 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $825.0 MN
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                    <p class="mini_subtext_paradisus mt-3">
                        Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                        al terminar tu tratamiento.
                        Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                    </p>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselMini" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner" style="">

                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/BRAZO_FIRME.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/BRAZO_FIRME.mp4') }}" type="video/mp4">
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

<section class="row p-2 " style="background:#bc7988;" >

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;">
        <path fill="#ffffff" fill-opacity="1" d="M0,32L48,80C96,128,192,224,288,261.3C384,299,480,277,576,266.7C672,256,768,256,864,240C960,224,1056,192,1152,186.7C1248,181,1344,203,1392,213.3L1440,224L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
        </path>
    </svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto">
        <div id="carouselbrazo" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/DESPIGMENTACION_CORPORAL.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/DESPIGMENTANTE_CORPORAL_NUEVO.mp4') }}" type="video/mp4">
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

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
        <div class="container ">
            <h3 class="tittle_lase_section text-left color_blanco">CORPORALES</h3>
            <h3 class="service_title mb-3 color_blanco">Despigmentación Corporal</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Aclara de forma natural. Ve resultados desde la primera sesión. Puedes elegir 2 zonas a tratar.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Axila <br>
                        2. Entrepierna <br>
                        3. Codos <br>
                        4. División entre glúteo y muslo <br>
                        5. Cuello <br>
                        6. Rodillas <br>
                        Se recomiendan entre 4 a 5 sesiones para máximos resultados.
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        50 min
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $1,050.0 MN
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                    <a href="" class="btn_comprar_paquete color_blanco">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,165.3C384,139,480,85,576,74.7C672,64,768,96,864,101.3C960,107,1056,85,1152,106.7C1248,128,1344,192,1392,224L1440,256L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">CORPORALES</h3>
                    <h3 class="service_title mb-3">Pompilevanta con Vacumterapia</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento ideal para levantar glúteos, estimular el sistema circulatorio y tonificar.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de glúteos. <br>
                                2. Exfoliación <br>
                                3. Coctelería de geles reafirmzantes <br>
                                4. Vacumterapia <br>
                                5. Aceite de café <br>
                                6. Masaje drenante <br>
                                7. Lociones criógenas <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                50 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $1,200.0 MN
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselpompi" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/POMPILEVANTA.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/POMPILEVANTA.mp4') }}" type="video/mp4">
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
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,288L48,277.3C96,267,192,245,288,224C384,203,480,181,576,186.7C672,192,768,224,864,208C960,192,1056,128,1152,117.3C1248,107,1344,149,1392,170.7L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto">
        <div id="carouselDespigmentacion" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/REDUCTIVO_COLOMBIANO.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
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

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">CORPORALES</h3>
            <h3 class="service_title mb-3 color_blanco">Reductivo Colombiano</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Tratamiento ideal para eliminar cúmulos de grasa. Estiliza el contorno de la figura logrando una silueta más estética.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Reduce grasa acumulada. <br>
                        2. Estiliza el cuerpo. <br>
                        3. Reduce la grasa. <br>
                        4. Combate la celulitis. <br>
                        5. Beneficia la Circulación Sanguínea. <br>
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        50 min
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $975.0 MN
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,32L48,58.7C96,85,192,139,288,160C384,181,480,171,576,144C672,117,768,75,864,80C960,85,1056,139,1152,144C1248,149,1344,107,1392,85.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">CORPORALES</h3>
                    <h3 class="service_title mb-3">Anticelulítico y piernas Cansadas</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                ¿Cansancio y pesadez? Tratamiento ideal para la circulación sanguínea, anticelulítico y criógeno.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza de glúteos. <br>
                                2. Lociones Criógenas Anticelulíticas <br>
                                3. Aplicación de vendas frías <br>
                                4. Hielo corporal en piernas <br>
                                5. Aceite de Café y masaje drenante <br>
                                6. Crema de algas marinas. <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                60 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $1,125.0 MN
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselpompilevanta" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/ANTICELULITICO.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/ANTICELULITICO_NUEVO.mp4') }}" type="video/mp4">
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

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,192L48,192C96,192,192,192,288,186.7C384,181,480,171,576,165.3C672,160,768,160,864,160C960,160,1056,160,1152,133.3C1248,107,1344,53,1392,26.7L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto">
        <div id="carouselmadero" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/MADEROTERAPIA.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/MADEROTERAPIA.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselmadero" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselmadero" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">CORPORALES</h3>
            <h3 class="service_title mb-3 color_blanco">Maderoterapia</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Masaje empleando diferentes utensilios de madera
                        para equilibrar la energía del paciente.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Zonas a tratar:</h3>
                    <p class="subtext_lase color_blanco">
                        1. Reafirma <br>
                        2. Tonifica <br>
                        3. Favorece la circulación sanguínea <br>
                        4. Combate la celulitis <br>
                        5. Combate dolores de cuello y espalda <br>
                        6. Mejora la respiración <br>
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        60 min
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $900.0 MN
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                    <a href="" class="btn_comprar_paquete">Agendar</a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="row p-2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#bc7988" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
                <div class="container">
                    <h3 class="tittle_lase_section text-left">CORPORALES</h3>
                    <h3 class="service_title mb-3">Velo de Novia</h3>
                    <div class="row">
                        <div class="col-12 my-auto">
                            <p class="subtext_lase">
                                Tratamiento ideal para lucir una piel radiante. Hidrata,
                                humecta y da suavidad a la piel. Incluye exfoliación corporal.
                            </p>
                            <h3 class="service_title mb-3">Procedimiento</h3>
                            <p class="subtext_lase">
                                1. Limpieza corporal. <br>
                                2. Exfoliación con Perlas Corporales. <br>
                                3. Aceite de Manzana Verde <br>
                                4. Aplicación de Fango Exotic con Oro <br>
                                5. Seda en Leche <br>
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Duración :</h3>
                            <p class="subtext_lase">
                                80 Min
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4">
                            <h3 class="service_title mb-3">Costo : </h3>
                            <p class="subtext_lase">
                                $1,650.0 MN
                            </p>
                        </div>
                        <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
                            <a href="" class="btn_comprar_paquete">Agendar</a>
                        </div>
                    </div>
                </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-auto">
        <div id="carouselVelo" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/VELO_DE_NOVIA.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/VELO_DE_NOVIA.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselVelo" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselVelo" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>
</section>

<section class="row p-2" style="background:#bc7988;">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,250.7C384,256,480,224,576,186.7C672,149,768,107,864,90.7C960,75,1056,85,1152,74.7C1248,64,1344,32,1392,16L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto">
        <div id="carouseldiez" class="carousel slide">

            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">

            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/corporales/GLUTEOS_DE_10.jpg') }}" class="img_corporales ligthbox_img" alt="">
                    </div>
                </div>

                <div class="carousel-item ">
                    <div class="d-flex justify-content-center">
                        <video width="350" controls autoplay class="ligthbox_img">
                            <source src="{{ asset('assets/landing/corporales/GLÚTEOS DE 10 NUEVO.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouseldiez" data-bs-slide="prev">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Antes</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouseldiez" data-bs-slide="next">
                <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;">
                <span class="visually-hidden">Despues</span>
            </button>

          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
        <div class="container">
            <h3 class="tittle_lase_section text-left color_blanco">CORPORALES</h3>
            <h3 class="service_title mb-3 color_blanco">Glúteos de 10</h3>
            <div class="row">
                <div class="col-12 my-auto">
                    <p class="subtext_lase color_blanco">
                        Procedimiento que se realiza por medio de un masaje
                        manual, logrando mejor textura, apariencia de la piel,
                        volumen de glúteo y flacidez.
                    </p>
                    <h3 class="service_title mb-3 color_blanco">Procedimiento</h3>
                    <p class="subtext_lase color_blanco">
                        1. Limpieza corporal. <br>
                        2. Coctelería de geles reductivos <br>
                        3. Aceite de Café <br>
                        4. Levantamiento manual <br>
                        5. Drenaje Corporal <br>
                        6. Lociones Criógenas <br>
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Duración :</h3>
                    <p class="subtext_lase color_blanco">
                        50 Min
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4">
                    <h3 class="service_title mb-3 color_blanco">Costo : </h3>
                    <p class="subtext_lase color_blanco">
                        $1,050.0 MN
                    </p>
                </div>
                <div class="col-6 col-md-6 col-lg-4 my-auto mb-5">
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
