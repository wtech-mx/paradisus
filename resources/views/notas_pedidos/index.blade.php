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
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Notas Pedidos
                            </span>
                            @can('notas-create')
                                <div class="btn btn-sm" data-toggle="modal" data-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Nueva Nota
                                </div>
                            @endcan
                        </div>
                    </div>
                    @can('notas-list')
                        <div class="card-body">
                            @include('notas_pedidos.create')
                            <div class="table-responsive">
                                <table class="table table-flush table_id" id="datatable-basic">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Usuario</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Metodo Pago</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach ($nota_pedido as $notas)
                                            @include('notas_pedidos.show')
                                            @include('notas_pedidos.edit')
                                                <tr>
                                                    <td>{{ ++$i }}</td>

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

                                                            <div class="btn btn-sm btn-primary " data-toggle="modal" data-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> Ver</div>
                                                            @can('notas-edit')
                                                                <div class="btn btn-sm btn-success" data-toggle="modal" data-target="#editDataModal{{$notas->id}}"><i class="fa fa-fw fa-edit"></i> Editar</div>
                                                            @endcan
                                                            @can('notas-delete')
                                                                <form action="{{ route('notas.destroy',$notas->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
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
                {!! $nota_pedido->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
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

    // Select 2
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

// ============= Sumar inputs =============
// function sumar (valor) {
//     var total = 0;
//     valor = parseInt(valor); // Convertir el valor a un entero (número).
//     total = document.getElementById('spTotal').innerHTML;

//     // Aquí valido si hay un valor previo, si no hay datos, le pongo un cero "0".
//     total = (total == null || total == undefined || total == "") ? 0 : total;

//     /* Esta es la suma. */
//     total = (parseInt(total) + parseInt(valor));

//     // Colocar el resultado de la suma en el control "span".
//     document.getElementById('spTotal').innerHTML = total;
// }

</script>

@endsection

