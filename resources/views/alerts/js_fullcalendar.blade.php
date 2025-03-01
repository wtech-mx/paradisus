<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.user_disponibilidad').select2();
        $('.cliente_disponibilidad').select2();
        $('.multi_cosme_disponibilidad').select2();
        $('.disponibilidad_2').select2();

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

            $('.cosmesInput_multipleComida').select2({
                width: '100%',
                dropdownParent: $('#comidaModal')
            });

            $('.id_servicio_full').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            $('.id_servicio_full2').select2({
                width: '100%',
                dropdownParent: $('#exampleModal')
            });

            // $('.cosmesInput_multiple').select2({
            //     width: '100%',
            //     dropdownParent: $('#exampleModal')
            // });
            // $('.cosmesInput_multiple_nueva').select2({
            //     width: '100%',
            //     dropdownParent: $('#exampleModal')
            // });

            // $('.id_servicio_full').select2();
            // $('.id_servicio_full2').select2();
            $('.cosmesInput_multiple').select2();
            $('.cosmesInput_multiple_nueva').select2();

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

        $(document).on('shown.bs.modal', function(e) {
            // Obtén el modal que se ha mostrado
            var modal = $(e.target);

            // Encuentra los selects dentro de este modal y aplica Select2
            modal.find('.modal_cita_serv').select2({
                width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
                dropdownParent: modal // Esto asegura que el dropdown se renderice dentro del modal correcto
            });

            modal.find('.modal_cita_cosme').select2({
                width: '100%', // Asegúrate de que el select2 ocupe el 100% del ancho del contenedor
                dropdownParent: modal // Esto asegura que el dropdown se renderice dentro del modal correcto
            });
        });
    });
</script>

<script>

