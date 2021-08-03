<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transposte-solicitacao-material-equipamentos-servicos/solicitacao-mes" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br><br>

        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Adicionar itens a nota.
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <address>
                        Obra: <strong><?= esc($lista_doc_servicos['smes_sequencia_numerica']) ?></strong><br>
                        Departamento: <strong><?= esc($list_join['dep_name']) ?></strong><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        Loc. Entrega: <strong><?= esc($lista_doc_servicos['smes_local_entrega']) ?></strong><br>
                        Data da nota: <strong><?= esc(date('d/m/Y', strtotime($lista_doc_servicos['datetime']))) ?></strong>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <address>
                        Solicitante: <strong><?= esc($user_dd['f_nome']) ?></strong><br>
                        Frente: <strong><?= esc($list_join['nome_ft']) ?></strong><br>
                    </address>
                </div>
                <!-- /.col -->
                <address>
                    Obra/Projeto: <b><?= esc($user_obra['obras_local']) ?></b><br>
                    Aplicação: <b><?= esc(strip_tags($lista_doc_servicos['smes_aplicacao'])) ?></b>
                </address>
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped" id="refresh_table">
                        <thead>
                            <tr>
                                <th>Unid.</th>
                                <th>Quant.</th>
                                <th>data</th>
                                <th>descrições</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($list_itens_solicitacao) && is_array($list_itens_solicitacao)) : ?>
                                <?php foreach ($list_itens_solicitacao as $itens) : ?>
                                    <tr>
                                        <td><?= esc($itens['isc_unidade']) ?></td>
                                        <td><?= esc($itens['isc_quantidade']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($itens['isc_data_necessidade'])) ?></td>
                                        <td><?= esc($itens['isc_descricao_da_requisicao']) ?></td>
                                        <td>
                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Opções
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="vierItem dropdown-item" href="#" data-id="<?= esc($itens['isc_id'], 'url') ?>"><i class="fas fa-eye"></i> Alterar</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="deletaItem dropdown-item" href="#" data-id="<?= esc($itens['isc_id'], 'url') ?>"><i class="fas fa-trash"></i> Deletar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Não há itens para esse registro.</td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <br>
            <div class="col-12">
                <?php
                if (session()->getFlashdata('success_message_iten')) {
                ?>
                    <div class="hide_add_smes">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                            <?php echo session()->getFlashdata('success_message_iten') ?>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <br>
            <div class="col-12">
                <?php
                if (session()->getFlashdata('error_message_iten')) {
                ?>
                    <div class="hide_add_smes">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-times-circle"></i> Vixe!</h5>
                            <?php echo session()->getFlashdata('error_message_iten') ?>
                            <?= \Config\Services::validation()->listErrors() ?>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>

            <div class="row">
                <!-- accepted payments column -->

                <?php $validation = \Config\Services::validation(); ?>

                <!-- /.col -->
                <div class="col-12">
                    <p class="lead text-center">Complemento do formulário</p>

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Itens para cadastro</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/solicitacaoItensCompra') ?>" method="POST" id="add_novos_itens">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Unidade:</label>
                                            <input type="text" class="form-control" id="iten_unidade" name="iten_unidade" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter ..." maxlength="2" value="<?= old('iten_unidade') ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('iten_unidade')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('iten_unidade'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Quantidade:</label>
                                            <input type="number" min="1" class="form-control" name="iten_quantidade" id="iten_quantidade" placeholder="Enter ..." value="<?= old('iten_quantidade') ?>">
                                            <!-- Error -->
                                            <?php if ($validation->getError('iten_quantidade')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('iten_quantidade'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label for="iten_data">Data da necessidade:</label>
                                        <input type="date" class="form-control" name="iten_data" value="<?= old('iten_data') ?>">
                                        <!-- Error -->
                                        <?php if ($validation->getError('iten_data')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('iten_data'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="iten_descricao_material_equipamento">Descrição do Material/Equipamento:</label>
                                        <textarea class="form-control" name="itens_descricao" id="itens_descricao" rows="3"><?= old('itens_descricao') ?></textarea>
                                        <!-- Error -->
                                        <?php if ($validation->getError('itens_descricao')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('itens_descricao'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="form-group col-6">

                                        <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#addRequisicoesModalItens">
                                            <i class="fas fa-plus"></i> Add requisitos
                                        </button>

                                        <label>Requisito de Segurança e Meio Ambiente:</label>
                                        <select class="form-control" name="itens_mas[]" id="lstBox2" multiple> </select>
                                        <!-- Error -->
                                        <?php if ($validation->getError('itens_mas')) { ?>
                                            <div class='text-danger mt-2'>
                                                <?= $error = $validation->getError('itens_mas'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iten_cento_custo">Cento de custo:</label>
                                    <select class="form-control" name="itens_cc[]" id="itens_cc" multiple>
                                        <option selected disabled>Selecione aqui...</option>
                                        <?php if (!empty($lista_cc) && is_array($lista_cc)) : ?>
                                            <?php foreach ($lista_cc as $news_cc) : ?>
                                                <option value="<?= esc($news_cc['numero_cc']) ?>"><?= esc($news_cc['numero_cc']) ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option>Não há registro de Cento de Custo</option>
                                        <?php endif ?>
                                    </select>
                                    <!-- Error -->
                                    <?php if ($validation->getError('itens_cc')) { ?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('itens_cc'); ?>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="iten_observacao">Observações:</label>
                                    <textarea class="form-control" name="iten_observacao" placeholder="Digite aqui..." rows="3"><?= old('iten_observacao') ?></textarea>
                                    <!-- Error -->
                                    <?php if ($validation->getError('iten_observacao')) { ?>
                                        <div class='text-danger mt-2'>
                                            <?= $error = $validation->getError('iten_observacao'); ?>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="id_solicitante" value="<?= session()->get('id') ?>">
                            <input type="hidden" name="id_solicitacao" value="<?= esc($lista_doc_servicos['smes_id']) ?>">

                            <div class="card-footer">
                                <button type="submit" class="add_btn_itens_da_solitacao btn btn-primary" id="btnSubmitItens">
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


    </div>

    <!-- Modal -->
    <div class="modal fade" id="addRequisicoesModalItens" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar requições da segurança</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-12">
                        <p class="lead text-center">Adicionar itens a nota:</p>


                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Formulário de itens</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="" method="POST" id="add_novos_itens">

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="iten_requisito_meio_ambiente">Requisito de Segurança e Meio Ambiente:</label>
                                        <select class="form-control" name="id_quali" id="id_quali">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php if (!empty($lista_categoria_qualidade) && is_array($lista_categoria_qualidade)) : ?>
                                                <?php foreach ($lista_categoria_qualidade as $item_qualidade) : ?>
                                                    <option value="<?= esc($item_qualidade['ql_id']) ?>"><?= esc(strip_tags($item_qualidade['ql_description'])) ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option>Sem categorias adicionada</option>
                                            <?php endif ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Adicionar requisitos</label>
                                        <div class="card-tools col-12 mx-auto">
                                            <!-- button with a dropdown -->
                                            <button type="button" id="btnRight" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus"></i> Adicionar
                                            </button>
                                            <button type="button" id="btnLeft" class="btn btn-danger btn-sm">
                                                <i class="fas fa-minus"></i> Remover
                                            </button>
                                            <button type="button" id="btnRightall" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus-circle"></i> Add Todos
                                            </button>
                                            <button type="button" id="btnLeftall" class="btn btn-danger btn-sm">
                                                <i class="fas fa-minus-circle"></i> Rem. Todos
                                            </button>
                                        </div>
                                        <br>
                                        <select multiple="" class="form-control" id="itens_quali_doc">

                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </form>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">fechar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Dados do item -->

    <div class="modal fade" id="mostrarItenCriadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Dados do Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Itens para cadastro</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/alterasolicitacaoItensCompra') ?>" method="POST" id="alterar_novos_itens">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Unididade:</label>
                                            <input type="text" class="form-control" id="isc_unidade" name="isc_unidade" onkeyup="this.value = this.value.toUpperCase();" placeholder="Enter ..." maxlength="2">
                                            <!-- Error -->
                                            <span class="text-danger error-text isc_unidade_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Quantidade:</label>
                                            <input type="number" min="1" class="form-control" name="isc_quantidade" id="isc_quantidade" placeholder="Enter ...">
                                            <!-- Error -->
                                            <span class="text-danger error-text isc_quantidade_error"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="iten_descricao_material_equipamento">Descrição do Material/Equipamento:</label>
                                    <textarea class="form-control" name="isc_descricao_da_requisicao" id="isc_descricao_da_requisicao" rows="3"></textarea>
                                    <!-- Error -->
                                    <span class="text-danger error-text isc_descricao_da_requisicao_error"></span>
                                </div>

                                <div class="form-group">
                                    <label>Requisito de Segurança e Meio Ambiente:</label>
                                    <textarea class="form-control" name="isc_requisito_meio_ambiente" id="isc_requisito_meio_ambiente" placeholder="Digite aqui..." rows="3"></textarea>
                                    <span class="text-danger error-text isc_requisito_meio_ambiente_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="iten_cento_custo">Cento de custo:</label>
                                    <textarea class="form-control" name="isc_cento_custo" id="isc_cento_custo" placeholder="Digite aqui..." rows="3"></textarea>
                                    <span class="text-danger error-text isc_cento_custo_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="iten_data">Data da necessidade:</label>
                                    <input type="date" class="form-control" name="isc_data_necessidade" id="isc_data_necessidade">
                                    <span class="text-danger error-text isc_data_necessidade_error"></span>
                                    <!-- Error -->
                                </div>

                                <div class="form-group">
                                    <label for="iten_observacao">Observações:</label>
                                    <textarea class="form-control" name="isc_observacoes" id="isc_observacoes" placeholder="Digite aqui..." rows="3"></textarea>
                                    <span class="text-danger error-text isc_observacoes_error"></span>
                                    <!-- Error -->
                                </div>

                            </div>
                            <input type="hidden" name="hidden_id_iten" id="hidden_id_iten">
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="cls_btn_alterar_iten btn btn-danger" id="btn_altera_iten">
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

</section>
<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script>
    $(document).ready(function() {
        $('#btnRight').click(function(e) {
            var selectedOpts = $('#itens_quali_doc option:selected');
            if (selectedOpts.length == 0) {
                alert("Nada para mover.");
                e.preventDefault();
            }

            $('#lstBox2').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
            updateIDs();
        });

        $('#btnLeft').click(function(e) {
            var selectedOpts = $('#lstBox2 option:selected');
            if (selectedOpts.length == 0) {
                alert("Nada para mover.");
                e.preventDefault();
            }

            $('#itens_quali_doc').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
            updateIDs();
        });
        $("#btnRightall").click(function(e) {
            var selectedOpts = $('#itens_quali_doc option:not([disabled])');
            if (selectedOpts.length == 0) {
                alert("Nada para mover.");
                e.preventDefault();
            }
            $('#lstBox2').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
            updateIDs();
        });

        $("#btnLeftall").click(function(e) {
            var selectedOpts = $('#lstBox2 option:not([disabled])');
            if (selectedOpts.length == 0) {
                alert("Nada para mover.");
                e.preventDefault();
            }
            $('#itens_quali_doc').append($(selectedOpts).clone());
            $(selectedOpts).remove();
            e.preventDefault();
            updateIDs();
        })
    });

    function updateIDs() {
        $('#values').val('');
        $('#lstBox2 option').each(function(index) {
            console.log($(this).val());
            $('#values').val($('#values').val() + $(this).val() + ",");
        });
    }
</script>
<script>
    $(document).ready(function() {
        $("#btnSubmitItens").click(function() {
            //$(this).hide();
            $('.add_btn_itens_da_solitacao').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando aguarde...');
        });

        $('#id_quali').change(function() {
            var quali_id = $(this).val();
            // AJAX request
            $.ajax({
                url: '<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicosController/getListaQualidadeCategoriaItens') ?>',
                method: 'get',
                data: {
                    quali_id: quali_id
                },
                dataType: 'json',
                success: function(response) {
                    // $('#itens_quali_doc').remove();
                    $('#itens_quali_doc').find('option').remove();
                    $.each(response, function(index, data) {
                        $('#itens_quali_doc').append('<option value="' + data['qld_description'] + '" selected>' + data['qld_description'] + '</option>').text();
                    });
                }
            });
        });

        /**lista todos os itens */
        $(document).on('click', '.vierItem', function(event) {
            event.preventDefault();
            var id_iten = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/getViewItenSolicitacao'); ?>",
                method: "GET",
                data: {
                    id_iten: id_iten
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#isc_unidade').val(data.isc_unidade);
                    $('#isc_quantidade').val(data.isc_quantidade);
                    $('#isc_descricao_da_requisicao').val(data.isc_descricao_da_requisicao);
                    $('#isc_requisito_meio_ambiente').val(data.isc_requisito_meio_ambiente).text();
                    $('#isc_cento_custo').val(data.isc_cento_custo);
                    $('#isc_data_necessidade').val(data.isc_data_necessidade);
                    $('#isc_observacoes').val(data.isc_observacoes);
                    $('#mostrarItenCriadoModal').modal('show');
                    $('#hidden_id_iten').val(id_iten);
                }
            })
        });

        //desenvolver alteração
        $("#alterar_novos_itens").submit(function(e) {
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
                    $('#btn_altera_iten').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...');
                    $('.cls_btn_alterar_iten').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_altera_iten').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_btn_alterar_iten').attr('disabled', false);
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

        $(document).on('click', '.deletaItem', function() {
            var id_del_i = $(this).data('id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/deleteIten'); ?>",
                        method: "GET",
                        data: {
                            id_del_i: id_del_i
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deletado!',
                                data,
                                'success'
                            );
                            // $('#message').html(data);
                            setTimeout(function() {
                                $('#refresh_table');
                            }, 1000);
                        }
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your imaginary file is safe :)',
                        'error'
                    )
                }
            });
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
<?= $this->endSection() ?>