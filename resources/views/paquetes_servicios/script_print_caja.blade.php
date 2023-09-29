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
                    success: async function(response) { // Agrega "async" aquí
                        // El formulario se ha enviado correctamente, ahora realiza la impresión
                        imprimirRecibo(response);
                        console.log(response);

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

                        const formaPago = $("#forma_pago").val();

                        console.log(recibo);

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
            }
    });

</script>
