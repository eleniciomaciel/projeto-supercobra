<!-- Modal -->
<div class="modal fade" id="modalFuncao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Informações da função</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Dados da Função</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/admin_rh/altera_funcao" method="post" id="formAlteraFuncao">
                    <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="fun_funcao_up">Função</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="fun_funcao_up" id="fun_funcao_up">
                                <span id="fun_funcao_up_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="fun_descricao_up">Descrição da Função</label>
                                <textarea class="form-control form-control-border border-width-2" name="fun_descricao_up" id="fun_descricao_up" rows="3"></textarea>
                                <span id="fun_descricao_up_error" class="text-danger"></span>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="hidden_id" id="hidden_id">

                        <div class="card-footer">
                            <button type="submit" class="cls_func_add_up btn btn-success" id="id_func_add_up">
                                <i class="fa fa-sync-alt"></i> Alterar
                            </button>
                        </div>
                    </form>
                    <div class="col-12">
                        <span id="message_up"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>