<script>
    $(document).ready(function() {

        $('.user_disponibilidad').select2();
        $('.cliente_disponibilidad').select2();
        $('.multi_cosme_disponibilidad').select2();
        $('.disponibilidad_2').select2();

        let pagina = 1;

        $('#buscarDisponibilidadForm').on('submit', function(e) {
            e.preventDefault();
            pagina = 1;  // Reiniciar la página cuando se envía el formulario

            buscarDisponibilidad(true);
        });

        function buscarDisponibilidad(reset = false) {
            const servicioId = $('#servicio').val();
            const duracion = $('#servicio option:selected').data('duracion');
            const numPersonas = $('#numPersonas').val();

            $.ajax({
                url: '/buscar-disponibilidad',
                method: 'GET',
                data: {
                    servicioId: servicioId,
                    duracion: duracion,
                    numPersonas: numPersonas,
                    pagina: pagina
                },
                success: function(data) {
                console.log(data);
                    if (reset) {
                        $('#resultadosDisponibilidad').html('');
                    }

                    let resultadosHtml = '';

                    if (Object.keys(data).length > 0) {
                        let collapseId = pagina * 5;  // Ajustar el ID para evitar conflictos

                        for (const [fecha, horarios] of Object.entries(data)) {
                            const fechaFormateada = moment(fecha).locale('es').format('dddd D [de] MMMM');
                            collapseId++;
                            resultadosHtml += `
                                <div class="card mb-3">
                                    <div class="card-header" id="heading${collapseId}" style="padding: 1.5rem 1.5rem 0 1.5rem;">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${collapseId}" aria-expanded="true" aria-controls="collapse${collapseId}">
                                                ${fechaFormateada}
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse${collapseId}" class="collapse" aria-labelledby="heading${collapseId}" data-parent="#resultadosDisponibilidad">
                                        <div class="card-body">
                            `;
                            horarios.forEach(horario => {
                                resultadosHtml += `<div><h4>${horario.hora}</h4><ul>`;
                                horario.cosmes.forEach(cosme => {
                                    resultadosHtml += `<li>${cosme}</li>`;
                                });
                                resultadosHtml += '</ul>';
                                resultadosHtml += `
                                    <button class="seleccionarHorario btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"
                                        data-fecha="${fecha}"
                                        data-hora="${horario.hora}"
                                        data-servicio="${servicioId}"
                                        data-numPersonas="${numPersonas}"
                                        data-cosmes='${JSON.stringify(horario.cosmes)}'>
                                        ¿Agendar?
                                    </button>
                                `;
                                resultadosHtml += '</div>';
                            });
                            resultadosHtml += `
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    } else {
                        if (reset) {
                            resultadosHtml = '<p>No hay disponibilidad para el servicio seleccionado.</p>';
                        }
                    }

                    $('#resultadosDisponibilidad').append(resultadosHtml);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        $('#buscarMasFechas').on('click', function() {
            pagina++;
            buscarDisponibilidad();

            alert('Busqueda Actualizada');
        });

        $('#resultadosDisponibilidad').on('click', '.seleccionarHorario', function() {
            const fechaSeleccionada = $(this).data('fecha');
            const horaSeleccionada = $(this).data('hora');
            const servicioIdSeleccionado = $(this).data('servicio');
            const numPersonasSeleccionado = $(this).data('numPersonas');
            const cosmesSeleccionados = $(this).data('cosmes');
            console.log(cosmesSeleccionados);

            $('#fechaSeleccionadaInput').val(fechaSeleccionada);
            $('#horaSeleccionadaInput').val(horaSeleccionada);
            $('#servicioIdInput').val(servicioIdSeleccionado);
            $('#numPersonasInput').val(numPersonasSeleccionado);

            // Preselecciona los cosmes en el multiselect
            $('#cosme_disp').val(cosmesSeleccionados).trigger('change');

             $('#formularioFechaSeleccionada').show();
            actualizarTotalSuma();
        });

        $('#num_servicio').on('input', function() {
            actualizarTotalSuma();
        });

        $('#pagoInput').on('input', function() {
            actualizarRestante();
            actualizarCambio();
        });

        $('#dineroRecibidoInput').on('input', function() {
            actualizarCambio();
        });

        function actualizarTotalSuma() {
            const numServicios = $('#num_servicio').val();
            const precioServicio = parseFloat($('#servicio option:selected').data('precio'));
            const totalSuma = precioServicio * numServicios;
            $('#totalSumaInput').val(totalSuma);
            actualizarRestante();
        }

        function actualizarRestante() {
            const totalSuma = parseFloat($('#totalSumaInput').val());
            const pago = parseFloat($('#pagoInput').val()) || 0;
            const restante = totalSuma - pago;
            $('#restanteInput').val(restante);
        }

        function actualizarCambio() {
            const pago = parseFloat($('#pagoInput').val()) || 0;
            const dineroRecibido = parseFloat($('#dineroRecibidoInput').val()) || 0;
            const cambio = dineroRecibido - pago;
            $('#cambioInput').val(cambio > 0 ? cambio : 0);
        }

        $('#submit_disponibilidad').on('click', function(e, callback) {
    e.preventDefault();

    var $button = $(this);
    var $spinner = $('#spinner');
    var formData = $('#detallesFechaSeleccionadaForm').serialize();

    // Mostrar el spinner y deshabilitar el botón
    $spinner.show();
    $button.prop('disabled', true);

    $.ajax({
        type: 'POST',
        url: "{{ route('store_agenda.notas') }}",
        data: formData,
        success: function(response) {
            console.log('Éxito:', response);

            if (response.success) {
                // Mostrar mensaje de éxito
                alert(response.message);

                calendar.refetchEvents();
                if (callback) callback();  // Llama a la callback si existe
                // Reiniciar el formulario
                $('#detallesFechaSeleccionadaForm')[0].reset();
                $('#buscarDisponibilidadForm')[0].reset();
                console.log('Formulario reseteado'); // Verificar si se ejecuta
                $('#id_client').val([]).trigger('change');
                $('#cosme_disp').val([]).trigger('change');
                $('#id_user').val([]).trigger('change');


                console.log('Contenedores ocultados'); // Verificar si se ejecuta

                // Ocultar el spinner y habilitar el botón después de completar la solicitud
                $spinner.hide();
                $button.prop('disabled', false);
            } else {
                alert('Hubo un problema al actualizar la cita.');
            }
        },
        error: function(xhr, response, error) {
            // Maneja el error si es necesario
            alert('No se ha podido guardar');
            console.error('Error:', error);

            // Ocultar el spinner y habilitar el botón en caso de error
            $spinner.hide();
            $button.prop('disabled', false);
        }
    });
});



});

</script>
