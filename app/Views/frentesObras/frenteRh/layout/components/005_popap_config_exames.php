<!-- Button trigger modal -->
<div class="modal fade" id="modalExameContratual" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalExamesContratuais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dados cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Exames contratuais</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/exames/altera_exames_contratual_ativo" method="POST" id="form_exame_contratual_altera">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ect_nome">Nome: </label>
                                <input type="text" class="form-control" name="ect_nome" id="ect_nome" placeholder="Ex.: Periódico Semestral">
                                <span id="ect_nome_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea class="form-control" rows="3" name="ect_description" id="ect_description" placeholder="Descrição digite aqui..."></textarea>
                                <small>Descrição exame contartual de trabalho</small>
                                <span id="ect_description_error" class="text-danger"></span>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="hidden_id_contrat_exame" id="hidden_id_contrat_exame">

                        <div class="card-footer">
                            <button type="submit" class="cls_add_exam_contrato_up btn btn-primary" id="id_add_exam_contrato_up">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        </div>

                    </form>
                    <br>
                    <div class="col-md-12">
                        <span id="message_emx_contartual_up"></span>
                    </div>
                </div>
                <!-- /.fim form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>



<!-- MODAL EXAME RISCOS ------------------------------------------------------- -->

<div class="modal fade" id="modal_riscos_one" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="modalExamesContratuais" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Dados cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- //form -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Exames contratuais</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/exames/alterar_risco_em_grau" method="POST" id="form_update_risco_grau">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="fk_funcao_eor">Função: </label>
                                <select name="fk_funcao_eor" id="fk_funcao_eor" class="custom-select">
                                    <?php foreach ($funf as $select_func) : ?>
                                        <option value="<?= esc($select_func['id']) ?>"> <?= esc($select_func['cf_nome_cargo_funcao']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="fk_funcao_eor_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="eor_nome">Nome do risco: </label>
                                <input type="text" class="form-control" name="eor_nome" id="eor_nome" placeholder="Ex.: Periódico Semestral">
                                <span id="eor_nome_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="eor_grau_risco">Graus de riscos: </label>
                                <select name="eor_grau_risco" id="eor_grau_risco" class="custom-select rounded-0" data-placeholder="Selecione aqui...">
                                    <option selected disabled>Seelcione aqui...</option>
                                    <option value="Nenhum">Nenhum</option>
                                    <option value="Acidentais">Acidentais</option>
                                    <option value="Biológicos">Biológicos</option>
                                    <option value="Ergonômicos">Ergonômicos</option>
                                    <option value="Físicos">Físicos</option>
                                    <option value="Mecânicos">Mecânicos</option>
                                    <option value="Químicos">Químicos</option>
                                </select>
                                <span id="eor_grau_risco_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea name="eor_description_risco" id="eor_description_risco" class="form-control" rows="3" placeholder="Descrição digite aqui..."></textarea>
                                <span id="eor_description_risco_error" class="text-danger"></span>
                                <small>Descrição exame de risco de trabalho</small>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="hidden_id_risco_exame_up" id="hidden_id_risco_exame_up">
                        <div class="card-footer">
                            <button type="submit" class="cls_up_exam_risco btn btn-info" id="id_up_exam_risco">
                                <i class="fa fa-save"></i> Alterar
                            </button>
                        </div>
                    </form>
                    <br>
                    <div class="col-md-12">
                        <span id="message_emx_up_risco"></span>
                    </div>
                </div>
                <!-- /.fim form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalListaExamesOne" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Procedimentos e exames</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Exames contratuais</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/exames/altera_exames_combo" method="POST" id="form_update_combo_exames">
                        <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="exc_name">Tipo de contrato: </label>
                                <select class="custom-select rounded-0" name="exm_contrato_combo_up" id="exm_contrato_combo_up">

                                </select>
                                <span id="exm_contrato_combo_up_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="ex_fk_funcao">Função:</label>
                                <select name="ex_fk_funcao" id="ex_fk_funcao" class="custom-select">
                                    <option selected disabled>Selecione aqui...</option>
                                    <?php foreach ($funf as $select_func) : ?>
                                        <option value="<?= esc($select_func['id']) ?>"> <?= esc($select_func['cf_nome_cargo_funcao']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span id="ex_fk_funcao_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="exm_riscos_funcao_ajax">Selecione uma função de risco: </label>
                                <select class="custom-select rounded-0" name="exm_riscos_funcao_ajax" id="exm_riscos_funcao_ajax">

                                </select>
                                <span id="exm_riscos_funcao_ajax_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="ex_tipo_exame">Nome do exame: </label>
                                <input type="text" class="form-control" name="ex_tipo_exame" id="ex_tipo_exame" placeholder="Ex.: Glicose">
                                <span id="ex_tipo_exame_error" class="text-danger"></span>
                            </div>


                            <label for="exam_mes_periodo">Fazer a cada mês(es): </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="number" name="ex_validade_meses" id="ex_validade_meses" min="1" max="12" class="form-control" placeholder="6 meses" aria-label="Amount (to the nearest dollar)">
                                <div class="input-group-append">
                                    <span class="input-group-text">Mês</span>
                                </div>
                            </div>
                            <span id="ex_validade_meses_error" class="text-danger"></span>



                            <div class="form-group">
                                <label>Descrição:</label>
                                <textarea class="form-control" name="ex_description" id="ex_description" rows="3" placeholder="Descrição digite aqui..."></textarea>
                                <span id="ex_description_error" class="text-danger"></span>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <input type="hidden" name="hidden_id_exame_combo" id="hidden_id_exame_combo">

                        <div class="card-footer">
                            <button type="submit" class="cls_update_exames_combo btn btn-danger" id="id_update_exames_combo">
                                <i class="fa fa-save"></i> Alterar
                            </button>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_exames_update_combo"></span>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>