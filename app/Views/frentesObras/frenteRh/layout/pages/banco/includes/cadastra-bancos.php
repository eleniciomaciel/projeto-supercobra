<a class="btn btn-app bg-success" data-toggle="modal" data-target="#listaBancos">
    <i class="fas fa-university"></i> Cadastrar Banco
</a>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Dados bancário de: <?= esc($funcionario['f_nome']) ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="/banco/criar-conta_usuario_bancaria" method="POST" id="form_add_dados_banco_usuario">
        <?= csrf_field() ?>
        <div class="card-body">

            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="inputEmail4">Banco:</label>
                    <select name="select_banco_cad" id="select_banco_cad" class="form-control">

                    </select>
                    <span id="select_banco_cad_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="inputPassword4">Tipo de Conta</label>
                    <select name="ub_tipo_conta" id="ub_tipo_conta" class="form-control">
                        <option selected disabled>Selecione aqui...</option>
                        <option value="Conta-Corrente">Conta-Corrente</option>
                        <option value="Conta-Digital">Conta-Digital</option>
                        <option value="Conta-Poupança">Conta-Poupança</option>
                        <option value="Conta-Universitária">Conta-Universitária</option>
                        <option value="Conta-Salário">Conta-Salário</option>
                    </select>
                    <span id="us_tipo_conta_error" class="text-danger"></span>
                </div>

            </div>


            <div class="form-row">

                <div class="form-group col-md-4">
                    <label for="ub_agenco">Agência:</label>
                    <input type="number" class="form-control" name="ub_agenco" id="ub_agenco" placeholder="Ex.: 3306">
                    <span id="ub_agenco_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-2">
                    <label for="up_digito_agencia">Dígito da Agência:</label>
                    <input type="number" class="form-control" name="up_digito_agencia" id="up_digito_agencia" placeholder="Ex.: 1">
                    <span id="up_digito_agencia_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="ub_numero_conta">Nº da Conta:</label>
                    <input type="number" class="form-control" name="ub_numero_conta" id="ub_numero_conta" placeholder="Ex.: 102030">
                    <span id="ub_numero_conta_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-2">
                    <label for="bu_digito_conta">Dígito da Conta:</label>
                    <input type="number" class="form-control" name="bu_digito_conta" id="bu_digito_conta" placeholder="Ex.: 2">
                    <span id="bu_digito_conta_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="bu_status_conta">Status:</label>
                    <select name="bu_status_conta" id="bu_status_conta" class="form-control">
                        <option selected disabled>Selecione aqui...</option>
                        <option>Ativa</option>
                        <option>Inativa</option>
                    </select>
                    <span id="bu_status_conta_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="bu_tutular_conta">Titularidade:</label>
                    <select name="bu_tutular_conta" id="bu_tutular_conta" class="form-control">
                        <option selected disabled>Selecione aqui...</option>
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                    <span id="bu_tutular_conta_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="bu_data_vencimento_conta">Data de vencimento:</label>
                    <input type="date" class="form-control" name="bu_data_vencimento_conta" id="bu_data_vencimento_conta">
                    <span id="bu_data_vencimento_conta_error" class="text-danger"></span>
                </div>

                <div class="form-group col-md-12">
                    <label for="bu_observacao_conta">Observações da Conta:</label>
                    <textarea class="form-control" name="bu_observacao_conta" id="bu_observacao_conta" rows="3"></textarea>
                    <span id="bu_observacao_conta_error" class="text-danger"></span>
                    <span id="frente_id_error" class="text-danger"></span>
                </div>
            </div>

            <!-- /.card-body -->

            <input type="hidden" name="bu_usuario_conta" value="<?= esc($funcionario['f_id']) ?>">
            <input type="hidden" name="frente_id" value="<?= session()->get('log_frente') ?>">

            <div class="card-footer">
                <button type="submit" class="cls_up_banco_user btn btn-primary" id="id_up_banco_user">
                    <i class="fa fa-save"></i> Salvar
                </button>
            </div>
    </form>
    <br>
    <div class="col-12">
        <span id="message_user_conta_add"></span>
    </div>
</div>