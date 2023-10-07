<div class="row">
    <div class="col-lg-6 mt-4">
        <div class="card h-100">
            <div class="card-body pb-0">
            <div class="row align-items-center mb-3">
                <div class="col-9">
                <h5 class="mb-1">
                    Comentarios
                </h5>
                </div>
            </div>
                <div class="carousel-text" style="height: 10em!important">
                    @foreach ($reportes as $key => $reporte)
                        <p class="{{ $key === 0 ? 'active' : '' }}">
                            {{$reporte->comentario}} <br>
                           <b>¿Se cumplió el tiempo de sesión? </b> {{$reporte->p14}} <br> {{$reporte->p15}}
                        </p>
                    @endforeach
                </div>
                <hr class="horizontal dark">
            <ul class="list-unstyled mx-auto">
                <li class="d-flex">
                    <p class="mb-0">Respondieron dudas:</p>
                    <div class="carousel-badge ms-auto ">
                        @foreach ($reportes as $key => $reporte)
                            <span class="badge badge-secondary {{ $key === 0 ? 'active' : '' }}">{{$reporte->p4}}</span>
                        @endforeach
                    </div>
                </li>
                <li>
                <hr class="horizontal dark">
                </li>
                <li class="d-flex">
                <p class="mb-0">Redes Sociales:</p>
                    <div class="carousel ms-auto">
                        @foreach ($reportes as $key => $reporte)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <div class="rating">
                                    @if ($reporte->p3 == 'Muy mala')
                                        ★☆☆☆☆
                                    @elseif ($reporte->p3 == 'Mala')
                                        ★★☆☆☆
                                    @elseif ($reporte->p3 == 'Neutral')
                                        ★★★☆☆
                                    @elseif ($reporte->p3 == 'Buena')
                                        ★★★★☆
                                    @elseif ($reporte->p3 == 'Muy buena')
                                        ★★★★★
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </li>
            </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        <div class="card h-100">
            <div class="card-body pb-0">
            <div class="row align-items-center mb-3">
                <div class="col-9">
                <h5 class="mb-1">
                    Estadisticas Comentarios
                </h5>
                </div>
            </div>

            <ul class="list-unstyled mx-auto">
                <li class="d-flex">
                    <p class="mb-0">Redes sociales:</p>
                    <div class="ms-auto ">
                        @if ($conteoCalificaciones['Muy mala'] + $conteoCalificaciones['Mala'] > $conteoCalificaciones['Buena'] + $conteoCalificaciones['Muy buena'])
                            <span class="badge badge-danger">Mal servicio</span>
                        @elseif ($conteoCalificaciones['Buena'] + $conteoCalificaciones['Muy buena'] > $conteoCalificaciones['Muy mala'] + $conteoCalificaciones['Mala'])
                            <span class="badge badge-success">Buen servicio</span>
                        @else
                            <span class="badge badge-secondary">Neutral</span>
                        @endif
                    </div>
                </li>
                <li>
                    <hr class="horizontal dark">
                </li>
                <li class="d-flex">
                    <p class="mb-0">Responden dudas:</p>
                    <div class="ms-auto ">
                        @if ($conteoSiNo['si'] > $conteoSiNo['no'])
                            <span class="badge badge-success">Si responden dudas</span>
                        @elseif ($conteoSiNo['no'] > $conteoSiNo['si'])
                            <span class="badge badge-danger">No responden dudas</span>
                        @else
                            <span class="badge badge-secondary">Neutral</span>
                        @endif
                    </div>
                </li>
                <li>
                    <hr class="horizontal dark">
                </li>
                <li class="d-flex">
                    <p class="mb-0">Atención:</p>
                    <div class="ms-auto ">
                        @if ($conteoAtencion['Muy mala'] + $conteoAtencion['Mala'] > $conteoAtencion['Buena'] + $conteoAtencion['Muy buena'])
                            <span class="badge badge-danger">Mala atención</span>
                        @elseif ($conteoAtencion['Buena'] + $conteoAtencion['Muy buena'] > $conteoAtencion['Muy mala'] + $conteoAtencion['Mala'])
                            <span class="badge badge-success">Buena atención</span>
                        @else
                            <span class="badge badge-secondary">Neutral</span>
                        @endif
                    </div>
                </li>
            </ul>

            </div>
        </div>
    </div>
