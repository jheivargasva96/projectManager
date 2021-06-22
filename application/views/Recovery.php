<body class="hold-transition login-page login">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>/Cinicio"><b><?= $empresa ?></b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <center><img src="<?= base_url() ?>/<?= $logo ?>" width="200"></center>
                <p class="login-box-msg">Nueva contraseña</p>

                <form id="form_recovery" method="post">
                    <input type="hidden" name="idusuario" value="<?= $idusuario ?>">
                    <input type="hidden" name="token" value="<?= $num ?>">
                    <div class="row">
                        <div class="form-group col-md-12">
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
                    
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" id="continuar" class="btn btn-primary btn-block">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>