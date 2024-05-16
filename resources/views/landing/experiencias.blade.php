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

                <h4 class="service_title text-center mt-4 mb-4">¿CÓMO QUIERES RELAJARTE HOY?</h4>

                <div class="row d-flex justify-content-between">

                        <div class="col-6  col-md-2 col-lg-2 border_selecionador" >
                            <p class="text-center">
                                <a href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_EXPERIENCIAS.png') }}" class="" alt="..." style="width: 150px">
                                </a>
                                <a  href="{{ route('experiencias.landingpage') }}" class="texo_services_icons">
                                    <br>Experiencias
                                </a>
                            </p>
                            <img src="{{ asset('assets/landing/ICONOS_BOTONES/click.png') }}" id="movingImage" style="position: relative;width: 90px;top: -146px;left: 80px;">

                        </div>

                        <div class="col-6  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/BOTON_CORPORALES.png') }}" class="" alt="..." style="width: 150px">
                                </a>
                                <a href="{{ route('masajes.landingpage') }}" class="texo_services_icons">
                                    <br>Masajes con tu <br> Persona favorita
                                </a>
                            </p>
                        </div>

                        <div class="col-12  col-md-2 col-lg-2">
                            <p class="text-center">
                                <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                    <img src="{{ asset('assets/landing/ICONOS_BOTONES/icono-anillo.png') }}" class="" alt="..." style="width: 150px">
                                </a>
                                <a href="{{ route('dayspa.landingpage') }}" class="texo_services_icons">
                                    <br>Day Spa
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


<section class="row" style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,149.3C384,139,480,117,576,106.7C672,96,768,96,864,106.7C960,117,1056,139,1152,138.7C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
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
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete">
                                Agendar
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $2,100.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP_MAMA_E_HIJA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0 " alt="">
                    </div>
                </div>
            </div>


          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/EXP_HERMANAS.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0 " alt="">
                    </div>
                </div>
            </div>


          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
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
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete">
                                Agendar
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $2,100.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>


</section>

<section class="row p-2" style="background-color: #CB95A2">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,213.3C384,224,480,224,576,192C672,160,768,96,864,80C960,64,1056,96,1152,101.3C1248,107,1344,85,1392,74.7L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

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
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete">
                                Agendar
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $2,100.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP_MEJORES_AMIGAS.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0 " alt="">
                    </div>
                </div>
            </div>


          </div>
    </div>
</section>

<section class="row p-2" style="">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#CB95A2" fill-opacity="1" d="M0,160L48,181.3C96,203,192,245,288,250.7C384,256,480,224,576,186.7C672,149,768,107,864,90.7C960,75,1056,85,1152,74.7C1248,64,1344,32,1392,16L1440,0L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 my-auto animated-slide-in">
        <div id="carouselMini" class="carousel slide">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 50px;left: 0px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 0px;left: -30px;">
            <img src="{{ asset('assets/landing/DESTELLO_WHITE.webp') }}" id="movingImage" style="position: relative;width: 90px;top: 10px;left: -40px;">
            <div class="carousel-inner">
                <div class="carousel-item active ">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('assets/landing/experiencias/EXP_PAREJA.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0 " alt="">
                    </div>
                </div>
            </div>


          </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 order-1 order-md-2 order-lg-2 my-auto">
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
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete">
                                Agendar
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete" style="background-color: #CB95A2;color:#fff;">
                               <strong> $3,150.0 MN</strong>
                            </a>
                        </div>

                    </div>
                </div>
    </div>
</section>

<section class="row p-2 " style="background-color: #CB95A2">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" style="margin: -10px 0px 0px 0px;padding: 0;"><path fill="#fff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,176C384,171,480,181,576,160C672,139,768,85,864,64C960,43,1056,53,1152,58.7C1248,64,1344,64,1392,64L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
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
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete">
                                Agendar
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-6 mb-4 mb-md-3 mb-lg-4">
                            <a href="" class="btn_comprar_paquete" style="background-color: #fff;color:#CB95A2;">
                               <strong> $3,150.0 MN</strong>
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
                        <img src="{{ asset('assets/landing/experiencias/EXP_MEJORES_AMIGAS_TRIO.jpg') }}" class="img_corporales ligthbox_img mb-5 mb-md-2 mb-lg-0 mt-5 mt-md-2 mt-lg-0 " alt="">
                    </div>
                </div>
            </div>


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
