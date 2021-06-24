<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->

    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-hospital"></i> <?= esc($title) ?>
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">

                    <!-- <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-file-medical-alt"></i> Tipos</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-notes-medical"></i> Exam.: Riscos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#comb-cont" data-toggle="tab"><i class="fas fa-user-md"></i> Exames</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#config-aso" data-toggle="tab"><i class="fas fa-file-signature"></i> Congif.: ASO</a>
                    </li>

                </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_contratuais') ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="sales-chart">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_riscos_ocupacionais', $carg) ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="comb-cont">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_combo', $funf) ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="config-aso">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_config_aso', $carg) ?>
                    </div>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->


    <!-- Modal -->



</section>
<?= $this->include('frentesObras/frenteRh/layout/components/005_popap_config_exames', $carg) ?>
<?= $this->include('frentesObras/frenteRh/layout/components/010_popap_exames_e_aso') ?>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {
        SelecionaExamesContratos();
        SelecionaExamesRiscos();
        SelecionaExamesComboUp();
        SelecionaRiscosDaFuncao();
        //seleciona_exames_ajax();

        $('#list_exames_contratuais_all').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            columnDefs: [{
                targets: 0,
                render: function(data) {
                    return moment(data).format('L');
                }
            }],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/exames/list_exames_contratuais"); ?>",
                type: "GET",
            }
        });


        $('#lista_tipo_risco_trabalho').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],

            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/exames/list_risco_em_grau"); ?>",
                type: "GET",
            }
        });

        $('#lista_exames_combo').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/exames/get_lista_exames_combo"); ?>",
                type: "GET",
            }
        });
        /**adiciona dados cadastro */
        $('#form_exame_contratual').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_exam_contrato').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_exam_contrato').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_exam_contrato').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_exam_contrato').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#exc_name_error').text(data.exc_name_error);
                        $('#exc_descricao_error').text(data.exc_descricao_error);

                    } else {
                        $('#exc_name_error').text('');
                        $('#exc_descricao_error').text('');

                        $('#form_exame_contratual')[0].reset();
                        $('#message_emx_contartual').html(data.message);
                        $('#list_exames_contratuais_all').DataTable().ajax.reload();
                        SelecionaExamesContratos();
                        SelecionaExamesRiscos();
                        SelecionaExamesComboUp();
                        setTimeout(function() {
                            $('#message_emx_contartual').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**lista dados exame contaratual */
        $(document).on('click', '.verExameContratua', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/exames/get_exames_contartual_modal'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#ect_nome').val(data.ect_nome);
                    $('#ect_description').val(data.ect_description);
                    $('#modalExameContratual').modal('show');
                    $('#hidden_id_contrat_exame').val(id);
                }
            })
        });

        /**altera dados cadastro */
        $('#form_exame_contratual_altera').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_exam_contrato_up').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_exam_contrato_up').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_exam_contrato_up').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_exam_contrato_up').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#ect_nome_error').text(data.ect_nome_error);
                        $('#ect_description').text(data.ect_description);

                    } else {
                        $('#message_emx_contartual_up').html(data.message);
                        $('#list_exames_contratuais_all').DataTable().ajax.reload();
                        SelecionaExamesContratos();
                        SelecionaExamesRiscos();
                        SelecionaExamesComboUp();
                        setTimeout(function() {
                            $('#message_emx_contartual_up').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**deleta departamento */
        $(document).on('click', '.deleteExameContratua', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deseja deletar?',
                text: "Confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/exames/delete_exames_contratual_ativo'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            )
                            $('#list_exames_contratuais_all').DataTable().ajax.reload();
                            SelecionaExamesContratos();
                            SelecionaExamesRiscos();
                            SelecionaExamesComboUp();
                        }
                    })
                }
            });
        });


        /** ===================================== CADASTRO DOS RISCOS =============================*/


        /**adiciona dados cadastro */
        $('#form_add_risco_grau').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_exam_risco').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_exam_risco').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_exam_risco').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_exam_risco').attr('disabled', false);


                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#risco_funcao_error').text(data.risco_funcao_error);
                        $('#risco_nome_error').text(data.risco_nome_error);
                        $('#risco_grau_error').text(data.risco_grau_error);
                        $('#risco_descricao_error').text(data.risco_descricao_error);

                    } else {
                        $('#risco_funcao_error').text('');
                        $('#risco_nome_error').text('');
                        $('#risco_grau_error').text('');
                        $('#risco_descricao_error').text('');

                        $('#form_add_risco_grau')[0].reset();
                        $('#message_emx_add_risco').html(data.message);
                        $('#lista_tipo_risco_trabalho').DataTable().ajax.reload();
                        SelecionaExamesContratos();
                        SelecionaExamesRiscos();
                        setTimeout(function() {
                            $('#message_emx_add_risco').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**lista dados exame risco */
        $(document).on('click', '.ViewTisco', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/exames/get_exames_riscos'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#fk_funcao_eor').val(data.fk_funcao_eor);
                    $('#eor_nome').val(data.eor_nome);
                    $('#eor_grau_risco').val(data.eor_grau_risco);
                    $('#eor_description_risco').val(data.eor_description_risco);
                    $('#modal_riscos_one').modal('show');
                    $('#hidden_id_risco_exame_up').val(id);
                }
            })
        });

        /**adiciona dados cadastro riscos -------------------------------------------------*/
        $('#form_update_risco_grau').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_exam_risco').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_exam_risco').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_up_exam_risco').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_up_exam_risco').attr('disabled', false);


                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#fk_funcao_eor_error').text(data.fk_funcao_eor_error);
                        $('#eor_nome_error').text(data.eor_nome_error);
                        $('#eor_grau_risco_error').text(data.eor_grau_risco_error);
                        $('#eor_description_risco_error').text(data.eor_description_risco_error);

                    } else {
                        $('#fk_funcao_eor_error').text('');
                        $('#eor_nome_error').text('');
                        $('#eor_grau_risco_error').text('');
                        $('#eor_description_risco_error').text('');

                        $('#message_emx_up_risco').html(data.message);
                        $('#lista_tipo_risco_trabalho').DataTable().ajax.reload();
                        SelecionaExamesContratos();
                        SelecionaExamesRiscos();
                        setTimeout(function() {
                            $('#message_emx_up_risco').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**deleta departamento */
        $(document).on('click', '.deleteRisco', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deseja deletar?',
                text: "Confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/exames/delete_risco_em_grau'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            )
                            $('#lista_tipo_risco_trabalho').DataTable().ajax.reload();
                            SelecionaExamesContratos();
                            SelecionaExamesRiscos();

                        }
                    })
                }
            });
        });

        /**Cargo com função */

        function SelecionaExamesContratos() {
            $.ajax({
                url: '<?= site_url('/exames/listSelectExamesContrato') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="exm_contrato"]').empty();
                    $('select[name="exm_contrato"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#exm_contrato').append('<option value="' + data['id'] + '">' + data['ect_nome'] + '</option>');
                    });
                }
            });
        }


        function SelecionaExamesComboUp() {
            $.ajax({
                url: '<?= site_url('/exames/listSelectExamesContrato') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="exm_contrato_combo_up"]').empty();
                    $('select[name="exm_contrato_combo_up"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#exm_contrato_combo_up').append('<option value="' + data['id'] + '">' + data['ect_nome'] + '</option>');
                    });
                }
            });
        }

        /**Cargo com função */

        function SelecionaExamesRiscos() {
            $.ajax({
                url: '<?= site_url('/exames/listSelectExamesRiscos') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="exm_riscos"]').empty();
                    $('select[name="exm_riscos"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#exm_riscos').append('<option value="' + data['id_r'] + '">' + data['eor_nome'] + '</option>');
                    });
                }
            });
        }


        /**lista funções do cargo com seus riscos chamada por click*/
        $('#todas_funcao_para_risco').change(function() {
            var id_func = $(this).val();


            $.ajax({
                url: '<?= site_url('/exames/list_funcao_cargos_riscos') ?>',
                method: 'GET',
                data: {
                    id_func: id_func
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'json',
                success: function(response) {

                    $('select[name="select_carg_func_risco"]').append('<option selected disabled>Selecione aqui...</option>');
                    $('#select_carg_func_risco').find('option').not(':first').remove();

                    $.each(response, function(index, data) {
                        $('#select_carg_func_risco').append('<option value="' + data['id_r'] + '">' + data['eor_nome'] + '</option>');
                    });
                }
            });
        });



        /**adiciona dados combo -------------------------------------------------*/
        $('#form_add_combo_exames').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_exames_combo').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_exames_combo').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_up_exames_combo').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_up_exames_combo').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        //$('#exm_contrato_error').text(data.exm_contrato_error);
                        $('#todas_funcao_para_risco_error').text(data.todas_funcao_para_risco_error);
                        $('#select_carg_func_risco_error').text(data.select_carg_func_risco_error);
                        $('#final_exam_name_error').text(data.final_exam_name_error);
                        //$('#exames_mes_valor_error').text(data.exames_mes_valor_error);
                        $('#final_exame_desc_error').text(data.final_exame_desc_error);

                    } else {
                        //$('#exm_contrato_error').text('');
                        $('#todas_funcao_para_risco_error').text('');
                        $('#select_carg_func_risco_error').text('');
                        $('#final_exam_name_error').text('');
                        //$('#exames_mes_valor_error').text('');
                        $('#final_exame_desc_error').text('');

                        $('#message_exames_combo').html(data.message);
                        $('#lista_exames_combo').DataTable().ajax.reload();

                        setTimeout(function() {
                            $('#message_exames_combo').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**lista todos os exames */
        $(document).on('click', '.ViewExamesCombo', function() {
            var id = $(this).data('id');


            $.ajax({
                url: "<?php echo site_url('/exames/get_lista_one_exames'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                success: function(data) {

                    $('#exm_contrato_combo_up').val(data.ex_fk_tipo_contato);
                    $('#ex_fk_funcao').val(data.ex_fk_funcao);
                    $('#exm_riscos_funcao_ajax').val(data.ex_fk_risco);
                    $('#ex_tipo_exame').val(data.ex_tipo_exame);
                    $('#ex_validade_meses').val(data.ex_validade_meses);
                    $('#ex_description').val(data.ex_description);
                    $('#modalListaExamesOne').modal('show');
                    $('#hidden_id_exame_combo').val(id);
                }
            })
        });



        function SelecionaRiscosDaFuncao() {
            $.ajax({
                url: '<?= site_url('/exames/get_lista_funcao_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="exm_riscos_funcao_ajax"]').empty();
                    $('select[name="exm_riscos_funcao_ajax"]').append('<option selected disabled>Selecione aquixx...</option>');

                    $.each(response, function(index, data) {
                        $('#exm_riscos_funcao_ajax').append('<option value="' + data['id_r'] + '">' + data['eor_nome'] + ' <---> ' + data['eor_grau_risco'] + '</option>');
                    });
                }
            });
        }

        /**adiciona dados combo -------------------------------------------------*/
        $('#form_update_combo_exames').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_update_exames_combo').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_update_exames_combo').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_update_exames_combo').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_update_exames_combo').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        //$('#exm_contrato_combo_up_error').text(data.exm_contrato_combo_up_error);
                        $('#ex_fk_funcao_error').text(data.ex_fk_funcao_error);
                        $('#exm_riscos_funcao_ajax_error').text(data.exm_riscos_funcao_ajax_error);
                        $('#ex_tipo_exame_error').text(data.ex_tipo_exame_error);
                        //$('#ex_validade_meses_error').text(data.ex_validade_meses_error);
                        $('#ex_description').text(data.ex_description);

                    } else {
                        //$('#exm_contrato_combo_up_error').text('');
                        $('#ex_fk_funcao_error').text('');
                        $('#exm_riscos_funcao_ajax_error').text('');
                        $('#ex_tipo_exame_error').text('');
                        //$('#ex_validade_meses_error').text('');
                        $('#ex_description').text('');

                        $('#message_exames_update_combo').html(data.message);
                        $('#lista_exames_combo').DataTable().ajax.reload();

                        setTimeout(function() {
                            $('#message_exames_update_combo').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**deleta departamento */
        $(document).on('click', '.deleteExamesCombo', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            Swal.fire({
                title: 'Deseja deletar?',
                text: "Confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/exames/get_deleteExames'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            )
                            $('#lista_exames_combo').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });


        /*************************  lista os cargos das funçãoes ******************************* */
        $('#select_cargos_p_aso').change(function() {
            var id_cargo_aso = $(this).val();
            $.ajax({
                url: '<?= site_url('/aso/lista_cargos') ?>',
                method: 'GET',
                data: {
                    id_cargo_aso: id_cargo_aso
                },
                dataType: 'json',
                beforeSend: function() {
                    $(".loader").css('display', 'block');
                },
                complete: function() {
                    $(".loader").css('display', 'none');
                },
                success: function(response) {
                    // Remove options 
                    $('#select_funcao_cargo_all').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#select_funcao_cargo_all').append('<option value="' + data['id'] + '">' + data['cf_nome_cargo_funcao'] + '</option>');
                    });
                }
            });
        });

        /**lista dos os riscos dos cargos */
        $('#select_cargos_p_aso').change(function() {
            var id_cargo_risco = $(this).val();
            // AJAX request
            $.ajax({
                url: '<?= site_url('/aso/seleciona_riscos_cargos') ?>',
                method: 'GET',
                data: {
                    id_cargo_risco: id_cargo_risco
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        html += '<li>' + data[i].eor_nome + ' ==> ' + data[i].eor_description_risco + '</li>';
                    }
                    show_lista_exames_dados_por_consulta(id_cargo_risco);
                    $('#show_data').html(html);

                }
            });
        });

      

        // function seleciona_exames_ajax() {
        //     $.ajax({
        //         url: '<?= site_url('/riscosexames/lista_exames') ?>',
        //         method: 'GET',
        //         dataType: 'json',
        //         headers: {
        //             'X-Requested-With': 'XMLHttpRequest'
        //         },
        //         success: function(response) {
        //             $.each(response, function(index, data) {
        //                 $('#new_exames_select').append('<option value="' + data['id_ex'] + '">' + data['ex_tipo_exame'] + '</option>');
        //             });
        //         }
        //     });
        // }

        $('#select_cargos_p_aso').change(function(){
            var id_exames = $(this).val();
            $.ajax({
                url: '<?= site_url('/riscosexames/lista_exames') ?>',
                method: 'GET',
                dataType: 'json',
                data:{id_exames:id_exames}, 
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('#new_exames_select').find('option').not(':first').remove();
                    $.each(response, function(index, data) {
                        $('#new_exames_select').append('<option value="' + data['id_ex'] + '">' + data['ex_tipo_exame'] + '</option>');
                    });
                }
            });
        });

        /**adiciona exames e cargos 2 */
        $('#form_exames_cargos_2').on('submit', function(event) {
            event.preventDefault();
            let id_cargo = $("select[name='select_cargos_p_aso']").val();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_exam_riscos_two').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_exam_riscos_two').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_exam_riscos_two').html('<i class="fa fa-plus"></i> Adiciona');
                    $('.cls_add_exam_riscos_two').attr('disabled', false);


                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#select_cargos_p_aso_error').text(data.select_cargos_p_aso_error);
                        $('#new_exames_select_error').text(data.new_exames_select_error);
                        $('#select_cselect_funcao_cargo_all_error').text(data.select_cselect_funcao_cargo_all_error);
                        $('#primeiro_periodico_demiccional_error').text(data.primeiro_periodico_demiccional_error);
                        $('#segundo_peridico_demissional_error').text(data.segundo_peridico_demissional_error);

                    } else {
                        $('#select_cargos_p_aso_error').text('');
                        $('#new_exames_select_error').text('');
                        $('#select_cselect_funcao_cargo_all_error').text('');
                        $('#primeiro_periodico_demiccional_error').text('');
                        $('#segundo_peridico_demissional_error').text('');

                        $('#form_exames_cargos_2')[0].reset();
                        $('#message_emx_add_risco_two').html(data.message);
                        // $('#lista_tipo_risco_trabalho').DataTable().ajax.reload();
                        show_lista_exames_dados_por_consulta(id_cargo);
                        setTimeout(function() {
                            $('#message_emx_add_risco_two').html('');
                        }, 2500);
                    }
                }
            })
        });

        /**lista registro do aso */
        function show_lista_exames_dados_por_consulta(id) {

            $.ajax({
                type: 'GET',
                url: '<?php echo site_url('/aso/lista_exames_retorno_aso/') ?>' + id,
                async: true,
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(data) {
                    var html = '';
                    var i;
                    for (i = 0; i < data.length; i++) {

                        var checked1 = data[i].ef_tipos_ad == null ? "" : "checked";
                        var checked2 = data[i].ef_tipos_d == null ? "" : "checked";
                        var checked3 = data[i].ef_tipos_p == null ? "" : "checked";
                        var checked4 = data[i].ef_tipos_m == null ? "" : "checked";
                        var checked5 = data[i].ef_tipos_r == null ? "" : "checked";
                        var checked6 = data[i].ef_tipos_is == null ? "" : "checked";

                        html += '<tr>' +
                            '<td>' + data[i].ex_tipo_exame + '</td>' +
                            '<td>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="admissional" id="' + data[i].ef_id + '" ' + checked1 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">A</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="demissional" id="' + data[i].ef_id + '" ' + checked2 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">D</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="periodico" id="' + data[i].ef_id + '" ' + checked3 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">P</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="mudanca_funcao" id="' + data[i].ef_id + '" ' + checked4 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">M</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="retorno_trabalho" id="' + data[i].ef_id + '" ' + checked5 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">R</label>' +
                            '</div>' +
                            '<div class="custom-control custom-checkbox custom-control-inline">' +
                            '<input class="custom-control-input custom-control-input-danger custom-control-input-outline" type="checkbox" name="' + data[i].ef_id + '" id="' + data[i].ef_id + '" ' + checked6 + ' value="1">' +
                            '<label for="' + data[i].ef_id + '" class="custom-control-label">I/S</label>' +
                            '</div>' +


                            '</td>' +
                            '<td>' + data[i].ef_dias_1 + '</td>' +
                            '<td>' + data[i].ef_dias_2 + '</td>' +
                            '<td style="text-align:right;">' +
                            '<div class="btn-group dropleft">' +
                            '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            'Opções' +
                            '</button>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="view_risco_funcao dropdown-item" data-id="' + data[i].ef_id + '"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>' +
                            '<div class="dropdown-divider"></div>' +
                            '<a href="#" class="delete_view_risco_funcao dropdown-item" data-id="' + data[i].ef_id + '" data-cargo="' + data[i].ef_fk_funcao + '"><i class="fa fa-trash"></i>&nbsp;Deletar</a>' +
                            '</div>' +
                            '</div>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#show_data_exames_posr_funcao').html(html);
                }

            });
        }

        /**modal exames riscos */
        $(document).on('click', '.view_risco_funcao', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/riscosexames/get_dados_usuario_exames_riscos/'); ?>" + id,
                method: "GET",
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
                    $('#select_modal_cargoaso_cf').val(data.ef_fk_funcao);
                    $('#select_modal_cargoa_funcoes_so_cf').val(data.ef_fk_cargos_funcoes);
                    $('#select_modal_exames_cf').val(data.ef_ek_exame);

                    if (data.ef_tipos_ad != null) {
                        $('#checked1').prop('checked', true);
                    } else {
                        $('#checked1').prop('checked', false);
                    }

                    if (data.ef_tipos_d != null) {
                        $('#checked2').prop('checked', true);
                    } else {
                        $('#checked2').prop('checked', false);
                    }

                    if (data.ef_tipos_p != null) {
                        $('#checked3').prop('checked', true);
                    } else {
                        $('#checked3').prop('checked', false);
                    }

                    if (data.ef_tipos_m != null) {
                        $('#checked4').prop('checked', true);
                    } else {
                        $('#checked4').prop('checked', false);
                    }

                    if (data.ef_tipos_r != null) {
                        $('#checked5').prop('checked', true);
                    } else {
                        $('#checked5').prop('checked', false);
                    }

                    if (data.ef_tipos_is != null) {
                        $('#checked6').prop('checked', true);
                    } else {
                        $('#checked6').prop('checked', false);
                    }

                    // let tipo1 = data['ef_tipos_ad'] == !null ? prop('checked', true) : prop('checked', false);

                    $('#ef_dias_1').val(data.ef_dias_1);
                    $('#ef_dias_2').val(data.ef_dias_2);
                    $('#modalComponheExamesEaso').modal('show');
                    $('#hidden_id_altera_exame_aso_up').val(id);
                }
            })
        });

        lista_cargos_modal_aso();
        lista_cargos_funcoes_modal_aso();
        lista_exames_modal_aso();

        function lista_cargos_modal_aso() {
            $.ajax({
                url: '<?= site_url('/aso/lista_cargos_modal') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    // Remove options 
                    $('#select_modal_cargoaso_cf').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#select_modal_cargoaso_cf').append('<option value="' + data['id_cargo'] + '">' + data['cargo_nome'] + '</option>');
                    });
                }
            });
        }

        function lista_exames_modal_aso() {
            $.ajax({
                url: '<?= site_url('/aso/lista_exames_combo_modal') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    // Remove options 
                    $('#select_modal_exames_cf').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#select_modal_exames_cf').append('<option value="' + data['id_ex'] + '">' + data['ex_tipo_exame'] + '</option>');
                    });
                }
            });
        }
        /**lista dos os riscos dos cargos */
        function lista_cargos_funcoes_modal_aso() {

            $.ajax({
                url: '<?= site_url('/aso/lista_cargos_funcoes_modal') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('#select_modal_cargoa_funcoes_so_cf').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#select_modal_cargoa_funcoes_so_cf').append('<option value="' + data['id'] + '">' + data['cf_nome_cargo_funcao'] + '</option>');
                    });
                }
            });
        }


        /**altera dados exames e cargos 2 */
        $('#form_altera_dados_exame_riscos_aso').on('submit', function(event) {
            event.preventDefault();
            let id_cargo = $("select[name='select_modal_cargoaso_cf']").val();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_exam_riscos_two_up').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_exam_riscos_two_up').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_exam_riscos_two_up').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_add_exam_riscos_two_up').attr('disabled', false);


                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        $('#select_modal_cargoaso_cf_error').text(data.select_modal_cargoaso_cf_error);
                        $('#select_modal_cargoa_funcoes_so_cf_error').text(data.select_modal_cargoa_funcoes_so_cf_error);
                        $('#select_modal_exames_cf_error').text(data.select_modal_exames_cf_error);
                        $('#ef_dias_1_error').text(data.ef_dias_1_error);
                        $('#ef_dias_2_error').text(data.ef_dias_2_error);

                    } else {
                        $('#select_modal_cargoaso_cf_error').text('');
                        $('#select_modal_cargoa_funcoes_so_cf_error').text('');
                        $('#select_modal_exames_cf_error').text('');
                        $('#ef_dias_1_error').text('');
                        $('#ef_dias_2_error').text('');

                        $('#message_emx_add_risco_two_up').html(data.message);
                        // $('#lista_tipo_risco_trabalho').DataTable().ajax.reload();
                        show_lista_exames_dados_por_consulta(id_cargo);
                        setTimeout(function() {
                            $('#message_emx_add_risco_two_up').html('');
                        }, 2500);
                    }
                }
            })
        });


        /**delete configurações aso */
        $(document).on('click', '.delete_view_risco_funcao', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var id_cargo_load = $(this).data("cargo");

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/riscosexames/delete_exames_config_aso'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {

                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            show_lista_exames_dados_por_consulta(id_cargo_load);
                        }
                    })
                }
            });
        });


        /**chama modal exames aso */
        $(document).on('click', '.viewComponhemExamesAsoModal', function() {
            var user_id = $(this).attr("id");
            $('#modalComponheExamesEaso').modal('show');
        });


        function forceKeyPressUppercase(e) {
            var charInput = e.keyCode;
            if ((charInput >= 97) && (charInput <= 122)) { // lowercase
                if (!e.ctrlKey && !e.metaKey && !e.altKey) { // no modifier key
                    var newChar = charInput - 32;
                    var start = e.target.selectionStart;
                    var end = e.target.selectionEnd;
                    e.target.value = e.target.value.substring(0, start) + String.fromCharCode(newChar) + e.target.value.substring(end);
                    e.target.setSelectionRange(start + 1, start + 1);
                    e.preventDefault();
                }
            }
        }

        document.getElementById("exc_name").addEventListener("keypress", forceKeyPressUppercase, false);
        document.getElementById("exc_descricao").addEventListener("keypress", forceKeyPressUppercase, false);

        document.getElementById("risco_nome").addEventListener("keypress", forceKeyPressUppercase, false);
        document.getElementById("risco_descricao").addEventListener("keypress", forceKeyPressUppercase, false);

        document.getElementById("exam_name").addEventListener("keypress", forceKeyPressUppercase, false);
        document.getElementById("exam_desc").addEventListener("keypress", forceKeyPressUppercase, false);

        document.getElementById("final_exam_name").addEventListener("keypress", forceKeyPressUppercase, false);
        document.getElementById("final_exame_desc").addEventListener("keypress", forceKeyPressUppercase, false);

    });
</script>
<?= $this->endSection() ?>