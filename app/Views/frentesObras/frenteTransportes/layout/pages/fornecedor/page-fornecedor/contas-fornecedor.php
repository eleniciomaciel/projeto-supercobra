<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transporte-fornecedor/fornecedor" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br><br>
    </div>
    <?php $validation = \Config\Services::validation(); ?>
    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_add_conta_error_cadastro')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Vixe!</h5>
                    <?php echo session()->getFlashdata('fornecedor_add_conta_error_cadastro') ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_conta_add_success')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('fornecedor_conta_add_success') ?>
                </div>
            </div>

        <?php
        }
        ?>

        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> Cobra Brasil, Inc.
                                <small class="float-right">Data da consulta: <?= date('d/m/Y') ?></small>
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
                            <p class="lead">Contas Bancárias:</p>

                            <div class="table table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agência</th>
                                            <th>Tipo</th>
                                            <th>Conta</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($list_contas) && is_array($list_contas)) : ?>
                                            <?php foreach ($list_contas as $lst_contas) : ?>
                                                <tr>
                                                    <td><?= esc($lst_contas['cbf_banco']) ?></td>
                                                    <td><?= esc($lst_contas['cbf_agencia']) ?></td>
                                                    <td><?= esc($lst_contas['cbf_tipo_conta']) ?></td>
                                                    <td><?= esc($lst_contas['cbf_numero_conta'] . ' - ' . $lst_contas['cbf_digito_conta']) ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                            <button type="button" class="verContaFornecedor btn btn-primary" data-id="<?= esc($lst_contas['cbf_id']) ?>" title="Visualizar conta"><i class="fas fa-eye"></i></button>
                                                            <button type="button" class="deleteBancoFornecedor btn btn-danger" data-id="<?= esc($lst_contas['cbf_id']) ?>" title="Deletar conta"><i class="fas fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-muted text-center">Não há contas para esse fornecedor</td>
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
                                <div class="card-header">
                                    <h3 class="card-title">Cadastrar Conta</h3>
                                </div>
                                <!-- /.card-header -->
                                <?php $validation = \Config\Services::validation(); ?>
                                <!-- form start -->
                                <?= form_open('Transporte/FornecedorController/cadastroContaFornecedor') ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="fornecedor_banco_titular">Titular da Conta:</label>
                                        <input type="text" class="form-control" name="fornecedor_banco_titular" id="fornecedor_banco_titular" value="<?= esc($dd_fornecedor['for_responsavel']) ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="fornecedor_banco">Banco:</label>
                                        <input type="text" class="form-control" name="fornecedor_banco" id="fornecedor_banco" placeholder="Ex.: Banco do Brasil" value="<?= old('fornecedor_banco') ?>">
                                        <!-- Error -->
                                        <?php if ($validation->getError('fornecedor_banco')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('fornecedor_banco'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label for="validationDefault01">Tipo de Conta</label>
                                            <select name="fb_tipo_conta" class="form-control">
                                                <option selected="" disabled="">Selecione aqui...</option>
                                                <option value="Conta-Corrente">Conta-Corrente</option>
                                                <option value="Conta-Digital">Conta-Digital</option>
                                                <option value="Conta-Poupança">Conta-Poupança</option>
                                                <option value="Conta-Universitária">Conta-Universitária</option>
                                                <option value="Conta-Salário">Conta-Salário</option>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('fb_tipo_conta')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('fb_tipo_conta'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fb_agencia">Agência</label>
                                            <input type="number" class="form-control" name="fb_agencia" placeholder="Ex.: 1234" value="<?= old('fb_agencia') ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('fb_agencia')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('fb_agencia'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="fb_numero_conta">Nº de Conta</label>
                                            <input type="number" class="form-control" name="fb_numero_conta" placeholder="1234567" value="<?= old('fb_numero_conta') ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('fb_numero_conta')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('fb_numero_conta'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fb_digito_agencia">Dígito da Conta</label>
                                            <input type="text" class="form-control" name="fb_digito_agencia" placeholder="Ex.: 12" value="<?= old('fb_digito_agencia') ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('fb_digito_agencia')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('fb_digito_agencia'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="fb_observacao">Observações da conta:</label>
                                            <textarea class="form-control" name="fb_observacao" id="fb_observacao" placeholder="Digite aqui..." rows="3"><?= old('fb_observacao') ?></textarea>
                                            <!-- Error -->
                                            <?php if ($validation->getError('fb_observacao')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('fb_observacao'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="fb_id_fornecedor" value="<?= esc($dd_fornecedor['for_id']) ?>">
                                <input type="hidden" name="fb_obra" value="<?= session()->get('log_obra') ?>">
                                <input type="hidden" name="fb_frente" value="<?= session()->get('log_frente') ?>">
                                <input type="hidden" name="fb_usuario" value="<?= session()->get('id') ?>">

                                <div class="card-footer">
                                    <div class="id_btn_fornecedor"></div>
                                    <button type="submit" class="btn btn-primary" id="btnSubmit_Fornecedor">
                                        <i class="fas fa-save"></i> Salvar
                                    </button>
                                </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div>


</section>

<!-- Modal -->
<div class="modal fade" id="dadosContaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados da Conta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Cadastrar Conta</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <?= form_open('Transporte/FornecedorController/alteraContaFornecedor', array('id' => 'formAlteraConta')) ?>
                    <div class="card-body">


                        <div class="form-row">

                            <div class="form-group col-8">
                                <label for="fornecedor_banco_titular">Titular da Conta:</label>
                                <input type="text" class="form-control" name="fornecedor_banco_titular" id="fornecedor_banco_titular" value="<?= esc($dd_fornecedor['for_responsavel']) ?>">
                            </div>

                            <div class="form-group col-4">
                                <label for="up_banco_for">Banco:</label>
                                <input type="text" class="form-control" name="up_banco_for" id="cbf_banco" id="fornecedor_banco" placeholder="Ex.: Banco do Brasil">
                                <!-- Error -->
                                <span class="text-danger error-text up_banco_for_error"></span>
                            </div>

                            <div class="col-md-3">
                                <label for="validationDefault01">Tipo de Conta</label>
                                <select name="cbf_tipo_conta" id="cbf_tipo_conta" class="form-control">
                                    <option selected="" disabled="">Selecione aqui...</option>
                                    <option value="Conta-Corrente">Conta-Corrente</option>
                                    <option value="Conta-Digital">Conta-Digital</option>
                                    <option value="Conta-Poupança">Conta-Poupança</option>
                                    <option value="Conta-Universitária">Conta-Universitária</option>
                                    <option value="Conta-Salário">Conta-Salário</option>
                                </select>
                                <!-- Error -->
                                <span class="text-danger error-text cbf_tipo_conta_error"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="up_agencia_for">Agência</label>
                                <input type="number" class="form-control" name="up_agencia_for" id="cbf_agencia" placeholder="Ex.: 1234">
                                <span class="text-danger error-text up_agencia_for_error"></span>
                                <!-- Error -->
                            </div>

                            <div class="col-md-3">
                                <label for="up_numconta_for">Nº de Conta</label>
                                <input type="number" class="form-control" name="up_numconta_for" id="cbf_numero_conta" placeholder="1234567">
                                <!-- Error -->
                                <span class="text-danger error-text up_numconta_for_error"></span>
                            </div>

                            <div class="col-md-3">
                                <label for="up_digito_for">Dígito da Conta</label>
                                <input type="text" class="form-control" name="up_digito_for" id="cbf_digito_conta" placeholder="Ex.: 12">
                                <!-- Error -->
                                <span class="text-danger error-text up_digito_for_error"></span>
                            </div>

                            <div class="col-md-12">
                                <label for="up_observacao_for">Observações da conta:</label>
                                <textarea class="form-control" name="up_observacao_for" id="cbf_Observacoes_conta" placeholder="Digite aqui..." rows="3"></textarea>
                                <!-- Error -->
                                <span class="text-danger error-text up_observacao_for_error"></span>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="hidden_id_banco" id="hidden_id_banco">
                    <div class="card-footer">
                        <div class="id_btn_fornecedor"></div>
                        <button type="submit" class="cls_btn_alterarbanco btn btn-danger" id="btn_altera_banco">
                            <i class="fas fa-save"></i> Alterar
                        </button>
                    </div>
                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        setTimeout(function() {
            $('.hide_up_smes').html('');
        }, 5000);
    })
</script>
<script>
    $(document).ready(function() {
        $("#btnSubmit_Fornecedor").click(function() {
            $(this).hide();
            $('.id_btn_fornecedor').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Sanvando, aguarde...</button>');
        });

        /**lista dados conta */
        $(document).on('click', '.verContaFornecedor', function() {

            let id_c = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorController/getDadosBancoModal'); ?>",
                method: "GET",
                data: {
                    id_c: id_c
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#cbf_banco').val(data.cbf_banco);
                    $('#cbf_tipo_conta').val(data.cbf_tipo_conta);
                    $('#cbf_agencia').val(data.cbf_agencia);
                    $('#cbf_numero_conta ').val(data.cbf_numero_conta);
                    $('#cbf_digito_conta').val(data.cbf_digito_conta);
                    $('#cbf_Observacoes_conta').val(data.cbf_Observacoes_conta);
                    $('#dadosContaModal').modal('show');
                    $('#hidden_id_banco').val(id_c);
                }
            })
        });

        /**alteraçãode conta */
        $("#formAlteraConta").submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    $('#btn_altera_banco').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...');
                    $('.cls_btn_alterarbanco').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_altera_banco').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_btn_alterarbanco').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'error'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            Swal.fire(
                                'Ops!',
                                'Existem alguns erros, corrija por favor.',
                                'error'
                            );
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

        /**
         * deleta banco do fornecedor
         */
        $(document).on('click', '.deleteBancoFornecedor', function() {
            var id_del_conta = $(this).data('id');


            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/FornecedorController/deleteContaFornecedor'); ?>",
                        method: "GET",
                        data: {
                            id_del_conta: id_del_conta
                        },

                        success: function(data) {
                            Swal.fire(
                                'Deletedo!',
                                data,
                                'success'
                            );
                            setTimeout(function() {
                                location.reload(true);
                            }, 5000);
                        }
                    });
                }
            });
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

    document.getElementById("fornecedor_banco_titular").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fornecedor_banco").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fb_observacao").addEventListener("keyup", forceInputUppercase, false);
</script>
<?= $this->endSection() ?>