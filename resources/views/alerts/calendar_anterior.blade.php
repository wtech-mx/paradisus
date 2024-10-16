@extends('layouts.app')

@section('title')
     Calendario Meses anteriores
@endsection

@section('css')

    <!-- Datatable -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.1/index.global.min.js'></script>

    <style>

        .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
            background: #a8a8a8 !important;
        }

        .fc-v-event .fc-event-title {
            font-size: 8.5px;
            color: #000000!important;
        }
        .fc .fc-scrollgrid, .fc .fc-scrollgrid table {
            width: 100%;
            table-layout: fixed;
            background: #fff!important;
        }

        .fc-theme-standard .fc-scrollgrid, .fc-scrollgrid {
            border: none;
            background: #fff;
        }
        .fc-event-time {
            font-size: 7.6px;
            color: #000000!important;
        }
    </style>

@endsection

@section('content')

@php
    // $Y = date('Y') ;
    // $M = date('m');
    // $D = date('d') ;
    // $Fecha = $Y."-".$M."-".$D;
    use Carbon\Carbon;

        // Obtener la fecha de inicio del mes actual y del mes anterior
        $currentDate = Carbon::now();

        $startOfCurrentMonth = $currentDate->copy()->startOfMonth();
        $startOfPreviousMonth = $startOfCurrentMonth->copy()->subMonth();
    $Fecha = $startOfPreviousMonth;

@endphp

    <div class="row">
        <div class="col-12 mt-5">

            <div class="row ">

                <div class="col-6">
                    <label for="total-suma">Buscar Cliente</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <img src="{{ asset('assets/icons/personas.webp') }}" alt="" width="30px">
                        </span>
                        <input class="form-control" type="text" id="title_search" name="title_search">
                    </div>
                </div>

                <div class="col-2 mt-4">
                    <button class="btn btn-sx btn-success" id="btnBuscar">Buscar <img src="{{ asset('assets/icons/buscar.png') }}" alt="" width="20px"></button>
                </div>

                <div class="col-3 mt-4">
                    <button class="btn btn-sx btn-danger" id="btnLimpiar">Limpiar <img src="{{ asset('assets/icons/limpiar-deslizar.png') }}" alt="" width="20px"></button>
                </div>

                <div class="col-1"></div>

                <div class="col-12 mt-5 mb-5">
                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#estatusModal">
                        Estatus de Servicios <img src="{{ asset('assets/icons/carta_res.png') }}" alt="" width="20px">
                    </button>

                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#comidaModal">
                        Comidas de Cosmetologas <img src="{{ asset('assets/icons/muchacha.png') }}" alt="" width="20px">
                    </button>

                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-success" >
                        Mese Actual <img src="{{ asset('assets/icons/flecha-correcta.png') }}" alt="" width="20px">
                    </a>

                </div>

            </div>

            <div id="resultadosContainer">
                <!-- La vista parcial se cargará aquí -->
            </div>
        </div>
    </div>

    <div class="calendar" data-toggle="calendar" id="calendar"></div>

    @include('alerts.modal')
    @include('alerts.modal_comida')
    @include('alerts.estatus')

@endsection

@section('select2')

@include('alerts.js_fullcalendar')

@endsection
