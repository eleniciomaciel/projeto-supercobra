
<!-- Modal -->
<div class="modal fade" id="modal_dados_cc_rh" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Dados do Cento de custo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="/admin_rh/altera_novo_rh_cc" method="POST" id="form_altera_rh_new_cc">
                    <?= csrf_field() ?>
                    <div class="card-body">
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="new_numero_ccrh">Número CC</label>
                                <input type="text" class="form-control" name="new_numero_ccrh" id="new_numero_ccrh" placeholder="Ex.: 1234567">
                                <span id="new_numero_ccrh_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="dep_cc">Departamento CC</label>
                                <select class="form-control" name="new_departamento_ccrh" id="new_departamento_ccrh">
                                    <option selected disabled>Selecione aqui..</option>
                                    <?php if (!empty($departamentos) && is_array($departamentos)) : ?>
                                        <?php foreach ($departamentos as $news_dep) : ?>
                                            <option value="<?= esc($news_dep['id']) ?>"><?= esc($news_dep['dep_name']) ?></option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option selected disabled>Sem cadastros</option>
                                    <?php endif ?>
                                </select>
                                <span id="new_departamento_ccrh_error" class="text-danger"></span>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="new_descricao_ccrh">Descrição:</label>
                                <textarea class="form-control" name="new_descricao_ccrh" id="new_descricao_ccrh" rows="3" placeholder="Digite aqui..."></textarea>
                                <span id="new_descricao_ccrh_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-12"><span id="message_new_altera_rhcc"></span></div>
                        </div>
                        <input type="hidden" name="new_id_cc" id="new_id_cc">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="cls_new_uprh_cc btn btn-success" id="id_new_uprh_cc">
                            <i class="fa fa-save"></i> Alterar
                        </button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>