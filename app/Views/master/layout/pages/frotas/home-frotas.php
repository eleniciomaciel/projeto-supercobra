<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <?php
    // Display Response
    if (session()->has('message_ok_veiculo')) {
    ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message_ok_veiculo') ?>
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
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Cadastrar Veículos
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <form action="<?= base_url('/Admin/VeiculosController/index') ?>" method="POST">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label for="vei_for_frente">Frente:</label>
                                            <select name="vei_for_frente" class="form-control <?= ($validation->hasError('vei_for_frente')) ? 'is-invalid' : ''; ?>">
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
                                                        <option value="<?= esc($news_fornecedor['for_id']) ?>"><?= esc($news_fornecedor['for_nome_fantasia']) ?></option>
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
                                                <input type="text" class="form-control <?= ($validation->hasError('car_nome')) ? 'is-invalid' : ''; ?>" name="car_nome" placeholder="Ex.: " value="<?= old('car_nome') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_nome')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_nome'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="car_marca">Marca do Carro:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_marca')) ? 'is-invalid' : ''; ?>" name="car_marca" placeholder="Ex.: " value="<?= old('car_marca') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_marca')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_marca'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_modelo">Modelo do Carro:</label>
                                                <input type="text" class="form-control" <?= ($validation->hasError('car_modelo')) ? 'is-invalid' : ''; ?>" name="car_modelo" placeholder="Ex.: " value="<?= old('car_modelo') ?>">
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
                                                <input type="text" class="form-control <?= ($validation->hasError('car_placa')) ? 'is-invalid' : ''; ?>" name="car_placa" placeholder="Ex.: " value="<?= old('car_placa') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_placa')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_placa'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="car_cor">Cor:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_cor')) ? 'is-invalid' : ''; ?>" name="car_cor" placeholder="Ex.: " value="<?= old('car_cor') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_cor')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_cor'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="car_ano">Ano:</label>
                                                <input type="number" class="form-control <?= ($validation->hasError('car_ano')) ? 'is-invalid' : ''; ?>" name="car_ano" placeholder="Ex.: " value="<?= old('car_ano') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_ano')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_ano'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_ano_compra">Ano de Compra:</label>
                                                <input type="number" class="form-control <?= ($validation->hasError('car_ano_compra')) ? 'is-invalid' : ''; ?>" name="car_ano_compra" placeholder="Ex.: " value="<?= old('car_ano_compra') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_ano_compra')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_ano_compra'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="car_valor_compra">Valor do Veículo:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_valor_compra')) ? 'is-invalid' : ''; ?>" name="car_valor_compra" placeholder="Ex.: " value="<?= old('car_valor_compra') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_valor_compra')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_valor_compra'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="car_chassi">Chassi:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('car_chassi')) ? 'is-invalid' : ''; ?>" name="car_chassi" placeholder="Ex.: " value="<?= old('car_chassi') ?>">
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
                                                    <option value="Gasolina">Gasolina</option>
                                                    <option value="Diesel">Diesel</option>
                                                    <option value="Etanol">Etanol</option>
                                                    <option value="Flex">Flex</option>
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
                                                <textarea class="form-control <?= ($validation->hasError('car_observer')) ? 'is-invalid' : ''; ?>" name="car_observer" rows="3"><?= old('car_observer') ?></textarea>
                                                <!-- Error -->
                                                <?php if ($validation->getError('car_observer')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('car_observer'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
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
<?= $this->section('admin-js') ?>

<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#vei_for_endereco").val("");
            $("#vei_for_bairro").val("");
            $("#vei_for_cidade").val("");
            $("#vei_for_uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#vei_for_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#vei_for_endereco").val("...");
                    $("#vei_for_bairro").val("...");
                    $("#vei_for_cidade").val("...");
                    $("#vei_for_uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#vei_for_endereco").val(dados.logradouro);
                            $("#vei_for_bairro").val(dados.bairro);
                            $("#vei_for_cidade").val(dados.localidade);
                            $("#vei_for_uf").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

    });
</script>
<?= $this->endSection() ?>