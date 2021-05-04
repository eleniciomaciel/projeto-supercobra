<?= $this->extend('master\layout\template\base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Cento de Custo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <br>


        <?php
        if (session()->has("success")) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?= session("success") ?>
                </div>
            </div>

        <?php
        }
        ?>


        <form action="/centocusto/save-cento-custo" method="post">
            <div class="card-body">

                <?php $validation = \Config\Services::validation(); ?>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="neu_numero_cc">Número do cc:</label>
                        <input type="text" class="form-control" name="neu_numero_cc" value="<?= old('neu_numero_cc') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('neu_numero_cc')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('neu_numero_cc'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_descricao_cc">Descrição:</label>
                        <input type="text" class="form-control" name="new_descricao_cc" value="<?= old('new_descricao_cc') ?>">
                        <?php if ($validation->getError('new_descricao_cc')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_descricao_cc'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_data_inicial">Obra</label>
                        <select class="form-control" name="new_obra_cc" id="new_obra_cc">
                            <option selected disabled>Selecione aqui...</option>
                            <?php if (!empty($list_ob) && is_array($list_ob)) : ?>
                                <?php foreach ($list_ob as $news_list_ob) : ?>
                                    <option value="<?php echo $news_list_ob['id'] ?>" <?php if ($news_list_ob['id'] == set_value('new_obra_cc')) echo "selected = 'selected'"?>><?php echo $news_list_ob['obras_local'] ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option>Sem obras cadastradas</option>
                            <?php endif ?>
                        </select>
                        <?php if ($validation->getError('new_obra_cc')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_obra_cc'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_data_final">Status</label>
                        <select class="form-control" name="new_status_cc" required>
                            <option selected disabled>selecione aqui...</option>
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                            <option value="deleted">Desativado</option>
                        </select>
                        <?php if ($validation->getError('new_status_cc')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('new_status_cc'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
                </button>
                <a href="/admin-panel" class="btn btn-warning">
                    <i class="fas fa-reply-all"></i> Voltar
                </a>
            </div>
        </form>
        <br>
        <?php
        if (session()->has("success_cento_cc")) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?= session("success_cento_cc") ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
    <!-- /.card -->

</div>
<?= $this->endSection() ?>