@extends('layouts.app')

@section('template_title')
    Notas Pedidos
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
                            <h3 class="mb-3">Notas Pedidos</h3>

                            @can('notas-pedido-create')
                            <a class="btn btn-sm btn-success" href="{{ route('notas_pedidos.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan
                        </div>
                    </div>

                    @can('notas-pedido-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Cosme</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Metodo Pago</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                        <tbody>
                                            @foreach ($nota_pedido as $notas)
                                                <tr>
                                                    <td>{{ $notas->id }}</td>

                                                    <td>{{ $notas->User->name }}</td>
                                                    <td>{{ $notas->Client->name }} {{ $notas->Client->last_name }}</td>
                                                    <td>${{ $notas->total }} mxn</td>
                                                    @if ($notas->metodo_pago == "Mercado Pago")
                                                    <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">{{ $notas->metodo_pago }}</label> </td>
                                                    @elseif ($notas->metodo_pago == "Transferencia")
                                                    <td> <label class="badge" style="color: #072146;background-color: #0721463b;">{{ $notas->metodo_pago }}</label> </td>
                                                    @else
                                                    <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">{{ $notas->metodo_pago }}</label> </td>
                                                    @endif

                                                    <td>{{ $notas->fecha }}</td>

                                                    <td>

                                                            {{-- <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                            @can('notas-pedido-edit')
                                                                <a class="btn btn-sm btn-success" href="{{ route('notas_pedidos.edit',$notas->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                            @endcan
                                                                <a type="button" class="btn btn-primary btn-sm" href="{{route('notas_pedidos.imprimir',$notas->id)}}"style="color: #ffff">
                                                                    <i class="fa fa-print"></i>
                                                                </a>
                                                            @can('notas-pedido-delete')
                                                                <form action="{{ route('notas.destroy',$notas->id) }}" method="POST" style="display: contents">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
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
<script type="text/javascript">
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

</script>
@endsection


@section('js_custom')
<script>
    function abrir(url,largo,altura) {
    open(url,'','top=100,left=100,width='+largo+',height='+altura+'') ;
    }
</script>

@endsection
