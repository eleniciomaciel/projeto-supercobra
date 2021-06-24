<!-- Button trigger modal -->

<div class="modal fade" id="modalComponheExamesEaso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Dados dos Exames</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="/riscosexames/alterar-exame-aso" method="POST" id="form_altera_dados_exame_riscos_aso">
        <?= csrf_field() ?>
          <div class="form-row">

            <div class="col-md-4 mb-3">
              <label for="">Cargo:</label>
              <select class="form-control" id="select_modal_cargoaso_cf" name="select_modal_cargoaso_cf">
              </select>
              <span id="select_modal_cargoaso_cf_error" class="text-danger"></span>
            </div>

            <div class="col-md-4 mb-3">
              <label for="">Função:</label>
              <select class="form-control" id="select_modal_cargoa_funcoes_so_cf" name="select_modal_cargoa_funcoes_so_cf">
              </select>
              <span id="select_modal_cargoa_funcoes_so_cf_error" class="text-danger"></span>
            </div>

            <div class="col-md-4 mb-3">
              <label for="">Exames:</label>
              <select class="form-control" id="select_modal_exames_cf" name="select_modal_exames_cf">
              </select>
              <span id="select_modal_exames_cf_error" class="text-danger"></span>
            </div>

          </div>

          <div class="form-row">

            <div class="col-md-6 mb-3">
              <label for="">1º P/D:</label>
              <input type="text" class="form-control" name="ef_dias_1" id="ef_dias_1" placeholder="Ex.: 40">
              <span id="ef_dias_1_error" class="text-danger"></span>
            </div>

            <div class="col-md-6 mb-3">
              <label for="">2º P/D:</label>
              <input type="text" class="form-control" name="ef_dias_2" id="ef_dias_2" placeholder="Ex.: 80">
              <span id="ef_dias_2_error" class="text-danger"></span>
            </div>

          </div>

          <div class="form-row">
            
            <div class="form-check">

             <label for="">Tipos:&nbsp;</label>
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked1" name="checked1" value="1">
                <label for="checked1">ADM.:</label>
              </div>

              &nbsp;
              &nbsp;

              
              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked2" name="checked2" value="1">
                <label for="checked2">DEM.:</label>
              </div>

              &nbsp;
              &nbsp;

              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked3" name="checked3" value="1">
                <label for="checked3">PER.:</label>
              </div>

             
              &nbsp;
              &nbsp;

              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked4" name="checked4" value="1">
                <label for="checked4">MUD.: FUNÇÃO</label>
              </div>

              
              &nbsp;
              &nbsp;

              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked5" name="checked5" value="1">
                <label for="checked5">RET.: TRABALHO</label>
              </div>

              
              &nbsp;
              &nbsp;

              <div class="icheck-primary d-inline ml-2">
                <input type="checkbox" id="checked6" name="checked6" value="1">
                <label for="checked6">I/S</label>
              </div>

            </div>

          </div>
          
        <input type="hidden" name="hidden_id_altera_exame_aso_up" id="hidden_id_altera_exame_aso_up">

          <button type="submit" class="cls_add_exam_riscos_two_up btn btn-danger" id="id_add_exam_riscos_two_up">
            <i class="fa fa-save"></i>&nbsp;Alterar
          </button>
        </form>
      <br>
      <span id="message_emx_add_risco_two_up"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>