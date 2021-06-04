<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= esc($title) ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->

        <br>
        <div class="col-12">
        <a href="/admin_rh/cadastro-colaboradores" class="btn btn-outline-primary btn-flat">
        <i class="fas fa-reply-all"></i>&nbsp;Voltar
        </a>
        <br><br>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cadastrar Documentos</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <form enctype="multipart/form-data" id="form_add_documento">
                            <?= csrf_field() ?>
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <label for="inputName">Colaborador</label>
                                    <input type="text" class="form-control" value="<?= esc($fun_dd['f_nome']) ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="desc_doc">Descrição do Documento</label>
                                    <textarea name="desc_doc" id="desc_doc" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profileImage" id="profileImage" required>
                                        <label class="custom-file-label" for="profileImage" data-browse="Upload">Selecione seu arquivo</label>
                                    </div>
                                </div>

                                <script>
                                    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                        var fileName = document.getElementById("profileImage").files[0].name;
                                        var nextSibling = e.target.nextElementSibling
                                        nextSibling.innerText = fileName
                                    })
                                </script>
                                <input type="hidden" name="col_dod_name" value="<?= esc($fun_dd['f_id']) ?>">
                                <input type="hidden" name="col_dod_obra" value="<?= session()->get('log_obra') ?>">
                                <input type="hidden" name="col_dod_frente" value="<?= session()->get('log_frente') ?>">

                                <button type="submit" class="cls_add_fl btn btn-primary" id="id_add_fl">
                                    <i class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                        </form>

                        <br>
                        <div class="col-12">
                            <div id="alertMessage" class="alert alert-warning mb-3" style="display: none">
                                <span id="alertMsg"></span>
                            </div>
                        </div>


                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Documentos cadastrados</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body" style="display: block;">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Lista dos documentos</h3>
                                </div>
                                <!-- /.card-header -->

                                <table class="table table-striped" id="lista_documentos_func" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Descrição</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <!-- /.card-body -->
                            </div>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->
<script src="<?= base_url() ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        var id_funcioanario = <?= esc($fun_dd['f_id']) ?>;
       

        $('#lista_documentos_func').DataTable({
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
                url: "<?php echo base_url("/Rh/Documentos/DocumentosController/listaDocUser"); ?>" +'/'+id_funcioanario,
                type: "GET",
            }
        });

        $('#form_add_documento').on('submit', function(e) {
            
            let id_user_doc = $("input[name='col_dod_name']").val();

            e.preventDefault();
            if ($('#profileImage').val() == '') {
                alert("Escolha um arquivo.");
                $('#id_add_fl').html('<i class="fa fa-save"></i> Salvar');
                $('.cls_add_fl').attr('disabled', false);
                document.getElementById("form_add_documento").reset();
            } else {
                $.ajax({
                    url: "<?= base_url('Rh/Documentos/DocumentosController/uploadDocumentoColaborador') ?>" + '/' + id_user_doc,
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#id_add_fl').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                        $('.cls_add_fl').attr('disabled', 'disabled');
                    },
                    success: function(res) {
                        console.log(res.success);
                        if (res.success == true) {
                            $('#ajaxImgUpload').attr('src', 'https://via.placeholder.com/300');
                            $('#alertMsg').html(res.msg);
                            $('#alertMessage').show();
                            $('#lista_documentos_func').DataTable().ajax.reload();
                        } else if (res.success == false) {
                            $('#alertMsg').html(res.msg);
                            $('#alertMessage').show();
                        }
                        setTimeout(function() {
                            $('#alertMsg').html('');
                            $('#alertMessage').hide();
                        }, 4000);

                        $('#id_add_fl').html('<i class="fa fa-save"></i> Salvar');
                        $('.cls_add_fl').attr('disabled', false);
                        document.getElementById("form_add_documento").reset();
                    }
                });
            }
        });

        /**delete documento */
        $(document).on('click', '.del_doc', function(e) {
            e.preventDefault();
            var id = $(this).data('id');

            Swal.fire({
                title: 'Deletar arquivo?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fas fa-trash"></i> Sim, deletar!',
                cancelButtonText: '<i class="fas fa-ban"></i> Não',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/admin_rh/delete_file_doc'); ?>",
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
                            $('#lista_documentos_func').DataTable().ajax.reload();
                        }
                    })
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>