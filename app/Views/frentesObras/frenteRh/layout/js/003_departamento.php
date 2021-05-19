<script>
    $(document).ready(function() {
        $('#lista_todos_departamentos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/admin_rh/lista_departamentos"); ?>",
                type: "GET",
            }
        });

        /**cadastrar departamento */
        $('#add_record').click(function() {

            $('#user_form')[0].reset();

            $('.modal-title').text('Add Data');

            $('#name_error').text('');

            $('#email_error').text('');

            $('#gender_error').text('');

            $('#action').val('Add');

            $('#submit_button').val('Add');

            $('#userModal').modal('show');

        });

        $('#user_form').on('submit', function(event) {

            event.preventDefault();

            $.ajax({

                url: "<?php echo base_url('/ajax_crud/action'); ?>",

                method: "POST",

                data: $(this).serialize(),

                dataType: "JSON",

                beforeSend: function() {

                    $('#submit_button').val('wait...');

                    $('#submit_button').attr('disabled', 'disabled');

                },

                success: function(data) {

                    $('#submit_button').val('Add');

                    $('#submit_button').attr('disabled', false);

                    if (data.error == 'yes') {

                        $('#name_error').text(data.name_error);

                        $('#email_error').text(data.email_error);

                        $('#gender_error').text(data.gender_error);

                    } else {

                        $('#userModal').modal('hide');

                        $('#message').html(data.message);

                        $('#sample_table').DataTable().ajax.reload();

                        setTimeout(function() {

                            $('#message').html('');

                        }, 5000);

                    }

                }

            })

        });

    });
</script>