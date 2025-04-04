@ -0,0 +1,916 @@
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

@include('alerts.js_buscar_disponibilidad')

<script type="text/javascript">
    $(document).ready(function() {
        $('.user_disponibilidad').select2();
        $('.cliente_disponibilidad').select2();
        $('.multi_cosme_disponibilidad').select2();
        $('.disponibilidad_2').select2();

        // $('.user_manual').select2();
        // $('.cliente_manual').select2();
        // $('.multi_cosme_manual').select2();
        // $('.servicios_manual').select2();

        // Inicializar select2 fuera del modal (por si acaso)
        $('.mibuscador_paciente').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#exampleModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

        // Re-inicializar select2 cada vez que se muestre el modal
        $('#exampleModal').on('shown.bs.modal', function () {
            $('.mibuscador_paciente').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.id_servicio_full').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.id_servicio_full2').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.cosmesInput_multiple').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.cosmesInput_multiple_nueva').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.cosmesInput_multipleComida').select2({
                width: '100%',
                dropdownParent: $('#comidaModal')
            });
        });

        // Inicializar select2 fuera del modal (por si acaso)
        $('.id_servicio_full').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#exampleModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

        // Inicializar select2 fuera del modal (por si acaso)
        $('.id_servicio_full2').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#exampleModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

        // Inicializar select2 fuera del modal (por si acaso)
        $('.cosmesInput_multiple').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#exampleModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

        $('.cosmesInput_multiple_nueva').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#exampleModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

        $('.cosmesInput_multipleComida').select2({
            width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
            dropdownParent: $('#comidaModal') // Esto asegura que el dropdown se renderice dentro del modal
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

    var calendarEl = document.getElementById('calendar');
    var originalResources = {!! json_encode($modulos) !!};

    var currentUrl = window.location.href; // Obtener la URL actual
    var eventsUrl;

    // Determinar la URL de eventos según la URL actual
    if (currentUrl.includes("/dashboard/anterior")) {
        eventsUrl = "{{ route('calendar.show_calendar_anterior') }}";
    } else {
        eventsUrl = "{{ route('calendar.show_calendar') }}";
    }

    var calendar = new FullCalendar.Calendar(calendarEl, {
        navLinks: true,
        height: 'auto',
        timeZone: 'local',
        initialDate: '{{$Fecha}}',
        initialView: 'dayGridMonth',
        nowIndicator: true,
        editable: true,
        dayMaxEvents: 5,
        aspectRatio: 1.8,
        themeSystem: 'bootstrap',
        scrollTime: "09:00:00",
        slotMinTime: "{{ date('H:i:s', strtotime($configuracion->horario_inicio)) }}",
        slotMaxTime: "{{ date('H:i:s', strtotime($configuracion->horario_fin)) }}",
        schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
        headerToolbar: {
            left: 'today prev,next',
            center: 'title',
            right: 'resourceTimeGridDay,dayGridMonth,list'
        },
        views: {
            resourceTimeGridDay: {
                titleFormat: { // para resourceTimeGridDay
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }
            },
            dayGridMonth: {
                titleFormat: { // para dayGridMonth
                    year: 'numeric',
                    month: 'long'
                }
            },
            list: {
                titleFormat: { // para list view
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }
            }
        },
        resources: {!! json_encode($modulos) !!},
        resources: originalResources,

        events: eventsUrl,

        datesSet: function(info) {
            var dayNames = ["domingo", "lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];
            var currentDay = dayNames[new Date(info.start).getDay()]; // Obtener el día de la semana actual

            if (info.view.type === 'resourceTimeGridDay') {
                var filteredResources = originalResources.filter(function(resource) {
                    return resource.horario[currentDay] === 1; // Filtrar los recursos según el día de la semana
                });
                calendar.setOption('resources', filteredResources);
            } else {
                calendar.setOption('resources', originalResources);
            }
        },

        // ======================= M O D A L  P A R A  N U E V A  C I T A =======================
        dateClick: function (info) {
            limpiarFormulario();
            $("#btnAgregar").prop("disabled", false);
            $("#btnModificar").prop("disabled", true);
            $("#btnBorrar").prop("disabled", true);

            if (info.allDay) {
                $('#txtFecha').val(info.dateStr);
            } else {
                let fechaHora = info.dateStr.split("T");
                let unahora = fechaHora[1].substring(0, 2);
                let final = Number(unahora) + 1;
                $('#txtFecha').val(fechaHora[0]);
                $('#txtHorafin').val(fechaHora[1].substring(0, 5));
                $('#txtHora').val(fechaHora[1].substring(0, 5));
                // console.log('hora', final)
            }
            $('#exampleModal').modal('toggle');
        },
        // ======================= E N D  M O D A L  P A R A  N U E V A  C I T A =======================

        eventClick: function (info) {
            $("#btnAgregar").prop("disabled", true);
            $("#btnModificar").prop("disabled", false);
            $("#btnBorrar").prop("disabled", false);
            $('#txtID').val(info.event.id);

            mes = (info.event.start.getMonth() + 1);
            dia = (info.event.start.getDate());
            anio = (info.event.start.getFullYear());

            mes = (mes < 10) ? "0" + mes : mes;
            dia = (dia < 10) ? "0" + dia : dia;

            minutos = (info.event.start.getMinutes());
            hora = (info.event.start.getHours());

            minutos = (minutos < 10) ? "0" + minutos : minutos;
            hora = (hora < 10) ? "0" + hora : hora;

            horario = (hora + ":" + minutos);

            minutos2 = (info.event.end && info.event.end.getMinutes()) || 0;
            hora2 = (info.event.end && info.event.end.getHours()) || 0;

            if (info.event.end) {
                minutos2 = (minutos2 < 10) ? "0" + minutos2 : minutos2;
                hora2 = (hora2 < 10) ? "0" + hora2 : hora2;
            }

            horario2 = hora2 + ":" + minutos2;

            $('#txtFecha').val(anio + "-" + mes + "-" + dia);
            $('#txtHora').val(horario);
            $('#txtHorafin').val(horario2);
            $('#id_client').val(info.event.extendedProps.id_client);
            $('#cliente_id').val(info.event.extendedProps.id_client);
            $('#resourceId').val(info.event._def.resourceIds);
            $('#id_especialist').val(info.event.extendedProps.id_especialist);
            $('#title').val(info.event.title);
            $('#txtNota').val(info.event.extendedProps.id_nota);
            $('#txtTelefono').val(info.event.extendedProps.telefono);
            $('#color').val(info.event.backgroundColor);
            $('#id_servicio').val(info.event.extendedProps.id_servicio);
            $('#id_servicio2').val(info.event.extendedProps.id_servicio2);
            $('#id_notaModal').val(info.event.extendedProps.id_nota);
            $('#id_laserModal').val(info.event.extendedProps.id_laser);
            $('#id_paqueteModal').val(info.event.extendedProps.id_paquete);

            if (info.event.extendedProps.mod_hora_fin === 'si') {
                $('#mod_hora_fin').prop('checked', true);
                $('#txtHorafin').prop('disabled', false);
            } else {
                $('#mod_hora_fin').prop('checked', false);
                $('#txtHorafin').prop('disabled', true);
            }

            $('#descripcion').val(info.event.extendedProps.descripcion);
            $('#id_status').val(info.event.extendedProps.id_status);
            $('#image').val(info.event.extendedProps.image);

            limpiarSelectCosmes();
            limpiarSelectCosmesNuevasSinSeleccionar();

            if (info.event.extendedProps.cosmes) {
                info.event.extendedProps.cosmes.forEach(function (id) {
                    $('#cosmesInput option[value="' + id + '"]').prop('selected', true);
                });
            }

            // Manejar servicios anteriores
            const previousServicesList = document.getElementById('previousServicesList');
            previousServicesList.innerHTML = ''; // Clear existing list
            const serviciosAnteriores = info.event.extendedProps.servicios_anteriores;
            // console.log(serviciosAnteriores);

            if (serviciosAnteriores && serviciosAnteriores.length > 0) {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('row'); // Agregar clase 'row' para Bootstrap

                serviciosAnteriores.forEach(service => {
                    if (service.id_client === info.event.extendedProps.id_client) {
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-4'); // Agregar clase 'col-4' para Bootstrap

                        colDiv.innerHTML = `
                            <strong>Fecha:</strong> <a href="#" style="text-decoration: underline blue;color: blue;" class="service-date" data-date="${service.start}">${new Date(service.start).toLocaleDateString()}</a><br>
                            <strong>Hora Inicio:</strong> ${new Date(service.start).toLocaleTimeString()}<br>
                            <strong>Hora Fin:</strong> ${new Date(service.end).toLocaleTimeString()}<br>
                            <strong>Cosmetóloga:</strong> ${service.cosmes.join(', ')}<br>
                            <strong>Estatus:</strong> ${service.estatus}
                        `;

                        rowDiv.appendChild(colDiv);
                    }
                });

                previousServicesList.appendChild(rowDiv);
            } else {
                previousServicesList.innerHTML = '<li>No hay servicios anteriores.</li>';
            }

                // Evento para manejar el click en las fechas de servicios anteriores
            document.getElementById('previousServicesList').addEventListener('click', function(e) {
                if (e.target.classList.contains('service-date')) {
                    e.preventDefault();

                    const date = e.target.getAttribute('data-date');

                    // Navegar a la fecha en la vista resourceTimeGridDay
                    calendar.changeView('resourceTimeGridDay', date);
                }
            });


            // Verificar el valor de id_status y ocultar/mostrar el contenedor
            $('#id_status').val(info.event.extendedProps.id_status);
            toggleContainer();

            $('#exampleModal').modal('show');
            // console.log('cosmesInput', info.event.extendedProps.cosmes)
        },

        eventContent: function (arg) {
            minutos3 = (arg.event.start.getMinutes());
            hora3 = (arg.event.start.getHours());
            minutos3 = (minutos3 < 10) ? "0" + minutos3 : minutos3;
            hora3 = (hora3 < 10) ? "0" + hora3 : hora3;
            horario = (hora3 + ":" + minutos3);
            let hor = horario;

            let imageArg = arg.event.extendedProps.image;
            let modulocapi = arg.event.getResources().map(function (resource) { return resource.id });
            let nombreServicio = arg.event.extendedProps.nombre_servicio;
            let nombreServicio2 = arg.event.extendedProps.nombre_servicio2;
            // console.log(nombreServicio);

            let arrayOfDomNodes = []

            let titleEvent = document.createElement('div')
            titleEvent.innerHTML = arg.event.title
            titleEvent.classList = "fc-event-title fc-sticky"

            let horaEvent = document.createElement('div')
            horaEvent.innerHTML = '<div style="font-size:10px;">' + hor + ' - ' + modulocapi + '<img width="13px" style="margin-left: 10px" src="' + imageArg + '" ><br>' + nombreServicio + '<br>' + nombreServicio2 + '</div>';
            horaEvent.classList = "fc-event-time"

            arrayOfDomNodes = [titleEvent, horaEvent]

            return { domNodes: arrayOfDomNodes }
        },

    });

        // Función para ocultar/mostrar el contenedor según el valor de id_status
        function toggleContainer() {
            var idStatus = $('#id_status').val();
            if (idStatus == 7) {
                $('#OcultaroContendores').hide();
                $('#OcultaroContendoresBotones').hide();
            } else {
                $('#OcultaroContendores').show();
                $('#OcultaroContendoresBotones').show();
            }
        }

            // Asegurar que el contenedor se oculte/muestre cuando se cambie el valor de id_status manualmente
            $('#id_status').on('change', function() {
                toggleContainer();
            });



    // Ensure the selects are cleared each time the modal is opened
    $('#exampleModal').on('show.bs.modal', function() {
        limpiarSelectCosmesNuevasSinSeleccionar();
    });

    // Clear the selects after the modal is hidden
    $('#exampleModal').on('hidden.bs.modal', function() {
        limpiarSelectCosmesNuevasSinSeleccionar();
    });

    $('#mod_hora_fin').change(function() {
        if ($(this).is(':checked')) {
            $('#txtHorafin').prop('disabled', false);
        } else {
            $('#txtHorafin').prop('disabled', true);
        }
    });

    calendar.setOption('locale', 'es');
    calendar.render();



    // Función para mostrar el spinner
    function showSpinner(button) {
        button.prop('disabled', true);
        button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...');
    }

    // Función para ocultar el spinner y restaurar el botón
    function hideSpinner(button, originalText) {
        button.prop('disabled', false);
        button.html(originalText);
    }

      $('#btnWhats').click(function(){
          ObjEvento= recolectarDatosGUIWhatsapp('POST');
          EnviarInformacionWhatsapp('', ObjEvento);
      });

      $('#btnVerServicios').click(function() {
        var clienteId = $('#cliente_id').val();
            var url = 'https://paradisus.mx/buscador?id_client=' + clienteId + '&phone=';
            window.open(url, '_blank');
      });

      $('#btnNota').click(function() {
            var ObjEvento = {
                nota: $('#id_notaModal').val(),
                laser: $('#id_laserModal').val(),
                paquete: $('#id_paqueteModal').val()
            };
            EnviarInformacionnota(ObjEvento);
      });

      $('#btnAgregar').click(function() {
        var button = $(this);
        showSpinner(button);

        ObjEvento = recolectarDatosGUI('POST');
        EnviarInformacion('', ObjEvento, function() {
            hideSpinner(button, '<i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar');
        });
      });

      $('#btnBorrar').click(function(){
        var button = $(this);
        showSpinner(button);

        ObjEvento = editarDatosGUI('PATCH');
        EnviarInformacion('/destroy/'+$('#txtID').val(), ObjEvento, function() {
            hideSpinner(button, '<i class="fa fa-trash" aria-hidden="true"></i> Eliminar');
        });

      });

      $('#btnModificar').click(function() {
        var button = $(this);
        showSpinner(button);

        ObjEvento = editarDatosGUI('PATCH');
        EnviarInformacion('/update/' + $('#txtID').val(), ObjEvento, function() {
            hideSpinner(button, '<i class="fa fa-retweet" aria-hidden="true"></i> Modificar');
        });
    });

      function recolectarDatosGUIWhatsapp(method){
          nuevoEventowhatasapp={
              telefono:$('#txtTelefono').val(),
              fecha:$('#txtFecha').val(),
              hora:$('#txtHora').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }
          return (nuevoEventowhatasapp);
      }

      function recolectarDatosGUInota(method){
          nuevoEventowhatasapp={
              nota:$('#txtNota').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }
          return (nuevoEventowhatasapp);
      }

      function recolectarDatosGUI(method){
          colorAlert =("#2ECC71");
          imageDefault = ("{{asset('img/icon/comprobado.png') }}");

          nuevoEvento={
              id:$('#txtID').val(),
              name_full:$('#name_full').val(),
              last_name_full:$('#last_name_full').val(),
              phone_full:$('#phone_full').val(),
              title:$('#title').val(),
              id_client:$('#id_client').val(),
              resourceId:$('#resourceId').val(),
              id_especialist:$('#id_especialist').val(),
              descripcion:$('#descripcion').val(),
              id_status:$('#id_status').val(),
              image:$('#image').val()+imageDefault,
              color:$('#color').val(),
              id_servicio:$('#id_servicio').val(),
              id_servicio2:$('#id_servicio2').val(),
              id_notaModal:$('#id_notaModal').val(),
              id_laserModal:$('#id_laserModal').val(),
              id_paqueteModal:$('#id_paqueteModal').val(),
              cliente_id:$('#cliente_id').val(),
              cosmesInput:$('#cosmesInput').val(),
              cosmesnueva:$('#cosmesnueva').val(),
              start:$('#txtFecha').val()+" "+$('#txtHora').val(),
              end:$('#txtFecha').val()+" "+$('#txtHorafin').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }

          if ($('#mod_hora_fin').is(':checked')) {
            nuevoEvento.mod_hora_fin = 'si';
        }
        //   console.log('Fecha nuevo',nuevoEvento)
          return (nuevoEvento);
      }

      function editarDatosGUI(method){
          nuevoEvento={
              id:$('#txtID').val(),
              title:$('#title').val(),
              id_client:$('#id_client').val(),
              resourceId:$('#resourceId').val(),
              id_especialist:$('#id_especialist').val(),
              descripcion:$('#descripcion').val(),
              id_status:$('#id_status').val(),
              image:$('#image').val(),
              color:$('#color').val(),
              id_servicio:$('#id_servicio').val(),
              id_servicio2:$('#id_servicio2').val(),
              id_notaModal:$('#id_notaModal').val(),
              id_laserModal:$('#id_laserModal').val(),
              id_paqueteModal:$('#id_paqueteModal').val(),
              cliente_id:$('#cliente_id').val(),
              cosmesInput:$('#cosmesInput').val(),
              cosmesnueva:$('#cosmesnueva').val(),
              start:$('#txtFecha').val()+" "+$('#txtHora').val(),
              end:$('#txtFecha').val()+" "+$('#txtHorafin').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }

          if ($('#mod_hora_fin').is(':checked')) {
            nuevoEvento.mod_hora_fin = 'si';
            }
            //   console.log('Fecha nuevo 1',cosmesInput)
            return (nuevoEvento);
      }

      function EnviarInformacionWhatsapp(accion,ObjEvento){
          // console.log(ObjEvento['telefono']);
          var pagina='https://api.whatsapp.com/send?phone=+52'+ObjEvento['telefono']+'&text=Buen%20día%20✨🦷%20Le%20escribimos%20de%20PARADISUS%20para%20confirmar%20la%20cita%20'+ObjEvento['fecha']+'%20%20a%20las%20'+ObjEvento['hora']+'%20Le%20agradecemos%20nos%20confirme%20su%20asistencia%20a%20más%20tardar%20hoy%20antes%20de%202:00%20pm%20de%20lo%20contrario%20se%20cederá%20el%20lugar%20a%20otro%20cliente%20que%20requiera.%20Quedamos%20al%20pendiente%20de%20su%20pronta%20respuesta.%20Gracias!';
          window.open(pagina, '_blank');
      }

      function EnviarInformacionnota(ObjEvento) {
            var idNota = ObjEvento.nota;
            var idLaser = ObjEvento.laser;
            var idPaquete = ObjEvento.paquete;

            var ruta = '';
            if (idNota) {
                ruta = 'https://paradisus.mx/notas/servicios/edit/' + idNota;
            } else if (idLaser) {
                ruta = 'https://paradisus.mx/notas/laser/edit/' + idLaser;
            } else if (idPaquete) {
                ruta = 'https://paradisus.mx/paquetes/servicios/edit/moldeante/' + idPaquete;
            } else {
                alert('No hay valores disponibles para redirigir.');
                return;
            }

            window.open(ruta, '_blank');
      }

      function EnviarInformacion(accion, ObjEvento, callback) {
        $.ajax({
            type: "POST",
            url: "{{route('calendar.store_calendar')}}" + accion,
            data: ObjEvento,
            success: function(msg) {
                $('#exampleModal').modal('toggle');
                calendar.refetchEvents();
                if (callback) callback();  // Llama a la callback si existe
            },
            error: function() {
                alert("hay un error");
                if (callback) callback();  // Llama a la callback incluso en caso de error
            }
        });
      }

      $('#guardarCita').on('click', function(e,callback) {
            e.preventDefault();

            var formData = $('#updateForm').serialize();

            $.ajax({
                type: 'POST',
                url: "{{ route('update_horarios') }}", // Actualiza con la ruta correcta
                data: formData,
                success: function(response) {
                    // Actualiza los eventos en el calendario
                    calendar.refetchEvents();
                    if (callback) callback();  // Llama a la callback si existe
                    $('#HorariosModal').modal('hide');
                    // Muestra un mensaje de éxito si es necesario
                    alert('Cita guardada exitosamente');
                    location.reload();

                },
                error: function(xhr, status, error) {
                    // Maneja el error si es necesario
                    alert('Ocurrió un error al guardar la cita');
                    if (callback) callback();  // Llama a la callback incluso en caso de error

                }
            });
        });

        $('#submit_comida').on('click', function(e, callback) {
            e.preventDefault();

            var $button = $(this);
            var $spinner = $('#spinner');
            var formData = $('#comidas_form').serialize();

            // Mostrar el spinner y deshabilitar el botón
            $spinner.show();
            $button.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: "{{ route('calendar.store_comidas') }}",
                data: formData,
                success: function(response) {
                    // Actualiza los eventos en el calendario
                    calendar.refetchEvents();
                    if (callback) callback();  // Llama a la callback si existe

                    // Reinicia el formulario
                    $('#comidas_form')[0].reset();
                    $('#cosmesInputComida').val([]).trigger('change'); // Limpiar el select múltiple si estás usando Select2 u otro plugin

                    // Cierra el modal
                    $('#comidaModal').modal('hide');

                    // Muestra un mensaje de éxito si es necesario
                    alert('Comida guardada exitosamente');
                },
                error: function(xhr, status, error) {
                    // Maneja el error si es necesario
                    alert('Ocurrió un error al guardar la comida');
                    if (callback) callback();  // Llama a la callback incluso en caso de error
                },
                complete: function() {
                    // Ocultar el spinner y habilitar el botón después de completar la solicitud
                    $spinner.hide();
                    $button.prop('disabled', false);
                }
            });
        });


      function limpiarFormulario(){
            $('#txtID').val("");
            $('#title').val("");
            $('#id_client').val("");
            $('#resourceId').val("");
            $('#id_especialist').val("");
            $('#txtFecha').val("");
            $('#txtNota').val("");
            $('#txtTelefono').val("");
            $('#txtHora').val("");
            $('#color').val("");
            $('#id_servicio').val("");
            $('#id_servicio2').val("");
            $('#id_notaModal').val("");
            $('#id_laserModal').val("");
            $('#id_paqueteModal').val("");
            $('#cliente_id').val("");
            $('#descripcion').val("");
            $('#id_status').val("");
            $('#image').val("");
            $('#mod_hora_fin').prop('checked', false);
            $('#txtHorafin').prop('disabled', true);
            limpiarSelectCosmes();
            limpiarSelectCosmesNuevasSinSeleccionar();
        }

        function limpiarSelectCosmes() {
            $('#cosmesInput option').prop('selected', false);
        }

        function limpiarSelectCosmesNuevasSinSeleccionar() {
            $('#cosmesnueva option:selected').prop('selected', false);
            $('#cosmesnueva').val([]).trigger('change');
        }

    });

