<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <a href="/admin_rh/cadastrar-cargo" class="btn btn-info btn-flat">
        <i class="fa fa-plus"></i> Cadastrar
    </a><br><br>
    <!-- TO DO List -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= esc($title) ?></h3>

            <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cargos</th>
                        <th>Descrição</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($list_cargos) && is_array($list_cargos)) : ?>

                        <?php foreach ($list_cargos as $lst_cargos) : ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime(esc($lst_cargos['created_at']))) ?></td>
                                <td><?= esc($lst_cargos['cargo_nome']) ?></td>
                                <td><?= esc($lst_cargos['cargo_description']) ?> </td>
                                <td><button type="button" class=" deleteFakeCargos btn btn-block btn-warning btn-flat" id="<?= esc($lst_cargos['id_cargo'], 'url') ?>"><i class="fa fa-trash"></i> Deletar</button></td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <tr>
                            <td colspan="4">
                                <p class="text-center">Não há cargos cadastrados</p>
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- /.card -->
</section>
<?= $this->endSection() ?>
