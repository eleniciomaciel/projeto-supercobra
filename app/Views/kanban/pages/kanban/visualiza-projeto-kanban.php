<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">


    <div class="col-12">
        <?php
        if (session()->getFlashdata('success_proj_up')) : ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <?php echo session()->getFlashdata('success_proj_up') ?>
            </div>
        <?php elseif (session()->getFlashdata('error_proj_up')) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                <?php echo session()->getFlashdata('error_proj_up') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Dados do projeto
                    </h3>
                </div>
                <?php $validation =  \Config\Services::validation(); ?>
                <form action="<?= base_url('Kanban/KanbanController/alterarProjeto/' . $ddProjetos['kbp_id']) ?>" method="post">
                    <div class="card-body">
                        <?= csrf_field() ?>
                        <div class="row">

                            <div class="form-group col-6">
                                <label>Nome do Projeto:</label>
                                <input type="text" class="form-control <?php if ($validation->getError('kan_pro_nome')) : ?>is-invalid<?php endif ?>" name="kan_pro_nome" value="<?= esc($ddProjetos['kbp_nome_projeto']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_nome')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_nome'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-6">
                                <label>Justificativa da alteração:</label>
                                <input type="text" class="form-control <?php if ($validation->getError('kan_pro_controle_versao')) : ?>is-invalid<?php endif ?>" name="kan_pro_controle_versao" value="<?= old('kan_pro_controle_versao') ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_controle_versao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_controle_versao'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-4">
                                <label>Data inicial da etapa</label>
                                <input type="date" class="form-control <?php if ($validation->getError('kan_pro_data_inicial')) : ?>is-invalid<?php endif ?>" name="kan_pro_data_inicial" value="<?= esc($ddProjetos['kbp_data_inicial']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_data_inicial')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_data_inicial'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-4">
                                <label>Data final da etapa</label>
                                <input type="date" class="form-control <?php if ($validation->getError('kan_pro_data_final')) : ?>is-invalid<?php endif ?>" name="kan_pro_data_final" value="<?= esc($ddProjetos['kbp_data_final']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_data_final')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_data_final'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-4">
                                <label>Status do projeto</label>
                                <select class="custom-select rounded-0 <?php if ($validation->getError('kan_pro_status')) : ?>is-invalid<?php endif ?>" name="kan_pro_status">
                                    <option selected disabled>Selecione aqui...</option>
                                    <option value="Ativo" <?php if ($ddProjetos['kbp_status'] == 'Ativo') {
                                                                echo 'selected';
                                                            } ?>>Ativo</option>
                                    <option value="Pendente" <?php if ($ddProjetos['kbp_status'] == 'Pendente') {
                                                                    echo 'selected';
                                                                } ?>>Pendente</option>
                                    <option value="Concluído" <?php if ($ddProjetos['kbp_status'] == 'Concluído') {
                                                                    echo 'selected';
                                                                } ?>>Concluído</option>
                                </select>
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_status')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_status'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-12">
                                <label>Descrição do projeto</label>
                                <textarea id="summernote" class="form-control <?php if ($validation->getError('kan_pro_descricao')) : ?>is-invalid<?php endif ?>" name="kan_pro_descricao"><?= esc($ddProjetos['kbp_detalhes_projeto']) ?></textarea>
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_descricao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_descricao'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <input type="hidden" name="origin_id" value="<?= esc($ddProjetos['kbp_id']) ?>">
                        <input type="hidden" name="origin_name" value="<?= esc($ddProjetos['kbp_nome_projeto']) ?>">
                        <input type="hidden" name="origin_data_inicial" value="<?= esc($ddProjetos['kbp_data_inicial']) ?>">
                        <input type="hidden" name="origin_data_final" value="<?= esc($ddProjetos['kbp_data_final']) ?>">
                        <input type="hidden" name="origin_descricao" value="<?= esc($ddProjetos['kbp_detalhes_projeto']) ?>">
                        <input type="hidden" name="id_usuario_kanban" value="<?= session()->get('id_pw') ?>">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Alterar</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="col-md-5">

            <?php
            if (session()->getFlashdata('success_backlog')) : ?>
                <div class="message_add_backlog alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('success_backlog') ?>
                </div>
            <?php elseif (session()->getFlashdata('error_backlog')) : ?>
                <div class="message_add_backlog alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                    <?php echo session()->getFlashdata('error_backlog') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Criar Backlog do Projeto</h3>
                </div>
                <!-- /.card-header -->
                <form action="/kanban/savaBacklog" method="POST">
                    <?= csrf_field() ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="backlog_name">Nome do backlog:</label>
                            <input type="text" class="form-control" name="backlog_name" placeholder="Ex.: Formulário de login">
                            <!-- Error -->
                            <?php if ($validation->getError('backlog_name')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('backlog_name'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="backlog_data_inicial">Data Início:</label>
                                <input type="date" class="form-control" name="backlog_data_inicial" placeholder="Ex.: Formulário de login">
                                <!-- Error -->
                                <?php if ($validation->getError('backlog_data_inicial')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('backlog_data_inicial'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="backlog_data_final">Data Fim:</label>
                                <input type="date" class="form-control" name="backlog_data_final" placeholder="Ex.: Formulário de login">
                                <!-- Error -->
                                <?php if ($validation->getError('backlog_data_final')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('backlog_data_final'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="backlog_name_null">Projeto:</label>
                            <input type="text" class="form-control" id="backlog_name_null" value="<?= esc($ddProjetos['kbp_nome_projeto']) ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Objetivo do Backlog</label>
                            <textarea class="form-control" rows="3" name="backlog_description" placeholder="Digite aqui ..."></textarea>
                            <!-- Error -->
                            <?php if ($validation->getError('backlog_description')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('backlog_description'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <input type="hidden" name="id_projeto_bl" value="<?= esc($ddProjetos['kbp_id']) ?>">
                        <input type="hidden" name="s" value="<?= session()->get('id_pw') ?>">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Lista de Backlog do Projeto</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Data do Backlod</th>
                                <th>Nome do Backlog</th>
                                <th>Status</th>
                                <th>Descrição</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list_backlog) && is_array($list_backlog)) : ?>
                                <?php foreach ($list_backlog as $news_bl) : ?>
                                    <tr>
                                        <td><?= esc(date('d/m/Y', strtotime($news_bl['created_at']))) ?></td>
                                        <td><?= esc($news_bl['bl_nome_backlog']) ?></td>
                                        <td><?= esc($news_bl['bl_status']) ?></td>
                                        <td><?= esc($news_bl['bl_description']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Sem backlog cadastrado</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.col-->
</div>
<!-- ./row -->
<?= $this->endSection() ?>
<?= $this->section('script_geral') ?>
<script>
    $(function() {
        $('#summernote').summernote();
        setTimeout(function() {
            $('.message_add_backlog').hide();
        }, 2500);
    });
</script>
<?= $this->endSection() ?>