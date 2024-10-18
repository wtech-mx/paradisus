@extends('layouts.app')

@section('template_title')
    Editar Nota
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header" style="padding: 1.5rem 0 0 1.5rem !important;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="">Editar Nota Pedido</h3>

                            <a class="btn" href="{{ route('notas.index') }}" style="background: {{ $configuracion->color_boton_close }}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('notas_pedidos.update', $nota_pedido->id) }}"enctype="multipart/form-data" role="form" id="miFormulario">
                            @csrf

                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">

                                <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5>¿Quieres modifcar los datos?</h5>
                                                <label>
                                                    <input type="radio" name="opcion" value="si"
                                                        onclick="habilitarInputs()"> Sí
                                                </label>
                                                <label>
                                                    <input type="radio" name="opcion" value="no"
                                                        onclick="deshabilitarInputs()"> No
                                                </label>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nombre">Usuario</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/mujer.png') }}" alt=""
                                                            width="25px">
                                                    </span>
                                                    <select readonly class="form-control input-edit-car" id="id_user"
                                                        name="id_user" value="{{ old('id_user') }}" required>
                                                        <option selected value="{{ $nota_pedido->id_user }}">
                                                            {{ $nota_pedido->User->name }}</option>
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nombre">Cliente</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cliente.png') }}" alt=""
                                                            width="25px">
                                                    </span>
                                                    <select readonly class="form-control" id="id_client" name="id_client"
                                                        value="{{ old('id_client') }}" required>
                                                        <option selected value="{{ $nota_pedido->id_client }}">
                                                            {{ $nota_pedido->Client->name }}
                                                            {{ $nota_pedido->Client->last_name }}</option>
                                                        @foreach ($client as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                                {{ $item->last_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="fecha">Fecha</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/calenda.png') }}" alt=""
                                                            width="25px">
                                                    </span>
                                                    <input readonly id="fecha" name="fecha" type="date"
                                                        class="form-control" placeholder="fecha"
                                                        value="{{ $nota_pedido->fecha }}" required>
                                                </div>
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="nota">Total Anterior</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/dinero.png') }}" alt=""
                                                            width="25px">
                                                    </span>
                                                    <input readonly id="total_anterior" name="total_anterior"
                                                        type="number" class="form-control"
                                                        value="{{ $nota_pedido->total }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nota">Total Actual</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}"
                                                            alt="" width="25px">
                                                    </span>
                                                    <input readonly id="totalSuma" name="totalSuma" type="number"
                                                        class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="num_sesion">Descuento (%)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/descuentos.png') }}"
                                                            alt="" width="25px">
                                                    </span>
                                                    <input id="descuento_porcentaje" name="descuento_porcentaje"
                                                        type="number" class="form-control"
                                                        value="{{ $nota_pedido->descuento }}">
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="total-suma">Dinero recibido *</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}"
                                                            alt="" width="25px">
                                                    </span>
                                                    <input id="dinero_recibido" name="dinero_recibido" type="number"
                                                        class="form-control" value="{{ $nota_pedido->dinero_recibido }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="num_sesion">Metodo de pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/transferir.png') }}"
                                                            alt="" width="25px">
                                                    </span>
                                                    <select readonly id="metodo_pago" name="metodo_pago"
                                                        class="form-control" required>
                                                        <option selected value="{{ $nota_pedido->metodo_pago }}">
                                                            {{ $nota_pedido->metodo_pago }}</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido 2</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}"
                                                            alt="" width="25px">
                                                    </span>
                                                    <input id="dinero_recibido2" name="dinero_recibido2" type="number"
                                                        class="form-control"
                                                        value="{{ $nota_pedido->dinero_recibido2 }}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="num_sesion">Metodo de pago 2</label>
                                                    <select id="metodo_pago2" name="metodo_pago2" class="form-control">
                                                        <option selected value="{{ $nota_pedido->metodo_pago2 }}">
                                                            {{ $nota_pedido->metodo_pago2 }}</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @if ($nota_pedido->foto == null)
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Foto</label>
                                                        <input type="file" id="foto" class="form-control"
                                                            name="foto">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <a
                                                        href="javascript:abrir('{{ asset('foto_producto/' . $nota_pedido->foto) }}','500','500')">
                                                        <img src="{{ asset('foto_producto/' . $nota_pedido->foto) }}"
                                                            style="width: 30%">
                                                    </a>
                                                </div>
                                            @endif
                                </div>

                                <div class="row">
                                            <div class="col-12">
                                                <h3>Pedido</h3>
                                            </div>

                                            <div class="col-12">
                                                <div class="row text-center">
                                                    <div class="row mt-4">
                                                        <div class="col-4" style="background-color: #212529; color: #fff;">
                                                            Cantidad</div>
                                                        <div class="col-4" style="background-color: #212529; color: #fff;">
                                                            Concepto</div>
                                                        <div class="col-4" style="background-color: #212529; color: #fff;">
                                                            Importe</div>

                                                        <p style="display: none">{{ $resultado = 0 }}</p>

                                                        @foreach ($pedido as $item)
                                                            @if ($item->id_nota == $nota_pedido->id)
                                                                <div class="row" id="producto-{{ $item->id }}">
                                                                    <div class="col-3">
                                                                        <input disabled name="cantidad[]" type="number"
                                                                            class="form-control" value="{{ $item->cantidad }}">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input disabled name="concepto[]" type="text"
                                                                            class="form-control" value="{{ $item->concepto }}">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input disabled name="importe[]" type="number"
                                                                            class="form-control" value="{{ $item->importe }}">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <button type="button" class="btn btn-danger btn-sm"
                                                                            onclick="eliminarProducto({{ $item->id }})">Eliminar</button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach

                                                    </div>
                                                </div>

                                                <div id="formulario" class="mt-4">
                                                    {{-- <button type="button" class="clonar btn btn-secondary btn-sm"onclick="clonar()">+</button> --}}
                                                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>

                                                    <div class="clonars">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="">Producto</label>
                                                                <div class="form-group">
                                                                    <select name="concepto[]" class="form-select d-inline-block select2">
                                                                        <option value="">Seleccione products</option>
                                                                        @foreach ($products as $product)
                                                                        <option value="{{ $product->nombre }}" data-precio_normal="{{ $product->precio_normal }}">{{ $product->nombre }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="fecha">Cantidad</label>
                                                                    <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-2">
                                                                <div class="form-group">
                                                                    <label for="num_sesion">Subtotal</label>
                                                                    <input  id="importe[]" name="importe[]" type="number" class="form-control importe" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"
                                        style="background: {{ $configuracion->color_boton_close }}; color: #ffff">Cancelar</button>
                                    <button type="submit" class="btn close-modal"
                                        style="background: {{ $configuracion->color_boton_save }}; color: #ffff">Actualizar</button>
                                </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('select2')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.input-edit-car').select2();
        });

        document.getElementById('descuento_porcentaje').addEventListener('change', function() {
            calcularSuma();
        });

        function initializeSelect2($container) {
            $container.find('.select2').select2();
        }

        // Inicializa Select2 en todos los elementos .select2 existentes
        initializeSelect2($('#formulario'));

            // Asocia un evento de cambio al campo de concepto
        $(document).on('change', '.select2', function() {
            // Obtiene el precio normal del producto seleccionado
            var precioNormal = $(this).find('option:selected').data('precio_normal');

            // Encuentra el campo de importe correspondiente y establece su valor
            $(this).closest('.row').find('.importe').val(precioNormal);
        });


        $(document).on('click', '.clonar', function() {
            var $clone = $('.clonars').first().clone();
            $clone.find('select.select2').removeClass('select2-hidden-accessible').next().remove();
            $clone.find('select.select2').select2();

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

            // Asocia el evento de cambio al campo de concepto clonado
            $clone.find('.select2').on('change', function() {
                var precioNormal = $(this).find('option:selected').data('precio_normal');
                $(this).closest('.row').find('.importe').val(precioNormal);
            });

            // Asocia el evento 'input' al campo clonado
            $clone.find('input[name="importe[]"]').on('input', function() {
                calcularSuma();
            });
        });

        function eliminar(elemento) {
            elemento.remove();
            calcularSuma(); // Llama a la función para recalcular el total cuando se elimina un elemento
        }

        // Función para calcular la suma de los importes
        function calcularSuma() {
            var totalSuma = 0;
            // Itera a través de los campos de cantidad y importe
            $('input[name="cantidad[]"]').each(function(index) {
                var cantidad = parseFloat($(this).val()) || 0;
                var importe = parseFloat($('input[name="importe[]"]').eq(index).val()) || 0;
                totalSuma += cantidad * importe;
            });

            // Obtén el valor del descuento
            var descuento = parseFloat($('#descuento_porcentaje').val()) || 0;

            // Calcula el total después de aplicar el descuento
            var totalConDescuento = totalSuma - (totalSuma * descuento / 100);

            // Actualiza el valor del campo de suma
            $('#totalSuma').val(totalConDescuento.toFixed(2));
        }

        // Escucha el evento 'input' en los campos de cantidad, importe y descuento existentes y futuros
        $(document).on('input', 'input[name="cantidad[]"], input[name="importe[]"], #descuento_porcentaje', function() {
            calcularSuma();
        });

        // Escucha el evento 'input' en los campos de dinero recibido
        $('input[name^="dinero_recibido"]').on('input', function() {
            calcularCambioYRestante();
        });

        // Función para calcular cambio y restante
        function calcularCambioYRestante() {
            var dineroRecibidoTotal = 0;
            $('input[name^="dinero_recibido"]').each(function() {
                dineroRecibidoTotal += parseFloat($(this).val()) || 0;
            });

            // Obtiene el valor del total sumado
            var totalSuma = parseFloat($('#totalSuma').val()) || 0;

            // Calcula el restante como la diferencia entre el total y el dinero recibido total
            var restante = totalSuma - dineroRecibidoTotal;

            // El restante no debe ser negativo
            restante = Math.max(restante, 0);

            // Calcula el cambio solo si el dinero recibido total es mayor o igual que el total
            var cambio = (dineroRecibidoTotal >= totalSuma) ? dineroRecibidoTotal - totalSuma : 0;

            // Actualiza los campos Restante y Cambio
            $('#restante').val(restante);
            $('#cambio').val(cambio);
        }

        // inicio de funcion ajax impresion caja y tiket
        function habilitarInputs() {
            // Habilitar los inputs
            document.getElementById('id_user').readonly = false;
            document.getElementById('id_client').readonly = false;
            document.getElementById('fecha').readonly = false;
            document.getElementById('total').readonly = false;
            document.getElementById('metodo_pago').readonly = true;
        }

        function deshabilitarInputs() {
            // Deshabilitar los inputs
            document.getElementById('id_user').readonly = true;
            document.getElementById('id_client').readonly = true;
            document.getElementById('fecha').readonly = true;
            document.getElementById('total').readonly = true;
            document.getElementById('metodo_pago').readonly = true;
        }

        // Calcula el cambio y restante al cargar la página
        calcularCambioYRestante();
        // inicio de funcion ajax impresion caja y tiket

        $(document).ready(function() {

            $("#miFormulario").on("submit", function(event) {
                event.preventDefault(); // Evita el envío predeterminado del formulario

                // Realiza la solicitud POST usando AJAX
                $.ajax({
                    url: $(this).attr("action"),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: async function(response) { // Agrega "async" aquí
                        // El formulario se ha enviado correctamente, ahora realiza la impresión
                        console.log(response);
                        imprimirRecibo(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });

            });

            // Función para imprimir el recibo
            async function imprimirRecibo(response) {
                const userAgent = navigator.userAgent;

                // Obtén los datos del recibo de la respuesta AJAX
                const recibo = response.recibo;
                // Empezar a usar el plugin
                const formaPago = $("#forma_pago").val();

                if (/Windows/i.test(userAgent)) {

                    if (formaPago === 'Efectivo') {

                        const conector = new ConectorPluginV3();

                        conector.Pulso(parseInt(48), parseInt(60), parseInt(120));

                        conector
                            .EscribirTexto("Paradisus\n")
                            .EscribirTexto("Ticket #: " + recibo.id + "\n")
                            .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                            .EscribirTexto("Cosmetologa: " + recibo.cosmetologa + "\n")
                            .EscribirTexto("Total: $" + recibo.Total + "\n")
                            .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                            .EscribirTexto("-------------------------")
                            .Feed(1);

                        for (const pago of recibo.pago) {
                            conector
                                .EscribirTexto(" Fecha: " + pago.fecha + "\n")
                                .EscribirTexto(" Pago: $" + pago.pago + "\n")
                                .EscribirTexto(" Cambio: $" + pago.cambio + "\n")
                                .EscribirTexto(" Met. Pago: " + pago.forma_pago + "\n")
                                .EscribirTexto("-------------------------")
                            conector.Feed(1);
                        }

                        for (const paquete of recibo.notas_paquetes) {
                            for (const servicio of paquete.servicios) {
                                conector.EscribirTexto("Servicio: " + servicio + "\n").EscribirTexto(
                                    "-------------------------");
                                conector.Feed(1);
                            }
                        }

                        const respuesta = await conector.imprimirEn(recibo.nombreImpresora);

                        if (!respuesta) {
                            alert("Error al imprimir ticket: " + respuesta);
                        } else {

                            Swal.fire({
                                icon: 'success',
                                title: 'Guardado con exito',
                                text: 'Impresion de ticket y apertura de caja',
                            }).then(() => {
                                // Recarga la página
                                window.location.href = '/notas/servicios/edit/' + recibo.id;
                            });
                        }

                    } else {

                        const conector = new ConectorPluginV3();

                        conector
                            .EscribirTexto("Paradisus\n")
                            .EscribirTexto("Ticket #: " + recibo.id + "\n")
                            .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                            .EscribirTexto("Cosmetologa: " + recibo.cosmetologa + "\n")
                            .EscribirTexto("Total: $" + recibo.Total + "\n")
                            .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                            .EscribirTexto("-------------------------")
                            .Feed(1);

                        for (const pago of recibo.pago) {
                            conector
                                .EscribirTexto(" Fecha: " + pago.fecha + "\n")
                                .EscribirTexto(" Pago: $" + pago.pago + "\n")
                                .EscribirTexto(" Cambio: $" + pago.cambio + "\n")
                                .EscribirTexto(" Met. Pago: " + pago.forma_pago + "\n")
                                .EscribirTexto("-------------------------")
                            conector.Feed(1);
                        }

                        for (const paquete of recibo.notas_paquetes) {
                            for (const servicio of paquete.servicios) {
                                conector.EscribirTexto("Servicio: " + servicio + "\n").EscribirTexto(
                                    "-------------------------");
                                conector.Feed(1);
                            }
                        }

                        const respuesta = await conector.imprimirEn(recibo.nombreImpresora);

                        if (!respuesta) {
                            alert("Error al imprimir ticket: " + respuesta);
                        } else {

                            Swal.fire({
                                icon: 'success',
                                title: 'Guardado con exito',
                                text: 'Impresion de ticket',
                            }).then(() => {
                                // Recarga la página
                                window.location.href = '/notas/pedidos';
                            });
                        }

                    }
                } else if (/Macintosh/i.test(userAgent)) {
                    // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                    alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                    setTimeout(function() {
                        window.location.href = '/notas/pedidos';
                    }, 1000);
                }
            }

        });

        function eliminarProducto(id) {
            // Confirmación antes de eliminar
            if (!confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                return;
            }

            $.ajax({
                url: '/notas/pedidos/eliminar-producto/' + id, // Ruta al backend para eliminar el producto
                type: 'DELETE', // Método HTTP
                data: {
                    "_token": "{{ csrf_token() }}", // Agrega el token CSRF
                },
                success: function(response) {
                    // Eliminar el producto del frontend
                    document.getElementById('producto-' + id).remove();
                    // Opcional: Puedes llamar a la función calcularSuma() para actualizar el total
                    calcularSuma();
                    alert(response.message);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Error al eliminar el producto');
                }
            });
        }
    </script>
@endsection
