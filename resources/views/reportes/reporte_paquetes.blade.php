@extends('layouts.app')

@section('template_title')
    Reporte Paquetes
@endsection
@section('css')
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection
@section('content')

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
                                Reporte Paquetes
                               </strong>
                            </span>
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover text-center" id="orden_servicio">
                                    <thead class="thead">
                                        <tr>
                                            <th class="text-center">Nota</th>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Precio</th>
                                            <th class="text-center">Restante</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Tipo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paquetesFaciales as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->Client->name }} {{ $item->Client->last_name }}</td>
                                                <td>${{ $item->precio }}</td>
                                                <td>${{ $item->restante }}</td>
                                                <td>{{ $item->fecha }}</td>
                                                <td>Paquete Facial</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($paquetesCorporales as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->Client->name }} {{ $item->Client->last_name }}</td>
                                                <td>${{ $item->monto }}</td>
                                                <td>${{ $item->restante }}</td>
                                                <td>{{ $item->fecha1 }}</td>
                                                <td>Paquete Corporal</td>
                                            </tr>
                                        @endforeach
                                        @foreach ($paquetesLaser as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->Client->name }} {{ $item->Client->last_name }}</td>
                                                <td>${{ $item->total }}</td>
                                                <td>${{ $item->restante }}</td>
                                                <td>{{ $item->fecha }}</td>
                                                <td>Paquete Laser</td>
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
@endsection
@section('datatable')
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>

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

