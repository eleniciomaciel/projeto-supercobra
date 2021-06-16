<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- form -->
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Mão de Obra</h3>
            </div>
            <!-- /.card-header -->
            <form action="/mao_obra/adiciona-mao-obra" method="POST" id="form_add_mao_obra">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="name_mao_obra">Nome </label>
                        <input type="text" class="form-control form-control-border" name="name_mao_obra" id="name_mao_obra" placeholder="Digite aqui...">
                        <span id="name_mao_obra_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="descricao_mao_obra">Descrição</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="descricao_mao_obra" id="descricao_mao_obra" placeholder="Digite aqui...">
                        <span id="descricao_mao_obra_error" class="text-danger"></span>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="cls_add_mao_obra btn btn-primary" id="id_add_mao_obra">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_mao"></span>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card fim form -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-success">

            <div class="card-header">
                <h3 class="card-title">Mão de Obras Cadastradas</h3>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table" id="lista_todas_mao_obra" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
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