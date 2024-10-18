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
                            <h3 class="mb-3">Editar Nota Pedido</h3>

                            <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                        <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#notaedit{{$nota_pedido->id}}" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                    <i class="ni ni-folder-17 text-sm me-2"></i> Nota
                                </a>

                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pedidoedit{{$nota_pedido->id}}" role="tab" aria-controls="pills-profile" aria-selected="true">
                                    <i class="ni ni-credit-card text-sm me-2"></i> Pedido
                                </a>
                            </li>
                        </ul>


                        <form method="POST" action="{{ route('notas_pedidos.update', $nota_pedido->id) }}" enctype="multipart/form-data" role="form" id="miFormulario" >
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="modal-body">
                                <div class="tab-content">

                                    <div class="tab-pane fade in active show" id="notaedit{{$nota_pedido->id}}">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <h5>¿Quieres modifcar los datos?</h5>
                                                <label>
                                                    <input type="radio" name="opcion" value="si" onclick="habilitarInputs()"> Sí
                                                </label>
                                                <label>
                                                    <input type="radio" name="opcion" value="no" onclick="deshabilitarInputs()"> No
                                                </label>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nombre">Usuario</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/mujer.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select disabled class="form-control input-edit-car" id="id_user" name="id_user"
                                                    value="{{ old('id_user') }}" required>
                                                    <option selected value="{{ $nota_pedido->id_user }}">{{ $nota_pedido->User->name }}</option>
                                                    @foreach ($user as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nombre">Cliente</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select disabled class="form-control" id="id_client" name="id_client"
                                                    value="{{ old('id_client') }}" required>
                                                    <option selected value="{{ $nota_pedido->id_client }}">{{ $nota_pedido->Client->name }} {{ $nota_pedido->Client->last_name }}</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="fecha">Fecha</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/calenda.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input disabled id="fecha" name="fecha" type="date" class="form-control" placeholder="fecha" value="{{$nota_pedido->fecha}}" required>
                                                </div>
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="nota">Total Anterior</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input disabled id="total_anterior" name="total_anterior" type="number" class="form-control" value="{{$nota_pedido->total}}" >
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="nota">Total Actual</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input disabled id="total" name="total" type="number" class="form-control" >
                                                </div>
                                            </div>


                                            <div class="form-group col-6">
                                                <label for="num_sesion">Descuento (%)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/descuentos.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="descuento_porcentaje" name="descuento_porcentaje" type="number" class="form-control"  value="{{$nota_pedido->descuento}}">
                                                </div>
                                            </div>

                                            <div class="form-group col-6">
                                                    <label for="total-suma">Dinero recibido *</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                        </span>
                                                        <input  id="dinero_recibido" name="dinero_recibido" type="number" class="form-control" value="{{$nota_pedido->dinero_recibido}}" required>
                                                    </div>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="num_sesion">Metodo de pago</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/transferir.png') }}" alt="" width="25px">
                                                    </span>
                                                    <select disabled id="metodo_pago" name="metodo_pago" class="form-control" required>
                                                        <option selected value="{{$nota_pedido->metodo_pago}}">{{$nota_pedido->metodo_pago}}</option>
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
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero_recibido2" name="dinero_recibido2" type="number" class="form-control" value="{{$nota_pedido->dinero_recibido2}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="num_sesion">Metodo de pago 2</label>
                                                    <select id="metodo_pago2" name="metodo_pago2" class="form-control">
                                                        <option selected value="{{$nota_pedido->metodo_pago2}}">{{$nota_pedido->metodo_pago2}}</option>
                                                        <option value="Efectivo">Efectivo</option>
                                                        <option value="Transferencia">Transferencia</option>
                                                        <option value="Mercado Pago">Mercado Pago</option>
                                                        <option value="Tarjeta">Tarjeta</option>
                                                    </select>
                                                </div>
                                            </div>

                                            @if ($nota_pedido->foto == NULL)
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="nota">Foto</label>
                                                        <input type="file" id="foto" class="form-control" name="foto">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <a href="javascript:abrir('{{asset('foto_producto/'.$nota_pedido->foto)}}','500','500')">
                                                        <img src="{{asset('foto_producto/'.$nota_pedido->foto)}}" style="width: 30%">
                                                    </a>
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="tab-pane fade" id="pedidoedit{{$nota_pedido->id}}" >

                                        <div class="row text-center">
                                            <div class="row mt-4">
                                                <div class="col-4" style="background-color: #212529; color: #fff;">Cantidad</div>
                                                <div class="col-4" style="background-color: #212529; color: #fff;">Concepto</div>
                                                <div class="col-4" style="background-color: #212529; color: #fff;">Importe</div>

                                                <p style="display: none">{{ $resultado = 0; }}</p>
                                                @foreach ($pedido as $item)
                                                    @if ($item->id_nota == $nota_pedido->id)
                                                    <div class="col-4"><input disabled name="cantidad[]" type="number" class="form-control" id="cantidad[]"
                                                            value="{{$item->cantidad}}"></div>
                                                    <div class="col-4"><input disabled name="concepto[]" type="text" class="form-control" id="concepto[]"
                                                            value="{{$item->concepto}}"></div>
                                                    <div class="col-4"><input disabled name="importe[]" type="number" class="form-control" id="importe[]"
                                                        value="{{$item->importe}}"></div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        <div id="formulario" class="mt-4">
                                            <label for="Material">Pedido</label>
                                            <button type="button" class="clonar btn btn-secondary btn-sm" onclick="clonar()">+</button>
                                            <div class="clonars">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="fecha">Cantidad</label>
                                                            <input id="cantidad[]" name="cantidad[]" type="number" class="form-control" onchange="calcularTotal()">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="pago">Concepto</label>
                                                            <input id="concepto[]" name="concepto[]" type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="num_sesion">Importe</label>
                                                            <input id="importe[]" name="importe[]" type="number" class="form-control" onchange="calcularTotal()">
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group"> -<br>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminar(this)">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                                    </div>
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
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.input-edit-car').select2();
    });

