<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_rh/cadastrar-dados" class="btn btn-success btn-flat">
        <i class="fa fa-plus"></i> Cadastrar
    </a>
    <br><br>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Funcionarios cadastrados</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table table-responsive col-12">
                <table class="table table-sm" id="lista_funcioanrios_frente" style="width: 100%;">
                <br>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>E-mail</th>
                            <th>Código</th>
                            <th>Matrícula</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
              
                    </tbody>
                </table>
            </div>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<?= $this->endSection() ?>