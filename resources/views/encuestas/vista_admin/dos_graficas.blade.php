<div class="row">
    <div class="col-12">

        <div class="col-12">
            <h5 class="p-3">{!! $rango_fechas !!}</h5>
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="p-3"> Facial y Corporal</h5>
            </div>
            @foreach ($reportes as $item)
            <div class="col-3">
                <div class="card mt-3" style="background: #fde9ef!important;">

                    <div class="d-flex justify-content-between px-3" style="background: #f9d4df;padding: 30px 0px 10px 0px;border-radius: 9px 9px 0 0;">
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cliente: <br> <strong style="color: #6b0020;font-size: 13px;"> {{ $item->nombre }}</strong></p>
                        <p class="px-3" style="font-size: 13px;color: #d32156;font-weight: bold;">Telefono: <br> <strong style="color: #6b0020;font-size: 13px;">{{ $item->telefono }}</strong></p>
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cosmetologa: <br><strong style="color: #6b0020;font-size: 13px;">{{ $item->User->name }}</strong></p>
                    </div>

                    <div class="card-body px-4" style="">
                        <ul style="list-style:none;padding:0;margin: 0;color: #d32156;font-weight: bold;font-size: 13px;">
                            <li>
                                1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                                 <br>
                            <li>
                                2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                                 <br>
                            <li>
                                3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                                 <br>
                            <li>
                                4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                                 <br>
                            <li>
                                5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                                 <br>
                            <li>
                                6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                                 <br>
                            <li>
                               <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="p-3">Experiencia + Jacuzzi</h5>
            </div>
            @foreach ($reportes_exp_ja as $item)
            <div class="col-3">
                <div class="card mt-3" style="background: #f6e9fd!important;">

                    <div class="d-flex justify-content-between px-3" style="background: #f9d4f9;padding: 30px 0px 10px 0px;border-radius: 9px 9px 0 0;">
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cliente: <br> <strong style="color: #6b0020;font-size: 13px;"> {{ $item->nombre }}</strong></p>
                        <p class="px-3" style="font-size: 13px;color: #d32156;font-weight: bold;">Telefono: <br> <strong style="color: #6b0020;font-size: 13px;">{{ $item->telefono }}</strong></p>
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cosmetologa: <br><strong style="color: #6b0020;font-size: 13px;">{{ $item->User->name }}</strong></p>
                    </div>

                    <div class="card-body px-4" style="">
                        <ul style="list-style:none;padding:0;margin: 0;color: #d32156;font-weight: bold;font-size: 13px;">
                            <li>
                                1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                                 <br>
                            <li>
                                2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                                 <br>
                            <li>
                                3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                                 <br>
                            <li>
                                4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                                 <br>
                            <li>
                                5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                                 <br>
                            <li>
                                6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                                 <br>
                            <li>
                                7- ¿Te exfoliaron los pies con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p10 }}</strong></li> </li>
                                <br>
                            <li>
                                8- ¿Te ofrecieron <br> Vino y Fresas? <strong style="color: #6b0020;">{{ $item->p11 }}</strong></li> </li>
                                <br>
                            <li>
                                9- ¿Te exfoliaron las manos con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li> </li>
                                <br>
                            <li>
                                10- ¿Te dieron cuarzo <br> de amistad o amor? <strong style="color: #6b0020;">{{ $item->p13 }}</strong></li> </li>
                                <br>
                               <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="p-3"> Brow Bar & Lash Lifting</h5>
            </div>
            @foreach ($reportes_brow as $item)
            <div class="col-3">
                <div class="card mt-3" style="background: #ebe9fd!important;">

                    <div class="d-flex justify-content-between px-3" style="background: #d7d4f9;padding: 30px 0px 10px 0px;border-radius: 9px 9px 0 0;">
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cliente: <br> <strong style="color: #6b0020;font-size: 13px;"> {{ $item->nombre }}</strong></p>
                        <p class="px-3" style="font-size: 13px;color: #d32156;font-weight: bold;">Telefono: <br> <strong style="color: #6b0020;font-size: 13px;">{{ $item->telefono }}</strong></p>
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cosmetologa: <br><strong style="color: #6b0020;font-size: 13px;">{{ $item->User->name }}</strong></p>
                    </div>

                    <div class="card-body px-4" style="">
                        <ul style="list-style:none;padding:0;margin: 0;color: #d32156;font-weight: bold;font-size: 13px;">
                            <li>
                                1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                                 <br>
                            <li>
                                2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                                 <br>
                            <li>
                                3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                                 <br>
                            <li>
                                4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                                 <br>
                            <li>
                                5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                                 <br>
                            <li>
                                6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                                 <br>
                            <li>
                                7- ¿Aplicaron todos los productos <br> mencionados en el flyer publicitario? <strong style="color: #6b0020;">{{ $item->p5 }}</strong></li> </li>
                                <br>
                            <li>
                                8- ¿Cómo calificas la calidad y <br> limpieza de las cabinas? <strong style="color: #6b0020;">{{ $item->p8 }}</strong></li> </li>
                                <br>
                            <li>
                               <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="p-3">Experiencias</h5>
            </div>
            @foreach ($reportes_exp as $item)
            <div class="col-3">
                <div class="card mt-3" style="background: #f9f3d4!important;">

                    <div class="d-flex justify-content-between px-3" style="background: #f9d4d4;padding: 30px 0px 10px 0px;border-radius: 9px 9px 0 0;">
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cliente: <br> <strong style="color: #6b0020;font-size: 13px;"> {{ $item->nombre }}</strong></p>
                        <p class="px-3" style="font-size: 13px;color: #d32156;font-weight: bold;">Telefono: <br> <strong style="color: #6b0020;font-size: 13px;">{{ $item->telefono }}</strong></p>
                        <p class="" style="font-size: 13px;color: #d32156;font-weight: bold;">Cosmetologa: <br><strong style="color: #6b0020;font-size: 13px;">{{ $item->User->name }}</strong></p>
                    </div>

                    <div class="card-body px-4" style="">
                        <ul style="list-style:none;padding:0;margin: 0;color: #d32156;font-weight: bold;font-size: 13px;">
                            <li>
                                1- ¿Qué tan probable es <br> que nos recomiendes? <strong style="color: #6b0020;">{{ $item->p1 }}</strong></li>
                                 <br>
                            <li>
                                2- ¿Qué tan buena fue <br> la atención? <strong style="color: #6b0020;">{{ $item->p2 }}</strong></li> </li>
                                 <br>
                            <li>
                                3- ¿Cómo calificas la atención <br> en Redes Sociales? <strong style="color: #6b0020;">{{ $item->p3 }}</strong></li> </li>
                                 <br>
                            <li>
                                4- ¿Respondieron todas <br> tus dudas? <strong style="color: #6b0020;">{{ $item->p4 }}</strong></li> </li>
                                 <br>
                            <li>
                                5- ¿Cómo calificas el profesionalismo <br> y presentación del equipo de trabajo? <strong style="color: #6b0020;">{{ $item->p7 }}</strong></li> </li>
                                 <br>
                            <li>
                                6- ¿Se cumplió el tiempo <br> de sesión? <strong style="color: #6b0020;">{{ $item->p14 }} {{ $item->p15 }}</strong></li> </li>
                                 <br>
                            <li>
                                7- ¿Masaje en <br> pareja o amigas? <strong style="color: #6b0020;">{{ $item->p17 }}</strong></li> </li>
                                <br>
                            <li>
                                8- ¿Te exfoliaron los pies con <br> Sugar Honey? <strong style="color: #6b0020;">{{ $item->p10 }}</strong></li> </li>
                                <br>
                            <li>
                                8-¿Te ofrecieron <br> Vino y Fresas? <strong style="color: #6b0020;">{{ $item->p11 }}</strong></li> </li>
                                <br>
                            <li>
                                8- ¿Te exfoliaron las manos <br> con Sugar Honey? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li> </li>
                                <br>
                            <li>
                                8- ¿Te dieron cuarzo <br> de amistad o amor? <strong style="color: #6b0020;">{{ $item->p12 }}</strong></li> </li>
                                <br>
                            <li>
                               <strong style="color: #6b0020;">{{  $item->comentario}}</strong>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


