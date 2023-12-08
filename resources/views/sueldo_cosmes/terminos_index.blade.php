@extends('layouts.app')

@section('template_title')
    Terminos Personalizados
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Terminos</h3>

                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modal_terminos" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear terminos
                    </a>

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                        <th>No</th>
                        <th>Usuario</th>
                        <th>titulo</th>
                        <th>firma</th>
                        <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($custom as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->User->name}}</td>
                        <td>{{ $item->titulo }}</td>
                        <td>
                            @if ($item->firma == NULL)
                                <button class="btn btn-outline-dange disabledr">No ha Firmado</button>
                            @else
                            <img src="{{asset('firmaCosme/'. $item->firma)}}" alt="" style="width: 150px">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('terminos.edit', $item->id) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-signature"></i></a>
                            <a type="button" class="btn btn-sm" target="_blank"
                            href="https://wa.me/52{{$item->User->photo}}?text=Hola%20{{$item->User->name}}%20{{ route('terminos.edit', $item->id) }}"
                            style="background: #00BB2D; color: #ffff">
                            <i class="fa fa-whatsapp"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </table>
                </div>

          </div>
        </div>
      </div>
</div>

@include('sueldo_cosmes.modal_terminoscreate')


@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
