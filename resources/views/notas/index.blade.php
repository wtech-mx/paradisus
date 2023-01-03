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

                            <span id="card_title">
                                Notas
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
                            @include('notas.create')
                            <div class="table-responsive">
                                <table class="table table-flush table_id" id="datatable-basic">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>

                                            <th>Usuario</th>
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    @if (Auth::user()->hasRole('cosmetologa'))
                                        <tbody>
                                            @foreach ($nota_usuario as $notas)
                                            @include('notas.show')
                                            @include('notas.edit')
                                                <tr>
                                                    <td>{{ ++$i }}</td>

                                                    <td>{{ $notas->Client->name }} {{ $notas->Client->last_name }}</td>
                                                    <td>{{ $notas->Servicios->nombre }}</td>
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
                                    @else
                                        <tbody>
                                            @foreach ($nota as $notas)
                                            @include('notas.show')
                                            @include('notas.edit')
                                                <tr>
                                                    <td>{{ $notas->id }}</td>

                                                    <td>{{ $notas->Client->name }} {{ $notas->Client->last_name }}</td>
                                                    <td>{{ $notas->Servicios->nombre }}</td>
                                                    <td>{{ $notas->fecha }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-sm" target="_blank"
                                                        href="https://wa.me/52{{$notas->Client->phone}}?text=Hola%20{{$notas->Client->name}}%20{{$notas->Client->last_name}},%20te%20enviamos%20tu%20nota%20de%20servicio:%20%22{{ $notas->Servicios->nombre }}%22%20el%20d%C3%ADa:%20{{ $notas->fecha }}%20Esperamos%20que%20la%20hayas%20pasado%20incre%C3%ADble,%20vuelve%20pronto.%0D%0ADa+click+en+el+siguente+enlace%0D%0A%0D%0A{{route('notas.usuario', $notas->id)}}"
                                                        style="background: #00BB2D; color: #ffff">
                                                        <i class="fa fa-fw fa-whatsapp"></i> WhatsApp</a>
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
                                    @endif
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
                {!! $nota->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
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

$(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

        });
</script>
@endsection

