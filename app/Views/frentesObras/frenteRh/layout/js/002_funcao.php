<script>
    $(document).ready(function() {
        $('#lista_funcoes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/lista_funcoes_cadastradas"); ?>",
                type: "GET",
            }
        });

        $('#lista_funcoes_e_cargos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/lista_cargos_e_funcoes"); ?>",
                type: "GET",
            }
        });

        /**lista todos cargos e funções */
        $('#lista_funcoes_e_cargos_geral').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            columnDefs:[{
                targets: 0,
                render: function(data){
                    return moment(data).format('L');
                }
            }],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/todoCargosFuncRh"); ?>",
                type: "GET",
            }
        });

        $('#lista_funcoes_e_cargos_funcionarios').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            columnDefs:[{
                targets: 0,
                render: function(data){
                    return moment(data).format('L');
                }
            }],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/lista_tabela_funcionarios_cargos"); ?>",
                type: "GET",
            }
        });

        $('#for_add_funco_cargo').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo site_url('/admin_rh/cadastra_funcao'); ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_func_add').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_func_add').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_func_add').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_func_add').attr('disabled', false);
                    if (data.error == 'yes') {
                        $('#fun_funcao_error').text(data.fun_funcao_error);
                        $('#fun_descricao_error').text(data.fun_descricao_error);
                    } else {
                        $('#for_add_funco_cargo')[0].reset();
                        $('#fun_funcao_error').text('');
                        $('#fun_descricao_error').text('');

                        $('#message').html(data.message);
                        $('#lista_funcoes').DataTable().ajax.reload();
                        todasFuncoesSelect();
                        setTimeout(function() {
                            $('#message').html('');
                        }, 5000);
                    }
                }
            })
        });

        /**visualiza dados da função */
        $('#formAlteraFuncao').on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_func_add_up').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_func_add_up').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_func_add_up').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_func_add_up').attr('disabled', false);
                    if (data.error == 'yes') {
                        $('#fun_funcao_up_error').text(data.fun_funcao_up_error);
                        $('#fun_descricao_up_error').text(data.fun_descricao_up_error);
                    } else {
                        $('#fun_funcao_up_error').text('');
                        $('#fun_descricao_up_error').text('');

                        $('#message_up').html(data.message);
                        $('#lista_funcoes').DataTable().ajax.reload();
                        todasFuncoesSelect();
                        setTimeout(function() {
                            $('#message_up').html('');
                        }, 5000);
                    }
                }
            })
        });

        $(document).on('click', '.visualizarFuncao', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/admin_rh/verDadosFuncao'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#fun_funcao_up').val(data.cargo_nome);
                    $('#fun_descricao_up').val(data.cargo_description);
                    $('#fun_funcao_error').text('');
                    $('#fun_descricao').text('');
                    $('#modalFuncao').modal('show');
                    $('#hidden_id').val(id);
                }
            })
        });

        $(document).on('click', '.deleteFuncao', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deletar Categoria?',
                text: "Confirmar o delete da função no sistema!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/admin_rh/deleta_funcao'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            )
                            $('#lista_funcoes').DataTable().ajax.reload();
                            todasFuncoesSelect();
                        }
                    })
                }
            });
        });
        todasFuncoesSelect();

        function todasFuncoesSelect() {
            $.ajax({
                url: '<?= site_url('/admin_rh/lista-funcoes_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="func_select"]').empty();
                    $('select[name="func_select"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#func_select').append('<option value="' + data['id_cargo'] + '">' + data['cargo_nome'] + '</option>');
                    });
                }
            });
        }

        todasCargoSelect();

        function todasCargoSelect() {
            $.ajax({
                url: '<?= site_url('/admin_rh/lista-funcoes_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="cargos_select"]').empty();
                    $.each(response, function(index, data) {
                        $('#cargos_select').append('<option value="' + data['id_cargo'] + '">' + data['cargo_nome'] + '</option>');
                    });
                }
            });
        }

        /**Cargo com função */
        SelecionaCargoComFuncao();
        function SelecionaCargoComFuncao() {
            $.ajax({
                url: '<?= site_url('/admin_rh/lista-funcoes_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="func_select"]').empty();
                    $('select[name="func_select"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#func_select').append('<option value="' + data['id_cargo'] + '">' + data['cargo_nome'] + '</option>');
                    });
                }
            });
        }

        /**salvando os cagos com funções */
        $('#formAddCargoWithFunction').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_func_cargo_add').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_func_cargo_add').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_func_cargo_add').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_func_cargo_add').attr('disabled', false);
                    if (data.error == 'yes') {

                        $('#func_select_error').text(data.func_select_error);
                        $('#cargo_new_nome_error').text(data.cargo_new_nome_error);
                        $('#cargo_new_descricao_error').text(data.cargo_new_descricao_error);

                    } else {

                        $('#func_select_error').text('');
                        $('#cargo_new_nome_error').text('');
                        $('#cargo_new_descricao_error').text('');

                        $('#message_cargo').html(data.message);
                        $('#lista_funcoes_e_cargos').DataTable().ajax.reload();
                        $('#lista_funcoes_e_cargos_geral').DataTable().ajax.reload();
                        $('#formAddCargoWithFunction')[0].reset();
                        setTimeout(function() {
                            $('#message_cargo').html('');
                        }, 3000);
                    }
                }
            })
        });

        /** *********************************** carrega ******************************/
        $(document).on('click', '.visualizarCargosAjax', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/admin_rh/lista_um_cargos'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#cargos_select').val(data.cf_fk_funcao);
                    $('#fc_cargo_up').val(data.cf_nome_cargo_funcao);
                    $('#fc_descricao_up').val(data.cf_description_cargo_funcao);
                    $('#modalCargoComFuncao').modal('show');
                    $('#hidden_id_cargo').val(id);
                }
            })
        });


        /**altera cargo */
        $('#formAlteraCargo').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_cargo_func').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_cargo_func').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_up_cargo_func').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_up_cargo_func').attr('disabled', false);
                    if (data.error == 'yes') {

                        $('#cargos_select_error').text(data.cargos_select_error);
                        $('#fc_cargo_up_error').text(data.fc_cargo_up_error);
                        $('#fc_descricao_up_error').text(data.fc_descricao_up_error);

                    } else {

                        $('#message_cargo_up').html(data.message);
                        $('#lista_funcoes_e_cargos').DataTable().ajax.reload();
                        $('#lista_funcoes_e_cargos_geral').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_cargo_up').html('');
                        }, 3000);
                    }
                }
            })
        });


        /**deleta cargo */
        $(document).on('click', '.deleteCargosAjax', function(event) {
            event.preventDefault();
            let id_dl = $(this).data('id');

            Swal.fire({
                title: 'Deletar?',
                text: "Ao confirmar essa ação será permanaente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/admin_rh/deleteCursoRh'); ?>",
                        method: "GET",
                        data: {
                            id_dl: id_dl
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deletado!',
                                data,
                                'success'
                            );
                            $('#lista_funcoes_e_cargos').DataTable().ajax.reload();
                            $('#lista_funcoes_e_cargos_geral').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });

        /**salva todos os cargos com funcionarios e funções ================================== */
        $('#form_add_cargo_funcao_funcionario').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_funcionario_cargo_add').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_funcionario_cargo_add').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_funcionario_cargo_add').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_funcionario_cargo_add').attr('disabled', false);
                    if (data.error == 'yes') {

                        $('#rh_cadastro_error').text(data.rh_cadastro_error);
                        $('#funcionario_select_error').text(data.funcionario_select_error);
                        $('#select_cargo_e_funcoes_error').text(data.select_cargo_e_funcoes_error);
                        $('#select_departamentos_all_error').text(data.select_departamentos_all_error);
                        $('#select_atividades_all_error').text(data.select_atividades_all_error);
                        $('#compositor_description_error').text(data.compositor_description_error);

                    } else {

                        $('#rh_cadastro_error').text('');
                        $('#funcionario_select_error').text('');
                        $('#select_cargo_e_funcoes_error').text('');
                        $('#select_departamentos_all_error').text('');
                        $('#select_atividades_all_error').text('');
                        $('#compositor_description_error').text('');

                        $('#message_cargo_funcionario').html(data.message);
                        $('#lista_funcoes_e_cargos_funcionarios').DataTable().ajax.reload();
                        $('#form_add_cargo_funcao_funcionario')[0].reset();
                        setTimeout(function() {
                            $('#message_cargo_funcionario').html('');
                        }, 3000);
                    }
                }
            })
        });

    });
</script>

<script type="text/javascript">
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

    document.getElementById("fun_funcao").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("fun_descricao").addEventListener("keypress", forceKeyPressUppercase, false);

    //alterar dados
    function forceKeyPressUppercase_alterar(e) {
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

    document.getElementById("fun_funcao_up").addEventListener("keypress", forceKeyPressUppercase_alterar, false);
    document.getElementById("fun_descricao_up").addEventListener("keypress", forceKeyPressUppercase_alterar, false);
    /**cargos das funcoes */
    document.getElementById("cargo_new_nome").addEventListener("keypress", forceKeyPressUppercase_alterar, false);
    document.getElementById("cargo_new_descricao").addEventListener("keypress", forceKeyPressUppercase_alterar, false);
</script>