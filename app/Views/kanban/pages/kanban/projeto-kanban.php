<?= $this->extend('Views/kanban/layout/Base_layout') ?>

<?= $this->section('content') ?>
<div class="row">

    <?php $validation =  \Config\Services::validation(); ?>
    <div class="col-12">
        <?php
        if (session()->getFlashdata('success_proj')) : ?>
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i> OK!</h5>
                <?php echo session()->getFlashdata('success_proj') ?>
            </div>
        <?php elseif (session()->getFlashdata('error_proj')) : ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                <?php echo session()->getFlashdata('error_proj') ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">
                    Dados do projeto
                </h3>
            </div>

            <!-- /.card-header -->
            <?php $validation = \Config\Services::validation(); ?>
            <form action="/kanban/salvar-projeto" method="post">
                <div class="card-body">
                    <?= csrf_field() ?>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nome do Projeto</label>
                                <input type="text" class="form-control <?php if ($validation->getError('kan_pro_nome')) : ?>is-invalid<?php endif ?>" name="kan_pro_nome" value="<?= old('kan_pro_nome') ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_nome')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_nome'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Data inicial da etapa</label>
                                <input type="date" class="form-control <?php if ($validation->getError('kan_pro_data_inicial')) : ?>is-invalid<?php endif ?>" name="kan_pro_data_inicial" value="<?= old('kan_pro_data_inicial') ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_data_inicial')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_data_inicial'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Data final da etapa</label>
                                <input type="date" class="form-control <?php if ($validation->getError('kan_pro_data_final')) : ?>is-invalid<?php endif ?>" name="kan_pro_data_final" value="<?= old('kan_pro_data_final') ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_data_final')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_data_final'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Descrição do projeto</label>
                                <textarea id="summernote" class="form-control <?php if ($validation->getError('kan_pro_descricao')) : ?>is-invalid<?php endif ?>" name="kan_pro_descricao"><?= old('kan_pro_descricao') ?></textarea>
                                <!-- Error -->
                                <?php if ($validation->getError('kan_pro_descricao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('kan_pro_descricao'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                    <input type="hidden" name="id_usuario_kanban" value="<?= session()->get('id_pw') ?>">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </form>
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