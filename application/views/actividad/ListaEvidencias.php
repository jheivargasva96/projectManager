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
    <div>
        <p id="listaEvidencias"></p>
        <div>
            <div class="card card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Fecha</label>
                        <input type="text" class="form-control" value="" name="fecha" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Estado *</label>
                        <input type="text" class="form-control" value="" name="estado" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Observaciones *</label>
                        <textarea type="text" name="observaciones" id="observaciones" class="form-control" placeholder="Observaciones..." required="" readonly></textarea>
                    </div>
                </div>

                <table id="TableAnexoEvidencia" class="table table-bordered table-striped" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Anexo</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer justify-content-between">
    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
</div>