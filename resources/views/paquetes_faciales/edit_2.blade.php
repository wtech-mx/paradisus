@extends('layouts.app')

@section('template_title')
    {{$nota->Servicio->nombre}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif
                         <h3>{{$nota->Servicio->nombre}}</h3>
                    </div>

                    <div class="card-body">
                            <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 active" data-bs-toggle="tab" href="#servicioedit" role="tab" aria-controls="pills-home" aria-selected="true" id="pills-home-tab">
                                        <i class="ni ni-folder-17 text-sm me-2"></i> Ficha clinica
                                    </a>

                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1" id="pills-profile-tab" data-bs-toggle="tab" href="#pagoedit" role="tab" aria-controls="pills-profile" aria-selected="true">
                                        <i class="ni ni-credit-card text-sm me-2"></i> Pago
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link mb-0 px-0 py-1 " id="pills-nota-tab" data-bs-toggle="tab" href="#pagoNota" role="tab" aria-controls="pills-nota" aria-selected="true">
                                        <i class="ni ni-credit-card text-sm me-2"></i> Nota
                                    </a>
                                </li>
                            </ul>
                        <form method="POST" action="{{ route('paquetes_faciales.update', $nota->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade in active show" id="servicioedit">
                                    <div class="row">
                                        @foreach ($registros as $registro)
                                            <div class="col-lg-4 col-md-4 col-12 mt-3">
                                                <div class="card mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                    SESIÓN 0{{ $registro->num_sesion }}
                                                                </a>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="nombre">Cosmetologa</label>
                                                                <select class="form-control " value="{{ old('id_cosme') }}" readonly>
                                                                    <option value="{{ $registro->id_cosme }}">{{ $registro->User->name }}</option>
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="nombre">Fecha</label>
                                                                <div class="stats">
                                                                    <input class="form-control" type="date" value="{{ $registro->fecha }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="nombre">Masaje</label>
                                                                <div class="stats">
                                                                    <input class="form-control" type="text" value="{{ $registro->masaje }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="nombre">Facial</label>
                                                                <div class="stats">
                                                                    <input class="form-control" type="text" value="{{ $registro->facial }}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nombre">Nota</label>
                                                                <div class="stats">
                                                                    <textarea cols="15" rows="3" class="form-control" readonly>{{ $registro->observaciones }}</textarea>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($total_sesiones_registradas < $total_sesiones_servicio)
                                            <div class="col-lg-4 col-md-4 col-12 mt-3">
                                                <div class="card mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <a href="javascript:;" class="card-title h5 d-block text-darker">
                                                                    SESIÓN {{ str_pad($total_sesiones_registradas + 1, 2, '0', STR_PAD_LEFT) }}
                                                                </a>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="nombre">Cosmetóloga</label>
                                                                <select class="form-control" id="id_cosme_form" name="id_cosme_form" required>
                                                                    <option value="">Seleccionar cosmetóloga</option>
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="fecha">Fecha</label>
                                                                <input class="form-control" type="date" name="fecha" required>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="fecha">Masajes</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="masaje" id="masaje1" value="Relajante">
                                                                    <label class="form-check-label" for="masaje1">
                                                                        Relajante
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="masaje" id="masaje2" value="Descontracturante">
                                                                    <label class="form-check-label" for="masaje2">
                                                                        Descontracturante
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="masaje" id="masaje3" value="Antiestrés">
                                                                    <label class="form-check-label" for="masaje3">
                                                                        Antiestrés
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-6">
                                                                <label for="fecha">Faciales</label>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="faciales" id="faciales1" value="Hidratante">
                                                                    <label class="form-check-label" for="faciales1">
                                                                        Hidratante
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="faciales" id="faciales2" value="Limpieza básica y skinscrubber">
                                                                    <label class="form-check-label" for="faciales2">
                                                                        Limpieza básica y skinscrubber
                                                                    </label>
                                                                </div>
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="faciales" id="faciales3" value="Antiedad">
                                                                    <label class="form-check-label" for="faciales3">
                                                                        Antiedad
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <label for="observaciones">Nota</label>
                                                                <textarea name="observaciones" id="observaciones" cols="15" rows="3" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="tab-pane" id="pagoedit">
                                    @include('paquetes_faciales.edit_pago')
                                </div>

                                <div class="tab-pane" id="pagoNota">
                                    @include('paquetes_faciales.edit_nota')
                                </div>

                                <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff;margin-right: 3rem">Guardar</button>
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

<script type="text/javascript">

    $(document).ready(function () {
        $('.id_paquete').select2();
        $('.id_user').select2();
        $('.id_cosme').select2();
        $('.cliente_facial').select2();

        $('#pago, #dinero_recibido').on('input', function () {
            calcularRestante();
            calcularCambio();
        });

        function calcularRestante() {
            const restanteOriginal = parseFloat($('#restante_original').val()) || 0;
            const pago = parseFloat($('#pago').val()) || 0;
            const nuevoRestante = restanteOriginal - pago;

            $('#restante').val(nuevoRestante.toFixed(2));
        }

        function calcularCambio() {
            const pago = parseFloat($('#pago').val()) || 0;
            const recibido = parseFloat($('#dinero_recibido').val()) || 0;
            const cambio = recibido - pago;

            $('#cambio').val(cambio >= 0 ? cambio.toFixed(2) : '0.00');
        }
    });
</script>
@endsection
