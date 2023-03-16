@extends('clientes.layout.app')


@section('template_title')
    Consentimiento Facial
@endsection

@section('client_app')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.signature.css')}}">
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
</style>

<main class="main-content main-content-bg mt-0">
    <div class="page-header min-vh-100" style="background-image: url('https://img.freepik.com/foto-gratis/composicion-spa-articulos-cuidado-corporal-luz_169016-4162.jpg?w=1380&t=st=1673891361~exp=1673891961~hmac=c4906a893a92ac918c550c104ff3007b935c475c8b53275e4b26bebee610d48f');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-7">
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
                {{-- <form method="POST" action="{{ route('clients.update', $client->id) }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="_method" value="PATCH"> --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Enfermedades</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="renales" name="renales">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Renales
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="digestivas" name="digestivas">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Digestivas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="circulatorias" name="circulatorias">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Circulatorias
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="diabetes" name="diabetes">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Diabetes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="presion_arterial" name="presion_arterial">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Presión arterial
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="sistema_nervioso" name="sistema_nervioso">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Sistema nervioso
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="tiroides" name="tiroides">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tiroides
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="anorexia" name="anorexia">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Anorexia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="bulimia" name="bulimia">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Bulimia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="obesidad" name="obesidad">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Obesidad
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="fobias" name="fobias">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Fobias
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="convulsiones" name="convulsiones">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Convulsiones
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="problemas_cardiacos" name="problemas_cardiacos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Problemas cardíacos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="problemas_oseos" name="problemas_oseos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Problemas óseos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="queloides" name="queloides">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Queloides
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="cancer" name="cancer">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Cáncer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="embarazo" name="embarazo">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Embarazo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="alcohol" name="alcohol">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Alcohol
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="cigarrillo" name="cigarrillo">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Cigarrillo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="herpes" name="herpes">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Herpes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="celulitis" name="celulitis">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Celulitis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flacidez" name="flacidez">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Flacidez
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="varices" name="varices">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Varices
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Realizas hábitos de limpieza facial? *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta2" name="pregunta2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta2" name="pregunta2">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta2" name="pregunta2" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Selecciona si realizas/utilizas/tomas alguna de estas:
                                    *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="dieta" name="dieta">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Dieta
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="proteccion_piel" name="proteccion_piel">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Protección de la piel
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="maquillaje" name="maquillaje">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Maquillaje
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="deporte" name="deporte">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Deporte
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="corticoides" name="corticoides">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Corticoides
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="antidepresivos" name="antidepresivos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Antidepresivos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="anticonceptivos_hormonales" name="anticonceptivos_hormonales">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Anticonceptivos hormonales
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="diureticos" name="diureticos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Diureticos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="carotenos_pigmentos" name="carotenos_pigmentos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Carotenos u otros pigmentos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="vitamina" name="vitamina">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Vitamina a,b,c
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Problemas en la piel</label>
                                <p>En respuesta otra: En caso de tener algún problema de la piel, menciónalo. PARADISUS SPA TE INFORMA:EN CASO DE OMITIR ALGUNO DE ESTOS PROBLEMAS, LAS COSMETÓLOGAS INFORMARÁN DE INMEDIATO A RECEPCIÓN POR HABER OMITIDO LA INFORMACIÓN, TENDRAS QUE RETIRARTE DE LAS INSTALACIONES SIN DEVOLUCIÓN MONETARIA ALGUNA.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Hongos en pies
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta4" name="pregunta4">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Problemas vaginales
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta4" name="pregunta4" type="text" class="form-control" >
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
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta5" name="pregunta5">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta5" name="pregunta5">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta5" name="pregunta5" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alteraciones menstruales:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta6" name="pregunta6">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta6" name="pregunta6">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta6" name="pregunta6" type="text" class="form-control" >
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
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta7" name="pregunta7">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta7" name="pregunta7">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta7" name="pregunta7" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Operaciones estéticas/plásticas/dentales</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta8" name="pregunta8" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Selecciona si cuentas con alguna de estas</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="antidepresivos" name="antidepresivos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Antidepresivos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="somniferos" name="somniferos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Somníferos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="drogas" name="drogas">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Drogas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="marcapasos" name="marcapasos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Marcapasos
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="protesis" name="protesis">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Prótesis
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="placas" name="placas">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Placas
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="mesoterapia" name="mesoterapia">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mesoterapia
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="dispositivo_intrauterino" name="dispositivo_intrauterino">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Dispositivo intrauterino
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="dispositivo_cardiaco" name="dispositivo_cardiaco">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Dispositivo cardiaco
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="suplementos" name="suplementos">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Suplementos
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Medicamentos controlados</label>
                                <p>En respuesta otra: En caso de tomar algún medicamento controlado, menciónalo.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Si
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="pregunta8" name="pregunta8">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta8" name="pregunta8" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">¿Te has sometido a alguna cirugía estética?
                                    *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="ninguna" name="ninguna">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Ninguna
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="histerectomia" name="histerectomia">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Histerectomía
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="cesarea" name="cesarea">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Cesárea
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="tiroides" name="tiroides">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Tiroides
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="bucodental" name="bucodental">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Bucodental
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="botox" name="botox">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Botox
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="hilos_tensores" name="hilos_tensores">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Hilos tensores
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="mesoterapia" name="mesoterapia">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Mesoterapia
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label for="name">Otros:</label>
                                    <input id="pregunta8" name="pregunta8" type="text" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>
{{-- 
                </form> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" href="{{ asset('assets/js/jquery.signature.js')}}"></script>
@endsection
