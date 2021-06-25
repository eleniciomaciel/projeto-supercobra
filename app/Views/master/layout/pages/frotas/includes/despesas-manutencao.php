<div class="row">
    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Cadastrar Despesas
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Tipo de Serviço</button>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <?php $validation = \Config\Services::validation(); ?>
                <form>
                    <div class="form-group">
                        <label for="inputAddress">Frentes:</label>
                        <select name="manut_frente" id="manut_frente" class="form-control <?= ($validation->hasError('manut_frente')) ? 'is-invalid' : ''; ?>">
                            <option selected disabled>Selecione aqui...</option>
                            <?php if (!empty($frente) && is_array($frente)) : ?>
                                <?php foreach ($frente as $news_item) : ?>
                                    <option value="<?= esc($news_item['id_ft']) ?>"><?= esc($news_item['nome_ft']) ?></option>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <option selected disabled>Não há frentes cadastradas</option>
                            <?php endif ?>
                        </select>
                        <!-- Error -->
                        <?php if ($validation->getError('manut_frente')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('manut_frente'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">

                            <label for="inputEmail4">Departamento:</label>
                            <select class="form-control" id="sel_depart_frente"></select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Veículo/Placa:</label>
                            <select class="form-control" id="sel_desp_veiculo_placa_select"></select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Cento de Custo:</label>
                            <select class="form-control" id="sel_desp_cc_carro_atividade_frente"></select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputAddress2">Oficina/Estabecimento:</label>
                        <select name="manut_frente" id="manut_frente" class="form-control <?= ($validation->hasError('manut_frente')) ? 'is-invalid' : ''; ?>">
                            <option selected disabled>Selecione aqui...</option>
                            <?php if (!empty($oficinas_list) && is_array($oficinas_list)) : ?>
                                <?php foreach ($oficinas_list as $news_item) : ?>
                                    <option value="<?= esc($news_item['ofic_id']) ?>"><?= esc($news_item['ofic_nome_fantasia']) ?></option>
                                <?php endforeach; ?>

                            <?php else : ?>
                                <option selected disabled>Não há frentes cadastradas</option>
                            <?php endif ?>
                        </select>
                        <!-- Error -->
                        <?php if ($validation->getError('manut_frente')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('manut_frente'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="inputZip">Número da Nota:</label>
                            <input type="text" class="form-control" id="inputZip">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputState">Tipo de Serviço:</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4">Valor:</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4">KM:</label>
                            <input type="tel" class="form-control" id="inputPassword4" placeholder="Password">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputState">Status do Serviço:</label>
                            <select id="inputState" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="exampleFormControlTextarea1">Observações:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->

    <div class="col-md-6">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bullhorn"></i>
                    Callouts
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Task</th>
                            <th>Progress</th>
                            <th style="width: 40px">Label</th>
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
    <!-- /.col -->
</div>