<div class="modal fade" id="modal_atividades_frentes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Atividades de trabalho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Alterar Atividades</h3>
                    </div>
                    <form action="/atividades/atividades_frentes_alterar" method="POST" id="update_new_active_admin">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <input type="text" class="form-control" name="atv_descricao" id="atv_descricao" placeholder="Ex.: Administração RJ">
                                    <span id="atv_descricao_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-12">
                                    <label for="titulo_description">Descrição</label>
                                    <textarea class="form-control" name="titulo_description" id="titulo_description" placeholder="Digite aqui..." rows="3"></textarea>
                                    <span id="titulo_description_error" class="text-danger"></span>
                                </div>

                                <input type="hidden" name="hidden_id_frente_active" id="hidden_id_frente_active">

                                <div class="form-group col-12">
                                    <button type="submite" class="cls_atividade_adm_up btn btn-block btn-danger btn-flat" id="id_add_atividade_adm_up">
                                        <i class="fa fa-save"></i> Alterar
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_atividades_up"></span>
                    </div>

                    <!-- /.card-body -->
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>