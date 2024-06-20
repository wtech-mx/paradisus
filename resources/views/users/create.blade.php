@extends('layouts.app')

@section('template_title')
    Create Usuarios
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-3">Crear nuevo ususario</h3>
               <a class="btn" href="{{ route('users.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff"> Regresar</a>
                    @if (count($errors) > 0)
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                           @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                      </div>
                    @endif
            </div>

            <div class="card-body mb-5">

                {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Nombre:</label>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Email:</label>
                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Puesto:</label>
                            <select class="form-select cliente d-inline-block"  data-toggle="select" id="puesto" name="puesto" value="{{ old('puesto') }}">
                                <option value="Recepcionista">Recepcionista</option>
                                <option value="Cosme">Cosme</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Sueldo base por dia:</label>
                            <input  id="sueldo_base" name="sueldo_base" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Bono comida:</label>
                            <input  id="bono_comida" name="bono_comida" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Bono puntualidad:</label>
                            <input  id="bono_puntualidad" name="bono_puntualidad" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Sueldo por hora domingo:</label>
                            <input  id="comision_despedida" name="comision_despedida" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Sueldo por hora:</label>
                            <input  id="sueldo_hora" name="sueldo_hora" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Color:</label>
                            <input  id="color" name="color" type="color" class="form-control" >
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Color:</label>
                            <input  id="resourceId" name="resourceId" type="text" class="form-control" minlength="1" maxlength="1">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Password:</label>
                            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Confirm Password:</label>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label class="form-control-label">Role:</label>
                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Dias Laborales:</label>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lunes" id="customRadio1" value="1">
                                <label class="custom-control-label" for="customRadio1">Lunes</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="martes" id="customRadio2" value="1">
                                <label class="custom-control-label" for="customRadio1">Martes</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="miercoles" id="customRadio3" value="1">
                                <label class="custom-control-label" for="customRadio1">Miercoles</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="jueves" id="customRadio4" value="1">
                                <label class="custom-control-label" for="customRadio1">Jueves</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="viernes" id="customRadio5" value="1">
                                <label class="custom-control-label" for="customRadio1">Viernes</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sabado" id="customRadio6" value="1">
                                <label class="custom-control-label" for="customRadio1">Sabado</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="domingo" id="customRadio7" value="1">
                                <label class="custom-control-label" for="customRadio1">Domingo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}

            </div>

          </div>
        </div>
      </div>
</div>


@endsection
@section('select2')
<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script>
    document.getElementById('sueldo_base').oninput = function() {
        calcularSueldo();
    };

    function calcularSueldo() {
        // Obtener el valor de sueldo_base
        var sueldoBase = document.getElementById('sueldo_base').value;

        // Verificar si sueldoBase es un número válido
        if (!isNaN(sueldoBase)) {
            // Calcular sueldo por hora y comisión de despido
            var sueldoHora = sueldoBase / 9;
            var comisionDespedida = sueldoBase / 8;

            // Mostrar los resultados en los inputs correspondientes
            document.getElementById('sueldo_hora').value = sueldoHora.toFixed(2);
            document.getElementById('comision_despedida').value = comisionDespedida.toFixed(2);
        } else {
            // Si el valor ingresado no es un número válido, establecer los inputs en blanco
            document.getElementById('sueldo_hora').value = '';
            document.getElementById('comision_despedida').value = '';
        }
    }
</script>
@endsection
