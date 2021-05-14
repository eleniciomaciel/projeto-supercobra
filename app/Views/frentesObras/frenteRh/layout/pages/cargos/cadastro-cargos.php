<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-md-12 content">

    <a href="/admin_rh/cargos-rh" class="btn btn-warning btn-flat">
        <i class="fa fa-reply-all"></i> Voltar
    </a><br><br>

    <div class="">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    <?= esc($title) ?>
                </h3>
            </div>
            <div class="card-body pad table-responsive">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Composição</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Funções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Cargos</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="home" class="container tab-pane active"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_resultados') ?>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_funcao') ?>
                    </div>

                    <div id="menu2" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_cargos') ?>
                    </div>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.col -->

</section>
<?= $this->endSection() ?>