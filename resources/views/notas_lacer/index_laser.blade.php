@extends('layouts.app')

@section('template_title')
    Notas Laser
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
                                            <input type="text" value="{{$nota_laser->Client->name}} {{$nota_laser->Client->last_name}}" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                                        </div>

                                        <div class="col-6 mt-3">
                                            <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                                Telefono:
                                            </p>
                                            <input type="text" value="{{$nota_laser->Client->phone}}" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>

                                        </div>

                                        <div class="col-6 mt-3">
                                            <p class="d-inline mr-5"  style="color:#C45584;font-weight: 600;margin-right: 2rem;">
                                                DNI :
                                            </p>

                                            <input type="text" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                        </div>

                                        @foreach ($zonas_lacer as $zona_lacer)

                                            <div class="col-12 mt-5">
                                                <div class="table-responsive">
                                                    <table class="table align-items-left mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Session</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Zona______________</th>
                                                            <th class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parametros</th>
                                                            <th class="text-secondary opacity-7">Observaciones</th>
                                                            <th class="text-secondary opacity-7">Guardar</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @for ($i = 1; $i <= $zona_lacer->sesiones_compradas; $i++)
                                                            <form method="POST" action="{{ route('store_sesion.lacer') }}" id="miFormulario" enctype="multipart/form-data" role="form">
                                                                @csrf
                                                                @php
                                                                    $registro = $registrosZonas->where('id_zona', '=', $zona_lacer->id_zona)->firstWhere('sesion', $i);

                                                                    // Verificar si la fila debería estar habilitada
                                                                    $filaHabilitada = true;
                                                                    if (($nota_laser->tipo === 'Zona Mini' || $nota_laser->tipo === 'Zonas Pequeñas') && $i > 2) {
                                                                        $filaHabilitada = false;
                                                                    } elseif (($nota_laser->tipo === 'Zonas Medianas' || $nota_laser->tipo === 'Zonas Grandes') && $i > 4) {
                                                                        $filaHabilitada = false;
                                                                    }

                                                                    // Verificar si hay restante
                                                                    $hayRestante = $nota_laser->restante > 0;
                                                                @endphp
                                                                <tr>
                                                                    <input type="text" class="form-control" name="id_nota" value="{{$zona_lacer->id_nota}}" style="display: none">

                                                                    <td>
                                                                        <input type="number" value="{{$i}}" name="sesion" class="form-control" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                                                                    </td>

                                                                    <td>
                                                                        @if ($registro)
                                                                            <input type="date" value="{{ $registro->fecha }}" class="form-control" style="display: inline-block;width: 100%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                                                                        @else
                                                                            <input type="date" name="fecha" value="{{$fechaActual}}" class="form-control" style="display: inline-block;width: 100%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        <select class="form-control" name="id_zona" style="display: inline-block;width: 100%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                                                                            <option value="{{$zona_lacer->id_zona}}">{{$zona_lacer->Zona->zona}}</option>
                                                                        </select>
                                                                    </td>

                                                                    <td>
                                                                        @if ($registro)
                                                                            <input type="text" class="form-control" name="parametros" value="{{ $registro->parametros }}" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;" readonly>
                                                                        @else
                                                                            <input type="text" class="form-control" name="parametros" style="display: inline-block;width: 50%;border: 0px solid;border-bottom: 1px dotted #C45584;border-radius: 0;">
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        @if ($registro)
                                                                            <textarea class="form-control" cols="10" rows="1" readonly>{{ $registro->nota }}</textarea>
                                                                        @else
                                                                            <textarea class="form-control" cols="10" rows="1" name="nota"></textarea>
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        @if ($registro)@else
                                                                            @if (!$hayRestante || !$filaHabilitada)

                                                                            @else
                                                                                <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                                                                    G
                                                                                </button>
                                                                            @endif
                                                                        @endif
                                                                    </td>

                                                                </tr>
                                                            </form>
                                                        @endfor

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>

                                        @endforeach
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <div class="row text-center container_pagos">
                                    <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha</div>
                                    <div class="col-2" style="background-color: #bb546c; color: #fff;">Usuario</div>
                                    <div class="col-1" style="background-color: #bb546c; color: #fff;">Pago</div>
                                    <div class="col-2" style="background-color: #bb546c; color: #fff;">Dinero recibido</div>
                                    <div class="col-2" style="background-color: #bb546c; color: #fff;">Metodo </div>
                                    <div class="col-2" style="background-color: #bb546c; color: #fff;">Nota</div>
                                    <div class="col-1" style="background-color: #bb546c; color: #fff;">Foto</div>

                                    <p style="display: none">{{ $resultado = 0; }}</p>

                                    @foreach ($pago as $item)

                                        <input id="pago_{{ $item->id }}" name="pago_id_edit[]" type="hidden" class="form-control" value="{{ $item->id }}">


                                        <p style="display: none">{{ $resultado += $item->pago; }}</p>

                                        <div class="col-2 py-2 p-1" >
                                            <input name="fecha_pago_edit[]" type="date" class="form-control text-center" id="fecha_pago" value="{{$item->fecha}}" disabled>
                                        </div>

                                        <div class="col-2 py-2 p-1" >
                                            <select class="form-control toggle-class" id="cosmetologa" name="cosmetologa_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive">
                                                <option value="{{$item->id_user}}">{{ $item->User->name }}</option>
                                                @foreach ($user as $cosmes)
                                                    <option value="{{ $cosmes->id }}" >{{ $cosmes->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-1 py-2 p-1" >
                                            <input name="pago_edit[]" type="number" class="form-control text-center pago-existente" id="pago_{{ $item->id }}" value="{{$item->pago}}" disabled>
                                        </div>

                                        <div class="col-2 py-2 p-1" >
                                            <input name="dinero_recibido_edit[]" type="number" class="form-control text-center" id="pago_{{ $item->id }}" value="{{$item->dinero_recibido}}" disabled>
                                        </div>

                                        <div class="col-2 py-2 p-1" >
                                            <select class="form-control toggle-class" id="cosmetologa" name="forma_pago_edit[]" data-toggle="select" data-id="{{ $item->id }}" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive">
                                                <option value="{{$item->forma_pago}}">{{$item->forma_pago}}</option>
                                                <option value="Efectivo">Efectivo</option>
                                                <option value="Transferencia">Transferencia</option>
                                                <option value="Mercado Pago">Mercado Pago</option>
                                                <option value="Tarjeta">Tarjeta</option>
                                            </select>
                                        </div>

                                        <div class="col-2 py-2 p-1" >
                                            <textarea class="form-control text-center" name="nota_edit[]" id="nota[]" cols="3" rows="1" disabled>{{$item->nota}}</textarea>
                                        </div>

                                        @if ($item->foto == NULL)
                                            <a href=""></a>
                                        @else
                                            <div class="col-1 py-2 p-1">
                                                <a target="_blank" href="{{asset('foto_servicios/'.$item->foto)}}">Ver</a>
                                            </div>
                                        @endif

                                    @endforeach

                                </div>

                                <form method="POST" action="{{ route('update.lacer', $nota_laser->id) }}" enctype="multipart/form-data" id="miFormularioEditLaser" role="form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PATCH">
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="total-suma">Total a Pagar</label>
                                                    <input type="text" id="total-suma" name="total-suma" class="form-control" readonly value="{{$nota_laser->total}}">
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
                                                    <input type="text" id="restante-edit" name="restante_paquetes" class="form-control" readonly value="{{$nota_laser->restante}}">
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="restante">Cambio</label>
                                                    <input type="text" id="cambio-edit" name="cambio" class="form-control" readonly>
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
                                                        @foreach ($user as $cosmes)
                                                            <option value="{{ $cosmes->id }}">{{ $cosmes->name }}</option>
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
                                                    <input  id="nuevo-pago" name="pago" type="number" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <label for="total-suma">Dinero recibido</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                                    </span>
                                                    <input  id="dinero-recibido-edit" name="dinero_recibido" type="number" class="form-control" >
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
                                    <button type="submit" class="btn mt-5" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                        Guardar
                                    </button>
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

<script>
        // Obtén la referencia a los elementos de nuevo-pago, cambio-edit, dinero-recibido-edit y restante-edit
        var inputNuevoPago = $('#nuevo-pago');
        var inputCambioEdit = $('#cambio-edit');
        var inputDineroRecibidoEdit = $('#dinero-recibido-edit');
        var inputRestanteEdit = $('#restante-edit');
        var precioDesdeDB = parseFloat("<?php echo $nota_laser->total; ?>");
        $('#total-suma').val(precioDesdeDB);
        console.log('precio', precioDesdeDB);

        function calcularCambio() {
            var nuevoPago = parseFloat(inputNuevoPago.val()) || 0;
            var dineroRecibidoEdit = parseFloat(inputDineroRecibidoEdit.val()) || 0;

            var cambio = 0;

            if (dineroRecibidoEdit > nuevoPago) {
                cambio = dineroRecibidoEdit - nuevoPago;
            }

            inputCambioEdit.val(cambio);
        }

        function calcularRestante() {
            var cambiosRealizados = false;
            var pagosExistentes = 0;
            $('.pago-existente').each(function() {
                pagosExistentes += parseFloat($(this).val()) || 0;
            });

            var nuevoPago = parseFloat(inputNuevoPago.val()) || 0;
            if (cambiosRealizados) {
                var totalSuma = parseFloat($('#total-suma').val()) || 0;
            }else{
                var totalSuma = parseFloat("<?php echo $nota_laser->total; ?>") || 0;
            }

            console.log('saldo', pagosExistentes);
            var restante = totalSuma - pagosExistentes - nuevoPago;

            inputRestanteEdit.val(restante);
        }

        // Escucha el evento 'input' en los campos de nuevo-pago y dinero-recibido-edit
        inputNuevoPago.on('input', function() {
            calcularCambio();
            calcularRestante();
        });

        inputDineroRecibidoEdit.on('input', function() {
            calcularCambio();
            calcularRestante();
        });

        // Calcula el cambio y el restante al cargar la página
        calcularCambio();
        calcularRestante();

        document.addEventListener('DOMContentLoaded', function () {
            $("#miFormularioEditLaser").on("submit", function (event) {
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
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        // Itera a través de los errores y agrega cada mensaje de error al mensaje final
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessages = errors[key].join('<br>'); // Usamos <br> para separar los mensajes
                                errorMessage += '<strong>' + key + ':</strong><br>' + errorMessages + '<br>';
                            }
                        }
                        console.log(errorMessage);
                        // Muestra el mensaje de error en una SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Faltan Campos',
                            html: errorMessage, // Usa "html" para mostrar el mensaje con formato HTML
                        });
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
                            console.log(recibo);

                            conector.Pulso(parseInt(48), parseInt(60), parseInt(120));

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
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
                            console.log(recibo);

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
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
                                    window.location.href = '/notas/laser/edit/' + recibo.id;
                                });
                            }

                        }
                    } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            window.location.href = '/notas/laser/edit/' + recibo.id;
                        }, 1000);
                    }
            }
        });
</script>

@endsection

