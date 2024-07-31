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
        </tr>
    </thead>
    <tbody>
        @foreach($alertas as $alerta)
            <tr>
                <td>{{ $alerta->id }}</td>
                <td>{{ $alerta->title }}</td>
                <td>{{ $alerta->cosmetologa }}</td>
                <td>{!! \Carbon\Carbon::parse($alerta->start)->format('d-m-Y') !!} <br> {!! \Carbon\Carbon::parse($alerta->start)->format('\a \l\a\s h:i A') !!}</td>
                <td>{!! \Carbon\Carbon::parse($alerta->end)->format('d-m-Y') !!} <br> {!! \Carbon\Carbon::parse($alerta->end)->format('\a \l\a\s h:i A') !!}</td>
                <td style="background-color: {{ $alerta->status->color }}">{{ $alerta->status->estatus }} <img src="{{ $alerta->status->icono }}" alt="" style="width: 20px"></td>
                <td>{{ $alerta->service_name  }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
