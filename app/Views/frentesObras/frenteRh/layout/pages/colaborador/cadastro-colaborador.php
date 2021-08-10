<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_rh/cadastrar-dados" class="btn btn-success btn-flat">
        <i class="fa fa-plus"></i> Cadastrar
    </a>
    <br><br>

    <?php
    $session = \Config\Services::session();
    if ($session->getFlashdata('success_active_colaborador')) {
        echo '
        <div id="message_hide_transferencia">
            <div class="alert alert-success">' . $session->getFlashdata("success_active_colaborador") . '</div>
        </div>
        ';
    }
    ?>
    <br>

    <div class="card card-primary card-outline card-tabs">
        <div class="card-header p-0 pt-1 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Colaboradores Ativos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Em Status de Revisão</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-three-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                    <div class="card-body p-0">
                        <div class="table table-responsive col-12">
                            <table class="table table-sm" id="lista_funcioanrios_frente" style="width: 100%;">
                                <br>
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>E-mail</th>
                                        <th>Código</th>
                                        <th>Matrícula</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                    <div class="card-body p-0">
                        <div class="table table-responsive col-12">
                            <table class="table table-sm" id="lista_funcioanrios_frente_nao_afivos" style="width: 100%;">
                                <br>
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Nome</th>
                                        <th>Telefone</th>
                                        <th>E-mail</th>
                                        <th>Código</th>
                                        <th>Matrícula</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

    <!-- /.card -->
</section>

<?= $this->endSection() ?>
<?= $this->section('script_toast') ?>
<script>
    $(document).ready(function() {
        $('#lista_funcioanrios_frente_nao_afivos').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            // columnDefs: [{
            //     targets: 0,
            //     render: function(data) {
            //         return moment(data).format('L');
            //     }
            // }],
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("Rh/CadastrocolaboradorController/listFuncionariosNaoAtivos"); ?>",
                type: "GET",
            }
        });
        setTimeout(function() {
            $('#message_hide_transferencia').hide('');
        }, 3000);
        // function load_toast_habilitacao_vencida() {
        //     $.ajax({
        //         url: "<?php echo site_url('/banco/get_toast_habilitacao_vencida'); ?>",
        //         method: "GET",
        //         headers: {
        //             'X-Requested-With': 'XMLHttpRequest'
        //         },
        //         dataType: 'JSON',

        //         success: function(response) {

        //             $.each(response, function(index, data) {
        //                 $(document).Toasts('create', {
        //                     class: 'bg-warning',
        //                     title: 'Aviso:',
        //                     subtitle: 'Habilitação vencida',
        //                     body: 'Habilitação do(a) mototista <a href="/banco/visualiza_minha_cnh/' + data['f_id'] + '">'+ data['f_nome']+'<a/> Vencida.'
        //                 })
        //             });
        //         }
        //     })
        // }
    });
</script>
<?= $this->endSection() ?>