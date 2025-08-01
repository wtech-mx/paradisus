@extends('layouts.app')

@section('template_title')
    Recordatorios
@endsection

@section('content')
@php
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

                        <h3 class="mb-3">Recordatorios</h3>

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <form action="{{ route('advance_search.recordatorios') }}" method="GET" >
                                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                                <h5>Filtro</h5>
                                                    <div class="row">
                                                    <div class="col-3">
                                                        <label for="user_id">Seleccionar Fecha:</label>
                                                        <input type="date" id="fecha" name="fecha" class="form-control" required>
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
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Estatus</th>
                                            <th>Cita</th>
                                            <th>¿Enviado?</th>
                                            <th>Confirmo Whats</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(Route::currentRouteName() != 'index.recordatorios')
                                        @foreach ($alertas as $idCliente => $citas)
                                            @php
                                                $cliente = $citas->first();
                                                $nombre = $cliente->title;
                                                $telefono = $cliente->telefono;
                                                $estatus = $cliente->Status->estatus ?? '';
                                                $color = $cliente->Status->color ?? '#ccc';
                                                $fechaFormateada = \Carbon\Carbon::parse($cliente->start)->locale('es')->isoFormat('dddd D [de] MMMM');

                                                // Construir lista de horas y servicios
                                                $detalleCitas = $citas->map(function($cita) {
                                                    $hora = \Carbon\Carbon::parse($cita->start)->format('g:i A');
                                                    $servicio = $cita->Servicios_id->nombre ?? 'Servicio';
                                                    return "$hora ($servicio)";
                                                })->implode(', ');

                                                // Texto para WhatsApp
                                                $texto = "Hola, buen día bonita solo para confirmar tus citas el día $fechaFormateada a las $detalleCitas ☺💖
                                        Recordándote que si a las 6pm - 9:00pm no tenemos respuesta de tu confirmación se dará por confirmada tu cita ☺

                                        ✅Nota Importante✅

                                        🌸✨Al momento de confirmar tu cita ya NO se podrá cancelar o hacer algún cambio
                                        Para hacer algún cambio o cancelar es necesario hacerlo con 3 días de anticipación.
                                        Si llegarás a cancelar tu sesión dentro de 72hrs, 48hrs o el mismo día que te corresponde ya no se podrá tomar en cuenta tu apartado o tu cita agendada y no habrá devolución del mismo.💰

                                        🌸Por políticas para reagendar citas es con 3 días de anticipación, y sólo contarán con UNA oportunidad de reagendar de lo contrario la cita se dará como dada💖

                                        Gracias por tu compresión.

                                        Buen día, ¡te esperamos! 💖";
                                            @endphp

                                            <tr>
                                                <td>{{ $cliente->id }}</td>
                                                <td>{{ $nombre }} - {{ $telefono }}</td>
                                                <td style="background-color: {{ $color }};">
                                                    <a data-bs-toggle="modal" data-bs-target="#editEstatus{{ $cliente->id }}" style="color: #fff">
                                                        <b>{{ $estatus }}</b>
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $fechaFormateada }}
                                                    <ul style="margin-bottom: 0;">
                                                        @foreach ($citas as $cita)
                                                            <li>
                                                                {{ \Carbon\Carbon::parse($cita->start)->format('g:i A') }}
                                                                ({{ $cita->Servicios_id->nombre ?? 'Servicio' }})
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </td>

                                                <td>
                                                    <input data-id="{{ $cliente->id }}" class="toggle-class recordatorio-toggle" type="checkbox"
                                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                        data-on="Active" data-off="InActive" {{ $cliente->recordatorio ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <input data-id="{{ $cliente->id }}" class="toggle-class confirmo-whats-toggle" type="checkbox"
                                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                        data-on="Active" data-off="InActive" {{ $cliente->confirmo_whats ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm" onclick="copyText({{ json_encode($texto) }})"
                                                        style="background-color: #f8c418; color: #ffffff;">Copiar Texto</button>
                                                </td>
                                            </tr>

                                           @foreach ($citas as $cita)
                                                @include('alerts_recordatorios.estatus', ['alerta' => $cita])
                                            @endforeach
                                        @endforeach

                                        @endif
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

<script>
    function copyText(text) {
        // Crear un textarea temporal
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);

        // Seleccionar el contenido del textarea
        textArea.select();
        textArea.setSelectionRange(0, 99999); // Para dispositivos móviles

        // Copiar el texto al portapapeles
        document.execCommand("copy");

        // Eliminar el textarea temporal
        document.body.removeChild(textArea);

        // Notificar al usuario
        alert("Texto copiado al portapapeles");
    }

    $(function() {
        // Asignar el evento a un elemento padre estático
        $('.table-responsive').on('change', '.recordatorio-toggle', function() {
            var recordatorio = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('ChangePendienteStatus.recordatorios') }}',
                data: {
                    'recordatorio': recordatorio,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    });

    // Para el segundo checkbox que controla 'confirmo_whats'
    $('.table-responsive').on('change', '.confirmo-whats-toggle', function() {
        var confirmo_whats = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route('ChangePendienteStatusWhats.recordatorios') }}', // Ajusta la ruta si es necesario
            data: {
                'confirmo_whats': confirmo_whats,
                'id': id
            },
            success: function(data) {
                console.log(data.success);
            }
        });
    });

</script>
@endsection
