@extends('layouts.app_landing')

@section('content')


<section class="parallax" style="background-image: url('{{ asset('assets/landing/bg1.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold tittle_hero">DEPILACIÓN LÁSER </h1>
            <div class="col-lg-6 mx-auto">
              <p class="lead text_hero mb-4 ">
                Traemos para el cuidado de tu piel, la última tecnología
                    CUATRIDIODO, para eliminar los molestos vellos y decirle
                    adiós a la irritación por el rastrillo y métodos de depilación
              </p>

              <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn px-4 btn_cta">Solicitar Informacion</button>
              </div>
            </div>
          </div>

    </div>

  </section>

  <section class="row">
    <div class="col-6 my-auto">

        <div class="container">
            <h3 class="tittle_paradisus_section text-center">Paquetes</h3>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                    Mini
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                    Pequeño
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                    Mediano
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false">
                    Grande
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-vellos-tab" data-bs-toggle="pill" data-bs-target="#pills-vellos" type="button" role="tab" aria-controls="pills-vellos" aria-selected="false">
                      Adios Vellos
                    </button>
                  </li>
              </ul>

        </div>

    </div>

    <div class="col-6">
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

            <div class="row">
                <div class="col-7">
                    <div class="container">
                        <h3 class="service_title mb-3">24 Sesiones 2 Zonas Mini a elegir: </h3>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <p class="subtext_lase">
                                    1. Manos 5. Bigote <br>
                                    2. Frente   6. Mentón <br>
                                    3. Patillas  7. Línea Alba <br>
                                    4. Mejilla  8. Pies
                                </p>
                            </div>
                            <div class="col-6">
                                <h5 class="precio_laser mb-4"> $2,160 </h5>
                                <a href="" class="btn_comprar_paquete">Comprar Paquete</a>
                            </div>
                        </div>
                        <p class="mini_subtext_paradisus mt-3">
                            Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                            al terminar tu tratamiento.
                            Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                        </p>
                    </div>

                </div>

                <div class="col-5">
                    <img src="{{ asset('assets/landing/DEPILACION_LASER/CARRUSEL_MINI/LASER-13.webp') }}" class="img_tab_lase" alt="">
                </div>

            </div>

        </div>

        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
            <div class="row">
                <div class="col-7">
                    <div class="container">
                        <h3 class="service_title mb-3">24 Sesiones 2 Zonas Pequeñas a elegir:
                        </h3>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <p class="subtext_lase">
                                    1. Ante brazos 6. Axilas <br>
                                    2. Brazos Sup   7. Brazos Sup <br>
                                    3. Nuca  8. Zona Íntima <br>
                                    4. Hombros  9. Línea Interglútea <br>
                                    5. Escote
                                </p>
                            </div>
                            <div class="col-6">
                                <h5 class="precio_laser mb-4"> $3,690 </h5>
                                <a href="" class="btn_comprar_paquete">Comprar Paquete</a>
                            </div>
                        </div>
                        <p class="mini_subtext_paradisus mt-3">
                            Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                            al terminar tu tratamiento.
                            Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                        </p>
                    </div>

                </div>

                <div class="col-5">
                    <img src="{{ asset('assets/landing/DEPILACION_LASER/CARRUSEL_PEQUEÑO/LASER-19.webp') }}" class="img_tab_lase" alt="">
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
            <div class="row">
                <div class="col-7">
                    <div class="container">
                        <h3 class="service_title mb-3">30 Sesiones 2 Zonas Mediano a elegir:
                        </h3>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <p class="subtext_lase">
                                    1. Brazos Completos 6. Glúteos <br>
                                    2. Espalda alta   7. Piernas sup <br>
                                    3. Pecho  8. Piernas Inf <br>
                                    4. Espalda baja  9. Bikini completo <br>
                                    5. Abdomen
                                </p>
                            </div>
                            <div class="col-6">
                                <h5 class="precio_laser mb-4"> $12,000 </h5>
                                <a href="" class="btn_comprar_paquete">Comprar Paquete</a>
                            </div>
                        </div>
                        <p class="mini_subtext_paradisus mt-3">
                            Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                            al terminar tu tratamiento.
                            Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                        </p>
                    </div>

                </div>

                <div class="col-5">
                    <img src="{{ asset('assets/landing/DEPILACION_LASER/CARRUSE_MEDIANO/LASER-20.webp') }}" class="img_tab_lase" alt="">
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">
            <div class="row">
                <div class="col-7">
                    <div class="container">
                        <h3 class="service_title mb-3">30 Sesiones 2 Zonas Grandes:

                        </h3>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <p class="subtext_lase">
                                    1. Piernas Completas <br>
                                    2. Espalda Completa <br>
                                </p>
                            </div>
                            <div class="col-6">
                                <h5 class="precio_laser mb-4"> $15,000</h5>
                                <a href="" class="btn_comprar_paquete">Comprar Paquete</a>
                            </div>
                        </div>
                        <p class="mini_subtext_paradisus mt-3">
                            Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                            al terminar tu tratamiento.
                            Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                        </p>
                    </div>

                </div>

                <div class="col-5">
                    <img src="{{ asset('assets/landing/DEPILACION_LASER/CARRUSEL_GRANDE/LASER-21.webp') }}" class="img_tab_lase" alt="">
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="pills-vellos" role="tabpanel" aria-labelledby="pills-vellos-tab" tabindex="0">
            <div class="row">
                <div class="col-7">
                    <div class="container">
                        <h3 class="service_title mb-3">Cuerpo Completo:


                        </h3>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <p class="subtext_lase">
                                    1. Todas las zonas mini <br>
                                    2. Todas las zonas pequeñas <br>
                                    3. Todas las zonas medianas <br>
                                    4. Todas las zonas grandes <br>
                                </p>
                            </div>
                            <div class="col-6">
                                <h5 class="precio_laser mb-4"> $60,000
                                </h5>
                                <a href="" class="btn_comprar_paquete">Comprar Paquete</a>
                            </div>
                        </div>
                        <p class="mini_subtext_paradisus mt-3">
                            Te aseguramos que NO tendrás que pagar más sesiones, te brindamos resultados reales,
                            al terminar tu tratamiento.
                            Tú pagas las 12 sesiones de una zona y te damos otras 12 sesiones en otra zona, dando un total de 24 sesiones.
                        </p>
                    </div>

                </div>

                <div class="col-5">
                    <img src="{{ asset('assets/landing/DEPILACION_LASER/CARRUSEL_ADIOS_VELLOS/LASER-23.webp') }}" class="img_tab_lase" alt="">
                </div>

            </div>
        </div>

      </div>

