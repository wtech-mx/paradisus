
<!-- Card Basic Info -->
@php
    use Carbon\Carbon;
    $fechaFormateada = Carbon::parse($cliente->created_at)->locale('es')->isoFormat('DD [de] MMMM YYYY hh:mm a');
@endphp
<form method="POST" action="{{ route('clients.update', $cliente->id) }}" enctype="multipart/form-data" role="form">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
        <div class="card mt-4" id="basic-info">
            <div class="card-header">
                <h5>Información basica</h5>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                <div class="col-12">
                    <label class="form-label">Fecha de registro</label>
                    <div class="input-group">
                    <p>{{$fechaFormateada }}</p>
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Nombre</label>
                    <div class="input-group">
                    <input id="name" name="name" class="form-control" type="text" value="{{$cliente->name}}" >
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Apellido</label>
                    <div class="input-group">
                    <input id="last_name" name="last_name" class="form-control" type="text" value="{{$cliente->last_name}}" >
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Correo</label>
                    <div class="input-group">
                    <input id="email" name="email" class="form-control" type="email" value="{{$cliente->email}}" >
                    </div>
                </div>
                <div class="col-6">
                    <label class="form-label">Telefono</label>
                    <input id="phone" name="phone" class="form-control" type="number" value="{{$cliente->phone}}" >
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
            </div>
        </div>


    </form>
