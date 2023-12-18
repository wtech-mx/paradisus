@extends('layouts.app')

@section('template_title')
    Pagos
@endsection

@section('content')
<div class="row mt-4">
    <div class="col-12">
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="mb-3">Pagos</h3>

                <a type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes">
                    Asistencia del dia
                </a>

                <a type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#showComida">
                    Hora de Comida
                </a>

                <a type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#corteAsistenciaCosmes">
                    Corte Sueldos
                </a>

            </div>
        </div>
        @include('sueldo_cosmes.corte')
        @include('sueldo_cosmes.modal_comida')
        <div class="row">
            @foreach ($user_pagos as $user_pago)
                <div class="col-md-6 mt-3">
                    <div class="card">

                        <div class="card-header pb-0 px-3">

                            <div class="row">
                                <div class="col-3">
                                    <h6 class="mb-3">{{$user_pago->name}}</h6>
                                </div>

                                <div class="col-3">
                                    <a type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes{{$user_pago->id}}">
                                        Agregar
                                    </a>
                                </div>

                                <div class="col-3">
                                    <a type="button" class="btn btn-outline-danger" href="{{ route('index.sueldos', $user_pago->id) }}">
                                        Firma
                                    </a>
                                </div>

                                <div class="col-3">
                                    <a type="button" class="btn btn-outline-dark" href="{{ route('pagos.pdf', $user_pago->id) }}">
                                        Reporte Sueldo
                                    </a>
                                </div>
                            </div>

                        </div>

                        <div class="card-body pt-4 p-3">
                            <div class="row">
                                <div class="col-3"><b>Fecha</b></div>
                                <div class="col-5"><b>Concepto</b></div>
                                <div class="col-3"><b>Comision</b></div>
                                <div class="col-1"></div>
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
                                    $sumaPedidos = 0;
                                    $comision = 0;
                                    $totalBonoComida = 0;
                                    $paqueteFac = 0;
                                    $propinaCosme = 0;

                                    // Calcular la suma de Pedidos
                                    foreach ($notasPedidos as $notaPedido) {
                                        if ($user_pago->id == $notaPedido->id_user) {
                                            $sumaPedidos += $notaPedido->total;
                                        }
                                    }

                                    foreach ($notasServicios as $notaServicio) {
                                        if ($user_pago->id == $notaServicio->NotasCosmes->id_user) {
                                            $sumaServicios += $notaServicio->primer_pago;
                                        }
                                    }

                                    $sumaTotales = $sumaPedidos + $sumaServicios;
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
                                @endphp
                                @foreach ($paquetesFaciales as $notaServicio)
                                    @if ($user_pago->id == $notaServicio->NotasCosmes->id_user)
                                    @php
                                        $paqueteFac += 350;
                                    @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($notaServicio->fecha)->format('d \d\e F ') }}</div>
                                        <div class="col-5"><a href="{{ route('notas.edit',$notaServicio->id) }}"> Paquete Facial Vendido: #{{$notaServicio->id}} </a></div>
                                        <div class="col-3"><b>$350</b></div>
                                        <div class="col-1"></div>
                                    @endif
                                @endforeach
                                @foreach ($paquetes as $paquete)
                                    @if ($user_pago->id == $paquete->id_cosme)
                                            @php
                                                if($user_pago->id == 22 || $user_pago->id == 23 || $user_pago->id == 5){
                                                    $totalBonoComida = 0;
                                                }elseif ($paquete->paquetes == 1) {
                                                    $totalBonoComida = 130;
                                                }else{
                                                    $totalBonoComida = 0;
                                                }
                                            @endphp
                                            @if ($user_pago->id == 22 || $user_pago->id == 23 || $user_pago->id == 5)
                                            @else
                                        <div class="col-3">{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F ') }}</div>
                                        <div class="col-5">Bono de comida</div>
                                        <div class="col-3"><b>
                                            @if($paquete->paquetes == 1)
                                                $130
                                            @else
                                                $0
                                            @endif
                                     </b></div>
                                        <div class="col-1"></div>
                                        @endif
                                    @endif
                                @endforeach
                                @foreach ($registroSueldoSemanal as $puntualidad)
                                    @if ($user_pago->id == $puntualidad->id_cosme)
                                        @php
                                            if($puntualidad->id_cosme == 23 || $puntualidad->id_cosme == 5 || $puntualidad->id_cosme == 22 ){
                                                $totalBono = 80;
                                            }else{
                                                $totalBono = 150;
                                            }
                                        @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($puntualidad->fecha)->format('d \d\e F ') }}</div>
                                        <div class="col-5">Bono de puntualidad</div>
                                        <div class="col-3"><b>${{$totalBono}}</b></div>
                                        <div class="col-1"></div>
                                    @endif
                                @endforeach
                                @foreach ($registros_sueldo as $sueldo_base)
                                    @if ($user_pago->id == $sueldo_base->cosmetologo_id)
                                        @php
                                            $totalSueldo += $sueldo_base->monto_pago;
                                        @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($sueldo_base->fecha)->format('d \d\e F ') }}</div>
                                        <div class="col-5">
                                            @if ($sueldo_base->monto_pago == '1000')
                                                Sueldo base <br> + Comision
                                            @elseif($sueldo_base->cosmetologo_cubriendo != NULL)
                                                Se cubrio a: <br> {{$sueldo_base->cosmetologoCubriendo->name}}
                                            @else
                                                Sueldo base
                                            @endif
                                        </div>
                                    <div class="col-3">${{$sueldo_base->monto_pago}}</div>
                                        <div class="col-1"></div>
                                    @endif
                                @endforeach
                                @foreach ($paquetes_vendidos as $paquete_vendido)
                                    @if ($user_pago->id == $paquete_vendido->id_cosme)
                                        @php
                                            $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $user_pago->id)->count() * 350;

                                            $totalPaquetes = $sumaPaquetes;
                                        @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($paquete_vendido->fecha_inicial)->format('d \d\e F ') }}</div>
                                        <div class="col-5">Paquete Vendido #{{$paquete_vendido->id}}</div>
                                        <div class="col-3"><b>$350</b></div>
                                        <div class="col-1"></div>
                                    @endif
                                @endforeach
                                @foreach ($regcosmessum as $cosmessum)
                                    @if ($user_pago->id == $cosmessum->id_cosme)
                                        @php
                                            $totalIngresos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Extra')->sum('monto');
                                            $totalDescuentos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                                            $color = $cosmessum->tipo === 'Extra' ? 'green' : 'red';
                                        @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($cosmessum->fecha)->format('d \d\e F ') }}</div>
                                        <div class="col-5">{{$cosmessum->concepto}}</div>
                                        <div class="col-3">${{$cosmessum->monto}}</div>
                                        <div class="col-1">{{$cosmessum->tipo}}</div>
                                    @endif
                                @endforeach
                                @foreach ($propinas as $propina)
                                    @if ($user_pago->id == $propina->id_user)
                                        @php
                                            $propinaCosme += $propina->propina;
                                        @endphp
                                        <div class="col-3">{{ \Carbon\Carbon::parse($propina->created_at)->format('d \d\e F ') }}</div>
                                        <div class="col-5"><a href="{{ route('notas.edit',$propina->id_nota) }}"> Propina en nota: #{{$propina->id_nota}}</a></div>
                                        <div class="col-3">${{$propina->propina}}</div>
                                        <div class="col-1"></div>
                                    @endif
                                @endforeach
                                <div class="col-3">{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F ') }}</div>
                                <div class="col-5">Total vendido: <b>${{ number_format($sumaTotales, 2) }}</b> </div>
                                <div class="col-3">${{ $comision }}</div>
                                <div class="col-1"></div>

                                @php
                                    $resultadoFormateado = number_format(
                                        ($propinaCosme + $paqueteFac + $totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum + $totalIngresos + $comision + $totalBonoComida) - $totalDescuentos,
                                        2, // Número de decimales
                                        '.', // Separador decimal
                                        ',' // Separador de miles
                                    );
                                @endphp
                                <div class="col-3">Total:</div>
                                <div class="col-5"></div>
                                <div class="col-3"><b> ${{$resultadoFormateado}}</b></div>
                                <div class="col-1"></div>
                            </div>
                        </div>

                    </div>
                </div>
                @include('sueldo_cosmes.agregar')
            @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('datatable')

@endsection
