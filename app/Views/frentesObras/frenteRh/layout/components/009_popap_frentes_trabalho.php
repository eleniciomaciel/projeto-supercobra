<div class="modal fade" id="dadosFrenteTrabalho" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Frente de trabalho cadastrado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!-- form -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Frente de Trabalho</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="/frentes_trabalho/altera_frente_frabalho" method="POST" id="form_alterar_fente_trabalho">
                        <?= csrf_field() ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="nome_ftbr">Nome </label>
                                <input type="text" class="form-control form-control-border" name="nome_ftbr" id="nome_ftbr" placeholder="Digite aqui...">
                                <span id="nome_ftbr_error" class="text-danger"></span>
                            </div>

                            <div class="form-group">
                                <label for="description_ftbr">Descrição</label>
                                <input type="text" class="form-control form-control-border border-width-2" name="description_ftbr" id="description_ftbr" placeholder="Digite aqui...">
                                <span id="description_ftbr_error" class="text-danger"></span>
                            </div>

                            <input type="hidden" name="hidden_id_up_frente_Trab" id="hidden_id_up_frente_Trab">

                            <div class="card-footer">
                                <button type="submit" class="cls_frent_trab_up btn btn-danger" id="id_frent_trab_up">
                                    <i class="fa fa-sync-alt"></i> Alterar
                                </button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_frente_trab_up"></span>
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