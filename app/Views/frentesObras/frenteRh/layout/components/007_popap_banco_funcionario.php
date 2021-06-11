<!-- Button trigger modal -->
<div class="modal fade" id="modalBancoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Banco cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados bancário de: <?= esc($funcionario['f_nome']) ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/banco/conta_usuario_bancaria_alterar" method="POST" id="form_altera_dados_banco_usuario">
                        <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">Banco:</label>
                                    <select name="fk_banco_bu" id="fk_banco_bu" class="form-control">

                                    </select>
                                    <span id="fk_banco_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="tipo_conta_bu">Tipo de Conta</label>
                                    <select name="tipo_conta_bu" id="tipo_conta_bu" class="form-control">
                                        <option selected disabled>Selecione aqui...</option>
                                        <option value="Conta-Corrente">Conta-Corrente</option>
                                        <option value="Conta-Digital">Conta-Digital</option>
                                        <option value="Conta-Poupança">Conta-Poupança</option>
                                        <option value="Conta-Universitária">Conta-Universitária</option>
                                        <option value="Conta-Salário">Conta-Salário</option>
                                    </select>
                                    <span id="tipo_conta_bu_error" class="text-danger"></span>
                                </div>

                            </div>


                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="agencia_bu">Agência:</label>
                                    <input type="number" class="form-control" name="agencia_bu" id="agencia_bu" placeholder="Ex.: 3306">
                                    <span id="agencia_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="digito_agencia_bu">Dígito da Agência:</label>
                                    <input type="number" class="form-control" name="digito_agencia_bu" id="digito_agencia_bu" placeholder="Ex.: 1">
                                    <span id="digito_agencia_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="numero_conta_bu">Nº da Conta:</label>
                                    <input type="number" class="form-control" name="numero_conta_bu" id="numero_conta_bu" placeholder="Ex.: 102030">
                                    <span id="numero_conta_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="digito_conta_bu">Dígito da Conta:</label>
                                    <input type="number" class="form-control" name="digito_conta_bu" id="digito_conta_bu" placeholder="Ex.: 2">
                                    <span id="digito_conta_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="status_conta_bu">Status:</label>
                                    <select name="status_conta_bu" id="status_conta_bu" class="form-control">
                                        <option selected disabled>Selecione aqui...</option>
                                        <option>Ativa</option>
                                        <option>Inativa</option>
                                    </select>
                                    <span id="status_conta_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="titular_status_bu">Titularidade:</label>
                                    <select name="titular_status_bu" id="titular_status_bu" class="form-control">
                                        <option selected disabled>Selecione aqui...</option>
                                        <option>Sim</option>
                                        <option>Não</option>
                                    </select>
                                    <span id="titular_status_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="data_vencimento_conta_bu">Data de vencimento:</label>
                                    <input type="date" class="form-control" name="data_vencimento_conta_bu" id="data_vencimento_conta_bu">
                                    <span id="data_vencimento_conta_bu_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="observacao_bu">Observações da Conta:</label>
                                    <textarea class="form-control" name="observacao_bu" id="observacao_bu" rows="3"></textarea>
                                    <span id="observacao_bu_error" class="text-danger"></span>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <input type="hidden" name="hidden_id_conta_user" id="hidden_id_conta_user">

                            <div class="card-footer">
                                <button type="submit" class="cls_up_banco_user_uper btn btn-danger" id="id_up_banco_user_uper">
                                    <i class="fa fa-save"></i> Alterar
                                </button>
                            </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_user_conta_up"></span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>