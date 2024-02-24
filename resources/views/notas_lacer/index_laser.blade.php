@extends('layouts.app')

@section('template_title')
    Notas Lacer
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                    <i class="ni ni-folder-17 text-sm me-2"></i> Ficha de Pacientes
                                </a>
                            </li>

                            <li class="nav-item" role="presentation">
                                <a class="nav-link " data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true" id="pills-profile-tab">
                                    <i class="ni ni-credit-card text-sm me-2"></i> Pago
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="" id="" enctype="multipart/form-data" role="form">
                            @csrf

                                <div class="tab-content" id="pills-tabContent">

                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">


                                        <div class="row">

                                            <div class="col-12">
                                                <h3 class="text-center" style="color:#C45584;text-decoration: underline;">Ficha del Paciente</h3>
                                            </div>

                                            <div class="row p-3">
                                                <div class="col-12 mt-3">
                                                    <p class="d-inline mr-5" style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                                        Nombre del paciente
                                                    </p>
                                                    <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                                        Telefono:
                                                    </p>
                                                    <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">

                                                </div>

                                                <div class="col-6 mt-3">
                                                    <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                                        DNI :
                                                    </p>

                                                    <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                                </div>

                                                <div class="col-12 mt-5">
                                                    <div class="table-responsive">
                                                          <table class="table align-items-left mb-0">
                                                            <thead>
                                                              <tr>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zona______________</th>
                                                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Session</th>
                                                                <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parametros</th>
                                                                <th class="text-secondary opacity-7">Observaciones</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>

                                                              <tr>

                                                                <td>
                                                                    <input type="date" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                                                </td>

                                                                <td>
                                                                    <select class="form-control" style="display: inline-block;width: 100%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">>
                                                                        <option value="">Pierna</option>
                                                                    </select>
                                                                </td>

                                                                <td>
                                                                    <input type="number" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">

                                                                </td>

                                                                <td>
                                                                    <input type="number" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">

                                                                </td>

                                                                <td>
                                                                    <textarea class="form-control" cols="10" rows="1"></textarea>
                                                                </td>

                                                              </tr>

                                                            </tbody>
                                                          </table>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

                                    </div>

                                </div>

                                <a class="btn mt-5"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                    Cancelar
                                </a>

                                <button type="submit" class="btn close-modal mt-5" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Guardar
                                </button>

                        </form>

                </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('datatable')



@endsection


