<div class="row">
    <!-- left column -->
    <div class="col-md-6">

        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Cargos</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="form-group">
                    <label for="func_select">Selecione a função</label>
                    <select class="custom-select form-control-border border-width-2 select2FuncaoTodas" name="func_select" id="func_select">
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputBorder">Cadastrar cargos </label>
                    <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder="Digite aqui...">
                </div>

                <div class="form-group">
                    <label for="exampleInputBorderWidth2">Descrição do cargo</label>
                    <input type="text" class="form-control form-control-border border-width-2" id="exampleInputBorderWidth2" placeholder="Digite aqui...">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
        <!-- Form Element sizes -->
        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">Cargos cadastradas</h3>
            </div>
            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 10px">Data</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th style="width: 40px">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Update software</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-danger">55%</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Clean database</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar bg-warning" style="width: 70%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-warning">70%</span></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Cron job running</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-primary" style="width: 30%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-primary">30%</span></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Fix and squish bugs</td>
                            <td>
                                <div class="progress progress-xs progress-striped active">
                                    <div class="progress-bar bg-success" style="width: 90%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-success">90%</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (right) -->
</div>