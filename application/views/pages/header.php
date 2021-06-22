<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="<?= base_url() ?>/<?= $logo ?>" alt="icono" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url() ?>Cinicio" class="nav-link">Inicio</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-fw fa-user-cog" class="user-image" alt="User Image"></i>
                        <span class="hidden-xs"><?= $this->session->userdata('nombre') ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <span class="dropdown-item dropdown-header">
                            <img src="<?= base_url() ?>/<?= $this->session->userdata('imagen') ?>" width="160" class="img-circle" alt="User Image">
                            <p>
                                <small><?= $this->session->userdata('perfil') ?></small>
                            </p>
                        </span>
                        <!-- Menu Footer-->
                        <div class="dropdown-item dropdown-footer">
                            <div class="row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <input type="button" class="btn bg-gradient-primary btn-xs btn-flat" id="editar_perfil" value="Modificar" idusuario="<?= $this->session->userdata('idusuario') ?>">
                                </div>
                            </div>
                            <div class="row">
                                <br>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="button" class="btn bg-gradient-primary btn-xs btn-flat" id="actualizar_password" value="Modificar Contraseña">
                                </div>
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-4">
                                    <a href="<?= base_url() ?>Clogin/Cerrar" class="btn bg-gradient-danger btn-xs btn-flat">Cerrar sesión</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- MODAL -->
        <div class="modal fade" id="ModalUser">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                </div>
            </div>
        </div>