document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var spinner = document.getElementById('loading-spinner');

        var currentUrl = window.location.href; // Obtener la URL actual
        var eventsUrl;
        var originalResources = {!! json_encode($modulos) !!};
        // Determinar la URL de eventos según la URL actual
        if (currentUrl.includes("/dashboard/anterior")) {
            eventsUrl = "{{ route('calendar.show_calendar_anterior') }}";
        } else {
            eventsUrl = "{{ route('calendar.show_calendar') }}";
        }

       // Mostrar el spinner antes de iniciar la carga
       spinner.style.display = 'block';

        var calendar = new FullCalendar.Calendar(calendarEl, {
            navLinks: true,
            height: 'auto',
            // timeZone: 'America/Mexico_City',
            timeZone: 'America/Mexico_City',

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
            lazyFetching: false,
            headerToolbar: {
                left: 'today prev,next',
                center: 'title',
                right: 'resourceTimeGridDay,dayGridMonth'
            },
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            },
            views: {
                resourceTimeGridDay: {
                titleFormat: {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                },
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    hour12: true // Esto muestra el formato de 12 horas con AM/PM
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

        datesSet: function(info) {
            var dayNames = [ "lunes", "martes", "miercoles", "jueves", "viernes", "sabado","domingo",];
            var currentDay = dayNames[new Date(info.start).getDay()]; // Obtener el día de la semana actual

            // console.log(dayNames);
            // console.log(currentDay);

            if (info.view.type === 'resourceTimeGridDay') {
                var filteredResources = originalResources.filter(function(resource) {
                    return resource.horario[currentDay] === 1; // Filtrar los recursos según el día de la semana
                });
                calendar.setOption('resources', filteredResources);
            } else {
                calendar.setOption('resources', originalResources);
            }
        },

        events: function(fetchInfo, successCallback, failureCallback) {
    // Obtener las fechas de inicio y fin
    var startDate = new Date(fetchInfo.start);
    var endDate = new Date(fetchInfo.end);

    // Calcular la diferencia de días entre las dos fechas
    var diffInTime = endDate.getTime() - startDate.getTime();
    var diffInDays = diffInTime / (1000 * 3600 * 24); // Convertir el tiempo a días

    // Si la diferencia de días es mayor o igual a 27, estamos en un mes completo
    if (diffInDays >= 27) {
        // Corregir las fechas para obtener solo los días del mes actual
        var firstDayOfMonth = new Date(startDate.getFullYear(), startDate.getMonth() + 1, 1);
        var lastDayOfMonth = new Date(startDate.getFullYear(), startDate.getMonth() + 2, 0);

        // Ajustar las fechas de inicio y fin al primer y último día del mes seleccionado
        startDate = firstDayOfMonth;
        endDate = lastDayOfMonth;

        // Convertir las fechas al formato YYYY-MM-DD
        var correctedStart = startDate.getFullYear() + '-' +
        String(startDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(startDate.getDate()).padStart(2, '0') + 'T00:00:00-06:00'; // Primer día del mes

        var correctedEnd = endDate.getFullYear() + '-' +
        String(endDate.getMonth() + 1).padStart(2, '0') + '-' +
        String(endDate.getDate()).padStart(2, '0') + 'T23:59:59-06:00'; // Último día del mes

        // Mostrar las fechas corregidas en la consola para verificar
        console.log('Cargando eventos para:', correctedStart, ' hasta ', correctedEnd);

        // Hacer la petición con las fechas corregidas
        fetch(eventsUrl + '?start=' + correctedStart + '&end=' + correctedEnd)
        .then(response => response.json())
        .then(data => {
            successCallback(data); // Devolver los eventos al calendario
        })
        .catch(error => {
            console.error('Error al cargar eventos:', error);
            failureCallback(error);
        });

    }else{

        // Obtener las fechas de inicio y fin
        var startDate = new Date(fetchInfo.start);
        var endDate = new Date(fetchInfo.end);

        // Convertir las fechas al formato ISO sin cambiar la zona horaria
        var correctedStart = startDate.getFullYear() + '-' +
            String(startDate.getMonth() + 1).padStart(2, '0') + '-' +
            String(startDate.getDate()).padStart(2, '0') + 'T' +
            String(startDate.getHours()).padStart(2, '0') + ':' +
            String(startDate.getMinutes()).padStart(2, '0') + ':' +
            String(startDate.getSeconds()).padStart(2, '0') + '-06:00'; // Zona horaria local

        var correctedEnd = endDate.getFullYear() + '-' +
            String(endDate.getMonth() + 1).padStart(2, '0') + '-' +
            String(endDate.getDate()).padStart(2, '0') + 'T' +
            String(endDate.getHours()).padStart(2, '0') + ':' +
            String(endDate.getMinutes()).padStart(2, '0') + ':' +
            String(endDate.getSeconds()).padStart(2, '0') + '-06:00'; // Zona horaria local

        // console.log('Cargando eventos para:', correctedStart, ' hasta ', correctedEnd);

        // Hacer la petición con las fechas corregidas
        fetch(eventsUrl + '?start=' + correctedStart + '&end=' + correctedEnd)
            .then(response => response.json())
            .then(data => {
                successCallback(data); // Devolver los eventos al calendario
            })
            .catch(error => {
                console.error('Error al cargar eventos:', error);
                failureCallback(error);
            });
    }

},
    viewDidMount: function(info) {
        calendar.refetchEvents(); // Forzar la actualización de eventos al cambiar de vista
    },


        // Mostrar el spinner cuando se cargan nuevos eventos
        loading: function(isLoading) {
            if (isLoading) {
                spinner.style.display = 'block'; // Mostrar el spinner
            } else {
                spinner.style.display = 'none'; // Ocultar el spinner
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

            // Obtener la hora sin hacer conversiones de zona horaria
            const start = moment(info.event.start).utc().format('HH:mm');
            const end = moment(info.event.end).utc().format('HH:mm');

            $('#txtHora').val(start);
            $('#txtHorafin').val(end);

            $('#txtFecha').val(anio + "-" + mes + "-" + dia);

            $('#id_client').val(info.event.extendedProps.id_client);
            $('#cliente_id').val(info.event.extendedProps.id_client);
            $('#resourceId').val(info.event._def.resourceIds);
            $('#id_especialist').val(info.event.extendedProps.id_especialist);
            $('#title').val(info.event.title);

            $('#name_full').val(info.event.extendedProps.name_full);
            $('#last_name_full').val(info.event.extendedProps.last_name_full);
            $('#phone_full').val(info.event.extendedProps.phone_full);

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

            const cosmetologas = {
                6: 'Teresa Gutiérrez Carrizales',
                8: 'Perla Jurado',
                5: 'Minu Reyes Vera',
                29: 'Melisa Andrade',
                9: 'María Fernanda Valdez Cordero',
                37: 'Maria Fernanda Delgado Gonzalez',
                32: 'Lesli Paola Patiño Audelo',
                43: 'Leilani Natalie Mendoza Escobedo',
                16: 'Karina Hurtado',
                39: 'Jennifer Sada Barra',
                35: 'Janine Ortega',
                38: 'Jacuzzi',
                4: 'Gioanna Jazmin Jimenez',
                3: 'Gabriela Pérez Preciat',
                25: 'Carmen Osorio',
                40: 'Andrea Estefanía Castañeda Oaxaca',
                31: 'Andrea Arizmendi Sánchez',
                23: 'America Acosta Pérez',
                26: 'Alexis Hurtado',
                34: 'Alejandra Burgos',
                36: 'Aglae Morales Tuyub',
                41: 'Abril Michelle Acosta Pérez',
                22: 'Abril Acosta Pérez'
            };

            // Manejar servicios anteriores
            const previousServicesList = document.getElementById('previousServicesList');
            previousServicesList.innerHTML = ''; // Limpiar lista existente
            const serviciosAnteriores = info.event.extendedProps.servicios_anteriores;

            if (serviciosAnteriores && serviciosAnteriores.length > 0) {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('row'); // Agregar clase 'row' para Bootstrap
                rowDiv.style.display = 'flex';
                rowDiv.style.flexWrap = 'wrap';
                rowDiv.style.alignItems = 'stretch';

                serviciosAnteriores.forEach(service => {
                    if (service.id_client === info.event.extendedProps.id_client) {
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-4'); // Agregar clase 'col-4' para Bootstrap
                        colDiv.style.padding = '0px';
                        colDiv.style.display = 'flex';
                        colDiv.style.flexDirection = 'column';

                        const innerDiv = document.createElement('div');
                        innerDiv.style.borderRadius = '6px';
                        innerDiv.style.background = '#F1F1F1';
                        innerDiv.style.padding = '3px';
                        innerDiv.style.margin = '5px';
                        innerDiv.style.flex = '1';

                        // Mapeamos los IDs a los nombres de las cosmetólogas
                        const cosmetologaNombres = service.cosmes.map(id => cosmetologas[id] || 'Desconocida');

                        innerDiv.innerHTML = `
                            <strong>Fecha:</strong> <a href="#" style="text-decoration: underline blue;color: blue;" class="service-date" data-date="${service.start}">${new Date(service.start).toLocaleDateString()}</a><br>
                            <strong>Hora:</strong><br> ${new Date(service.start).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })} a ${new Date(service.end).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })}<br>
                            <strong>Cosmetóloga:</strong> ${cosmetologaNombres.join(', ')}<br>
                            <strong>Estatus:</strong> ${service.estatus}<br>
                            <strong>Servicio:</strong> ${service.servicios_id ? service.servicios_id.nombre : 'No asignado'}
                        `;

                        colDiv.appendChild(innerDiv);
                        rowDiv.appendChild(colDiv);
                    }
                });

                previousServicesList.appendChild(rowDiv);


                // Agregar manejadores de eventos a los enlaces de fecha
                const serviceDates = document.querySelectorAll('.service-date');
                serviceDates.forEach(dateLink => {
                    dateLink.addEventListener('click', function (event) {
                        event.preventDefault(); // Prevenir la acción predeterminada de los enlaces
                        const selectedDate = new Date(this.getAttribute('data-date'));

                        // Mover el calendario a la fecha seleccionada
                        calendar.gotoDate(selectedDate);

                        // Cerrar el modal automáticamente
                        const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide(); // Cerrar el modal
                        }

                    });
                });

            } else {
                previousServicesList.innerHTML = '<li>No hay servicios anteriores.</li>';
            }

            // Manejar servicios anteriores
            const previousServicesProxList = document.getElementById('previousServicesProxList');
            previousServicesProxList.innerHTML = ''; // Limpiar lista existente
            const serviciosProximos = info.event.extendedProps.servicios_proximos;

            if (serviciosProximos && serviciosProximos.length > 0) {
                const rowDiv = document.createElement('div');
                rowDiv.classList.add('row'); // Agregar clase 'row' para Bootstrap
                rowDiv.style.display = 'flex';
                rowDiv.style.flexWrap = 'wrap';
                rowDiv.style.alignItems = 'stretch';

                serviciosProximos.forEach(service => {
                    if (service.id_client === info.event.extendedProps.id_client) {
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-4'); // Agregar clase 'col-4' para Bootstrap
                        colDiv.style.padding = '0px';
                        colDiv.style.display = 'flex';
                        colDiv.style.flexDirection = 'column';

                        const innerDiv = document.createElement('div');
                        innerDiv.style.borderRadius = '6px';
                        innerDiv.style.background = '#F1F1F1';
                        innerDiv.style.padding = '3px';
                        innerDiv.style.margin = '5px';
                        innerDiv.style.flex = '1';

                        // Mapeamos los IDs a los nombres de las cosmetólogas
                        const cosmetologaNombres = service.cosmes.map(id => cosmetologas[id] || 'Desconocida');

                        innerDiv.innerHTML = `
                            <strong>Fecha:</strong> <a href="#" style="text-decoration: underline blue;color: blue;" class="service-date" data-date="${service.start}">${new Date(service.start).toLocaleDateString()}</a><br>
                            <strong>Hora:</strong><br> ${new Date(service.start).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })} a ${new Date(service.end).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true })}<br>
                            <strong>Cosmetóloga:</strong> ${cosmetologaNombres.join(', ')}<br>
                            <strong>Estatus:</strong> ${service.estatus}<br>
                            <strong>Servicio:</strong> ${service.servicios_id ? service.servicios_id.nombre : 'No asignado'}
                        `;

                        colDiv.appendChild(innerDiv);
                        rowDiv.appendChild(colDiv);
                    }
                });

                previousServicesProxList.appendChild(rowDiv);

                // Agregar manejadores de eventos a los enlaces de fecha
                const serviceDates = document.querySelectorAll('.service-date');
                serviceDates.forEach(dateLink => {
                    dateLink.addEventListener('click', function (event) {
                        event.preventDefault(); // Prevenir la acción predeterminada de los enlaces
                        const selectedDate = new Date(this.getAttribute('data-date'));

                        // Mover el calendario a la fecha seleccionada
                        calendar.gotoDate(selectedDate);

                        // Cerrar el modal automáticamente
                        const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                        if (modal) {
                            modal.hide(); // Cerrar el modal
                        }

                    });
                });

            } else {
                previousServicesProxList.innerHTML = '<li>No hay servicios anteriores.</li>';
            }

            // Verificar el valor de id_status y ocultar/mostrar el contenedor
            $('#id_status').val(info.event.extendedProps.id_status);
            toggleContainer();

            $('#exampleModal').modal('show');
            // console.log('cosmesInput', info.event.extendedProps.cosmes)
        },

        eventContent: function (arg) {

            let duracion = arg.event.extendedProps.duracion || 0; // Duración del primer servicio en minutos
            let duracion2 = arg.event.extendedProps.duracion2 || 0; // Duración del segundo servicio en minutos


            let imageArg = arg.event.extendedProps.image;

            let nombreServicio = arg.event.extendedProps.nombre_servicio;
            let nombreServicio2 = arg.event.extendedProps.nombre_servicio2;

            let arrayOfDomNodes = [];

            // Calcula la diferencia en minutos entre formattedTimeInicio y formattedTime
            let startTime = new Date(arg.event.start);
            let endTime = new Date(arg.event.end);
            let timeDifference = (endTime - startTime) / 60000; // Diferencia en minutos

            // Define los valores predeterminados para fontSize y lineHeight
            let fontSize = '9.5px';
            let lineHeight = '11.2px';

            let titulo = arg.event.title;
            let nuevoCliente =  arg.event.extendedProps.nuevo_cliente;

            if(nuevoCliente === '1'){
                NuevoClienteIcon = 'https://paradisus.mx/assets/icons/estrella.png';
            }else{
                NuevoClienteIcon = '';
            }

            let horaEvent = document.createElement('div');

            const start = moment(arg.event.start).utc().format('HH:mm');
            const end = moment(arg.event.end).utc().format('HH:mm');


            // Si la diferencia es de 30 minutos, usa la estructura compacta
            if (timeDifference === 30) {
                horaEvent.innerHTML = `
                    <p style="font-size:9px; line-height:6px ; margin: 0; padding: 0;">
                        ${titulo} ${start} - ${end}
                        <img width="9px" style="margin-left: 10px" src="${imageArg}">
                        <br>${nombreServicio} (${duracion} min)
                        ${nombreServicio2 && duracion2 ? `<br>${nombreServicio2} (${duracion2} min)` : ''}
                        <br>
                        <img width="30px" style="position: absolute;top: -20px;right: -15px;" src="${NuevoClienteIcon}">
                    </p>`;
            } else { // Si la diferencia es mayor a 30 minutos, usa la estructura más detallada
                horaEvent.innerHTML = `
                    <p style="font-size:${fontSize}; line-height: ${lineHeight}; margin: 0; padding: 0;">
                        ${titulo}
                        <br>
                        ${start} - ${end} -
                        <img width="9px" style="margin-left: 10px" src="${imageArg}">
                        <br>${nombreServicio} (${duracion} min)
                        ${nombreServicio2 && duracion2 ? `<br>${nombreServicio2} (${duracion2} min)` : ''}
                        <br>
                        <img width="30px" style="position: absolute;top: -20px;right: -15px;" src="${NuevoClienteIcon}">
                    </p>`;
            }

            horaEvent.classList = "fc-event-time";

            arrayOfDomNodes = [horaEvent];
            return { domNodes: arrayOfDomNodes };


        },

    });

        calendar.setOption('locale', 'es');
        calendar.render();

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

            var ObjEvento = editarDatosGUI('PATCH');
                EnviarInformacion('/update/' + $('#txtID').val(), ObjEvento, function(response) {
                    hideSpinner(button, '<i class="fa fa-retweet" aria-hidden="true"></i> Modificar');
                    // console.log(response);
                    // Aquí puedes manejar cualquier acción adicional en función de la respuesta
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
              name_full:$('#name_full').val(),
              last_name_full:$('#last_name_full').val(),
              phone_full:$('#phone_full').val(),
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
            success: function(response) {
                $('#exampleModal').modal('toggle');
                calendar.refetchEvents();

                // Asegúrate de que la respuesta es un objeto JSON
                if (typeof response === 'object' && response !== null) {
                    if (response.success) {

                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message || 'Operación realizada con éxito.',
                        });

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Ocurrió un error.',
                        });

                    }
                }

                if (callback) callback(response);  // Llama a la callback si existe
            },

            error: function(xhr) {
                alert("Hay un error en la solicitud.");

                // Si prefieres usar SweetAlert:
                /*
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error en la solicitud.',
                });
                */

                if (callback) callback(xhr);  // Llama a la callback incluso en caso de error
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

       $('#btnBuscar').on('click', function() {
            var titulo = $('#title_search').val();
            var telefono = $('#telefono_search').val();

            $.ajax({
                url: '{{ route("alertas.buscar") }}',
                type: 'GET',
                data: {
                    titulo: titulo,
                    telefono: telefono,
                },
                success: function(response) {
                $('#resultadosContainer').html(response);

                // Inicializa los modales después de cargar la vista diferida
                $('#resultadosContainer').find('.modal-trigger').on('click', function() {
                    var targetModal = $(this).data('target');
                    $(targetModal).modal('show');
                });

                // Añadir el evento click a las fechas después de cargar la tabla
                $('#resultadosContainer').find('.fecha-click').on('click', function() {
                    var fechaSeleccionada = $(this).data('fecha'); // Obtenemos la fecha en formato 'YYYY-MM-DD'

                    console.log(fechaSeleccionada);
                    // Mover el calendario a la fecha seleccionada
                    calendar.gotoDate(fechaSeleccionada);

                });

                // const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                // searchable: true,
                // fixedHeight: false
                // });
            },
                error: function(xhr) {
                    // console.log(xhr.responseText);
                }
            });
       });

       $('#btnLimpiar').on('click', function() {
            $('#resultadosContainer').html('');  // Limpiar el contenido del contenedor de resultados
            $('#title_search').val('');
            $('#telefono_search').val('');
       });

       $(document).on('submit', '.approveForm', function(e) {
            e.preventDefault();

            var form = $(this);
            var formData = form.serialize();

            $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    success: function(response) {
                        // console.log(response);
                        // Mostrar alerta de guardado exitoso
                        alert('Aprobado correctamente.');

                        // Cerrar el modal después de guardar
                        form.closest('.modal').modal('hide');
                        calendar.refetchEvents();

                        // Opcional: recargar la tabla o los datos si es necesario
                        $('#btnBuscar').click(); // Esto recarga la tabla después de la aprobación
                    },
                    error: function(xhr) {
                        // console.log(xhr.responseText);
                    }
            });

       });


      function limpiarFormulario(){
            $('#txtID').val("");
            $('#name_full').val(""),
            $('#last_name_full').val(""),
            $('#phone_full').val(""),
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

      $(document).on('click', '.btn-submit-cita', function(e) {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });
            e.preventDefault();

            var alertaId = $(this).data('alerta-id');
            // console.log('alertaId', alertaId);
            var form = $('#submit_prox_cita_' + alertaId);
            // var formData = form.serialize();
            // console.log('formData', formData); // Debugging
            // console.log(form.length);

            // Asegúrate de que formData no esté vacío
            if (formData === '') {
                console.error('formData is empty');
                return;
            }

            var $button = $(this);
            var $spinner = $button.find('#spinner');

            // Mostrar el spinner y deshabilitar el botón
            $spinner.show();
            $button.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: "{{ route('servicio.store_prox_cita') }}",
                data: formData,
                success: function(response) {
                    // Actualiza los eventos en el calendario
                    calendar.refetchEvents();

                    // Reinicia el formulario
                    form[0].reset();
                    form.find('.modal_cita_serv').val([]).trigger('change'); // Limpiar el select de servicio si usas Select2
                    form.find('.modal_cita_cosme').val([]).trigger('change'); // Limpiar el select múltiple si usas Select2

                    // Cierra el modal
                    $('#modalCita' + alertaId).modal('hide');

                    // Muestra un mensaje de éxito
                    alert('Cita agendada exitosamente');
                },
                error: function(xhr, status, error) {
                    // Maneja el error si es necesario
                    alert('Ocurrió un error al guardar la cita');
                },
                complete: function() {
                    // Ocultar el spinner y habilitar el botón después de completar la solicitud
                    $spinner.hide();
                    $button.prop('disabled', false);
                }
            });

      });

</script>

