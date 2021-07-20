<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>

<a href="/kanban-homologacao/painel-de-homologacao-status/<?= esc($dd_projeto['hml_fk_projeto']) ?>/<?= esc($dd_projeto['hml_fk_backlog']) ?>" class="btn btn-success btn-flat">
    <i class="fas fa-reply-all"></i> Voltar
</a>
<br>
<br>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Atualizar formulário de etapa</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?= base_url('Kanban/HomologacaoController/alteraStatusTarefa/' . $dd_projeto['hml_id']) ?>" method="POST">
        <?= csrf_field() ?>
        <div class="card-body">
            <div class="form-group">
                <label for="etapa-homologacao">Etapa</label>
                <input type="text" class="form-control" name="etapa_homologacao" value="<?= $dd_projeto['hml_ativ_descricao'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="status_hologa">Selecione o Status</label>
                <select class="custom-select rounded-0" name="status_hologa">
                    <option value="1" <?php if ($dd_projeto['hml_status'] == 1) {
                                            echo 'selected';
                                        } ?>>Aprovado</option>
                    <option value="0" <?php if ($dd_projeto['hml_status'] == 0) {
                                            echo 'selected';
                                        } ?>>Pendente</option>
                </select>
            </div>
            <div class="form-group">
                <label>Observação do teste</label>
                <textarea class="form-control" name="homologa_observe" rows="3" placeholder="Digite aqui ..." required><?= $dd_projeto['hml_description'] ?></textarea>
            </div>
        </div>

        <!-- /.card-body -->
        <input type="hidden" name="return_projeto" value="<?= esc($dd_projeto['hml_fk_projeto']) ?>">
        <input type="hidden" name="return_back_log" value="<?= esc($dd_projeto['hml_fk_backlog']) ?>">

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Salvar
            </button>
        </div>
    </form>
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