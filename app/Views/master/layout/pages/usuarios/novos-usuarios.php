<?= $this->extend('master\layout\template\base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= esc($title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <br>


        <?php
        if (session()->has("success_users")) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?= session("success_users") ?>
                </div>
            </div>

        <?php
        }
        ?>


        <form action="/usuario_admin/salva_usuarios" method="post" autocomplete="off">
            <div class="card-body">

                <?php $validation = \Config\Services::validation(); ?>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label for="nome_user">Nome completo:</label>
                        <input type="text" class="form-control" name="nome_user" value="<?= old('nome_user') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('nome_user')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('nome_user'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cargo_user">Cargo:</label>
                        <select class="custom-select rounded-0" name="cargo_user">
                            <option selected disabled>Selecione aqui...</option>
                            <?php if (!empty($list_cargos) && is_array($list_cargos)) : ?>
                                <?php foreach ($list_cargos as $lt_cargos) : ?>
                                    <option value="<?= esc($lt_cargos['id_cargo']) ?>"><?= esc($lt_cargos['cargo_nome']) ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option>Sem registro cadastrado</option>
                            <?php endif ?>
                        </select>
                        <?php if ($validation->getError('cargo_user')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('cargo_user'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="email_user">Email:</label>
                        <input type="email" class="form-control" name="email_user" value="<?= old('email_user') ?>">

                        <?php if ($validation->getError('email_user')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('email_user'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="matricula_user">Matrícula:</label>
                        <input type="text" class="form-control" name="matricula_user" value="<?= old('matricula_user') ?>">

                        <?php if ($validation->getError('matricula_user')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('matricula_user'); ?>
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
                <a href="/admin_master/gestao_master" class="btn btn-warning">
                    <i class="fas fa-reply-all"></i> Voltar
                </a>
            </div>
        </form>
    </div>
    <!-- /.card -->

</div>
<?= $this->endSection() ?>