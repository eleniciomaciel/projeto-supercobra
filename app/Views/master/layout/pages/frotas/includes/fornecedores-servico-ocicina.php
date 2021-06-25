<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <?php
    // Display Response
    if (session()->has('message_ok_oficina_up')) {
    ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message_ok_oficina_up') ?>
        </div>
    <?php
    }
    ?>
    <!-- corpo aplicação -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Oficina</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link" href="/frota/controle">Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-veiculo">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link active" href="#tab_2" data-toggle="tab">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-despesas">Despess/Manutenção</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-localizacao">Localização/Transferência</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Dados da Oficina
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <form action="<?= base_url('/Admin/OficinaController/alterar/'.$get_one_oficina['ofic_id']) ?>" method="POST">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label for="ofic_frente">Frente:</label>
                                            <select name="ofic_frente" class="form-control <?= ($validation->hasError('ofic_frente')) ? 'is-invalid' : ''; ?>">
                                                <option selected disabled>Selecione aqui...</option>
                                                <?php if (!empty($frente) && is_array($frente)) : ?>
                                                    <?php foreach ($frente as $news_item) : ?>
                                                        <option value="<?= esc($news_item['id_ft']) ?>" <?php if( $news_item['id_ft']== $get_one_oficina['ofic_fk_frente']){echo 'selected';}?> ><?= esc($news_item['nome_ft']) ?></option>
                                                    <?php endforeach; ?>

                                                <?php else : ?>
                                                    <option selected disabled>Não há frentes cadastradas</option>
                                                <?php endif ?>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('ofic_frente')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('ofic_frente'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="ofic_fornecedor">Fornecedor:</label>
                                            <select name="ofic_fornecedor" class="form-control <?= ($validation->hasError('ofic_fornecedor')) ? 'is-invalid' : ''; ?>">
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
                                            <?php if ($validation->getError('ofic_fornecedor')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('ofic_fornecedor'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="ofic_name">Nome Fantasia:</label>
                                            <input type="text" class="form-control <?= ($validation->hasError('ofic_name')) ? 'is-invalid' : ''; ?>" name="ofic_name" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_nome_fantasia'] ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('ofic_name')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('ofic_name'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label for="ofic_responsavel">Responsável:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_responsavel')) ? 'is-invalid' : ''; ?>" name="ofic_responsavel" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_responsavel'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_responsavel')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_responsavel'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="ofic_mail">Email:</label>
                                                <input type="email" class="form-control <?= ($validation->hasError('ofic_mail')) ? 'is-invalid' : ''; ?>" name="ofic_mail" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_email'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_mail')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_mail'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="ofic_telefone">Telefone:</label>
                                                <input type="tel" class="form-control <?= ($validation->hasError('ofic_telefone')) ? 'is-invalid' : ''; ?>" name="ofic_telefone" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_telefone'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_telefone')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_telefone'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="ofic_cnpj">CNPJ:</label>
                                            <input type="text" class="form-control <?= ($validation->hasError('ofic_cnpj')) ? 'is-invalid' : ''; ?>" name="ofic_cnpj" id="ofic_cnpj" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_cnpj'] ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('ofic_cnpj')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('ofic_cnpj'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-4">
                                                <label for="ofic_cep">CEP:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_cep')) ? 'is-invalid' : ''; ?>" name="ofic_cep" id="ofic_cep" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_cep'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_cep')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_cep'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-2">
                                                <label for="ofic_uf">UF:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_uf')) ? 'is-invalid' : ''; ?>" name="ofic_uf" id="ofic_uf" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_uf'] ?>" readonly>
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_uf')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_uf'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="ofic_cidade">Cidade</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_cidade')) ? 'is-invalid' : ''; ?>" name="ofic_cidade" id="ofic_cidade" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_cidade'] ?>" readonly>
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_cidade')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_cidade'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="ofic_bairro">Bairro:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_bairro')) ? 'is-invalid' : ''; ?>" name="ofic_bairro" id="ofic_bairro" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_bairro'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_bairro')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_bairro'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-8">
                                                <label for="ofic_endereco">Endereço:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('ofic_endereco')) ? 'is-invalid' : ''; ?>" name="ofic_endereco" id="ofic_endereco" placeholder="Ex.: " value="<?= $get_one_oficina['ofic_endereco'] ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_endereco')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_endereco'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="ofic_observacao">Observações:</label>
                                                <textarea class="form-control <?= ($validation->hasError('ofic_observacao')) ? 'is-invalid' : ''; ?>" name="ofic_observacao" placeholder="Ex.: " ><?= $get_one_oficina['ofic_description'] ?></textarea>
                                                <!-- Error -->
                                                <?php if ($validation->getError('ofic_observacao')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('ofic_observacao'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> Alterar</button>
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
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>Cidade</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($list_oficinas) && is_array($list_oficinas)) : ?>

                                                <?php foreach ($list_oficinas as $list_car) : ?>
                                                    <tr>
                                                        <td><?= esc($list_car['ofic_nome_fantasia']) ?></td>
                                                        <td><?= esc($list_car['ofic_telefone']) ?></td>
                                                        <td><?= esc($list_car['ofic_cidade']) ?></td>
                                                        <td>
                                                            <div class="btn-group dropleft">
                                                                <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Opções
                                                                </button>

                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="/oficina/visualizar/<?= esc($list_car['ofic_id'], 'url') ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                                                    <div class="dropdown-divider"></div>
                                                                    <a class="dropdown-item" href="/oficina/deletar/<?= esc($list_car['ofic_id'], 'url') ?>"><i class="fa fa-trash"></i> Deletar</a>
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

        $('#ofic_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#ofic_cnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#ofic_endereco").val("");
            $("#ofic_bairro").val("");
            $("#ofic_cidade").val("");
            $("#ofic_uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#ofic_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#ofic_endereco").val("...");
                    $("#ofic_bairro").val("...");
                    $("#ofic_cidade").val("...");
                    $("#ofic_uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#ofic_endereco").val(dados.logradouro);
                            $("#ofic_bairro").val(dados.bairro);
                            $("#ofic_cidade").val(dados.localidade);
                            $("#ofic_uf").val(dados.uf);
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