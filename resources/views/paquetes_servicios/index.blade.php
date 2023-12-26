@extends('layouts.app')

@section('template_title')
    Paquetes
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
                            <h3 class="mb-3">Paquetes</h3>

                            @can('notas-pedido-create')
                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#showDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-plus"></i> Crear
                                </a>
                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
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
                                                    @if ($paquete->num_paquete == 1)
                                                        <td>figura Ideal c/Aparatología</td>
                                                    @elseif ($paquete->num_paquete == 2)
                                                        <td>Lipoescultura s/Cirugía</td>
                                                    @elseif ($paquete->num_paquete == 3)
                                                        <td>Moldeante & Reductivo</td>
                                                    @elseif ($paquete->num_paquete == 4)
                                                        <td>Drenante & Linfático</td>
                                                    @elseif ($paquete->num_paquete == 5)
                                                        <td>Glúteos Definido & Perfectos</td>
                                                    @elseif ($paquete->num_paquete == 6)
                                                        <td>Piernas de 10 <br> Anticelulítico & Reafirmante</td>
                                                    @elseif ($paquete->num_paquete == 7)
                                                        <td>Brazos Definidos</td>
                                                    @endif

                                                    <td>{{$paquete->fecha_inicial}}</td>

                                                    @if ($paquete->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $paquete->restante }}</label> </td>
                                                    @endif

                                                    <td>
                                                        {{-- <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></button> --}}
                                                            @if ($paquete->num_paquete == 1)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_uno.firma_edit_uno', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_uno.print_uno',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 2)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_dos.firma_edit_dos', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_dos.print_dos',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 3)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_tres.firma_edit_tres', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_tres.print_tres',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 4)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_cuatro.firma_edit_cuatro', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_cuatro.print_cuatro',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 5)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_cinco.firma_edit_cinco', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_cinco.print_cinco',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 6)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_seis.firma_edit_seis', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_seis.print_seis',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @elseif ($paquete->num_paquete == 7)
                                                                <a class="btn btn-sm btn-primary" href="{{ route('firma_paquete_siete.firma_edit_siete', $paquete->id) }}" target="_blanck"><i class="fas fa-signature"></i> </a>
                                                                <a type="button" class="btn btn-success btn-sm" href="{{route('print_paquete_siete.print_siete',$paquete->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @endif
                                                        @can('notas-edit')
                                                            @if ($paquete->num_paquete == 1)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_uno.edit_uno',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 2)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_dos.edit_dos',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 3)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_tres.edit_tres',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 4)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_cuatro.edit_cuatro',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 5)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_cinco.edit_cinco',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 6)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_seis.edit_seis',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @elseif ($paquete->num_paquete == 7)
                                                                <a class="btn btn-sm btn-warning" href="{{ route('edit_paquete_siete.edit_siete',$paquete->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @endif
                                                        @endcan
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
@include('paquetes_servicios.show')
@endsection
@section('datatable')
<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      deferRender:true,
      paging: true,
      pageLength: 10
    });

</script>
@endsection
