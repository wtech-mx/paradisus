<!-- Modal -->
<div class="modal fade" id="showDataModal" tabindex="-1" role="dialog" aria-labelledby="createDataModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title text-center" id="showDataModal">Seleciona el Paquetes</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                    <div class="row">

                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                    <a class="btn primary text-center" href="{{ route('create_paquete_uno.create_uno') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                        Tu figura Ideal c/Aparatología
                                    </a>
                                </div>
                              </div>

                              <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_dos.create_dos') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Lipoescultura s/cirugía
                                </a>
                                 </div>
                              </div>

                              <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_tres.create_tres') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Moldeante & Reductivo
                                </a>
                                 </div>
                              </div>

                              <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_cuatro.create_cuatro') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Drenante & Linfático
                                </a>
                                 </div>
                              </div>

                              <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_cinco.create_cinco') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Glúteos Definido & Perfectos
                                </a>
                                 </div>
                              </div>

                              <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_seis.create_seis') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Piernas de 10
                                </a>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-center">
                                <a class="btn primary" href="{{ route('create_paquete_siete.create_siete') }}" style="background: {{$configuracion->color_boton_save}}; color: #ffff">
                                    Brazos definidos
                                </a>
                                </div>
                            </div>
                    </div>
            </div>
        </div>
    </div>
</div>
