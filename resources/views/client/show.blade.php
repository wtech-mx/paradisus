<!-- Modal -->
<div class="modal fade" id="showDataModal{{$client->id}}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="showDataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showDataModalLabel">Ver Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input disabled id="name" name="name" type="text" class="form-control" placeholder="Nombre" required value="{{$client->name}}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellido</label>
                            <input disabled id="last_name" name="last_name" type="text" class="form-control" placeholder="Apellido" value="{{$client->last_name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Correo</label>
                            <input disabled id="email" name="email" type="email" class="form-control" placeholder="Correo" required value="{{$client->email}}">
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Telefono</label>
                                    <input disabled id="phone" name="phone" type="number" class="form-control" placeholder="Telefono" required value="{{$client->phone}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="occupation">Ocupacion</label>
                                    <input disabled id="occupation" name="occupation" type="text" class="form-control" placeholder="Ocupacion" value="{{$client->occupation}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sanguineous">Sanguineo</label>
                                    <input disabled id="sanguineous" name="sanguineous" type="text" class="form-control" placeholder="Sanguineo" value="{{$client->sanguineous}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="age">Edad</label>
                                    <input disabled id="age" name="age" type="number" class="form-control" placeholder="Edad" value="{{$client->age}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="birth_date">birth_date</label>
                                    <input disabled id="birth_date" name="birth_date" type="date" class="form-control" placeholder="birth_date" value="{{$client->birth_date}}">
                            </div>
                        </div>

                </div>
        </div>
    </div>
</div>
