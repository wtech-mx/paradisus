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
                <a href="https://www.wa.link/tiys58" target="_blank" class="btn px-4 btn_cta">Agendar una cita</a>
                <a type="button" class="btn px-4 btn_cta" href="{{ route('index_contacto.landingpage') }}">Conocenos</a>
              </div>
            </div>
          </div>

    </div>

</section>

  <section class="row">
        <div class="col-12 my-auto">

            <div class="container p-0 p-sm-0 p-md-3 p-lg-5">

                <h4 class="service_title text-center mt-3">Nuestros Servicios :</h4>

                <div class="row d-flex justify-content-between">

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('index_laser.landingpage') }}">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_DEPILACION_LASER.png') }}" class="d-block w-100" alt="...">
                                </a>
                                <a href="{{ route('index_laser.landingpage') }}" class="texo_services_icons">
                                    Depilación Láser
                                </a>
                            </p>
                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_CORPORALES.png') }}" class="w-100" alt="...">
                                </a>
                                <a href="{{ route('tratamientos_corporales.landingpage') }}" class="texo_services_icons">
                                    Corporales
                                </a>
                            </p>
                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_FACIALES.png') }}" class="w-100" alt="...">
                                <a href="{{ route('tratamientos_faciales.landingpage') }}" class="texo_services_icons">
                                    Faciales
                                </a>
                            </p>
                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_EXPERIENCIAS.png') }}" class="w-100" alt="...">
                                <a href="" class="texo_services_icons">
                                    Experiencias
                                </a>
                            </p>
                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_PAQUETES.png') }}" class="w-100" alt="...">
                                <a href="" class="texo_services_icons">
                                    Paquetes
                                </a>
                            </p>
                        </div>

                </div>

            </div>

        </div>

  </section>

  <section class="row">
    <div class="col-12 my-auto">

        <div class="container p-0 p-sm-0 p-md-3 p-lg-5">

            <h4 class="service_title text-center mb-5">¿Que Opinan nuestros Clientes?</h4>

            <div class="row">
                <div class="col-12">

                    <div id="carouselComentarios" class="carousel slide">


                        <div class="carousel-inner">

                          <div class="carousel-item active">

                            <div class="row">

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                            Excelente servicio del personal, instalaciones limpias se cumplió lo establecido en sus publicaciones de redes sociales!!! Si regreso, todo excelente
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong> Victoria Vargas</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                            La atención es genial y todas las chicas son super amables, el tratamiento estético que me hice fue super rápido y muy profesional
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong>Alfonso Rios</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                            Me gusta mucho su concepto, el trato es muy bueno, la verdad el
                                            Personal es muy capacitado y súper eficiente
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong>Florencia Maguey Moreno</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                            </div>

                          </div>

                          <div class="carousel-item ">

                            <div class="row">

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                            Lo recomiendo mucho, el personal es muy amable en todo momento y las instalaciones están muy limpias, el servicio 10/10 sin duda son mi nuevo lugar favorito para relajarme y siempre tienen buenas promociones superaron mis expectativas
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong>Eduardo Chávez</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                           Tomé el curso de limpieza profunda y me encantó. El trato de todos siempre fue muy amable, abiertos a preguntas, respetuosos y con mucha información valiosa. Me gustó mucho que venden productos de alta calidad y a un precio mucho más accesible que el mercado. Yo no me dedico a esto, pero creo que es una buena opción para adentrarte al mundo de la cosmetología. 100% recomendado.
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong>Karen Vallejo</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
                                    <div class="container_comentario mb-3 mb-md-0 md-lg-0">
                                        <p class="text-left text_comentario">
                                            Me encantó el servicio una experiencia que toda mujer debe sentir
                                        </p>
                                        <p class="text-left text_autor">
                                           <strong>Diana Elena Bautista González</strong>
                                        </p>
                                        <p class="text-left">
                                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/clasificacion.png') }}" class="" style="width: 100px">
                                        </p>
                                    </div>
                                </div>

                            </div>

                          </div>

                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselComentarios" data-bs-slide="prev">
                            <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                            <span class="visually-hidden">Antes</span>
                        </button>

                        <button class="carousel-control-next" type="button" data-bs-target="#carouselComentarios" data-bs-slide="next">
                            <img src="{{ asset('assets/landing/btn_carousel.webp') }}" alt="Previous" style="width: 30px;"> <!-- Reemplaza 'ruta/a/tu/imagen/arrow-left.png' con la ruta a tu imagen de flecha izquierda -->
                            <span class="visually-hidden">Despues</span>
                        </button>

                      </div>

                </div>
            </div>

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
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/ACIDO-HIALURONICO-SHAMPOO.webp') }}" class="img_productos_carousel" alt="..." >
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/acnes-shampoo.webp') }}" class="img_productos_carousel" alt="..." >
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/ACNEYING.webp') }}" class="img_productos_carousel" alt="..." >
                    </div>

                </div>

              </div>

              <div class="carousel-item ">

                <div class="row">

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BB-ANTIAGING-60ML.webp') }}" class="img_productos_carousel" alt="..." >
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BLACK-MASK.webp') }}" class="img_productos_carousel" alt="..." >
                    </div>

                    <div class="col-4 ">
                        <img src="{{ asset('assets/landing/CARRUSEL_PRODUCTOS/BTOX-SERUM-CREAM.webp') }}" class="img_productos_carousel" alt="..." >
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

    <div class="col-4 col-sm-5 col-md-5 col-lg-5 my-auto">
        <img src="{{ asset('assets/landing/logo_democosmetics.png') }}" class="d-block m-auto logo_democosmetic" alt="...">

    </div>

    <div class="col-8 col-sm-7 col-md-7 col-lg-7 my-auto">
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
