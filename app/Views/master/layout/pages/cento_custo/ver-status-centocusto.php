<?= $this->extend('master\layout\template\base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Alterar dados do status do Cento de Custo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <br>


        <?php
        if (session()->has("success_cento_ust_cc")) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?= session("success_cento_ust_cc") ?>
                </div>
            </div>

        <?php
        }
        ?>


        <form action="/centocusto/altera-status_cento-custo/<?= esc($dd_cc['id_cc']) ?>" method="post">
            <div class="card-body">

                <?php $validation = \Config\Services::validation(); ?>

                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="neu_numero_cc_up">Número do cc:</label>
                        <input type="text" class="form-control" name="neu_numero_cc_up" value="<?= esc($dd_cc['numero_cc']) ?>" disabled>
                        
                    </div>

                    <div class="form-group col-md-12">
                    <label for="new_data_final">Status</label>
                        <select class="form-control" name="up_status_cc" required>
                            <option selected disabled>Selecione aqui...</option>
                            <option value="active">Ativo</option>
                            <option value="inactive">Inativo</option>
                            <option value="deleted">Desativado</option>
                        </select>
                        <?php if ($validation->getError('up_status_cc')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('up_status_cc'); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <input type="hidden" name="id_do_cc" value="<?= esc($dd_cc['id_cc']) ?>">

            <div class="card-footer">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save"></i> Alterar
                </button>
                <a href="/admin_master/gestao_master" class="btn btn-warning">
                    <i class="fas fa-reply-all"></i> Voltar
                </a>
            </div>
        </form>
    </div>
    <!-- /.card -->

</div>
<?= $this->endSection() ?>