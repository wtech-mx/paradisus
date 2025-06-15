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
                    // success: async function(response) { // Agrega "async" aquí
                    //     // El formulario se ha enviado correctamente, ahora realiza la impresión
                    //     imprimirRecibo(response);
                    //     console.log(response);

                    // },
                    success: async function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Guardado con éxito',
                            text: 'Los datos han sido registrados correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        try {
                            await imprimirRecibo(response);
                        } catch (error) {
                            console.error('Error al imprimir:', error);
                            Swal.fire({
                                icon: 'warning',
                                title: 'Guardado pero no se imprimió',
                                text: 'Verifica la impresora si es necesario.',
                            });
                            window.location.href = '/paquetes/servicios';
                        }
                    },
                    error: function (xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = '';

                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessages = errors[key].join('<br>');
                                errorMessage += '<strong>' + key + ':</strong><br>' + errorMessages + '<br>';
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Faltan Campos',
                            html: errorMessage,
                        });
                    }

                });

            });

            // Función para imprimir el recibo
            async function imprimirRecibo(response) {
                        const userAgent = navigator.userAgent;

                        // Obtén los datos del recibo de la respuesta AJAX
                        const recibo = response.recibo;

                        const formaPago = $("#forma_pago").val();

                        console.log(recibo);
                    if (/Windows/i.test(userAgent)) {
                        if(formaPago === 'Efectivo'){
                            // Empezar a usar el plugin
                            const conector = new ConectorPluginV3();
                            conector.Pulso(parseInt(48), parseInt(60), parseInt(120));
                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente : " + recibo.Cliente + "\n")
                                .EscribirTexto("Fecha : " + recibo.Fecha + "\n")
                                .EscribirTexto("Paquete: " + recibo.Paquete + "\n")
                                .EscribirTexto("Pago: " + recibo.Pago + "\n")
                                .EscribirTexto("Dinero_recibido: " + recibo.Dinero_recibido + "\n")
                                .EscribirTexto("Cambio: " + recibo.Cambio + "\n")
                                .EscribirTexto("Forma_pago: " + recibo.Forma_pago + "\n")
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
                                   window.location.href = '/paquetes/servicios/';
                                });
                            }

                        }else{
                            // Empezar a usar el plugin
                            console.log(recibo);

                            const conector = new ConectorPluginV3();
                            conector
                                .EscribirTexto("Paradisus\n")
                                .EscribirTexto("Ticket #: " + recibo.id + "\n")
                                .EscribirTexto("Cliente : " + recibo.Cliente + "\n")
                                .EscribirTexto("Fecha : " + recibo.Fecha + "\n")
                                .EscribirTexto("Paquete: " + recibo.Paquete + "\n")
                                .EscribirTexto("Pago: " + recibo.Pago + "\n")
                                .EscribirTexto("Dinero_recibido: " + recibo.Dinero_recibido + "\n")
                                .EscribirTexto("Cambio: " + recibo.Cambio + "\n")
                                .EscribirTexto("Forma_pago: " + recibo.Forma_pago + "\n")
                                .EscribirTexto("-------------------------")
                                .Feed(1);
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
                                   window.location.href = '/paquetes/servicios/';
                                });
                            }
                        }
                    } else if (/Macintosh/i.test(userAgent)) {
                        // Si es Windows, muestra una alerta y redirige a Google después de 5 segundos
                        alert("¡Estás usando una Mac! Serás redirigido a la nota en 1 segundo.");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
            }
    });

</script>
