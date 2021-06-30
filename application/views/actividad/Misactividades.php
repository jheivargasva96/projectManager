<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Responsable</th>
                                    <th>Fecha</th>
                                    <th>Lugar</th>
                                    <th>Indicador</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL -->
    <div class="modal fade" id="Modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                
            </div>
        </div>
    </div>


    <div class="modal fade" id="ModalAnexo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Evidencias</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                               

                                    <div class="card-header">
                                        <form enctype="multipart/form-data" id="form" style="margin-top: 15px; margin-bottom: 15px">
                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Observaciones *</label>
                                                    <input type="hidden" name="idevidencia" id="idevidencia" class="form-control hide" value="0">
                                                    <input type="hidden"  name="actividad_idactividad" id="actividad_idactividad" class="form-control hide" value="0">
                                                    <textarea type="text" name="observaciones" id="observaciones" class="form-control" placeholder="observaciones..." required=""></textarea>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Estado</label>
                                                    <select class="form-control" name="estado" required="">
                                                        <option>Seleccione...</option>
                                                        <option value="en proceso">En Proceso</option>
                                                        <option value="terminado">Tereminado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                        <p>Los campos marcados con (*) son obligatorios</p>
                                    </div>

                                    <div class="card-header">
                                        <button id="CrearAnexoActividad" class="btn bg-gradient-success btn-sm btn-social"><i class="fas fa-plus"></i> Nuevo Anexo</button>
                                    </div>


                                    <div class="card-body">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button style="width: 20%; float: right" tabindex="5" id="guardar" class="btn btn-success" type="submit" form="form">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalAprobacion">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="margin-top: 5px;color: #dd4b39" id="title">Aceptar Participante</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="TblAprobacion" class="table table-bordered table-striped" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Estado</th>
                                                    <th>Acciónes</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button style="width: 20%; float: right; margin-right: 8px;" tabindex="6" id="cancelar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</section>