@extends('layouts.app')

@section('template_title')
    Notas
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h3 class="mb-3">Notas</h3>

                            @can('notas-create')
                                <a class="btn btn-sm btn-success" href="{{ route('notas.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                    </div>
                    @can('notas-list')
                        <div class="card-body">
                            {{-- @include('notas.create') --}}
                            {{-- <form class="row mt-5" action="{{ route('notas.advance_search') }}" method="GET" >
                                <div class="col-2 ml-3">
                                    <label class="form-label">Nombre Cliente</label>
                                    <div class="input-group">
                                        <input name="id_client" id="id_client" class="form-control"
                                            type="text" >
                                    </div>
                                </div>
                                <div class="col-2">
                                    <label class="form-label">ID Nota</label>
                                    <div class="input-group">
                                        <input  name="id" id="id" type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button class="btn btn-sm mt-4 bg-gradient-success" type="submit" >Buscar</button>
                                    <a type="button" class="btn btn-sm mt-4" href="{{ route('notas.index') }}" style="background-color: #F82018; color: #ffffff;"><i class="fa fa-cash"></i> Limpiar</a>
                                </div>
                            </form> --}}

                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            {{-- <th>Usuario</th> --}}
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($nota as $notas)
                                            @if ($notas->cancelado == 1)
                                            <tr style="background-color: #e70f0f40;">
                                            @elseif ($notas->anular == 1)
                                            <tr style="background-color: #e7ad0f40;">
                                            @else
                                            <tr>
                                            @endif

                                            <td>
                                                {{ $notas->id }} <br>

                                                @if ($notas->Encuesta)
                                                    @php
                                                        // Obtener el número de ocurrencias del id_nota actual
                                                        $count = $notas->Encuesta()->count();
                                                    @endphp

                                                    {{-- Mostrar la imagen repetida si hay más de una ocurrencia del id_nota --}}
                                                    @if ($count > 1)
                                                        @for ($i = 0; $i < $count; $i++)
                                                            <img src="{{ asset('assets/icons/topografo.png') }}" alt="" width="30px">
                                                        @endfor
                                                    @else
                                                        <img src="{{ asset('assets/icons/topografo.png') }}" alt="" width="30px">
                                                    @endif

                                                @else
                                                    <img src="{{ asset('assets/icons/esperar.png') }}" alt="" width="30px">
                                                @endif
                                            </td>

                                                    {{-- <td>
                                                        @foreach($nota_cosme as $item)
                                                            @if ($item->id_nota == $notas->id)
                                                               <b>  {{$item->User->name}}</b><br>
                                                            @endif
                                                        @endforeach
                                                    </td> --}}
                                                    <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}<br> {{ $notas->Client->phone }}</td>
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
                                                    <td>{{ \Carbon\Carbon::parse($notas->fecha)->format('d \d\e F \d\e\l Y') }}</td>

                                                    @if ($notas->restante == 0)
                                                    <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                                    @else
                                                    <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $notas->restante }}</label> </td>
                                                    @endif

                                                    <td>
                                                            <a type="button" class="btn btn-sm" target="_blank"
                                                            href="https://wa.me/52{{$notas->Client->phone}}?text=Hola%20{{$notas->Client->name}}%20{{$notas->Client->last_name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $notas->fecha }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.usuario', $notas->id)}}"
                                                            style="background: #00BB2D; color: #ffff">
                                                            <i class="fa fa-whatsapp"></i>
                                                            </a>
                                                            <a type="button" class="btn btn-primary btn-sm" href="{{route('notas.usuario_imprimir', $notas->id)}}"style="color: #ffff">
                                                                <i class="fa fa-print"></i>
                                                            </a>
                                                            {{-- <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></button> --}}
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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection


