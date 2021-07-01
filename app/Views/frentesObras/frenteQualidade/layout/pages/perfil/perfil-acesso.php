<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<section class="content col-12">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <?php
                    $validation = \Config\Services::validation();
                    ?>

                    <?php
                    if (session()->getFlashdata('success_file_qualidade')) {
                    ?>
                        <h3 class="text-danger">
                            <?php echo session()->getFlashdata('success_file_qualidade') ?>
                        </h3>

                    <?php
                    }
                    if (session()->getFlashdata('error_file_qualidade')) {
                    ?>
                        <div class="col-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                                <?php echo session()->getFlashdata('error_file_qualidade') ?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <form action="/admin_qualidade/atualiza-foto-acesso/<?= session()->get('id') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if (is_file(session()->get('au_foto'))) {
                                ?>
                                    <img id="imgPreview" class="profile-user-img img-fluid img-circle" src="uploads/perfil/<?php echo session()->get('au_foto') ?>" alt="Imegem perfil do usuário">
                                <?php

                                } else {
                                ?>
                                    <img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/dist/img/eletricidade.png" id="imgPreview" alt="Imegem perfil do usuário não atualizada">
                                <?php
                                }
                                ?>

                            </div>

                            <h3 class="profile-username text-center"><?= esc($user_dd['f_nome']) ?></h3>

                            <p class="text-muted text-center"><?= esc($user_dd['cargo_nome']) ?></p>

                            <input type="file" class="btn btn-primary btn-block" name="avatar" id="photo" />

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Matrícula</b> <a class="float-right"><?= esc($user_dd['f_matricula']) ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Obra</b> <a class="float-right"><?= esc($user_dd['obras_local']) ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Frente</b> <a class="float-right"><?= esc($user_dd['nome_ft']) ?></a>
                                </li>
                            </ul>

                            <button type="submit" class="btn btn-primary btn-block"><b><i class="fa fa-save"></i> Salvar Foto</b></button>
                        </div>
                        <br>
                        <br>
                        <div class="col-12">
                            <?php $validationErrors = $this->config->plugins['validation_errors']; ?>
                            <p class="text-danger text-center"><?= $validationErrors(['field' => 'avatar']); ?></p>
                            <?php
                            if (session()->getFlashdata('success_imagem_ok')) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>OK!</strong> <?php echo session()->getFlashdata('success_imagem_ok') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php elseif (session()->getFlashdata('failed_imagem_error')) : ?>

                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error! </strong> <?php echo session()->getFlashdata('failed_imagem_error') ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>

                    </form>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <h5>Dados de acesso</h5>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">

                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Cadastro do usuário</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="col-12">
                                        <br>
                                            <?php
                                            if (session()->getFlashdata('success_atualiz_perfil_user')) {
                                            ?>
                                                <div class="alert alert-success alert-dismissible">
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                                                    <?php echo session()->getFlashdata('success_atualiz_perfil_user') ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <!-- form start -->
                                        <form action="/admin_qualidade/dados-acesso_atulizar" method="POST" autocomplete="off">
                                            <?= csrf_field() ?>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="usr_email">Email corporativo</label>
                                                    <input type="email" class="form-control" name="usr_email" placeholder="Enter email" value="<?= session()->get('login_use') ?>">
                                                    <!-- Error -->
                                                    <?php if ($validation->getError('usr_email')) { ?>
                                                        <div class='text-danger mt-2'>
                                                            <?= $error = $validation->getError('usr_email'); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="urs_pw">Nova Senha</label>
                                                    <input type="text" class="form-control" name="urs_pw" placeholder="Ex.: 12345678" value="<?= old('urs_pw') ?>">
                                                    <!-- Error -->
                                                    <?php if ($validation->getError('urs_pw')) { ?>
                                                        <div class='text-danger mt-2'>
                                                            <?= $error = $validation->getError('urs_pw'); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <input type="hidden" name="urs_usuario" value="<?= session()->get('id_pw') ?>">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-danger">Alterar</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>
<?= $this->section('script_toast_transporte') ?>
<script>
    $(document).ready(() => {
        $("#photo").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
<?= $this->endSection() ?>