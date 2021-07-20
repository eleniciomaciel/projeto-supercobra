<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>


<div class="col-2">
    <a href="/kanban/gerar-processo-kanban/<?= esc($listToFazendo['to_faz_fk_projeto']) ?>" class="btn btn-block btn-success btn-flat"><i class="fas fa-reply-all"></i> Voltar</a>
</div><br>

<div class="row">
    <!-- Left col -->
    <div class="col-md-8">
        <!-- MAP & BOX PANE -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?= esc($listToFazendo['to_faz_nome_backlog']) ?></h3>
            </div>

            <?php $validation =  \Config\Services::validation(); ?>
            <div class="col-12">
                <?php
                if (session()->getFlashdata('success_to_faz_')) : ?>
                    <div class="message_hide_atividade_tofaz alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> OK!</h5>
                        <?php echo session()->getFlashdata('success_to_faz_') ?>
                    </div>
                <?php elseif (session()->getFlashdata('error_to_faz_')) : ?>
                    <div class="message_hide_atividade_tofaz alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                        <?php echo session()->getFlashdata('error_to_faz_') ?>
                    </div>
                <?php endif; ?>
            </div>
            <!-- /.card-header -->
            <form action="<?= base_url('Kanban/ToFazendoController/salvaAtividadeToFazendo') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="backlog_name">Nome da Etapa:</label>
                        <input type="text" class="form-control" name="to_faz_nome_etapa" placeholder="Ex.: Formulário de login" value="<?= old('to_faz_nome_etapa') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('to_faz_nome_etapa')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('to_faz_nome_etapa'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_toFaz_add_projeto" value="<?= esc($listToFazendo['to_faz_fk_projeto']) ?>">
                <input type="hidden" name="id_toFaz_add_backlog" value="<?= esc($listToFazendo['to_faz_fk_backlog']) ?>">
                <input type="hidden" name="id_toFaz_add_nome_bk" value="<?= esc($listToFazendo['to_faz_nome_backlog']) ?>">
                <input type="hidden" name="id_toFaz_add_backlog_usuario" value="<?= session()->get('id_pw') ?>">

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salvar
                    </button>
                </div>
            </form>
            <!-- /.card-body -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col -->

    <div class="col-md-4">
        <!-- Info Boxes Style 2 -->

        <?php if (!empty($lacoToFazendo) && is_array($lacoToFazendo)) : ?>

            <?php foreach ($lacoToFazendo as $news_item) : ?>
                <?php
                if ($news_item['to_faz_status'] != NULL && $news_item['to_faz_status'] == 1) {
                ?>
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?= esc($news_item['ativ_descricao']) ?></span>
                            <span class="info-box-number">Concluído em   : <?= esc(date('d/m/Y', strtotime($news_item['created_at']))) ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <?php
                } else {
                ?>
                    <div class="info-box mb-3 bg-warning">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?= esc($news_item['ativ_descricao']) ?></span>
                            <span class="info-box-number">Criado em: <?= esc(date('d/m/Y', strtotime($news_item['created_at']))) ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                <?php
                }

                ?>

            <?php endforeach; ?>

        <?php else : ?>
            <h5 class="text-center">Sem atividades lançadas</h5>
        <?php endif ?>
    </div>
    <!-- /.col -->
</div>

<?= $this->endSection() ?>
<?= $this->section('script_geral') ?>

<script>
    $(function() {
        setTimeout(function() {
            $('.message_hide_atividade_tofaz').hide();
        }, 2000);
    })
</script>
<?= $this->endSection() ?>