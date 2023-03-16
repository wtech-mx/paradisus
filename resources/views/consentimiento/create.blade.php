@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Facial
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css') }}">

@endsection

@section('content')

<style>
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
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9">
            <div class="card border-0 mb-0">

              <div class="card-header bg-transparent">
                <h5 class="text-dark text-center mt-2 mb-3">Bienvenid@ :
                    <br>

                </h5>
              </div>

              <div class="card-body px-lg-3 pt-0">
                <div class="text-center text-muted mb-4">
                  <small></small>
                </div>
                <form method="POST" action="{{ route('clients_consentimiento.user', $ConsentimientoCorporal->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Enfermedades</label>
                                <div class="row">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="renales" id="renales" name="renales">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Renales
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="digestivas" id="digestivas" name="digestivas">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Digestivas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="circulatorias" id="circulatorias" name="circulatorias">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Circulatorias
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="diabetes" id="diabetes" name="diabetes">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Diabetes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Presión arterial" id="presion_arterial" name="presion_arterial">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Presión arterial
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Sistema nervioso" id="sistema_nervioso" name="sistema_nervioso">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Sistema nervioso
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="tiroides" id="tiroides" name="tiroides">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Tiroides
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="anorexia" id="anorexia" name="anorexia">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Anorexia
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="bulimia" id="bulimia" name="bulimia">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Bulimia
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="obesidad" id="obesidad" name="obesidad">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Obesidad
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="fobias" id="fobias" name="fobias">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Fobias
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="convulsiones" id="convulsiones" name="convulsiones">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Convulsiones
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Problemas cardíacos" id="problemas_cardiacos" name="problemas_cardiacos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Problemas cardíacos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Problemas óseos" id="problemas_oseos" name="problemas_oseos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Problemas óseos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="queloides" id="queloides" name="queloides">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Queloides
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="cancer" id="cancer" name="cancer">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Cáncer
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="embarazo" id="embarazo" name="embarazo">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Embarazo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="alcohol" id="alcohol" name="alcohol">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Alcohol
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="cigarrillo" id="cigarrillo" name="cigarrillo">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Cigarrillo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="herpes" id="herpes" name="herpes">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Herpes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="celulitis" id="celulitis" name="celulitis">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Celulitis
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="flacidez" id="flacidez" name="flacidez">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Flacidez
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="varices" id="varices" name="varices">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Varices
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Realizas hábitos de limpieza facial? *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta2" name="pregunta2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta2" name="pregunta2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta2_otro" name="pregunta2_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Selecciona si realizas/utilizas/tomas alguna de estas:*</label>
                                <div class="row">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="dieta" id="dieta" name="dieta">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Dieta
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Protección de la piel" id="proteccion_piel" name="proteccion_piel">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Protección de la piel
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="maquillaje" id="maquillaje" name="maquillaje">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Maquillaje
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="deporte" id="deporte" name="deporte">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Deporte
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="corticoides" id="corticoides" name="corticoides">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Corticoides
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="antidepresivos" id="antidepresivos" name="antidepresivos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Antidepresivos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Anticonceptivos hormonales" id="anticonceptivos_hormonales" name="anticonceptivos_hormonales">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Anticonceptivos hormonales
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="diureticos" id="diureticos" name="diureticos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Diureticos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Carotenos u otros pigmentos" id="carotenos_pigmentos" name="carotenos_pigmentos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Carotenos u otros pigmentos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Vitamina a,b,c" id="vitamina" name="vitamina">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Vitamina a,b,c
                                            </label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Problemas en la piel</label>
                                <p class="text-res"><strong>En respuesta otra:</strong> <br> En caso de tener algún problema de la piel, menciónalo. <br>
                                     <strong>PARADISUS SPA TE INFORMA:</strong> <br>
                                     EN CASO DE OMITIR ALGUNO DE ESTOS PROBLEMAS, LAS COSMETÓLOGAS INFORMARÁN DE INMEDIATO A RECEPCIÓN POR HABER OMITIDO LA INFORMACIÓN, TENDRAS QUE RETIRARTE DE LAS INSTALACIONES SIN DEVOLUCIÓN MONETARIA ALGUNA.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Hongos en pies" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Hongos en pies
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Problemas vaginales" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Problemas vaginales
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta4_otro" name="pregunta4_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Tratamientos dermatológicos:</label>
                                <p>En respuesta otra: En caso de tener algún tratamiento dermatológico, menciónalo.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta5" name="pregunta5">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta5" name="pregunta5">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta5_otro" name="pregunta5_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alteraciones menstruales:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta6" name="pregunta6">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta6" name="pregunta6">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta6_otro" name="pregunta6_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alergias:</label>
                                <p>En respuesta otra: En caso de tener alguna alergia, menciónala.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta7" name="pregunta7">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta7" name="pregunta7">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta7_otro" name="pregunta7_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Operaciones estéticas/plásticas/dentales</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta8_otro" name="pregunta8_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Selecciona si cuentas con alguna de estas</label>
                                <div class="row">
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="antidepresivos" id="antidepresivos" name="antidepresivos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Antidepresivos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="somniferos" id="somniferos" name="somniferos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Somníferos
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="drogas" id="drogas" name="drogas">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Drogas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="marcapasos" id="marcapasos" name="marcapasos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Marcapasos
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="protesis" id="protesis" name="protesis">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Prótesis
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="placas" id="placas" name="placas">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Placas
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="mesoterapia" id="mesoterapia" name="mesoterapia">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Mesoterapia
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Dispositivo intrauterino" id="dispositivo_intrauterino" name="dispositivo_intrauterino">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Dispositivo intrauterino
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Dispositivo cardiaco" id="dispositivo_cardiaco" name="dispositivo_cardiaco">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Dispositivo cardiaco
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="suplementos" id="suplementos" name="suplementos">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Suplementos
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Medicamentos controlados</label>
                                <p class="text-res"><strong>En respuesta otra:</strong> <br> En caso de tomar algún medicamento controlado, menciónalo.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Si" id="pregunta10" name="pregunta10">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="No" id="pregunta10" name="pregunta10">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta10_otro" name="pregunta10_otro" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Te has sometido a alguna cirugía estética?
                                    *</label>
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="ninguna" id="ninguna" name="ninguna">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Ninguna
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="histerectomia" id="histerectomia" name="histerectomia">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Histerectomía
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="cesarea" id="cesarea" name="cesarea">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Cesárea
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="tiroides" id="tiroides_11" name="tiroides_11">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Tiroides
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="bucodental" id="bucodental" name="bucodental">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Bucodental
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="botox" id="botox" name="botox">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Botox
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Hilos tensores" id="hilos_tensores" name="hilos_tensores">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Hilos tensores
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="mesoterapia" id="mesoterapia_11" name="mesoterapia_11">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mesoterapia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="name">Otros:</label>
                                                <input id="pregunta11_otro" name="pregunta11_otro" type="text" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection

@section('js_custom')
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.signature.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js'></script>

<script type="text/javascript">
    var sig_pago = $('#sig_pago').signature({syncField: '#signed_pago', syncFormat: 'PNG'});

    $('#clear_pago').click(function (e) {
        e.preventDefault();
        sig_pago.signature('clear');
        $("#signed_pago").val('');
    });
</script>
@endsection
