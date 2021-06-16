<div class="modal fade" id="dadosMaoObraModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mão de obra cadastrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Mão de Obra</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="/mao_obra/altera_names-mao-obra" method="POST" id="form_alterar_mao_obra">
                        <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="nome_tmo">Nome </label>
                                <input type="text" class="form-control form-control-border" name="nome_tmo" id="nome_tmo" placeholder="Digite aqui...">
                                <span id="nome_tmo_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="description_tmo">Descrição</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="description_tmo" id="description_tmo" placeholder="Digite aqui...">
                                <span id="description_tmo_error" class="text-danger"></span>
                            </div>

                            <input type="hidden" name="hidden_id_up_mao_obra" id="hidden_id_up_mao_obra">

                            <div class="card-footer">
                                <button type="submit" class="cls_up_mao_obra btn btn-danger" id="id_up_mao_obra">
                                    <i class="fa fa-save"></i> Alterar
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_mao_up"></span>
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card fim form -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>