<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Link de Pago IMNAS #{{ $nota->id }}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <meta name="google-site-verification" content="xjOUgezOv03ht4XdfShswB0Hh-49H_WsaM6Cx9GIR6A" />

    <!-- Bootstrap -->
     <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://plataforma.imnasmexico.com/assets/ecommerce/css/bootstrap.css">
    <link rel="icon" type="image/x-icon" href="https://paradisus.mx/assets/landing/paradisus.webp">

     <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://plataforma.imnasmexico.com/assets/ecommerce/css/twitter-bootstrap.css">

    <!-- css custom -->
    <link rel="stylesheet" href="https://plataforma.imnasmexico.com/assets/ecommerce/css/ecommerce.css">

    <!-- Sweetalert2 -->
     <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">-->
    <link rel="stylesheet" href="https://plataforma.imnasmexico.com/assets/ecommerce/css/sweetalert2.css">

    <link href="https://plataforma.imnasmexico.com/assets/ecommerce/bootstrap_icons/font/bootstrap-icons.min.css" rel="stylesheet">


    @yield('css_custom')

    <style>
        .titulo{
            font-size: 20px;
            line-height: 25px;
        }
        .subtitle{
            font-size: 16px;
            line-height: 20px;
            color: rgba(0, 0, 0, .55);
        }

        .card {
            background-color: #fff;
            padding: 15px;
            border-radius: 19px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

        .strong_ticket{
            font-weight: 500;
        }

        .ticket_text{
            font-weight: 300;
        }


        .bi-share::before {
            content: "\f52e";
            font-size: 14px;
        }

        .compra_prote{
            background: #00a650;
            color: #fff;
            font-size: 9px;
            border-radius: 10px;
            padding: 4px;
        }

        .bi-shield::before {
            content: "\f53f";
            font-size: 13px;
        }

        .bi-cart::before {
            content: "\f242";
            font-size: 15px;
        }

        .btn_compra{
            background-color: #3483fa;
            border: none;
            border-radius: 13px;
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
        }

    </style>

</head>

    <body style="background:#f9f4f4">
    <section class="d-flex justify-content-center align-items-start" style="min-height:100vh; background: #3483fa;">
        <div class="card p-3 mt-3 mb-5" style="max-width: 375px; width:100%;">

            {{-- — Header del ticket — --}}
            <div class="d-flex justify-content-between mb-2">
                <div class="text-center"><strong class="strong_ticket text-center">
                    Nota: <br> </strong> {{ $nota->id }}
                </div>
                    {{-- — Compartir por WhatsApp — --}}
                    <div class="text-center mb-4">
                        @php
                            // Preparamos el mensaje con la URL actual
                            $shareUrl = Request::fullUrl();
                            $message  = urlencode("Revisa tu Link de pago: $shareUrl");
                        @endphp
                        <a
                            href="https://api.whatsapp.com/send?text={{ $message }}"
                            target="_blank"
                            class="btn btn-success"
                            style="background-color:transparent; border:none;font-size: 3px;"
                        >
                        <i class="icons_header bi bi-share" style="color:#000"></i>
                        </a>
                    </div>
                <div class="text-center"><strong class="strong_ticket text-center">
                    Servicio: <br>

                    @if($nota->Paquetes->id_servicio != NULL || $nota->Paquetes->id_servicio != 0)
                        {{$nota->Paquetes->Servicios->nombre}}<br>
                    @else
                        SN
                    @endif
                    @if($nota->Paquetes->id_servicio2 != NULL || $nota->Paquetes->id_servicio2 != 0)
                        {{$nota->Paquetes->Servicios2->nombre}}<br>
                    @endif
                    @if($nota->Paquetes->id_servicio3 != NULL || $nota->Paquetes->id_servicio3 != 0)
                        {{$nota->Paquetes->Servicios3->nombre}}<br>
                    @endif
                    @if($nota->Paquetes->id_servicio4 != NULL || $nota->Paquetes->id_servicio4 != 0)
                        {{$notas->Paquetes->Servicios4->nombre}}<br>
                    @endif

                 </strong>
                </div>
            </div>

            {{-- — Total del pago — --}}
            <div class="text-center mb-2">
            <div class="row">
                <div class="col-12">
                    <img src="https://paradisus.mx/assets/landing/paradisus.webp" style="width: 90px">
                    <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" style="width: 140px">
                </div>
            </div>
            <h5>Link de pago</h5>
            <h5 class="text-muted">{{ $user->name }} {{ $user->last_name }}</h5>
            <p class="text-muted">{{ $user->phone }}</p>

                <div class="d-flex justify-content-center" >
                    <p class="compra_prote">COMPRA PROTEGIDA <i class="icons_header bi bi-shield" style="color:#fff"></i></p>
                </div>
            <h2>${{ number_format($pago->pago,2) }}</h2>
            </div>

            <div class="d-flex justify-content-center" >
                <form method="POST" action="{{ route('link_pago.payment_custom') }}">
                    @csrf
                    <input type="text" name="total" value="{{ $pago->pago }}" hidden>
                    <input type="text" name="folio" value="{{ $nota->id }}" hidden>
                    <input type="text" name="titulo" value="{{ $nota->id }}" hidden>

                    @if($nota->Paquetes->id_servicio != NULL || $nota->Paquetes->id_servicio != 0)
                        <input type="text" name="descripcion" value="{{$nota->Paquetes->Servicios->nombre}}" hidden>
                    @else
                        <input type="text" name="descripcion" value="SN" hidden>

                    @endif
                    @if($nota->Paquetes->id_servicio2 != NULL || $nota->Paquetes->id_servicio2 != 0)
                        <input type="text" name="descripcion" value="{{$nota->Paquetes->Servicios2->nombre}}" hidden>
                    @endif
                    @if($nota->Paquetes->id_servicio3 != NULL || $nota->Paquetes->id_servicio3 != 0)
                        <input type="text" name="descripcion" value="{{$nota->Paquetes->Servicios3->nombre}}" hidden>
                    @endif
                    @if($nota->Paquetes->id_servicio4 != NULL || $nota->Paquetes->id_servicio4 != 0)
                        <input type="text" name="descripcion" value="{{$notas->Paquetes->Servicios4->nombre}}" hidden>
                    @endif

                    <button type="submit" class="btn btn-success btn_compra mb-4" style="background-color:#3483fa; border:none;">
                        <i class="bi bi-cart"></i> Pagar ahora
                    </button>
                </form>
            </div>

            </div>

        </div>
    </section>

        <!-- Bootstrap -->

        <script type="text/javascript" src="https://plataforma.imnasmexico.com/assets/ecommerce/js/bootstrap_bundle.js"></script>


        <script type="text/javascript" src="https://plataforma.imnasmexico.com/assets/ecommerce/js/popper.js"></script>

        <!-- jquery -->
        <script type="text/javascript" src="https://plataforma.imnasmexico.com/assets/ecommerce/js/jquery-3.7.0.js"></script>

        <!-- Sweetalert2 -->
        <script type="text/javascript" src="https://plataforma.imnasmexico.com/assets/ecommerce/js/sweetalert2.all.min.js"></script>


        @yield('js_custom')


</body>

</html>
