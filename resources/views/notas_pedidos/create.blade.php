@extends('layouts.app')

@section('template_title')
   Crear Notas Producto
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-3">Crear Nota</h3>

                        <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>
                <div class="card-body" id="createDataModal">
                    <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                <i class="ni ni-folder-17 text-sm me-2"></i> Nota
                            </a>

                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">
                                <i class="fa fa-solid fa-receipt"></i> Pedido

                            </a>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('notas_pedidos.store') }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <div class="modal-body">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                    <div class="form-group">

                                        @if (Auth::user()->hasRole('cosmetologa'))
                                        <input type="text" id="id_user" class="form-control" name="id_user" value="{{ $cosme->id }}" style="display: none">
                                        @else
                                        <label for="nombre">Usuario</label>
                                        <select class="form-control" id="id_user" name="id_user"
                                            value="{{ old('id_user') }}" required>
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion">Cliente</label>
                                        <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            +
                                        </button>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nombre">Nombre *</label>
                                                        <input  id="name" name="name" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nombre">Apellido</label>
                                                        <input  id="last_name" name="last_name" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nombre">Telefono *</label>
                                                        <input  id="phone" name="phone" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="nombre">Correo</label>
                                                        <input  id="email" name="email" type="email" class="form-control">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div><br>
                                        <select class="form-control cliente_pedido" data-toggle="select" id="id_client" name="id_client"
                                            value="{{ old('id_client') }}" required>
                                            <option>Seleccionar cliente</option>
                                            @foreach ($client as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="num_sesion">Total</label>
                                                <input id="totalSuma" name="totalSuma" type="text" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="restante">Restante</label>
                                                <input type="text" id="restante" name="restante" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="restante">Cambio</label>
                                                <input type="text" id="cambio" name="cambio" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <label for="total-suma">Dinero recibido *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                </span>
                                                <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="num_sesion">Metodo de pago</label>
                                                <select id="metodo_pago" name="metodo_pago" class="form-control" value="{{old('metodo_pago')}}" required>
                                                    <option value="Efectivo">Efectivo</option>
                                                    <option value="Transferencia">Transferencia</option>
                                                    <option value="Mercado Pago">Mercado Pago</option>
                                                    <option value="Tarjeta">Tarjeta</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="nota">Foto</label>
                                                <input type="file" id="foto" class="form-control" name="foto">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label for="precio">Usar otro metodo de pago</label><br>
                                        <button class="btn btn-dark btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMetodo" aria-expanded="false" aria-controls="collapseExample">
                                             <img src="{{ asset('assets/icons/mas.png') }}" alt="" width="25px">
                                        </button>
                                    </div>

                                    <div class="collapse" id="collapseMetodo">
                                        <div class="card card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <label for="total-suma">Dinero recibido *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input  id="dinero_recibido2" name="dinero_recibido2" type="number" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="num_sesion">Metodo de pago</label>
                                                        <select id="metodo_pago2" name="metodo_pago2" class="form-control" value="{{old('metodo_pago2')}}" >
                                                            <option value="Efectivo">Efectivo</option>
                                                            <option value="Transferencia">Transferencia</option>
                                                            <option value="Mercado Pago">Mercado Pago</option>
                                                            <option value="Tarjeta">Tarjeta</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Foto</label>
                                                        <input type="file" id="foto2" class="form-control" name="foto2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <div id="formulario" class="mt-4">

                                        <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                        <div class="clonars">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="fecha">Cantidad</label>
                                                        <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <label for="descripcion">concepto</label><br>
                                                        <input  id="concepto[]" name="concepto[]" type="text" class="form-control">
                                                    {{-- <select class="form-control product"  data-toggle="select" id="concepto[]" name="concepto[]"value="{{ old('concepto') }}" required>

                                                        @foreach ($json2 as $item)
                                                                <option value="{{ $item->name }}">{{ $item->name }} - ${{ $item->price }}</option>
                                                            @endforeach
                                                        </select> --}}
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="num_sesion">Importe</label>
                                                        <input  id="importe[]" name="importe[]" type="number" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            $(".product").select2({
                dropdownParent: $("#createDataModal")
            });

            $(document).ready(function() {
                $(".cliente_pedido").select2({
                    dropdownParent: $("#createDataModal")
                });
            });
</script>
<script type="text/javascript">
    // Función para calcular la suma de los importes
    function calcularSuma() {
        var totalSuma = 0;
        // Itera a través de los campos de importe
        $('input[name="importe[]"]').each(function() {
            var valor = parseFloat($(this).val()) || 0;
            totalSuma += valor;
        });

        console.log(totalSuma);
        // Actualiza el valor del campo de suma
        $('#totalSuma').val(totalSuma);
    }

    // Escucha el evento 'input' en los campos de importe existentes
    $('input[name="importe[]"]').on('input', function() {
        calcularSuma();
    });

    // Agregar más campos dinámicamente
    $('.clonar').click(function() {
        // Clona el .clonar
        var $clone = $('.clonar').first().clone();

        // Borra los valores de los inputs clonados
        $clone.find(':input').each(function() {
            if ($(this).is('select')) {
                this.selectedIndex = 0;
            } else {
                this.value = '';
            }
        });

        // Agrega lo clonado al final del formulario
        $clone.appendTo('#formulario');

        // Asocia el evento 'input' al campo clonado
        $clone.find('input[name="importe[]"]').on('input', function() {
            calcularSuma();
        });
    });

    // Calcular la suma al cargar la página
    calcularSuma();

    // Obtén la referencia a los elementos HTML
    var inputDineroRecibido = $('#dinero_recibido');
    var inputDineroRecibido2 = $('#dinero_recibido2');
    var inputRestante = $('#restante');
    var inputCambio = $('#cambio');
    var inputTotalSuma = $('#totalSuma');

    // Función para calcular cambio y restante
    function calcularCambioYRestante() {
        // Obtiene el valor del dinero recibido
        var dineroRecibido = parseFloat(inputDineroRecibido.val()) || 0;

        // Obtiene el valor del segundo dinero recibido
        var dineroRecibido2 = parseFloat(inputDineroRecibido2.val()) || 0;

        // Calcula la suma de dinero recibido y dinero recibido2
        var sumaDineroRecibido = dineroRecibido + dineroRecibido2;

        // Obtiene el valor de total-suma
        var totalSuma = parseFloat(inputTotalSuma.val()) || 0;

        // Calcula el restante como la diferencia entre total-suma y la suma de dinero recibido y dinero recibido2
        var restante = totalSuma - sumaDineroRecibido;

        // El restante no debe ser negativo
        restante = Math.max(restante, 0);

        // Calcula el cambio solo si la suma de dinero recibido y dinero recibido2 es mayor que total-suma
        var cambio = (sumaDineroRecibido >= totalSuma) ? sumaDineroRecibido - totalSuma : 0;

        // Establece el valor del restante en el campo correspondiente
        inputRestante.val(restante);

        // Establece el valor del cambio en el campo correspondiente
        inputCambio.val(cambio);
    }

    // Escucha el evento 'input' en los campos de dinero recibido y dinero recibido2
    inputDineroRecibido.on('input', calcularCambioYRestante);
    inputDineroRecibido2.on('input', calcularCambioYRestante);

    // Calcula el cambio y el restante al cargar la página
    calcularCambioYRestante();

    </script>
@endsection
