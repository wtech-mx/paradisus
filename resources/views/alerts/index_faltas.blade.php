@extends('layouts.app')

@section('template_title')
Faltas de Cosmes Pasadas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="mb-3">Faltas de Cosmes Pasadas</h3>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Cosme que falto</th>
                                        <th>Cosme que sustituye</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bitacora_horario as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->CosmeFaltante->name }}</td>
                                            <td>{{ $item->CosmeSustituye->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->fecha_inicio)->locale('es')->translatedFormat('l j F Y') }}</td>
                                            <td>
                                                @if ($item->fecha_fin == NULL)
                                                    -
                                                @else
                                                    {{ \Carbon\Carbon::parse($item->fecha_fin)->locale('es')->translatedFormat('l j F Y') }}
                                                @endif
                                            </td>
                                            <td>{{ $item->comentario }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
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
