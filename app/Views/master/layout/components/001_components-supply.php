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
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="local_input">Local</label>
                                <input type="text" class="form-control" id="local_input" placeholder="Ex.: Corinto">
                            </div>
                            <div class="form-group">
                                <label for="cep_input">CEP</label>
                                <input type="text" class="form-control" name="cep_input" id="cep_input" placeholder="Ex.: 000.000.000-00">
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <input type="text" class="form-control" name="input_state_uf" id="input_state_uf" placeholder="Ex.: MG ...">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cidade </label>
                                        <input type="text" class="form-control" placeholder="Ex.: Corinto ..." disabled="">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleSelectRounded0">Status da obra</label>
                                        <select class="custom-select rounded-0" id="exampleSelectRounded0">
                                            <option selected disabled>Selecione aqui...</option>
                                            <option value="ativo">Ativo</option>
                                            <option value="pendente">Pendente</option>
                                            <option value="concluido">Concluído</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
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