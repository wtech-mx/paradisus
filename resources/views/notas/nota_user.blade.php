@php
    $cadena = $notas_pedidos->User->name;
    $cadenaExplode = explode(" ", $cadena);
    $ultimoElemento = end($cadenaExplode);
@endphp
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="Paradisus SPA">
    <title>Nota Usuario</title>

    <link rel="stylesheet" href="{{ asset('assets/css/nicepage.css') }}" media="screen">
    <link rel="stylesheet" href="{{ asset('assets/css/nota_usuario.css') }}" media="screen">

    <script class="u-script" type="text/javascript" src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}" defer=""></script>
    <script class="u-script" type="text/javascript" src="{{ asset('assets/js/nicepage.js') }}" defer=""></script>

    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster:400">
    <body class="u-body u-xl-mode" data-lang="es">
        <header class="u-clearfix u-header u-palette-2-light-2 u-header" id="sec-aec1">
          <div class="u-clearfix u-sheet u-valign-middle-xs u-sheet-1">
            <h1 class="u-custom-font u-font-lobster u-text u-text-body-alt-color u-text-default u-text-1">Paradisus</h1>
          </div>
        </header>
        <section class="u-clearfix u-gradient u-section-1" id="sec-d5dd">
          <div class="u-clearfix u-sheet u-sheet-1">

          {{-- =========================================================  C A R R U S E L ======================================================== --}}
            <div class="u-carousel u-gallery u-gallery-slider u-layout-carousel u-lightbox u-no-transition u-show-text-none u-gallery-1 mt-5" data-interval="5000" data-u-ride="carousel" id="carousel-ca0e">
                <ol class="u-absolute-hcenter u-carousel-indicators u-carousel-indicators-1">
                  <li data-u-target="#carousel-ca0e" data-u-slide-to="0" class="u-active u-grey-70 u-shape-circle" style="width: 10px; height: 10px;"></li>
                  <li data-u-target="#carousel-ca0e" data-u-slide-to="1" class="u-grey-70 u-shape-circle" style="width: 10px; height: 10px;"></li>
                </ol>
                <div class="u-carousel-inner u-gallery-inner" role="listbox">

                     <div class="u-active u-carousel-item u-gallery-item u-carousel-item-1">
                        <div class="u-back-slide" data-image-width="1080" data-image-height="1080">
                          <img class="u-back-image u-expanded" src="{{asset('carrusel/1.jpg') }}">
                        </div>
                        <div class="u-align-center-xs u-over-slide u-shading u-valign-bottom-xs u-over-slide-1">
                          <h3 class="u-gallery-heading"></h3>
                          <p class="u-gallery-text"></p>
                        </div>
                      </div>
                      <div class="u-carousel-item u-gallery-item u-carousel-item-2">
                        <div class="u-back-slide" data-image-width="1080" data-image-height="1080">
                          <img class="u-back-image u-expanded" src="{{asset('carrusel/2.jpg') }}" alt="">
                        </div>
                        <div class="u-align-center-xs u-over-slide u-shading u-valign-bottom-xs u-over-slide-2">
                          <h3 class="u-gallery-heading"></h3>
                          <p class="u-gallery-text"></p>
                        </div>
                      </div>

                </div>
                <a class="u-absolute-vcenter u-carousel-control u-carousel-control-prev u-grey-70 u-hidden u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-1" href="#carousel-ca0e" role="button" data-u-slide="prev">
                  <span aria-hidden="true">
                    <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                  </span>
                  <span class="sr-only">
                    <svg viewBox="0 0 451.847 451.847"><path d="M97.141,225.92c0-8.095,3.091-16.192,9.259-22.366L300.689,9.27c12.359-12.359,32.397-12.359,44.751,0c12.354,12.354,12.354,32.388,0,44.748L173.525,225.92l171.903,171.909c12.354,12.354,12.354,32.391,0,44.744c-12.354,12.365-32.386,12.365-44.745,0l-194.29-194.281C100.226,242.115,97.141,234.018,97.141,225.92z"></path></svg>
                  </span>
                </a>
                <a class="u-absolute-vcenter u-carousel-control u-carousel-control-next u-grey-70 u-hidden u-icon-circle u-opacity u-opacity-70 u-spacing-10 u-text-white u-carousel-control-2" href="#carousel-ca0e" role="button" data-u-slide="next">
                  <span aria-hidden="true">
                    <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                  </span>
                  <span class="sr-only">
                    <svg viewBox="0 0 451.846 451.847"><path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"></path></svg>
                  </span>
                </a>
            </div>
            {{-- =========================================================  C L I E N T E ======================================================== --}}
            <h2 class="u-custom-font u-font-lobster u-text u-text-default-xs u-text-1">{{ $notas_pedidos->Client->name }} {{ $notas_pedidos->Client->last_name }}<span style="font-weight: 700;"></span></h2>

            <h3 class="u-text u-text-default-xs u-text-palette-2-dark-1 u-text-2">${{ $notas_pedidos->Servicios->precio }}</h3>
            <span class="u-icon u-text-palette-2-light-3 u-icon-1" data-href="https://goo.gl/maps/VgWjj1vfHHShhtrq7" data-target="_blank"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 52 52" style=""><use xlink:href="#svg-c045"></use></svg><svg class="u-svg-content" viewBox="0 0 52 52" x="0px" y="0px" id="svg-c045" style="enable-background:new 0 0 52 52;"><path style="fill:currentColor;" d="M38.853,5.324L38.853,5.324c-7.098-7.098-18.607-7.098-25.706,0h0C6.751,11.72,6.031,23.763,11.459,31L26,52l14.541-21C45.969,23.763,45.249,11.72,38.853,5.324z M26.177,24c-3.314,0-6-2.686-6-6s2.686-6,6-6s6,2.686,6,6S29.491,24,26.177,24z"></path></svg></span>
            <h6 class="u-text u-text-default-xs u-text-grey-50 u-text-3">
              <a class="u-active-none u-border-none u-btn u-button-link u-button-style u-custom-font u-font-lobster u-hover-none u-none u-text-palette-2-light-3 u-btn-1" href="https://goo.gl/maps/VgWjj1vfHHShhtrq7" target="_blank">Paradisus</a>
            </h6>

            <div class="u-palette-1-light-3 u-radius-10 u-shape u-shape-round u-shape-1"></div>
            <h6 class="u-text u-text-default-xs u-text-palette-2-base u-text-4"><span class="u-file-icon u-icon u-text-palette-2-light-1"><img src="{{asset('favicon/reloj.png') }}" alt=""></span>&nbsp;{{ $notas_pedidos->Servicios->duracion }}
            </h6>
            <div class="u-palette-1-light-3 u-radius-10 u-shape u-shape-round u-shape-2"></div>
            <h6 class="u-text u-text-default-xs u-text-palette-2-base u-text-5"><span class="u-file-icon u-icon u-text-palette-2-light-1 u-icon-3"><img src="{{asset('favicon/cosme.png') }}" alt=""></span>&nbsp;{{  $ultimoElemento }}
            </h6>

            {{-- =========================================================  S E R V I C I O ======================================================== --}}
            <h2 class="u-text u-text-default-xs u-text-6">Servicio</h2>

            <div class="u-container-style u-group u-radius-10 u-shape-round u-white u-group-1">
              <div class="u-container-layout u-container-layout-1"></div>
            </div>
            <span class="u-file-icon u-icon u-icon-4"><img src="{{asset('favicon/usuario.png') }}" alt=""></span>
            <h4 class="u-custom-font u-font-lobster u-text u-text-palette-2-light-1 u-text-7">{{ $notas_pedidos->Servicios->nombre }}<br></h4>

            {{-- =========================================================  P A G O S ======================================================== --}}
            <div class="u-palette-1-light-3 u-radius-10 u-shape u-shape-round u-shape-3"></div>
            <h6 class="u-text u-text-default-xs u-text-palette-2-base u-text-8"><span class="u-file-icon u-icon u-text-palette-2-light-1"><img src="/images/747310-f9731d8c.png" alt=""></span>&nbsp;Fecha
            </h6>

            <h2 class="u-text u-text-default-xs u-text-9">Pagos</h2>

            <div class="u-palette-1-light-3 u-radius-10 u-shape u-shape-round u-shape-4"></div>
            <h6 class="u-text u-text-default-xs u-text-palette-2-base u-text-10"><span class="u-file-icon u-icon u-text-palette-2-light-1 u-icon-6"><img src="/images/3133460-c66953f5.png" alt=""></span>&nbsp;Pago
            </h6>

            <div class="u-palette-1-light-3 u-radius-10 u-shape u-shape-round u-shape-5"></div>
            <h6 class="u-text u-text-default-xs u-text-palette-2-base u-text-11"><span class="u-file-icon u-icon u-text-palette-2-light-1"><img src="/images/1356635-b9d83679.png" alt=""></span>&nbsp;Sesión
            </h6>

            @foreach ($pago as $item)
            <div class="u-radius-10 u-shape u-shape-round u-white u-shape-6"></div>
            <p class="u-text u-text-default-xs u-text-palette-2-dark-1 u-text-12">{{ $item->fecha }}</p>

            <div class="u-radius-10 u-shape u-shape-round u-white u-shape-7"></div>
            <p class="u-text u-text-default-xs u-text-palette-2-dark-1 u-text-13">${{ $item->pago }}</p>

            <div class="u-radius-10 u-shape u-shape-round u-white u-shape-8"></div>
            <p class="u-text u-text-default-xs u-text-palette-2-dark-1 u-text-14">{{ $item->num_sesion }}</p>
            @endforeach

          </div>
        </section>

    </body>
</html>
