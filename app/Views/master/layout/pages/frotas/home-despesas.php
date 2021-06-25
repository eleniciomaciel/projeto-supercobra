<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-md-12">
    <?php
    // Display Response
    if (session()->has('message_ok_fornecedor')) {
    ?>
        <div class="alert <?= session()->getFlashdata('alert-class') ?>">
            <?= session()->getFlashdata('message_ok_fornecedor') ?>
        </div>
    <?php
    }
    ?>

    <?= \Config\Services::validation()->listErrors() ?>
    <!-- corpo aplicação -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link" href="/frota/controle">Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-veiculo">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-oficina">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link active" href="#tab_3" data-toggle="tab">Despess/Manutenção</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-localizacao">Localização/Transferência</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_3">
                    <?= $this->include('master/layout/pages/frotas/includes/despesas-manutencao') ?>
                </div>

                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div><!-- /.card-body -->
    </div>
    <!-- /.fim do corpo da aplicação -->

</div>
<?= $this->endSection() ?>
<?= $this->section('admin-js') ?>

<script>
    $(document).ready(function() {

        $('#manut_frente').change(function() {
            var id_frente = $(this).val();
            // AJAX request
            $.ajax({
                url: '<?= base_url('Admin/FrotaController/getFrenteDepartamento') ?>',
                method: 'GET',
                data: {
                    id_frente: id_frente
                },
                dataType: 'json',
                success: function(response) {
                    // Remove options 
                    $('#sel_desp_veiculo_placa_select').find('option').not(':first').remove();
                    $('#sel_depart_frente').find('option').not(':first').remove();
                    $('#sel_desp_cc_carro_atividade_frente').find('option').not(':first').remove();
                    $('#sel_depart_frente').html('<option>Selecione o departamento...</option>');
                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_depart_frente').append('<option value="' + data['id'] + '">' + data['dep_name'] + '</option>');
                    });
                }
            });
        });


        // Department change
        $('#sel_depart_frente').change(function() {
            var id_department_frent = $(this).val();
            // alert(id_department_frent);
            // AJAX request
            $.ajax({
                url: '<?= base_url('Admin/FrotaController/getDepartamentoVeiculoPlaca') ?>',
                method: 'GET',
                data: {
                    id_department_frent: id_department_frent
                },
                dataType: 'json',
                success: function(response) {
                    // Remove options
                    $('#sel_desp_veiculo_placa_select').find('option').not(':first').remove();
                    $('#sel_desp_veiculo_placa_select').html('<option>Selecione o departamento...</option>');
                    $('#sel_desp_cc_carro_atividade_frente').find('option').not(':first').remove();
                    // Add options
                    $.each(response, function(index, data) {
                        $('#sel_desp_veiculo_placa_select').append('<option value="' + data['trf_id'] + '">' + data['vaic_placa'] + '</option>');
                    });
                }
            });
        });

        // select veiculo seleciona cc no departamento
        $('#sel_desp_veiculo_placa_select').change(function() {
            var id_veiculo_transferencia_local_cc = $(this).val();
            //alert(id_veiculo_transferencia_local_cc);
            // AJAX request
            $.ajax({
                url: '<?= base_url('Admin/FrotaController/getVeiculoCcLocalDaAtividade') ?>',
                method: 'GET',
                data: {
                    id_veiculo_transferencia_local_cc: id_veiculo_transferencia_local_cc
                },
                dataType: 'json',
                success: function(response) {
                    // Remove options
                    $('#sel_desp_cc_carro_atividade_frente').find('option').not(':first').remove();
                    $('#sel_desp_cc_carro_atividade_frente').html('<option>Selecione o departamento...</option>');
                    // Add passando o id da transferencia de onde o carro está na linha da tabela
                    $.each(response, function(index, data) {
                        $('#sel_desp_cc_carro_atividade_frente').append('<option value="' + data['trf_id'] + '">' + data['numero_cc'] + '</option>');
                    });
                }
            });
        });


    });
</script>
<?= $this->endSection() ?>