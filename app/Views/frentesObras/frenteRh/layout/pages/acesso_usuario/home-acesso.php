<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<section class="content col-md-12">
    <div class="container-fluid">
        <h5 class="mb-2"><?= esc($title) ?></h5>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Informações pessoal de acesso</h5>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Quick Example</h3>
                                    </div>

                                    <br>
                                    <div class="col-md-12">
                                        <?php if (session('msg')) : ?>
                                            <div class="alert alert-info alert-dismissible">
                                                <?= session('msg') ?>
                                                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <!-- /.card-header -->
                                    <br>
                                    <div class="text-center">
                                        <?php
                                        if (is_null(session()->get('foto'))) {
                                        ?>
                                            <img id="blah" class="profile-user-img img-fluid img-circle" src="/dist/img/user4-128x128.jpg" alt="User profile picture">
                                        <?php
                                        } else {
                                        ?>
                                            <img id="blah" class="profile-user-img img-fluid img-circle" src="<?php echo WRITEPATH . 'uploads\perfil\\' . session()->get('foto') ?>" alt="Foto perfíl">
                                        <?php
                                        }

                                        ?>

                                    </div>
                                    <!-- form start -->
                                    <form action="/dados_pessoais/altera-dados-foto/<?= session()->get('id_pw') ?>" name="ajax_form" id="ajax_form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                        <?= csrf_field() ?>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="file_perfil">Selecionar imagam</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file_perfil" id="file_perfil" onchange="readURL(this);" accept=".png, .jpg, .jpeg">
                                                        <label class="custom-file-label" for="customFileLang">Selecionar Arquivo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                                var fileName = document.getElementById("file_perfil").files[0].name;
                                                var nextSibling = e.target.nextElementSibling
                                                nextSibling.innerText = fileName
                                            })
                                        </script>
                                        <!-- /.card-body -->
                                        <input type="hidden" name="file_id_foto" value="<?= session()->get('id') ?>">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            <!-- /.col -->
                            <div class="col-md-8">


                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Quick Example</h3>
                                    </div>

                                    <br>
                                    <div class="col-12">
                                        <?php
                                        if (session()->get("success_acc")) {
                                        ?>
                                            <div class="alert alert-success">
                                                <?= session()->get("success_acc") ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- /.card-header -->
                                    <?php $validation = \Config\Services::validation(); ?>

                                    <!-- form start -->
                                    <form action="/dados_pessoais/altera_acesso_senha/<?= session()->get('id_pw') ?>" method="POST">
                                        <?= csrf_field() ?>

                                        <div class="card-body">

                                            <div class="form-row">

                                                <div class="form-group col-md-8">
                                                    <label for="user_my_nome">Nome:</label>
                                                    <input type="text" class="form-control" id="user_my_nome" value="<?= esc($dd_funcionario['f_nome']) ?>" disabled>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="matricula">Matrícula</label>
                                                    <input type="text" class="form-control" id="matricula" value="<?= esc($dd_funcionario['f_matricula']) ?>" disabled>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="meu_email_pessoal">Email</label>
                                                    <input type="email" class="form-control <?= ($validation->hasError('meu_email_pessoal')) ? 'is-invalid' : '' ?>" name="meu_email_pessoal" value="<?= esc($dd_funcionario['f_email_pessoal']) ?>">
                                                    <?php if ($validation->getError('meu_email_pessoal')) { ?>
                                                        <div class='text-danger mt-2'>
                                                            <?= $error = $validation->getError('meu_email_pessoal'); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="minha_nova_senha">Nova Senha:</label>
                                                    <input type="text" class="form-control <?= ($validation->hasError('minha_nova_senha')) ? 'is-invalid' : '' ?>" name="minha_nova_senha" placeholder="Ex.: 12345">
                                                    <?php if ($validation->getError('minha_nova_senha')) { ?>
                                                        <div class='text-danger mt-2'>
                                                            <?= $error = $validation->getError('minha_nova_senha'); ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>

                                            </div>

                                        </div>
                                        <!-- /.card-body -->

                                        <input type="hidden" name="user_id_acc" value="<?= session()->get('id') ?>">
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </form>
                                </div>


                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div><!-- /.container-fluid -->
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>

<script>
    function readURL(input, id) {
        id = id || '#blah';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    $(document).ready(function() {

    });
</script>
<?= $this->endSection() ?>