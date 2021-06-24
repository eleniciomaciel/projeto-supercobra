<div class="row">
    <div class="col-md-6">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Cadastro do fornecedor
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php $validation = \Config\Services::validation(); ?>

                <form action="/frota/altera-fornecedor/<?= esc($cad['for_id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="vei_for_nome">Nome Fantasia:</label>
                        <input type="text" class="form-control <?= ($validation->hasError('vei_for_nome')) ? 'is-invalid' : ''; ?>" name="vei_for_nome" value="<?= esc($cad['for_nome_fantasia']) ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('vei_for_nome')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('vei_for_nome'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="vei_for_responsavel">Responsável:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('vei_for_responsavel')) ? 'is-invalid' : ''; ?>" name="vei_for_responsavel" placeholder="Ex.: " value="<?= esc($cad['for_responsavel']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_responsavel')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_responsavel'); ?>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="vei_for_email">Email:</label>
                            <input type="email" class="form-control <?= ($validation->hasError('vei_for_email')) ? 'is-invalid' : ''; ?>" name="vei_for_email" placeholder="Ex.: " value="<?= esc($cad['for_email']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_email')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_email'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vei_for_telefone">Telefone:</label>
                            <input type="tel" class="form-control <?= ($validation->hasError('vei_for_telefone')) ? 'is-invalid' : ''; ?>" name="vei_for_telefone" placeholder="Ex.: " value="<?= esc($cad['for_telefone']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_telefone')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_telefone'); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="vei_for_cnpj">CNPJ:</label>
                        <input type="text" class="form-control <?= ($validation->hasError('vei_for_cnpj')) ? 'is-invalid' : ''; ?>" name="vei_for_cnpj" id="vei_for_cnpj" value="<?= esc($cad['for_cnpj']) ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('vei_for_cnpj')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('vei_for_cnpj'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="vei_for_cep">CEP:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('vei_for_cep')) ? 'is-invalid' : ''; ?>" name="vei_for_cep" id="vei_for_cep" value="<?= esc($cad['for_cep']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_cep')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_cep'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="vei_for_uf">UF:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('vei_for_uf')) ? 'is-invalid' : ''; ?>" name="vei_for_uf" id="vei_for_uf" placeholder="Ex.: " value="<?= esc($cad['for_uf']) ?>" readonly>
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_uf')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_uf'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vei_for_cidade">Cidade</label>
                            <input type="text" class="form-control <?= ($validation->hasError('vei_for_cidade')) ? 'is-invalid' : ''; ?>" name="vei_for_cidade" id="vei_for_cidade" placeholder="Ex.: " value="<?= esc($cad['for_cidade']) ?>" readonly>
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_cidade')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_cidade'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vei_for_bairro">Bairro:</label>
                            <input type="text" class="form-control <?= ($validation->hasError('vei_for_bairro')) ? 'is-invalid' : ''; ?>" name="vei_for_bairro" id="vei_for_bairro" placeholder="Ex.: " value="<?= esc($cad['for_bairro']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_bairro')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_bairro'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-8">
                            <label for="vei_for_endereco">Endereço:</label>
                            <input type="tel" class="form-control <?= ($validation->hasError('vei_for_endereco')) ? 'is-invalid' : ''; ?>" name="vei_for_endereco" id="vei_for_endereco" placeholder="Ex.: " value="<?= esc($cad['for_endereco']) ?>">
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_endereco')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_endereco'); ?>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="vei_for_frente">Frente:</label>
                            <select name="vei_for_frente" class="form-control <?= ($validation->hasError('vei_for_frente')) ? 'is-invalid' : ''; ?>">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($frente) && is_array($frente)) : ?>
                                    <?php foreach ($frente as $news_item) : ?>
                                        <option value="<?= esc($news_item['id_ft']) ?>" <?php if($news_item['id_ft'] == esc($cad['for_fk_frente'])){echo 'selected';}?>><?= esc($news_item['nome_ft']) ?></option>
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

                        <div class="form-group col-md-12">
                            <label for="vei_for_observacao">Observações:</label>
                            <textarea class="form-control <?= ($validation->hasError('vei_for_observacao')) ? 'is-invalid' : ''; ?>" name="vei_for_observacao" placeholder="Digite aqui...." rows="3"><?= esc($cad['for_description']) ?></textarea>
                            <!-- Error -->
                            <?php if ($validation->getError('vei_for_observacao')) { ?>
                                <div class='text-danger mt-2'>
                                    <?= $error = $validation->getError('vei_for_observacao'); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-save"></i> Alterar
                    </button>
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
                    Cadastros
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>email</th>
                            <th>telefone</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($list_fornecedor) && is_array($list_fornecedor)) : ?>

                            <?php foreach ($list_fornecedor as $news_item) : ?>


                                <tr>
                                    <td><?= esc($news_item['for_nome_fantasia']) ?></td>
                                    <td><?= esc($news_item['for_email']) ?></td>
                                    <td><?= esc($news_item['for_telefone']) ?></td>
                                    <td>
                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Ações
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="/frota/alterar-fornecedor/<?= esc($news_item['for_id'], 'url') ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/frota/deletar-fornecedor/<?= esc($news_item['for_id'], 'url') ?>"><i class="fa fa-trash"></i> Deletar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>
                            <tr>
                                <td colspan="4">Não ha registro cadastrado</td>
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