<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">

    <div class="row">
        <div class="col-md-12">
            <a href="/admin_rh/cadastro-colaboradores" class="btn btn-secondary btn-flat">
                <i class="fas fa-reply-all"></i> Voltar
            </a><br><br>
            <?php
            // Display Response 
            if (session()->has('message')) {
            ?>
                <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php
            }

            ?>
            <?php $validation = \Config\Services::validation(); ?>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><?= esc($title) ?></h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="/transferencia/processa-transferencia/<?= esc($dd_user_t['f_id']) ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputEmail4">Obra</label>
                                        <select name="t_obra" class="form-control">
                                            <?php if (!empty($view_obra) && is_array($view_obra)) : ?>
                                                <?php foreach ($view_obra as $new_obra) : ?>
                                                    <option value="<?= esc($new_obra['id']) ?>" <?php if ($new_obra['id'] == $dd_user_t['f_fk_obra']) {
                                                                                                    echo 'selected';
                                                                                                } ?>><?= esc($new_obra['obras_local']) ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option selected disabled>Não ha obras cadastradas</option>
                                            <?php endif ?>
                                        </select>
                                        <!-- Error -->
                                        <?php if ($validation->getError('t_obra')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('t_obra'); ?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPassword4">Frente</label>
                                        <select name="t_frente" class="form-control">
                                            <?php if (!empty($view_frente) && is_array($view_frente)) : ?>
                                                <?php foreach ($view_frente as $new_frente) : ?>
                                                    <option value="<?= esc($new_frente['id_ft']) ?>" <?php if ($new_frente['id_ft'] == $dd_user_t['f_Fk_frente']) {
                                                                                                        echo 'selected';
                                                                                                    } ?>><?= esc($new_frente['nome_ft']) ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option selected disabled>Não ha obras cadastradas</option>
                                            <?php endif ?>
                                        </select>
                                        <!-- Error -->
                                        <?php if ($validation->getError('t_frente')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('t_frente'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputCity">Matrícula</label>
                                        <input type="text" class="form-control" id="inputCity" value="<?= esc($dd_user_t['f_matricula']) ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Código</label>
                                        <input type="text" class="form-control" id="inputCity" value="<?= esc($dd_user_t['f_codigo']) ?>" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="t_cargo">Cargo</label>
                                        <select name="t_cargo" class="form-control">
                                            <?php if (!empty($view_cargos) && is_array($view_cargos)) : ?>
                                                <?php foreach ($view_cargos as $new_cargos) : ?>
                                                    <option value="<?= esc($new_cargos['id_cargo']) ?>" <?php if ($new_cargos['id_cargo'] == $dd_user_t['f_cargo']) { echo 'selected'; } ?>><?= esc($new_cargos['cargo_nome']) ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option selected disabled>Não ha obras cadastradas</option>
                                            <?php endif ?>
                                        </select>
                                        <!-- Error -->
                                        <?php if ($validation->getError('t_cargo')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('t_cargo'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger">Transferir</button>
                            </form>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Informações do colaborador</strong>
                            </p>
                            Dados pessoal
                            <address>
                                <strong>CPF: </strong><?= esc($dd_user_t['f_cpf']) ?><br>
                                <strong>NOME: </strong><?= esc($dd_user_t['f_nome']) ?><br>
                                <strong>CARGO: </strong><?= esc($view_User_dado['cargo_nome']) ?><br>
                                <strong>TELEFONE: </strong><?= esc($dd_user_t['f_telefone_contato']) ?><br>
                                <strong>EMAIL: </strong><?= esc($dd_user_t['f_email_pessoal']) ?><br>
                                <strong>FRENTE: </strong><?= esc($view_User_dado['nome_ft']) ?><br>
                                <strong>SITUAÇÃO: </strong><?= esc($dd_user_t['f_situacao']) ?><br>
                            </address>
                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {


    });
</script>
<?= $this->endSection() ?>