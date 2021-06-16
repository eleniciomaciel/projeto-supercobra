<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-md-12 content">

    <!-- <a href="/admin_rh/cargos-rh" class="btn btn-warning btn-flat">
        <i class="fa fa-reply-all"></i> Voltar
    </a><br><br> -->

    <div class="">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-edit"></i>
                    <?= esc($title) ?>
                </h3>
            </div>
            <div class="card-body pad table-responsive">

                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#menu_A">Mão de Obra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#home">Composição</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1">Funções</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2">Cargos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu3">Departamentos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu4">Atividades</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div id="menu_A" class="container tab-pane active"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_mao_de_obra') ?>
                    </div>

                    <div id="home" class="container tab-pane"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_resultados') ?>
                    </div>
                    <div id="menu1" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_funcao') ?>
                    </div>

                    <div id="menu2" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_cargos') ?>
                    </div>

                    <div id="menu3" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_departamento') ?>
                    </div>
                    <div id="menu4" class="container tab-pane fade"><br>
                        <?= $this->include('frentesObras/frenteRh/layout/pages/cargos/includes/inc_atividades') ?>
                    </div>
                </div>

            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.col -->
    <?= $this->include('frentesObras/frenteRh/layout/components/008_popap_mao_obra') ?>
</section>
<?= $this->endSection() ?>
<?= $this->section('extra-js') ?>
<script>
    $(document).ready(function() {

        $('#lista_todas_mao_obra').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            "serverSide": true,
            "ajax": {
                url: "<?php echo site_url("/mao_obra/lista_mao_obras"); ?>",
                type: "GET",
            }
        });


        $('#form_add_mao_obra').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_mao_obra').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_mao_obra').attr('disabled', 'disabled');
                },

                success: function(data) {

                    $('#id_add_mao_obra').html('<i class="fas fa-sync-alt"></i> Alterar');
                    $('.cls_add_mao_obra').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#name_mao_obra_error').text(data.name_mao_obra_error);
                        $('#descricao_mao_obra_error').text(data.descricao_mao_obra_error);
                    } else {

                        $('#name_mao_obra_error').text('');
                        $('#descricao_mao_obra_error').text('');

                        $('#message_mao').html(data.message);
                        $('#form_add_mao_obra')[0].reset();
                        $('#lista_todas_mao_obra').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_mao').html('');
                        }, 2500);
                    }
                }
            });
        });


        /**lista dados mão de obra */
        $(document).on('click', '.viewMaoObra', function() {
            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/mao_obra/getMaoObraOne'); ?>",
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
                    $('#nome_tmo').val(data.nome_tmo);
                    $('#description_tmo').val(data.description_tmo);
                    $('#dadosMaoObraModal').modal('show');
                    $('#hidden_id_up_mao_obra').val(id);
                }
            })
        });


        /**altera dados mão de obra */
        $('#form_alterar_mao_obra').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_mao_obra').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_mao_obra').attr('disabled', 'disabled');
                },

                success: function(data) {

                    $('#id_up_mao_obra').html('<i class="fas fa-sync-alt"></i> Alterar');
                    $('.cls_up_mao_obra').attr('disabled', false);

                    if (data.error == 'yes') {
                        $('#nome_tmo_error').text(data.nome_tmo_error);
                        $('#description_tmo_error').text(data.description_tmo_error);
                    } else {

                        $('#nome_tmo_error').text('');
                        $('#description_tmo_error').text('');

                        $('#message_mao_up').html(data.message);
                        $('#lista_todas_mao_obra').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_mao_up').html('');
                        }, 2500);
                    }
                }
            });
        });


        /**delete banco */
        $(document).on('click', '.deleteMaoObra', function(event) {
            let id_del_mao_obra = $(this).data('id');
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
                        url: "<?php echo site_url('/mao_obra/deleta_mao_obra'); ?>" + '/' + id_del_mao_obra,
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                       
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            $('#lista_todas_mao_obra').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });

        function forceKeyPressUppercase2(e) {
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

        document.getElementById("descricao_mao_obra").addEventListener("keypress", forceKeyPressUppercase2, false);
        document.getElementById("name_mao_obra").addEventListener("keypress", forceKeyPressUppercase2, false);

    });
</script>
<?= $this->endSection() ?>