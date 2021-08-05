
    <!-- /.card-header -->
    <?php $validation = \Config\Services::validation(); ?>
   

    <!-- form start -->
    <?= form_open('Transporte/FornecedorController/cadstroFornecedor') ?>

    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="fort_name">Nome:</label>
            <input type="text" class="form-control" name="fort_name" id="fort_name" placeholder="Ex.: Ana Silva" value="<?= old('fort_name') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_name')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_name'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="fort_email">Email:</label>
            <input type="email" class="form-control" name="fort_email" id="fort_email" placeholder="Ex.: ana@email.com" value="<?= old('fort_email') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_email')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_email'); ?>
                </div>
            <?php } ?>
        </div>


        <div class="form-group col-md-4">
            <label for="fort_telefone">Telefone:</label>
            <input type="tel" class="form-control" name="fort_telefone" id="fort_telefone" placeholder="Ex.: (00) 3632-9877" value="<?= old('fort_telefone') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_telefone')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_telefone'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="fort_cpf">CPF:</label>
            <input type="text" class="form-control" name="fort_cpf" id="fort_cpf" value="<?= old('fort_cpf') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_cpf')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_cpf'); ?>
                </div>
            <?php } ?>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col-md-3">
            <label for="fort_cep">CEP:</label>
            <input type="text" class="form-control" name="fort_cep" id="fort_cep" value="<?= old('fort_cep') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_cep')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_cep'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-3">
            <label for="fort_uf">UF:</label>
            <input type="text" class="form-control" name="fort_uf" id="fort_uf" readonly value="<?= old('fort_uf') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_uf')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_uf'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-6">
            <label for="fort_cidade">Cidade:</label>
            <input type="text" class="form-control" name="fort_cidade" id="fort_cidade" readonly value="<?= old('fort_cidade') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_cidade')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_cidade'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="fort_bairro">Bairro:</label>
            <input type="text" class="form-control" name="fort_bairro" id="fort_bairro" placeholder="Ex.: Luiz Sena" value="<?= old('fort_bairro') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_bairro')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_bairro'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-8">
            <label for="fort_endereco">Endereço:</label>
            <input type="text" class="form-control" name="fort_endereco" id="fort_endereco" placeholder="Ex.:Rua da Matriz, nº 500" value="<?= old('fort_endereco') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_endereco')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_endereco'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-12">
            <label for="fort_observacao">Observações:</label>
            <textarea class="form-control" name="fort_observacao" id="fort_observacao" rows="3" placeholder="Digite aqui..."><?= old('fort_observacao') ?></textarea>
            <!-- Error -->
            <?php if ($validation->getError('fort_observacao')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_observacao'); ?>
                </div>
            <?php } ?>
        </div>

    </div>
    <!-- /.card-body -->
    <input type="hidden" name="fort_obra" value="<?= session()->get('log_obra') ?>">
    <input type="hidden" name="fort_frente" value="<?= session()->get('log_frente') ?>">
    <input type="hidden" name="fort_usuario" value="<?= session()->get('id') ?>">

    <div class="card-footer">
    <div class="id_btn_fornecedor"></div>
        <button type="submit" class="btn btn-primary" id="btnSubmit_Fornecedor">
            <i class="fas fa-save"></i> Salvar
        </button>
    </div>
    </form>
