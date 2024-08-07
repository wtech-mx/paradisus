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
                        <td>
                            @if(!isset($item->User->name ))
                                {{ $item->cosmemanual}}
                            @else
                                {{ $item->User->name}}
                            @endif
                        </td>
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

                            @if(!isset($item->User->name ))
                            <a type="button" class="btn btn-sm" target="_blank"
                            href="https://wa.me/52{{$item->cosmemanual_tel}}?text=Hola%20{{$item->cosmemanual}}%20{{ route('terminos.edit', $item->id) }}"
                            style="background: #00BB2D; color: #ffff">
                            <i class="fa fa-whatsapp"></i>
                            </a>

                            @else

                                <a type="button" class="btn btn-sm" target="_blank"
                                href="https://wa.me/52{{$item->User->photo}}?text=Hola%20{{$item->User->name}}%20{{ route('terminos.edit', $item->id) }}"
                                style="background: #00BB2D; color: #ffff">
                                <i class="fa fa-whatsapp"></i>
                                </a>
                            @endif



                            <a type="button" class="btn btn-outline-dark" href="{{ route('treminos.pdf', $item->id) }}">
                                PDF
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

    document.addEventListener('DOMContentLoaded', function() {
    var cosmeNoRadio = document.getElementById('cosme_no');
    var cosmeSiRadio = document.getElementById('cosme_si');
    var campoCosmeManual = document.getElementById('campo_cosmemanual');

    function toggleCosmeManualField() {
        if (cosmeSiRadio.checked) {
            campoCosmeManual.style.display = 'flex';
        } else {
            campoCosmeManual.style.display = 'none';
        }
    }

    cosmeNoRadio.addEventListener('change', toggleCosmeManualField);
    cosmeSiRadio.addEventListener('change', toggleCosmeManualField);

    // Llamada inicial para configurar el campo en función del valor predeterminado
    toggleCosmeManualField();
});


</script>

@endsection
