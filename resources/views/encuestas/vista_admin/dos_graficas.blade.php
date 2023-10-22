<div class="row">
    <div class="col-12">
        <div class="col-12">
            <h5 class="p-3">{!! $rango_fechas !!}</h5>
        </div>

        <div class="table-responsive">
            <h5 class="p-3">Facial y Corporal</h5>
            <table class="table table-flush" id="datatable-search">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Cosmetologa</th>
                        <th>Cliente</th>
                        <th>Comentario</th>
                        <th>¿Qué tan probable es <br> que nos recomiendes?</th>
                        <th>¿Qué tan buena fue <br> la atención? </th>
                        <th>¿Cómo calificas la atención <br> en Redes Sociales?</th>
                        <th>¿Respondieron todas <br> tus dudas?</th>
                        <th>¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo?</th>
                        <th>¿Se cumplió el tiempo <br> de sesión?</th>
                    </tr>
                </thead>

                @foreach ($reportes as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @php
                            $nombrecomse = $item->User->name;
                            $nombrecomse = str_replace('Curso de ', '', $nombrecomse);
                            $nombrecomse = str_replace('Curso ', '', $nombrecomse);

                            $palabras = explode(' ', $nombrecomse);

                            // Inicializa la cadena formateada
                            $nombre_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $nombre_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $nombre_formateado !!}
                    </td>
                    <td>
                        @php
                            $nombrecliente = $item->nombre;
                            $nombrecliente = str_replace('Curso de ', '', $nombrecliente);
                            $nombrecliente = str_replace('Curso ', '', $nombrecliente);

                            $palabras = explode(' ', $nombrecliente);

                            // Inicializa la cadena formateada
                            $cliente_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $cliente_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $cliente_formateado .= "<br>";
                                }
                            }
                        @endphp

                        {!! $cliente_formateado !!}
                        <br>
                        {{ $item->telefono }}
                    </td>
                    <td>
                        @php
                            $nombrecoemntario = $item->comentario;
                            $nombrecoemntario = str_replace('Curso de ', '', $nombrecoemntario);
                            $nombrecoemntario = str_replace('Curso ', '', $nombrecoemntario);

                            $palabras = explode(' ', $nombrecoemntario);

                            // Inicializa la cadena formateada
                            $comentario_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $comentario_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 4 == 0) {
                                    $comentario_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $comentario_formateado !!}
                    </td>
                    <td>{{ $item->p1 }}</td>
                    <td>{{ $item->p2 }}</td>
                    <td>{{ $item->p3 }}</td>
                    <td>{{ $item->p4 }}</td>
                    <td>{{ $item->p7 }}</td>
                    <td>{{ $item->p14 }} <br>

                        @php
                            $nombrep15 = $item->p15;
                            $nombrep15 = str_replace('Curso de ', '', $nombrep15);
                            $nombrep15 = str_replace('Curso ', '', $nombrep15);

                            $palabras = explode(' ', $nombrep15);

                            // Inicializa la cadena formateada
                            $nombre_formateadop15 = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateadop15 .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 3 == 0) {
                                    $nombre_formateadop15 .= "<br>";
                                }
                            }
                        @endphp


                        {!! $nombre_formateadop15 !!}
                    </td>
                </tr>
                @endforeach

            </table>
        </div>

        <div class="table-responsive">
            <h5 class="p-3">Brow Bar & Lash Lifting</h5>
            <table class="table table-flush" id="datatable-search2">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Cosmetologa</th>
                        <th>Cliente</th>
                        <th>Comentario</th>
                        <th>¿Qué tan probable es <br> que nos recomiendes?</th>
                        <th>¿Qué tan buena fue <br> la atención? </th>
                        <th>¿Cómo calificas la atención <br> en Redes Sociales?</th>
                        <th>¿Respondieron todas <br> tus dudas?</th>
                        <th>¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo?</th>
                        <th>¿Se cumplió el tiempo <br> de sesión?</th>
                        <th>¿Aplicaron todos los productos <br> mencionados en el flyer publicitario?</th>
                        <th>¿Cómo calificas la calidad y <br> limpieza de las cabinas?</th>
                    </tr>
                </thead>

                @foreach ($reportes_brow as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @php
                            $nombrecomse = $item->User->name;
                            $nombrecomse = str_replace('Curso de ', '', $nombrecomse);
                            $nombrecomse = str_replace('Curso ', '', $nombrecomse);

                            $palabras = explode(' ', $nombrecomse);

                            // Inicializa la cadena formateada
                            $nombre_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $nombre_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $nombre_formateado !!}
                    </td>
                    <td>
                        @php
                            $nombrecliente = $item->nombre;
                            $nombrecliente = str_replace('Curso de ', '', $nombrecliente);
                            $nombrecliente = str_replace('Curso ', '', $nombrecliente);

                            $palabras = explode(' ', $nombrecliente);

                            // Inicializa la cadena formateada
                            $cliente_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $cliente_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $cliente_formateado .= "<br>";
                                }
                            }
                        @endphp

                        {!! $cliente_formateado !!}
                        <br>
                        {{ $item->telefono }}
                    </td>
                    <td>
                        @php
                            $nombrecoemntario = $item->comentario;
                            $nombrecoemntario = str_replace('Curso de ', '', $nombrecoemntario);
                            $nombrecoemntario = str_replace('Curso ', '', $nombrecoemntario);

                            $palabras = explode(' ', $nombrecoemntario);

                            // Inicializa la cadena formateada
                            $comentario_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $comentario_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 4 == 0) {
                                    $comentario_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $comentario_formateado !!}
                    </td>
                    <td>{{ $item->p1 }}</td>
                    <td>{{ $item->p2 }}</td>
                    <td>{{ $item->p3 }}</td>
                    <td>{{ $item->p4 }}</td>
                    <td>{{ $item->p7 }}</td>
                    <td>{{ $item->p14 }} <br>

                        @php
                            $nombrep15 = $item->p15;
                            $nombrep15 = str_replace('Curso de ', '', $nombrep15);
                            $nombrep15 = str_replace('Curso ', '', $nombrep15);

                            $palabras = explode(' ', $nombrep15);

                            // Inicializa la cadena formateada
                            $nombre_formateadop15 = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateadop15 .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 3 == 0) {
                                    $nombre_formateadop15 .= "<br>";
                                }
                            }
                        @endphp


                        {!! $nombre_formateadop15 !!}
                    </td>
                    <td>{{ $item->p5 }}</td>
                    <td>{{ $item->p8 }}</td>
                </tr>
                @endforeach

            </table>
        </div>

        <div class="table-responsive">
            <h5 class="p-3">Experiencia + Jacuzzi</h5>
            <table class="table table-flush" id="datatable-search3">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Cosmetologa</th>
                        <th>Cliente</th>
                        <th>Comentario</th>
                        <th>¿Qué tan probable es <br> que nos recomiendes?</th>
                        <th>¿Qué tan buena fue <br> la atención? </th>
                        <th>¿Cómo calificas la atención <br> en Redes Sociales?</th>
                        <th>¿Respondieron todas <br> tus dudas?</th>
                        <th>¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo?</th>
                        <th>¿Se cumplió el tiempo <br> de sesión?</th>
                        <th>¿Te exfoliaron los pies con Sugar Honey?</th>
                        <th>¿Te ofrecieron <br> Vino y Fresas?</th>
                        <th>¿Te exfoliaron las manos con Sugar Honey?</th>
                        <th>¿Te dieron cuarzo <br> de amistad o amor?</th>
                    </tr>
                </thead>

                @foreach ($reportes_exp_ja as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @php
                            $nombrecomse = $item->User->name;
                            $nombrecomse = str_replace('Curso de ', '', $nombrecomse);
                            $nombrecomse = str_replace('Curso ', '', $nombrecomse);

                            $palabras = explode(' ', $nombrecomse);

                            // Inicializa la cadena formateada
                            $nombre_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $nombre_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $nombre_formateado !!}
                    </td>
                    <td>
                        @php
                            $nombrecliente = $item->nombre;
                            $nombrecliente = str_replace('Curso de ', '', $nombrecliente);
                            $nombrecliente = str_replace('Curso ', '', $nombrecliente);

                            $palabras = explode(' ', $nombrecliente);

                            // Inicializa la cadena formateada
                            $cliente_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $cliente_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $cliente_formateado .= "<br>";
                                }
                            }
                        @endphp

                        {!! $cliente_formateado !!}
                        <br>
                        {{ $item->telefono }}
                    </td>
                    <td>
                        @php
                            $nombrecoemntario = $item->comentario;
                            $nombrecoemntario = str_replace('Curso de ', '', $nombrecoemntario);
                            $nombrecoemntario = str_replace('Curso ', '', $nombrecoemntario);

                            $palabras = explode(' ', $nombrecoemntario);

                            // Inicializa la cadena formateada
                            $comentario_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $comentario_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 4 == 0) {
                                    $comentario_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $comentario_formateado !!}
                    </td>
                    <td>{{ $item->p1 }}</td>
                    <td>{{ $item->p2 }}</td>
                    <td>{{ $item->p3 }}</td>
                    <td>{{ $item->p4 }}</td>
                    <td>{{ $item->p7 }}</td>
                    <td>{{ $item->p14 }} <br>

                        @php
                            $nombrep15 = $item->p15;
                            $nombrep15 = str_replace('Curso de ', '', $nombrep15);
                            $nombrep15 = str_replace('Curso ', '', $nombrep15);

                            $palabras = explode(' ', $nombrep15);

                            // Inicializa la cadena formateada
                            $nombre_formateadop15 = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateadop15 .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 3 == 0) {
                                    $nombre_formateadop15 .= "<br>";
                                }
                            }
                        @endphp


                        {!! $nombre_formateadop15 !!}
                    </td>
                    <td>{{ $item->p10 }}</td>
                    <td>{{ $item->p11 }}</td>
                    <td>{{ $item->p12 }}</td>
                    <td>{{ $item->p13 }}</td>
                </tr>
                @endforeach

            </table>
        </div>

        <div class="table-responsive">
            <h5 class="p-3">Experiencias</h5>
            <table class="table table-flush" id="datatable-search4">
                <thead class="thead">
                    <tr>
                        <th>No</th>
                        <th>Cosmetologa</th>
                        <th>Cliente</th>
                        <th>Comentario</th>
                        <th>¿Qué tan probable es <br> que nos recomiendes?</th>
                        <th>¿Qué tan buena fue <br> la atención? </th>
                        <th>¿Cómo calificas la atención <br> en Redes Sociales?</th>
                        <th>¿Respondieron todas <br> tus dudas?</th>
                        <th>¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo?</th>
                        <th>¿Se cumplió el tiempo <br> de sesión?</th>
                        <th>¿Masaje en <br> pareja o amigas?</th>
                        <th>¿Te exfoliaron los pies con <br> Sugar Honey?</th>
                        <th>¿Te ofrecieron <br> Vino y Fresas?</th>
                        <th>¿Te exfoliaron las manos <br> con Sugar Honey?</th>
                        <th>¿Te dieron cuarzo <br> de amistad o amor?</th>
                    </tr>
                </thead>

                @foreach ($reportes_exp as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        @php
                            $nombrecomse = $item->User->name;
                            $nombrecomse = str_replace('Curso de ', '', $nombrecomse);
                            $nombrecomse = str_replace('Curso ', '', $nombrecomse);

                            $palabras = explode(' ', $nombrecomse);

                            // Inicializa la cadena formateada
                            $nombre_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $nombre_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $nombre_formateado !!}
                    </td>
                    <td>
                        @php
                            $nombrecliente = $item->nombre;
                            $nombrecliente = str_replace('Curso de ', '', $nombrecliente);
                            $nombrecliente = str_replace('Curso ', '', $nombrecliente);

                            $palabras = explode(' ', $nombrecliente);

                            // Inicializa la cadena formateada
                            $cliente_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $cliente_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 2 == 0) {
                                    $cliente_formateado .= "<br>";
                                }
                            }
                        @endphp

                        {!! $cliente_formateado !!}
                        <br>
                        {{ $item->telefono }}
                    </td>
                    <td>
                        @php
                            $nombrecoemntario = $item->comentario;
                            $nombrecoemntario = str_replace('Curso de ', '', $nombrecoemntario);
                            $nombrecoemntario = str_replace('Curso ', '', $nombrecoemntario);

                            $palabras = explode(' ', $nombrecoemntario);

                            // Inicializa la cadena formateada
                            $comentario_formateado = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $comentario_formateado .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 4 == 0) {
                                    $comentario_formateado .= "<br>";
                                }
                            }
                        @endphp
                        {!! $comentario_formateado !!}
                    </td>
                    <td>{{ $item->p1 }}</td>
                    <td>{{ $item->p2 }}</td>
                    <td>{{ $item->p3 }}</td>
                    <td>{{ $item->p4 }}</td>
                    <td>{{ $item->p7 }}</td>
                    <td>{{ $item->p14 }} <br>

                        @php
                            $nombrep15 = $item->p15;
                            $nombrep15 = str_replace('Curso de ', '', $nombrep15);
                            $nombrep15 = str_replace('Curso ', '', $nombrep15);

                            $palabras = explode(' ', $nombrep15);

                            // Inicializa la cadena formateada
                            $nombre_formateadop15 = '';
                            $contador_palabras = 0;

                            foreach ($palabras as $palabra) {
                                // Agrega la palabra actual a la cadena formateada
                                $nombre_formateadop15 .= $palabra . ' ';

                                // Incrementa el contador de palabras
                                $contador_palabras++;

                                // Agrega un salto de línea después de cada tercera palabra
                                if ($contador_palabras % 3 == 0) {
                                    $nombre_formateadop15 .= "<br>";
                                }
                            }
                        @endphp


                        {!! $nombre_formateadop15 !!}
                    </td>
                    <th>{{ $item->p17 }}</th>
                    <th>{{ $item->p10 }}</th>
                    <th>{{ $item->p11 }}</th>
                    <th>{{ $item->p12 }}</th>
                    <th>{{ $item->p13 }}</th>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
</div>


