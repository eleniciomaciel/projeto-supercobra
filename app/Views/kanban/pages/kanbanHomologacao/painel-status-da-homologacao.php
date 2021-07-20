<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>

<a href="/kanban/gerar-processo-kanban/<?= esc($dd_projeto['hml_fk_projeto']) ?>" class="btn btn-success btn-flat">
    <i class="fas fa-reply-all"></i> Voltar
</a>
<br>
<br>
<div class="card">
    <div class="card-header border-transparent">
        <h3 class="card-title">Fase: <?= $dd_projeto['hml_nome_backlog'] ?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table m-0">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Última Atualização</th>
                        <th>Observações</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($list_homolocacao as $lista) {
                    ?>
                        <tr>
                            <td><?= esc($lista['hml_ativ_descricao']) ?></td>
                            <td><?= $lista['hml_status'] == 0 ? '<span class="badge badge-warning">Em Revisão</span>' : '<span class="badge badge-success">Aprovado</span>' ?></td>
                            <td><?= date('d/m/Y', strtotime(esc($lista['updated_at']))) ?></td>
                            <td><?= esc($lista['hml_description'] == NULL ? '---' : $lista['hml_description']) ?></td>
                            <td>
                                <a href="/kanban-homologacao/atualizar-etapa-homologacao/<?= esc($lista['hml_id']) ?>" class="btn btn-block btn-info btn-flat">
                                    <i class="fas fa-pen-alt"></i> Editar
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
    <form action="<?=base_url('Kanban/HomologacaoController/fazeCluido')?>" method="post">
    <?= csrf_field() ?>
    <?php
    foreach ($list_homolocacao as $key) {
        ?>
        <input type="hidden" name="c_descricao[]" value="<?= esc($key['hml_ativ_descricao']) ?>">
        <input type="hidden" name="c_status[]" value="<?= esc($key['hml_status']) ?>">
        <input type="hidden" name="c_observacao[]" value="<?= esc($key['hml_description']) ?>">
        <?php
    }
    ?>

    <input type="hidden" name="c_usuario" value="<?= esc($dd_projeto['hml_fk_usuario']) ?>">
    <input type="hidden" name="c_projeto" value="<?= esc($dd_projeto['hml_fk_projeto']) ?>">
    <input type="hidden" name="c_n_backlog" value="<?= esc($dd_projeto['hml_nome_backlog']) ?>">
    <input type="hidden" name="c_dt_migracao" value="<?= esc($dd_projeto['data_migracao_do_backlog']) ?>">
     <button type="submit" class="btn btn-sm btn-info float-left" title="Marcar etapa de homologação como concluído.">
            <i class="fas fa-tasks"></i> Concluír
        </button>
    </form>
       
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.col-->
<!-- ./row -->
<?= $this->endSection() ?>
<?= $this->section('script_geral') ?>

<script>
    $(function() {
        $('#summernote').summernote()
    })
</script>
<?= $this->endSection() ?>