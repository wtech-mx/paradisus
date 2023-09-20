
@extends('layouts.app')

@section('template_title')
    Buscador
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                        <div class="card-body">

                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <form action="{{ route('advance_search.buscador') }}" method="GET" >

                                                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                    <h5>Filtro</h5>
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="user_id">Seleccionar cliente:</label>
                                                                <select class="form-control cliente" name="id_client" id="id_client">
                                                                    @foreach($clients as $client)
                                                                        <option value="{{ $client->id }}">{{ $client->name }} {{ $client->last_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <br>
                                                                <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Route::currentRouteName() != 'index.buscador')
                                            @foreach ($nota as $notas)
                                                @if ($notas->cancelado == 1)
                                                    <tr style="background-color: #e70f0f40;">
                                                @elseif ($notas->anular == 1)
                                                    <tr style="background-color: #e7ad0f40;">
                                                @else
                                                    <tr>
                                                @endif
                                                    <td>{{ $notas->id }}</td>
                                                    <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}</td>
                                                    <td>

                                                        @if($notas->Paquetes->id_servicio != NULL || $notas->Paquetes->id_servicio != 0)
                                                            {{$notas->Paquetes->Servicios->nombre}}<br>
                                                        @else
                                                            SN
                                                        @endif
                                                        @if($notas->Paquetes->id_servicio2 != NULL || $notas->Paquetes->id_servicio2 != 0)
                                                            {{$notas->Paquetes->Servicios2->nombre}}<br>
                                                        @endif
                                                        @if($notas->Paquetes->id_servicio3 != NULL || $notas->Paquetes->id_servicio3 != 0)
                                                            {{$notas->Paquetes->Servicios3->nombre}}<br>
                                                        @endif
                                                        @if($notas->Paquetes->id_servicio4 != NULL || $notas->Paquetes->id_servicio4 != 0)
                                                            {{$notas->Paquetes->Servicios4->nombre}}<br>
                                                        @endif

                                                    </td>
                                                    <td>{{ $notas->fecha }}</td>
                                                    <td><label class="badge" style="color: #009ee3;background-color: #009ee340;">Servicio</label></td>
                                                    <td>
                                                            <a type="button" class="btn btn-sm" target="_blank"
                                                            href="https://wa.me/52{{$notas->Client->phone}}?text=Hola%20{{$notas->Client->name}}%20{{$notas->Client->last_name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $notas->fecha }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.usuario', $notas->id)}}"
                                                            style="background: #00BB2D; color: #ffff">
                                                            <i class="fa fa-whatsapp"></i>
                                                            </a>
                                                            <a type="button" class="btn btn-primary btn-sm" href="{{route('notas.usuario_imprimir', $notas->id)}}"style="color: #ffff">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                            @can('notas-edit')
                                                                <a class="btn btn-sm btn-success" href="{{ route('notas.edit',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @endcan
                                                            @if ($notas->paquete == 1)
                                                                <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></button>
                                                            @endif
                                                            @can('notas-delete')
                                                                <form action="{{ route('notas.destroy',$notas->id) }}" method="POST" style="display: contents;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                                </form>
                                                            @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
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
                                                    @endif

                                                    <td>{{$paquete->fecha_inicial}}</td>

                                                    <td><label class="badge" style="color: #072146;background-color: #0721463b;">Paquete</label></td>
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
                                                            @endif
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('datatable')
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });
    </script>

    <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.cliente').select2();
        });
    </script>
@endsection
