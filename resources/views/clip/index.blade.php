@extends('layouts.app')

@section('template_title')
    Clip
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Clip</h3>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Probar envio de datos a la terminal
                              </button>

                              @if (!empty($mensaje))
                                <div class="alert alert-info" role="alert">
                                    {{ $mensaje }}
                                </div>
                            @endif
                        </div>
                    </div>
                    @can('notas-list')

                        <div class="card-body">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <form action="{{ route('buscador.clip') }}" method="GET" >

                                                <div class="card-body" style="">
                                                    <h5>Filtro</h5>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="user_id">Seleccionar Fecha de inicio:</label>
                                                                <input type="date" class="form-control" name="fecha_inicio" id="">
                                                            </div>

                                                            <div class="col-3">
                                                                <label for="user_id">Seleccionar Fecha de Fin:</label>
                                                                <input type="date" class="form-control" name="fecha_fin" id="">
                                                            </div>

                                                            <div class="col-3 mt-5">
                                                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>

                            @if(Route::currentRouteName() != 'clip.index')
                                <div class="table-responsive" style="background-color:#fb91b030 ">
                                    <h5 class="mt-3">Transacciones de las fechas selecionadas</h5>
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>No. recibo</th>
                                                <th>Método de pago</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data['results'] as $index => $result)
                                                <tr>
                                                    <td>
                                                    <strong> {{ date('d/m/Y', strtotime($result['created_at'])) }}</strong> <br>
                                                        {{ date('h:i:s A', strtotime($result['created_at'])) }}
                                                    </td>                                                <td>{{ $result['receipt_no'] }}</td>
                                                    <td>
                                                        <ul>
                                                            <li><strong>Emisor:</strong> {{ $result['payment_method']['card']['issuer'] }}</li>
                                                            <li><strong>País:</strong> {{ $result['payment_method']['card']['country'] }}</li>
                                                            <li><strong>Últimos dígitos:</strong> {{ $result['payment_method']['card']['last_digits'] }}</li>
                                                            <li><strong>Expiración:</strong> {{ $result['payment_method']['card']['exp_month'] }}/{{ $result['payment_method']['card']['exp_year'] }}</li>
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $subtotal = $result['amount'];
                                                            $comision = $subtotal * 0.036;
                                                            $iva_comision = $comision * 0.16;
                                                            $ganancia_neta = $subtotal - $comision - $iva_comision;
                                                        @endphp

                                                         <ul style=" list-style: none;">
                                                            <li><strong>Subtotal</strong> <p style="display: inline-block;color:red">${{ number_format($subtotal, 2) }}</p> </li>
                                                            <li><strong>Comisión por transacción (3.60%) </strong>${{ number_format($comision, 2) }}</li>
                                                            <li><strong>IVA de  comisión (16%)</strong>${{ number_format($iva_comision, 2) }}</li>
                                                            <li><strong>Ganancia neta </strong> <p style="display: inline-block;color: rgb(0, 174, 0)">${{ number_format($ganancia_neta, 2) }}</p> </li>
                                                        </ul>

                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            @else

                            @endif

                            <div class="table-responsive">
                                <h5 class="mt-3">Transacciones de la semana</h5>
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>No. recibo</th>
                                            <th>Método de pago</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['results'] as $index => $result)
                                            <tr>
                                                <td>
                                                   <strong> {{ date('d/m/Y', strtotime($result['created_at'])) }}</strong> <br>
                                                    {{ date('h:i:s A', strtotime($result['created_at'])) }}
                                                </td>                                                <td>{{ $result['receipt_no'] }}</td>
                                                <td>
                                                    <ul>
                                                        <li><strong>Emisor:</strong> {{ $result['payment_method']['card']['issuer'] }}</li>
                                                        <li><strong>País:</strong> {{ $result['payment_method']['card']['country'] }}</li>
                                                        <li><strong>Últimos dígitos:</strong> {{ $result['payment_method']['card']['last_digits'] }}</li>
                                                        <li><strong>Expiración:</strong> {{ $result['payment_method']['card']['exp_month'] }}/{{ $result['payment_method']['card']['exp_year'] }}</li>
                                                    </ul>
                                                </td>
                                                <td>
                                                    @php
                                                        $subtotal = $result['amount'];
                                                        $comision = $subtotal * 0.036;
                                                        $iva_comision = $comision * 0.16;
                                                        $ganancia_neta = $subtotal - $comision - $iva_comision;
                                                    @endphp

                                                     <ul style=" list-style: none;">
                                                        <li><strong>Subtotal</strong> <p style="display: inline-block;color:red">${{ number_format($subtotal, 2) }}</p> </li>
                                                        <li><strong>Comisión por transacción (3.60%) </strong>${{ number_format($comision, 2) }}</li>
                                                        <li><strong>IVA de  comisión (16%)</strong>${{ number_format($iva_comision, 2) }}</li>
                                                        <li><strong>Ganancia neta </strong> <p style="display: inline-block;color: rgb(0, 174, 0)">${{ number_format($ganancia_neta, 2) }}</p> </li>
                                                    </ul>

                                                </td>

                                            </tr>
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

@include('clip.modal_clip')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection


