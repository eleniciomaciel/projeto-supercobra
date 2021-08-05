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
                            <h3 class="card-title">Empresa(s) do fornecedor</h3>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Empresa(s)</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Cadastrar empresa</a>
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
                            <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/empresa-lista') ?>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                            <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/empresa-cadastro', $dd_fornecedor) ?>
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
        $('#empr_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#empre_cnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });

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

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#empr_endereco").val("");
            $("#empr_bairro").val("");
            $("#empr_cidade").val("");
            $("#empr_uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#empr_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#empr_endereco").val("...");
                    $("#empr_bairro").val("...");
                    $("#empr_cidade").val("...");
                    $("#empr_uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#empr_endereco").val(dados.logradouro);
                            $("#empr_bairro").val(dados.bairro);
                            $("#empr_cidade").val(dados.localidade);
                            $("#empr_uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });

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

        /**
         * lista dados em moddal popap da empresa do fornecedor
         */
        $(document).on('click', '.verEmpresaFornecedor', function(e) {
            e.preventDefault();
            var id_emp_forn = $(this).data('id');

            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorController/getDadosEmpresaFornecedor'); ?>",
                method: "GET",
                data: {
                    id_emp_forn: id_emp_forn
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#ef_razao_social').val(data.ef_razao_social);
                    $('#ef_nome_dono').val(data.ef_nome_dono);
                    $('#ef_tipo_dono').val(data.ef_tipo_dono);
                    $('#ef_cnae').val(data.ef_cnae);
                    $('#ef_classificacao_empresa').val(data.ef_classificacao_empresa);
                    $('#ef_cnpj').val(data.ef_cnpj);
                    $('#ef_incricao_estadual').val(data.ef_incricao_estadual);
                    $('#ef_incricao_municial').val(data.ef_incricao_municial);
                    $('#ef_cep').val(data.ef_cep);
                    $('#ef_uf').val(data.ef_uf);
                    $('#ef_cidade').val(data.ef_cidade);
                    $('#ef_bairro').val(data.ef_bairro);
                    $('#ef_endereco').val(data.ef_endereco);
                    $('#ef_description').val(data.ef_description);

                    $('#empresaDadosDoFornecedorModal').modal('show');
                    $('#hidden_id_empresa_up_fornecedor').val(id_emp_forn);
                }
            })
        });

        /**
         * cadastro da empresa do fornecedor
         */
        $("#form_altera_empresa_fornecedor").submit(function(e) {
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
                    $('#id_btn_update_empresa').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_update_empresa').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#id_btn_update_empresa').html('<i class="fa fa-save"></i> Alterar');
                    $('.cls_update_empresa').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores').DataTable().ajax.reload();
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


        /**
         * deleta empresa fake
         */
        $(document).on('click', '.delEmpresaFornecedor', function() {
            var id_emp_for = $(this).data('id');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Essa ação será permanente no sistema!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/FornecedorController/deleteEmpresaFornecedor'); ?>",
                        method: "GET",
                        data: {
                            id_emp_for: id_emp_for
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            $('#list_empresas_fornacedores').DataTable().ajax.reload();
                        }
                    })
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