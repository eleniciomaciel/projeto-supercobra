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
                                'Deleted!',
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
</script>