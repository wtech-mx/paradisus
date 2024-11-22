@extends('layouts.app')

@section('template_title')
    Client
@endsection

@section('content')
@php
    use App\Models\User;
    use Carbon\Carbon;
@endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif

                        <div class="d-flex justify-content-between">


                            <h3 class="mb-3">Clientes</h3>

                            @can('client-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="container-fluid mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <form action="{{ route('clients.advance_search') }}" method="GET" >

                                        <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                            <h5>Filtro</h5>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="user_id">Seleccionar cliente:</label>
                                                        <select class="form-control cliente" name="id_client" id="id_client">
                                                            <option selected value="">seleccionar cliente</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->name }} {{ $client->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="user_id">Seleccionar Telefono:</label>
                                                        <select class="form-control phone" name="phone" id="phone">
                                                            <option selected value="">seleccionar Telefono</option>
                                                            @foreach($clients as $client)
                                                                <option value="{{ $client->id }}">{{ $client->phone }}</option>
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

                    @can('client-nuevos')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <form class="row mt-3 mb-3" action="{{ route('client_nuevos.filtro') }}" method="GET" >
                                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h6>Filtro nuevos clientes</h6>
                                                    </div>

                                                    <div class="col-6 col-md-4 col-lg-4 py-3">
                                                        <label class="form-label tiitle_products">Rango Fecha de</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text span_custom_tab" >
                                                                <img class="icon_span_tab" src="{{ asset('assets/media/icons/cero.webp') }}" alt="" >
                                                            </span>
                                                            <input id="fecha_inicial_de" name="fecha_inicial_de" type="date"  class="form-control input_custom_tab @error('fecha_inicial_de') is-invalid @enderror"  value="{{ old('fecha_inicial_de') }}" autocomplete="" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 col-md-4 col-lg-4 py-3">
                                                        <label class="form-label tiitle_products">hasta </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text span_custom_tab" >
                                                                <img class="icon_span_tab" src="{{ asset('assets/media/icons/9.webp') }}" alt="" >
                                                            </span>
                                                            <input id="fecha_inicial_a" name="fecha_inicial_a" type="date"  class="form-control input_custom_tab @error('fecha_inicial_a') is-invalid @enderror"  value="{{ old('fecha_inicial_a') }}" autocomplete="" autofocus>
                                                        </div>
                                                    </div>

                                                    <div class="col-6 col-md-4 col-lg-4 py-3">
                                                        <label class="form-label tiitle_products">-</label>
                                                        <div class="input-group">
                                                            <button class="btn btn_filter" type="submit" style="">Filtrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <form class="row mt-3 mb-3" action="{{ route('client_nuevos.pdf') }}" method="GET" >
                                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <button class="btn btn-dark" type="submit" style="">Imprimir PDF</button>
                                                    </div>
                                                    @if(Route::currentRouteName() != 'clients.index')
                                                        <input type="date" name="fecha_inicial_de" value="{{ request('fecha_inicial_de') }}" style="display: none">
                                                        <input type="date" name="fecha_inicial_a" value="{{ request('fecha_inicial_a') }}" style="display: none">
                                                    @else
                                                        <input type="date" name="fecha_inicial_de" value="{{ date('Y-m-d') }}" style="display: none">
                                                        <input type="date" name="fecha_inicial_a" value="{{ date('Y-m-d') }}" style="display: none">
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan

                    @can('client-list')
                        <div class="card-body">
                                @include('client.create')
                            @if(Route::currentRouteName() == 'clients.index')
                                @include('consentimiento.modal_create')
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Nombre</th>
                                                <th>Telefono</th>
                                                <th>Email</th>

                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Route::currentRouteName() != 'clients.index')
                                                    @foreach ($user as $item)
                                                        @include('client.edit')
                                                        <tr>
                                                            <td>{{ $item->id }}</td>

                                                            <td>{{ $item->name }} <br>{{ $item->last_name }}</td>
                                                            <td>{{ $item->phone }}</td>
                                                            <td>{{ $item->email }}</td>

                                                            <td>
                                                                {{-- <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$item->id}}" style="color: #ffff"><i class="fa fa-fw fa-eye"></i></a> --}}
                                                                @can('client-edit')
                                                                    <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editClientModal{{$item->id}}" style="color: #ffff"><i class="fa fa-fw fa-edit"></i></a>
                                                                @endcan
                                                                @can('client-delete')
                                                                    <form action="{{ route('clients.destroy',$item->id) }}" method="POST" style="display: contents">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                                                    </form>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Servicio</th>
                                                <th>Cosmetologa</th>
                                                <th>Estatus</th>
                                                <th>Fecha cita</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($HistorialVendidos as $item)
                                                @php
                                                 $users = User::whereIn('resourceId', explode(', ', $item->resourceIds))->get();
                                                 $userNames = $users->pluck('name')->implode(', ');
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>{{ $item->Client->name }} {{ $item->Client->last_name }} <br> {{ $item->Client->phone }}</td>
                                                    <td>
                                                        {{ $item->Servicios_id->nombre }}
                                                        @if ($item->id_servicio2 != NULL)
                                                            <br> {{ $item->Servicios_id2->nombre }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $userNames }}</td>
                                                    <td>{{ $item->estatus }}</td>
                                                    <td>{{ Carbon::parse($item->start)->locale('es')->translatedFormat('d F Y h:i a') }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @endif
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
      deferRender:true,
      paging: true,
      pageLength: 10
    });

</script>
@endsection

@section('select2')
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">
        $(document).ready(function() {
            $('.cliente').select2();
            $('.phone').select2();
        });
  </script>

{{-- <script type="text/javascript">
    $(function () {
      var table = $('.user_datatable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('clients.index') }}",
          columns: [
              {data: 'id', name: 'id'},
              {data: 'name', name: 'name'},
              {data: 'phone', name: 'phone'},
              {data: 'email', name: 'email'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
      });
    });
  </script> --}}
@endsection
