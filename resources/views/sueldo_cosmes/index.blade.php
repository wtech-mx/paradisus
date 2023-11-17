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

            </div>
        </div>

        <div class="row">
            @foreach ($user_pagos as $user_pago)
                <div class="col-md-6 mt-3">
                    <div class="card">

                        <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{$user_pago->name}}</h6>
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
                                        <tr>
                                            <td>Total:</td>
                                            <td></td>
                                            <td><b>${{$totalBono + $totalSueldo + $totalCubierta}}</b></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

@section('datatable')

@endsection
