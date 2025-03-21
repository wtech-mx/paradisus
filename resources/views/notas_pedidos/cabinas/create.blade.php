@extends('layouts.app')

@section('template_title')
   Nota para cabias
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 class="mb-3">Nota para cabinas</h3>

                        <a class="btn"  href="{{ route('notas.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                            Regresar
                        </a>

                    </div>
                </div>
                <div class="card-body" id="createDataModal">

                    <form method="POST" action="{{ route('notas_cabinas.store') }}" enctype="multipart/form-data" role="form" id="miFormulario">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-3">
                                    <label for="total-suma">Cabina *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/icons/payment-method.png') }}" alt="" width="25px">
                                        </span>
                                        <select id="cabina" name="cabina" class="form-control" value="{{old('cabina')}}" >
                                            <option value="" selected>selecione Cabina</option>
                                            <option value="1">Cabina 1</option>
                                            <option value="2">Cabina 2</option>
                                            <option value="3">Cabina 3</option>
                                            <option value="4">Cabina 4</option>
                                            <option value="5">Cabina 5</option>
                                            <option value="6">Recepción</option>
                                            <option value="7">Exfoliación de manos</option>
                                            <option value="8">Exfoliación de pies</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-9">
                                    <label for="num_estandar">Nota</label>
                                    <textarea name="nota_reposicion" id="nota_reposicion" cols="10" rows="2" class="form-control" ></textarea>
                                </div>
                                <div id="formulario" class="mt-4">
                                    <button type="button" class="clonar btn btn-secondary btn-sm">Agregar</button>
                                    <div class="clonars">
                                        <div class="row">
                                            <div class="col-10">
                                                <label for="">Producto</label>
                                                <div class="form-group">
                                                    <select name="producto[]" class="form-select d-inline-block select2">
                                                        <option value="">Seleccione products</option>
                                                        @foreach ($products as $product)
                                                        <option value="{{ $product->nombre }}">{{ $product->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- <div class="col-2">
                                                <div class="form-group">
                                                    <label for="fecha">Cantidad</label>
                                                    <input  id="cantidad[]" name="cantidad[]" type="number" class="form-control" value="1">
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Cancelar</button>
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                Guardar
                            </button>
                            <div class="d-flex justify-content-center">
                                <div class="spinner-border" role="status" id="preloader" style="display:none">
                                     <span class="visually-hidden">Loading...</span>
                                 </div>
                            </div>
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
               $('.cliente').select2();
            });

            $(document).ready(function() {
                $(".cliente_pedido").select2({
                    dropdownParent: $("#createDataModal")
                });
            });
</script>
<script type="text/javascript">
    const productos = {
        "1": @json($products),
        "2": @json($products),
        "3": @json($products),
        "4": @json($products),
        "5": @json($products),
        "6": @json($productos_recepcion),
        "7": @json($productos_manos),
        "8": @json($productos_pies)
    };
    document.getElementById('cabina').addEventListener('change', function () {
        const cabina = this.value;
        const productosSelect = document.querySelector('select[name="producto[]"]');

        // Limpiar opciones anteriores
        productosSelect.innerHTML = '<option value="">Seleccione producto</option>';

        // Si hay productos para esa cabina, los añadimos
        if (productos[cabina]) {
            productos[cabina].forEach(producto => {
                const option = document.createElement('option');
                option.value = producto.nombre;
                option.text = producto.nombre;
                productosSelect.appendChild(option);
            });
        }
    });
    $(document).ready(function() {

        function initializeSelect2($container) {
            $container.find('.select2').select2();
        }

        // Inicializa Select2 en todos los elementos .select2 existentes
        initializeSelect2($('#formulario'));

        // Asocia un evento de cambio al campo de concepto
        $(document).on('change', '.select2', function() {
            // Obtiene el precio normal del producto seleccionado
            var precioNormal = $(this).find('option:selected').data('precio_normal');

            // Encuentra el campo de importe correspondiente y establece su valor
            $(this).closest('.row').find('.importe').val(precioNormal);
        });

        // Clonar el div cuando se haga clic en el botón "Clonar"
        $(document).on('click', '.clonar', function() {
            var $clone = $('.clonars').first().clone();
            $clone.find('select.select2').removeClass('select2-hidden-accessible').next().remove();
            $clone.find('select.select2').select2();

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

            // Asocia el evento de cambio al campo de concepto clonado
            $clone.find('.select2').on('change', function() {
                var precioNormal = $(this).find('option:selected').data('precio_normal');
                $(this).closest('.row').find('.importe').val(precioNormal);
            });

        });
    });


    </script>
@endsection
