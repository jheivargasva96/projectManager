<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>Cinicio" class="brand-link">
        <img src="<?= base_url() ?><?= $logo ?>" alt="Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light" style="font-size: 85%;"><?= $empresa ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
       

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" id="menu">
                <li class="nav-item">
                    <a href="<?= base_url() ?>Cinicio" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Inicio</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>Cinicio" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Perfiles</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>Cusuario" class="nav-link">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Usuarios</p>
                    </a>
                </li>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link" id="modulo_programa">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>Programas<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Cprograma" class="nav-link" id="modulo_lista_programas">
                                <i class="nav-icon fas fa-clipboard-list"></i><p>Lista</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>Cprograma/filtro_responsable" class="nav-link" id="modulo_mis_programas">
                            <i class="nav-icon fas fa-clipboard-list"></i><p>Mis Programas</p></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>