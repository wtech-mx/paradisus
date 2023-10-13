<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">Nombre Completo</label>
        <div class="input-group mb-4">
        <span class="input-group-text"><i class="fa fa-user"></i></span>
        <input class="form-control" type="text" id="nombre" name="nombre">
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">Celular</label>
        <div class="input-group mb-4">
        <span class="input-group-text"><i class="fa fa-phone"></i></span>
        <input class="form-control" type="number" id="telefono" name="telefono">
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="form-group p-2">
    <label for="example-text-input" class="form-control-label">Cosmetologa *</label>
        <div class="input-group mb-4">
            <span class="input-group-text"><i class="fa fa-file"></i></span>
            <select class="form-control" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                <option value="">Seleccione Cosmetologa</option>
                @foreach ($cosme as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">Fecha</label>
        <div class="input-group mb-4">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
        <input class="form-control" type="text" value="{{ $fechaActual }}" readonly>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Qué tan probable es que nos recomiendes? *</label>
        <div class="input-group">
            <select class="form-control" id="p1" name="p1" value="{{ old('p1') }}" required>
                <option value="">Seleccione una opción</option>
                <option value="Poco probable">Poco probable</option>
                <option value="Algo poco probable">Algo poco probable</option>
                <option value="Neutral">Neutral</option>
                <option value="Probable">Probable</option>
                <option value="Bastante probable">Bastante probable</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Qué tan buena fue la atención? *</label>
        <div class="input-group text-center">
            <select class="form-control" id="p2" name="p2" value="{{ old('p2') }}" required>
                <option value="">Seleccione una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Neutral">Neutral</option>
                <option value="Buena">Buena</option>
                <option value="Muy buena">Muy buena</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Cómo calificas la atención en Redes Sociales? *</label>
        <div class="input-group text-center">
            <select class="form-control" id="p3" name="p3" value="{{ old('p3') }}" required>
                <option value="">Seleccione una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Neutral">Neutral</option>
                <option value="Buena">Buena</option>
                <option value="Muy buena">Muy buena</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2" style="">
        <label for="example-text-input" class="form-control-label">¿Respondieron todas tus dudas? *</label>
        <div class="input-group text-center" style="display: table;">
            <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
            <input type="radio" id="p4" name="p4" value="si" required/>

            <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
            <input type="radio" id="p4" name="p4" value="no" required/>
        </div>
    </div>
</div>

@if(!request()->is('encuesta/jacuzzi'))
    <div class="col-md-12">
        <div class="form-group p-2">
            <label for="example-text-input" class="form-control-label">¿Aplicaron todos los productos mencionados en el flyer publicitario? *</label>
            <div class="input-group text-center" style="display: table;">
                <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
                <input type="radio" id="p5" name="p5" value="si" required/>

                <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
                <input type="radio" id="p5" name="p5" value="no" required/>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group p-2">
            <label for="example-text-input" class="form-control-label">¿Aplicaron Aromaterapia? *</label>
            <div class="input-group text-center" style="display: table;">
                <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
                <input type="radio" id="p6" name="p6" value="si" required/>

                <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
                <input type="radio" id="p6" name="p6" value="no" required/>
            </div>
        </div>
    </div>

@endif

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Cómo calificas el profesionalismo y presentación del equipo de trabajo? *</label>
        <div class="input-group text-center">
            <select class="form-control" id="p7" name="p7" value="{{ old('p7') }}" required>
                <option value="">Seleccione una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Neutral">Neutral</option>
                <option value="Buena">Buena</option>
                <option value="Muy buena">Muy buena</option>
            </select>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Cómo calificas la calidad y limpieza de las cabinas? *</label>
        <div class="input-group text-center">
            <select class="form-control" id="p8" name="p8" value="{{ old('p8') }}" required>
                <option value="">Seleccione una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Neutral">Neutral</option>
                <option value="Buena">Buena</option>
                <option value="Muy buena">Muy buena</option>
            </select>
        </div>
    </div>
</div>

@if(!request()->is('encuesta/jacuzzi'))
    <div class="col-md-12">
        <div class="form-group p-2">
            <label for="example-text-input" class="form-control-label">¿Qué tanto satisfacieron tus necesidades nuestros productos? *</label>
            <div class="input-group text-center">
                <select class="form-control" id="p9" name="p9" value="{{ old('p9') }}" required>
                    <option value="">Seleccione una opción</option>
                    <option value="Muy insatisfactorio">Muy insatisfactorio</option>
                    <option value="Insatisfactorio">Insatisfactorio</option>
                    <option value="Neutral">Neutral</option>
                    <option value="Satisfactorio">Satisfactorio</option>
                    <option value="Muy satisfactorio">Muy satisfactorio</option>
                </select>
            </div>
        </div>
    </div>
@endif

<div class="col-md-12">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Se cumplió el tiempo de sesión? *</label>
        <div class="input-group text-center" style="display: table;">
            <label style="margin-left: 30px; margin-right: 10px" for="scales">Si</label>
            <input type="radio" id="p14" name="p14" value="si" onclick="ocultarDiv('div_p9')" required/>

            <label style="margin-left: 30px; margin-right: 10px" for="scales">No</label>
            <input type="radio" id="p14" name="p14" value="no" onclick="mostrarDiv('div_p9')" required/>
        </div>
    </div>
</div>

<div class="col-md-12" id="div_p9" style="">
    <div class="form-group p-2">
        <label for="example-text-input" class="form-control-label">¿Por qué no se cumplió el tiempo de sesión?</label>
        <div class="input-group text-center" style="">
            <textarea class="form-control" id="p15" name="p15" rows="2" ></textarea>
        </div>
    </div>
</div>
