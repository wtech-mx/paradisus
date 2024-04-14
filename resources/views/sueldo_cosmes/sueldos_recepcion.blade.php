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

                                <a type="button" class="btn bg-warning" href="{{ route('pagos_recepcion.pdf', $user_pago->id) }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Reporte  de sueldos
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
                                            <td></td>
                                        </tr>

                                        @foreach ($paquetes as $paquete)
                                            @if ($user_pago->id == $paquete->id_cosme)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($paquete->fecha)->format('d \d\e F \d\e\l Y') }}</td>
                                                    <td>Bono de comida</td>
                                                    <td>${{$user_pago->bono_comida}}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('pagos.quitar_comida', $user_pago->id) }}" enctype="multipart/form-data" role="form">
                                                            @csrf
                                                            <input type="hidden" name="_method" value="PATCH">
                                                            <input type="text" id="paquetes" name="paquetes" value="0" style="display: none">
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas quitarlo?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach

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
                                            <td>
                                                @php
                                                    $resultadoFormateado = number_format(
                                                        ($user_pago->sueldo_base + $totalIngresos + $user_pago->bono_comida) - $totalDescuentos,
                                                        2, // Número de decimales
                                                        '.', // Separador decimal
                                                        ',' // Separador de miles
                                                    );
                                                @endphp
                                                <b>${{$resultadoFormateado}}</b></td>
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
