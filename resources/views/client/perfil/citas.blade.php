<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Proximas citas</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush">
                <thead>
                    <tr>
                        <th>Cosmetologa</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alertas as $alerta)
                    @php
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
                            <td>{!! $formattedTitleCosme !!}</td>
                            <td class="fecha-click" data-fecha="{{ \Carbon\Carbon::parse($alerta->start)->format('Y-m-d') }}">
                                {!! \Carbon\Carbon::parse($alerta->start)->format('d-m-Y') !!} <br>
                                {!! \Carbon\Carbon::parse($alerta->start)->format('h:i A') !!} - {!! \Carbon\Carbon::parse($alerta->end)->format('h:i A') !!}
                            </td>
                            <td style="background-color: {{ $alerta->status->color }}">{{ $alerta->status->estatus }} <img src="{{ $alerta->status->icono }}" alt="" style="width: 20px"></td>
                            <td>{!! $formattedTitleServicio !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>