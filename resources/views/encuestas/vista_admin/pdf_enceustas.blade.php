<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte PDF</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Estilos para el contenedor principal */
        .container {
            width: 100%;
            padding: 0px;
            margin: 0;
            top: 0;
        }

        /* Estilos para cada tarjeta */
        .card {
            background: #fde9ef;
            border-radius: 9px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
        }

        /* Otros estilos para el contenido dentro de las tarjetas */
        .card h5 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #d32156;
        }

        .card ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .card ul li {
            font-size: 14px;
            color: #6b0020;
            margin-bottom: 10px;
            width: 330px;
            display: inline-block;
        }
    </style>
</head>
<body>

    <h5 class="">{!! $rango_fechas !!}</h5>
    <div class="container">
        <h5>Facial y Corporal</h5>
        @foreach ($reportes as $item)
            <div class="card">
                <div class="info">
                    <p>Cliente: <strong>{{ $item->nombre }}</strong> - Telefono: <strong>{{ $item->telefono }}</strong> - Cosmetologa: <strong>{{ $item->User->name }}</strong> ID Nota <strong>{{ $item->id_nota }}</strong></p>
                </div>
                <ul>
                    <li>
                        1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                    <li>
                        2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                    <li>
                        3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                    <li>
                        4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                    <li>
                        5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                    <li>
                        6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                    <li>
                       <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>


    <div class="container">
        <h5>Experiencia + Jacuzzi</h5>
        @foreach ($reportes_exp_ja as $item)
            <div class="card" style="background: #f6e9fd!important;">
                <div class="info">
                    <p>Cliente: <strong>{{ $item->nombre }}</strong> - Telefono: <strong>{{ $item->telefono }}</strong> - Cosmetologa: <strong>{{ $item->User->name }}</strong> ID Nota <strong>{{ $item->id_nota }}</strong></p>
                </div>
                <ul>
                    <li>
                        1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                    <li>
                        2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                    <li>
                        3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                    <li>
                        4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                    <li>
                        5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                    <li>
                        6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                    <li>
                        7- ¿Te exfoliaron los pies con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p10 }}</strong></li> </li>
                    <li>
                        8- ¿Te ofrecieron <br> Vino y chocolates? <strong style="color: #6b0020;">{{ $item->p11 }}</strong></li> </li>
                    <li>
                        9- ¿Te exfoliaron las manos con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li> </li>
                    <li>
                        10- ¿Te dieron cuarzo <br> de amistad o amor? <strong style="color: #6b0020;">{{ $item->p13 }}</strong></li> </li>
                        <br>
                       <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>

    {{-- <div class="container">
        <h5 class=""> Brow Bar & Lash Lifting</h5>
        @foreach ($reportes_brow as $item)
            <div class="card" style="background: #ebe9fd!important;">
                <div class="info">
                    <p>Cliente: <strong>{{ $item->nombre }}</strong> - Telefono: <strong>{{ $item->telefono }}</strong> - Cosmetologa: <strong>{{ $item->User->name }}</strong> ID Nota <strong>{{ $item->id_nota }}</strong></p>
                </div>
                <ul>
                    <li>
                        1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong>
                    </li>
                    <li>
                        2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong>
                    </li>
                    <li>
                        3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong>
                    </li>
                    <li>
                        4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong>
                    </li>
                    <li>
                        5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong>
                    </li>
                    <li>
                        6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong>
                    </li>
                    <li>
                        7- ¿Aplicaron todos los productos <br> mencionados en el flyer publicitario? <strong style="color: #6b0020;">{{ $item->p5 }}</strong>
                    </li>
                    <li>
                        8- ¿Cómo calificas la calidad y <br> limpieza de las cabinas? <strong style="color: #6b0020;">{{ $item->p8 }}</strong>
                    </li>
                    <li>
                       <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                    </li>
                </ul>
            </div>
        @endforeach
    </div> --}}

    <div class="container">
        <h5 class=""> Experiencias</h5>
        @foreach ($reportes_brow as $item)
            <div class="card" style="background: #f9f3d4!important;">
                <div class="info">
                    <p>Cliente: <strong>{{ $item->nombre }}</strong> - Telefono: <strong>{{ $item->telefono }}</strong> - Cosmetologa: <strong>{{ $item->User->name }}</strong> ID Nota <strong>{{ $item->id_nota }}</strong></p>
                </div>
                <ul>
                    <li>
                        1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>

                    <li>
                        2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li>

                    <li>
                        3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li>

                    <li>
                        4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li>

                    <li>
                        5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li>

                    <li>
                        6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li>

                    <li>
                        7- ¿Masaje en <br> pareja o amigas? <strong style="color: #6b0020;">{{ $item->p17 }}</strong></li>
                    <li>
                        8- ¿Te exfoliaron los pies con <br> Sugar Honey? <strong style="color: #6b0020;">{{ $item->p10 }}</strong></li>
                    <li>
                        8-¿Te ofrecieron <br> Vino y chocolates? <strong style="color: #6b0020;">{{ $item->p11 }}</strong></li>
                    <li>
                        8- ¿Te exfoliaron las manos <br> con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li>
                    <li>
                        8- ¿Te dieron cuarzo <br> de amistad o amor? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li>
                    <li>
                       <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>


</body>
</html>
