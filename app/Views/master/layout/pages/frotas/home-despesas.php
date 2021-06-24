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
            <h3 class="card-title p-3">Tabs</h3>
            <ul class="nav nav-pills ml-auto p-2">
                <li class="nav-item"><a class="nav-link" href="/frota/controle">Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-veiculo">Fornecedor/Veículos</a></li>
                <li class="nav-item"><a class="nav-link" href="/frota/page-fornecedor-oficina">Fornecedor/Serviços-Oficinas</a></li>
                <li class="nav-item"><a class="nav-link active" href="#tab_3" data-toggle="tab">Despess/Manutenção</a></li>
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