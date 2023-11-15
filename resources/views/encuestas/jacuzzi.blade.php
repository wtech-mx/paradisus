<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jacuzzi | Encuesta de satisfaccion</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon/'. $configuracion->favicon) }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/encuestas.css')}}">

  </head>



<body>

    <main class="main-content main-content-bg mt-0">

        <div class="page-header min-vh-100" style="background-image: url('');">
            <span class="mask"></span>

          <div class="container">

            <div class="row justify-content-center">
              <div class="col-10 custom_col p-3">

                <div class="card card_custom" style="">

                  <div class="card-header" style="border: solid 0px;background:transparent;">

                    <p class="text-center">
                        <img class="img_logo" src="{{ asset('assets/logo_paradisus.png')}}" alt="">
                    </p>
                    <p class="text-center">
                        <img class="img_tittle_encuesta" src="{{ asset('assets/tittle_encuesta.png')}}" alt="">
                    </p>
                    <p class="text-center">
                        <label class="form-control-label" style="font-size: 35px;">Jacuzzi</label>
                    </p>

                  </div>

                  <div class="card-body">
                    <div class="row">

                        <form method="POST" action="{{ route('create.faciales') }}" id="miFormulario" enctype="multipart/form-data" role="form" style="text-align: center;">
                            @csrf

                            <input class="form-control" id="tipo" name="tipo" type="text" value="Jacuzzi" style="display: none">
                            @include('encuestas.preguntas_base')

                            <div class="col-md-12">
                                <div class="form-group p-2">
                                    <label for="example-text-input" class="form-control-label">¿Te dieron el Vino y chocolates? *</label>
                                    <div class="input-group text-center">
                                        <div class="input-group text-center" style="display: table">
                                            <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
                                            <input type="radio" id="p11" name="p11" value="si" required/>

                                            <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
                                            <input type="radio" id="p11" name="p11" value="no" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group p-2">
                                    <label for="example-text-input" class="form-control-label">¡Gracias! Déjanos un comentario.</label>
                                    <div class="input-group text-center">
                                        <textarea class="form-control" id="comentario" name="comentario" rows="2" ></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group p-2">
                                    <button type="submit" class="btn_save" style="">
                                        Guardar
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                  </div>

                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

    </main>
  @include('sweetalert::alert')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('assets/js/preloader.js')}}"></script>

  </body>
  </html>
