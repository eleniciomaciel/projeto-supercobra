<!-- Modal cdados da empresa -->
<div class="modal fade" id="empresaEyeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados da empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Empresa: <span id="ef_razao_social_x"></span>
                            </h4>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            Dados da empresa
                            <address>
                                CNPJ: <span id="cnpj"></span><br>
                                Classificação: <span id="classificacao_empresa"></span><br>
                                Insc.: Estadual: <span id="incricao_estadual"></span><br>
                                Insc.: Municipal: <span id="incricao_municial"></span>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6 invoice-col">
                            <address>
                                Cep: <span id="cep"></span><br>
                                UF: <span id="uf"></span><br>
                                Cidade: <span id="ef_cidade"></span><br>
                                Bairro: <span id="ef_bairro"></span><br>
                                Endereço: <span id="endereco"></span>
                            </address>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">

                        <p class="lead">Informações do(s) representantes(s):</p>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Telefone 1</th>
                                        <th>Telefone 2</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data_donos_empresa">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editarAlteracoesCrudModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Alterações</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-success">
                    <div class="card-header text-center">
                        <h3 class="card-title">Selecione o tipo de ação desejada</h3>
                    </div>
                    <div class="card-body">
                        <!-- Minimal style -->
                        <div class="row">

                            <div class="col-sm-12">
                                <!-- radio -->
                                <div class="form-group clearfix">

                                    <form id="form_button_radio">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" class="editEmployerOne" name="edit_dados" id="hidden_id_alteraEmpresa">
                                            <label for="hidden_id_alteraEmpresa">
                                                Editar Empresa
                                            </label>
                                        </div>

                                        <div class="icheck-primary d-inline">
                                            <input type="radio" class="editMultipleOneRepresentanteOne" name="edit_dados" id="hidden_id_altera_representante">
                                            <label for="hidden_id_altera_representante">
                                                Editar representante(s)
                                            </label>
                                        </div>
                                    </form>


                                </div>
                            </div>
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


<!-- Modal altera dados da empresa-->
<div class="modal fade" id="dadosEMpresaEditOptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados da empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?= form_open('Transporte/FornecedorNovoController/alteraCadastroDaEmpresaRadioButton', array('id' => 'form_update_new_empresa_100')) ?>
                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="new_responsavel">Razão Social/Nome</label>
                            <input type="text" class="form-control" name="new_responsavel" id="new_responsavel" placeholder="Ex.: Consócios Carros">
                            <span class="text-danger error-text new_responsavel_error"></span>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="new_ef_cnae">CNAE:</label>
                            <input type="text" class="form-control" name="new_ef_cnae" id="new_ef_cnae" placeholder="Ex.: 12..33">
                            <span class="text-danger error-text new_ef_cnae_error"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="new_ef_classificacao_empresa">Classificação Empresarial</label>
                            <select class="form-control" name="new_ef_classificacao_empresa" id="new_ef_classificacao_empresa">
                                <option selected="" disabled="">Selecione aqui...</option>
                                <option value="Empresa de Pequeno Porte (EPP)">Empresa de Pequeno Porte (EPP)</option>
                                <option value="Empresário Individual">Empresário Individual</option>
                                <option value="EIRELI">EIRELI</option>
                                <option value="Microempresa (ME)">Microempresa (ME)</option>
                                <option value="Microempreendedor individual – MEI">Microempreendedor individual – MEI</option>
                                <option value="Sociedade Limitada">Sociedade Limitada</option>
                            </select>
                            <span class="text-danger error-text new_ef_classificacao_empresa_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="new_ef_cnpj">CNPJ:</label>
                            <input type="text" class="form-control" name="new_ef_cnpj" id="new_ef_cnpj" placeholder="00.000.000/0001-00" autocomplete="off">
                            <span class="text-danger error-text new_ef_cnpj_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="new_ef_incricao_estadual">Inscrição Estadual</label>
                            <input type="text" class="form-control" name="new_ef_incricao_estadual" id="new_ef_incricao_estadual" placeholder="Ex.: 1234567890">
                            <span class="text-danger error-text new_ef_incricao_estadual_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="new_ef_incricao_municial">Inscrição Municipal</label>
                            <input type="text" class="form-control" name="new_ef_incricao_municial" id="new_ef_incricao_municial" placeholder="Ex.: 1234567890">
                            <span class="text-danger error-text new_ef_incricao_municial_error"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="new_ef_cep">CEP:</label>
                            <input type="text" class="form-control" name="new_ef_cep" id="new_ef_cep" placeholder="00.000-000" autocomplete="off">
                            <span class="text-danger error-text new_ef_cep_error"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="new_ef_uf">UF:</label>
                            <input type="text" class="form-control" name="new_ef_uf" id="new_ef_uf" placeholder="Ex.: MG" readonly="">
                            <span class="text-danger error-text new_ef_uf_error"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="new_ef_cidade">Cidade:</label>
                            <input type="text" class="form-control" name="new_ef_cidade" id="new_ef_cidade" readonly="" placeholder="Ex.: Ana Silva">
                            <span class="text-danger error-text new_ef_cidade_error"></span>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="new_ef_bairro">Bairro:</label>
                            <input type="text" class="form-control" name="new_ef_bairro" id="new_ef_bairro" placeholder="Ex.: Centro">
                            <span class="text-danger error-text new_ef_bairro_error"></span>
                        </div>

                        <div class="form-group col-md-7">
                            <label for="new_ef_endereco">Endereço:</label>
                            <input type="text" class="form-control" name="new_ef_endereco" id="new_ef_endereco" placeholder="Ex.: Rua Ana Maria">
                            <span class="text-danger error-text new_ef_endereco_error"></span>
                        </div>

                        <div class="form-group col-12">
                            <label for="new_ef_description">Observação:</label>
                            <textarea class="form-control" name="new_ef_description" id="new_ef_description" placeholder="Digite aqui..." rows="3"></textarea>
                            <span class="text-danger error-text new_ef_description_error"></span>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="hidden_id_empresa_onde" id="hidden_id_empresa_onde">

                <div class="card-footer">
                    <button type="submit" class="cls_new_empresa_100 btn btn-danger" id="btn_new_empresa_100">
                        <i class="fas fa-save"></i> Alterar
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

