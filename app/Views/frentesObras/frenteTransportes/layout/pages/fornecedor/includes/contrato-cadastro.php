<!-- /.card-header -->
<?php $validation = \Config\Services::validation(); ?>

<div class="container-fluid">
    <h2 class="text-center display-5">Buscar empresa</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="#">
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" name="search" id="search" placeholder="Buscar aqui...">
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- form start -->
<?= form_open('Transporte/FornecedorController/cadstroFornecedor') ?>
<br>
<div class="form-row">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text bg-danger">MTQ</span>
        </div>
        <input type="text" aria-label="First name" class="form-control" value="LOOC">
        <input type="text" aria-label="Last name" class="form-control" value="COB">
        <input type="text" aria-label="Last name" class="form-control" value="0010">
    </div>
</div>


<fieldset class="scheduler-border">

    <legend class="info-box-text">1. LOCADORA:</legend>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="fort_name">Razão Social/Nome:</label>
            <input type="text" class="form-control" name="fort_name" id="fort_name" placeholder="Ex.: Ana Silva" value="<?= old('fort_name') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_name')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_name'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="fort_email">CNPJ/CPF:</label>
            <input type="email" class="form-control" name="fort_email" id="fort_email" placeholder="Ex.: ana@email.com" value="<?= old('fort_email') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_email')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_email'); ?>
                </div>
            <?php } ?>
        </div>


        <div class="form-group col-md-4">
            <label for="fort_telefone">Inscrição Estadual:</label>
            <input type="tel" class="form-control" name="fort_telefone" id="fort_telefone" placeholder="Ex.: (00) 3632-9877" value="<?= old('fort_telefone') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_telefone')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_telefone'); ?>
                </div>
            <?php } ?>
        </div>

        <div class="form-group col-md-4">
            <label for="fort_cpf">Inscrição Estadual::</label>
            <input type="text" class="form-control" name="fort_cpf" id="fort_cpf" value="<?= old('fort_cpf') ?>">
            <!-- Error -->
            <?php if ($validation->getError('fort_cpf')) { ?>
                <div class='text-danger mt-2'>
                    <?= $error = $validation->getError('fort_cpf'); ?>
                </div>
            <?php } ?>
        </div>
    </div>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">2. OBJETO DO CONTRATO:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição do contrato:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">2. VIGÊNCIA:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição da vigência:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">3. PREÇOS E CONDIÇÕES DE PAGAMENTOS:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição das condições e preços:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">5. DADOS PARA EMISSÃO DO RECIBO OU FATURAMENTO DE LOCAÇÃO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da emissão:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">6. DADOS PARA EMISSÃO DA NOTA FISCAL DE SERVIÇO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da nota:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">7. INFORMAÇÕES BANCÁRIAS PARA O PAGAMENTO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da conta:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">8. RESPONSÁVEL DA LOCAÇÃO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da do responsável:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">9. CONDIÇÕES NEGOCIADAS DO CONTRATO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da das condições:</label>
        <textarea class="form-control" id="obj_descricao" placeholder="Digite aqui..." rows="3"></textarea>
        <!-- Error -->
        <?php if ($validation->getError('fort_cep')) { ?>
            <div class='text-danger mt-2'>
                <?= $error = $validation->getError('fort_cep'); ?>
            </div>
        <?php } ?>
    </div>
</fieldset>

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