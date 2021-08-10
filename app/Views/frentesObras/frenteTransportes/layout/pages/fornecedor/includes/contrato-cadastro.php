<!-- /.card-header -->
<?php $validation = \Config\Services::validation(); ?>

<!-- <div class="container-fluid">
    <h2 class="text-center display-5">Buscar empresa</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <form action="#">
                <div class="input-group">
                    <select class="form-control" name="select_empresas" id="select_empresas"></select>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->


<!-- form start -->
<?= form_open('Transporte/FornecedorController/cadstroFornecedor') ?>

<br>
<div class="form-row">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text bg-danger">Contrato</span>
        </div>
        <select class="form-control" aria-label="First name" name="select_frentes" id="select_frentes">
            <option>Selecione a frente do contrato aqui...</option>
        </select>
        <select class="form-control" aria-label="First name" id="exampleFormControlSelect1">
            <option>Selecione o tipo de contrato aqui...</option>
            <option value="LOO">LOO</option>
            <option value="COO">COO</option>
            <option value="OCO">OCO</option>
        </select>
        <input type="text" aria-label="Last name" class="form-control" value="COB" readonly>
        <input type="number" aria-label="Last name" class="form-control" value="0010" min="1">
    </div>
</div>


<fieldset class="scheduler-border">

    <legend class="info-box-text">1. LOCADORA:</legend>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="fort_name">Razão Social/Nome:</label>
            <?php if (!empty($list_empresa) && is_array($list_empresa)) : ?>
                <?php foreach ($list_empresa as $news_item) : ?>

                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="customCheckbox<?= esc($news_item['ef_id']) ?>" value="option1">
                        <label for="customCheckbox<?= esc($news_item['ef_id']) ?>" class="custom-control-label">Empresa: <?= esc($news_item['ef_razao_social']) ?></label>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Não há empresas cadastradas.</p>
            <?php endif ?>
        </div>
    </div>

</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">2. OBJETO DO CONTRATO:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição do contrato:</label>
        <textarea class="form-control" id="summernote" placeholder="Digite aqui..." rows="3" style="text-align: justify;">

        Inicia-se a vigência deste instrumento a partir da data de sua assinatura pelas partes, respeitando-se o 
        estabelecido na Cláusula Nona do Contrato. No caso de haver mais de um equipamento locado, o início 
        efetivo da locação poderá ser diferente para cada equipamento. O prazo de locação será de 05 (cinco) meses 
        podendo ser prorrogado de comum acordo entre as partes, mediante a celebração de Termo Aditivo ao 
        presente Contrato.
        </textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">2. VIGÊNCIA:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição da vigência:</label>
        <textarea class="form-control vigencia" id="summernote1" placeholder="Digite aqui..." rows="3" style="text-align: justify;">

        O valor mensal da locação do objeto deste Contrato é de R$ 70.000,00 (Setenta mil reais), sendo:
         R$ R$ 63.000,00 (sessenta e três mil reais) referente à locação do veículo e devem ser pagos à 
        Contratada 1 pela Contratante, conforme estabelecido no Contrato.
         R$ 7.000,00 (sete mil reais) referente ao serviço do operador e devem ser pagos à Contratada 2 pela 
        Contratante, conforme estabelecido no Contrato.
        E devem ser pagos à Contratada pela Contratante, conforme estabelecido no Contrato.

    </textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">3. PREÇOS E CONDIÇÕES DE PAGAMENTOS:</legend>

    <div class="form-group">
        <label for="obj_descricao">Descrição das condições e preços:</label>
        <textarea class="form-control" id="summernote2" placeholder="Digite aqui..." rows="3">
        COBRA BRASIL SERVICOS, COMUNICACOES E ENERGIA S/A
        CNPJ: 08.928.273/0008-89 Inscrição Estadual: 002899645.00-49 
        Endereço: R RUA ARTHUR BERNARDES Nº 11, 5º ANDAR, CENTRO, ITABIRITO–MG, CEP 35.450-000
        </textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">5. DADOS PARA EMISSÃO DO RECIBO OU FATURAMENTO DE LOCAÇÃO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da emissão:</label>
        <textarea class="form-control" id="summernote3" placeholder="Digite aqui..." rows="3">
        COBRA BRASIL SERVICOS, COMUNICACOES E ENERGIA S/A
        CNPJ: 08.928.273/0008-89 Inscrição Estadual: 002899645.00-49 
        Endereço: R RUA ARTHUR BERNARDES Nº 11, 5º ANDAR, CENTRO, ITABIRITO–MG, CEP 35.450-000 -
        51.242.43702/75
        </textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">6. DADOS PARA EMISSÃO DA NOTA FISCAL DE SERVIÇO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da nota:</label>
        <textarea class="form-control" id="summernote4" placeholder="Digite aqui..." rows="3">

        </textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">7. INFORMAÇÕES BANCÁRIAS PARA O PAGAMENTO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da conta:</label>
        <textarea class="form-control" id="summernote5" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">8. RESPONSÁVEL DA LOCAÇÃO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da do responsável:</label>
        <textarea class="form-control" id="summernote6" placeholder="Digite aqui..." rows="3"></textarea>
    </div>
</fieldset>

<fieldset class="scheduler-border">
    <legend class="widget-user-username">9. CONDIÇÕES NEGOCIADAS DO CONTRATO:</legend>

    <div class="form-group">
        <label for="obj_descricao" class="widget-user-username">Descrição da das condições:</label>
        <textarea class="form-control" id="summernote7" placeholder="Digite aqui..." rows="3"></textarea>
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