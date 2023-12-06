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

                <a type="button" class="btn btn-outline-warning" href="{{ route('pagos.pdf') }}">
                    <img src="{{ asset('assets/icons/presupuesto.png') }}" alt="" width="35px"> Reporte PDF
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($recepcion_pagos as $user_pago)
                <div class="col-md-6 mt-3">
                    <div class="card">

                        <div class="card-header pb-0 px-3">

                            <h6 class="mb-3">{{$user_pago->name}}</h6>


                            <div class="d-flex justify-content-between">
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes{{$user_pago->id}}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Agregar
                                </a>

                                <a type="button" class="btn bg-primary" href="{{ route('index_recepcion.sueldos', $user_pago->id) }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Firma
                                </a>
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
                                            $totalIngresos = 0;
                                            $totalDescuentos = 0;
                                        @endphp
                                        <tr>
                                            <td>{{$fechaLunes}}</td>
                                            @if ($user_pago->id == 16)
                                                <td>Sueldo Fin de semana</td>
                                            @else
                                                <td>Sueldo Semanal</td>
                                            @endif
                                            <td>${{$user_pago->sueldo_base}}</td>
                                        </tr>
                                        @foreach ($regcosmessum as $item)
                                            @if ($user_pago->id == $item->id_cosme)
                                                @php
                                                    $totalIngresos = $item->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $item->id_cosme)->where('tipo', 'Extra')->sum('monto');
                                                    $totalDescuentos = $item->whereBetween('fecha', [$fechaInicioSemana, $fechaFinSemana])->where('id_cosme', '=', $item->id_cosme)->where('tipo', 'Descuento')->sum('monto');
                                                    $color = $item->tipo === 'Extra' ? 'green' : 'red';
                                                @endphp
                                                <tr style="color: {{$color}}">
                                                    <td>{{$item->fecha}}</td>
                                                    <td>{{$item->concepto}}</td>
                                                    <td>${{$item->monto}}</td>
                                                    <td>{{$item->tipo}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td>Total:</td>
                                            <td></td>
                                            <td><b>${{($user_pago->sueldo_base + $totalIngresos) - $totalDescuentos;}}</b></td>
                                        </tr>
                                    </tbody>
                            </table>
                        </div>
                        @include('sueldo_cosmes.agregar')
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
