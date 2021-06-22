<style type="text/css">
    label {
        float: left;
    }
</style>

<div class="modal-header">
    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Modificar Contraseña</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form enctype="multipart/form-data" id="form" style="margin-top: 15px; margin-bottom: 15px">
        <div class="row">
            <span class="col-md-2"></span>
            <div class="form-group col-md-6">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="actual" id="actual" placeholder="Contraseña Actual" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label id="actual-error" class="error" for="actual" style="display: none;"></label>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="nueva" id="nueva" placeholder="Nueva Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label id="nueva-error" class="error" for="nueva" style="display: none;"></label>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Confirmar Nueva Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <label id="confirmar-error" class="error" for="confirmar" style="display: none;"></label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <p>Todos los campos son obligatorios</p>
        </div>
    </form>
</div>

<div class="modal-footer justify-content-between">
    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
    <button style="width: 20%; float: right" tabindex="5" id="guardar" class="btn btn-success" type="submit" form="form">Guardar</button>
</div>