@extends('layouts.app')

@section('template_title')
    Reporte
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')

@include('layouts.header')

@php
    $fechaActual = date('d/m/Y');
@endphp

    <div class="container-fluid">
        <div class="row">
            {{-- =============== C A R D   S E R V I C I O S =============================== --}}
            <div class="col-sm-12 mb-5">
                <div class="card">

                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                               <strong>
                                Reportes
                               </strong>
                            </span>
                        </div>

                        <form class="row mt-5" action="{{ route('advance_search') }}" method="GET" >

                            <div class="col-2 ml-3">
                                <label class="form-label">Del</label>
                                <div class="input-group">
                                    <input name="fecha" class="form-control"
                                        type="date" >
                                </div>
                            </div>
                            <div class="col-2">
                                <label class="form-label">Al</label>
                                <div class="input-group">
                                    <input  name="fecha2" type="date" class="form-control" >
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="form-label">Tipo</label>
                                <div class="input-group">
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="" selected>Todos</option>
                                        <option value="NOTA SERVICIO">NOTA SERVICIO</option>
                                        <option value="NOTA PRODUCTOS">NOTA PRODUCTOS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <label class="form-label">Pago</label>
                                <div class="input-group">
                                    <select class="form-control" name="metodo_pago" id="metodo_pago">
                                        <option value="" selected>Todos</option>
                                        <option value="Mercado Pago">Mercado Pago</option>
                                        <option value="Transferencia">Transferencia</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Gift Card">Gift Card</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                            @can('client-create')
                                <button class="btn btn-sm mt-4" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                <a type="button" class="btn btn-sm mt-4 bg-gradient-success" href="{{ route('reporte.index') }}"><i class="fa fa-cash"></i> Limpiar</a>
                            @endcan
                            </div>
                        </form>
                    </div>









                    @can('client-list')
                        <div class="card-body">
                            @include('caja.create')
                            <div class="table-responsive">
                                <table class="table table-hover text-center" id="orden_servicio">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Num Nota</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Restante</th>
                                            <th class="text-center">Metodo de Pago</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reporte as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>

                                                @if ($item->tipo == 'NOTA SERVICIO')
                                                <td>{{ $item->id_nota }}</td>
                                                <td> <label class="badge" style="color: #7500e3;background-color: #7500e36c;">NOTA SERVICIO</label> </td>
                                                @else
                                                <td>{{ $item->id_producto }}</td>
                                                <td> <label class="badge" style="color: #004fe3;background-color: #0062e36c;">NOTA PRODUCTOS</label> </td>
                                                @endif
                                                <td>${{ $item->monto }}</td>
                                                <td><b>${{ $item->restante }}</b></td>
                                                <td><b>{{ $item->metodo_pago }}</b></td>
                                            </tr>
                                        @endforeach
                                        {{-- @foreach ($pedidos_dia as $item)
                                        <tr>
                                            <td>{{ $item->fecha }}</td>
                                            <td>{{ $item->id }}</td>
                                            <td> <label class="badge" style="color: #0017e3;background-color: #002ae36c;">Nota Paquetes</label> </td>
                                            <td>${{ $item->total }}</td>
                                            <td><b>$0</b></td>
                                        </tr>
                                    @endforeach --}}
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
@section('datatable')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
$(document).ready(function() {
            $('#orden_servicio').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'excel',
                    'pdf',
                    'colvis'
                ],
                responsive: true,
                stateSave: true,

                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        });

</script>

@endsection
