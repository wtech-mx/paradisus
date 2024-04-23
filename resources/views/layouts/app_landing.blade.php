<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">
  <title>
    @yield('template_title') - Paradisus
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

  @yield('css')
   <!-- Select2  -->
   <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css')}}">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />

  {{-- <link rel="stylesheet" href="{{ asset('assets/css/preloader.css')}}"> --}}

  <link rel="stylesheet" href="{{ asset('assets/css/landing.css')}}">
  <link href="{{asset('assets/css/btn_flotante.css')}}" rel="stylesheet" />


  <style>
        input:before {
            content: attr(data-date);
            display: inline-block;
            color: black;
        }
    </style>

</head>

<nav class="navbar navbar-expand-md bg-body-tertiary navbar_paradisus">
    <a class="navbar-brand" href="#">
        <a class="nav-link navbar_li_color logo_ocultar" href="{{ route('index.landingpage') }}">
            <img class="img_logo" src="{{ asset('assets/landing/paradisus.webp') }}" alt="Logo paradisus">
        </a>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="background-color: #fff">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto ms-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link navbar_li_color active" href="{{ route('index.landingpage') }}">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index_laser.landingpage') }}">Depilacion LASER</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Corporales</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Faciales</a>
                </li>

                <li class="nav-item logo_ocultar_menu">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">
                        <img class="img_logo" src="{{ asset('assets/landing/paradisus.webp') }}" alt="Logo paradisus">
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Paquetes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Experiencias</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Nutricion</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link navbar_li_color" href="{{ route('index.landingpage') }}">Productos</a>
                </li>

        </ul>
      </div>
    </div>
</nav>

<body class="">

  {{-- <div id="page-loader"><span class="preloader-interior"></span></div> --}}

    @yield('content')

    @include('landing.btn_flotante')

    <footer class="py-5 footer_paradisus" style="background-color: #B9758A!important;">
        <div class="row">

          <div class="col-4">
            <div class="d-flex justify-content-center">
                <h5 class="footer_tittle"><strong>UBICACION</strong></h5>
            </div>

            <div class="d-flex justify-content-center">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="https://maps.app.goo.gl/YEweZXrJjaEBa3Zr6" target="_blank" class="nav-link p-0 footer_tittle text-center">
                            Castilla 136, Álamos, Benito Juárez, 03400 Ciudad de México <br>
                            <img class="img_icono_footer" src="{{ asset('assets/landing/ICONOS_BOTONES/UBICACION.webp') }}" alt="Logo paradisus">
                        </a>
                    </li>
                </ul>
            </div>
          </div>

          <div class="col-4">
            <div class="d-flex justify-content-center">
                <h5 class="footer_tittle"><strong>CONTACTO</strong></h5>
            </div>

            <div class="d-flex justify-content-center">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 footer_tittle text-center">
                            5549204641 <br>
                            <img class="img_icono_footer" src="{{ asset('assets/landing/ICONOS_BOTONES/WHATSAPP-01.webp') }}" alt="Logo paradisus">
                        </a>
                    </li>
                </ul>
            </div>
          </div>

          <div class="col-4">
            <div class="d-flex justify-content-center">
                <h5 class="footer_tittle"><strong>REDES SOCIALES</strong></h5>
            </div>

            <div class="d-flex justify-content-center">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link p-0 footer_tittle text-center">
                            <img class="img_icono_footer" src="{{ asset('assets/landing/ICONOS_BOTONES/FACEBOOK-01.webp') }}" alt="Logo paradisus">
                            <img class="img_icono_footer" src="{{ asset('assets/landing/ICONOS_BOTONES/TIKTOK-01.webp') }}" alt="Logo paradisus">
                            <img class="img_icono_footer" src="{{ asset('assets/landing/ICONOS_BOTONES/INSTAGRAM-01.webp') }}" alt="Logo paradisus">

                        </a>
                    </li>
                </ul>
            </div>
          </div>

        </div>

    </footer>

  <!--   Core JS Files   -->

  <script src="{{ asset('assets/js/core/popper.min.js')}}"></script>

  <script src="{{ asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>

  <script src="{{ asset('assets/js/plugins/datatables.js')}}"></script>

  {{-- <script src="{{ asset('assets/js/plugins/fullcalendar.min.js')}}"></script> --}}
  <!-- Kanban scripts -->

  <script src="{{ asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js')}}"></script>
  <script src="{{ asset('assets/js/argon-dashboard.min.js')}}"></script>
  <script src="{{ asset('assets/js/ConectorJavaScript.js')}}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  {{-- <script src="{{ asset('assets/js/preloader.js')}}"></script> --}}

  @yield('datatable')


</body>

</html>
