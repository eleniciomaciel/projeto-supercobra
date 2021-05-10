<?= $this->extend('master\layout\template\base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= esc($title) ?></h3>
        </div>
        <br>
        <!-- /.card-header -->
        <?php
        if (session()->has("success_users_cria_user")) {
        ?>
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?= session("success_users_cria_user") ?>
                </div>
            </div>

        <?php
        }
        ?>

        <?php if (!empty($usuarios_login) && is_array($usuarios_login)) : ?>
            <?php $validation = \Config\Services::validation(); ?>
            <?php

            if (session()->has("success_users_cria_user_update")) {
            ?>
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> OK!</h5>
                        <?= session("success_users_cria_user_update") ?>
                    </div>
                </div>

            <?php
            }
            ?>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/usuario_acesso/altera-status-login/<?= esc($usuarios_login['au_id']) ?>" method="POST">
                <div class="card-body">

                    <div class="form-group">
                        <label for="up_acc_nome">Usuário</label>
                        <input type="text" class="form-control" name="up_acc_nome" value="<?= esc($usuarios_login['f_nome']) ?>" disabled>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="up_acc_email">Email</label>
                            <input type="email" class="form-control" name="up_acc_email" value="<?= esc($usuarios_login['au_login_corp']) ?>">
                            <?php if ($validation->getError('up_acc_email')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('up_acc_email'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="up_acc_token">Token</label>
                            <input type="text" class="form-control" name="up_acc_token" value="<?= esc($usuarios_login['au_token_active']) ?>" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="up_acc_token">Data expiração</label>
                            <input type="text" class="form-control" name="up_acc_token" value="<?= date('d/m/Y', strtotime(esc($usuarios_login['au_token_expiracao']))) ?>" disabled>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="up_acc_cargo">Cargo:</label>
                            <select name="up_acc_cargo" class="form-control">
                                <?php if (!empty($cargos) && is_array($cargos)) : ?>
                                    <?php foreach ($cargos as $iten_cargo) : ?>
                                        <option value="<?= $iten_cargo['id_cargo'] ?>" <?php if($iten_cargo['id_cargo'] == $usuarios_login['au_fk_cargo']){echo "selected";} ?>><?= esc($iten_cargo['cargo_nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected>Nenhum cargo cadastrado</option>
                                <?php endif ?>
                            </select>
                            <?php if ($validation->getError('up_acc_cargo')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('up_acc_cargo'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="up_acc_codigo">Código:</label>
                            <input type="text" class="form-control" id="up_acc_codigo" value="<?= esc($usuarios_login['f_codigo']) ?>" disabled>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="up_acc_matricula">Matrícula:</label>
                            <input type="text" class="form-control" id="up_acc_matricula" value="<?= esc($usuarios_login['f_matricula']) ?>" disabled>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="up_acc_obra">Obra</label>
                            <select name="up_acc_obra" class="form-control">
                                <?php if (!empty($obras) && is_array($obras)) : ?>
                                    <?php foreach ($obras as $us_obras) : ?>
                                        <option value="<?= esc($us_obras['id']) ?>" <?php if ($us_obras['id'] == $usuarios_login['au_fk_obra']) {
                                                                                        echo "selected";
                                                                                    } ?>><?= esc($us_obras['obras_local']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Não ha obra cadastrada</option>
                                <?php endif ?>
                            </select>
                            <?php if ($validation->getError('up_acc_obra')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('up_acc_obra'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="up_acc_frente">Frente</label>
                            <select name="up_acc_frente" class="form-control">
                                <?php if (!empty($frentes) && is_array($frentes)) : ?>
                                    <?php foreach ($frentes as $us_frentes) : ?>
                                        <option value="<?= esc($us_frentes['id_ft']) ?>" <?php if ($us_frentes['id_ft'] == $usuarios_login['au_fk_frente']) {
                                                                                                echo "selected";
                                                                                            } ?>><?= esc($us_frentes['nome_ft']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Não há frentes cadastrada</option>
                                <?php endif ?>
                            </select>
                            <?php if ($validation->getError('up_acc_frente')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('up_acc_frente'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="up_acc_status">Status</label>
                            <select name="up_acc_status" class="form-control">
                                <option value="1" <?php echo $usuarios_login['au_status'] == '1' ? 'selected' : '' ?>>Ativo</option>
                                <option value="0" <?php echo $usuarios_login['au_status'] == '0' ? 'selected' : '' ?>>Suspenso</option>
                            </select>
                            <?php if ($validation->getError('up_acc_status')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('up_acc_status'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Alterar
                    </button>
                    <a href="/admin_master/gestao_master" class="btn btn-warning">
                        <i class="fas fa-reply-all"></i> Voltar
                    </a>
                </div>
            </form>

        <?php else : ?>

            <form action="/usuario_acesso/gera_acesso_usuarios/<?= esc($ddf['f_id']) ?>" method="post" autocomplete="off">
                <div class="card-body">

                    <?php $validation = \Config\Services::validation(); ?>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="nome_user">Nome completo:</label>
                            <input type="text" class="form-control" name="nome_user" value="<?= esc($ddf['f_nome']) ?>" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cargo_user">Cargo:</label>
                            <select class="custom-select rounded-0" name="cargo_user" disabled>
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($list_cargos) && is_array($list_cargos)) : ?>
                                    <?php foreach ($list_cargos as $lt_cargos) : ?>
                                        <option value="<?php echo $lt_cargos['id_cargo'] ?>" <?php if ($lt_cargos['id_cargo'] == $ddf['f_cargo']) echo "selected = 'selected'" ?>><?php echo $lt_cargos['cargo_nome'] ?></option>
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
                            <label for="obra_user_acesso">Obra</label>
                            <select name="obra_user_acesso" class="form-control">
                            <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($obras) && is_array($obras)) : ?>
                                    <?php foreach ($obras as $us_obras) : ?>
                                        <option value="<?= esc($us_obras['id']) ?>"><?= esc($us_obras['obras_local']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Não ha obra cadastrada</option>
                                <?php endif ?>
                            </select>
                            <?php if ($validation->getError('obra_user_acesso')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('obra_user_acesso'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="up_acc_frente">Frente</label>
                            <select name="frente_user_acesso" class="form-control">
                            <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($frentes) && is_array($frentes)) : ?>
                                    <?php foreach ($frentes as $us_frentes) : ?>
                                        <option value="<?= esc($us_frentes['id_ft']) ?>"><?= esc($us_frentes['nome_ft']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>Não há frentes cadastrada</option>
                                <?php endif ?>
                            </select>
                            <?php if ($validation->getError('frente_user_acesso')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('frente_user_acesso'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="email_user_acesso">Login:</label>
                            <input type="email" class="form-control" name="email_user_acesso" value="<?= esc($ddf['f_email_pessoal']) ?>">

                            <?php if ($validation->getError('email_user_acesso')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('email_user_acesso'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="senha_user_acesso">Senha:</label>
                            <input type="text" class="form-control" name="senha_user_acesso" value="<?= esc($ddf['f_codigo']) ?>">

                            <?php if ($validation->getError('senha_user_acesso')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('senha_user_acesso'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="hidden" name="id_usuario_acesso" value="<?= esc($ddf['f_id']) ?>">

                            <?php if ($validation->getError('id_usuario_acesso')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('id_usuario_acesso'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-save"></i> Gerar acesso
                    </button>
                    <a href="/admin_master/gestao_master" class="btn btn-warning">
                        <i class="fas fa-reply-all"></i> Voltar
                    </a>
                </div>
            </form>

        <?php endif ?>

    </div>
    <!-- /.card -->

</div>
<?= $this->endSection() ?>