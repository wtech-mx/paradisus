@extends('layouts.app')

@section('template_title')
    Perfil Cliente
@endsection

@section('content')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        @if (Route::currentRouteName() == 'peril_cliente.index')
                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <h5>Filtro</h5>
                                <form action="{{ route('peril_cliente.buscador') }}" method="GET" >
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Cliente:</label>
                                            <select class="form-control cliente" name="id_client" id="id_client">
                                                <option selected value="">seleccionar cliente</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}">{{ $client->name }} {{ $client->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label for="user_id">Seleccionar Telefono:</label>
                                            <select class="form-control phone" name="phone" id="phone"></select>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <a class="btn btn-sm mb-0 mt-sm-0 mt-1" href="{{route('peril_cliente.index')}}" style="background-color: #F82018; color: #ffffff;">Buscar otro cliente</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
          </div>

          <main class="main-content max-height-vh-100 h-100">
            <div class="container-fluid my-5 py-2">
                <div class="row mb-5">
                    @if(Route::currentRouteName() != 'peril_cliente.index')
                        <div class="col-lg-3">
                            <div class="card position-sticky top-1">
                            <ul class="nav flex-column bg-white border-radius-lg p-3">
                                <li class="nav-item">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.informacion', $cliente->id)}}">
                                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                        <img src="{{ asset('assets/icons/carta_res.png') }}"width="30px" >
                                    </div>
                                    <span class="text-sm">Informacion Basica</span>
                                </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.citas', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/calenda.png') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Proximas citas</span>
                                    </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.servicios', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/mascara-facial.png') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Servicios</span>
                                    </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.paquetes', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/massage.png') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Paquetes</span>
                                    </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.laser', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/camara.png') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Laser</span>
                                    </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.productos', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/carrito-de-compras.webp') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Productos</span>
                                    </a>
                                </li>
                                <li class="nav-item pt-2">
                                    <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{route('peril_cliente.consentimientos', $cliente->id)}}">
                                        <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                                            <img src="{{ asset('assets/icons/prueba.webp') }}"width="30px" >
                                        </div>
                                        <span class="text-sm">Consentimientos</span>
                                    </a>
                                </li>
                            </ul>
                            </div>
                        </div>
                    @endif
                  <div class="col-lg-9 mt-lg-0 mt-4">
                    @if (Route::currentRouteName() != 'peril_cliente.index')
                    <div class="card card-body" id="profile">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="{{ asset('icons/woman_happy.png') }}" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">
                                        {{$cliente->name}} {{$cliente->last_name}}
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        {{$cliente->phone}} <br>
                                        A{{$cliente->id}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">

                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.buscador' || Route::currentRouteName() == 'peril_cliente.informacion')
                        @include('client.perfil.basic_info')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.citas')
                        @include('client.perfil.citas')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.servicios')
                        @include('client.perfil.servicios')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.paquetes')
                        @include('client.perfil.paquetes')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.laser')
                        @include('client.perfil.laser')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.productos')
                        @include('client.perfil.productos')
                    @endif
                    @if(Route::currentRouteName() == 'peril_cliente.consentimientos')
                        @include('client.perfil.consentimientos')
                    @endif
                  </div>
                </div>
              </div>
            </main>
        </div>
      </div>
</div>
@endsection

@section('select2')
    <script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
    <script>
        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.cliente').select2();
            $('.phone').select2({
                placeholder: 'Buscar Teléfono',
                ajax: {
                    url: '{{ route('peril_cliente.searchPhone') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.phone,
                                    id: item.phone
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.name').select2({
                placeholder: 'Buscar Nombre',
                ajax: {
                    url: '{{ route('peril_cliente.searchName') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name + ' ' + item.last_name, // Concatenar name y last_name
                                    id: item.id // Puedes cambiar esto si necesitas usar otro identificador
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
@endsection
