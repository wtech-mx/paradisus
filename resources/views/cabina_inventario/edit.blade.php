@extends('layouts.app')

@section('template_title')
   Editar Inventario
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Editar Inventario</h3>

                            <a class="btn"  href="{{ route('inventario.index1') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>

                        </div>
                    </div>

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
                            <form method="POST" action="{{ route('cabina1.update_cabina1', $cabinaInventario->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">

                                        <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="1">

                                        <div class="form-group col-6">
                                            <label for="">Num de Cabina</label>
                                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}" readonly>
                                        </div>

                                        @if(count($products_invs1) > 0)
                                            <div class="form-group col-6">
                                                <label for="">Fecha</label> <br>
                                                @if(isset($fechasPorSemana[1]))
                                                    {{ \Carbon\Carbon::parse($fechasPorSemana[1])->format('d/m/Y') }}
                                                @else
                                                    Sin fecha
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group col-12">
                                            <h3>Insumos</h3>
                                            @if ($products_invs1->isEmpty())
                                                <table class="table table-flush" id="datatable-search">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($productos_cabinas as $index => $producto)
                                                                <td>
                                                                    <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                    {{ $producto->nombre }}</td>
                                                                <td>
                                                                    <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                        <option value="">En stock</option>
                                                                        <option value="Por Terminar">Por Terminar</option>
                                                                        <option value="Se cambio">Se cambio</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @foreach ($products_invs1 as $productoInventario)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Producto</label><br>
                                                                    <select class="form-select" id="producto[]" name="producto[]" disabled>
                                                                        <option value="">{{ $productoInventario->Productos->nombre }}</td></option>

                                                                        @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Cantidad</label><br>
                                                                        <input class="form-control" type="text" value="{{ $productoInventario->cantidad }}" name="stock[]" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="estatus[]">Estatus</label>
                                                                    <select class="form-select" id="estatus[]" name="estatus[]" disabled>
                                                                        <option value="">Selecionar</option>
                                                                        <option value="En stock" @if ($productoInventario->estatus == "En stock") selected @endif>En stock</option>
                                                                        <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                        <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="row">

                                            <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}">
                                            <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="1">
                                            @if ($products_invs1->isEmpty())
                                            @else
                                                <div class="form-group col-12">
                                                    <div id="formulario" class="mt-4">

                                                        <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">Cantidad</label><br>
                                                                            <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">En stock</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($cabina_fotos == null)
                                                <div class="form-group">
                                                    <label for="nota">Foto</label>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>
                                            @else

                                                @foreach ($cabina_fotos as $cabina_foto)
                                                    @if ($cabina_foto->id_inv == '1')
                                                        <a href="{{ asset('foto_servicios/' . $cabina_foto->foto) }}" target="_blank">Ver</a>
                                                    @endif
                                                @endforeach
                                            @endif

                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>


                                </div>
                            </form>
                            </div>

                        <div class="tab-pane fade" id="pills-Info2" role="tabpanel" aria-labelledby="semana2" tabindex="0">
                            <form method="POST" action="{{ route('cabina1.update_cabina1', $cabinaInventario->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">

                                        <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="2">

                                        <div class="form-group col-6">
                                            <label for="">Num de Cabina</label>
                                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Fecha</label> <br>
                                            @if(isset($fechasPorSemana[2]))
                                                {{ \Carbon\Carbon::parse($fechasPorSemana[2])->format('d/m/Y') }}
                                            @else
                                                Sin fecha
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <h3>Insumos</h3>
                                            @if ($products_invs2->isEmpty())
                                                <table class="table table-flush" id="datatable-search">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantitdad</th>
                                                            <th>Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($productos_cabinas as $index => $producto)
                                                                <td>
                                                                    <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                    {{ $producto->nombre }}</td>
                                                                <td>
                                                                    <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                        <option value="">En stock</option>
                                                                        <option value="Por Terminar">Por Terminar</option>
                                                                        <option value="Se cambio">Se cambio</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @foreach ($products_invs2 as $productoInventario)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Producto</label><br>
                                                                    <select class="form-select" id="producto[]" name="producto[]" disabled>
                                                                        <option value="">Seleciona el producto</option>

                                                                        @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Cantidad</label><br>
                                                                        <input class="form-control" type="text" value="{{ $productoInventario->cantidad }}" name="stock[]" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="estatus[]">Estatus</label>
                                                                    <select class="form-select" id="estatus[]" name="estatus[]" disabled>
                                                                        <option value="">Selecionar</option>
                                                                        <option value="En stock" @if ($productoInventario->estatus == "En stock") selected @endif>En stock</option>
                                                                        <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                        <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif

                                        </div>

                                        @if ($products_invs2->isEmpty())
                                        @else
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="2">

                                                <div class="form-group col-12">
                                                    <div id="formulario2" class="mt-4">

                                                        <button type="button" class="clonar2 btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars2">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">Producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">Cantidad</label><br>
                                                                            <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">Estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">En stock</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label for="nota">Foto</label>
                                            <input type="file" id="foto" class="form-control" name="foto">
                                        </div>
                                        @foreach ($cabina_fotos as $cabina_foto)
                                            @if ($cabina_foto->id_inv == '2')
                                                <a href="{{ asset('foto_servicios/' . $cabina_foto->foto) }}" target="_blank">Ver</a>
                                            @endif
                                        @endforeach

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-Info3" role="tabpanel" aria-labelledby="semana3" tabindex="0">
                            <form method="POST" action="{{ route('cabina1.update_cabina1', $cabinaInventario->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">

                                        <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="3">

                                        <div class="form-group col-6">
                                            <label for="">Num de Cabina</label>
                                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Fecha</label> <br>
                                            @if(isset($fechasPorSemana[3]))
                                                {{ \Carbon\Carbon::parse($fechasPorSemana[3])->format('d/m/Y') }}
                                            @else
                                                Sin fecha
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <h3>Insumos</h3>
                                            @if ($products_invs3->isEmpty())
                                                <table class="table table-flush" id="datatable-search">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantitdad</th>
                                                            <th>Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($productos_cabinas as $index => $producto)
                                                                <td>
                                                                <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                {{ $producto->nombre }}
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                        <option value="">En stock</option>
                                                                        <option value="Por Terminar">Por Terminar</option>
                                                                        <option value="Se cambio">Se cambio</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @foreach ($products_invs3 as $productoInventario)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Producto</label><br>
                                                                    <select class="form-select" id="producto[]" name="producto[]" disabled>
                                                                        <option value="">Seleciona el producto</option>

                                                                        @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Cantidad</label><br>
                                                                        <input class="form-control" type="text" value="{{ $productoInventario->cantidad }}" name="stock[]" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="estatus[]">Estatus</label>
                                                                    <select class="form-select" id="estatus[]" name="estatus[]" disabled>
                                                                        <option value="">Selecionar</option>
                                                                        <option value="En stock" @if ($productoInventario->estatus == "En stock") selected @endif>En stock</option>
                                                                        <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                        <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($products_invs3->isEmpty())
                                        @else
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="3">

                                                <div class="form-group col-12">
                                                    <div id="formulario3" class="mt-4">

                                                        <button type="button" class="clonar3 btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars3">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">Cantidad</label><br>
                                                                            <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">En stock</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                            <div class="form-group">
                                                <label for="nota">Foto</label>
                                                <input type="file" id="foto" class="form-control" name="foto">
                                            </div>
                                            @foreach ($cabina_fotos as $cabina_foto)
                                                @if ($cabina_foto->id_inv == '3')
                                                    <a href="{{ asset('foto_servicios/' . $cabina_foto->foto) }}" target="_blank">Ver</a>
                                                @endif
                                            @endforeach

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-Info4" role="tabpanel" aria-labelledby="semana4" tabindex="0">
                            <form method="POST" action="{{ route('cabina1.update_cabina1', $cabinaInventario->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">

                                        <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="4">

                                        <div class="form-group col-6">
                                            <label for="">Num de Cabina</label>
                                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Fecha</label> <br>
                                            @if(isset($fechasPorSemana[4]))
                                                {{ \Carbon\Carbon::parse($fechasPorSemana[4])->format('d/m/Y') }}
                                            @else
                                                Sin fecha
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <h3>Insumos</h3>
                                            @if ($products_invs4->isEmpty())
                                                <table class="table table-flush" id="datatable-search">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantitdad</th>
                                                            <th>Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($productos_cabinas as $index => $producto)
                                                                <td>
                                                                    <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                    {{ $producto->nombre }}
                                                                </td>
                                                                <td>
                                                                    <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                        <option value="">En stock</option>
                                                                        <option value="Por Terminar">Por Terminar</option>
                                                                        <option value="Se cambio">Se cambio</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @foreach ($products_invs4 as $productoInventario)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="producto[]">producto</label><br>
                                                                    <select class="form-select" id="producto[]" name="producto[]" disabled>
                                                                        <option value="">Seleciona el producto</option>

                                                                        @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Cantidad</label><br>
                                                                        <input class="form-control" type="text" value="{{ $productoInventario->cantidad }}" name="stock[]" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="estatus[]">estatus</label>
                                                                    <select class="form-select" id="estatus[]" name="estatus[]" disabled>
                                                                        <option value="">Selecionar</option>
                                                                        <option value="En stock" @if ($productoInventario->estatus == "En stock") selected @endif>En stock</option>
                                                                        <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                        <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($products_invs4->isEmpty())
                                        @else
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="4">

                                                <div class="form-group col-12">
                                                    <div id="formulario4" class="mt-4">

                                                        <button type="button" class="clonar4 btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars4">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">Cantidad</label><br>
                                                                            <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">En stock</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endif
                                            <div class="form-group">
                                                <label for="nota">Foto</label>
                                                <input type="file" id="foto" class="form-control" name="foto">
                                            </div>
                                            @foreach ($cabina_fotos as $cabina_foto)
                                                @if ($cabina_foto->id_inv == '4')
                                                    <a href="{{ asset('foto_servicios/' . $cabina_foto->foto) }}" target="_blank">Ver</a>
                                                @endif
                                            @endforeach
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="pills-Info5" role="tabpanel" aria-labelledby="semana5" tabindex="0">
                            <form method="POST" action="{{ route('cabina1.update_cabina1', $cabinaInventario->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">

                                        <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="5">

                                        <div class="form-group col-6">
                                            <label for="">Num de Cabina</label>
                                            <input class="form-control" type="text" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}" readonly>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Fecha</label> <br>
                                            @if(isset($fechasPorSemana[5]))
                                                {{ \Carbon\Carbon::parse($fechasPorSemana[5])->format('d/m/Y') }}
                                            @else
                                                Sin fecha
                                            @endif
                                        </div>

                                        <div class="form-group col-6">
                                            <h3>Insumos</h3>
                                            @if ($products_invs5->isEmpty())
                                                <table class="table table-flush" id="datatable-search">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantitdad</th>
                                                            <th>Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($productos_cabinas as $index => $producto)
                                                                <td>
                                                                    <p style="display: none"><input type="text" value="{{ $producto->id }}" name="producto[]" readonly> </p>
                                                                    {{ $producto->nombre }}</td>
                                                                <td>
                                                                    <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                </td>
                                                                <td>
                                                                    <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                        <option value="">En stock</option>
                                                                        <option value="Por Terminar">Por Terminar</option>
                                                                        <option value="Se cambio">Se cambio</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                @foreach ($products_invs5 as $productoInventario)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="producto[]">producto</label><br>
                                                                    <select class="form-select" id="producto[]" name="producto[]" disabled>
                                                                        <option value="">Seleciona el producto</option>

                                                                        @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}" @if ($producto->id == $productoInventario->id_producto) selected @endif>{{ $producto->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="producto[]">Cantidad</label><br>
                                                                        <input class="form-control" type="text" value="{{ $productoInventario->cantidad }}" name="stock[]" readonly>
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="estatus[]">estatus</label>
                                                                    <select class="form-select" id="estatus[]" name="estatus[]" disabled>
                                                                        <option value="">Selecionar</option>
                                                                        <option value="En stock" @if ($productoInventario->estatus == "En stock") selected @endif>En stock</option>
                                                                        <option value="Por Terminar" @if ($productoInventario->estatus == "Por Terminar") selected @endif>Por Terminar</option>
                                                                        <option value="Se cambio" @if ($productoInventario->estatus == "Se cambio") selected @endif>Se cambio</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endforeach
                                            @endif
                                        </div>

                                        @if ($products_invs5->isEmpty())
                                        @else
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="">Fecha</label>
                                                    <input class="form-control" type="date" name="fecha1" id="fecha1" value="{{ $fechaActual }}" readonly>
                                                </div>

                                                <input class="form-control" type="hidden" name="cabina" id="cabina" value="{{$cabinaInventario->num_cabina}}">
                                                <input class="form-control" type="hidden" name="num_semana" id="num_semana" value="4">

                                                <div class="form-group col-12">
                                                    <div id="formulario4" class="mt-4">

                                                        <button type="button" class="clonar4 btn btn-secondary btn-sm">Agregar</button>
                                                        <div class="clonars4">
                                                            <div class="row">

                                                                <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label for="descripcion">producto</label><br>
                                                                        <select class="form-select"  id="producto[]" name="producto[]">
                                                                            <option value="">Seleciona el producto</option>
                                                                            @foreach ($productos_cabinas as $producto)
                                                                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="producto[]">Cantidad</label><br>
                                                                            <input class="form-control" type="text" value="{{ $producto->cantidad }}" name="stock[]">
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">estatus</label>
                                                                        <select class="form-select"  id="estatus[]" name="estatus[]">
                                                                            <option value="">En stock</option>
                                                                            <option value="Por Terminar">Por Terminar</option>
                                                                            <option value="Se cambio">Se cambio</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-2">
                                                                    <div class="form-group">
                                                                        <label for="num_sesion">-</label><br>
                                                                        <button type="button" class="eliminar2 btn btn-danger btn-sm">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                            <div class="form-group">
                                                <label for="nota">Foto</label>
                                                <input type="file" id="foto" class="form-control" name="foto">
                                            </div>
                                            @foreach ($cabina_fotos as $cabina_foto)
                                                @if ($cabina_foto->id_inv == '5')
                                                    <a href="{{ asset('foto_servicios/' . $cabina_foto->foto) }}" target="_blank">Ver</a>
                                                @endif
                                            @endforeach
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
<script type="text/javascript">
    $('#formulario').on('click', '.eliminar', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor = $(this).closest('.clonars');

        // Eliminar el conjunto
        $contenedor.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar').click(function() {
      // Clona el .input-group
      var $clone = $('#formulario .clonars').last().clone();

      // Borra los valores de los inputs clonados
      $clone.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone.appendTo('#formulario');
    });

    $('#formulario2').on('click', '.eliminar2', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor2 = $(this).closest('.clonars2');

        // Eliminar el conjunto
        $contenedor2.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar2').click(function() {
      // Clona el .input-group
      var $clone2 = $('#formulario2 .clonars2').last().clone();

      // Borra los valores de los inputs clonados
      $clone2.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone2.appendTo('#formulario2');
    });

    $('#formulario3').on('click', '.eliminar3', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor3 = $(this).closest('.clonars3');

        // Eliminar el conjunto
        $contenedor3.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar3').click(function() {
      // Clona el .input-group
      var $clone3 = $('#formulario3 .clonars3').last().clone();

      // Borra los valores de los inputs clonados
      $clone3.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone3.appendTo('#formulario3');
    });

    $('#formulario4').on('click', '.eliminar4', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor4 = $(this).closest('.clonars4');

        // Eliminar el conjunto
        $contenedor4.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar4').click(function() {
      // Clona el .input-group
      var $clone4 = $('#formulario4 .clonars4').last().clone();

      // Borra los valores de los inputs clonados
      $clone4.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone4.appendTo('#formulario4');
    });

    $('#formulario5').on('click', '.eliminar5', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor5 = $(this).closest('.clonars5');

        // Eliminar el conjunto
        $contenedor5.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar5').click(function() {
      // Clona el .input-group
      var $clone5 = $('#formulario5 .clonars5').last().clone();

      // Borra los valores de los inputs clonados
      $clone5.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone5.appendTo('#formulario5');
    });


    $('#formulario6').on('click', '.eliminar6', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor6 = $(this).closest('.clonars6');

        // Eliminar el conjunto
        $contenedor6.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar6').click(function() {
      // Clona el .input-group
      var $clone6 = $('#formulario6 .clonars6').last().clone();

      // Borra los valores de los inputs clonados
      $clone6.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone6.appendTo('#formulario6');
    });

    $('#formulario7').on('click', '.eliminar7', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor7 = $(this).closest('.clonars7');

        // Eliminar el conjunto
        $contenedor7.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar7').click(function() {
      // Clona el .input-group
      var $clone7 = $('#formulario7 .clonars7').last().clone();

      // Borra los valores de los inputs clonados
      $clone7.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone7.appendTo('#formulario7');
    });

    $('#formulario8').on('click', '.eliminar8', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor8 = $(this).closest('.clonars8');

        // Eliminar el conjunto
        $contenedor8.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar8').click(function() {
      // Clona el .input-group
      var $clone8 = $('#formulario8 .clonars8').last().clone();

      // Borra los valores de los inputs clonados
      $clone8.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone8.appendTo('#formulario8');
    });

    $('#formulario9').on('click', '.eliminar9', function() {
        // Obtener el contenedor del conjunto a eliminar
        var $contenedor9 = $(this).closest('.clonars9');

        // Eliminar el conjunto
        $contenedor9.remove();
    });

    // ============= Agregar mas inputs dinamicamente =============
    $('.clonar9').click(function() {
      // Clona el .input-group
      var $clone9 = $('#formulario9 .clonars9').last().clone();

      // Borra los valores de los inputs clonados
      $clone9.find(':input').each(function () {
        if ($(this).is('select')) {
          this.selectedIndex = 0;
        } else {
          this.value = '';
        }
      });

      // Agrega lo clonado al final del #formulario
      $clone9.appendTo('#formulario9');
    });
</script>
@endsection
