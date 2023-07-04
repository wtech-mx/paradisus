@extends('layouts.app')

@section('template_title')
    Reporte Inventario
@endsection

@section('content')
<div class="container-fluid my-5 py-2">

    <div class="row">
      <div class="col-lg-8">
        <div class="row">
          <div class="col-xl-6 mb-xl-0 mb-4">

            <div class="card">
                <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-warning shadow text-center border-radius-lg">
                        <i class="fa fa-cube opacity-10"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Productos por agotar</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$productos_por_agotar}}</h5>
                </div>
            </div>
          </div>

          <div class="col-xl-6">
            <div class="row">

              <div class="col-md-6">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-success shadow text-center border-radius-lg">
                      <i class="fa fa-cubes opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Productos con stock</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$productos_stock}}</h5>
                  </div>
                </div>
              </div>

              <div class="col-md-6 mt-md-0 mt-4">
                <div class="card">
                  <div class="card-header mx-4 p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-gradient-danger shadow text-center border-radius-lg">
                      <i class="fa fa-ban opacity-10"></i>
                    </div>
                  </div>
                  <div class="card-body pt-0 p-3 text-center">
                    <h6 class="text-center mb-0">Total</h6>
                    <span class="text-xs">Agotados</span>
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">{{$productos_agotado}}</h5>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-header pb-0 p-3">
            <div class="row">
              <div class="col-6 d-flex align-items-center">
                <h6 class="mb-0">Egresos</h6>
              </div>
              <div class="col-6 text-end">
                <a type="button" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4" href="#"><i class="fas fa-file-pdf text-lg me-1"></i>Corte</a>
              </div>
            </div>
          </div>
          <div class="card-body p-3 pb-0">
            <ul class="list-group">

                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark font-weight-bold text-sm">hjkhkj</h6>
                        <span class="text-xs">#10</span>
                        </div>
                        <div class="d-flex align-items-center text-sm">
                        $100
                        </div>
                    </li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-md-7">
        <div class="card">
          <div class="card-header pb-0 px-3">
            <h6 class="mb-0">Notas Cursos</h6>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">hgjhjj</h6>
                            <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">545</span></span>
                            <span class="mb-2 text-xs">Monto: <span class="text-dark ms-sm-2 font-weight-bold">$255</span></span>
                            <span class="text-xs">ID Nota: <span class="text-dark ms-sm-2 font-weight-bold">#52</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="text-warning text-gradient px-3 mb-0"><i class="fa fa-graduation-cap me-2"></i>Nota Cursos</a>
                            <a class="btn btn-link text-dark px-3 mb-0" href="#" target="_blank"><i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>Ver</a>
                        </div>
                    </li>

            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-5 mt-md-0 mt-4">
        <div class="card h-100 mb-4">
          <div class="card-header pb-0 px-3">
            <div class="row">
              <div class="col-md-6">
                <h6 class="mb-0">Notas Productos</h6>
              </div>
              <div class="col-md-6 d-flex justify-content-end align-items-center">
                <i class="far fa-calendar-alt me-2"></i>
                <small>63/85</small>
              </div>
            </div>
          </div>
          <div class="card-body pt-4 p-3">
            <ul class="list-group">

                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                        <div class="d-flex flex-column">
                            <h6 class="mb-3 text-sm">hkh j yty</h6>
                            <span class="mb-2 text-xs">Fecha: <span class="text-dark font-weight-bold ms-sm-2">45</span></span>
                            <span class="mb-2 text-xs">Monto: <span class="text-dark ms-sm-2 font-weight-bold">$562</span></span>
                            <span class="text-xs">ID Nota: <span class="text-dark ms-sm-2 font-weight-bold">#10</span></span>
                        </div>
                        <div class="ms-auto text-end">
                            <a class="text-success text-gradient px-3 mb-0"><i class="fa fa-shopping-bag me-2"></i><b> Nota Productos </b></a>
                        </div>
                    </li>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('datatable')

@endsection


