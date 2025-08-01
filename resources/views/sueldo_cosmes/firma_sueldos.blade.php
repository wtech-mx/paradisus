<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitacora de Sueldo</title>
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
                <form action="{{ route('pagos.advance_search', $cosme->id) }}" method="GET" >
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

        @if(Route::currentRouteName() != 'index.sueldos')
            <div class="col-12 mb-3">
                <div class="card p-2 ">
                    <h5 class="mb-3 mt-3">Registros de de sueldos </h5>
                    <table class="table table-flush" id="example">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Firma</th>
                                <th>Sueldo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($todosPagos as $pago)
                            @php
                                $resultadoFormateado = number_format($pago->monto,2,'.',',');
                            @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($pago->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                    <td>
                                        @if ($pago->firma == NULL)
                                            NO
                                        @else
                                            SI
                                        @endif
                                    </td>
                                    <td>

                                        ${{$resultadoFormateado}}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Ver Detalles
                                        </a>
                                    </td>
                                    @include('sueldo_cosmes.modal_desglose')
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif

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
                                    <th></th>
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
                                        $totalIngresos = 0;
                                        $totalDescuentos = 0;
                                        $sumaTotales = 0;
                                        $sumaServicios = 0;
                                        $sumaServicios2 = 0;
                                        $sumaPedidos = 0;
                                        $comision = 0;
                                        $totalBonoComida = 0;
                                        $paqueteFac = 0;
                                        $propinaCosme = 0;
                                        $sumaPancho = 0;
                                        $primerPago = 0;
                                        $paqueteFacNew = 0;

                                        // Calcular la suma de totales
                                        foreach ($notasPedidos as $notaPedido) {
                                            if ($cosme->id == $notaPedido->id_user) {
                                                $sumaPedidos += $notaPedido->total;
                                            }
                                        }

                                        if($cosme->id == 9){
                                            $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $cosme->id)->sum('monto');
                                            foreach ($notasMaFer as $notaServicio) {
                                                if ($cosme->id == $notaServicio->NotasCosmes->id_user) {
                                                    $sumaServicios2 += $notaServicio->precio;
                                                }
                                            }
                                            $sumaServicios = $sumaPaquetes + $sumaServicios2;
                                        }else{

                                            foreach ($notasServicios as $notaServicio) {
                                                if ($cosme->id == $notaServicio->NotasCosmes->id_user) {
                                                    $sumaServicios += $notaServicio->primer_pago;
                                                }
                                            }

                                            foreach ($paquetesFaciales as $notaServicio) {
                                                if ($cosme->id == $notaServicio->NotasCosmes->id_user) {
                                                    $servicios = array_filter([
                                                        $notaServicio->id_servicio,
                                                        $notaServicio->id_servicio2,
                                                        $notaServicio->id_servicio3,
                                                        $notaServicio->id_servicio4,
                                                    ]);

                                                    $intersect = array_intersect($servicios, [138, 139, 140, 141, 142]);
                                                    $diff = array_diff($servicios, [138, 139, 140, 141, 142]);

                                                    // Verificar si al menos un servicio contiene un valor deseado
                                                    if (count($intersect) > 0) {
                                                        // Verificar si al menos un servicio es diferente de los valores deseados
                                                        if (count($diff) > 0 || count($intersect) > 1) {
                                                            $primerPago = $notaServicio->primer_pago / 2;
                                                            $sumaPancho += $primerPago;
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        foreach ($paquetes_faciales_vendidos as $paquete_facial_vendido){
                                            if ($cosme->id == $paquete_facial_vendido->id_cosme_comision){
                                                if ($paquete_facial_vendido->Servicio->comision == NULL){
                                                    $paqueteFacNew += $paquete_facial_vendido->primerPago->pago;
                                                }
                                            }
                                        }

                                        $sumaTotales = $sumaPedidos + $sumaServicios + $sumaPancho + $paqueteFacNew;
                                        // Calcular la comisión según la lógica proporcionada
                                        if ($sumaTotales >= 2000 && $sumaTotales < 3000) {
                                            $comision = $sumaTotales * 0.03;
                                        } elseif ($sumaTotales >= 3000 && $sumaTotales < 4000) {
                                            $comision = $sumaTotales * 0.05;
                                        } elseif ($sumaTotales >= 4000 && $sumaTotales < 7000) {
                                            $comision = $sumaTotales * 0.06;
                                        } elseif ($sumaTotales >= 7000 && $sumaTotales < 8000) {
                                            $comision = $sumaTotales * 0.07;
                                        } elseif ($sumaTotales >= 8000 && $sumaTotales < 9000) {
                                            $comision = $sumaTotales * 0.08;
                                        } elseif ($sumaTotales >= 9000 && $sumaTotales < 10000) {
                                            $comision = $sumaTotales * 0.09;
                                        } elseif ($sumaTotales >= 10000) {
                                            $comision = $sumaTotales * 0.10;
                                        }

                                        if ($paquetes->paquetes == 1) {
                                            $totalBonoComida = $cosme->bono_comida;
                                        }else{
                                            $totalBonoComida = 0;
                                        }
                                    @endphp
                                    @if ($cosme->id != 9)
                                        @foreach ($paquetesFaciales as $notaServicio)
                                            @if ($cosme->id == $notaServicio->NotasCosmes->id_user)
                                                @php
                                                    $paqueteFac += 350;
                                                @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td><a class="btn btn-sm btn-primary" href="{{ route('notas.edit',$notaServicio->id) }}">Paquete Facial Vendido: #{{$notaServicio->id}}</a></td>
                                                    <td>$350</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    @foreach ($paquetes_faciales_vendidos as $paquete_facial_vendido)
                                        @if ($cosme->id == $paquete_facial_vendido->id_cosme_comision)
                                            @if ($paquete_facial_vendido->Servicio->comision != NULL)
                                                @php
                                                    $paqueteFac += $paquete_facial_vendido->Servicio->comision;
                                                @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($paquete_facial_vendido->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td><a class="btn btn-sm btn-primary" href="{{ route('paquetes_faciales.edit',$paquete_facial_vendido->id) }}">Paquete Facial Vendido: #{{$paquete_facial_vendido->id}}</a></td>
                                                    <td>${{$paquete_facial_vendido->Servicio->comision}}</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    @foreach ($registroSueldoSemanal as $puntualidad)
                                        @if ($cosme->id == $puntualidad->id_cosme)
                                        @php
                                            $totalBono = $cosme->bono_puntualidad;
                                        @endphp
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($puntualidad->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                <td>Bono de puntualidad</td>
                                                <td>
                                                    {{$totalBono}}
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($registros_sueldo as $sueldo_base)
                                        @php
                                            $totalSueldo += $sueldo_base->monto_pago;
                                        @endphp

                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                @if ($sueldo_base->monto_pago == '1000')
                                                    <td>Sueldo base <br> + Comision</td>
                                                @elseif($sueldo_base->cosmetologo_cubriendo != NULL)
                                                    <td>Se cubrio a: <br> {{$sueldo_base->cosmetologoCubriendo->name}}</td>
                                                @else
                                                    <td>Sueldo base</td>
                                                @endif
                                                <td>${{$sueldo_base->monto_pago}}</td>
                                                <td>Hora Entrada: {{ \Carbon\Carbon::parse($sueldo_base->hora_inicio)->format('h:i A') }} <br>
                                                    Hora Salida: {{ \Carbon\Carbon::parse($sueldo_base->hora_fin)->format('h:i A') }} <br>
                                                   <b> Horas Trabajadas: {{$sueldo_base->horas_trabajadas}}</b>
                                                </td>
                                            </tr>
                                    @endforeach
                                    @if ($cosme->id != 9)
                                        @foreach ($paquetes_vendidos as $paquete_vendido)
                                            @if ($cosme->id == $paquete_vendido->id_cosme)
                                                @php
                                                    $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $cosme->id)->count() * 350;

                                                    $totalPaquetes = $sumaPaquetes;
                                                @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($paquete_vendido->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                    <td>
                                                        @if ($paquete_vendido->num_paquete == 1)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_uno.edit_uno',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 2)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_dos.edit_dos',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 3)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_tres.edit_tres',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 4)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_cuatro.edit_cuatro',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 5)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_cinco.edit_cinco',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 6)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_seis.edit_seis',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @elseif ($paquete_vendido->num_paquete == 7)
                                                            <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_siete.edit_siete',$paquete_vendido->id) }}">Paquete Vendido #{{$paquete_vendido->id}}</a>
                                                        @endif
                                                    </td>
                                                    <td>$350</td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                    @foreach ($regcosmessum as $cosmessum)
                                        @if ($cosme->id == $cosmessum->id_cosme)
                                        @php
                                            $totalIngresos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Extra')->sum('monto');
                                            $totalDescuentos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                                            $color = $cosmessum->tipo === 'Extra' ? 'green' : 'red';
                                        @endphp
                                            <tr style="color: {{$color}}">
                                                <td>{{ \Carbon\Carbon::parse($cosmessum->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                <td>
                                                    @if (str_contains($cosmessum->concepto, 'Bono Venta Laser en nota:'))
                                                        <a class="btn btn-sm btn-secondary" href="{{ route('edit.lacer',$cosmessum->id_nota) }}">{{$cosmessum->concepto}}</a>
                                                    @else
                                                        {{$cosmessum->concepto}}</a>
                                                    @endif
                                                </td>
                                                <td>${{$cosmessum->monto}}</td>
                                                <td><b>{{$cosmessum->tipo}}</b></td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    @foreach ($propinas as $propina)
                                        @php
                                            $propinaCosme += $propina->propina;
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($propina->created_at)->format('d \d\e F ') }}</td>
                                            <td>Propina</td>
                                            <td>${{$propina->propina}}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F \d\e\l Y') }}</td>
                                        <td>Total vendido: <b>${{ number_format($sumaTotales, 2) }}</b> </td>
                                        <td>${{ $comision }}</td>
                                        <td>
                                            <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#productoModal-{{$cosme->id}}">
                                                Ver Detalles
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F \d\e\l Y') }}</td>
                                        <td>Bono de comida</td>
                                        <td>
                                            @if($paquetes->paquetes == 1)
                                                {{$cosme->bono_comida}}
                                            @else
                                                $0
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#comidaModal-{{$cosme->id}}">
                                                Ver Detalles
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><strong>Total:</strong></td>
                                        <td></td>
                                        <td>
                                            @php
                                                $resultadoFormateado = number_format(
                                                    ($propinaCosme + $paqueteFac + $totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum + $totalIngresos + $comision + $totalBonoComida) - $totalDescuentos,
                                                    2, // Número de decimales
                                                    '.', // Separador decimal
                                                    ',' // Separador de miles
                                                );
                                            @endphp
                                       <b> ${{$resultadoFormateado}}</b></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>

                    <div class="col-12 mt-5">
                        <h4 class="text-left">CARTA DE CONFORMIDAD</h4>
                        <h6 class="text-left">Fecha:  {{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F \d\e\l Y') }}</h6>
                        <p class="text-left">
                            Por medio de la presente, declaro que me encuentro en buenos términos con la empresa en la que laboro “Instituto Mexicano Naturales Ain Spa”. <br>
                            También declaro que leí mi contrato y el reglamento interno de la empresa, así externo también mi conformidad con recibir mi seguro social y estoy de acuerdo con lo estipulado en dichos documentos. <br><br>

                            Del mismo modo, declaro que me entregaron el sueldo de mi semana, sin ningún adeudo de ningún evento ni nada hasta el momento. <br>
                        </p>
                        <h6 class="text-left">Firma:  </h6>

                        @if ($registroSueldoSemanalActual->firma == NULL)
                            <form method="POST" action="{{ route('pagos.firma', $cosme->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div id="sig"></div>
                                @php
                                $monto = ($totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum + $totalIngresos + $comision + $totalBonoComida) - $totalDescuentos;
                                @endphp
                                <textarea id="signed" name="signed" style="display: none"></textarea>

                                <h6 class="text-left mt-3 mb-3">Nombre: <br> {{ $cosme->name }}  </h6>
                                <input type="text" name="monto" value="{{$monto}}" style="display: none">
                                <input type="text" name="id" value="{{$registroSueldoSemanalActual->id}}" style="display: none">
                                <button id="clear" class="btn btn-sm btn-danger ">Repetir</button>
                                <button class="btn btn-sm btn-success">Guardar</button>
                            </form>
                        @else
                            <img src="{{asset('firmaCosme/'. $registroSueldoSemanalActual->firma)}}" alt="">
                        @endif

                    </div>

                </div>


            </div>
        </div>
        @include('sueldo_cosmes.modal_productos')
        @include('sueldo_cosmes.modal_ver_comida')
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
