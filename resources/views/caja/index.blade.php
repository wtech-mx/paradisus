@extends('layouts.app')

@section('template_title')
    Caja
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            @php
                $total_ing = 0;

                $total_ing =  $pago_suma->total +  $pago_pedidos_suma->total + $pago_paquete_suma->total + $caja_vista->inicio + $caja_dia_suma_Ingreso->total + $pago_laser_suma->total + $propinas_suma->total + $pago_facial_suma->total;

                $total_egresos = 0;
                $total_egresos = $total_ing - $caja_dia_suma->total;
            @endphp
                {{-- =============== C A R D   T O T A L E S =============================== --}}
            <div class="col-sm-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Total') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            {{-- =============== I N G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Ingresos</p>
                                            <h5 class="font-weight-bolder text-white" >
                                                ${{ number_format($total_ing, 1, '.', ',') }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle" style="background: {{$configuracion->color_iconos_sidebar}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== E G R E S O S =============================== --}}
                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Egresos</p>
                                            <h5 class="font-weight-bolder text-white">
                                                ${{ number_format($caja_dia_suma->total, 1, '.', ',') }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/presupuesto.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== T O T A L =============================== --}}

                            <div class="col-lg-4 col-md-4 col-12">
                                <div class="card bg-dark mb-4">
                                    <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm text-white mb-0 text-uppercase font-weight-bold">Total</p>
                                            <h5 class="font-weight-bolder text-white">
                                                ${{ number_format($total_egresos, 1, '.', ',') }}
                                            </h5>
                                        </div>
                                        </div>
                                        <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow-primary text-center rounded-circle"  style="background: {{$configuracion->color_principal}}; color: #ffff">
                                            <img src="{{ asset('assets/icons/bolsa-de-dinero.png') }}" alt="" width="35px">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            {{-- =============== S A L D O  I N I C I A L =============================== --}}

                            {{-- @if ($caja == NULL)
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="card  mb-4">
                                        <div class="card-body p-3">
                                            <form method="POST" action="{{ route('caja.caja_inicial') }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Saldo inicial en caja</p>
                                                            <input name="ingresos" id="ingresos" type="number" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <p></p>
                                                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}

                        </div>
                    </div>
                </div>
            </div>

            {{-- =============== C A R D   I N G R E S O S =============================== --}}
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Ingresos
                            </span>
                            @if ($caja_vista->total == NULL)
                            <a type="button" class="btn btn-outline-warning" href="{{ route('caja.corte') }}"
                                onclick="return confirm('¿Estás seguro de que deseas realizar el corte?')">
                                <img src="{{ asset('assets/icons/cortar.png') }}" alt="" width="35px"> -  Corte
                            </a>

                                <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDataModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <img src="{{ asset('assets/icons/retiro-de-efectivo.png') }}" alt="" width="35px"> Ingresos y/o Retiro
                                </a>
                            @endif
                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">

                            @include('caja.create')


                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Num Nota</th>
                                            <th>Monto</th>
                                            <th>Dinero recibido</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pago_facial as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #6a00e3;background-color: #8800e36c;">Paquete Facial</label> </td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ $item->pago }}</td>
                                                <td>${{ number_format($item->dinero_recibido, 1, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                        @foreach ($pago as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #7500e3;background-color: #7500e36c;">Nota Servicio</label> </td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ number_format($item->pago, 1, '.', ',') }}</td>
                                                <td>${{ number_format($item->dinero_recibido, 1, '.', ',') }}</td>
                                            </tr>
                                        @endforeach

                                        @foreach ($pago_laser as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #0075e3;background-color: #00e3d06c;">Nota Laser</label> </td>
                                                <td>{{ $item->id_nota }}</td>
                                                <td>${{ $item->pago }}</td>
                                                <td>${{ number_format($item->dinero_recibido, 1, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                        @foreach ($pago_pedidos as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #004fe3;background-color: #0062e36c;">Nota Pedido</label> </td>
                                                <td>{{ $item->id }}</td>
                                                <td>${{ number_format($item->total, 1, '.', ',') }}</td>
                                                @if ($item->metodo_pago2 == 'Efectivo')
                                                    <td>
                                                        ${{ number_format($item->dinero_recibido2, 1, '.', ',') }}
                                                    </td>
                                                @else
                                                    <td>
                                                        ${{ number_format($item->dinero_recibido, 1, '.', ',') }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach

                                        @foreach ($pago_paquete as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #e300aa;background-color: #e3009f6c;">Nota Paquete</label> </td>
                                                <td>{{ $item->id_paquete }}</td>
                                                <td>${{ $item->pago }}</td>
                                                <td>${{ number_format($item->dinero_recibido, 1, '.', ',') }}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                        @foreach ($propinas as $item)
                                            <tr>
                                                <td>{{ $item->fecha }}</td>
                                                <td> <label class="badge" style="color: #e30000;background-color: #e300006c;">Propina</label> </td>
                                                <td>-</td>
                                                <td>${{ number_format($item->propina, 1, '.', ',') }}</td>
                                                <td>${{ number_format($item->propina, 1, '.', ',') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>

            {{-- =============== C A R D   E G R E S O S =============================== --}}
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Egresos
                            </span>

                            @if ($caja_vista->total != NULL)
                                <a type="button" class="btn btn-outline-dark" href="{{ route('caja.print_caja') }}">Imprimir Corte</a>
                            @endif

                            <a type="button" class="btn btn-outline-warning" href="{{ route('caja.print_precorte') }}">
                                <img src="{{ asset('assets/icons/presupuesto.png') }}" alt="" width="35px"> Precorte
                            </a>

                        </div>
                    </div>
                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table_id text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>Monto</th>
                                            <th>Concepto</th>
                                            <th>Motivo</th>
                                            <th>Editar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($caja_dia as $item)
                                            <tr>
                                                <td>${{ number_format($item->egresos, 1, '.', ',') }}</td>
                                                <td>{{ $item->concepto }}</td>

                                                <td>
                                                    @if($item->motivo == 'Ingreso')

                                                    <a type="" class="btn btn-sm btn-outline-success">
                                                        {{ $item->motivo }}
                                                    </a>
                                                    @else

                                                    <a type="" class="btn btn-sm btn-outline-danger">
                                                        {{ $item->motivo }}
                                                    </a>

                                                    @endif
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editDataModal{{ $item->id }}" ><i class="fa fa-pencil"></i> Editar</a>
                                                    <form action="{{ route('caja.destroy', $item->id) }}" method="POST" style="display: inline-block;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @include('caja.edit')
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js_custom')
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>

<script>
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
                    success: function (response) {
                        imprimirRecibo(response);
                        console.log(response);
                    if (response.success) {
                        // Cerrar el modal
                        $('#createDataModal').modal('hide');

                        // Mostrar SweetAlert de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado exitosamente',
                            text: 'El registro se ha guardado correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Recargar la página o actualizar la tabla
                            location.reload();
                        });
                    }
                },
                error: function (xhr) {
                    // Manejar errores
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un problema al guardar el registro.',
                    });
                }
                });

            });

            // Función para imprimir el recibo
            async function imprimirRecibo(response) {
                        const userAgent = navigator.userAgent;

                        // Obtén los datos del recibo de la respuesta AJAX

                        const recibo = response.recibo;
                        console.log(recibo);

                        if (/Windows/i.test(userAgent)) {

                        // Empezar a usar el plugin
                            const conector = new ConectorPluginV3();
                            conector.Pulso(parseInt(48), parseInt(60), parseInt(120));
                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Motivo : " + recibo.Motivo + "\n")
                                .EscribirTexto("Fecha : " + recibo.Fecha + "\n")
                                .EscribirTexto("Monto: $" + recibo.Monto + "\n")
                                .EscribirTexto("Concepto: " + recibo.Concepto + "\n")
                                .EscribirTexto("-------------------------")
                                .Feed(1);

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
                                   window.location.href = '/caja/';
                                });
                            }
                        } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            window.location.href = 'caja';
                        }, 1000);
                    }
            }
    });
</script>

@endsection
