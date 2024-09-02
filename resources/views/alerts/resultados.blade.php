<table id="resultadosAlertas" class="table table-dark table-striped p-5 mb-5" id="datatable-search">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Cosmetologa</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Servicio</th>
            <th>Servicio</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alertas as $alerta)
        @php
            $words = explode(' ', $alerta->title);
            $formattedTitle = '';
            foreach($words as $index => $word) {
                $formattedTitle .= $word;
                if (($index + 1) % 2 == 0 && $index < count($words) - 1) {
                    $formattedTitle .= '<br>';
                } else {
                    $formattedTitle .= ' ';
                }
            }

            $words = explode(' ', $alerta->cosmetologa);
            $formattedTitleCosme = '';
            foreach($words as $index => $word) {
                $formattedTitleCosme .= $word;
                if (($index + 1) % 2 == 0 && $index < count($words) - 1) {
                    $formattedTitleCosme .= '<br>';
                } else {
                    $formattedTitleCosme .= ' ';
                }
            }

            $words = explode(' ', $alerta->service_name);
            $formattedTitleServicio = '';
            foreach($words as $index => $word) {
                $formattedTitleServicio .= $word;
                if (($index + 1) % 2 == 0 && $index < count($words) - 1) {
                    $formattedTitleServicio .= '<br>';
                } else {
                    $formattedTitleServicio .= ' ';
                }
            }


        @endphp
            <tr>
                <td>{{ $alerta->id }}</td>
                <td>{!! $formattedTitle !!}</td>
                <td>{!! $formattedTitleCosme !!}</td>
                <td>{!! \Carbon\Carbon::parse($alerta->start)->format('d-m-Y') !!} <br> {!! \Carbon\Carbon::parse($alerta->start)->format('\a \l\a\s h:i A') !!}</td>
                <td>{!! \Carbon\Carbon::parse($alerta->end)->format('d-m-Y') !!} <br> {!! \Carbon\Carbon::parse($alerta->end)->format('\a \l\a\s h:i A') !!}</td>
                <td style="background-color: {{ $alerta->status->color }}">{{ $alerta->status->estatus }} <img src="{{ $alerta->status->icono }}" alt="" style="width: 20px"></td>
                <td>{!! $formattedTitleServicio !!}</td>
                <td>

                    <button type="button" class="btn btn-xs btn-primary modal-trigger" data-target="#modal-{{ $alerta->id }}">
                        Agendar
                    </button>

                    @include('alerts.modal_cita')
                </td>

            </tr>
        @endforeach
    </tbody>
</table>


