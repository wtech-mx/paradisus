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
    @yield('template_title') - {{$configuracion->nombre_sistema}}
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{ asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  @yield('css')
   <!-- Select2  -->
   <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css')}}">

  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/css/preloader.css')}}">


   {{-- <link src="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link src="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
--}}


  <style>
        input:before {
            content: attr(data-date);
            display: inline-block;
            color: black;
        }
    </style>

</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300  position-absolute w-100" style="background-color: {{$configuracion->color_principal}}!important;"></div>
  <div id="page-loader"><span class="preloader-interior"></span></div>
  @include('client.create_cons')
   <!-- Sidenav -->
    @include('layouts.sidebar')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- End Navbar -->
    @include('sueldo_cosmes.crear')
    @include('paquetes_servicios.show')

    <div class="container-fluid">

        {{-- @include('layouts.header') --}}
        @include('layouts.simple_alert')
        @yield('breadcrumb')
        @yield('content')
       <!-- Modal lateral Congif -->
        @include('layouts.footer')
      <!-- End Modal lateral Congif -->

    </div>
  </main>

  @yield('js_custom')

   <!-- Modal lateral Congif -->
    {{-- @include('layouts.modal_config') --}}
  <!-- End Modal lateral Congif -->



  <!--   Core JS Files   -->
  {{-- <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script> --}}

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

  @include('sweetalert::alert')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('assets/js/preloader.js')}}"></script>

  @yield('datatable')

  @yield('fullcalendar')


  <!-- Github buttons -->
  {{-- <script async defer src="https://buttons.github.io/buttons.js"></script> --}}

  @yield('select2')

</body>

</html>
