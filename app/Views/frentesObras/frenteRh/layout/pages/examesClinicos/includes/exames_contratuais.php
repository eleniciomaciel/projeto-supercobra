<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-4">

                        <!-- //form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Exames contratuais</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/exames/cadastra_exames_contratual_ativo" method="POST" id="form_exame_contratual">
                            <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exc_name">Nome: </label>
                                        <input type="text" class="form-control" name="exc_name" id="exc_name" placeholder="Ex.: Periódico Semestral">
                                        <span id="exc_name_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <textarea class="form-control" rows="3" name="exc_descricao" id="exc_descricao" placeholder="Descrição digite aqui..."></textarea>
                                        <small>Descrição exame contartual de trabalho</small>
                                        <span id="exc_descricao_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="hidden_usuario_cad_exc" value="<?= session()->get('id') ?>">

                                <div class="card-footer">
                                    <button type="submit" class="cls_add_exam_contrato btn btn-primary" id="id_add_exam_contrato">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                            <br>
                            <div class="col-md-12">
                                <span id="message_emx_contartual"></span>
                            </div>
                        </div>
                        <!-- /.fim form -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exames em contrato ativos</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped" id="list_exames_contratuais_all" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                   
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.chart-responsive -->
                    </div>

                </div>
                <!-- /.row -->
            </div>
            <!-- ./card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>