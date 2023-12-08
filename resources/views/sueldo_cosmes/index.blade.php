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
                            <table class="table table-flush" id="datatable-search">
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
                                            $totalIngresos = 0;
                                            $totalDescuentos = 0;
                                            $sumaTotales = 0;
                                            $comision = 0;
                                            $totalBonoComida = 0;

                                            // Calcular la suma de totales
                                            foreach ($notasPedidos as $notaPedido) {
                                                if ($user_pago->id == $notaPedido->id_user) {
                                                    $sumaTotales += $notaPedido->total;
                                                }
                                            }

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
                                        @foreach ($paquetes as $paquete)
                                            @if ($user_pago->id == $paquete->id_cosme)
                                            @php
                                                $totalBonoComida = 130;
                                            @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($paquete->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td>Bono de comida</td>
                                                    <td>$130</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($registroSueldoSemanal as $puntualidad)
                                            @if ($user_pago->id == $puntualidad->id_cosme)
                                            @php
                                                $totalBono = 150;
                                            @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($puntualidad->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td>Bono de puntualidad</td>
                                                    <td>$150</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($registros_sueldo as $sueldo_base)
                                            @if ($user_pago->id == $sueldo_base->cosmetologo_id)
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
                                            @if ($user_pago->id == $paquete_vendido->id_cosme)
                                                @php
                                                    $sumaPaquetes = $paquetes_vendidos->where('id_cosme', $user_pago->id)->count() * 350;

                                                    $totalPaquetes = $sumaPaquetes;
                                                @endphp
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($paquete_vendido->fecha_inicial)->format('d \d\e F \d\e\l Y') }}</td>
                                                     <td>Paquete Vendido</td>
                                                    <td>$350</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($registros_cubriendose as $cubierta)
                                            @if ($user_pago->id == $cubierta->cosmetologo_id)
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
                                            @if ($user_pago->id == $cosmessum->id_cosme)
                                                @php
                                                    $totalIngresos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Extra')->sum('monto');
                                                    $totalDescuentos = $cosmessum->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $cosmessum->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                                                    $color = $cosmessum->tipo === 'Extra' ? 'green' : 'red';
                                                @endphp
                                                <tr style="color: {{$color}}">
                                                    <td>{{ \Carbon\Carbon::parse($cosmessum->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td>{{$cosmessum->concepto}}</td>
                                                    <td>${{$cosmessum->monto}}</td>
                                                    <td>{{$cosmessum->tipo}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($fechaActual)->format('d \d\e F \d\e\l Y') }}</td>
                                            <td>Total vendido en productos: <b>${{ number_format($sumaTotales, 2) }}</b> </td>
                                            <td>${{ $comision }}</td>
                                            <td>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total:</td>
                                            <td></td>
                                            <td><b>${{($totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum + $totalIngresos + $comision + $totalBonoComida) - $totalDescuentos}}</b></td>
                                        </tr>
                                    </tbody>
                            </table>
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
