<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- general form elements -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Funções</h3>
            </div>
            <!-- /.card-header -->
            <form id="for_add_funco_cargo">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="fun_numero">Nº</label>
                        <input type="number" class="form-control form-control-border border-width-2" name="fun_numero" id="fun_numero" placeholder="Digite aqui...">
                        <span id="fun_numero_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="fun_funcao">Cadastrar função </label>
                        <input type="text" class="form-control form-control-border" name="fun_funcao" id="fun_funcao" placeholder="Digite aqui...">
                        <span id="fun_funcao_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="fun_descricao">Descrição da função</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="fun_descricao" id="fun_descricao" placeholder="Digite aqui...">
                        <span id="fun_descricao_error" class="text-danger"></span>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="cls_func_add btn btn-primary" id="id_func_add">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message"></span>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">Funções cadastradas</h3>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table" id="lista_funcoes" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 10px">Data</th>
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