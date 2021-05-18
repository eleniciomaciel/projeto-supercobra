<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cargos</h3>
            </div>
            <!-- /.card-header -->
            <form action="/admin_rh/cadastra_cargos_e_funcoes" method="post" id="formAddCargoWithFunction">
            <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="func_select">Selecione a função</label>
                        <select class="custom-select form-control-border border-width-2 select2FuncaoTodas" name="func_select" id="func_select">
                        </select>
                        <span id="func_select_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="cargo_new_nome">Cadastrar cargos </label>
                        <input type="text" class="form-control form-control-border" name="cargo_new_nome" id="cargo_new_nome" placeholder="Digite aqui...">
                        <span id="cargo_new_nome_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="cargo_new_descricao">Descrição do cargo</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="cargo_new_descricao" id="cargo_new_descricao" placeholder="Digite aqui...">
                        <span id="cargo_new_descricao_error" class="text-danger"></span>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="cls_func_cargo_add btn btn-primary" id="id_func_cargo_add">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_cargo"></span>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Cargos cadastradas</h3>
            </div>
            <div class="card-body">

                <div class="table table-responsive">
                    <table class="table" id="lista_funcoes_e_cargos" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Função</th>
                                <th>Cargo</th>
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