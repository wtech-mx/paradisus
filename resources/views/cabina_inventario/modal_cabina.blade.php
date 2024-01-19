@extends('layouts.app')

@section('template_title')
   Crear Inventario
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Crear Inventario</h3>
                        </div>
                    </div>

                            <div class="modal-body p-3">
                                <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#pills-Info1" id="semana1" role="tab" aria-controls="pills-1" aria-selected="true">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana 1
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Info2" id="semana2" role="tab" aria-controls="pills-2" aria-selected="true">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana 2
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Info3" id="semana3" role="tab" aria-controls="pills-3" aria-selected="true">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana 3
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Info4" id="semana4" role="tab" aria-controls="pills-4" aria-selected="true">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana 4
                                        </button>
                                    </li>

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#pills-Info5" id="semana5" role="tab" aria-controls="pills-5" aria-selected="true">
                                            <i class="ni ni-folder-17 text-sm me-2"></i> Semana 5
                                        </button>
                                    </li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-Info1" role="tabpanel" aria-labelledby="semana1" tabindex="0">
                                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num semana</label>
                                                    <input class="form-control" type="text" name="num_semana" id="num_semana" value="1" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num de Cabina</label>
                                                    <select class="form-select" name="cabina" id="cabina">
                                                        <option  {{ (Request::is('inventario/cabinas/create') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                                        <option  {{ (Request::is('inventario/cabina2/create') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                                        <option  {{ (Request::is('inventario/cabina3/create') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                                        <option  {{ (Request::is('inventario/cabina4/create') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                                        <option  {{ (Request::is('inventario/cabina5/create') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <table class="table table-flush" id="datatable-search">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos_cabinas as $index => $producto)
                                                                        <td>
                                                                            <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                            {{ $producto->nombre }}</td>
                                                                        <td>
                                                                            <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                                <option value="">Con stock</option>
                                                                                <option value="Por Terminar">Por Terminar</option>
                                                                                <option value="Se cambio">Se cambio</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-Info2" role="tabpanel" aria-labelledby="semana2" tabindex="0">
                                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num semana</label>
                                                    <input class="form-control" type="text" name="num_semana" id="num_semana" value="2" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num de Cabina</label>
                                                    <select class="form-select" name="cabina" id="cabina">
                                                        <option  {{ (Request::is('inventario/cabinas/create') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                                        <option  {{ (Request::is('inventario/cabina2/create') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                                        <option  {{ (Request::is('inventario/cabina3/create') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                                        <option  {{ (Request::is('inventario/cabina4/create') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                                        <option  {{ (Request::is('inventario/cabina5/create') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <table class="table table-flush" id="datatable-search">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos_cabinas as $index => $producto)
                                                                        <td>
                                                                            <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                            {{ $producto->nombre }}</td>
                                                                        <td>
                                                                            <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                                <option value="">Con stock</option>
                                                                                <option value="Por Terminar">Por Terminar</option>
                                                                                <option value="Se cambio">Se cambio</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-Info3" role="tabpanel" aria-labelledby="semana3" tabindex="0">
                                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num semana</label>
                                                    <input class="form-control" type="text" name="num_semana" id="num_semana" value="3" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num de Cabina</label>
                                                    <select class="form-select" name="cabina" id="cabina">
                                                        <option  {{ (Request::is('inventario/cabinas/create') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                                        <option  {{ (Request::is('inventario/cabina2/create') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                                        <option  {{ (Request::is('inventario/cabina3/create') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                                        <option  {{ (Request::is('inventario/cabina4/create') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                                        <option  {{ (Request::is('inventario/cabina5/create') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <table class="table table-flush" id="datatable-search">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos_cabinas as $index => $producto)
                                                                        <td>
                                                                            <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                            {{ $producto->nombre }}</td>
                                                                        <td>
                                                                            <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                                <option value="">Con stock</option>
                                                                                <option value="Por Terminar">Por Terminar</option>
                                                                                <option value="Se cambio">Se cambio</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-Info4" role="tabpanel" aria-labelledby="semana4" tabindex="0">
                                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num semana</label>
                                                    <input class="form-control" type="text" name="num_semana" id="num_semana" value="4" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num de Cabina</label>
                                                    <select class="form-select" name="cabina" id="cabina">
                                                        <option  {{ (Request::is('inventario/cabinas/create') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                                        <option  {{ (Request::is('inventario/cabina2/create') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                                        <option  {{ (Request::is('inventario/cabina3/create') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                                        <option  {{ (Request::is('inventario/cabina4/create') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                                        <option  {{ (Request::is('inventario/cabina5/create') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <table class="table table-flush" id="datatable-search">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos_cabinas as $index => $producto)
                                                                        <td>
                                                                            <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                            {{ $producto->nombre }}</td>
                                                                        <td>
                                                                            <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                                <option value="">Con stock</option>
                                                                                <option value="Por Terminar">Por Terminar</option>
                                                                                <option value="Se cambio">Se cambio</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="pills-Info5" role="tabpanel" aria-labelledby="semana5" tabindex="0">
                                        <form method="POST" action="{{ route('cabina_inventario.store') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num semana</label>
                                                    <input class="form-control" type="text" name="num_semana" id="num_semana" value="5" readonly>
                                                </div>

                                                <div class="form-group col-4">
                                                    <label for="">Num de Cabina</label>
                                                    <select class="form-select" name="cabina" id="cabina">
                                                        <option  {{ (Request::is('inventario/cabinas/create') ? 'selected ' : '') }} value="1">Cabina 1</option>
                                                        <option  {{ (Request::is('inventario/cabina2/create') ? 'selected ' : '') }} value="2">Cabina 2</option>
                                                        <option  {{ (Request::is('inventario/cabina3/create') ? 'selected ' : '') }} value="3">Cabina 3</option>
                                                        <option  {{ (Request::is('inventario/cabina4/create') ? 'selected ' : '') }} value="4">Cabina 4</option>
                                                        <option  {{ (Request::is('inventario/cabina5/create') ? 'selected ' : '') }} value="5">Cabina 5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-12">
                                                    <div class="row">
                                                        <table class="table table-flush" id="datatable-search">
                                                            <thead class="thead">
                                                                <tr>
                                                                    <th>Producto</th>
                                                                    <th>Estatus</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($productos_cabinas as $index => $producto)
                                                                        <td>
                                                                            <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                            {{ $producto->nombre }}</td>
                                                                        <td>
                                                                            <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                                <option value="">Con stock</option>
                                                                                <option value="Por Terminar">Por Terminar</option>
                                                                                <option value="Se cambio">Se cambio</option>
                                                                            </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('datatable')

@endsection
