<div class="row">

    <div class="col-md-12">

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Configuração de exames</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="card-refresh" data-source="widgets.html" data-source-selector="#card-refresh-content" data-load-on-init="false">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form action="/exames/adiciona-exames-cargos" method="POST" id="form_exames_cargos_2">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-3">
                        <label for="">Funcao:</label>
                            <select name="select_cargos_p_aso" id="select_cargos_p_aso" class="custom-select" required>
                                <option selected disabled>Selecione aqui...</option>
                                <?php foreach ($carg as $select_func) : ?>
                                    <option value="<?= esc($select_func['id_cargo']) ?>"> <?= esc($select_func['cargo_numero']) ?> <==> <?= esc($select_func['cargo_nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span id="select_cargos_p_aso_error" class="text-danger"></span>
                        </div>
                        <div class="col-md-9">
                        <label for="">Cargo</label>
                            <select name="select_funcao_cargo_all" id="select_funcao_cargo_all" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                            </select>
                            <span id="select_cselect_funcao_cargo_all_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Riscos</label>
                            <ol>
                                <span id="show_data"></span>
                            </ol>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Exames do Cargo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Exames</th>
                                        <th>Tpos</th>
                                        <th>1º P/D</th>
                                        <th>2º P/D</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control" name="new_exames_select" id="new_exames_select">
                                                    <option selected disabled>Selecione aqui</option>
                                                </select>
                                                <span id="new_exames_select_error" class="text-danger"></span>
                                            </div>
                                        </td>
                                        <td>

                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="admissional" id="admissional" value="1">
                                                <label for="admissional" class="custom-control-label">A</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="demissional" id="demissional" value="1">
                                                <label for="demissional" class="custom-control-label">D</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="periodico" id="periodico" value="1">
                                                <label for="periodico" class="custom-control-label">P</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="mudanca_funcao" id="mudanca_funcao" value="1">
                                                <label for="mudanca_funcao" class="custom-control-label">M</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="retorno_trabalho" id="retorno_trabalho" value="1">
                                                <label for="retorno_trabalho" class="custom-control-label">R</label>
                                            </div>
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="is" id="is" value="1">
                                                <label for="is" class="custom-control-label">I/S</label>
                                            </div>

                                        </td>

                                        <td>
                                            <input type="number" class="form-control" min="30" max="360" name="primeiro_periodico_demiccional" id="primeiro_periodico_demiccional">
                                            <span id="primeiro_periodico_demiccional_error" class="text-danger"></span>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" min="30" max="360" name="segundo_peridico_demissional" id="segundo_peridico_demissional">
                                            <span id="segundo_peridico_demissional_error" class="text-danger"></span>
                                        </td>
                                        <td>
                                            <button type="submit" class="cls_add_exam_riscos_two btn btn-danger btn-flat" id="id_add_exam_riscos_two"><i class="fa fa-plus"></i> Adicionar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </form>
                <br>
                <span id="message_emx_add_risco_two"></span>
                <br>
                <table class="table table-striped" id="mydata">
                    <thead>
                        <tr>
                            <th>Exames</th>
                            <th>Tpos</th>
                            <th>1º P/D</th>
                            <th>2º P/D</th>
                            <th>L</th>
                        </tr>
                    </thead>
                    <tbody id="show_data_exames_posr_funcao">

                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>



        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>