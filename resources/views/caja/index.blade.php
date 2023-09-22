@extends('layouts.app')

@section('template_title')
    Caja
@endsection

@section('content')


    <div class="container-fluid">
        <div class="row">
            @php
                $total_ing = 0;

                $total_ing =  $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $caja_vista->inicio;

                $total_egresos = 0;
                $total_egresos = $total_ing - $caja_dia_suma->total;
            @endphp
                {{-- =============== C A R D   T O T A L E S =============================== --}}
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Total') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            {{-- =============== I N G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Ingresos</p>
                                            <h5 class="font-weight-bolder text-white" >
                                                ${{ $total_ing }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle" style="background: {{$configuracion->color_iconos_sidebar}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== E G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Egresos</p>
                                            <h5 class="font-weight-bolder text-white">
                                                ${{ $caja_dia_suma->total }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/presupuesto.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== T O T A L =============================== --}}

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Total</p>
                                            <h5 class="font-weight-bolder text-white">
                                            ${{ $total_egresos }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== S A L D O  I N I C I A L =============================== --}}

                            {{-- @if ($caja == NULL)
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="card  mb-4">
                                        <div class="card-body p-3">
                                            <form method="POST" action="{{ route('caja.caja_inicial') }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Saldo inicial en caja</p>
                                                            <input name="ingresos" id="ingresos" type="number" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <p></p>
                                                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}

                        </div>
                    </div>
                </div>
            </div>

            {{-- =============== C A R D   I N G R E S O S =============================== --}}
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Ingresos
                            </span>
                            @if ($caja_vista->total == NULL)
                            <a type="button" class="btn btn-outline-warning" href="{{ route('caja.corte') }}"
                                onclick="return confirm('¿Estás seguro de que deseas realizar el corte?')">
                                <img src="{{ asset('assets/icons/cortar.png') }}" alt="" width="35px"> -  Corte
                            </a>

                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"> - Retirar
                                </a>
                            @endif
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            @include('caja.create')
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Num Nota</th>
                                            <th>Monto</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pago as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #7500e3;background-color: #7500e36c;">Nota Servicio</label> </td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ $item->pago }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($pago_pedidos as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #004fe3;background-color: #0062e36c;">Nota Pedido</label> </td>
                                                <td>{{ $item->id }}</td>
                                                <td>${{ $item->total }}</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($pago_paquete as $item)
                                        <tr>
                                            <td>{{ $item->fecha }}</td>
                                            <td> <label class="badge" style="color: #e300aa;background-color: #e3009f6c;">Nota Paquete</label> </td>
                                            <td>{{ $item->id }}</td>
                                            <td>${{ $item->pago }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- =============== C A R D   E G R E S O S =============================== --}}
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Egresos
                            </span>

                            @if ($caja_vista->total != NULL)
                                <a type="button" class="btn btn-sm btn-outline-warning" href="{{ route('caja.print_corte') }}">Imprimir Trans/Tarjeta</a>
                                <a type="button" class="btn btn-sm btn-outline-danger" href="{{ route('caja.print_caja') }}">Imprimir Caja</a>
                            @endif

                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Monto</th>
                                            <th>Concepto</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caja_dia as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td>${{ $item->egresos }}</td>
                                                <td>{{ $item->concepto }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDataModal{{ $item->id }}" ><i class="fa fa-cash"></i> Editar</a>
                                                </td>
                                            </tr>
                                            @include('caja.edit')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js_custom')


@endsection
