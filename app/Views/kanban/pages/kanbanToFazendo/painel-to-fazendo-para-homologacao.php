<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">

    <div class="col-md-12">
        <?php
        if (session()->getFlashdata('success_new_task')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <p>
                    <?php echo session()->getFlashdata('success_new_task') ?>
                    <a href="/kanban/gerar-processo-kanban/<?= esc($nova_fase['ativ_bl_fk_projeto'], 'url') ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-reply-all"></i> Voltar
                    </a>
                </p>
            </div>
        <?php endif; ?>

        <div class="invoice p-3 mb-3">

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">


                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        <?php if (!empty($nova_fase_list) && is_array($nova_fase_list)) : ?>
                    <p class="lead">To Fazendo: <?= esc($nova_fase['to_faz_nome_backlog']) ?></p>
                    <!-- <ul class="nav flex-column">
                        <?php foreach ($nova_fase_list as $news_faze) : ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <?= esc($news_faze['ativ_descricao']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul> -->

                    <!-- formulário de atividades TO FAZENDO -->
                    <form action="<?= base_url('Kanban/ToFazendoController/faseHomologacao') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="form-group">
                        <?php foreach ($nova_fase_list as $news_faze_id) : ?>
                            <input type="hidden" name="tofaz_name_atividades[]" value="<?= esc($news_faze_id['ativ_descricao']) ?>">
                            <div class="form-check">
                                <input class="form-check-input" name="status_ckeckbox[]" type="checkbox" <?php if($news_faze_id['to_faz_status'] != 0){echo 'checked';}?> value="1" required>
                                <label class="form-check-label"><?= esc($news_faze_id['ativ_descricao']) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="tofaz_usuario" value="<?= esc($nova_fase['to_faz_fk_usuario']) ?>">
                        <input type="hidden" name="tofaz_projeto" value="<?= esc($nova_fase['to_faz_fk_projeto']) ?>">
                        <input type="hidden" name="tofaz_backlog" value="<?= esc($nova_fase['to_faz_fk_backlog']) ?>">
                        <input type="hidden" name="tofaz_descricao" value="<?= esc($nova_fase['ativ_descricao']) ?>">
                        <input type="hidden" name="tofaz_datacriado" value="<?= esc($nova_fase['created_at']) ?>">
                        <input type="hidden" name="tofaz_nome_backlog" value="<?= esc($nova_fase['to_faz_nome_backlog']) ?>">

                        <div class="row no-print">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success float-right">
                                    <i class="fas fa-check"></i>
                                    Ir para nova fase
                                </button>
                                <a href="/kanban/gerar-processo-kanban/<?= esc($nova_fase['to_faz_fk_projeto'], 'url') ?>" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-reply-all"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </form>

                <?php else : ?>
                    <h3>Não há itens para mudar de faze</h3>


                <?php endif ?>
                </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><i class="fas fa-check"></i></h3>
                            <p>Ao confirmar você estará indo para a fase de (Homologação). </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


        </div>
    </div>
    <!-- /.col-->
</div>
<!-- ./row -->
<?= $this->endSection() ?>
<?= $this->section('script_geral') ?>

<script>
    $(function() {
        $('#summernote').summernote()
    })
</script>
<?= $this->endSection() ?>