<div class="modal-header" style="padding: 0px;">
    <h1 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Cambiar Contraseña</h1>
</div>
<div class="modal-body">
    <form action="" enctype="multipart/form-data" id="frmRegistro" style="margin-top: 15px; margin-bottom: 15px">
        <div class="form-group col-md-12">
            <label>Nueva Contraseña*</label>
            <input type="hidden" name="id" id="id" class="form-control hide" value="<?= $this->session->userdata('IDUSUARIO') ?>">
            <input type="password" name="password" id="password" class="form-control" placeholder="Nueva Contraseña..." required="">
        </div>
    </form>
</div>  
<div class="form-group">
    <p>Los campos marcados con (*) son obligatorios</p>
</div>
<div class="modal-footer">
    <button style="width: 20%; float: right" tabindex="5" id="guardarRegistro" class="btn btn-success" type="submit" form="frmRegistro">Guardar</button>
    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelarCierre" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
</div>

<style type="text/css">
    label {
        float: left;
    }
</style>