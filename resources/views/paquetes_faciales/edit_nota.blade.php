                                    <div class="row">
                                        <div class="col-6 form-group ">
                                            <label for="nombre">Seleccione Recepcionista</label><br>
                                            <select class="form-control id_user" id="id_user" name="id_user" value="{{ old('id_user') }}">
                                                <option value="{{ $nota->id_user }}">{{ $nota->User->name }}</option>
                                                @foreach ($user as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6 form-group ">
                                            <label for="nombre">Seleccione Cosmetologa Comision</label><br>
                                            <select class="form-control id_cosme" id="id_cosme" name="id_cosme" value="{{ old('id_cosme') }}">
                                                <option value="{{ $nota->id_cosme_comision }}">{{ $nota->Cosme->name }}</option>
                                                @foreach ($cosme as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="precio">Cliente</label><br>
                                                <select class="form-control cliente"  data-toggle="select" id="id_client" name="id_client">
                                                    <option value="{{ $nota->id_client }}">{{ $nota->Client->name }} {{ $nota->Client->last_name }}</option>
                                                    @foreach ($client as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }} {{ $item->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="precio">Fecha</label><br>
                                                <input  id="fecha_inicial" name="fecha_inicial" type="date" class="form-control" value="{{ $nota->fecha }}">
                                            </div>
                                        </div>
                                    </div>
