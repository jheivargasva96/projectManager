<style type="text/css">
    label {
        float: left;
    }
</style>

<div class="modal-header">
    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Editar Perfil</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form enctype="multipart/form-data" id="form" style="margin-top: 15px; margin-bottom: 15px">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Tipo Documento *</label>
                <select class="form-control" name="tipo_identificacion_idtipo_identificacion" required>
                    <option>Seleccione...</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label>Identificación *</label>
                <input type="hidden" name="idusuario" id="idusuario" class="form-control hide" value="0">
                <input type="text" pattern="[0-9]{6,10}" name="identificacion" id="identificacion" class="form-control" title="Identificación: Númerico entre 6 y 10 digitos" placeholder="Identificación..." required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Nombres *</label>
                <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres..." required="">
            </div>
            <div class="form-group col-md-6">
                <label>Apellidos *</label>
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos..." required="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Teléfono *</label>
                <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Teléfono..." required="">
            </div>
            <div class="form-group col-md-6">
                <label>Dirección *</label>
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Dirección..." required="">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Fecha Nacimiento *</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Nacimiento..." required="">
            </div>

            <div class="form-group col-md-6">
                <label>Email *</label>
                <input type="email" name="correo" id="correo" class="form-control" placeholder="Email..." required="">
            </div>
        </div>

        <div class="form-group">
            <p>Los campos marcados con (*) son obligatorios</p>
        </div>
    </form>
</div>

<div class="modal-footer justify-content-between">
<button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
    <button style="width: 20%; float: right" tabindex="5" id="guardar" class="btn btn-success" type="submit" form="form">Guardar</button>
</div>