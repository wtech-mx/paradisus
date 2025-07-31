@extends('layouts.app')

@section('template_title')
    Paquetes Faciales
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Paquetes Faciales</h3>

                                <a type="button" class="btn btn-sm btn-success" href="{{ route('paquetes_faciales.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                </a>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Paquete</th>
                                            <th>Fecha</th>
                                            <th>Restante</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($paquetes as $paquete)
                                                <tr class="text-center">
                                                    <td>{{$paquete->id}}</td>

                                                    <td>{{$paquete->Client->name }} {{ $paquete->Client->last_name }}</td>
                                                    <td>figura Ideal c/Aparatología</td>

                                                    <td>{{$paquete->fecha}}</td>

                                                    @if ($paquete->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $paquete->restante }}</label> </td>
                                                    @endif

                                                    <td>
                                                        <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_uno.firma_edit_uno', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>

                                                        <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_uno.print_uno',$paquete->id)}}"style="color: #ffff">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        
                                                        <a class="btn btn-sm btn-warning" href="{{ route('paquetes_faciales.edit',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('select2')
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });
</script>
@endsection
