<div class="row">
    <!-- left column -->
    <div class="col-md-4">

        <!-- form -->
        <div class="card card-indo">
            <div class="card-header">
                <h3 class="card-title">Frentes de trabalho</h3>
            </div>
            <!-- /.card-header -->
            <form action="/frentes_trabalho/adiciona-frentes-trabalho" method="POST" id="form_add_novas_frentes">
                <?= csrf_field() ?>
                <div class="card-body">

                    <div class="form-group">
                        <label for="name_frentes_trabalho">Nome </label>
                        <input type="text" class="form-control form-control-border" name="name_frentes_trabalho" id="name_frentes_trabalho" placeholder="Digite aqui...">
                        <span id="name_frentes_trabalho_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="descricao_frentes_trabalho">Descrição</label>
                        <input type="text" class="form-control form-control-border border-width-2" name="descricao_frentes_trabalho" id="descricao_frentes_trabalho" placeholder="Digite aqui...">
                        <span id="descricao_frentes_trabalho_error" class="text-danger"></span>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="cls_add_frentes_trab btn btn-info" id="id_add_frentes_trab">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <div class="col-12">
                <span id="message_frente_trab"></span>
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card fim form -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">Frentes Cadastradas</h3>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table" id="lista_todas_as_frentes" style="width: 100%;">
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