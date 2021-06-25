<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <?php
    // Display Response
    if (session()->has('message_ok_veiculo_up')) {
    ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message_ok_veiculo_up') ?>
        </div>
    <?php
    }
    ?>

    <!-- corpo aplicação -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Veículos</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-veiculo">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-oficina">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-despesas">Despess/Manutenção</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-localizacao">Localização/Transferência</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Dados do Veículos
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <form action="<?= base_url('/Admin/VeiculosController/alterar/'.$veic_dados['vaic_id']) ?>" method="POST">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label for="vei_for_frente">Frente:</label>
                                            <select name="vei_for_frente" class="form-control <?= ($validation->hasError('vei_for_frente')) ? 'is-invalid' : ''; ?>">
                                                <option selected disabled>Selecione aqui...</option>
                                                <?php if (!empty($frente) && is_array($frente)) : ?>
                                                    <?php foreach ($frente as $news_item) : ?>
                                                        <option value="<?= esc($news_item['id_ft']) ?>" <?php  if($news_item['id_ft'] == $veic_dados['vaic_fk_frente']){echo 'selected';}?>><?= esc($news_item['nome_ft']) ?></option>
                                                    <?php endforeach; ?>

                                                <?php else : ?>
                                                    <option selected disabled>Não há frentes cadastradas</option>
                                                <?php endif ?>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('vei_for_frente')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('vei_for_frente'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="car_fornecedor">Fornecedor:</label>
                                            <select name="car_fornecedor" class="form-control <?= ($validation->hasError('car_fornecedor')) ? 'is-invalid' : ''; ?>">
                                                <option selected disabled>Selecione aqui...</option>
                                                <?php if (!empty($lista_veiculos) && is_array($lista_veiculos)) : ?>
                                                    <?php foreach ($lista_veiculos as $news_fornecedor) : ?>
                                                        <option value="<?= esc($news_fornecedor['for_id']) ?>" <?php  if($news_fornecedor['for_id'] == $veic_dados['vaic_fk_fornecedor']){echo 'selected';}?>><?= esc($news_fornecedor['for_nome_fantasia']) ?></option>
                                                    <?php endforeach; ?>

                                                <?php else : ?>
                                                    <option selected disabled>Não há fornecedor cadastrado.</option>
                                                <?php endif ?>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('car_fornecedor')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('car_fornecedor'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label for="car_nome">Nome do Carro:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_nome')) ? 'is-invalid' : ''; ?>" name="car_nome" placeholder="Ex.: " value="<?= $veic_dados['vaic_nome'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_nome')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_nome'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="car_marca">Marca do Carro:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_marca')) ? 'is-invalid' : ''; ?>" name="car_marca" placeholder="Ex.: " value="<?= $veic_dados['vaic_marca'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_marca')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_marca'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_modelo">Modelo do Carro:</label>
                                                <input type="text" class="form-control" <?= ($validation->hasError('car_modelo')) ? 'is-invalid' : ''; ?>" name="car_modelo" placeholder="Ex.: " value="<?= $veic_dados['vaic_modelo'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_modelo')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_modelo'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>


                                        <div class="form-row">

                                            <div class="form-group col-md-4">
                                                <label for="car_placa">Placa:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_placa')) ? 'is-invalid' : ''; ?>" name="car_placa" placeholder="Ex.: " value="<?= $veic_dados['vaic_placa'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_placa')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_placa'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="car_cor">Cor:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_cor')) ? 'is-invalid' : ''; ?>" name="car_cor" placeholder="Ex.: " value="<?= $veic_dados['vaic_cor'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_cor')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_cor'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="car_ano">Ano:</label>
                                                <input type="number" class="form-control <?= ($validation->hasError('car_ano')) ? 'is-invalid' : ''; ?>" name="car_ano" placeholder="Ex.: " value="<?= $veic_dados['vaic_ano'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_ano')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_ano'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_ano_compra">Ano de Compra:</label>
                                                <input type="number" class="form-control <?= ($validation->hasError('car_ano_compra')) ? 'is-invalid' : ''; ?>" name="car_ano_compra" placeholder="Ex.: " value="<?= $veic_dados['vaic_data_compra'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_ano_compra')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_ano_compra'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_valor_compra">Valor do Veículo:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_valor_compra')) ? 'is-invalid' : ''; ?>" name="car_valor_compra" placeholder="Ex.: " value="<?= $veic_dados['vaic_valor_veiculo'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_valor_compra')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_valor_compra'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="car_chassi">Chassi:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_chassi')) ? 'is-invalid' : ''; ?>" name="car_chassi" placeholder="Ex.: " value="<?= $veic_dados['vaic_chassi'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_chassi')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_chassi'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="car_tipo_combustivel">Tipo Combustível:</label>
                                                <select name="car_tipo_combustivel" class="form-control">
                                                    <option selected disabled>Selecione aqui...</option>
                                                    <option value="Gasolina" <?php  if('Gasolina' == $veic_dados['vaic_tipo_combustivel']){echo 'selected';}?>>Gasolina</option>
                                                    <option value="Diesel" <?php  if('Diesel' == $veic_dados['vaic_tipo_combustivel']){echo 'selected';}?>>Diesel</option>
                                                    <option value="Etanol" <?php  if('Etanol' == $veic_dados['vaic_tipo_combustivel']){echo 'selected';}?>>Etanol</option>
                                                    <option value="Flex" <?php  if('Flex' == $veic_dados['vaic_tipo_combustivel']){echo 'selected';}?>>Flex</option>
                                                </select>
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_tipo_combustivel')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_tipo_combustivel'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="car_observer">Observações:</label>
                                                <textarea class="form-control <?= ($validation->hasError('car_observer')) ? 'is-invalid' : ''; ?>" name="car_observer" rows="3"><?= $veic_dados['vaic_description'] ?></textarea>
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_observer')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_observer'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Salvar</button>
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
                                                <th>Carro</th>
                                                <th>Ano</th>
                                                <th>Modelo</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($lista_veiculos_cadastrados) && is_array($lista_veiculos_cadastrados)) : ?>

                                                <?php foreach ($lista_veiculos_cadastrados as $list_car) : ?>
                                                    <tr>
                                                        <td><?= esc($list_car['vaic_nome']) ?></td>
                                                        <td><?= esc($list_car['vaic_ano']) ?></td>
                                                        <td><?= esc($list_car['vaic_modelo']) ?></td>
                                                        <td>
                                                        <div class="btn-group dropleft">
                                                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Opções
                                                                </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="/veiculos/visualizar/<?= esc($list_car['vaic_id'], 'url') ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="/veiculos/deletar/<?= esc($list_car['vaic_id'], 'url') ?>"><i class="fa fa-trash"></i> Deletar</a>
                                                                    </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php else : ?>

                                                <tr>
                                                    <td colspan="4" class="text-center">Não há registro no momento</td>
                                                </tr>

                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.fim do corpo da aplicação -->

</div>
<?= $this->endSection() ?>
