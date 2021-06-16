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

                    <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-file-medical-alt"></i> Tipos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-notes-medical"></i> Exam.: Riscos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#comb-cont" data-toggle="tab"><i class="fas fa-user-md"></i> Exames</a>
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

            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->


    <!-- Modal -->



</section>
<?= $this->include('frentesObras/frenteRh/layout/components/005_popap_config_exames', $carg) ?>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {
        SelecionaExamesContratos();
        SelecionaExamesRiscos();
        SelecionaExamesComboUp();
        SelecionaRiscosDaFuncao();

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

                        $('#exm_contrato_error').text(data.exm_contrato_error);
                        $('#todas_funcao_para_risco_error').text(data.todas_funcao_para_risco_error);
                        $('#select_carg_func_risco_error').text(data.select_carg_func_risco_error);
                        $('#final_exam_name_error').text(data.final_exam_name_error);
                        $('#exames_mes_valor_error').text(data.exames_mes_valor_error);
                        $('#final_exame_desc_error').text(data.final_exame_desc_error);

                    } else {
                        $('#exm_contrato_error').text('');
                        $('#todas_funcao_para_risco_error').text('');
                        $('#select_carg_func_risco_error').text('');
                        $('#final_exam_name_error').text('');
                        $('#exames_mes_valor_error').text('');
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

                        $('#exm_contrato_combo_up_error').text(data.exm_contrato_combo_up_error);
                        $('#ex_fk_funcao_error').text(data.ex_fk_funcao_error);
                        $('#exm_riscos_funcao_ajax_error').text(data.exm_riscos_funcao_ajax_error);
                        $('#ex_tipo_exame_error').text(data.ex_tipo_exame_error);
                        $('#ex_validade_meses_error').text(data.ex_validade_meses_error);
                        $('#ex_description').text(data.ex_description);

                    } else {
                        $('#exm_contrato_combo_up_error').text('');
                        $('#ex_fk_funcao_error').text('');
                        $('#exm_riscos_funcao_ajax_error').text('');
                        $('#ex_tipo_exame_error').text('');
                        $('#ex_validade_meses_error').text('');
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