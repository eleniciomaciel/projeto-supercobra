<script>
    $(document).ready(function() {
        todosClientes();
        todosClientesCadastroFrentes();

        $('#cep_input').inputmask('99.999-999', {
            'placeholder': '00.000-000'
        });

        $('#cnpj_input').inputmask('99.999.999/9991-99', {
            'placeholder': '00.000.000/0001-00'
        })

        var datatale_obras = $('#list_todas_obras').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": {
                url: "<?php echo site_url("/frentes/lista_todas_frentes_obras"); ?>",
                type: "GET",
            }
        });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#int_rua").val("");
            $("#int_bairro").val("");
            $("#input_cidade").val("");
            $("#input_state_uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep_input").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#int_rua").val("...");
                    $("#int_bairro").val("...");
                    $("#input_cidade").val("...");
                    $("#input_state_uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#int_rua").val(dados.logradouro);
                            $("#int_bairro").val(dados.bairro);
                            $("#input_cidade").val(dados.localidade);
                            $("#input_state_uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
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
                    limpa_formulário_cep();
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
                limpa_formulário_cep();
            }
        });

        //cadastrando obras
        $('#adiciona_obra').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "<?php echo site_url('obras/index'); ?>",
                method: "POST",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('.submit_button_cls').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> aguarde...'
                    );
                    $('#submit_button').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('.submit_button_cls').html('<i class="fa fa-save"></i> Salvar');
                    $('#submit_button').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Existem campos com erros, verifique por favor...',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#local_input_error').text(data.local_input_error);
                        $('#data_inicio_error').text(data.data_inicio_error);
                        $('#data_encerra_error').text(data.data_encerra_error);
                        $('#cep_input_error').text(data.cep_input_error);
                        $('#cnpj_input_error').text(data.cnpj_input_error);
                        $('#input_state_uf_error').text(data.input_state_uf_error);
                        $('#input_cidade_error').text(data.input_cidade_error);
                        $('#int_rua_error').text(data.int_rua_error);
                        $('#int_numero_error').text(data.int_numero_error);
                        $('#int_bairro_error').text(data.int_bairro_error);
                        $('#int_cliente_error').text(data.int_cliente_error);
                        $('#obra_status_error').text(data.obra_status_error);
                        $('#obs_obra_error').text(data.obs_obra_error);

                    } else {
                        $('#message').html(data.message);
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'OK! Registro efetuado com sucesso.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        datatale_obras.ajax.reload();
                        todosClientes();
                        todosClientesCadastroFrentes();
                        $('#adiciona_obra')[0].reset();
                    }
                }
            })
        });

        /**lista clientes da obra */
        function todosClientes() {
            $.ajax({
                url: '<?= site_url('/clientes/lista-clientes') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="int_cliente"]').empty();
                    $('select[name="int_cliente"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#int_cliente').append('<option value="' + data['id_cli'] + '">' + data['nome_cli'] + '</option>');
                    });
                }
            });
        }

        function todosClientesCadastroFrentes() {
            $.ajax({
                url: '<?= site_url('/clientes/lista-clientes') ?>',
                method: 'GET',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="frt_cliente"]').empty();
                    $('select[name="frt_cliente"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#frt_cliente').append('<option value="' + data['id_cli'] + '">' + data['nome_cli'] + '</option>');
                    });
                }
            });
        }
    });
</script>