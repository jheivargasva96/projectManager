<style type="text/css">
    label {
        float: left;
    }
</style>

<div class="modal-header">
    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Evidencias</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">

    <form enctype="multipart/form-data" id="form" style="margin-top: 15px; margin-bottom: 15px">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Fecha</label>
                <input type="text" class="form-control" value="" name="fecha" readonly>
                <input type="hidden" name="actividad_idactividad" id="actividad_idactividad" value="">
            </div>
            <div class="form-group col-md-6">
                <label>Estado *</label>
                <select class="form-control" name="estado" required="">
                    <option value="">Seleccione...</option>
                    <option value="en proceso">En Proceso</option>
                    <option value="terminado">Terminado</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12">
                <label>Observaciones *</label>
                <textarea type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones..." required=""></textarea>
            </div>
        </div>
    </form>

    <button id="CrearAnexoActividad" class="btn bg-gradient-success btn-sm btn-social"><i class="fas fa-plus"></i> Nuevo Anexo</button>
    <br><br>
    <table id="TblAnexoActividad" class="table table-bordered table-striped" style="width: 100%;">
        <thead>
            <tr>
                <th>Anexo</th>
                <th>Nombre</th>
                <th>Documento</th>
                <th>Acciónes</th>
            </tr>
        </thead>
    </table>

    <p>Los campos marcados con (*) son obligatorios</p>
</div>

<div class="modal-footer justify-content-between">
    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
    <button style="width: 20%; float: right" tabindex="5" id="guardar" class="btn btn-success" type="submit" form="form">Guardar</button>
</div>