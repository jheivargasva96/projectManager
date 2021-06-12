<body class="hold-transition login-page login">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>/Cinicio"><b><?= $empresa ?></b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <center><img src="<?= base_url() ?>/<?= $logo ?>" width="200"></center>
                <p class="login-box-msg">Inicio de sesión</p>

                <form id="frmLogueo" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="pass" class="form-control" placeholder="Contraseña">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" id="continuar" class="btn btn-primary btn-block">Continuar</button>
                        </div>
                    </div>
                </form>

                <!-- <p class="mb-1">
                    <a href="#">Olvide mi contraseña</a>
                </p>
                <p class="mb-0">
                    <a href="#" class="text-center">Registrarme</a>
                </p> -->
            </div>
        </div>
    </div>