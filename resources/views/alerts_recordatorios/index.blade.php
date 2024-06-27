@extends('layouts.app')

@section('template_title')
    Recordatorios
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

                        <h3 class="mb-3">Recordatorios</h3>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>No</th>
                                            <th>Nombre</th>
                                            <th>Estatus</th>
                                            <th>Email</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alertas as $alerta)
                                            <tr>
                                                <td>{{ $alerta->id }}</td>

                                                <td>{{ $alerta->title }}</td>
                                                <td style="background-color: {{ $alerta->Status->color }};">
                                                    <a type="button" data-bs-toggle="modal" data-bs-target="#editEstatus{{$alerta->id}}" style="color: #fff">
                                                       <b> {{ $alerta->Status->estatus }} </b>
                                                    </a>
                                                </td>
                                                <td>{{ $alerta->start }}</td>

                                                <td>
                                                    <button class="btn btn-sm enviarWhatsapp"
                                                            data-id="{{ $alerta->id }}"
                                                            data-start="{{ $alerta->start }}"
                                                            data-client-id="{{ $alerta->id_client }}"
                                                            style="background: #00BB2D; color: #ffff">
                                                            <i class="fa fa-whatsapp"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @include('alerts_recordatorios.estatus')
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

    $(document).ready(function() {
    $('.enviarWhatsapp').on('click', function() {
        const alertaId = $(this).data('id');
        const start = $(this).data('start');
        const clientId = $(this).data('client-id');

        // Formatear la fecha y hora de la alerta
        const startDate = new Date(start);
        const day = startDate.toLocaleDateString('es-ES', { weekday: 'long' });
        const formattedDay = day.charAt(0).toUpperCase() + day.slice(1);
        const date = startDate.toLocaleDateString('es-ES', { day: '2-digit', month: 'long' });
        const time = startDate.toLocaleTimeString('es-ES', { hour: '2-digit', minute: '2-digit' });

        // Hacer una solicitud AJAX para obtener el número de teléfono del cliente
        $.ajax({
            url: '/get-client-phone/' + clientId,
            method: 'GET',
            success: function(response) {
                const phone = response.phone;
                const message = `Hola, buen día bonita solo para confirmar tu cita el día ${formattedDay} ${date} a las ${time} 😄❤️
Recordándote que si a las 6pm - 9:00pm no tenemos respuesta de tu confirmación se dará por confirmada tu cita ☺

✅Nota Importante✅

🌸✨Al momento de confirmar tu cita ya NO se podrá cancelar o hacer algún cambio
Para hacer algun cambio o cancelar es necesario hacerlo con 3 dias de anticipación.
Si llegarás a cancelar tu sesión dentro de 72hrs, 48hrs o el mismo día que te corresponde ya no se podrá tomar en cuenta tu apartado o tu cita agendada y no habrá devolución del mismo.💰

🌸Por políticas para reagendar citas es con 3 días de anticipación, y sólo contarán con UNA oportunidad de reagendar de lo contrario la cita se dará como dada❤️

Gracias por tu compresión.

Buen dia, Te esperamos ❤️`;

                const whatsappUrl = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            },
            error: function(error) {
                console.log('Error fetching client phone:', error);
            }
        });
    });
});

</script>
@endsection
