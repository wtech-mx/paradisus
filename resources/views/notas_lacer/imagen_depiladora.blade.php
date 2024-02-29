@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Facial/Corporal
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">

@endsection

@section('content')

<style>

    body{
        background-color: #ccc;
        padding: 30px;
    }

    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{ width: 100% !important; height: auto;}

    .tab-pane{
        padding: 15px 15px 15px 15px;
    }
    .custom_col{

    }
    .icon-bar {
    position: fixed;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 10;
    right: 0;
    }

    .icon-bar a {
    display: block;
    text-align: center;
    padding: 16px;
    transition: all 0.3s ease;
    color: white;
    font-size: 20px;
    }

    .icon-bar a:hover {
    background-color: #000;
    }
    .content {
    margin-left: 75px;
    font-size: 30px;
    }

    .facebook {
    background: #D7819D;
    color: white;
    }

    @media only screen and (max-width: 450px) {
        .text-res {
        font-size: 12px
    }
    }

</style>

<main class="main-content main-content-bg mt-0">
      <div class="container" style="    background: #ccc;">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 p-3">
                <div class="row p-3">
                    <div class="col-12">

                        <h5 class=" text-center mt-5 mb-3" style="color:#C45584;font-weight: 800;font-size: 30px;">
                           Area
                        </h5>

                        <div class="row">

                            <div class="col-12">
                                <div class="d-flex justify-content-between">

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/face.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Face
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/arm.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Arm
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/armpit.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                armpit
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/back.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Back
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/abdomen.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Abdomen
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/bikini.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Bikini
                                            </label>
                                        </div>
                                    </div>

                                    <div class="container_cards">
                                        <img src="{{ asset('assets/img/leg.jpg') }}"  style="width: 110px;display:block">

                                        <div class="form-check" style="display:block;">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Leg
                                            </label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col 4">
                    <div class="card_sub">
                        <div class="row">
                            <div class="col-13">
                                <h5>SKYN TYPE</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4"></div>
                <div class="col-2"></div>
                <div class="col-2"></div>
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
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>




@endsection
