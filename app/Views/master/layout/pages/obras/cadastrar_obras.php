<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados da obra</h3>
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


        <form action="/clientes/atualizar-dados-Cliente" method="post">
            <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-md-8">
                        <label for="new_nome_cleinete">Local:</label>
                        <input type="text" class="form-control" name="new_nome_cleinete" value="<?= esc($info['obras_local']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="new_cnpj">CNPJ:</label>
                        <input type="text" class="form-control" name="new_cnpj" value="<?= esc($info['data_inicio']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_data_inicial">Data Inicial</label>
                        <input type="date" class="form-control" name="new_data_inicial" value="<?= esc($info['data_inicio']) ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_data_final">Data Final</label>
                        <input type="date" class="form-control" name="new_data_final" value="<?= esc($info['data_fim']) ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="new_cep">Cep:</label>
                        <input type="text" class="form-control" name="new_cep" value="<?= esc($info['obras_cep']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="new_estado">Estado:</label>
                        <input type="text" class="form-control" name="new_estado" value="<?= esc($info['obras_estado']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_cidade">Cidade:</label>
                        <input type="text" class="form-control" name="new_cidade" value="<?= esc($info['obras_cidade']) ?>">
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="new_endereco">Endereço:</label>
                        <input type="text" class="form-control" name="new_endereco" value="<?= esc($info['obras_endereco']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="new_numero">Número:</label>
                        <input type="text" class="form-control" name="new_numero" value="<?= esc($info['obras_numero']) ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <label for="new_bairro">Bairro:</label>
                        <input type="text" class="form-control" name="new_bairro" value="<?= esc($info['obras_bairro']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_data_inicial">Cliente</label>
                        <input type="text" class="form-control" name="new_data_inicial" value="<?= esc($info['nome_cli']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_data_final">Status</label>
                        <input type="text" class="form-control" name="new_data_final" value="<?= esc($info['obras_cliente']) ?>">
                    </div>

                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="new_objeto">Observação:</label>
                            <textarea class="form-control" name="new_objeto" rows="3"><?= esc($info['obras_description']) ?></textarea>
                        </div>
                    </div>

                </div>



            </div>
            <!-- /.card-body -->
            <input type="hidden" name="id_cliente_up" value="<?= esc($info['id']) ?>">

            <div class="card-footer">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-sync-alt"></i> Alterar
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