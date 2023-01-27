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
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan
                        </div>
                    </div>
                    @can('notas-list')
                        <div class="card-body">
                            @include('notas.create')
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Usuario</th>
                                            <th>Cliente</th>
                                            <th>Servicio</th>
                                            <th>Fecha</th>
                                            <th>Estatus</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    @if (Auth::user()->hasRole('cosmetologa'))
                                        <tbody>
                                            @foreach ($nota_cosme_ind as $notas)
                                            @include('notas.show_cosme')
                                                <tr>
                                                    <td>{{ $notas->id_nota }}</td>
                                                    <td>
                                                        {{$notas->User->name}}
                                                    </td>
                                                    <td>{{ $notas->Notas->Client->name }} {{ $notas->Notas->Client->last_name }}</td>
                                                    <td>
                                                        @foreach($notas_paquetes as $item)
                                                            @if ($item->id_nota == $notas->id)
                                                                {{$item->Servicios->nombre}}<br>

                                                                @if($item->id_servicio2 != NULL)
                                                                    {{$item->Servicios2->nombre}}<br>
                                                                @endif
                                                                @if($item->id_servicio3 != NULL)
                                                                    {{$item->Servicios3->nombre}}<br>
                                                                @endif
                                                                @if($item->id_servicio4 != NULL)
                                                                    {{$item->Servicios4->nombre}}<br>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $notas->Notas->fecha }}</td>

                                                    <td>
                                                            <div class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showCosmeDataModal{{$notas->id_nota}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i> Ver</div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            @foreach ($nota as $notas)
                                            @include('notas.show')
                                            @include('notas.edit')
                                            @if ($notas->cancelado == 1)
                                            <tr style="background-color: #e70f0f40;">
                                            @else
                                            <tr>
                                            @endif

                                                    <td>{{ $notas->id }}</td>
                                                    <td>
                                                        @foreach($nota_cosme as $item)
                                                            @if ($item->id_nota == $notas->id)
                                                               <b>  {{$item->User->name}}</b><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $notas->Client->name }} <br> {{ $notas->Client->last_name }}</td>
                                                    <td>
                                                        @foreach($notas_paquetes as $item)
                                                            @if ($item->id_nota == $notas->id)
                                                                {{$item->Servicios->nombre}}<br>

                                                                @if($item->id_servicio2 != NULL || $item->id_servicio2 != 0)
                                                                    {{$item->Servicios2->nombre}}<br>
                                                                @endif
                                                                @if($item->id_servicio3 != NULL || $item->id_servicio3 != 0)
                                                                    {{$item->Servicios3->nombre}}<br>
                                                                @endif
                                                                @if($item->id_servicio4 != NULL || $item->id_servicio4 != 0)
                                                                    {{$item->Servicios4->nombre}}<br>
                                                                @endif
                                                            @endif
                                                        @endforeach
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

                                                            {{-- <a class="btn btn-sm btn-warning"  href="{{route('notas.print', $notas->id)}}"><i class="fa fa-file-pdf"></i></a> --}}

                                                            <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#showDataModal{{$notas->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></button>
                                                            @can('notas-edit')
                                                                <div class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editDataModal{{$notas->id}}"><i class="fa fa-fw fa-edit"></i></div>
                                                            @endcan
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



@section('js_custom')
    <script type="text/javascript">
        // ============= Agregar mas inputs dinamicamente =============
        $('.clonar2').click(function() {
        // Clona el .input-group
        var $clone = $('#formulario .clonars2').last().clone();

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
        <script type="text/javascript">
            // ============= Agregar mas inputs dinamicamente =============
            $('.clonar3').click(function() {
            // Clona el .input-group
            var $clone = $('#formulario3 .clonars3').last().clone();

            // Borra los valores de los inputs clonados
            $clone.find(':input').each(function () {
                if ($(this).is('select')) {
                this.selectedIndex = 0;
                } else {
                this.value = '';
                }
            });

            // Agrega lo clonado al final del #formulario
            $clone.appendTo('#formulario3');
            });
        </script>
    <script>
        function abrir(url,largo,altura) {
        open(url,'','top=100,left=100,width='+largo+',height='+altura+'') ;
        }

        $(function() {
        $('.toggle-class').change(function() {
                let cosmetologa = $(this).val();
                console.log(cosmetologa)
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('notas.ChangeCosme') }}',
                    data: {
                        'cosmetologa': cosmetologa,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })

        $(function() {
        $('.serv-edit').change(function() {
                let id_servicio = $(this).val();
                console.log(id_servicio)
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('notas.ChangeServicio') }}',
                    data: {
                        'id_servicio': id_servicio,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection

@section('select2')

  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

    <script type="text/javascript">

            $(document).ready(function() {

                $(".cliente").select2({
                    dropdownParent: $("#createDataModal")
                });

                $(".cosme").select2({
                    dropdownParent: $("#createDataModal")
                });

                $(".servicio").select2({
                    dropdownParent: $("#createDataModal")
                });

                $(".servicio2").select2({
                    dropdownParent: $("#createDataModal")
                });

                $(".servicio3").select2({
                    dropdownParent: $("#createDataModal")
                });

                $(".servicio4").select2({
                    dropdownParent: $("#createDataModal")
                });
        });

    </script>

@endsection
