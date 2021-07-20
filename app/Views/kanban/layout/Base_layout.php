<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Obras-Eletrica | Kanban Board</title>
    <link rel="shortcut icon" href="<?= base_url() ?>/dist/img/eletricidade.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/ekko-lightbox/ekko-lightbox.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/summernote/summernote-bs4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Configurações de acesso</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> Dados pessoal
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/logout" class="dropdown-item dropdown-footer">
                            <i class="fas fa-power-off mr-2 text-center"></i> Sair
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../index3.html" class="brand-link">
                <img src="<?= base_url() ?>/dist/img/eletricidade.png" alt="sys-io" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" title="Sistemas Integrado de Obras">SYS-IO</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url() ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= esc($title['f_nome']) ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Painel de Projetos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/kanban/cadastrar-projeto" class="nav-link">
                                        <i class="fas fa-clipboard-check nav-icon"></i>
                                        <p>Cadastrar Projeto</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fas fa-tasks nav-icon"></i>
                                        <p>Cadastrar Etapas</p>
                                    </a>
                                </li>

                                <p class="text-center" style="color: snow;">Listagem dos Projetos</p>
                                <?php if (!empty($listProjetos) && is_array($listProjetos)) : ?>
                                    <?php foreach ($listProjetos as $news_proj) : ?>
                                        <li class="nav-item">
                                            <a href="/kanban/projetos-list-one/<?= esc($news_proj['kbp_id'], 'url') ?>" class="nav-link">
                                                <i class="fas fa-circle nav-icon"></i>
                                                <p><?= esc($news_proj['kbp_nome_projeto']) ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>Não há Projetos</p>
                                        </a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check"></i>
                                <p>
                                    Agenda de trabalho
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <?php
        if (url_is('kanban/gerar-processo-kanban*')) {
        ?>
            <?= $this->renderSection('content') ?>

        <?php
        } else {
        ?>
            <div class="content-wrapper" style="min-height: 236px;">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h1>Kanban Board</h1>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="/kanban/projeto-kanban">Início</a></li>
                                    <li class="breadcrumb-item active">Kanban Board</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content pb-3">
                    <?= $this->renderSection('content') ?>
                </section>
            </div>


            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 1.1.0
                </div>
                <strong>Copyright &copy; 2022 <a href="#">Obras Elétricas</a>.</strong> Todos os direitos reservados.
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
            <div id="sidebar-overlay"></div>

        <?php
        }

        ?>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="<?= base_url() ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?= base_url() ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ekko Lightbox -->
    <script src="<?= base_url() ?>/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?= base_url() ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <!-- Filterizr-->
    <script src="<?= base_url() ?>/plugins/filterizr/jquery.filterizr.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url() ?>/dist/js/demo.js"></script>
    <!-- Summernote -->
    <script src="<?= base_url() ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- Page specific script -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?= $this->renderSection('script_geral') ?>
</body>

</html>