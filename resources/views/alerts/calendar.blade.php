@extends('layouts.app')

@section('title')
     Calendario
@endsection



@section('css')

    <!-- Datatable -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
    <link   href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.1/index.global.min.js'></script>


<style>
.fc-v-event .fc-event-title {
    font-size: 7.6px;
}
</style>

@endsection

@section('content')
    <div class="calendar" data-toggle="calendar" id="calendar"></div>
    @include('alerts.modal')

@endsection

@section('select2')
<script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Incluir Moment.js desde CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Incluir el archivo de idioma de Moment.js para español -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>
        @php
        $Y = date('Y') ;
        $M = date('m');
        $D = date('d') ;
        $Fecha = $Y."-".$M."-".$D;

       @endphp

<script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.user_disponibilidad').select2();
        $('.cliente_disponibilidad').select2();
        $('.multi_cosme_disponibilidad').select2();
        $('.servicios_disponibilidad').select2();

        $('.user_manual').select2();
        $('.cliente_manual').select2();
        $('.multi_cosme_manual').select2();
        $('.servicios_manual').select2();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {

          height: 'auto',
          timeZone: 'local',
          {{--now: '{{$Fecha}}',--}}
          initialDate: '{{$Fecha}}',
          initialView: 'timeGridWeek',
          editable: true,
          dayMaxEvents: 5,
          aspectRatio: 1.8,
          themeSystem: 'bootstrap',
          scrollTime:  "09:00:00",
        //   slotMinTime: "08:00:00",
        //   slotMaxTime: "22:00:00",
        slotMinTime: "{{ date('H:i:s', strtotime($configuracion->horario_inicio)) }} }}",
          slotMaxTime: "{{ date('H:i:s', strtotime($configuracion->horario_fin)) }} }}",
        //   hiddenDays: [ 0 ],
          schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',

        headerToolbar: {
          left: 'today prev,next',
          center: 'title',
          // right: 'dayGridDay,timeGridWeek,dayGridMonth' sirve para la vidsata por di
          right: 'resourceTimeGridDay,timeGridWeek,dayGridMonth,list'
        },

        // resources: [
        //       { id: "A", title: "Modulo A" },
        //       { id: "B", title: "Modulo B" },
        //   ],

        resources: {!! json_encode($modulos) !!},


          events:"{{ route('calendar.show_calendar') }}",

        // ======================= M O D A L  P A R A  N U E V A  C I T A =======================
        dateClick:function (info) {

            limpiarFormulario();
            $("#btnAgregar").prop("disabled",false);
            $("#btnModificar").prop("disabled",true);
            $("#btnBorrar").prop("disabled",true);

              if (info.allDay) {
                  $('#txtFecha').val(info.dateStr);
              } else {
                  let fechaHora = info.dateStr.split("T");
                  let unahora = fechaHora[1].substring(0, 2);
                  let final = Number(unahora) + 1;
                  $('#txtFecha').val(fechaHora[0]);
                  $('#txtHorafin').val(fechaHora[1].substring(0, 5));
                  $('#txtHora').val(fechaHora[1].substring(0, 5));
                  console.log('hora', final)
              }
            $('#exampleModal').modal('toggle');
          },
        // ======================= E N D  M O D A L  P A R A  N U E V A  C I T A =======================

        eventClick:function (info) {

            $("#btnAgregar").prop("disabled",true);
            $("#btnModificar").prop("disabled",false);
            $("#btnBorrar").prop("disabled",false);
            $('#txtID').val(info.event.id);

              mes = (info.event.start.getMonth()+1);
              dia = (info.event.start.getDate());
              anio = (info.event.start.getFullYear());

              mes = (mes<10)?"0"+mes:mes;
              dia = (dia<10)?"0"+dia:dia;

              minutos=(info.event.start.getMinutes());
              hora=(info.event.start.getHours());

              minutos = (minutos<10)?"0"+minutos:minutos;
              hora = (hora<10)?"0"+hora:hora;

              horario = (hora+":"+minutos);

              // ---------a

            minutos2 = (info.event.end && info.event.end.getMinutes()) || 0;
            console.log(minutos2);

            hora2 = (info.event.end && info.event.end.getHours()) || 0;

            if (info.event.end) {
            minutos2 = (minutos2 < 10) ? "0" + minutos2 : minutos2;
            hora2 = (hora2 < 10) ? "0" + hora2 : hora2;
            }

            horario2 = hora2 + ":" + minutos2;


            $('#txtFecha').val(anio+"-"+mes+"-"+dia);
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
            $('#id_notaModal').val(info.event.extendedProps.id_nota);
            $('#id_laserModal').val(info.event.extendedProps.id_laser);
            $('#id_paqueteModal').val(info.event.extendedProps.id_paquete);
            $('#descripcion').val(info.event.extendedProps.descripcion);
            $('#id_status').val(info.event.extendedProps.id_status);
            $('#image').val(info.event.extendedProps.image);



    // Limpiar selecciones del select múltiple de cosmes
    limpiarSelectCosmes();

    // Seleccionar las cosmes correspondientes en el select múltiple
    if (info.event.extendedProps.cosmes) {
        info.event.extendedProps.cosmes.forEach(function(id) {
            $('#cosmesInput option[value="' + id + '"]').prop('selected', true);
        });
    }
            $('#exampleModal').modal('show');

            console.log('cosmesInput', info.event.extendedProps.cosmes)
          },

          eventContent: function(arg) {

          minutos3=(arg.event.start.getMinutes());
          hora3=(arg.event.start.getHours());
          minutos3 = (minutos3<10)?"0"+minutos3:minutos3;
          hora3 = (hora3<10)?"0"+hora3:hora3;
          horario = (hora3+":"+minutos3);
          let hor = horario;

          let imageArg = arg.event.extendedProps.image;
          let modulocapi = arg.event.getResources().map(function(resource) { return resource.id });

          let arrayOfDomNodes = []

          // title event
          let titleEvent = document.createElement('div')
            titleEvent.innerHTML = arg.event.title
            titleEvent.classList = "fc-event-title fc-sticky"


          // Hora event
          let horaEvent = document.createElement('div')
            horaEvent.innerHTML = '<div style="font-size:10px;">'+hor+' - '+modulocapi+'<img width="13px" style="margin-left: 10px" src="'+imageArg+'" ></div>';
            horaEvent.classList = "fc-event-time"

          // image event
          // let imgEventWrap = document.createElement('div')
          //   let imgEvent = '<img width="16px" height="16px" style="margin-left: 10px" src="'+imageArg+'" >';
          //   imgEventWrap.classList = "fc-event-img"
          //   imgEventWrap.innerHTML = imgEvent;

          arrayOfDomNodes = [ titleEvent,horaEvent ]

          return { domNodes: arrayOfDomNodes }
        },



      });

      calendar.setOption('locale','Es');
      calendar.render();

      $('#btnWhats').click(function(){
          ObjEvento= recolectarDatosGUIWhatsapp('POST');
          {{--EnviarInformacion('{{route('calendar.index_calendar')}}', ObjEvento);--}}
          EnviarInformacionWhatsapp('', ObjEvento);
      });

      $('#btnNota').click(function() {
        var ObjEvento = {
            nota: $('#id_notaModal').val(),
            laser: $('#id_laserModal').val(),
            paquete: $('#id_paqueteModal').val()
        };
        EnviarInformacionnota(ObjEvento);
    });

      $('#btnAgregar').click(function(){
          ObjEvento= recolectarDatosGUI('POST');
          {{--EnviarInformacion('{{route('calendar.index_calendar')}}', ObjEvento);--}}
          EnviarInformacion('', ObjEvento);
      });

      $('#btnBorrar').click(function(){
          ObjEvento= editarDatosGUI('PATCH');
          EnviarInformacion('/destroy/'+$('#txtID').val(), ObjEvento);
      });

      $('#btnModificar').click(function(){
          ObjEvento= editarDatosGUI('PATCH');
          EnviarInformacion('/update/'+$('#txtID').val(), ObjEvento);
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
              title:$('#title').val(),
              id_client:$('#id_client').val(),
              resourceId:$('#resourceId').val(),
              id_especialist:$('#id_especialist').val(),
              descripcion:$('#descripcion').val(),
              id_status:$('#id_status').val(),
              image:$('#image').val()+imageDefault,
              color:$('#color').val(),
              id_servicio:$('#id_servicio').val(),
              id_notaModal:$('#id_notaModal').val(),
              id_laserModal:$('#id_laserModal').val(),
              id_paqueteModal:$('#id_paqueteModal').val(),
              cliente_id:$('#cliente_id').val(),
              start:$('#txtFecha').val()+" "+$('#txtHora').val(),
              end:$('#txtFecha').val()+" "+$('#txtHorafin').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }
          console.log('Fecha nuevo',nuevoEvento)
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
              id_notaModal:$('#id_notaModal').val(),
              id_laserModal:$('#id_laserModal').val(),
              id_paqueteModal:$('#id_paqueteModal').val(),
              cliente_id:$('#cliente_id').val(),
              start:$('#txtFecha').val()+" "+$('#txtHora').val(),
              end:$('#txtFecha').val()+" "+$('#txtHorafin').val(),
              '_token':$("meta[name='csrf-token']").attr("content"),
              '_method':method
          }
          console.log('Fecha nuevo 1',nuevoEvento)
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
      function EnviarInformacion(accion,ObjEvento){
          $.ajax(
                  {
                     type:"POST",
                       url: "{{route('calendar.store_calendar')}}"+accion,
                      data:ObjEvento,
                      success:function (msg){
                            console.log('Mensaje',msg);
                            $('#exampleModal').modal('toggle');
                            calendar.refetchEvents();
                           },
                      error:function(){alert("hay un error");}
                  }
              );
      }

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
            $('#txtHorafin').val("");
            $('#color').val("");
            $('#id_servicio').val("");
            $('#id_notaModal').val("");
            $('#id_laserModal').val("");
            $('#id_paqueteModal').val("");
            $('#cliente_id').val("");
            $('#descripcion').val("");
            $('#id_status').val("");
            $('#image').val("");
            limpiarSelectCosmes();
        }

        function limpiarSelectCosmes() {
            $('#cosmesInput option').prop('selected', false);
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
        $('#cosmesInput').val(cosmesSeleccionados).trigger('change');

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
});
</script>
    @endsection


