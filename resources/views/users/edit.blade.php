@extends('layouts.app')

@section('template_title')
    Create Usuario
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-3">Editar Usuario</h3>
               <a class="btn" href="{{ route('users.index') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff"> Back</a>
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

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
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
                            {!! Form::text('puesto', null, array('placeholder' => 'Puesto','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Sueldo Base:</label>
                            {!! Form::text('sueldo_base', null, array('placeholder' => 'Sueldo Base','class' => 'form-control')) !!}
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
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <label class="form-control-label">Dias Laborales:</label>

                            @if ($horario->lunes == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lunes" id="customRadio1" value="{{$horario->lunes}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Lunes</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="lunes" id="customRadio1" value="1">
                                    <label class="custom-control-label" for="customRadio1">Lunes</label>
                                </div>
                            @endif

                            @if ($horario->martes == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="martes" id="customRadio2" value="{{$horario->martes}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Martes</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="martes" id="customRadio2" value="1">
                                    <label class="custom-control-label" for="customRadio1">Martes</label>
                                </div>
                            @endif

                            @if ($horario->miercoles == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="miercoles" id="customRadio3" value="{{$horario->miercoles}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Miercoles</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="miercoles" id="customRadio3" value="1">
                                    <label class="custom-control-label" for="customRadio1">Miercoles</label>
                                </div>
                            @endif

                            @if ($horario->jueves == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jueves" id="customRadio4" value="{{$horario->jueves}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Jueves</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="jueves" id="customRadio4" value="1">
                                    <label class="custom-control-label" for="customRadio1">Jueves</label>
                                </div>
                            @endif

                            @if ($horario->viernes == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="viernes" id="customRadio5" value="{{$horario->viernes}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Viernes</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="viernes" id="customRadio5" value="1">
                                    <label class="custom-control-label" for="customRadio1">Viernes</label>
                                </div>
                            @endif

                            @if ($horario->sabado == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sabado" id="customRadio6" value="{{$horario->sabado}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Sabado</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sabado" id="customRadio6" value="1">
                                    <label class="custom-control-label" for="customRadio1">Sabado</label>
                                </div>
                            @endif

                            @if ($horario->domingo == 1)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="domingo" id="customRadio7" value="{{$horario->domingo}}" checked>
                                    <label class="custom-control-label" for="customRadio1">Domingo</label>
                                </div>
                            @else
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="domingo" id="customRadio7" value="1">
                                    <label class="custom-control-label" for="customRadio1">Domingo</label>
                                </div>
                            @endif

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

@endsection
