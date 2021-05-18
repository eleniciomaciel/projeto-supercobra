<div class="modal fade" id="modalCargoComFuncao" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Cargo/Função</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cargos</h3>
            </div>
            <!-- /.card-header -->
            <form action="/admin_rh/altera_cargo_funcao" method="post" id="formAlteraCargo">
            <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="func_select">Selecione a função</label>
                        <select class="custom-select form-control-border border-width-2" name="cargos_select" id="cargos_select"></select>
                        <span id="cargos_select_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="cargo_new_nome">Cadastrar cargos </label>
                        <input type="text" class="form-control form-control-border" name="fc_cargo_up" id="fc_cargo_up" placeholder="Digite aqui...">
                        <span id="fc_cargo_up_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="cargo_new_descricao">Descrição do cargo</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="fc_descricao_up" id="fc_descricao_up" placeholder="Digite aqui...">
                        <span id="fc_descricao_up_error" class="text-danger"></span>
                    </div>

                    <input type="hidden" name="hidden_id_cargo" id="hidden_id_cargo">

                    <div class="card-footer">
                        <button type="submit" class="cls_up_cargo_func btn btn-primary" id="id_up_cargo_func">
                            <i class="fa fa-save"></i> Alterar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_cargo_up"></span>
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