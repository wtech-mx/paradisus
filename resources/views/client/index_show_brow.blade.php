@extends('layouts.app')

@section('template_title')
    Consentimiento Brow Bar
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


                            <h3 class="mb-3">Consentimiento Brow Bar</h3>

                            @can('client-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            @include('client.create')
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
                                        @foreach ($Concentimientos as $Concentimiento)
                                            <tr>
                                                <td>{{ $Concentimiento->id }}</td>

                                                <td>{{ $Concentimiento->Client->name }} <br>{{ $Concentimiento->Client->last_name }}</td>
                                                <td>{{ $Concentimiento->Client->phone }}</td>
                                                <td>{{ $Concentimiento->Client->email }}</td>

                                                <td>
                                                    @if ($Concentimiento->pregunta2 == NULL)
                                                        <a href="{{ route('brow_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #e30800;background-color: #e31a0040;" target="_blank">Brow Bar </a>
                                                    @else
                                                        <a href="{{ route('brow_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #00e300;background-color: #48e30040;" target="_blank">Brow Bar </a>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('brow_clients_consen.user',$Concentimiento->id) }}"><i class="fas fa-signature"></i></a>
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
        });
  </script>
@endsection
