<div class="card mt-4" id="basic-info">
    <div class="card-header">
        <h5>Consentimientos</h5>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <table class="table table-flush" id="datatable-search">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ConcentimientoFacial as $Concentimiento)
                        <tr>
                            <td>{{ $Concentimiento->id }}</td>
                            <td>
                                @if ($Concentimiento->pregunta2 == NULL)
                                    <a href="{{ route('clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #e30800;background-color: #e31a0040;" target="_blank">Facial/Corporal </a>
                                @else
                                    <a href="{{ route('clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #00e300;background-color: #48e30040;" target="_blank">Facial/Corporal </a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('clients_consen.user',$Concentimiento->id) }}"><i class="fas fa-signature"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($ConsentimeintoJacuzzi as $Concentimiento)
                        <tr>
                            <td>{{ $Concentimiento->id }}</td>

                            <td>
                                @if ($Concentimiento->pregunta2 == NULL)
                                    <a href="{{ route('jacuzzi_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #e30800;background-color: #e31a0040;" target="_blank">Jacuzzi </a>
                                @else
                                    <a href="{{ route('jacuzzi_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #00e300;background-color: #48e30040;" target="_blank">Jacuzzi </a>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('jacuzzi_clients_consen.user',$Concentimiento->id) }}"><i class="fas fa-signature"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($ConsentimientoCorporal as $Concentimiento)
                        <tr>
                            <td>{{ $Concentimiento->id }}</td>

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
                    @foreach ($LashLifting as $Concentimiento)
                        <tr>
                            <td>{{ $Concentimiento->id }}</td>

                            <td>
                                @if ($Concentimiento->pregunta2 == NULL)
                                    <a href="{{ route('lash_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #e30800;background-color: #e31a0040;" target="_blank">Lash Lifting </a>
                                @else
                                    <a href="{{ route('lash_clients_consen.cosme',$Concentimiento->id) }}" class="badge badge-pill" style="color: #00e300;background-color: #48e30040;" target="_blank">Lash Lifting </a>
                                @endif
                            </td>

                            <td>
                                <a class="btn btn-sm btn-warning" target="_blank" href="{{ route('lash_clients_consen.user',$Concentimiento->id) }}"><i class="fas fa-signature"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>