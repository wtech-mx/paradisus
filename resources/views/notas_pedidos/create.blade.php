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
                        <h3 class="mb-3">Crear Nota Pedido</h3>

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

                    <form method="POST" action="{{ route('notas_pedidos.store') }}" enctype="multipart/form-data" role="form" id="miFormulario">
                        @csrf
                        <div class="modal-body">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                                    <div class="row">

                                        <div class="form-group col-3">
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

                                        <div class="form-group col-3">
                                            <label for="precio">Nuevo cliente</label><br>
                                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                Agregar <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                            </button>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Cliente *</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/icons/cliente.png') }}" alt="" width="25px">
                                                </span>

                                                <select class="form-select cliente d-inline-block"  data-toggle="select" id="id_client" name="id_client" value="{{ old('id_client') }}" >
                                                    <option>Seleccionar cliente</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

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

                                                        <div class="col-4">
                                                            <label for="name">Correo *</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">
                                                                    <img src="{{ asset('assets/icons/correo-electronico.png') }}" alt="" width="29px">
                                                                </span>
                                                                <input  id="email" name="email" type="email" class="form-control" placeholder="correo@correo.com">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                                    <option value="" selected>selecione metodo de pago</option>
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
                                                        <label for="num_sesion">Metodo de pago 2</label>
                                                        <select id="metodo_pago2" name="metodo_pago2" class="form-control" value="{{old('metodo_pago2')}}" >
                                                            <option value="" selected>selecione metodo de pago</option>
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>

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
        var $clone = $('.clonars').first().clone();

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

    function calcularSuma() {
        var totalSuma = 0;

        // Itera a través de las filas de campos de cantidad e importe
        $('.clonars').each(function() {
            var cantidad = parseFloat($(this).find('input[name="cantidad[]"]').val()) || 0;
            var importe = parseFloat($(this).find('input[name="importe[]"]').val()) || 0;
            var subtotal = cantidad * importe; // Calcula el subtotal de esta fila
            totalSuma += subtotal;
        });

        // Actualiza el valor del campo de suma
        $('#totalSuma').val(totalSuma);
    }

    // Escucha el evento 'input' en los campos de cantidad y importe
    $('input[name="cantidad[]"], input[name="importe[]"]').on('input', function() {
        calcularSuma();
    });


    // Escucha el evento 'input' en los campos de dinero recibido y dinero recibido2
    $('#dinero_recibido').on('input', function() {
    calcularCambioYRestante();
    });

// Función para calcular cambio y restante
function calcularCambioYRestante() {
    // Obtiene el valor del dinero recibido
    var dineroRecibido = parseFloat($('#dinero_recibido').val()) || 0;

    // Obtiene el valor del total sumado
    var totalSuma = parseFloat($('#totalSuma').val()) || 0;

    // Calcula el restante como la diferencia entre el total y el dinero recibido
    var restante = totalSuma - dineroRecibido;

    // El restante no debe ser negativo
    restante = Math.max(restante, 0);

    // Calcula el cambio solo si el dinero recibido es mayor o igual que el total
    var cambio = (dineroRecibido >= totalSuma) ? dineroRecibido - totalSuma : 0;

    // Actualiza los campos Restante y Cambio
    $('#restante').val(restante);
    $('#cambio').val(cambio);
}

// Calcula el cambio y restante al cargar la página
calcularCambioYRestante();

    // inicio de funcion ajax impresion caja y tiket

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

                        // Obtén los datos del recibo de la respuesta AJAX
                        const recibo = response.recibo;
                        // Empezar a usar el plugin
                        const formaPago = $("#metodo_pago").val();
                        const formaPago2 = $("#metodo_pago2").val();
                        console.log(formaPago);
                        console.log(formaPago2);

                        if(formaPago === 'Efectivo' || formaPago2 === 'Efectivo'){

                            const conector = new ConectorPluginV3();

                            conector.Pulso(parseInt(48), parseInt(60), parseInt(120));

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Fecha: " + recibo.fecha + "\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                                .EscribirTexto("Metodo Pago: " + recibo.Metodo_pago + "\n")
                                .EscribirTexto("Metodo Pago 2: " + recibo.Metodo_pago_2 + "\n")
                                .EscribirTexto("Total: $" + recibo.Total + "\n")
                                .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                                .EscribirTexto("Cambio: $" + recibo.Cambio + "\n")
                                .EscribirTexto("-------------------------")
                                .Feed(1);

                                for (const pago of recibo.pago) {
                                    const cantidad = pago.pedido[0];
                                    const concepto = pago.pedido[1];
                                    const importe = pago.pedido[2];

                                    conector
                                        .EscribirTexto("Cantidad: " + cantidad + "\n")
                                        .EscribirTexto("Concepto: " + concepto + "\n")
                                        .EscribirTexto("Importe: " + importe + "\n")
                                        .EscribirTexto("-------------------------");

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
                                //    window.location.href = '/notas/pedidos/edit/' + recibo.id;
                                });
                            }

                        }else{

                            const conector = new ConectorPluginV3();

                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Fecha: " + recibo.fecha + "\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente: " + recibo.Cliente + "\n")
                                .EscribirTexto("Cosmetologa: " + recibo.cosmetologa + "\n")
                                .EscribirTexto("Total: $" + recibo.Total + "\n")
                                .EscribirTexto("Restante: $" + recibo.Restante + "\n")
                                .EscribirTexto("Cambio: $" + recibo.Cambio + "\n")
                                .EscribirTexto("-------------------------")
                                .Feed(1);

                                for (const pago of recibo.pago) {
                                    const cantidad = pago.pedido[0];
                                    const concepto = pago.pedido[1];
                                    const importe = pago.pedido[2];

                                    conector
                                        .EscribirTexto("Cantidad: " + cantidad + "\n")
                                        .EscribirTexto("Concepto: " + concepto + "\n")
                                        .EscribirTexto("Importe: " + importe + "\n")
                                        .EscribirTexto("-------------------------");

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
                                    // window.location.href = '/notas/pedidos/edit/' + recibo.id;
                                });
                            }

                        }
            }
        });


    </script>
@endsection
