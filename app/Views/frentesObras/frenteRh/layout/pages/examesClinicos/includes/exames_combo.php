<div class="row">

    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-5">

                        <!-- //form -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Exames</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/exames/adiciona_combo" method="POST" id="form_add_combo_exames">
                                <?= csrf_field() ?>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="exc_name">Tipo: </label>
                                        <select class="custom-select rounded-0" name="exm_contrato" id="exm_contrato">

                                        </select>
                                        <span id="exm_contrato_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exc_name">Função:</label>
                                        <select name="todas_funcao_para_risco" id="todas_funcao_para_risco" class="custom-select">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php foreach ($carg as $select_func) : ?>
                                                <option value="<?= esc($select_func['id_cargo']) ?>"> <?= esc($select_func['cargo_numero']) ?> <==> <?= esc($select_func['cargo_nome']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span id="todas_funcao_para_risco_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="exc_name">Selecione uma função de risco: </label>
                                        <select class="custom-select rounded-0" name="select_carg_func_risco" id="select_carg_func_risco">

                                        </select>
                                        <span id="select_carg_func_risco_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="final_exam_name">Nome do exame: </label>
                                        <input type="text" class="form-control" name="final_exam_name" id="final_exam_name" placeholder="Ex.: Glicose">
                                        <span id="final_exam_name_error" class="text-danger"></span>
                                    </div>


                                    <label for="exam_mes_periodo">Fazer a cada mês(es): </label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="number" name="exames_mes_valor" min="1" max="12" class="form-control" placeholder="6 meses" aria-label="Amount (to the nearest dollar)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Mês</span>
                                        </div>
                                    </div>
                                    <span id="exames_mes_valor_error" class="text-danger"></span>



                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <textarea class="form-control" name="final_exame_desc" id="final_exame_desc" rows="3" placeholder="Descrição digite aqui..."></textarea>
                                        <span id="final_exame_desc_error" class="text-danger"></span>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="cls_up_exames_combo btn btn-danger" id="id_up_exames_combo">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                            <br>
                            <div class="col-12">
                                <span id="message_exames_combo"></span>
                            </div>
                        </div>
                        <!-- /.fim form -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-7">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Exames por função de atividades</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table table-responsive col-12">
                                <br>
                                    <table class="table table-striped" id="lista_exames_combo" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Função</th>
                                                <th>Risco</th>
                                                <th>Exame</th>
                                                <th>Carência</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

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