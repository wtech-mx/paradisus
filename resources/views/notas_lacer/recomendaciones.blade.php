@extends('clientes.layout.app')


@section('template_title')
    Recomendaciones
@endsection

@section('css')


@endsection

@section('content')

<main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="backgorund:#000;">
      <span class="mask bg-gradient-dark opacity-6" style="    background: #ccc;"></span>
      <div class="container" style="    background: #ccc;">
        <div class="row justify-content-center">

          <div class="col-12 col-md-9 ">
            <div class="card border-0 mb-0">

                <h5 class=" text-center mt-5 mb-3" style="color:#C45584;font-weight: 800;font-size: 30px;">
                    Recomendaciones para antes y despues de tu cita
                </h5>

                <ul class="nav nav-pills mb-3 mx-auto" id="pills-tab" role="tablist">

                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Antes
                      </button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Despues
                      </button>
                    </li>
                  </ul>

                  <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">
                                    <img src="{{ asset('assets/recoemndaciones.jpg') }}" alt="" class="" style="width:90%;border-radius:9px">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">
                                    <img src="{{ asset('assets/recomendaciones_2.jpg') }}" alt="" class="" style="width:90%;border-radius:9px">
                                </p>
                            </div>
                        </div>
                    </div>
                  </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('js_custom')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



</script>
@endsection
