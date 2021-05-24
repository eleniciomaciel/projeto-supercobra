<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="atividadesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Atividade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados da atividade</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/admin_rh/altera_atividade" method="POST" id="form_altera_atividade">
                    <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="titulo_nome">Nome da Atividade:</label>
                                <input type="text" class="form-control" name="titulo_nome" id="titulo_nome" required>
                                <span id="titulo_nome_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Descrição da Atividade:</label>
                                <input type="text" class="form-control" name="titulo_description" id="titulo_description" required>
                                <span id="titulo_description_error" class="text-danger"></span>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="hidden_id_atividade" id="hidden_id_atividade">

                        <div class="card-footer">
                            <button type="submit" class="cls_up_ativ btn btn-danger" id="id_up_ativ">
                            <i class="fas fa-sync-alt"></i> Alterar
                            </button>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                    <span id="message_up_atividade"></span>
                    </div>
                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>