<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transporte-fornecedor/fornecedor" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_update_error_cadastro')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Vixe!</h5>
                    <?php echo session()->getFlashdata('fornecedor_update_error_cadastro') ?>
                </div>
            </div>

        <?php
        }

        if (session()->getFlashdata('delete_file')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> OK!</h5>
                    <?php echo session()->getFlashdata('delete_file') ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('success_uploaded_doc_fornecedor')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('success_uploaded_doc_fornecedor') ?>
                </div>
            </div>

        <?php
        }
        ?>
        <br>

        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Cobra Brasil, Inc.
                        <small class="float-right">Data da consulta: 04/08/2021</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                    Dados do fornecedor
                    <address>
                        Cliente: <strong><?= esc($dd_fornecedor['for_responsavel']) ?></strong><br>
                        Telefone: <?= esc($dd_fornecedor['for_telefone']) ?><br>
                        Email: <?= esc($dd_fornecedor['for_email']) ?><br>
                        CPF: <?= esc($dd_fornecedor['for_cnpj']) ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col">
                    Dados de localizalçao
                    <address>
                        Cep: <?= esc($dd_fornecedor['for_cep']) ?><br>
                        UF.: <?= esc($dd_fornecedor['for_uf']) ?><br>
                        Cidade: <?= esc($dd_fornecedor['for_cidade']) ?><br>
                        Bairro: <?= esc($dd_fornecedor['for_bairro']) ?>
                    </address>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr>


            <!-- accepted payments column -->
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="pt-2 px-3">
                            <h3 class="card-title">Contratos(s) com o fornecedor</h3>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Contratos(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Cadastrar Contratos</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Cadastrar documentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill" href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings" aria-selected="false">Contratos</a>
                        </li> -->
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                            <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/contratos-lista') ?>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                            <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/contrato-cadastro', $list_empresa) ?>
                        </div>

                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <!-- /.row -->
        </div>

</section>

<?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/modal-componet_empresa') ?>
<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {

        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

    });
</script>

<script>
    $(document).ready(function() {

        var id_fornecedor = "<?= esc($dd_fornecedor['for_id']) ?>";

        $('#list_empresas_fornacedores').DataTable({
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
                url: "<?php echo base_url("Transporte/FornecedorController/listaEmpresaFornecedorAjax"); ?>",
                type: "GET",
                data: {
                    id_fornecedor: id_fornecedor
                },
            }
        });

        /**
         * seleciona os dados do fornecedor via select
         */
        getSlectAjaxEmpresas(id_fornecedor);

        function getSlectAjaxEmpresas(id_fornecedor) {

            if (id_fornecedor != '') {
                $.ajax({
                    url: "<?php echo base_url('Transporte/FornecedorController/getEMpresasSelectFornecedor'); ?>" + '/' + id_fornecedor,
                    method: "GET",
                    data: {
                        id_fornecedor: id_fornecedor
                    },
                    dataType: "JSON",
                    success: function(data) {
                        if (data == '') {
                            $('#select_empresas').html('<option value="">Não há empresas cadastradas</option>');
                        } else {
                            var html = '<option value="">Selecione aqui...</option>';
                            for (var count = 0; count < data.length; count++) {
                                html += '<option value="' + data[count].ef_id + '">' + data[count].ef_razao_social + '</option>';
                            }

                            $('#select_empresas').html(html);
                        }

                    }
                });
            } else {
                $('#select_empresas').html('<option value="">Não há empresas cadastradas</option>');
            }

        }

        /**
         * lista frentes
         */
        frentes();
        function frentes() {
            $.getJSON("<?=base_url('Transporte/FornecedorController/getFrentes')?>", function(data) {
                var html = '<option value="">Selecione a frente do contrato...</option>';
                for (var count = 0; count < data.length; count++) {
                    html += '<option value="' + data[count].id_ft + '">' + data[count].nome_ft + '</option>';
                }
                $('#select_frentes').html(html);
            });
        }


        /**
         * cadastro da empresa do fornecedor
         */
        $("#form_empresa_fornecedor").submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                    $('#btn_add_empresa').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_empresa').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_empresa').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_empresa').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                        } else {
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'error'
                            );
                        }
                    } else {
                        $.each(data.error, function(prefix, val) {
                            Swal.fire(
                                'Ops!',
                                'Existem alguns erros, corrija por favor.',
                                'error'
                            );
                            $(form).find('span.' + prefix + '_error').text(val);
                        });
                    }
                }
            });
        });

    });
</script>

<script>
    $(function() {
        setTimeout(function() {
            $('.hide_up_smes').html('');
        }, 3000);
    })
</script>
<script>
    $(document).ready(function() {
        $("#btnSubmit_Fornecedor").click(function() {
            $(this).hide();
            $('.id_btn_fornecedor').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...</button>');
        });
    });
</script>

<script>
    function forceInputUppercase(e) {
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.setSelectionRange(start, end);
    }

    document.getElementById("empr_nome").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("empr_socio_dono").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("empr_observacao").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_observacao").addEventListener("keyup", forceInputUppercase, false);
</script>
<?= $this->endSection() ?>