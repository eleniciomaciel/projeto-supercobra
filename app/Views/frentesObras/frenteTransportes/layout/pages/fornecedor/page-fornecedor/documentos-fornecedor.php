<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transporte-fornecedor/fornecedor" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_update_error_cadastro')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Vixe!</h5>
                    <?php echo session()->getFlashdata('fornecedor_update_error_cadastro') ?>
                </div>
            </div>

        <?php
        }

        if (session()->getFlashdata('delete_file')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> OK!</h5>
                    <?php echo session()->getFlashdata('delete_file') ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('success_uploaded_doc_fornecedor')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('success_uploaded_doc_fornecedor') ?>
                </div>
            </div>

        <?php
        }
        ?>
        <br>

        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Cobra Brasil, Inc.
                        <small class="float-right">Data da consulta: 04/08/2021</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    Dados do fornecedor
                    <address>
                        Cliente: <strong><?= esc($dd_fornecedor['for_responsavel']) ?></strong><br>
                        Telefone: <?= esc($dd_fornecedor['for_telefone']) ?><br>
                        Email: <?= esc($dd_fornecedor['for_email']) ?><br>
                        CPF: <?= esc($dd_fornecedor['for_cnpj']) ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    Dados de localizalçao
                    <address>
                        Cep: <?= esc($dd_fornecedor['for_cep']) ?><br>
                        UF.: <?= esc($dd_fornecedor['for_uf']) ?><br>
                        Cidade: <?= esc($dd_fornecedor['for_cidade']) ?><br>
                        Bairro: <?= esc($dd_fornecedor['for_bairro']) ?>
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr>

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Documentos do Fornecedor:</p>

                    <div class="table table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (!empty($list_docs) && is_array($list_docs)) : ?>
                                    <?php foreach ($list_docs as $news_doc) : ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($news_doc['created_at'])) ?></td>
                                            <td><?= esc($news_doc['fd_descricao']) ?></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="<?= base_url('Transporte/FornecedorController/baixarDocumentosFornecedor/' . esc($news_doc['fd_documento'])) ?>" class="btn btn-primary btn-sm" title="Baixar Aquivo"><i class="fas fa-cloud-download-alt"></i></a>
                                                    <a href="<?= base_url('Transporte/FornecedorController/deletaDocumentosFornecedor/' . esc($news_doc['fd_id'])) ?>" class="btn btn-danger btn-sm" title="Deletar Aquivo"><i class="fas fa-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">Não há arquivos cadastrados</td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Formulário de cadastro</p>

                    <div class="card card-primary">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">Cadastrar documento</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <?= form_open_multipart('Transporte/FornecedorController/cadastroDocuemntosFornecedor') ?>

                        <div class="card-body">

                            <?php if (session()->has('errors')) : ?>
                                <ul class="alert alert-danger">
                                    <?php foreach (session('errors') as $error) : ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif ?>

                            <div class="form-row">

                                <div class="form-group col-12">

                                    <label for="fornecedor_banco">Selecione um documento:</label>
                                    <div class="custom-doc_file_fornecedor">
                                        <input type="file" name="doc_file_fornecedor" class="custom-file-input" id="customFileLang" requireds>
                                        <label class="custom-file-label" for="customFileLang">Selecionar Arquivo</label>
                                    </div>
                                    <!-- Error -->
                                </div>
                                <div class="col-md-12">
                                    <label for="doc_descricao_fornecedor">Observações:</label>
                                    <textarea class="form-control" name="doc_descricao_fornecedor" id="doc_descricao_fornecedor" placeholder="Digite aqui..." rows="3"><?= old('doc_descricao_fornecedor') ?></textarea>
                                    <!-- Error -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="doc_id_fornecedor" value="<?= esc($dd_fornecedor['for_id']) ?>">
                        <input type="hidden" name="operador_usuario" value="<?= session()->get('id') ?>">

                        <div class="card-footer">
                            <div class="id_btn_fornecedor"></div>
                            <button type="submit" class="btn btn-primary" id="btnSubmit_Fornecedor">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                        <div style="display:none"><label>Fill This Field</label><input type="text" name="honeypot" value=""></div>
                        </form>
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

</section>


<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

    });
</script>

<script>
    $(function() {
        setTimeout(function() {
            $('.hide_up_smes').html('');
        }, 3000);
    })
</script>
<script>
    $(document).ready(function() {
        $("#btnSubmit_Fornecedor").click(function() {
            $(this).hide();
            $('.id_btn_fornecedor').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...</button>');
        });
    });
</script>

<script>
    function forceInputUppercase(e) {
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.setSelectionRange(start, end);
    }

    document.getElementById("fort_name").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_bairro").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_endereco").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_observacao").addEventListener("keyup", forceInputUppercase, false);
</script>
<?= $this->endSection() ?>