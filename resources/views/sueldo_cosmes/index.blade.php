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

                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    Asistencia del dia
                </a>

                <a type="button" class="btn btn-outline-warning" href="{{ route('pagos.pdf') }}">
                    <img src="{{ asset('assets/icons/presupuesto.png') }}" alt="" width="35px"> Precorte
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($user_pagos as $user_pago)
                <div class="col-md-6 mt-3">
                    <div class="card">

                        <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{$user_pago->name}}</h6>

                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes{{$user_pago->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Agregar
                        </a>
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
                                        @endphp
                                        @foreach ($registros_puntualidad as $puntualidad)
                                            @if ($user_pago->id == $puntualidad->cosmetologo_id)
                                            @php
                                                $totalBono += 150;
                                            @endphp
                                                <tr>
                                                    <td>{{$puntualidad->fecha}}</td>
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
                                                    <td>{{$sueldo_base->fecha}}</td>
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
                                                    <td>{{$paquete_vendido->fecha_inicial}}</td>
                                                     <td>Paquete Vendido</td>
                                                    <td>$350</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($notasDespedidas as $notaDespedida)
                                            @if ($user_pago->id == $notaDespedida->Notas->NotasCosmes->id_user)
                                            @php
                                                // Calcula la cantidad de despedidas vendidas por el cosmetólogo actual
                                                $ventasDespedidas = $notasDespedidas->count();

                                                // Calcula la suma total de comisiones por despedida para este cosmetólogo
                                                $totalComisionDespedida = $ventasDespedidas * $user_pago->comision_despedida;

                                                // Suma esta cantidad a tu total general
                                                $totalGeneral += $totalComisionDespedida;
                                            @endphp
                                                <tr>
                                                    <td>{{$notaDespedida->Notas->fecha}}</td>
                                                    <td>Despedida Soltera</td>
                                                    <td>${{$user_pago->comision_despedida}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($registros_cubriendose as $cubierta)
                                            @if ($user_pago->id == $cubierta->cosmetologo_id)
                                            @php
                                                $totalCubierta += $cubierta->cosmetologoCubriendo->sueldo_base;
                                            @endphp
                                                <tr>
                                                    <td>{{$cubierta->fecha}}</td>
                                                    <td>Se cubrio a: <br> {{$cubierta->cosmetologoCubriendo->name}}</td>
                                                    <td>${{$cubierta->cosmetologoCubriendo->sueldo_base}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @foreach ($regcosmessum as $cosmessum)
                                            @if ($user_pago->id == $cosmessum->id_cosme)
                                            @php
                                                $totalcosmessum += $cosmessum->monto;
                                            @endphp
                                                <tr>
                                                    <td>{{$cosmessum->fecha}}</td>
                                                    <td>{{$cosmessum->concepto}}</td>
                                                    <td>${{$cosmessum->monto}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>Total:</td>
                                            <td></td>
                                            <td><b>${{$totalBono + $totalSueldo + $totalCubierta + $totalPaquetes + $totalGeneral + $totalcosmessum}}</b></td>
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