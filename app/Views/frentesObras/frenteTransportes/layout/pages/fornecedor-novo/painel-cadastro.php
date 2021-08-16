<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">

    <div class="card card-primary card-outline card-outline-tabs">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Cadastro de Empresa/Fornecedor
            </h3>
        </div>

        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false"><i class="fas fa-search"></i> Gerenciar </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><i class="fas fa-laptop-house"></i> Cadastrar Empresa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fas fa-user-plus"></i> Representantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false"><i class="fas fa-user-tag"></i> Cadastrar Empresa/Representante</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                    <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/consultas') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                    <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/formulario-empresa') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                    <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/formulario-representante') ?>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                    <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/anexo-empresa-representante') ?>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

</section>
<?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/component/003-dados_empresa') ?>
<?= $this->endSection() ?>