</script>

<script>
$(document).ready(function() {
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
                            <div class="card">
                                <div class="card-header" id="heading${collapseId}">
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
        // const fechaSeleccionada = $(this).data('fecha');
        // const horaSeleccionada = $(this).data('hora');
        const servicioIdSeleccionado = $(this).data('servicio');
        const numPersonasSeleccionado = $(this).data('numPersonas');
        const cosmesSeleccionados = $(this).data('cosmes');
        // console.log(cosmesSeleccionados);

        // $('#fechaSeleccionadaInput').val(fechaSeleccionada);
        // $('#horaSeleccionadaInput').val(horaSeleccionada);
        $('#servicioIdInput').val(servicioIdSeleccionado);
        $('#numPersonasInput').val(numPersonasSeleccionado);

        // Preselecciona los cosmes en el multiselect
        $('#cosme_disp').val(cosmesSeleccionados).trigger('change');

        // $('#formularioFechaSeleccionada').show();
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
});
</script>

<script>
    $(document).ready(function() {

        function toggleInputs() {
            if ($('#nota').is(':checked')) {
                $('#nota-inputs').show();
                $('#gratis-inputs').hide();
            } else if ($('#gratis').is(':checked')) {
                $('#nota-inputs').hide();
                $('#gratis-inputs').show();
            }
        }

        // Ejecutar al cargar la página para establecer el estado inicial
        toggleInputs();

        // Ejecutar cada vez que cambie la selección del radio button
        $('input[name="option_nota"]').change(function() {
            toggleInputs();
        });

        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = $(state.element).data('img');
            var $state = $(
                '<span><img src="' + baseUrl + '" class="img-flag" style="width: 20px; margin-right: 10px;" /> ' + state.text + '</span>'
            );
            return $state;
        };

        $('#icono').select2({
            templateResult: formatState,
            templateSelection: formatState,
            width: '100%'
        });

        $('.icono-select').select2({
            templateResult: formatState,
            templateSelection: formatState,
            width: '100%'
        });
    });
</script>
