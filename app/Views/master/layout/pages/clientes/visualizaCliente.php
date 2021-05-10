<?= $this->extend('master\layout\template\base_layout') ?>

<?= $this->section('content') ?>
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Dados do Cliente</h3>
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


        <form action="/clientes/atualizarCliente" method="post">
            <div class="card-body">

                <div class="form-row">

                    <div class="form-group col-md-8">
                        <label for="new_nome_cleinete">Nome:</label>
                        <input type="text" class="form-control" name="new_nome_cleinete" value="<?= esc($info['nome_cli']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="new_cnpj">CNPJ:</label>
                        <input type="text" class="form-control" name="new_cnpj" value="<?= esc($info['cnpj_cli']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_data_inicial">Data Inicial</label>
                        <input type="date" class="form-control" name="new_data_inicial" value="<?= esc($info['data_inicio_cli']) ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="new_data_final">Data Final</label>
                        <input type="date" class="form-control" name="new_data_final" value="<?= esc($info['data_final_cli']) ?>">
                    </div>

                    <div class="form-group col-md-2">
                        <label for="new_cep">Cep:</label>
                        <input type="text" class="form-control" name="new_cep" value="<?= esc($info['cep_cli']) ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="new_estado">Estado:</label>
                        <input type="text" class="form-control" name="new_estado" value="<?= esc($info['uf_cli']) ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="new_cidade">Cidade:</label>
                        <input type="text" class="form-control" name="new_cidade" value="<?= esc($info['cidade_cli']) ?>">
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="new_endereco">Endereço:</label>
                        <input type="text" class="form-control" name="new_endereco" value="<?= esc($info['endereco_cli']) ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="new_numero">Número:</label>
                        <input type="text" class="form-control" name="new_numero" value="<?= esc($info['numero_cli']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="new_bairro">Bairro:</label>
                    <input type="text" class="form-control" name="new_bairro" value="<?= esc($info['bairro_cli']) ?>">
                </div>

                <div class="form-group">
                    <div class="form-group">
                        <label for="new_objeto">Objeto:</label>
                        <textarea class="form-control" name="new_objeto" rows="3"><?= esc($info['description_cli']) ?></textarea>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <input type="hidden" name="id_cliente_up" value="<?= esc($info['id_cli']) ?>">

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