<?=form_open('Transporte/FornecedorNovoController/cadastraRepresentante', array('id'=>'form_representante'))?>
    <div class="form-row">

        <div class="form-group col-md-12">
            <label for="fort_name">Nome:</label>
            <input type="text" class="form-control" name="fort_name" id="fort_name" placeholder="Ex.: Ana Silva" value="">
            <span class="text-danger error-text fort_name_error"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="fort_email">Email:</label>
            <input type="email" class="form-control" name="fort_email" id="fort_email" placeholder="Ex.: ana@email.com" value="">
            <span class="text-danger error-text fort_email_error"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="fort_cpf">CPF:</label>
            <input type="text" class="form-control" name="fort_cpf" id="fort_cpf" value="" placeholder="000.000-000-00" autocomplete="off">
            <span class="text-danger error-text fort_cpf_error"></span>
        </div>


        <div class="form-group col-md-6">
            <label for="fort_telefone">Telefone:</label>
            <input type="tel" class="form-control" name="fort_telefone" id="fort_telefone" placeholder="Ex.: (00) 3632-9877" value="">
            <span class="text-danger error-text fort_telefone_error"></span>
        </div>

        <div class="form-group col-md-6">
            <label for="fort_telefone2">Telefone 2:</label>
            <input type="tel" class="form-control" name="fort_telefone2" id="fort_telefone2" placeholder="Ex.: (00) 3632-9877" value="">
            <span class="text-danger error-text fort_telefone2_error"></span>
        </div>

        <div class="form-group col-md-12">
            <label for="fort_observacao">Observações:</label>
            <textarea class="form-control" name="fort_observacao" id="fort_observacao" rows="3" placeholder="Digite aqui..."></textarea>
            <span class="text-danger error-text fort_observacao_error"></span>
        </div>

    </div>
    <!-- /.card-body -->
    <input type="hidden" name="fort_obra" value="<?= session()->get('log_obra') ?>">
    <input type="hidden" name="fort_frente" value="<?= session()->get('log_frente') ?>">
    <input type="hidden" name="fort_usuario" value="<?= session()->get('id') ?>">

    <div class="card-footer">
        <div class="id_btn_fornecedor"></div>
        <button type="submit" class="cls_add_representante btn btn-primary" id="btn_add_representante">
            <i class="fas fa-save"></i> Salvar
        </button>
    </div>
</form>
