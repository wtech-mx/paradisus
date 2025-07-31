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
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="date" class="form-control" value="{{ $registro->fecha }}" readonly>
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <strong>Cosmetologa</strong>
                                                                <select class="form-control" value="{{ old('id_cosme') }}" readonly>
                                                                    <option value="{{ $registro->id_cosme }}">{{ $registro->User->name }}</option>
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <strong>Talla</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input value="{{ $registro->talla_antes }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input value="{{ $registro->talla_despues }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <strong>Abdomen</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input value="{{ $registro->abdomen_antes }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input value="{{ $registro->abdomen_despues }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <strong>Cintura</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input value="{{ $registro->cintura_antes }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input value="{{ $registro->cintura_despues }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <strong>Cadera</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input value="{{ $registro->cadera_antes }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input value="{{ $registro->cadera_despues }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <strong>Gluteos</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input value="{{ $registro->gluteos_antes }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input value="{{ $registro->gluteos_despues }}" type="text" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="observaciones" id="observaciones" cols="15" rows="3" class="form-control" readonly>{{ $registro->observaciones }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        @if($total_sesiones_registradas < $total_sesiones_servicio)
                                            <div class="col-lg-3 col-md-3 col-12">
                                                <div class="card  mb-3">
                                                    <div class="card-body p-3">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"> Fecha:</span>
                                                            </div>
                                                            <div class="col-8">
                                                                <input  id="fecha1" name="fecha1" type="date" class="form-control">
                                                            </div>
                                                            <div class="col-12 mb-2">
                                                                <strong>Cosmetologa</strong>
                                                                <select class="form-control" id="id_cosme_form" name="id_cosme_form" required>
                                                                    <option value="">Seleccionar cosmetóloga</option>
                                                                    @foreach ($user as $item)
                                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <strong>Talla</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="talla1_a" name="talla1_a" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="talla1_d" name="talla1_d" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <strong>Abdomen</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="abdomen1_a" name="abdomen1_a" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="abdomen1_d" name="abdomen1_d" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <strong>Cintura</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="cintura1_a" name="cintura1_a" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="cintura1_d" name="cintura1_d" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <strong>Cadera</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="cadera1_a" name="cadera1_a" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="cadera1_d" name="cadera1_d" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <strong>Gluteos</strong>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Antes</label>
                                                                    <input  id="gluteo1_a" name="gluteo1_a" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="fecha">Despues</label>
                                                                    <input  id="gluteo1_d" name="gluteo1_d" type="text" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <span>Nota</span>
                                                                <div class="stats">
                                                                    <textarea name="observaciones" id="observaciones" cols="15" rows="3" class="form-control"></textarea>
                                                                </div>
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
