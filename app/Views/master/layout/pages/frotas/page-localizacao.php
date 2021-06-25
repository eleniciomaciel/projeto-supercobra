<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <?php
    // Display Response
    if (session()->has('message_ok_transferencia')) {
    ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message_ok_transferencia') ?>
        </div>
    <?php
    }
    ?>
    <!-- corpo aplicação -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link" href="/frota/controle">Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-veiculo">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-oficina" data-toggle="tab">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-despesas">Despess/Manutenção</a></li>
                <li class="nav-item"><a class="nav-link active" href="/frota/page-localizacao">Localização/Transferência</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="tab_6">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Tranferência de Veículo
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <?php $validation = \Config\Services::validation(); ?>
                                    <form action="<?= base_url('/Admin/FrotaController/veiculoTransferencia') ?>" method="POST">
                                        <?= csrf_field() ?>

                                        <div class="form-group">
                                            <label for="loc_veiculo">Veículos:</label>
                                            <select name="loc_veiculo" id="loc_veiculo" class="loc_veiculo form-control <?= ($validation->hasError('loc_veiculo')) ? 'is-invalid' : ''; ?>">
                                                <option selected disabled>Selecione aqui...</option>
                                                <?php if (!empty($list_veiculos) && is_array($list_veiculos)) : ?>
                                                    <?php foreach ($list_veiculos as $news_fornecedor) : ?>
                                                        <option value="<?= esc($news_fornecedor['vaic_id']) ?>"><?= esc($news_fornecedor['vaic_nome']) ?></option>
                                                    <?php endforeach; ?>

                                                <?php else : ?>
                                                    <option selected disabled>Não há fornecedor cadastrado.</option>
                                                <?php endif ?>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('loc_veiculo')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('loc_veiculo'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>


                                        <div class="form-group">
                                            <label for="loc_cc">CC da Atividade:</label>
                                            <select class="loc_cc form-control <?= ($validation->hasError('loc_cc')) ? 'is-invalid' : ''; ?>" name="loc_cc" id="loc_cc">
                                                <option selected disabled>Selecione aqui...</option>
                                                <?php if (!empty($list_cc) && is_array($list_cc)) : ?>
                                                    <?php foreach ($list_cc as $news_item) : ?>
                                                        <option value="<?= esc($news_item['id_cc']) ?>"><?= esc($news_item['numero_cc']) ?></option>
                                                    <?php endforeach; ?>

                                                <?php else : ?>
                                                    <option selected disabled>Não há cc cadastradas</option>
                                                <?php endif ?>
                                            </select>
                                            <!-- Error -->
                                            <?php if ($validation->getError('loc_cc')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('loc_cc'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="loc_frentes">Frentes:</label>
                                            <input type="text" name="loc_frentes" id="loc_frentes" class="form-control <?= ($validation->hasError('loc_frentes')) ? 'is-invalid' : ''; ?>" value="<?= old('loc_frentes') ?>">


                                            <!-- Error -->
                                            <?php if ($validation->getError('loc_frentes')) { ?>
                                                <div class='text-danger mt-2'>
                                                    <?= $error = $validation->getError('loc_frentes'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="loc_department">Deparatamentos:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('loc_department')) ? 'is-invalid' : ''; ?>" name="loc_department" id="loc_department" value="<?= old('loc_department') ?>">

                                                <!-- Error -->
                                                <?php if ($validation->getError('loc_department')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('loc_department'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="loc_atividades">Atividades:</label>
                                                <input type="text" class="form-control <?= ($validation->hasError('loc_atividades')) ? 'is-invalid' : ''; ?>" name="loc_atividades" id="loc_atividades" value="<?= old('loc_atividades') ?>">
                                                <!-- Error -->
                                                <?php if ($validation->getError('loc_atividades')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('loc_atividades'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="trans_observe">Observações:</label>
                                                <textarea class="form-control <?= ($validation->hasError('loc_cc')) ? 'is-invalid' : ''; ?>" name="trans_observe" id="trans_observe" rows="3"><?= old('trans_observe') ?></textarea>
                                                <?php if ($validation->getError('trans_observe')) { ?>
                                                    <div class='text-danger mt-2'>
                                                        <?= $error = $validation->getError('trans_observe'); ?>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                        </div>

                                        <input type="hidden" name="hidden_id_dep" id="hidden_id_dep">
                                        <input type="hidden" name="hidden_id_act" id="hidden_id_act">
                                        <input type="hidden" name="hidden_id_frente" id="hidden_id_frente">

                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                                    </form>


                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->

                        <div class="col-md-7">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-bullhorn"></i>
                                        Callouts
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table table-responsive">
                                        <table class="table table-striped" id="lista_table_localizacao_veiculos" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>VEÍCULO</th>
                                                    <th>FRENTE</th>
                                                    <th>CC</th>
                                                    <th>MARCA</th>
                                                    <th>MODELO</th>
                                                    <th>PLACA</th>
                                                    <th>CHASSI</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!empty($list_transferencia_veiculo) && is_array($list_transferencia_veiculo)) : ?>

                                                    <?php foreach ($list_transferencia_veiculo as $list_transf_veiculos) : ?>
                                                        <tr>
                                                            <td><?= esc($list_transf_veiculos['vaic_nome']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['nome_ft']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['numero_cc']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['vaic_marca']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['vaic_modelo']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['vaic_placa']) ?></td>
                                                            <td><?= esc($list_transf_veiculos['vaic_chassi']) ?></td>
                                                            <td>
                                                                <div class="btn-group dropleft">
                                                                    <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Opções
                                                                    </button>

                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="/oficina/visualizar/<?= esc($list_transf_veiculos['trf_id'], 'url') ?>"><i class="fa fa-eye"></i> Visualizar</a>
                                                                        <div class="dropdown-divider"></div>
                                                                        <a class="dropdown-item" href="/oficina/deletar/<?= esc($list_transf_veiculos['trf_id'], 'url') ?>"><i class="fa fa-trash"></i> Deletar</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                <?php else : ?>

                                                    <tr>
                                                        <td colspan="4" class="text-center">Não há registro no momento</td>
                                                    </tr>

                                                <?php endif ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.fim do corpo da aplicação -->

</div>
<?= $this->endSection() ?>
<?= $this->section('adm-frota-js') ?>

<script>
    $(document).ready(function() {

        $('#lista_table_localizacao_veiculos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print','colvis'
            ]
        }).buttons().container().appendTo('#lista_table_localizacao_veiculos_wrapper .col-md-6:eq(0)');


        // City change
        $('#loc_cc').change(function() {
            var id_cc = $(this).val();

            $.ajax({
                url: '<?= base_url('Admin/FrotaController/getFrente') ?>',
                method: 'get',
                data: {
                    id_cc: id_cc
                },
                dataType: 'json',
                beforeSend: function() {
                    $("#loc_frentes").val("carregando...");
                    $("#loc_department").val("carregando...");
                    $("#loc_atividades").val("carregando...");
                },
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {

                    $("#loc_frentes").val("");
                    $("#loc_department").val("");
                    $("#loc_atividades").val("");

                    $.each(response, function(index, data) {
                        $('input[name="loc_frentes"]').val(data.nome_ft);
                        $('input[name="loc_department"]').val(data.dep_name);
                        $('input[name="loc_atividades"]').val(data.titulo_nome);

                        $('input[name="hidden_id_dep"]').val(data.fk_departamento);
                        $('input[name="hidden_id_act"]').val(data.fk_atividade_cc);
                        $('input[name="hidden_id_frente"]').val(data.fk_frente_cc);
                    });
                }
            });
        });
        // Department change
    });
</script>
<?= $this->endSection() ?>