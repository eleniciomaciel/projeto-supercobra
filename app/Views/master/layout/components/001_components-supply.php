<div class="modal modal-right fade" id="obras_right_modal" tabindex="-1" role="dialog" aria-labelledby="right_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar obras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Dados da obra:</h3>
                    </div>
                    <!-- /.card-header -->
                    <span id="message"></span>
                    <!-- form start -->
                    <form method="POST" id="adiciona_obra">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="local_input">Local</label>
                                <input type="text" class="form-control" name="local_input" id="local_input" placeholder="Ex.: Corinto">
                                <span id="local_input_error" class="text-danger"></span>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Data de início:</label>
                                        <input type="date" class="form-control" name="data_inicio" id="data_inicio">
                                        <span id="data_inicio_error" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Data de Encerramento </label>
                                        <input type="date" class="form-control" name="data_encerra" id="data_encerra">
                                        <span id="data_encerra_error" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="cnpj_input">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj_input" id="cnpj_input" >
                                <span id="cnpj_input_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="cep_input">CEP</label>
                                <input type="text" class="form-control" name="cep_input" id="cep_input" placeholder="00.000-000">
                                <span id="cep_input_error" class="text-danger"></span>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <input type="text" class="form-control" name="input_state_uf" id="input_state_uf" placeholder="Ex.: MG ..." readonly>
                                        <span id="input_state_uf_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cidade </label>
                                        <input type="text" class="form-control" placeholder="Ex.: Corinto ..." name="input_cidade" id="input_cidade" readonly>
                                        <span id="input_cidade_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="int_bairro">Bairro:</label>
                                    <input type="text" class="form-control" name="int_bairro" id="int_bairro" placeholder="Ex.: Centro">
                                    <span id="int_bairro_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-sm-8">
                                    <label for="int_rua">Rua/Endereço:</label>
                                    <input type="text" class="form-control" name="int_rua" id="int_rua" placeholder="Ex.: Centro">
                                    <span id="int_rua_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="int_numero">Número:</label>
                                    <input type="number" class="form-control" name="int_numero" id="int_numero" placeholder="Ex.: Centro">
                                    <span id="int_numero_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="int_cliente">Cliente:</label>
                                    <select class="custom-select rounded-0" name="int_cliente" id="int_cliente"></select>
                                    <span id="int_cliente_error" class="text-danger"></span>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="obra_status">Status da obra</label>
                                        <select class="custom-select rounded-0" name="obra_status" id="obra_status">
                                            <option selected disabled>Selecione aqui...</option>
                                            <option value="ativo">Ativo</option>
                                            <option value="pendente">Pendente</option>
                                            <option value="concluido">Concluído</option>
                                        </select>
                                        <span id="obra_status_error" class="text-danger"></span>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea class="form-control" name="obs_obra" id="obs_obra" rows="3" placeholder="Enter ..."></textarea>
                                        <span id="obs_obra_error" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="submit_button_cls btn btn-primary" id="submit_button">
                                <i class="fa fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                    <br>
                    <span id="message"></span>
                </div>


            </div>
            <div class="modal-footer modal-footer-fixed">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-close"></i> Fechar
                </button>
            </div>
        </div>
    </div>
</div>