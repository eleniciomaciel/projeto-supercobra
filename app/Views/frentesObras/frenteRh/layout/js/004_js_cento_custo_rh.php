<script>
    $(document).ready(function() {
        $('#frente_cc_table').DataTable({
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
                url: "<?php echo site_url("/admin_rh/lista_cc_da_frente"); ?>",
                type: "GET",
            }
        });


        $('#form_add_rh_new_cc').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_add_cc').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_cc').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_cc').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_cc').attr('disabled', false);
                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#cc_name_error').text(data.cc_name_error);
                        $('#dep_cc_error').text(data.dep_cc_error);
                        $('#cc_dec_error').text(data.cc_dec_error);
                    } else {
                        $('#cc_name_error').text('');
                        $('#dep_cc_error').text('');
                        $('#cc_dec_error').text('');
                        $('#message_new_cc').html(data.message);
                        $('#frente_cc_table').DataTable().ajax.reload();
                        $('#form_add_rh_new_cc')[0].reset();
                        setTimeout(function() {
                            $('#message_new_cc').html('');
                        }, 3000);
                    }
                }
            })
        });

        $(document).on('click', '.visualizarRH_cc_admin_panel', function(event) {
            event.preventDefault();
            var id = $(this).data('id');

            $.ajax({
                url: "<?php echo site_url('/admin_rh/getListDados_cc'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: 'JSON',
                success: function(data) {

                    $('#new_numero_ccrh').val(data.numero_cc);
                    $('#new_descricao_ccrh').val(data.descricao_cc);
                    $('#new_departamento_ccrh').val(data.fk_departamento);
                    $('#modal_dados_cc_rh').modal('show');
                    $('#new_id_cc').val(id);
                }
            })
        });

        /**altera dados do cc */
        $('#form_altera_rh_new_cc').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                beforeSend: function() {
                    $('#id_new_uprh_cc').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_new_uprh_cc').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_new_uprh_cc').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_new_uprh_cc').attr('disabled', false);
                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você tem alguns erros.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        $('#new_numero_ccrh_error').text(data.new_numero_ccrh_error);
                        $('#new_departamento_ccrh_error').text(data.new_departamento_ccrh_error);
                        $('#new_descricao_ccrh_error').text(data.new_descricao_ccrh_error);
                    } else {
                        $('#new_numero_ccrh_error').text('');
                        $('#new_departamento_ccrh_error').text('');
                        $('#new_descricao_ccrh_error').text('');
                        $('#message_new_altera_rhcc').html(data.message);
                        $('#frente_cc_table').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_new_altera_rhcc').html('');
                        }, 3000);
                    }
                }
            })
        });

        $(document).on('click', '.statusRH_cc', function(event) {
            event.preventDefault();
            var id_st = $(this).data('id');
            var statu = $(this).data('statu');

            Swal.fire({
                title: 'Alterar Status?',
                text: "Confirmar alteração do estatus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor:  '#d33',
                confirmButtonText:  '<i class="fa fa-sync-alt"></i> Sim, alterar!',
                cancelButtonText:   '<i class="fa fa-eye-slash"></i> Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo site_url('/admin_rh/altera_status_do_cc'); ?>",
                        method: "GET",
                        data: {
                            id_st: id_st,
                            statu: statu,
                        },
                        success: function(data) {
                            Swal.fire(
                                'Alterado!',
                                data,
                                'success'
                            )
                            $('#frente_cc_table').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });

    });
</script>