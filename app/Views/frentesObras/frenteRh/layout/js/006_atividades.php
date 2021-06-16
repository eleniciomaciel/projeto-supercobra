<script>
    $(document).ready(function() {
        $('#lista_todas_atividades').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/lista_atividades"); ?>",
                type: "GET",
            }
        });

        // $('#add_record').click(function() {
        //     $('#form_adicioana_atividade')[0].reset();
        //     $('.modal-title').text('Add Data');
        //     $('#name_error').text('');
        //     $('#email_error').text('');
        //     $('#gender_error').text('');
        //     $('#action').val('Add');
        //     $('#submit_button').val('Add');
        //     $('#userModal').modal('show');
        // });

        $('#form_adicioana_atividade').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_ativ').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_ativ').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#id_add_ativ').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_ativ').attr('disabled', false);

                    if (data.error == 'yes') {

                        $('#ativ_name_error').text(data.ativ_name_error);
                        $('#ativ_descricao_error').text(data.ativ_descricao_error);
                        $('#ativ_id_error').text(data.ativ_id_error);

                    } else {

                        $('#ativ_name_error').text('');
                        $('#ativ_descricao_error').text('');

                        $('#message_add_atividade').html(data.message);
                        $('#lista_todas_atividades').DataTable().ajax.reload();
                        $('#form_adicioana_atividade')[0].reset();

                        setTimeout(function() {
                            $('#message_add_atividade').html('');
                        }, 2000);
                    }
                }
            })
        });

        $(document).on('click', '.visualizarAtividade', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/admin_rh/dados_atividade'); ?>",
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
                    $('#titulo_nome').val(data.titulo_nome);
                    $('#titulo_description').val(data.titulo_description);

                    $('#atividadesModal').modal('show');
                    $('#hidden_id_atividade').val(id);
                }
            })
        });

        $('#form_altera_atividade').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_ativ').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_ativ').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#id_up_ativ').html('<i class="fas fa-sync-alt"></i> Alterar');
                    $('.cls_up_ativ').attr('disabled', false);

                    if (data.error == 'yes') {

                        $('#titulo_nome_error').text(data.titulo_nome_error);
                        $('#titulo_description_error').text(data.titulo_description_error);

                    } else {

                        $('#titulo_nome_error').text('');
                        $('#titulo_description_error').text('');

                        $('#message_up_atividade').html(data.message);
                        $('#lista_todas_atividades').DataTable().ajax.reload();

                        setTimeout(function() {
                            $('#message_up_atividade').html('');
                        }, 2000);
                    }
                }
            })
        });

        $(document).on('click', '.deleteAtividade', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Deletar?',
                text: "Deseja deletar essa atividade!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo site_url('/admin_rh/delete_atividade'); ?>",
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
                            $('#lista_todas_atividades').DataTable().ajax.reload();
                          
                        }
                    })
                }
            });
        });


    });
</script>
<script>
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

    document.getElementById("ativ_name").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("ativ_descricao").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("titulo_nome").addEventListener("keypress", forceKeyPressUppercase, false);
    document.getElementById("titulo_description").addEventListener("keypress", forceKeyPressUppercase, false);
</script>