<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$nota->Servicio->nombre}}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  </head>


    <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}

        .tab-pane{
            padding: 15px 15px 15px 15px;
        }
        .custom_col{

        }
        .icon-bar {
        position: fixed;
        top: 50%;
        -webkit-transform: translateY(-50%);
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        z-index: 10;
        right: 0;
        }

        .icon-bar a {
        display: block;
        text-align: center;
        padding: 16px;
        transition: all 0.3s ease;
        color: white;
        font-size: 20px;
        }

        .icon-bar a:hover {
        background-color: #000;
        }
        .content {
        margin-left: 75px;
        font-size: 30px;
        }

        .facebook {
        background: #D7819D;
        color: white;
        }
    </style>
    <body>
        <div class="icon-bar">
            @for ($i = 1; $i <= $nota->num_sesion; $i++)
                <a href="#nav-{{ $i }}" class="facebook">
                    {{ $i }}
                </a>
            @endfor
        </div>

        <main class="main-content main-content-bg mt-0">
            <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                <div class="col-lg-4 col-md-7 custom_col">
                    <div class="card border-0 mb-0">

                    <div class="card-header bg-transparent">
                        <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@ :
                            <br>
                            {{$nota->Client->name }} {{ $nota->Client->last_name }}
                        </h5>
                    </div>

                    <div class="card-body px-lg-3 pt-0">
                        <div class="text-center text-muted mb-4">
                        <small></small>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Paquete:</label>
                                    <div class="input-group mb-4">
                                        <span class="input-group-text"><i class="fa fa-file"></i></span>
                                        <input class="form-control" type="text" value="{{$nota->Servicio->nombre}}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Fecha Inicial</label>
                                    <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    <input class="form-control" type="text" value="{{ $nota->fecha }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Precio</label>
                                    <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-coins"></i></span>
                                    <input class="form-control" type="text" value="${{ $nota->monto }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Pago Restante</label>
                                    <div class="input-group mb-4">
                                    <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                                    <input class="form-control" type="text" value="${{ $nota->restante }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <hr style="background-color: #D9819C; height: 2px;">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-12">

                                            <ul >
                                                <h5 class="text-center">
                                                    Sesiones
                                                </h5>
                                                <div class="nav nav-tabs" id="myTab" role="tablist">
                                                    @for ($i = 1; $i <= $nota->num_sesion; $i++)
                                                        <li class="nav-item">
                                                            <a href="#nav-{{ $i }}" class="nav-link">
                                                                {{ $i }}
                                                            </a>
                                                        </li>
                                                    @endfor
                                                </div>
                                            </ul>

                                            <div class="tab-pane" id="nav-uno">
                                                <div class="row mt-3">
                                                    @foreach ($registros as $registro)
                                                        <div class="tab-pane" id="nav-{{$registro->num_sesion}}">
                                                            <div class="row mt-3">
                                                                <div class="row">
                                                                    <div class="col-5 mb-3">
                                                                        <h6><strong>SESIÓN 0{{$registro->num_sesion}}</strong></h6>
                                                                    </div>

                                                                    <div class="col-7 mb-3">
                                                                        <strong>Fecha:</strong> {{ $nota->fecha }}
                                                                    </div>
                                                                    <div class="col-12">
                                                                        @if ($search_servicio->diseno == '3' && $registro->num_sesion == '1')
                                                                            <p><b>Piedras calientes</b></p>
                                                                            <p class="card-description mb-4" style="font-size:12px;">
                                                                                Ideal para relajar a profundidad, liberar tensión muscular y mejorar la circulación.
                                                                            </p>
                                                                        @elseif ($search_servicio->diseno == '3' && $registro->num_sesion == '2')
                                                                            <p><b>Relajante con aromaterapia</b></p>
                                                                            <p class="card-description mb-4" style="font-size:12px;">
                                                                                Perfecto para soltar el estrés, relajar mente y cuerpo y reconectar contigo misma.
                                                                            </p>
                                                                        @elseif ($search_servicio->diseno == '6')
                                                                            <p><b>Productos usados</b></p>
                                                                            <textarea cols="15" rows="3" class="form-control" readonly>{{ $registro->productos_usados }}</textarea>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="nombre">Cosmetologa</label>
                                                                        <select class="form-control " value="{{ old('id_cosme') }}" readonly>
                                                                            <option value="{{ $registro->id_cosme }}">{{ $registro->User->name }}</option>
                                                                            @foreach ($user as $item)
                                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-12"><strong>Celulitis</strong></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Antes</label>
                                                                            <input value="{{ $registro->celulitis_antes }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Despues</label>
                                                                            <input value="{{ $registro->celulitis_despues }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12"><strong>Textura</strong></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Antes</label>
                                                                            <input value="{{ $registro->textura_antes }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Despues</label>
                                                                            <input value="{{ $registro->textura_despues }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12"><strong>Gluteos</strong></div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Antes</label>
                                                                            <input value="{{ $registro->gluteos_antes }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label for="fecha">Despues</label>
                                                                            <input value="{{ $registro->gluteos_despues }}" type="text" class="form-control" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="nombre">Nota</label>
                                                                        <div class="stats">
                                                                            <textarea cols="15" rows="3" class="form-control" readonly>{{ $registro->observaciones }}</textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="col-12">
                                                                    <strong>Firma</strong>
                                                                    @php
                                                                        $index = $registro->id;
                                                                    @endphp
                                                                    @if ($registro->firma == NULL)
                                                                        <form method="POST" action="{{ route('paquetes_faciales.store_firma', $registro->id) }}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="signature-pad" id="sig{{ $index }}" data-id="{{ $index }}"></div>
                                                                            <br/>
                                                                            <button class="btn btn-danger btn-sm clear-btn" data-id="{{ $index }}">Repetir</button>
                                                                            <textarea id="signed{{ $index }}" name="signed2" style="display: none"></textarea>
                                                                            <button class="btn btn-primary btn-sm">Guardar</button>
                                                                        </form>
                                                                    @else
                                                                        <img src="{{ asset('signatures/' . $registro->firma) }}" alt="firma">
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr style="background-color: #D9819C; height: 2px;">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                            <div class="card-header bg-transparent">
                                <h5 class="text-dark text-center mt-2 mb-3">Ubicación <br>
                                </h5>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d60214.95713782746!2d-99.24951146734244!3d19.39360992523693!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1ffd944963ec3%3A0xb529339c57f86ca6!2sPARADISUS%20SPA!5e0!3m2!1ses-419!2smx!4v1673892200177!5m2!1ses-419!2smx" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>

                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </main>
        <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">

        <script type="text/javascript">
            $(document).ready(function () {
                // Inicializar todos los divs de firmas dinámicamente
                $('.signature-pad').each(function () {
                    let id = $(this).data('id');
                    $(this).signature({
                        syncField: '#signed' + id,
                        syncFormat: 'PNG'
                    });
                });

                // Limpiar firma al hacer clic en "Repetir"
                $('.clear-btn').on('click', function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    $('#sig' + id).signature('clear');
                    $('#signed' + id).val('');
                });
            });
        </script>
    </body>
</html>
