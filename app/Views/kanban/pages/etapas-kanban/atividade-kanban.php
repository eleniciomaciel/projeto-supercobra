<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>

<div class="content-wrapper kanban" style="min-height: 305px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <?= esc($ddProjetos['kbp_nome_projeto']) ?>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/kanban/projeto-kanban">Início</a></li>
                        <li class="breadcrumb-item active">Processo do Kanban</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <div class="col-12">
        <?php
        if (session()->getFlashdata('success_new_task')) : ?>
            <div class="message_hide_avisa_nova_tarefa_atividade alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <?php echo session()->getFlashdata('success_new_task') ?>
            </div>
        <?php endif; ?>

        <?php
        if (session()->getFlashdata('success_new_add_hml')) : ?>
            <div class="message_hide_avisa_nova_tarefa_atividade alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <?php echo session()->getFlashdata('success_new_add_hml') ?>
            </div>
        <?php endif; ?>

        <?php
        if (session()->getFlashdata('success_new_nomologa_concluido')) : ?>
            <div class="message_hide_avisa_nova_tarefa_atividade alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <?php echo session()->getFlashdata('success_new_nomologa_concluido') ?>
            </div>
        <?php endif; ?>
    </div>


    <section class="content pb-3">
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary">
                <div class="card-header">
                    <h3 class="card-title">
                        Backlog
                    </h3>
                </div>
                <div class="card-body">

                    <?php if (!empty($list_backlog) && is_array($list_backlog)) : ?>

                        <?php foreach ($list_backlog as $news_item) : ?>

                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title"><?= esc($news_item['bl_nome_backlog']) ?></h5>

                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a href="/kanban/adiciona-atividades-do-backlog/<?= esc($news_item['bl_id'], 'url') ?>" class="dropdown-item">
                                                    <i class="fas fa-clipboard-list"></i> Adicionar Etapas
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="/kanban/iniciar-tarefa/<?= esc($news_item['bl_id'], 'url') ?>" class="dropdown-item"><i class="fas fa-thumbs-up"></i> Mudar de Fase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="chart-legend clearfix">
                                        <?php
                                        foreach ($ativ_backlog as $key => $value) {
                                            if ($news_item['bl_id'] == $value['ativ_bl_fk_backlog']) {
                                        ?>
                                                <li><i class="far fa-circle text-danger"></i> <?= $value['ativ_descricao'] ?></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title text-center">Não há Backlogs cadastrados para esse projeto.</h5>
                            </div>
                        </div>
                    <?php endif ?>

                </div>
            </div>
            <div class="card card-row card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        To Fazendo
                    </h3>
                </div>
                <div class="card-body">

                    <!-- =============================./lista to fazendo ======================================= -->

                    <?php if (!empty($list_backlog_to_fazendo) && is_array($list_backlog_to_fazendo)) : ?>

                        <?php foreach ($list_backlog_to_fazendo as $news_item_to_fazendo) : ?>

                            <div class="card card-info card-outline">
                                <div class="card-header">
                                    <h5 class="card-title"><?= esc($news_item_to_fazendo['to_faz_nome_backlog']) ?></h5>

                                    <div class="card-tools">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52" aria-expanded="false">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a href="/kanban_to_fazendo/adiciona-atividades-to-fazendo/<?= esc($news_item_to_fazendo['to_faz_fk_backlog']) ?>/<?= esc($news_item_to_fazendo['to_faz_id'], 'url') ?>" class="dropdown-item">
                                                    <i class="fas fa-clipboard-list"></i> Adicionar + Etapas
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                <a href="/kanban_to_fazendo/iniciar-processo-de-homolocacao/<?= esc($news_item_to_fazendo['to_faz_id']) ?>/<?= esc($news_item_to_fazendo['to_faz_fk_backlog'], 'url') ?>" class="dropdown-item"><i class="fas fa-thumbs-up"></i> Mudar de Fase</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body p-0" style="display: block;">
                                        <ul class="nav nav-pills flex-column">
                                            <?php
                                            foreach ($list_to_fazendo_atividades as $key1 => $value1) {
                                                if ($news_item_to_fazendo['to_faz_fk_backlog'] == $value1['to_faz_fk_backlog']) {
                                            ?>
                                                    <li class="nav-item active">
                                                        <a href="#" class="nav-link">
                                                            <div class="custom-control custom-checkbox">
                                                                <input class="custom-control-input" type="checkbox" name="chk" id="<?= $value1['to_faz_id'] ?>" <?php if ($value1['to_faz_status'] != 0) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?> data-id="<?= esc($news_item_to_fazendo['to_faz_id']) ?>">
                                                                <label for="<?= $value1['to_faz_id'] ?>" class="custom-control-label"><?= $value1['ativ_descricao'] ?></label>
                                                                <span class="badge bg-primary float-right"><?= date('d/m/Y', strtotime($value1['updated_at']))  ?></span>
                                                            </div>
                                                        </a>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title text-center">Não há atividades cadastrados para esse projeto.</h5>
                            </div>
                        </div>
                    <?php endif ?>

                    <!-- =============================./ fim lista to fazendo ======================================= -->

                </div>
            </div>
            <div class="card card-row card-default">
                <div class="card-header bg-info">
                    <h3 class="card-title">
                        Processo de Homologação
                    </h3>
                </div>
                <div class="card-body">

                    <?php if (!empty($list_homologacao) && is_array($list_homologacao)) : ?>

                        <?php foreach ($list_homologacao as $homolocacao) : ?>
                            <div class="card card-light card-outline">
                                <div class="card-header">
                                    <h5 class="card-title"><?= esc($homolocacao['hml_nome_backlog']) ?></h5>
                                    <div class="card-tools">
                                        <a href="/kanban-homologacao/painel-de-homologacao-status/<?= esc($homolocacao['hml_fk_projeto']) ?>/<?= esc($homolocacao['hml_fk_backlog']) ?>" class="btn btn-tool">
                                            <i class="fas fa-pen" style="color: deepskyblue;"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="card-body p-0" style="display: block;">
                                        <ul class="nav nav-pills flex-column">
                                            <?php
                                            foreach ($homologacao_atividades as $key2 => $atividades) {
                                                if ($homolocacao['hml_fk_backlog'] == $atividades['hml_fk_backlog']) {
                                            ?>
                                                    <li class="nav-item active">
                                                        <a href="#" class="nav-link">
                                                            <?= esc($atividades['hml_ativ_descricao']) ?>
                                                            <span class="badge bg-info float-right"><?= date('d/m/Y', strtotime($atividades['updated_at']))  ?></span>
                                                        </a>
                                                    </li>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <p class="text-danger">Pendente de revisão</p>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    <?php else : ?>
                        <p class="text-center">Sem registro para ser homologados.</p>
                    <?php endif ?>

                </div>
            </div>
            <div class="card card-row card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        Concluídos
                    </h3>
                </div>
                <div class="card-body">


                    <?php if (!empty($lista_concluidos) && is_array($lista_concluidos)) : ?>

                        <?php foreach ($lista_concluidos as $news_concluidos) : ?>

                            <div class="card card-success collapsed-card">
                                <div class="card-header">
                                    <h3 class="card-title"><?= esc($news_concluidos['cl_nome_backlog']) ?></h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- lista table atividades -->
                                    <ul class="todo-list ui-sortable" data-widget="todo-list">
                                        <?php
                                        foreach ($list_concluida_atividades as $key3 => $atividades3) {
                                            if ($news_concluidos['cl_nome_backlog'] == $atividades3['cl_nome_backlog']) {
                                        ?>
                                                <li>
                                                    <!-- checkbox -->
                                                    <div class="icheck-primary d-inline ml-2">
                                                        <input type="checkbox" name="todo1" <?php if ($atividades3['cl_status'] == '1') {
                                                                                                echo 'checked';
                                                                                            } ?> id="<?= esc($atividades3['cl_id']) ?>">
                                                        <label for="<?= esc($atividades3['cl_id']) ?>"></label>
                                                    </div>
                                                    <!-- todo text -->
                                                    <span class="text"><?= esc($atividades3['cl_ativ_descricao']) ?></span>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php else : ?>
                        <h3 class="text-center text-muted">Sem registros</h3>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>
</div>





<?= $this->endSection() ?>

<?= $this->section('script_geral') ?>

<script>
    $(function() {
        setTimeout(function() {
            $('.message_hide_avisa_nova_tarefa_atividade').hide();
        }, 3000);
    });
</script>
<script>
    $(document).on("change", "input[name='chk']",
        function() {
            var checkbox = 0;
            if ($(this).is(':checked')) {
                var checkbox = $(this).val();
            }
            var id = $(this).attr("id");
            $.ajax({
                url: "<?php echo site_url("/kanban_to_fazendo/muda-estado-da-tarefa"); ?>",
                type: "GET",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: {
                    id: id,
                    checkbox: checkbox,
                },
                success: function(data) {
                    alert(data);
                    window.location.reload(true);
                },
                error: function(data) {
                    alert(data);
                    // Revert
                    //checkbox.attr("checked", !checked);
                }
            });
        });
</script>
<?= $this->endSection() ?>

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