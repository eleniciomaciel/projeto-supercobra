<!-- Modal -->
<div class="modal fade" id="dadosMedicoOneModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Cadastro do médico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados do Médico(a)</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('Rh/Medicos/PcmsoController/alteraCadastraMedicoPcmso', array('id' => 'quickFormPcmso_form_altera', 'novalidate' => 'novalidate')) ?>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="medic_pcmso_nome">Nome do médico:</label>
                                <input type="text" class="form-control" name="medic_pcmso_nome" id="medic_pcmso_nome" placeholder="Ex.: Ana Silva">
                                <span class="text-danger error-text medic_pcmso_nome_error"></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="medic_pcmso_email">Email</label>
                                <input type="email" class="form-control" name="medic_pcmso_email" id="medic_pcmso_email" placeholder="Ex.: ana@email.com">
                                <span class="text-danger error-text medic_pcmso_email_error"></span>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="medic_pcmso_crm">CRM:</label>
                                <input type="text" class="form-control" name="medic_pcmso_crm" id="medic_pcmso_crm" placeholder="Ex.: 123456">
                                <span class="text-danger error-text medic_pcmso_crm_error"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="medic_pcmso_description">Observações</label>
                                <textarea class="form-control" name="medic_pcmso_description" id="medic_pcmso_description" rows="3"></textarea>
                                <span class="text-danger error-text medic_pcmso_description_error"></span>
                            </div>

                            <input type="hidden" name="hidden_id_medic" id="hidden_id_medic">
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="cls_new_medical_up btn btn-danger" id="btn_id_new_medical_up">
                            <i class="fas fa-save"></i> Alterar
                        </button>
                    </div>
                    </form>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="statusMedicoOneModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Status do Médico(a)</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-12">
                    <div class="alert alert-success" style="display:none;">
                        <strong>Sucesso!</strong> <span id="success_status"></span>
                    </div>
                </div>

                <?= form_open('Rh/Medicos/PcmsoController/alterastatusMedicoPcmso', array('id'=>'formAddStatusMedico', 'class' => 'form-inline')) ?>

                    <label class="sr-only" for="x_pcmso_nome">Nome</label>
                    <input type="text" class="form-control mb-2 mr-sm-2" id="x_pcmso_nome" disabled>

                    <label class="sr-only" for="inlineFormInputGroupUsername2">Username</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <select class="custom-select mr-sm-2" name="medic_pcmso_status" id="medic_pcmso_status">
                            <option value="Ativo">Ativo</option>
                            <option value="Suspenso">Inativo</option>
                        </select>
                    </div>
                    <input type="hidden" name="hidden_id_medic_state" id="hidden_id_medic_state">

                    <button type="submit" class="cls_new_medical_st_up btn btn-primary mb-2" id="btn_id_new_medical_st_up">
                        <i class="fas fa-save"></i>    Alterar
                    </button>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>