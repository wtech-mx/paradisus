@extends('layouts.app')

@section('template_title')
    Encuestas Satisfacion
@endsection
<style>
    .carousel-text {
    overflow: hidden;
    height: 1.5em; /* Altura máxima para mostrar un párrafo a la vez */
}

.carousel-text p {
    margin: 0;
    padding: 0;
    opacity: 0;
    transition: opacity 1s;
    display: none;
}

.carousel-text p.active {
    opacity: 1;
    display: block;
}

.carousel-badge .badge {
    display: none;
}

.carousel-badge .badge.active {
    display: inline-block;
}
</style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <form action="{{ route('advance_search.encuestas') }}" method="GET" >

                                        <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                            <h5>Filtros</h5>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label for="user_id">Tipo de encuesta:</label>
                                                        <select class="form-control" name="tipo" id="tipo" required>
                                                            <option selected value="">seleccionar</option>
                                                                <option value="Facial">Facial</option>
                                                                <option value="Corporal">Corporal</option>
                                                                <option value="Experiencia + Jacuzzi">Experiencia + Jacuzzi</option>
                                                                <option value="Experiencias">Experiencias</option>
                                                                <option value="Jacuzzi">Jacuzzi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3 ml-3">
                                                        <label class="form-label">Del</label>
                                                        <div class="input-group">
                                                            <input name="fecha" class="form-control"
                                                                type="date" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <label class="form-label">Al</label>
                                                        <div class="input-group">
                                                            <input  name="fecha2" type="date" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <br>
                                                        <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                                    </div>
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if(Route::currentRouteName() != 'index.encuestas')
                @include('encuestas.vista_admin.dos_graficas')
            @endif
        </div>
    </div>
</div>
@endsection

@section('datatable')
<script>
    $(document).ready(function() {
        // Variables
        var $carouselText = $('.carousel-text');
        var $paragraphs = $carouselText.find('p');
        var $badges = $('.carousel-badge .badge');
        var currentIndex = 0;

        // Función para mostrar el próximo elemento en el carrusel
        function showNextElement() {
            $paragraphs.removeClass('active');
            $badges.removeClass('active');

            $paragraphs.eq(currentIndex).addClass('active');
            $badges.eq(currentIndex).addClass('active');

            currentIndex = (currentIndex + 1) % $paragraphs.length;

            setTimeout(showNextElement, 5000); // Cambia el elemento cada 3 segundos
        }

        // Inicializa el carrusel
        showNextElement(); // Muestra el primer elemento de inmediato
    });

    $(document).ready(function() {
        var $carousel = $('.carousel');
        $carousel.carousel(); // Inicializa el carrusel

        // Función para mostrar el próximo elemento en el carrusel
        function showNextElement() {
            $carousel.carousel('next'); // Cambia al próximo elemento en el carrusel

            setTimeout(showNextElement, 5000); // Cambia el elemento cada 3 segundos
        }

        // Inicializa el carrusel
        showNextElement(); // Muestra el primer elemento de inmediato
    });
</script>

<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>

    @if(Route::currentRouteName() != 'index.encuestas')
        <script>
            var ctx10 = document.getElementById("polar-chart").getContext("2d");
            new Chart(ctx10, {
            //   type: "pie",
            type: "doughnut",
            data: {
                labels: [
                'Poco probable',
                'Algo poco probable',
                'Neutral',
                'Probable',
                'Bastante probable',
                ],
                datasets: [{
                label: 'My First Dataset',
                data: [{{$conteoPorTipo["Poco probable"]}}, {{$conteoPorTipo["Algo poco probable"]}},{{ $conteoPorTipo["Neutral"]}}, {{$conteoPorTipo["Probable"]}}, {{$conteoPorTipo["Bastante probable"]}}],
                backgroundColor: ['#2152ff', '#dab95e', '#f53939', '#5bbd94', '#ae5ee4'],
                }]
            },
            options: {
                plugins: {
                legend: {
                    display: false,
                }
                }
            }
            });

            var ctx11 = document.getElementById("polar-chart2").getContext("2d");
            new Chart(ctx11, {
            //   type: "pie",
            type: "doughnut",
            data: {
                labels: [
                'Muy mala',
                'Mala',
                'Neutral',
                'Buena',
                'Muy buena',
                ],
                datasets: [{
                label: 'My First Dataset',
                data: [{{$conteoPorTipoP4["Muy mala"]}}, {{$conteoPorTipoP4["Mala"]}},{{ $conteoPorTipoP4["Neutral"]}}, {{$conteoPorTipoP4["Buena"]}}, {{$conteoPorTipoP4["Muy buena"]}}],
                backgroundColor: ['#2152ff', '#dab95e', '#f53939', '#5bbd94', '#ae5ee4'],
                }]
            },
            options: {
                plugins: {
                legend: {
                    display: false,
                }
                }
            }
            });

            var ctx = document.getElementById("stacked-bar-chart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ['Productos en flyer', 'Aromaterapia', 'Sugar Honey Pies', 'Vino y Fresas', 'Sugar Honey Manos', 'Cuarzo'], // Etiquetas de las barras (si es necesario)
                    datasets: [
                        {
                            label: "Sí",
                            data: <?php echo json_encode($siCounts); ?>,
                            backgroundColor: 'rgba(0, 123, 255, 0.7)',
                        },
                        {
                            label: "No",
                            data: <?php echo json_encode($noCounts); ?>,
                            backgroundColor: 'rgba(255, 0, 0, 0.7)',
                        },
                    ]
                },
                options: {
                    scales: {
                        x: {
                            stacked: true // Apila las barras horizontalmente
                        },
                        y: {
                            stacked: true // Apila las barras verticalmente
                        }
                    }
                }
            });

        </script>
    @endif

@endsection
