<div class="row">
    <div class="col-md-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-4">

                        <!-- //form -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Riscos Ocupacionais</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/exames/adiciona_risco_em_grau" method="POST" id="form_add_risco_grau">
                            <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exc_name">Função: </label>
                                        <select class="custom-select rounded-0" name="risco_funcao" id="risco_funcao">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php if (!empty($funf) && is_array($funf)) : ?>

                                                <?php foreach ($funf as $select_func) : ?>
                                                    <option value="<?= esc($select_func['id']) ?>"> <?= esc($select_func['cf_nome_cargo_funcao']) ?></option>
                                                <?php endforeach; ?>

                                            <?php else : ?>
                                                <option>Não há cadastro</option>
                                            <?php endif ?>
                                        </select> <span id="risco_funcao_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="risco_nome">Tipo de risco: </label>
                                        <input type="text" class="form-control" name="risco_nome" id="risco_nome" placeholder="Ex.: Riscos Demartológico">
                                        <span id="risco_nome_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="risco_grau">Graus de riscos: </label>
                                        <select name="risco_grau" id="risco_grau[]" class="custom-select rounded-0 select2MultipleEx" data-placeholder="Selecione aqui...">
                                            <option selected disabled>Seelcione aqui...</option>
                                            <option value="Nenhum">Nenhum</option>
                                            <option value="Acidentais">Acidentais</option>
                                            <option value="Biológicos">Biológicos</option>
                                            <option value="Ergonômicos">Ergonômicos</option>
                                            <option value="Físicos">Físicos</option>
                                            <option value="Mecânicos">Mecânicos</option>
                                            <option value="Químicos">Químicos</option>
                                        </select>
                                        <span id="risco_grau_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Descrição:</label>
                                        <textarea name="risco_descricao" id="risco_descricao" class="form-control" rows="3" placeholder="Descrição digite aqui..."></textarea>
                                        <span id="risco_descricao_error" class="text-danger"></span>
                                        <small>Descrição exame de risco de trabalho</small>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="hidden_usuario_cad_exc_risc" value="<?= session()->get('id') ?>">
                                <div class="card-footer">
                                    <button type="submit" class="cls_add_exam_risco btn btn-info" id="id_add_exam_risco">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                            <br>
                            <div class="col-md-12">
                            <span id="message_emx_add_risco"></span>
                            </div>
                        </div>
                        <!-- /.fim form -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Riscos de Atividades Cadastrados</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped" id="lista_tipo_risco_trabalho" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Função</th>
                                            <th>Nome</th>
                                            <th>Grau</th>
                                            <th>Ação</th>
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