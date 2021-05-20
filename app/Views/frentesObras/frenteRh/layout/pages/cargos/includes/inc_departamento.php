<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- general form elements -->
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Departamentos</h3>
            </div>
            <!-- /.card-header -->
            <form action="/admin_rh/cadastra_departamentos" method="post" id="formAddNovosDepartamentos">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="dep_new_nome_departamento">Nome do departamento </label>
                        <input type="text" class="form-control form-control-border" name="dep_new_nome_departamento" id="dep_new_nome_departamento" placeholder="Digite aqui...">
                        <span id="dep_new_nome_departamento_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="dep_new_descricao_departamento">Descrição</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="dep_new_descricao_departamento" id="dep_new_descricao_departamento" placeholder="Digite aqui...">
                        <span id="dep_new_descricao_departamento_error" class="text-danger"></span>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="cls_dep_add btn btn-warning" id="id_dep_add">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_dep"></span>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-warning">

            <div class="card-header">
                <h3 class="card-title">Departamentos Cadastradas</h3>
            </div>
            <div class="card-body">

                <div class="table table-responsive">
                    <table class="table" id="lista_todos_departamentos" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Departamento</th>
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