<!-- Modal -->
<div class="modal fade" id="listaCadastroBancoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bancos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-edit"></i>
                            Conta da Empresa: <span id="razao_empresa"></span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <h4>Gerenciar contas</h4>
                        <div class="row">
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" data-empresa="" onclick="lerBanco(this.data-empresa)" aria-controls="vert-tabs-home" aria-selected="true">Bancos da Empresa</a>
                                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Cadastrar Banco</a>
                                </div>
                            </div>
                            <div class="col-7 col-sm-9">
                                <div class="tab-content" id="vert-tabs-tabContent">
                                    <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">

                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Contas Cadastradas</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body p-0">
                                                <div class="table table-responsive">
                                                    <table class="table table-striped" id="postsBanco" style="width: 100%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Banco</th>
                                                                <th>Tipo de Conta</th>
                                                                <th>Agência</th>
                                                                <th>Conta</th>
                                                                <th style="width: 40px">Ações</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table_data">

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">

                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Dados da Conta</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <!-- form start -->
                                            <?= form_open('Transporte/FornecedorNovoController/adicionaContaBanco', array('id' => 'form_add_cb')) ?>
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <label for="banco">Banco:</label>
                                                    <input type="text" class="form-control" name="banco" id="banco" placeholder="Ex.: Banco do Brasil" value="">
                                                    <span class="text-danger error-text banco_error"></span>
                                                    <!-- Error -->
                                                </div>

                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <label for="validationDefault01">Tipo de Conta</label>
                                                        <select name="tipo_de_conta" class="form-control">
                                                            <option selected="" disabled="">Selecione aqui...</option>
                                                            <option value="Conta-Corrente">Conta-Corrente</option>
                                                            <option value="Conta-Digital">Conta-Digital</option>
                                                            <option value="Conta-Poupança">Conta-Poupança</option>
                                                            <option value="Conta-Universitária">Conta-Universitária</option>
                                                            <option value="Conta-Salário">Conta-Salário</option>
                                                        </select>
                                                        <span class="text-danger error-text tipo_de_conta_error"></span>
                                                        <!-- Error -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="agencia">Agência</label>
                                                        <input type="number" class="form-control" name="agencia" placeholder="Ex.: 1234">
                                                        <span class="text-danger error-text agencia_error"></span>
                                                        <!-- Error -->
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="numero_conta">Nº de Conta</label>
                                                        <input type="number" class="form-control" name="numero_conta" placeholder="1Ex.: 234567">
                                                        <span class="text-danger error-text numero_conta_error"></span>
                                                        <!-- Error -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="digito_conta">Dígito da Conta</label>
                                                        <input type="text" class="form-control" name="digito_conta" placeholder="Ex.: 12">
                                                        <span class="text-danger error-text digito_conta_error"></span>
                                                        <!-- Error -->
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label for="observacao_conta">Observações da conta:</label>
                                                        <textarea class="form-control" name="observacao_conta" id="observacao_conta" placeholder="Digite aqui..." rows="3"></textarea>
                                                        <span class="text-danger error-text observacao_conta_error"></span>
                                                        <!-- Error -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                            <input type="hidden" name="hidden_id_empresaConta" id="hidden_id_empresaConta">

                                            <div class="card-footer">
                                                <div class="id_btn_fornecedor"></div>
                                                <button type="submit" class="cls_add_conta_empresa btn btn-primary" id="btn_add_conta_empresa">
                                                    <i class="fas fa-save"></i> Salvar
                                                </button>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal visualiza e altera dados do banco-->
<div class="modal fade" id="bancoVerAlterarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Visualiza/Altera dados do banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Dados da Conta</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('Transporte/FornecedorNovoController/atualizaContaBanco', array('id' => 'form_update_cb')) ?>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="banco">Banco:</label>
                            <input type="text" class="form-control" name="cbf_banco" id="cbf_banco" placeholder="Ex.: Banco do Brasil" value="">
                            <span class="text-danger error-text cbf_banco_error"></span>
                            <!-- Error -->
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="validationDefault01">Tipo de Conta</label>
                                <select name="cbf_tipo_conta" id="cbf_tipo_conta" class="form-control">
                                    <option selected="" disabled="">Selecione aqui...</option>
                                    <option value="Conta-Corrente">Conta-Corrente</option>
                                    <option value="Conta-Digital">Conta-Digital</option>
                                    <option value="Conta-Poupança">Conta-Poupança</option>
                                    <option value="Conta-Universitária">Conta-Universitária</option>
                                    <option value="Conta-Salário">Conta-Salário</option>
                                </select>
                                <span class="text-danger error-text cbf_tipo_conta_error"></span>
                                <!-- Error -->
                            </div>
                            <div class="col-md-6">
                                <label for="cbf_agencia">Agência</label>
                                <input type="number" class="form-control" name="cbf_agencia" id="cbf_agencia" placeholder="Ex.: 1234">
                                <span class="text-danger error-text cbf_agencia_error"></span>
                                <!-- Error -->
                            </div>

                            <div class="col-md-6">
                                <label for="cbf_numero_conta">Nº de Conta</label>
                                <input type="number" class="form-control" name="cbf_numero_conta" id="cbf_numero_conta" placeholder="1Ex.: 234567">
                                <span class="text-danger error-text cbf_numero_conta_error"></span>
                                <!-- Error -->
                            </div>
                            <div class="col-md-6">
                                <label for="cbf_digito_conta">Dígito da Conta</label>
                                <input type="text" class="form-control" name="cbf_digito_conta" id="cbf_digito_conta" placeholder="Ex.: 12">
                                <span class="text-danger error-text cbf_digito_conta_error"></span>
                                <!-- Error -->
                            </div>

                            <div class="col-md-12">
                                <label for="cbf_Observacoes_conta">Observações da conta:</label>
                                <textarea class="form-control" name="cbf_Observacoes_conta" id="cbf_Observacoes_conta" placeholder="Digite aqui..." rows="3"></textarea>
                                <span class="text-danger error-text cbf_Observacoes_conta_error"></span>
                                <!-- Error -->
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="hidden_id_banco_alterar" id="hidden_id_banco_alterar">

                    <div class="card-footer">
                        <div class="id_btn_fornecedor"></div>
                        <button type="submit" class="cls_add_conta_empresa_up btn btn-danger" id="btn_add_conta_empresa_up">
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