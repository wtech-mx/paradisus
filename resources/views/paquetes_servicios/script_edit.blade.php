<script type="text/javascript">
    $(document).ready(function() {
        $('.cliente').select2();
    });

    // Obtén la referencia a los elementos de pago, cambio, dinero recibido y restante
    var inputPago = $('#nuevo-pago');
    var inputCambio = $('#cambio');
    var inputDineroRecibido = $('#dinero_recibido');
    var inputRestante = $('#restante');
    var restanteInicial;

    // Llamar a calcularRestante al cargar la página de edición
    $(document).ready(function() {
        restanteInicial = parseFloat($('#restante').val()) || 0; // Obten el valor inicial de #restante
        calcularRestante();
    });

    function calcularRestante() {
        var pagosExistentes = 0;
        $('.pago-existente').each(function() {
            pagosExistentes += parseFloat($(this).val()) || 0;
        });

        var nuevoPago = parseFloat(inputPago.val()) || 0;
        var restante = restanteInicial - pagosExistentes; // Utiliza el valor inicial de restante
        console.log('restante', restante);
        $('#restante').val(restante);

        // Calcula el cambio correctamente
        var cambio = 0;
        if (nuevoPago >= restante) {
            restante = 0;
        } else {
            restante -= nuevoPago; // Reduce el restante por el valor del nuevo pago
        }

        $('#restante').val(restante);
    }

    // Agregar evento de cambio en el campo de nuevo pago
    inputPago.on('input', function() {
        calcularRestante();
    });

    // Agregar evento de cambio en el campo de dinero recibido
    inputDineroRecibido.on('input', function() {
        calcularCambio();
    });

    function calcularCambio() {
        var dineroRecibido = parseFloat(inputDineroRecibido.val()) || 0;
        var nuevoPago = parseFloat(inputPago.val()) || 0;
        var cambio = 0;

        if (dineroRecibido > nuevoPago) {
            cambio = dineroRecibido - nuevoPago;
        }

        inputCambio.val(cambio);
    }

    // Restringir que el cambio sea 0 cuando los campos estén vacíos
    inputDineroRecibido.on('blur', function() {
        var dineroRecibido = parseFloat(inputDineroRecibido.val()) || 0;
        var nuevoPago = parseFloat(inputPago.val()) || 0;

        if (dineroRecibido === 0 && nuevoPago === 0) {
            inputCambio.val(0);
        }
    });
</script>
