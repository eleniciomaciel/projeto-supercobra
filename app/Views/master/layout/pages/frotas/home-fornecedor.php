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

    <!-- corpo aplicação -->
    <div class="card">
        <div class="card-header d-flex p-0">
            <h3 class="card-title p-3">Controle de frota</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link" href="/frota/controle">Veículos</a></li>
                <li class="nav-item"><a class="nav-link active" href="#tab_4" data-toggle="tab">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-oficina">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-despesas">Despess/Manutenção</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-localizacao">Localização/Transferência</a></li>
            </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content">
               
                <!-- /.tab-pane -->
                <div class="tab-pane active" id="tab_4">
                    <?= $this->include('master/layout/pages/frotas/includes/fornecedores-veiculos', $frente) ?>
                </div>
               
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

        $('#vei_for_cep').mask("00.000-000", {placeholder: "00.000-000"});
        $('#vei_for_cnpj').mask("00.000.000/0001-00", {placeholder: "00.000.000/0001-00"});

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#vei_for_endereco").val("");
            $("#vei_for_bairro").val("");
            $("#vei_for_cidade").val("");
            $("#vei_for_uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#vei_for_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#vei_for_endereco").val("...");
                    $("#vei_for_bairro").val("...");
                    $("#vei_for_cidade").val("...");
                    $("#vei_for_uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#vei_for_endereco").val(dados.logradouro);
                            $("#vei_for_bairro").val(dados.bairro);
                            $("#vei_for_cidade").val(dados.localidade);
                            $("#vei_for_uf").val(dados.uf);
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
<?= $this->endSection() ?>