<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('dashboard') }}" target="">
        <img src="{{asset('logo/'.$configuracion->logo) }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-calendar-grid-58 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>

        <a data-bs-toggle="collapse" href="#pagesPaquetes" class="nav-link {{ (Request::is('paquetes/servicios*') ? 'active' : '') }}" aria-controls="pagesPaquetes" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="fa fa-file text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Cosmes</span>
          </a>
          <div class="collapse " id="pagesPaquetes">
            <ul class="nav ms-4">
                <li class="nav-item ">
                    <a class="nav-link {{ (Request::is('paquetes/servicios*') ? 'show' : '') }}" data-bs-toggle="modal" data-bs-target="#showAsistenciaCosmes">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal">Asistencia</span>
                    </a>

                    <a class="nav-link {{ (Request::is('pagos*') ? 'active' : '') }}" href="{{ route('pagos.index') }}" target="">
                        <span class="nav-link-text ms-1">Sueldo Cosmes</span>
                    </a>
                </li>
            </ul>
        </div>

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('clients*') ? 'active' : '') }}" href="{{ route('clients.index') }}" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-circle-08 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Clientes</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Request::is('buscador*') ? 'active' : '') }}" href="{{ route('index.buscador') }}" target="">
              <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
               <i class="fa fa-search text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
              </div>
              <span class="nav-link-text ms-1">Buscador</span>
            </a>
          </li>

        <a data-bs-toggle="collapse" href="#pagesConsentimientos" class="nav-link {{ (Request::is('clients/facial*') ? 'active' : '') }}" aria-controls="pagesConsentimientos" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="fa fa-file-signature text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Consentimientos</span>
          </a>
          <div class="collapse " id="pagesConsentimientos">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('clients/facial*') ? 'show' : '') }}" id="open-form">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Crear Consentimiento</span>
                </a>
                @include('client.create_cons')
                <a class="nav-link {{ (Request::is('clients/facial*') ? 'show' : '') }}" href="{{ route('clients_facial.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Facial/Corporal</span>
                </a>

                <a class="nav-link {{ (Request::is('clients/bar*') ? 'show' : '') }}" href="{{ route('clients_show_brow.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Brow Bar</span>
                </a>

                <a class="nav-link {{ (Request::is('clients/lash*') ? 'show' : '') }}" href="{{ route('clients_lash.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Lash Lifting</span>
                </a>

                <a class="nav-link {{ (Request::is('clients/jacuzzi*') ? 'show' : '') }}" href="{{ route('clients_jacuzzi.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Jacuzzi</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <a data-bs-toggle="collapse" href="#pagesEncuestas" class="nav-link {{ (Request::is('/encuesta*') ? 'active' : '') }}" aria-controls="pagesEncuestas" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-basket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Encuestas</span>
        </a>
          <div class="collapse " id="pagesEncuestas">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.faciales') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Faciales</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.corporal') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Corporales</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.facorpo') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Faciales & Corporal</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.experiencias') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Experiencias</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.jacuzzi_experiencia') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Jacuzzi + Experiencia</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.jacuzzi') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Jacuzzi</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.brow') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Brow Bar</span>
                </a>

                <a class="nav-link {{ (Request::is('/encuesta*') ? 'show' : '') }}" href="{{ route('index.nailbar') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Hair Lab</span>
                </a>
              </li>
            </ul>
          </div>

        <a data-bs-toggle="collapse" href="#pagesServicios" class="nav-link {{ (Request::is('notas/servicios*') ? 'active' : '') }}" aria-controls="pagesServicios" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-basket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Notas Servicios</span>
        </a>
          <div class="collapse " id="pagesServicios">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('notas.create') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Crear Nueva</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('notas.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Todas</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('notas_pendientes.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Pendientes</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('notas_completadas.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Completadas</span>
                </a>
              </li>
            </ul>
          </div>

        <a data-bs-toggle="collapse" href="#pagesPedidos" class="nav-link {{ (Request::is('notas/pedidos*') ? 'active' : '') }}" aria-controls="pagesPedidos" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                <i class="ni ni-cart text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Notas Pedidos</span>
          </a>
          <div class="collapse " id="pagesPedidos">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('notas/pedidos*') ? 'show' : '') }}" href="{{ route('notas_pedidos.create') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Crear Nueva</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/pedidos*') ? 'show' : '') }}" href="{{ route('notas_pedidos.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Todas</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <a data-bs-toggle="collapse" href="#pagesPaquetes" class="nav-link {{ (Request::is('paquetes/servicios*') ? 'active' : '') }}" aria-controls="pagesPaquetes" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="fa fa-file text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Notas Paquetes</span>
          </a>
          <div class="collapse " id="pagesPaquetes">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('paquetes/servicios*') ? 'show' : '') }}" data-bs-toggle="modal" data-bs-target="#showDataModal">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Crear Nueva</span>
                </a>

                <a class="nav-link {{ (Request::is('paquetes/servicios*') ? 'show' : '') }}" href="{{ route('paquetes_servicios.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Todas</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('paquetes_servicios_pendientes.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Pendientes</span>
                </a>

                <a class="nav-link {{ (Request::is('notas/servicios*') ? 'show' : '') }}" href="{{ route('paquetes_servicios_pagados.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Pagadas</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <a data-bs-toggle="collapse" href="#pagesProductos" class="nav-link {{ (Request::is('productos*') ? 'active' : '') }}" aria-controls="pagesProductos" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="fa fa-file-signature text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Inventario</span>
          </a>
          <div class="collapse " id="pagesProductos">
            <ul class="nav ms-4">
                <li class="nav-item ">
                    <a class="nav-link {{ (Request::is('productos/reporte*') ? 'show' : '') }}" href="{{ route('productos.reporte') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal">Reporte</span>
                    </a>
                </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('productos/bodega*') ? 'show' : '') }}" href="{{ route('productos.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Bodega</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('inventario/cabina1*') ? 'show' : '') }}" href="{{ route('inventario.index1') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Cabina 1</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('inventario/cabina2*') ? 'show' : '') }}" href="{{ route('inventario.index2') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Cabina 2</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('inventario/cabina3*') ? 'show' : '') }}" href="{{ route('inventario.index3') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Cabina 3</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('inventario/cabina4*') ? 'show' : '') }}" href="{{ route('inventario.index4') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Cabina 4</span>
                </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('inventario/cabina5*') ? 'show' : '') }}" href="{{ route('inventario.index5') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Cabina 5</span>
                </a>
              </li>
            </ul>
          </div>

            <li class="nav-item">
            <a class="nav-link {{ (Request::is('caja*') ? 'active' : '') }}" href="{{ route('caja.index') }}" target="">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-money-coins text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Caja</span>
            </a>
            </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administrativo</h6>
        </li>

        <li class="nav-item">
        <a data-bs-toggle="collapse" href="#pagesExamples1" class="nav-link {{ (Request::is('servicio*') ? 'active' : '') }}{{ (Request::is('reporte*') ? 'active' : '') }}" aria-controls="pagesExamples1" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Administrativo</span>
        </a>
        <div class="collapse mb-3" id="pagesExamples1">
        <ul class="nav ms-4">
            <li class="nav-item ">
                <a class="nav-link {{ (Request::is('servicio*') ? 'show' : '') }}" href="{{ route('servicio.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Servicio</span>
                </a>

                <a class="nav-link {{ (Request::is('reporte*') ? 'show' : '') }}" href="{{ route('reporte.index') }}">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Reporte</span>
                </a>

                @can('encuestas')
                    <a class="nav-link {{ (Request::is('encuestas*') ? 'show' : '') }}" href="{{ route('index.encuestas') }}">
                        <span class="sidenav-mini-icon"> P </span>
                        <span class="sidenav-normal">Reporte Encuestas</span>
                    </a>
                @endcan
            </li>
        </ul>
        </div>

          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Roles y Permisos</span>
          </a>
          <div class="collapse " id="pagesExamples">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('users*') ? 'show' : '') }}" href="{{ route('users.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Usuarios</span>
                </a>

                <a class="nav-link {{ (Request::is('roles*') ? 'show' : '') }}" href="{{ route('roles.index') }}">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Roles</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sistem" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="sistem" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Configuraciones</span>
          </a>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="#">
                  <span class="sidenav-mini-icon">U</span>
                  <span class="sidenav-normal">Horarios</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="{{ route('index.configuracion') }}">
                  <span class="sidenav-mini-icon">U</span>
                  <span class="sidenav-normal">Pagina</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      </ul>

    </div>

  </aside>
