<script>
    $(document).ready(function() {
        $('#lista_todos_departamentos').DataTable({
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
                url: "<?php echo site_url("/admin_rh/lista_departamentos"); ?>",
                type: "GET",
            }
        });

        $('#formAddNovosDepartamentos').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url:  $(this).attr('action'),
                type:  $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_dep_add').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_dep_add').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_dep_add').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_dep_add').attr('disabled', false);
                    if (data.error == 'yes') {
                        $('#dep_new_nome_departamento_error').text(data.dep_new_nome_departamento_error);
                        $('#dep_new_descricao_departamento_error').text(data.dep_new_descricao_departamento_error);
                    } else {
                        $('#formAddNovosDepartamentos')[0].reset();
                        $('#dep_new_nome_departamento_error').text('');
                        $('#dep_new_descricao_departamento_error').text('');

                        $('#message_dep').html(data.message);

                        $('#lista_todos_departamentos').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_dep').html('');
                        }, 2000);
                    }
                }
            })
        });

        /**lista dados do deprtamento */
         /** *********************************** carrega ******************************/
         $(document).on('click', '.visualizarDepartamento', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/admin_rh/get_departamento_dados'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#dep_nme').val(data.dep_name);
                    $('#dp_descricao').val(data.dep_description);
                    $('#modalVerDepartamento').modal('show');
                    $('#hidden_id_dep').val(id);
                }
            })
        });

        /**altera dados do pertamento */
        $('#form_altera_departamento').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url:  $(this).attr('action'),
                type:  $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_dep_up').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_dep_up').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_dep_up').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_dep_up').attr('disabled', false);
                    if (data.error == 'yes') {
                        $('#dep_nme_error').text(data.dep_nme_error);
                        $('#dp_descricao_error').text(data.dp_descricao_error);
                    } else {
                        $('#formAddNovosDepartamentos')[0].reset();
                        $('#dep_nme_error').text('');
                        $('#dp_descricao_error').text('');

                        $('#message_dep_up').html(data.message);

                        $('#lista_todos_departamentos').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_dep_up').html('');
                        }, 2000);
                    }
                }
            })
        });

        /**deleta departamento */
        $(document).on('click', '.deleteDepartamento', function(event) {
            event.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deletar departamento?',
                text: "Confirmar a deleção do departamento!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Deletar!',
                cancelButtonText: 'Cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/admin_rh/deleta_depatamento'); ?>",
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
                            $('#lista_todos_departamentos').DataTable().ajax.reload();
                        }
                    })
                }
            });
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

    document.getElementById("dep_new_nome_departamento").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("dep_new_descricao_departamento").addEventListener("keypress", forceKeyPressUppercase, false);

</script>