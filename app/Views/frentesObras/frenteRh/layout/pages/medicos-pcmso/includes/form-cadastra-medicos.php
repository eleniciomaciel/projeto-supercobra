<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Cadastar Médico(a)</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?=form_open('Rh/Medicos/PcmsoController/cadastraMedicoPcmso', array('id'=>'quickFormPcmso_form', 'novalidate'=>'novalidate'))?>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="med_name">Nome do médico:</label>
                    <input type="text" class="form-control" name="med_name" id="med_name" placeholder="Ex.: Ana Silva">
                    <span class="text-danger error-text med_name_error"></span>
                </div>

                <div class="form-group col-md-3">
                    <label for="med_email">Email</label>
                    <input type="email" class="form-control" name="med_email" id="med_email" placeholder="Ex.: ana@email.com">
                    <span class="text-danger error-text med_email_error"></span>
                </div>

                <div class="form-group col-md-3">
                    <label for="med_crm">CRM:</label>
                    <input type="text" class="form-control" name="med_crm" id="med_crm" placeholder="Ex.: 123456">
                    <span class="text-danger error-text med_crm_error"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="med_descricao">Observações</label>
                    <textarea class="form-control" name="med_descricao" id="med_descricao" rows="3"></textarea>
                    <span class="text-danger error-text med_descricao_error"></span>
                </div>

                <input type="hidden" name="id_quem_cadastra_medic" value="<?= session()->get('id') ?>">
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <button type="submit" class="cls_new_medical btn btn-primary" id="btn_id_new_medical">
                <i class="fas fa-save"></i> Salvar
            </button>
        </div>
    </form>
</div>