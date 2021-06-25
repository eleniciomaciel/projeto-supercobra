<div class="card">
    <div class="card-header">
        <h5 class="card-title">Atividades dos Canteiro</h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar Atividades</h3>
                    </div>
                    <form action="/atividades/atividades_frentes" method="POST" id="add_new_active_admin">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="">Nome da Atividade</label>
                                    <input type="text" class="form-control" name="ativi_nome" id="ativi_nome" placeholder="Ex.: Administração RJ">
                                    <span id="ativi_nome_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-12">
                                    <label for="ativ_descricao">Descrição</label>
                                    <textarea class="form-control" name="ativ_descricao" id="ativ_descricao" placeholder="Digite aqui..." rows="3"></textarea>
                                    <span id="ativ_descricao_error" class="text-danger"></span>
                                </div>

                                <div class="form-group col-12">
                                    <button type="submite" class="cls_atividade_adm btn btn-block btn-warning btn-flat" id="id_add_atividade_adm">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>



                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="col-12">
                        <span id="message_atividades"></span>
                    </div>

                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Atividades</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped" id="lista_atividades_frentes_f" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- ./card-body -->
</div>