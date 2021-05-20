<!-- Modal -->
<div class="modal fade" id="modalVerDepartamento" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Dados do departamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Dados do departamento</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin_rh/altera_depatamento" method="POST" id="form_altera_departamento">
              <?= csrf_field() ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="dep_nme">Departamento</label>
                    <input type="text" class="form-control" name="dep_nme" id="dep_nme" placeholder="Enter email">
                    <span id="dep_nme_error" class="text-danger"></span>
                  </div>
                  <div class="form-group">
                    <label for="dp_descricao">Descrição</label>
                    <textarea class="form-control" name="dp_descricao" id="dp_descricao" rows="3"></textarea>
                    <span id="dp_descricao_error" class="text-danger"></span>
                  </div>
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="hidden_id_dep" id="hidden_id_dep">

                <div class="card-footer">
                  <button type="submit" class="cls_dep_up btn btn-warning" id="id_dep_up">Alterar</button>
                </div>
              </form>
              <br>
              <span id="message_dep_up"></span>
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