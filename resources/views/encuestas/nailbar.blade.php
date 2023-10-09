<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Faciales | Encuesta de satisfaccion</title>

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
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/vista-superior-sal-bano-copia-espacio-tarjeta_23-2148481773.jpg?w=826&t=st=1696565340~exp=1696565940~hmac=b94baeac134a901ed1eb53ce5250206b04d57a0f859f292257c9ee10bd3af73c');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7 custom_col">
            <div class="card border-0 mb-0">

              <div class="card-header bg-transparent">
                <h4 class="text-center mt-2 mb-3">Encuesta de Satisfacción</h4>
                <h3 class="text-center mt-2 mb-3"> <em>Nailbar</em> </h3>
              </div>

              <div class="card-body px-lg-3 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>

                <div class="row">
                    <form method="POST" action="{{ route('create.faciales') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                        @csrf
                        <input class="form-control" id="tipo" name="tipo" type="text" value="Nailbar" style="display: none">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Cosmetologa *</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-file"></i></span>
                                    <select class="form-control" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                                        <option value="">Seleccione Cosmetologa</option>
                                        @foreach ($cosme as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Fecha</label>
                                <div class="input-group mb-4">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <input class="form-control" type="text" value="{{ $fechaActual }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Qué tan probable es que nos recomiendes? *</label>
                                <div class="input-group">
                                    <select class="form-control" id="p1" name="p1" value="{{ old('p1') }}" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Poco probable">Poco probable</option>
                                        <option value="Algo poco probable">Algo poco probable</option>
                                        <option value="Neutral">Neutral</option>
                                        <option value="Probable">Probable</option>
                                        <option value="Bastante probable">Bastante probable</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Cómo calificas el profesionalismo
                                    de nuestra Experta en Cabello? *</label>
                                <div class="input-group text-center">
                                    <select class="form-control" id="p4" name="p4" value="{{ old('p4') }}" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Muy insatisfactorio">Muy insatisfactorio</option>
                                        <option value="Insatisfactorio">Insatisfactorio</option>
                                        <option value="Neutral">Neutral</option>
                                        <option value="Satisfactorio">Satisfactorio</option>
                                        <option value="Muy satisfactorio">Muy satisfactorio</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Cómo calificas la calidad y
                                    limpieza de las instalaciones? *</label>
                                <div class="input-group text-center">
                                    <select class="form-control" id="p5" name="p5" value="{{ old('p5') }}" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Muy insatisfactorio">Muy insatisfactorio</option>
                                        <option value="Insatisfactorio">Insatisfactorio</option>
                                        <option value="Neutral">Neutral</option>
                                        <option value="Satisfactorio">Satisfactorio</option>
                                        <option value="Muy satisfactorio">Muy satisfactorio</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Qué tanto satisfacieron tus
                                    necesidades nuestros productos? *</label>
                                <div class="input-group text-center">
                                    <select class="form-control" id="p6" name="p6" value="{{ old('p6') }}" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Muy insatisfactorio">Muy insatisfactorio</option>
                                        <option value="Insatisfactorio">Insatisfactorio</option>
                                        <option value="Neutral">Neutral</option>
                                        <option value="Satisfactorio">Satisfactorio</option>
                                        <option value="Muy satisfactorio">Muy satisfactorio</option>
                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Cómo calificas la presentación de
                                    nuestra Experta en Cabello? *</label>
                                <div class="input-group text-center">
                                    <select class="form-control" id="p7" name="p7" value="{{ old('p7') }}" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="Muy insatisfactorio">Muy insatisfactorio</option>
                                        <option value="Insatisfactorio">Insatisfactorio</option>
                                        <option value="Neutral">Neutral</option>
                                        <option value="Satisfactorio">Satisfactorio</option>
                                        <option value="Muy satisfactorio">Muy satisfactorio</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Te atendieron puntualmente? *</label>
                                <div class="input-group text-center">
                                    <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
                                    <input type="radio" id="p6" name="p6" value="si" required/>

                                    <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
                                    <input type="radio" id="p6" name="p6" value="no" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¡Gracias! Déjanos un comentario.</label>
                                <div class="input-group text-center">
                                    <textarea class="form-control" id="p7" name="p7" rows="2" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn mb-5" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
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
  </main>
  @include('sweetalert::alert')

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{ asset('assets/js/preloader.js')}}"></script>
  <script>
    function mostrarDiv(id) {
        var div = document.getElementById(id);
        if (div) {
            div.style.display = 'block';
        }
    }

    function ocultarDiv(id) {
        var div = document.getElementById(id);
        if (div) {
            div.style.display = 'none';
        }
    }
  </script>

  </body>
  </html>
