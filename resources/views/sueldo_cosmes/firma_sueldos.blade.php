<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitacora de Sueldos - </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">


  </head>
  <body>

    <style>

        body{
            background-color: #fb90b0;
            padding: 30px;
        }

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

    @media only screen and (max-width: 450px) {
        .text-res {
        font-size: 12px
    }
    }

    </style>

    <section class="row">

        <div class="col-12 mb-3">
            <h3 class="text-white"> <strong>Cosmetologa:</strong> <br> {{ $cosme->name }} </h3>
        </div>

        <div class="col-12 mb-3">
            <div class="card">
                <form action="" method="GET" >
                    <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                        <h6>Filtros</h6>
                            <div class="row">

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label class="form-label">Del</label>
                                    <div class="input-group">
                                        <input name="fecha" class="form-control"
                                            type="date" required value="{{$fechaActual}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label class="form-label">Al</label>
                                    <div class="input-group">
                                        <input  name="fecha2" type="date" class="form-control" required value="{{$fechaActual}}">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <label class="form-label">-</label>
                                    <div class="input-group">
                                        <button class="btn btn-sm bg-success mb-0 mt-sm-0 mt-1" type="submit" style="color: #ffffff;">Buscar</button>
                                    </div>

                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 mb-3">
            <div class="card p-2 ">
                <table class="table table-flush" id="example">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Fecha</th>
                            <th>Firma</th>
                            <th>Sueldo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>23</td>
                            <td>2011-04-25</td>
                            <td> SI</td>
                            <td>$3,444.0</td>
                            <td>
                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                   Ver Detalles
                                </a>
                            </td>
                            @include('sueldo_cosmes.modal_desglose')
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12">
            <div class="card p-3">
                <div class="row">

                    <div class="col-12 mb-3 mt-3">
                        <h5 class="">Tabla de Sueldo de la semana</h5>
                    </div>

                    <div class="col-12">
                        <table class="table table-flush" id="historial">
                            <thead class="thead">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Concepto</th>
                                    <th>Comision</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @php
                                        $totalBono = 0;
                                        $totalSueldo = 0;
                                        $totalCubierta = 0;
                                        $totalNotas = 0;
                                        $totalPaquetes = 0;
                                        $totalGeneral = 0;
                                        $totalcosmessum = 0;
                                    @endphp
                                    @foreach ($registros_puntualidad as $puntualidad)
                                        @if ($cosme->id == $puntualidad->cosmetologo_id)
                                        @php
                                            $totalBono += 150;
                                        @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($puntualidad->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                <td>Bono de puntualidad</td>
                                                <td>$150</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($registros_sueldo as $sueldo_base)
                                        @if ($cosme->id == $sueldo_base->cosmetologo_id)
                                        @php
                                            $totalSueldo += $sueldo_base->monto_pago;
                                        @endphp

                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                @if ($sueldo_base->monto_pago == '1000')
                                                    <td>Sueldo base <br> + Comision</td>
                                                @else
                                                    <td>Sueldo base</td>
                                                @endif
                                                <td>${{$sueldo_base->monto_pago}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($paquetes_vendidos as $paquete_vendido)
                                        @if ($cosme->id == $paquete_vendido->id_cosme)
                                            @php
                                                $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $cosme->id)->count() * 350;

                                                $totalPaquetes = $sumaPaquetes;
                                            @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($paquete_vendido->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                 <td>Paquete Vendido</td>
                                                <td>$350</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($notasDespedidas as $notaDespedida)
                                        @if ($cosme->id == $notaDespedida->Notas->NotasCosmes->id_user)
                                        @php
                                            // Calcula la cantidad de despedidas vendidas por el cosmetólogo actual
                                            $ventasDespedidas = $notasDespedidas->count();

                                            // Calcula la suma total de comisiones por despedida para este cosmetólogo
                                            $totalComisionDespedida = $ventasDespedidas * $cosme->comision_despedida;

                                            // Suma esta cantidad a tu total general
                                            $totalGeneral += $totalComisionDespedida;
                                        @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($notaDespedida->Notas->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                <td>Despedida Soltera</td>
                                                <td>${{$cosme->comision_despedida}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($registros_cubriendose as $cubierta)
                                        @if ($cosme->id == $cubierta->cosmetologo_id)
                                        @php
                                            $totalCubierta += $cubierta->cosmetologoCubriendo->sueldo_base;
                                        @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($cubierta->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                <td>Se cubrio a: <br> {{$cubierta->cosmetologoCubriendo->name}}</td>
                                                <td>${{$cubierta->cosmetologoCubriendo->sueldo_base}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($regcosmessum as $cosmessum)
                                        @if ($cosme->id == $cosmessum->id_cosme)
                                        @php
                                            $totalcosmessum += $cosmessum->monto;
                                        @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($cosmessum->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                <td>{{$cosmessum->concepto}}</td>
                                                <td>${{$cosmessum->monto}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td></td>
                                        <td><b>${{$totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum}}</b></td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-5">
                        <h4 class="text-left">CARTA DE CONFORMIDAD</h4>
                        <h6 class="text-left">Fecha:  {{$fechaActual}}</h6>
                        <p class="text-left">
                            Por medio de la presente, declaro que me encuentro en buenos términos con la empresa en la que laboro “Instituto Mexicano Naturales Ain Spa”. <br>
                            También declaro que leí mi contrato y el reglamento interno de la empresa, así externo también mi conformidad con recibir mi seguro social y estoy de acuerdo con lo estipulado en dichos documentos. <br><br>

                            Del mismo modo, declaro que me entregaron el sueldo de mi semana, sin ningún adeudo de ningún evento ni nada hasta el momento. <br>
                        </p>
                        <h6 class="text-left">Firma:  </h6>

                        <div id="sig"></div>

                        <textarea id="signed" name="signed" style="display: none"></textarea>

                        <h6 class="text-left mt-3 mb-3">Nombre: <br> {{ $cosme->name }}  </h6>

                        <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                        <button class="btn btn-sm btn-success">Guardar</button>
                    </div>

                </div>


            </div>
        </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>



	<script type="text/javascript" class="init">

        $(document).ready(function(){
            $('#example').DataTable();
            $('#historial').DataTable();

            var sig = $('#sig').signature({syncField: '#signed', syncFormat: 'PNG'});

            $('#clear').click(function (e) {
                e.preventDefault();
                sig.signature('clear');
                $("#signed").val('');
            });


        });

    </script>

  </body>
</html>
