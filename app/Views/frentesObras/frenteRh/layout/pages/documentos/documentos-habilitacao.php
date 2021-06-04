<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_rh/cadastro-colaboradores" class="btn btn-info btn-flat">
        <i class="fas fa-reply-all"></i> Voltar
    </a>
    <br><br>
    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-id-card"></i> Habilitação
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-id-card"></i> Dados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-folder"></i> Documentos</a>
                    </li>
                </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart">
                    <div class="chartjs-size-monitor">

                        <?php $validation = \Config\Services::validation(); ?>


                        <div class="col-12">
                            <?php if (isset($validation)) : ?>
                                <div class="col-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?= $validation->listErrors() ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php
                            // Display Response
                            if (session()->has('message_file')) {
                            ?>
                                <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                                    <?= session()->getFlashdata('message_file') ?>
                                </div>
                            <?php
                            }

                            if (session()->has('message_dados_user_cnh')) {
                            ?>
                                <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                                    <?= session()->getFlashdata('message_dados_user_cnh') ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <br>
                        <form action="<?= site_url('Rh/Documentos/DocumentosController/atualizaCnh/') ?><?= esc($fun_dd['f_id']) ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="form-row">

                                <div class="col-md-6 mb-3">
                                    <label for="validationDefaultUsername">Colaborador</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-address-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="validationDefaultUsername" value="<?= esc($fun_dd['f_nome']) ?>" disabled>
                                    </div>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="cnh_numero">Nº da CNH</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="cnh_numero" placeholder="Ex.: 123456" value="<?= esc($fun_dd['f_cnh_numero']) ?>">
                                    </div>
                                </div>


                                <div class="col-md-3 mb-3">
                                    <label for="cnh_categoria">Categoria CNH</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="cnh_categoria"><i class="fas fa-truck-pickup"></i></span>
                                        </div>
                                        <select class="custom-select rounded-0" name="cnh_categoria">
                                            <option selected disabled>Selecione aqui...</option>
                                            <option value="A" <?php if ($fun_dd['f_cnh_categoria'] == 'A') {
                                                                    echo 'selected';
                                                                } ?>>A</option>
                                            <option value="AB" <?php if ($fun_dd['f_cnh_categoria'] == 'AB') {
                                                                    echo 'selected';
                                                                } ?>>AB</option>
                                            <option value="C" <?php if ($fun_dd['f_cnh_categoria'] == 'C') {
                                                                    echo 'selected';
                                                                } ?>>C</option>
                                            <option value="D" <?php if ($fun_dd['f_cnh_categoria'] == 'D') {
                                                                    echo 'selected';
                                                                } ?>>D</option>
                                            <option value="E" <?php if ($fun_dd['f_cnh_categoria'] == 'E') {
                                                                    echo 'selected';
                                                                } ?>>E</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-row">

                                <div class="col-md-6 mb-3">
                                    <label for="cnh_emissor">Emissor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <select class="custom-select rounded-0" name="cnh_emissor">
                                            <option selected disabled>Selecione aqui...</option>
                                            <option value="DETRAN" <?php if ($fun_dd['f_cnh_emissor'] == 'DETRAN') {
                                                                        echo 'selected';
                                                                    } ?>>DETRAN</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="validationDefaultUsername">UF Emissor</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <select class="custom-select rounded-0" name="cnh_uf">
                                            <option selected disabled>Selecione aqui...</option>
                                            <?php if (!empty($estados) && is_array($estados)) : ?>
                                                <?php foreach ($estados as $uf) : ?>
                                                    <option value="<?= esc($uf['id']) ?>" <?php if ($uf['id'] == $fun_dd['f_cnh_uf']) {
                                                                                                echo 'selected';
                                                                                            } ?>><?= esc($uf['nome']) ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <option selected disabled>Sem estados cadastrados</option>
                                            <?php endif ?>
                                        </select>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cnh_data_emissao">Data de Emissão</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" name="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="cnh_data_emissao" value="<?php echo $fun_dd['f_cnh_data_emissao'] != "" ? $fun_dd['f_cnh_data_emissao'] : old('cnh_data_vencimento'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cnh_data_vencimento">Data de vencimento</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="cnh_data_vencimento" value="<?php echo $fun_dd['f_cnh_data_vencimento'] != "" ? $fun_dd['f_cnh_data_vencimento'] : old('cnh_data_vencimento'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="cnh_data_primeira">Data da 1ª CNH</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-id-card-alt"></i></span>
                                        </div>
                                        <input type="date" class="form-control" name="cnh_data_primeira" value="<?php echo $fun_dd['f_cnh_data_primeira'] != "" ? $fun_dd['f_cnh_data_primeira'] : old('cnh_data_vencimento'); ?>">
                                    </div>
                                </div>

                            </div>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </form>
                    </div>
                </div>

                <div class="chart tab-pane" id="sales-chart">
                    <div class="chartjs-size-monitor">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-folder-open"></i> Adicionar documento da CNH</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/arquivos_cnh/upload_cnh/<?= esc($fun_dd['f_id']) ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="file_doc_cnh">Arquivar</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file_doc_cnh" id="file_doc_cnh">
                                                <label class="custom-file-label" for="file_doc_cnh">Escolher arquivo</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-file-invoice"></i>&nbsp;Arquivar</span>
                                            </div>

                                        </div>
                                    </div>
                                    <script>
                                        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                            var fileName = document.getElementById("file_doc_cnh").files[0].name;
                                            var nextSibling = e.target.nextElementSibling
                                            nextSibling.innerText = fileName
                                        })
                                    </script>
                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="id_user_cnh" value="<?= esc($fun_dd['f_id']) ?>">
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Arquivos da CNH</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table table-responsive">
                                    <table class="table table-sm" id="list_ajax_cnh_user" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Nome do Arquivo</th>
                                                <th>
                                                    <p class="text-right">Opções</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->
<script src="<?= base_url() ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
<script>
    var id_sessao = "<?php echo $fun_dd['f_id']; ?>";
    $(document).ready(function() {
        $('#list_ajax_cnh_user').DataTable({
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
                url: "<?php echo base_url("/arquivos_cnh/list_my_cnh"); ?>" + '/' + id_sessao,
                type: "GET",
            }
        });

        /**deleta documento cnh */
        $(document).on('click', '.deleteCNH', function() {

            let id_del_cnh = $(this).data('id');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao dar OK será deletado de forma permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/Rh/Documentos/DocumentosController/deleteOneCnh'); ?>",
                        method: "GET",
                        data: {
                            id_del_cnh: id_del_cnh
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                            $('#list_ajax_cnh_user').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>