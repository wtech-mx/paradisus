@extends('layouts.app')

@section('template_title')
    Usuarios
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
              <h3 class="mb-3">Usuarios</h3>
              @can('usuarios-create')
                <a class="btn" href="{{ route('users.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">Crear usuario</a>
              @endcan
            </div>

            @can('usuarios-create')
                <div class="table-responsive py-4" style="">
                <table class="table table-flush table_id" id="datatable-basic" >
                    <thead class="thead-light">
                        <tr>
                        <th>No</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Puesto</th>
                        <th>Roles</th>
                        <th width="280px">Acciones</th>
                        </tr>
                    </thead>

                    @foreach ($data as $key => $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->puesto }}</td>
                            <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                            </td>

                            <td class="text-right">
                            <div class="dropdown ">
                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{ route('users.show',$user->id) }}">
                                    Ver
                                </a>
                                @can('usuarios-edit')
                                    <a class="dropdown-item" href="{{ route('users.edit',$user->id) }}">
                                        Editar
                                    </a>
                                @endcan
                                @can('usuarios-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'dropdown-item']) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </div>
                            </div>
                            </td>

                        </tr>
                    @endforeach

                </table>
                </div>
            @endcan

          </div>
        </div>
      </div>
</div>

{!! $data->render() !!}

@endsection