</div>


<div class="row mt-4">
    <div class="col-lg-6 col-md-12">
        <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <div class="d-flex align-items-center">
            <h6 class="mb-0">¿Qué tan probable es que nos recomiendes?</h6>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
            <div class="col-lg-5 col-12 text-center">
                <div class="chart mt-5">
                <canvas id="polar-chart" class="chart-canvas" height="200"></canvas>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <tbody>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ asset('icons/sad.png') }}" class="avatar avatar-sm me-2" alt="logo_xd">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" style="color: #2152ff">Poco probable</h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> {{$conteoPorTipo["Poco probable"]}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ asset('icons/woman.png') }}" class="avatar avatar-sm me-2" alt="logo_atlassian">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" style="color: #dab95e">Algo poco probable</h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> {{$conteoPorTipo["Algo poco probable"]}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ asset('icons/meh.png') }}" class="avatar avatar-sm me-2" alt="logo_slack">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" style="color: #f53939">Neutral</h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> {{ $conteoPorTipo["Neutral"]}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ asset('icons/woman_happy.png') }}" class="avatar avatar-sm me-2" alt="logo_spotify">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" style="color: #5bbd94">Probable</h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> {{$conteoPorTipo["Probable"]}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                <img src="{{ asset('icons/love.png') }}" class="avatar avatar-sm me-2" alt="logo_jira">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm" style="color: #ae5ee4">Bastante probable</h6>
                                </div>
                            </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                            <span class="text-xs font-weight-bold"> {{$conteoPorTipo["Bastante probable"]}} </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <div class="d-flex align-items-center">
            <h6 class="mb-0">¿Cómo calificas el profesionalismo y presentación del equipo de trabajo?</h6>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
            <div class="col-lg-5 col-12 text-center">
                <div class="chart mt-5">
                <canvas id="polar-chart2" class="chart-canvas" height="200"></canvas>
                </div>
            </div>
            <div class="col-lg-7 col-12">
                <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <tbody>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                            <img src="{{ asset('icons/sad.png') }}" class="avatar avatar-sm me-2" alt="logo_xd">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm" style="color: #2152ff">Muy mala</h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{$conteoPorTipoP4["Muy mala"]}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                            <img src="{{ asset('icons/woman.png') }}" class="avatar avatar-sm me-2" alt="logo_atlassian">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm" style="color: #dab95e">Mala</h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{$conteoPorTipoP4["Mala"]}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                            <img src="{{ asset('icons/meh.png') }}" class="avatar avatar-sm me-2" alt="logo_slack">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm" style="color: #f53939">Neutral</h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{ $conteoPorTipoP4["Neutral"]}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                            <img src="{{ asset('icons/woman_happy.png') }}" class="avatar avatar-sm me-2" alt="logo_spotify">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm" style="color: #5bbd94">Buena</h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{$conteoPorTipoP4["Buena"]}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                            <img src="{{ asset('icons/love.png') }}" class="avatar avatar-sm me-2" alt="logo_jira">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm" style="color: #ae5ee4">Muy buena</h6>
                            </div>
                        </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{$conteoPorTipoP4["Muy buena"]}} </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 mt-4 ">
        <div class="card h-100">
        <div class="card-header pb-0 p-3">
            <div class="d-flex align-items-center">
            <h4 class="mb-0">Estadisticas</h4>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <div class="chart mt-5">
                        <canvas id="stacked-bar-chart" class="chart-canvas" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


