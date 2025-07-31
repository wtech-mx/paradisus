@extends('layouts.app')

@section('template_title')
    Paquetes Faciales
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('paquetes_faciales.store') }}" enctype="multipart/form-data" role="form">
                            @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6 form-group ">
                                            <label for="nombre">Seleccione Recepcionista</label><br>
                                            <select class="form-control id_user" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6 form-group ">
                                            <label for="nombre">Seleccione Cosmetologa Comision</label><br>
                                            <select class="form-control id_cosme" id="id_cosme" name="id_cosme" value="{{ old('id_cosme') }}" required>
                                                <option value="">Seleccione cosme</option>
                                                @foreach ($cosme as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-3">
                                            <label for="precio">Nuevo cliente</label><br>
                                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                            </button>
                                        </div>
                                        <div class="col-9">

                                            <div class="form-group">
                                                <label for="name">Cliente *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                    </span>

                                                    <select class="form-select cliente_facial d-inline-block"  data-toggle="select" id="cliente" name="id_client" value="{{ old('id_client') }}">
                                                        <option>Seleccionar cliente</option>
                                                        @foreach ($client as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }} / {{ $item->phone }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-12">
                                                <div class="collapse" id="collapseExample">
                                                    <div class="card card-body">
                                                        <div class="row">


                                                            <div class="col-4">
                                                                <label for="name">Nombre(s) *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="name" name="name" type="text" class="form-control" placeholder="Nombre o Nombres">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="name">Apellido(s) *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/letter.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellidos">
                                                                </div>
                                                            </div>

                                                            <div class="col-4">
                                                                <label for="name">Telefono *</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">
                                                                        <img src="{{ asset('assets/icons/phone.png') }}" alt="" width="29px">
                                                                    </span>
                                                                    <input  id="phone" name="phone" type="text" class="form-control" type="tel" minlength="10" maxlength="10" placeholder="555555555">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="nombre">Seleccionar Paquete</label><br>
                                            <select class="form-control id_paquete" name="id_paquete" required>
                                                <option value="">Selecciona un servicio</option>
                                                @foreach ($paquetes_faciales as $item)
                                                    <option value="{{ $item->id }}" data-precio="{{ $item->precio }}">
                                                        {{ $item->nombre }} - ${{ $item->precio }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                            <div class="col-4">

                                                <label for="total-suma">Total a Pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" class="form-control total-pagar" id="total-pagar" name="total-pagar" readonly>
                                                </div>

                                            </div>

                                            <div class="col-4">
                                                <label for="total-suma">Restante</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/money.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" id="restante" id="restante" name="restante" class="form-control" readonly>
                                                </div>

                                            </div>

                                            <div class="col-4">
                                                <label for="total-suma">Cambio</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cambio.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="text" id="cambio" name="cambio" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Fecha</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="fecha_pago" name="fecha_pago" type="date" class="form-control" value="{{$fechaActual}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Monto a pagar</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cash-machine.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="pago" name="pago" type="number" class="form-control" required step="any">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control" required step="any">
                                                </div>
                                            </div>

                                            <div class="col-3">

                                                <label for="num_sesion">Metodo Pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select id="forma_pago" name="forma_pago" class="form-control">
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                        <option value="Nota">Nota</option>
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

                                                <label for="total-suma">Comprobante de pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/picture.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input type="file" id="foto" class="form-control" name="foto">
                                                </div>

                                            </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('select2')
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function () {
        $('.id_paquete').select2();
        $('.id_user').select2();
        $('.id_cosme').select2();
        $('.cliente_facial').select2();

       $(document).on('change', '.id_paquete', function () {
            const precio = $(this).find(':selected').data('precio') || 0;
            $('#total-pagar').val(precio);
            calcularRestante();
            calcularCambio();
        });

        // Escuchar cambios en pago o dinero recibido
        $('#pago, #dinero_recibido').on('input', function () {
            calcularRestante();
            calcularCambio();
        });

        function calcularRestante() {
            const total = parseFloat($('#total-pagar').val()) || 0;
            const pago = parseFloat($('#pago').val()) || 0;
            const restante = total - pago;

            $('#restante').val(restante.toFixed(2));
        }

        function calcularCambio() {
            const pago = parseFloat($('#pago').val()) || 0;
            const recibido = parseFloat($('#dinero_recibido').val()) || 0;
            const cambio = recibido - pago;

            $('#cambio').val(cambio >= 0 ? cambio.toFixed(2) : '0.00');
        }
    });
</script>
@endsection
