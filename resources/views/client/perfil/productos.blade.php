<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Productos</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Cosme</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                    <tbody>
                        @foreach ($productos as $notas)
                            <tr>
                                <td>{{ $notas->id }}</td>

                                <td>
                                    @php
                                        $words = explode(' ', $notas->User->name);
                                        $chunks = array_chunk($words, 2);
                                        foreach ($chunks as $chunk) {
                                            echo implode(' ', $chunk) . '<br>';
                                        }
                                    @endphp
                                </td>
                                <td>${{ $notas->total }} mxn</td>
                                <td>
                                    @php
                                    $fecha =  $notas->fecha;
                                    $fecha_timestamp = strtotime($fecha);
                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                    @endphp
                                    {{$fecha_formateada}}
                                </td>

                                <td>

                                        {{-- <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a> --}}
                                        @can('notas-pedido-edit')
                                            <a class="btn btn-xs btn-success" href="{{ route('notas_pedidos.edit',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                        @endcan
                                            <a type="button" class="btn btn-primary btn-xs" href="{{route('notas_pedidos.imprimir',$notas->id)}}"style="color: #ffff">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        @can('notas-pedido-delete')
                                            <form id="myFormEstatus" method="POST" action="{{ route('update_estatus.pedido',  $notas->id) }}" enctype="multipart/form-data" role="form">
                                             @csrf
                                                @method('PATCH')
                                                <input type="hidden" value="Cancelada"name="estatus_cotizacion" >
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-fw fa-trash"></i> </button>
                                            </form>
                                        @endcan
                                        {{-- <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modal_pedido_{{ $notas->id }}">
                                           Productos
                                        </a> --}}
                                </td>
                            </tr>
                            {{-- @include('notas_pedidos.modal_estatus') --}}
                        @endforeach
                    </tbody>
            </table>
        </div>
    </div>
</div>