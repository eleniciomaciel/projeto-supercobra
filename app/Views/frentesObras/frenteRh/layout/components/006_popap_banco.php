<!-- Modal -->
<div class="modal fade" id="listaBancos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Bancos Cadastrados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <button type="button" class="btn btn-primary" aria-pressed="false" data-toggle="modal" data-target="#cadastraBancos">
                    <i class="fa fa-plus"></i> Cadastrar
                </button>
                <br><br>

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Bancos Cadastrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table table-responsive">
                            <table class="table table-striped" id="lista_bacos_cadastrados" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Banco</th>
                                        <th>Número</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                   
                                </tbody>
                            </table>
                        </div>

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

<!-- Modal -->
<div class="modal fade" id="cadastraBancos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Bancos Cadastrados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="/banco/cadastro_banco" method="POST" id="form_add_banco">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="nome_banco">Nome do Bnanco</label>
                            <input type="text" class="form-control" name="nome_banco" id="nome_banco" placeholder="Ex.: Banco do Brasil">
                            <span id="nome_banco_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="numero_banco">Nº do Banco</label>
                            <input type="number" class="form-control" name="numero_banco" id="numero_banco" placeholder="Ex.: 001">
                            <span id="numero_banco_error" class="text-danger"></span>
                        </div>
                    </div>
                    <button type="submit" class="cls_add_banco btn btn-primary" id="id_add_banco">
                        <i class="fa fa-save"></i> Salvar
                    </button>
                </form>
                <br>
                <div class="col-12">
                    <span id="message_add_banco"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVerAlteraBanco" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Banco Cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <form action="/banco/altera_dados_banco" method="POST" id="form_altera_dados_banco">
                    <?= csrf_field() ?>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="b_nome">Nome do Bnanco</label>
                            <input type="text" class="form-control" name="b_nome" id="b_nome" placeholder="Ex.: Banco do Brasil">
                            <span id="b_nome_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="b_numero">Nº do Banco</label>
                            <input type="number" class="form-control" name="b_numero" id="b_numero" placeholder="Ex.: 001">
                            <span id="b_numero_error" class="text-danger"></span>
                        </div>
                    </div>
                    <input type="hidden" name="hidden_id_banco" id="hidden_id_banco">
                    <button type="submit" class="cls_up_banco btn btn-danger" id="id_up_banco">
                        <i class="fa fa-save"></i> Alterar
                    </button>
                </form>
                <br>
                <div class="col-12">
                    <span id="message_up_banco"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>