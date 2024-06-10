@extends('layouts.app')

@section('breadcrumb')
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-12">
                <div class="card  mb-4">
                    <div class="card-body p-3">
                        <ul class="nav nav-pills nav-fill p-1 mb-5" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-disponibilidad" role="tab" aria-controls="pills-disponibilidad" aria-selected="true" id="pills-disponibilidad-tab">
                                    <i class="ni ni-folder-17 text-sm me-2"></i> Disponibilidad
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-manual" role="tab" aria-controls="pills-manual" aria-selected="true" id="pills-manual-tab">
                                    <i class="ni ni-credit-card text-sm me-2"></i> Busqueda manual
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-disponibilidad" role="tabpanel" aria-labelledby="pills-disponibilidad-tab">
                                @include('alerts.disponibilidad')
                            </div>
                            <div class="tab-pane fade" id="pills-manual" role="tabpanel" aria-labelledby="pills-manual-tab">
                                @include('alerts.manual')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

  @include('layouts.estatus')

@endsection

@section('content')
    {{--calednarioi--}}
    @include('alerts.calendar');
    {{--calednarioi--}}
@endsection
