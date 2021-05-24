<script>
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#add_colab_rua_moradia").val("");
            $("#add_colab_bairro_moraddia").val("");
            $("#add_colab_cidade_moradia").val("");
            $("#add_colab_uf_moradia").val("");
        }

        //Quando o campo cep perde o foco.
        $("#add_colab_cep_moradia").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#add_colab_rua_moradia").val("...");
                    $("#add_colab_bairro_moraddia").val("...");
                    $("#add_colab_cidade_moradia").val("...");
                    $("#add_colab_uf_moradia").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#add_colab_rua_moradia").val(dados.logradouro);
                            $("#add_colab_bairro_moraddia").val(dados.bairro);
                            $("#add_colab_cidade_moradia").val(dados.localidade);
                            $("#add_colab_uf_moradia").val(dados.uf);
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

        /** ================================  aeroporto =============================*/
        function limpa_formulário_cep2() {
            // Limpa valores do formulário de cep.
            $("#add_colab_cidade_aeroporto").val("");
            $("#add_colab_uf_eroporto").val("");
        }

        //Quando o campo cep perde o foco.
        $("#add_colab_cep_aeroporto").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#add_colab_cidade_aeroporto").val("...");
                    $("#add_colab_uf_eroporto").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#add_colab_cidade_aeroporto").val(dados.localidade);
                            $("#add_colab_uf_eroporto").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep2();
                            alert("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep2();
                    alert("Formato de CEP inválido gg.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep2();
            }
        });
    });
</script>