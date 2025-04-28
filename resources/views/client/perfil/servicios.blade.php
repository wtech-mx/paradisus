<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Servicios</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-search">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Servicio</th>
                        <th>Fecha</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach ($servicios as $notas)
                        @if ($notas->cancelado == 1)
                        <tr style="background-color: #e70f0f40;">
                        @elseif ($notas->anular == 1)
                        <tr style="background-color: #e7ad0f40;">
                        @else
                        <tr>
                        @endif

                                <td>{{ $notas->id }}</td>
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
                                @if ($notas->restante == 0)
                                <td> <label class="badge badge-success" style="font-size: 13px;">Pagado</label> </td>
                                @else
                                <td> <label class="badge badge-danger" style="font-size: 15px;">${{ $notas->restante }}</label> </td>
                                @endif

                                <td>
                                        <a type="button" class="btn btn-sm" target="_blank"
                                        href="https://wa.me/52{{$notas->Client->phone}}?text=Hola%20{{$notas->Client->name}}%20{{$notas->Client->last_name}},%20te%20enviamos%20tu%20nota%20el%20d%C3%ADa:%20{{ $notas->fecha }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.usuario', $notas->id)}}"
                                        style="background: #00BB2D; color: #ffff">
                                        <i class="fa fa-whatsapp"></i></a>
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
</div>