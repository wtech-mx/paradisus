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
                                    @if (Auth::user()->hasRole('cosmetologa'))
                                    <tbody>
                                        @foreach ($nota_pedido_cosme as $notas)
                                        @include('notas_pedidos.show')
                                        @include('notas_pedidos.edit')
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
                                                        <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a>
                                                        @can('notas-pedido-edit')
                                                            <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a>
                                                        @endcan

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    @else
                                        <tbody>
                                            @foreach ($nota_pedido as $notas)
                                            @include('notas_pedidos.show')
                                            @include('notas_pedidos.edit')
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
                                                            <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a>
                                                            @can('notas-pedido-edit')
                                                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a>
                                                            @endcan

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
                                    @endif
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


@section('js_custom')
<script>
    function abrir(url,largo,altura) {
    open(url,'','top=100,left=100,width='+largo+',height='+altura+'') ;
    }
</script>

<script type="text/javascript">
// ============= Agregar mas inputs dinamicamente =============
$('.clonar').click(function() {
  // Clona el .input-group
  var $clone = $('#formulario .clonars').last().clone();

  // Borra los valores de los inputs clonados
  $clone.find(':input').each(function () {
    if ($(this).is('select')) {
      this.selectedIndex = 0;
    } else {
      this.value = '';
    }
  });

  // Agrega lo clonado al final del #formulario
  $clone.appendTo('#formulario');
});
</script>

@endsection
