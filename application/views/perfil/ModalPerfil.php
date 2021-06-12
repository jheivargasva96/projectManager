<style type="text/css">
    label {
        float: left;
    }
</style>

<div class="modal-header">
    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Nuevo Perfil</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form enctype="multipart/form-data" id="form" style="margin-top: 15px; margin-bottom: 15px">
        <div class="row">
            <div class="form-group col-md-12">
                <label>Nombre *</label>
                <input type="hidden" name="idperfil" id="idperfil" class="form-control hide" value="0">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre..." required="">
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