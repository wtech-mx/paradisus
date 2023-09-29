<script type="text/javascript">
    $(document).ready(function() {
        $('.cliente').select2();
    });

    // Obtén la referencia a los elementos de pago, cambio, dinero recibido, total a pagar y es contado
    var inputPago = $('#pago');
    var inputDineroRecibidoCreate = $('#dinero_recibido_create');
    var inputCambio = $('#cambio');
    var inputTotalSuma = $('#total-suma');
    var inputRestante = $('#restante');
    var inputEsContado = $('#es-contado'); // Checkbox de es contado

    // Al cargar la página, guarda el valor inicial del total a pagar
    var totalAPagarInicial = parseFloat(inputTotalSuma.val()) || 0;

    // Función para calcular el restante y el cambio
    function calcularRestanteYCambiar() {
        // Obtiene el valor del total a pagar
        var totalAPagar = totalAPagarInicial; // Restaura el valor inicial

        // Aplica el descuento del 5% si es contado
        if (inputEsContado.prop('checked')) {
            var descuento = totalAPagarInicial * 0.05; // Calcula el descuento
            totalAPagar -= descuento; // Resta el descuento al precio total
        }

        // Obtiene el valor del pago
        var pago = parseFloat(inputPago.val()) || 0;

        // Calcula el restante
        var restante = totalAPagar - pago;

        // Establece el valor del restante en el campo correspondiente
        inputRestante.val(restante.toFixed(2));

        // Obtiene el valor del dinero recibido para crear
        var dineroRecibidoCreate = parseFloat(inputDineroRecibidoCreate.val()) || 0;

        // Calcula el cambio y verifica si el dinero recibido es mayor o igual que el pago
        var cambio = 0;

        if (dineroRecibidoCreate >= pago) {
            cambio = dineroRecibidoCreate - pago;
        }

        // Establece el valor del cambio en el campo correspondiente
        inputCambio.val(cambio.toFixed(2));
    }

    // Escucha el evento 'input' en el campo de pago
    inputPago.on('input', calcularRestanteYCambiar);

    // Escucha el evento 'input' en el campo de dinero recibido para crear
    inputDineroRecibidoCreate.on('input', calcularRestanteYCambiar);

    // Escucha el evento 'change' en el checkbox de es contado para actualizar el total-suma cuando se marca o desmarca
    inputEsContado.on('change', function() {
        // No se modifica el total a pagar aquí
        calcularRestanteYCambiar();
    });

    // Llama a la función para calcular el restante y el cambio al cargar la página
    calcularRestanteYCambiar();
</script>
