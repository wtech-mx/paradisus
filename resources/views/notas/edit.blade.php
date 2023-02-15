@extends('layouts.app')

@section('template_title')
   Editar Nota
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Editar Nota</h3>

                            <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#servicioedit{{$notas->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                        <i class="ni ni-folder-17 text-sm me-2"></i> Servicio
                                    </a>

                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pagoedit{{$notas->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#pills-sesion{{$notas->id}}" role="tab" aria-controls="pills-sesion" aria-selected="true" id="pills-sesion-tab">
                                        <i class="fa fa-calendar-day text-sm me-2"></i> Sesiones
                                    </a>

                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#extra{{$notas->id}}" role="tab" aria-controls="extra" aria-selected="true" id="extra-tab">
                                        <i class="fa fa-money-bill text-sm me-2"></i> Extras
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" data-bs-toggle="tab" href="#propina{{$notas->id}}" role="tab" aria-controls="propina" aria-selected="true" id="propina-tab">
                                        <i class="fa fa-money-bill text-sm me-2"></i> Propina
                                    </a>
                                </li>

                            </ul>

                            <form method="POST" action="{{ route('notas.update', $notas->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="row">
                                            <div class="col-3"></div>
                                            <div class="col-3">
                                                <div class="form-group mt-3">
                                                    @if ($notas->cancelado == 1)
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="cancelado" style="font-size: 15px;">Cancelar Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="cancelado" id="cancelado" value="{{$notas->cancelado}}" checked>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="cancelado" style="font-size: 15px;">Cancelar Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="cancelado" id="cancelado" value="1">
                                                            </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group mt-3">
                                                    @if ($notas->anular == 1)
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="anular" style="font-size: 15px;">Anular Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="anular" id="anular" value="{{$notas->anular}}" checked>
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="anular" style="font-size: 15px;">Anular Nota</label>
                                                                <input class="form-check-input" type="checkbox" name="anular" id="anular" value="1">
                                                            </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <input class="" type="hidden" name="id_notas_cosmes" id="id_notas_cosmes" value="{{ $notas->NotasCosmes->id }}">
                                        <div class="tab-pane fade in active show" id="servicioedit{{$notas->id}}">
                                            <div class="form-group">
                                                <label for="nombre">Cosmetologas</label>
                                                <select  id="id_user[]" name="id_user[]" class="js-example-basic-multiple form-control" multiple="multiple">
                                                    @foreach ($user as $item)
                                                        @if ($notas->NotasCosmes->id_user == $item->id)
                                                        <option selected value="{{$item->id }}">{{$item->name}}</option>
                                                        @endif
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                    {{-- @foreach($nota_cosme as $item)
                                                        <option value="{{$item->id }}">{{$item->User->name}}</option>
                                                    @endforeach --}}
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion">Cliente</label>
                                                <select class="form-control input-edit-car" id="id_client" name="id_client"
                                                    value="{{ old('id_client') }}" >
                                                    <option value="{{ $notas->id_client }}">{{ $notas->Client->name }} {{ $notas->Client->last_name }}</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="precio">Servicio</label>
                                                        <select class="form-control servedit serv-edit" id="id_servicio" name="id_servicio" data-toggle="select" data-id="{{ $notas->Paquetes->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive" >
                                                            <option value="{{ $notas->Paquetes->id_servicio }}">{{ $notas->Paquetes->Servicios->nombre }}</option>
                                                            @foreach ($servicio as $item)
                                                                <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="precio">Num</label>
                                                            <input type="number" id="num" name="num" class="form-control" value="{{ $notas->Paquetes->num }}" >
                                                            <input type="hidden" id="id_notas_paquetes" name="id_notas_paquetes" class="form-control" value="{{ $notas->Paquetes->id }}" >
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    @if ($notas->Paquetes->descuento == 1)
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="descuento" style="font-size: 15px;">10%</label><br>
                                                                <input class="form-check-input" type="checkbox" name="descuento" id="descuento" value="{{$notas->Paquetes->descuento}}" checked >
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="descuento" style="font-size: 15px;">10%</label><br>
                                                                <input class="form-check-input" type="checkbox" name="descuento" id="descuento" value="1" >
                                                            </div>
                                                    @endif
                                                </div>
                                                <div class="col-1">
                                                    @if ($notas->Paquetes->descuento_5 == 1)
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="descuento_5" style="font-size: 15px;">5%</label><br>
                                                                <input class="form-check-input" type="checkbox" name="descuento_5" id="descuento_5" value="{{$notas->Paquetes->descuento_5}}" checked >
                                                            </div>
                                                        @else
                                                            <div class="form-check">
                                                                <label class="custom-control-label" for="descuento_5" style="font-size: 15px;">5%</label><br>
                                                                <input class="form-check-input" type="checkbox" name="descuento_5" id="descuento_5" value="1" >
                                                            </div>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- M A S  S E R V I C I O S --}}
                                            <div class="card card-body">
                                                {{-- D O S  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 2</label><br>
                                                            <select class="form-control " data-toggle="select" id="servicio2" name="id_servicio2" >
                                                                @if ($notas->Paquetes->id_servicio2 == NULL || $notas->Paquetes->id_servicio2 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio2 }}">{{ $notas->Paquetes->Servicios2->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 2</label>
                                                                <input type="number" id="num2" name="num2" class="form-control" value="{{ $notas->Paquetes->num2 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento2 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento2" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento2" id="descuento2" value="{{$notas->Paquetes->descuento2}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento2" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento2" id="descuento2" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento2_5 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento2_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento2_5" id="descuento2_5" value="{{$notas->Paquetes->descuento2_5}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento2_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento2_5" id="descuento2_5" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- T R E S  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 3</label><br>
                                                            <select class="form-control " data-toggle="select" id="servicio3" name="id_servicio3" >
                                                                @if ($notas->Paquetes->id_servicio3 == NULL || $notas->Paquetes->id_servicio3 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio3 }}">{{ $notas->Paquetes->Servicios3->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 3</label>
                                                                <input type="number" id="num3" name="num3" class="form-control" value="{{ $notas->Paquetes->num3 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento3 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento3" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento3" id="descuento3" value="{{$notas->Paquetes->descuento3}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento3" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento3" id="descuento3" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento3_5 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento3_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento3_5" id="descuento3_5" value="{{$notas->Paquetes->descuento3_5}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento3_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento3_5" id="descuento3_5" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{-- C U A T R O  S E R V I C I O  --}}
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="precio">Servicio 4</label><br>
                                                            <select class="form-control " id="servicio4" name="id_servicio4" >
                                                                @if ($notas->Paquetes->id_servicio4 == NULL || $notas->Paquetes->id_servicio4 == 0)
                                                                    <option value="">Seleccione Servicio</option>
                                                                @else
                                                                    <option value="{{ $notas->Paquetes->id_servicio4 }}">{{ $notas->Paquetes->Servicios4->nombre }}</option>
                                                                @endif
                                                                @foreach ($servicio as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="precio">Num 4</label>
                                                                <input type="number" id="num4" name="num4" class="form-control" value="{{ $notas->Paquetes->num4 }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento4 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento4" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento4" id="descuento4" value="{{$notas->Paquetes->descuento4}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento4" style="font-size: 15px;">10%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento4" id="descuento4" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-1">
                                                        @if ($notas->Paquetes->descuento4_5 == 1)
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento4_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento4_5" id="descuento4_5" value="{{$notas->Paquetes->descuento4_5}}" checked >
                                                                </div>
                                                            @else
                                                                <div class="form-check">
                                                                    <label class="custom-control-label" for="descuento4_5" style="font-size: 15px;">5%</label><br>
                                                                    <input class="form-check-input" type="checkbox" name="descuento4_5" id="descuento4_5" value="1" >
                                                                </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- E N D  M A S  S E R V I C I O S --}}

                                            <div class="form-group">
                                                <label for="fecha">Fecha</label>
                                                <input id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$notas->fecha}}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="nota">Nota</label>
                                                <textarea name="nota" id="nota" cols="10" rows="3" class="form-control" >{{$notas->nota}}</textarea>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pagoedit{{$notas->id}}" >

                                            <div class="row text-center">
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                                <div class="col-3" style="background-color: #bb546c; color: #fff;">Usuario</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Pago</div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                                <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                                <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>


                                                <p style="display: none">{{ $resultado = 0; }}</p>
                                                @foreach ($pago as $item)
                                                    <input  id="pago_id" name="pago_id" type="hidden"  class="form-control" value="{{$item->id}}">
                                                    <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                                    <div class="col-2 py-2" ><input name="fecha_pago" type="date" class="form-control text-center" id="fecha_pago"
                                                            value="{{$item->fecha}}" disabled>
                                                    </div>

                                                    <div class="col-3 py-2" >
                                                        <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                            <option value="{{$item->cosmetologa}}">{{ $item->User->name }}</option>
                                                            @foreach ($user as $cosmes)
                                                                <option value="{{ $cosmes->id }}" >{{ $cosmes->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-2 py-2" >
                                                        <input name="pago" type="number" class="form-control text-center" id="pago"
                                                            value="{{$item->pago}}" disabled></div>

                                                    <div class="col-2 py-2" ><input name="forma_pago" type="text" class="form-control text-center" id="forma_pago"
                                                        value="{{$item->forma_pago}}" disabled>
                                                    </div>

                                                    <div class="col-2 py-2" ><textarea class="form-control text-center" name="nota[]" id="nota[]" cols="3" rows="1" disabled>{{$item->nota}}</textarea>

                                                    </div>

                                                    @if ($item->foto == NULL)
                                                        <a href=""></a>
                                                    @else
                                                        <div class="col-1 py-2">
                                                            <a target="_blank" href="{{asset('foto_servicios/'.$item->foto)}}">Abrir Imagen</a>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                            <div class="mt-4">
                                                <h5><strong>Saldo a favor:</strong>  $ {{ $resultado; }} .00  MXN</h5>
                                                <h5><strong>Restante:</strong>  ${{$notas->restante}} .00  MXN</h5>

                                                <div class="row">
                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="fecha">Fecha</label>
                                                            <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="fecha">Usuario</label>
                                                            <select class="form-control"  data-toggle="select" id="cosmetologa" name="cosmetologa" value="">
                                                                <option value="">Selecciona</option>
                                                                @foreach ($user as $cosmes)
                                                                    <option value="{{ $cosmes->id }}">{{ $cosmes->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="pago">Pago</label>
                                                            <input  id="pago" name="pago" type="number" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago" name="forma_pago" class="form-control">
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="nota">Nota</label>
                                                            <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label for="nota">Foto</label>
                                                            <input type="file" id="foto" class="form-control" name="foto">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="pills-sesion{{$notas->id}}" role="tabpanel" aria-labelledby="pills-sesion-tab">
                                            @foreach ($notas_sesiones as $item)
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="fecha">Fecha</label>
                                                            <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$item->fecha}}" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Num sesion</label>
                                                            <input  id="sesion" name="sesion" type="number" class="form-control" value="{{$item->sesion}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="form-group">
                                                            <label for="nota">Nota</label>
                                                            <textarea class="form-control" id="nota3" name="nota3" rows="1" disabled>{{$item->nota}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="fecha">Fecha</label>
                                                        <input  id="fecha_sesion" name="fecha_sesion" type="date" class="form-control" value="{{$fechaActual}}">
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="num_sesion">Num sesion</label>
                                                        <input  id="sesion" name="sesion" type="number" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-5">
                                                    <div class="form-group">
                                                        <label for="nota">Nota</label>
                                                        <textarea class="form-control" id="nota3" name="nota3" rows="1"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="extra{{$notas->id}}" role="tabpanel" aria-labelledby="extra-tab">
                                            @foreach ($notas_extras as $item)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="descripcion">Concepto</label>
                                                            <input  id="concepto[]" name="concepto[]" type="text" class="form-control" value="{{$item->concepto}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Precio</label>
                                                            <input  id="precio[]" name="precio[]" type="number" class="form-control" value="{{$item->precio}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div id="formulario3" class="mt-4">
                                                {{-- <button type="button" class="clonar3 btn btn-secondary btn-sm">Agregar</button> --}}
                                                <div class="clonars3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="descripcion">Concepto</label>
                                                                <input  id="concepto" name="concepto" type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label for="num_sesion">Precio</label>
                                                                <input  id="precio" name="precio" type="number" class="form-control" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="propina{{$notas->id}}" role="tabpanel" aria-labelledby="propina-tab">
                                            @foreach ($notas_propinas as $item)
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombre">Seleccione Usuario</label>
                                                            <select class="form-control" disabled>
                                                                <option value="{{ $item->id_user }}">{{ $item->User->name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Propina</label>
                                                            <input type="number" class="form-control" value="{{$item->propina}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago_propina" name="forma_pago_propina" class="form-control" disabled>
                                                                <option value="{{ $item->metdodo_pago }}">{{ $item->metdodo_pago }}</option>
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div id="formulario3" class="mt-4">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombre">Seleccione Usuario</label>
                                                            <select class="form-control " id="id_user_propina" name="id_user_propina" value="{{ old('id_user_propina') }}" required>
                                                                @foreach ($user as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="Propina">Propina</label>
                                                            <input  id="propina" name="propina" type="number" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Metodo Pago</label>
                                                            <select id="forma_pago_propina" name="forma_pago_propina" class="form-control">
                                                                <option value="Efectivo">Efectivo</option>
                                                                <option value="Transferencia">Transferencia</option>
                                                                <option value="Mercado Pago">Mercado Pago</option>
                                                                <option value="Tarjeta">Tarjeta</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                                Cancelar
                                            </a>
                                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                                Actualizar
                                            </button>
                                        </div>
                                </div>
                            </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('js_custom')
    <script type="text/javascript">

$(function() {
        $('.toggle-class').change(function() {
                let cosmetologa = $(this).val();
                console.log(cosmetologa)
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('notas.ChangeCosme') }}',
                    data: {
                        'cosmetologa': cosmetologa,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })


        $(function() {
        $('.serv-edit').change(function() {
                let id_servicio = $(this).val();
                console.log(id_servicio)
                var id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '{{ route('notas.ChangeServicio') }}',
                    data: {
                        'id_servicio': id_servicio,
                        'id': id
                    },
                    success: function(data) {
                        console.log(data.success)
                    }
                });
            })
        })
    </script>

@endsection
