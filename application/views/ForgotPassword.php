<body class="hold-transition login-page login">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>/Cinicio"><b><?= $empresa ?></b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <center><img src="<?= base_url() ?>/<?= $logo ?>" width="200"></center>
                <p class="login-box-msg">Recuperar contraseña</p>

                <form id="form" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" id="continuar" class="btn btn-primary btn-block">Recuperar</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="<?= base_url() ?>Clogin">Ingresar</a>
                </p>
            </div>
        </div>
    </div>