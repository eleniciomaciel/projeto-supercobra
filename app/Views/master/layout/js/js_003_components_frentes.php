<script>
    $(document).ready(function() {
       
        $('#frt_cep').inputmask('99.999-999', {
            'placeholder': '00.000-000'
        });

        var datatale_frentes = $('#todos_frentes').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?php echo site_url("/frentes/lista-frentes"); ?>",
                type: "GET",
            }
        });

        function limpa_formulário_cep2() {
            // Limpa valores do formulário de cep.
            $("#frt_endereco").val("");
            $("#frt_bairros").val("");
            $("#frt_cidade").val("");
            $("#frt_estado").val("");
        }

        //Quando o campo cep perde o foco.
        $("#frt_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#frt_endereco").val("...");
                    $("#frt_bairros").val("...");
                    $("#frt_cidade").val("...");
                    $("#frt_estado").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#frt_endereco").val(dados.logradouro);
                            $("#frt_bairros").val(dados.bairro);
                            $("#frt_cidade").val(dados.localidade);
                            $("#frt_estado").val(dados.uf);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep2();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Ops! CEP não encontrado.',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep2();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Ops! Formato de CEP inválido.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep2();
            }
        });

        //cadastrando obras
        $('#criar_novas_frentes').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).closest('form').attr('action'),
                method: $(this).closest('form').attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.submit_frt_add_cls').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> aguarde...'
                    );
                    $('#submit_id_frt_add').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('.submit_frt_add_cls').html('<i class="fa fa-save"></i> Salvar');
                    $('#submit_id_frt_add').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Existem campos com erros, verifique por favor...',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#frt_cliente_error').text(data.frt_cliente_error);
                        $('#frt_obra_error').text(data.frt_obra_error);
                        $('#frt_projeto_nome_error').text(data.frt_projeto_nome_error);
                        $('#frt_refrencia_error').text(data.frt_refrencia_error);
                        $('#frt_dataInicial_error').text(data.frt_dataInicial_error);
                        $('#frt_datafinal_error').text(data.frt_datafinal_error);
                        $('#frt_cep_error').text(data.frt_cep_error);
                        $('#frt_estado_error').text(data.frt_estado_error);
                        $('#frt_cidade_error').text(data.frt_cidade_error);
                        $('#frt_bairros_error').text(data.frt_bairros_error);
                        $('#frt_endereco_error').text(data.frt_endereco_error);
                        $('#frt_numeros_error').text(data.frt_numeros_error);
                        $('#frt_observacoes_error').text(data.frt_observacoes_error);
                        

                    } else {
                        $('#message').html(data.message);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'OK! Registro efetuado com sucesso.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        datatale_frentes.ajax.reload();
                    }
                }
            })
        });
        /** ====================================cadstro de frentes ====================================================*/
    });
</script>