document.getElementById('descuento_porcentaje').addEventListener('change', function() {
    calcularTotal();
});


        function clonar() {
            // Clonar el contenedor clonars
            var clon = document.querySelector('.clonars').cloneNode(true);

            // Limpiar los valores de los inputs clonados
            var inputs = clon.querySelectorAll('input[type="number"], input[type="text"]');
            inputs.forEach(function(input) {
                input.value = '';
            });

            // Agregar el botón "Eliminar"
            var btnEliminar = clon.querySelector('button');
            btnEliminar.textContent = 'Eliminar';
            btnEliminar.classList.remove('btn-secondary');
            btnEliminar.classList.add('btn-danger');
            btnEliminar.onclick = function() {
                eliminar(clon);
            };

            // Agregar el clon al final del contenedor formulario
            document.getElementById('formulario').appendChild(clon);
        }

        function eliminar(elemento) {
            elemento.remove();
            calcularTotal(); // Llama a la función para recalcular el total cuando se elimina un elemento
        }

        function calcularTotal() {
            var totales = document.querySelectorAll('#formulario input[id^="importe[]"]');
            var cantidades = document.querySelectorAll('#formulario input[id^="cantidad[]"]');
            var total = parseFloat(document.getElementById('total_anterior').value) || 0; // Obtener el total anterior
            var descuentoPorcentaje = parseFloat(document.getElementById('descuento_porcentaje').value) || 0; // Obtener el descuento por porcentaje

            // Calcular el total antes del descuento
            for (var i = 0; i < totales.length; i++) {
                var importe = parseFloat(totales[i].value) || 0;
                var cantidad = parseFloat(cantidades[i].value) || 0;
                total += importe * cantidad;
            }

            // Calcular el descuento en términos de porcentaje del total calculado
            var descuento = (total * descuentoPorcentaje) / 100;

            // Restar el descuento del total
            total -= descuento;
            console.log(total);
            // Asignar el total calculado al input "dinero_recibido2"
            document.getElementById('total').value = total;
        }

        // inicio de funcion ajax impresion caja y tiket
        function habilitarInputs() {
            // Habilitar los inputs
            document.getElementById('id_user').disabled = false;
            document.getElementById('id_client').disabled = false;
            document.getElementById('fecha').disabled = false;
            document.getElementById('total').disabled = false;
            document.getElementById('metodo_pago').disabled = false;
        }

        function deshabilitarInputs() {
            // Deshabilitar los inputs
            document.getElementById('id_user').disabled = true;
            document.getElementById('id_client').disabled = true;
            document.getElementById('fecha').disabled = true;
            document.getElementById('total').disabled = true;
            document.getElementById('metodo_pago').disabled = true;
        }

        $(document).ready(function () {

            $("#miFormulario").on("submit", function (event) {
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
                        imprimirRecibo(response);
                    },
                    error: function (xhr, status, error) {
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

                        if(formaPago === 'Efectivo'){

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
                                    conector.EscribirTexto("Servicio: " + servicio + "\n").EscribirTexto("-------------------------");
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

                        }else{

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
                                    conector.EscribirTexto("Servicio: " + servicio + "\n").EscribirTexto("-------------------------");
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
</script>


@endsection
