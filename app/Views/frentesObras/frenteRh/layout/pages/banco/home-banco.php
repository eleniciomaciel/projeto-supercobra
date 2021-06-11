<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">

    <!-- TO DO List -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3"><?= esc($title) ?></h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fas fa-piggy-bank"></i> Conta(s) bancária(s)</a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fas fa-university"></i> Cadastrar Conta</a></li>

            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <?= $this->include('frentesObras/frenteRh/layout/pages/banco/includes/lista-bancos', $funcionario); ?>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <?= $this->include('frentesObras/frenteRh/layout/pages/banco/includes/cadastra-bancos', $funcionario); ?>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>

    <!-- /.card -->
    <?= $this->include('frentesObras/frenteRh/layout/components/006_popap_banco') ?>
    <?= $this->include('frentesObras/frenteRh/layout/components/007_popap_banco_funcionario', $funcionario) ?>
</section>
<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    $(document).ready(function() {
        var id_usuario_conta = <?= esc($funcionario['f_id']) ?>;
        selectListaBancos();
        selectListaBancosParaUsuarios();

        $('#lista_bacos_cadastrados').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/banco/get-bancos"); ?>",
                type: "GET",
            }
        });

        $('#lista_contas_funcionarios_ativos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/banco/getContas_funcionarios/"); ?>" + id_usuario_conta,
                type: "GET",
            }
        });



        $('#form_add_banco').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_banco').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_banco').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_banco').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_banco').attr('disabled', false);

                    if (data.error == 'yes') {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você possuí alguns error que precisam ser corrigidos.',
                            showConfirmButton: false,
                            timer: 2300
                        });

                        $('#nome_banco_error').text(data.nome_banco_error);
                        $('#numero_banco_error').text(data.numero_banco_error);
                    } else {
                        $('#nome_banco_error').text('');
                        $('#numero_banco_error').text('');

                        $('#message_add_banco').html(data.message);
                        $('#lista_bacos_cadastrados').DataTable().ajax.reload();

                        $('#form_add_banco')[0].reset();
                        setTimeout(function() {
                            $('#message_add_banco').html('');
                        }, 2500);
                    }
                }
            });
        });



        $(document).on('click', '.clickListBanco', function(event) {
            event.preventDefault();
            let id = $(this).data('id');


            $.ajax({

                url: "<?php echo site_url('/banco/listaOneBanco'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                success: function(data) {

                    $('#b_nome').val(data.b_nome);
                    $('#b_numero').val(data.b_numero);
                    $('#modalVerAlteraBanco').modal('show');
                    $('#hidden_id_banco').val(id);
                }
            })
        });


        $('#form_altera_dados_banco').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_banco').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_banco').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_up_banco').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_up_banco').attr('disabled', false);

                    if (data.error == 'yes') {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você possuí alguns error que precisam ser corrigidos.',
                            showConfirmButton: false,
                            timer: 2300
                        });

                        $('#b_nome_error').text(data.b_nome_error);
                        $('#b_numero_error').text(data.b_numero_error);
                    } else {
                        $('#b_nome_error').text('');
                        $('#b_numero_error').text('');

                        $('#message_up_banco').html(data.message);
                        $('#lista_bacos_cadastrados').DataTable().ajax.reload();
                        selectListaBancos();
                        setTimeout(function() {
                            $('#message_up_banco').html('');
                        }, 2500);
                    }
                }
            });
        });

        /**delete banco */
        $(document).on('click', '.deleteBanco', function(event) {
            let id = $(this).data('id');
            event.preventDefault();

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Essa ação será de forma permanente ao confirmar!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/banco/deleta_banco'); ?>",
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#lista_bacos_cadastrados').DataTable().ajax.reload();
                            selectListaBancos();
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                        }
                    })
                }
            });
        });


        $('#form_add_dados_banco_usuario').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_banco_user').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_banco_user').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#id_up_banco_user').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_up_banco_user').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#select_banco_cad_error').text(data.select_banco_cad_error);
                        $('#us_tipo_conta_error').text(data.us_tipo_conta_error);
                        $('#ub_agenco_error').text(data.ub_agenco_error);
                        $('#up_digito_agencia_error').text(data.up_digito_agencia_error);
                        $('#ub_numero_conta_error').text(data.ub_numero_conta_error);
                        $('#bu_digito_conta_error').text(data.bu_digito_conta_error);
                        $('#bu_status_conta_error').text(data.bu_status_conta_error);
                        $('#bu_tutular_conta_error').text(data.bu_tutular_conta_error);
                        $('#bu_data_vencimento_conta_error').text(data.bu_data_vencimento_conta_error);
                        $('#bu_observacao_conta_error').text(data.bu_observacao_conta_error);
                    } else {
                        $('#select_banco_cad_error').text('');
                        $('#us_tipo_conta_error').text('');
                        $('#ub_agenco_error').text('');
                        $('#up_digito_agencia_error').text('');
                        $('#ub_numero_conta_error').text('');
                        $('#bu_digito_conta_error').text('');
                        $('#bu_status_conta_error').text('');
                        $('#bu_tutular_conta_error').text('');
                        $('#bu_data_vencimento_conta_error').text('');
                        $('#bu_observacao_conta_error').text('');

                        $('#message_user_conta_add').html(data.message);
                        $('#form_add_dados_banco_usuario')[0].reset();
                        selectListaBancos();
                        $('#lista_contas_funcionarios_ativos').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_user_conta_add').html('');
                        }, 2500);
                    }
                }
            })
        });

        $(document).on('click', '.clickBancoUser', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('/banco/getDadosConta'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#fk_banco_bu').val(data.fk_banco_bu);
                    $('#tipo_conta_bu').val(data.tipo_conta_bu);
                    $('#agencia_bu').val(data.agencia_bu);
                    $('#digito_agencia_bu').val(data.digito_agencia_bu);
                    $('#numero_conta_bu').val(data.numero_conta_bu);
                    $('#digito_conta_bu').val(data.digito_conta_bu);
                    $('#status_conta_bu').val(data.status_conta_bu);
                    $('#titular_status_bu').val(data.titular_status_bu);
                    $('#data_vencimento_conta_bu').val(data.data_vencimento_conta_bu);
                    $('#observacao_bu').val(data.observacao_bu);
                    $('#modalBancoUsuario').modal('show');
                    $('#hidden_id_conta_user').val(id);
                }
            })
        });

        selectListaBancosParaUsuarios();

        function selectListaBancosParaUsuarios() {
            $.ajax({
                url: '<?= site_url('/banco/get_list_nacos_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="fk_banco_bu"]').empty();
                    $('select[name="fk_banco_bu"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#fk_banco_bu').append('<option value="' + data['id_b'] + '">' + data['b_nome'] + '</option>');
                    });
                }
            });
        }


        /**altera dados da conta */
        $('#form_altera_dados_banco_usuario').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_banco_user_uper').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_banco_user_uper').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#id_up_banco_user_uper').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_up_banco_user_uper').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#fk_banco_bu_error').text(data.fk_banco_bu_error);
                        $('#tipo_conta_bu_error').text(data.tipo_conta_bu_error);
                        $('#agencia_bu_error').text(data.agencia_bu_error);
                        $('#digito_agencia_bu_error').text(data.digito_agencia_bu_error);
                        $('#numero_conta_bu_error').text(data.numero_conta_bu_error);
                        $('#digito_conta_bu_error').text(data.digito_conta_bu_error);
                        $('#status_conta_bu_error').text(data.status_conta_bu_error);
                        $('#titular_status_bu_error').text(data.titular_status_bu_error);
                        $('#data_vencimento_conta_bu_error').text(data.data_vencimento_conta_bu_error);
                        $('#observacao_bu_error').text(data.observacao_bu_error);
                    } else {
                        $('#fk_banco_bu_error').text('');
                        $('#tipo_conta_bu_error').text('');
                        $('#agencia_bu_error').text('');
                        $('#digito_agencia_bu_error').text('');
                        $('#numero_conta_bu_error').text('');
                        $('#digito_conta_bu_error').text('');
                        $('#status_conta_bu_error').text('');
                        $('#titular_status_bu_error').text('');
                        $('#data_vencimento_conta_bu_error').text('');
                        $('#observacao_bu_error').text('');

                        $('#message_user_conta_up').html(data.message);
                        $('#lista_contas_funcionarios_ativos').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_user_conta_up').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**delete conta do funcionario */
        $(document).on('click', '.deleteBancoUser', function(event) {
            let id = $(this).data('id');
            event.preventDefault();

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Essa ação será de forma permanente ao confirmar!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/banco/deleta_conta_usuario'); ?>",
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#lista_contas_funcionarios_ativos').DataTable().ajax.reload();
                            selectListaBancos();
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                        }
                    })
                }
            });
        });

        $(document).on('click', '.clickBancoAtivaCOntaUser', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: '<strong>Alterar status da conta?</strong>',
                text: "Ao confirmar o status será alterado!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, ativar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/banco/alter_status'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                            $('#lista_contas_funcionarios_ativos').DataTable().ajax.reload();

                        }
                    })
                }
            });
        });


        function selectListaBancos() {
            $.ajax({
                url: '<?= site_url('/banco/get_list_nacos_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="select_banco_cad"]').empty();
                    $('select[name="select_banco_cad"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#select_banco_cad').append('<option value="' + data['id_b'] + '">' + data['b_nome'] + '</option>');
                    });
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>