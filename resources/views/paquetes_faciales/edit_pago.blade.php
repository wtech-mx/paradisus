                                    {{-- <div class="row">
                                        <div class="col-12">
                                            <label for="editarCampos">Editar Campos de pago</label>

                                            <input class="form-check-input" type="radio" id="editarCamposNo" name="editarsi"  value="no">
                                            <label  class="form-check-label" for="editarCamposNo">No</label>

                                            <input class="form-check-input" type="radio" id="editarCamposSi" name="editarsi" value="si">
                                            <label  class="form-check-label" for="editarCamposSi">Sí</label>
                                        </div>
                                    </div>--}}
                                    <p style="display: none">{{ $resultado = 0; }}</p>
                                    <table class="container_pagos table table-bordered table-responsive">

                                        <thead class="text-center" style="background-color: #bb546c; color: white;">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Usuario</th>
                                                <th>Pago</th>
                                                <th>Dinero recibido</th>
                                                <th>Método</th>
                                                <th>Nota</th>
                                                <th>Foto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pagos as $item)
                                                <tr id="pago-fila-{{ $item->id }}">

                                                    <input id="pago_{{ $item->id }}" name="pago_id_edit[]" type="hidden" class="form-control" value="{{ $item->id }}">
                                                        <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                                    <td>
                                                        <input name="fecha_pago_edit[]" type="date" class="form-control text-center" id="fecha_pago" value="{{$item->fecha}}" disabled>
                                                    </td>

                                                    <td>
                                                        <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                            <option value="{{$item->id_user}}">{{ $item->User->name }}</option>
                                                            @foreach ($user as $item_user)
                                                                <option value="{{ $item_user->id }}" >{{ $item_user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <input name="pago_edit[]" type="number" class="form-control text-center pago-existente" id="pago_{{ $item->id }}" value="{{$item->pago}}" disabled>
                                                    </td>

                                                    <td>
                                                        <input name="dinero_recibido_edit[]" type="number" class="form-control text-center" id="pago_{{ $item->id }}" value="{{$item->dinero_recibido}}" disabled>
                                                    </td>

                                                    <td>
                                                        <select class="form-control toggle-class" id="cosmetologa" name="forma_pago_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                            <option value="{{$item->forma_pago}}">{{$item->forma_pago}}</option>
                                                            <option value="Efectivo">Efectivo</option>
                                                            <option value="Transferencia">Transferencia</option>
                                                            <option value="Mercado Pago">Mercado Pago</option>
                                                            <option value="Tarjeta">Tarjeta</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control text-center" name="nota_edit[]" id="nota[]" cols="3" rows="1" disabled>{{$item->nota}}</textarea>
                                                    </td>

                                                    <td>
                                                        @if ($item->foto)
                                                            <a href="{{ asset('foto_servicios/' . $item->foto) }}" target="_blank">Ver</a>
                                                        @else
                                                            SF
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-sm btn-eliminar-pago" data-id="{{ $item->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>

                                                        @if($item->forma_pago == 'Mercado Pago')
                                                            <a target="_blank" href="{{ route('link_pago_servicio', ['item' => $item->id, 'nota' => $nota->id]) }}"
                                                            class="btn btn-primary btn-sm">
                                                                <i class="fa fa-share"></i>
                                                            </a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="total-pagar">Total a Pagar</label>
                                                    <input type="text" id="total-pagar" name="total-pagar" class="form-control" readonly value="{{$nota->monto}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Saldo a favor</label>
                                                    <input type="text" id="saldo-favor" class="form-control" readonly value="$ {{ $resultado; }} MXN">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Restante</label>
                                                    <input type="text" id="restante" name="restante_paquetes" class="form-control restante" readonly value="{{$nota->restante}}">
                                                    <input type="hidden" id="restante_original" value="{{ $nota->restante }}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Cambio</label>
                                                    <input type="text" id="cambio" name="cambio" class="form-control cambio" readonly>
                                                </div>
                                            </div>
                                        </div>

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
                                                        @foreach ($user as $item_user)
                                                            <option value="{{ $item_user->id }}">{{ $item_user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Monto a pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cash-machine.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="pago" name="pago" type="number" class="form-control pago" step="any">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control dinero_recibido" step="any">
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

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nota">Nota</label>
                                                    <textarea class="form-control" id="nota2" name="nota2" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="nota">Foto</label>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
