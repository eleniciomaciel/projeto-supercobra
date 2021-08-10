<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">

    <div class="container-fluid">
        <h2 class="text-center display-4">Buscar empresa</h2>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control form-control-lg" name="search" id="search" placeholder="Buscar aqui...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_error_cadastro')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Vixe!</h5>
                    <?php echo session()->getFlashdata('fornecedor_error_cadastro') ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_success')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('fornecedor_success') ?>
                </div>
            </div>

        <?php
        }
        ?>
        <br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-hospital-user mr-1"></i>
                    Responsáveis (forncedores)
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-paste"></i> Cadastro Renponsável</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-user-cog"></i> Cadastrados</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="tab-pane active" id="revenue-chart">
                        <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/cadastro-forncedor') ?>
                    </div>
                    <div class="tab-pane" id="sales-chart">
                        <?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/lista-fornecedor') ?>
                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>

</section>


<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#fort_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#fort_cpf').mask("000.000-000-00", {
            placeholder: "000.000-000-00"
        });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#fort_endereco").val("");
            $("#fort_bairro").val("");
            $("#fort_cidade").val("");
            $("#fort_uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#fort_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#fort_endereco").val("...");
                    $("#fort_bairro").val("...");
                    $("#fort_cidade").val("...");
                    $("#fort_uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#fort_endereco").val(dados.logradouro);
                            $("#fort_bairro").val(dados.bairro);
                            $("#fort_cidade").val(dados.localidade);
                            $("#fort_uf").val(dados.uf);
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

        $('#list_fornacedores').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("Transporte/FornecedorController/listaFornecedorAjax"); ?>",
                type: "GET",
            }
        });

        $("#btnSubmit_Fornecedor").click(function() {
            $(this).hide();
            $('.id_btn_fornecedor').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando...</button>');
        });

        $(function() {
            $("#search").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '<?php echo base_url('Transporte/FornecedorController/consultaEmpresa'); ?>',
                        type: "GET",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        delay: 2000,
                        success: function(data) {
                            if (data.length < 1) {
                                var data = [{
                                    label: 'Usuário não encontrado',
                                    value: -1
                                }];
                            }
                            response(data)
                        },
                    }); //fim do ajax 
                },
                minLenght: 1,
                select: function(event, ui) {
                    if (ui.item.value == -1) {
                        $(this).val("");
                        return false;
                    } else {
                        window.location.href = '<?= site_url('transporte-fornecedor/empresas-fornecedor') ?>' +'/'+ ui.item.id;
                    }
                }
            });
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

    document.getElementById("fort_name").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_bairro").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_endereco").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_observacao").addEventListener("keyup", forceInputUppercase, false);
</script>

<?= $this->endSection() ?>