</section>

<section class="parallax" style="background-image: url('{{ asset('assets/landing/bg2.webp') }}');">
    <div class="parallax-content">

        <div class="px-4 py-2 my-2 text-center">
            <h3 class="display-5 fw-bold tittle_section_para">
                Libera a tu piel <br> del sufrimiento.
            </h3>
            <div class="col-lg-6 mx-auto">
            <p class="lead mb-4 text_section_para">
                Dile hola a la tecnología y dile adiós a los métodos antiguos.
            </p>
            </div>
        </div>

    </div>

</section>

<section class="row section_equipo_laser">

    <div class="col-6">
        <div class="container_img_equi">
            <img src="{{ asset('assets/landing/DEPILACION_LASER/EQUIPO_LASER.webp') }}" alt="" class="img_equipo_laser">
            <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="estrellas_flotantes">
            <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="estrellas_flotantes_r ">

        </div>
    </div>

    <div class="col-6 my-auto">

        <div class="d-flex justify-content-evenly">
            <h3 class="box_tittle mt-5 mb-5">Vita Laser 3000w</h3>
        </div>

        <div class="d-flex justify-content-evenly">
            <p class="li_estresllas_texto">
                <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="img_icon__estrella"> Láser Cuatridiodo 4D <br>
                <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="img_icon__estrella"> Lo más eficaz para la depilación <br>
                <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="img_icon__estrella"> 300 Watts<br>
                <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="img_icon__estrella"> 20 millones de dísparos <br>
                <img src="{{ asset('assets/landing/DEPILACION_LASER/DESTELLO-01.webp') }}" alt="" class="img_icon__estrella"> Menos sesiones adios vello <br>
            </p>
        </div>

        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/landing/DEPILACION_LASER/PAGINA-WEB-PARADISUS-04.webp') }}" alt="" class="img_seziones">
            <img src="{{ asset('assets/landing/DEPILACION_LASER/PAGINA-WEB-PARADISUS-04.webp') }}" alt="" class="img_seziones">

        </div>

    </div>

</section>


@endsection
