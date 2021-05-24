<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- general form elements -->
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Atividades</h3>
            </div>
            <!-- /.card-header -->
            <form action="/admin_rh/add_atividade" method="POST" id="form_adicioana_atividade">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="ativ_name">Nome da Atividade </label>
                        <input type="text" class="form-control form-control-border" name="ativ_name" id="ativ_name" placeholder="Digite aqui...">
                        <span id="ativ_name_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="ativ_descricao">Descrição da Atividade</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="ativ_descricao" id="ativ_descricao" placeholder="Digite aqui...">
                        <span id="ativ_descricao_error" class="text-danger"></span>
                        <span id="ativ_id_error" class="text-danger"></span>
                    </div>

                    <input type="hidden" name="id_cadastrador" value="<?= session()->get('id') ?>">

                    <div class="card-footer">
                        <button type="submit" class="cls_add_ativ btn btn-danger" id="id_add_ativ">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_add_atividade"></span>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-danger">

            <div class="card-header">
                <h3 class="card-title">Atividades cadastradas</h3>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table" id="lista_todas_atividades" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th style="width: 40px">Ação</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (right) -->
</div>