<!-- ==================================  Modal ====================================== -->
<div class="modal fade" id="selecionaDadosRepresentanteSelect" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Editar Representante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Empresa: <span id="minha_empresa"></span>
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Escolher representante</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <select class="custom-select form-control-border border-width-2" name="selectDinamycRepresents" id="selectDinamycRepresents">
                                            <option>Selecione aqui...</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>


                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Dados do representante</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">


                                        <?=form_open('Transporte/FornecedorNovoController/cadastraAlteraDDRepresentante', array('id'=>'form_new_represets_altera1001'))?>
                                            <div class="form-row">

                                                <div class="form-group col-md-12">
                                                    <label for="new_resp">Nome:</label>
                                                    <input type="text" class="form-control" name="new_resp" id="new_resp" placeholder="Ex.: Ana Silva" value="">
                                                    <span class="text-danger error-text new_resp_error"></span>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="new_resp_email">Email:</label>
                                                    <input type="email" class="form-control" name="new_resp_email" id="new_resp_email" placeholder="Ex.: ana@email.com" value="">
                                                    <span class="text-danger error-text new_resp_email_error"></span>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="new_resp_cpf">CPF:</label>
                                                    <input type="text" class="form-control" name="new_resp_cpf" id="new_resp_cpf" value="" placeholder="000.000.000-00" autocomplete="off">
                                                    <span class="text-danger error-text new_resp_cpf_error"></span>
                                                </div>


                                                <div class="form-group col-md-6">
                                                    <label for="new_resp_telefone1">Telefone:</label>
                                                    <input type="tel" class="form-control" name="new_resp_telefone1" id="new_resp_telefone1" placeholder="Ex.: (00) 3632-9877" value="">
                                                    <span class="text-danger error-text new_resp_telefone1_error"></span>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="new_resp_relefone2">Telefone 2:</label>
                                                    <input type="tel" class="form-control" name="new_resp_relefone2" id="new_resp_relefone2" placeholder="Ex.: (00) 3632-9877" value="">
                                                    <span class="text-danger error-text new_resp_relefone2_error"></span>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="new_resp_descricao">Observações:</label>
                                                    <textarea class="form-control" name="new_resp_descricao" id="new_resp_descricao" rows="3" placeholder="Digite aqui..."></textarea>
                                                    <span class="text-danger error-text new_resp_descricao_error"></span>
                                                </div>

                                            </div>
                                            <!-- /.card-body -->
                                            <input type="hidden" name="new_up_resp_id_represents" id="new_up_resp_id_represents">

                                            <div class="card-footer">
                                                <button type="submit" class="cls_new_represents_100 btn btn-danger" id="btn_new_represets_1001">
                                                    <i class="fas fa-save"></i> Alterar
                                                </button>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
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