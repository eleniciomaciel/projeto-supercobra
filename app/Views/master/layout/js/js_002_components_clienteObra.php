<script>
    $(document).ready(function() {
        todasObrasCadastroFrentes();
        
        // $('#cli_o_cep').inputmask('99.999-999', {
        //     'placeholder': '00.000-000'
        // });

        // $('#cli_o_cnpj').inputmask('99.999.999/9999-99', {
        //     'placeholder': '00.000.000/0001-00'
        // });

        // var datatale_clientes = $('#todos_clientes').DataTable({
        //     "language": {
        //         "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
        //     },
        //     "order": [
        //         [0, "desc"]
        //     ],
        //     "ajax": "/clientes/lista_todos_clientes_mt"
        // });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#cli_o_address").val("");
            $("#cli_o_neighborhood").val("");
            $("#cli_o_city").val("");
            $("#cli_o_uf").val("");
        }



        //cadastrando obras
        // $('#form_cadastro_cliente').on('submit', function(event) {
        //     event.preventDefault();

        //     $.ajax({
        //         url: $(this).closest('form').attr('action'),
        //         method: $(this).closest('form').attr('method'),
        //         headers: {
        //             'X-Requested-With': 'XMLHttpRequest'
        //         },
        //         data: $(this).serialize(),
        //         dataType: "JSON",

        //         beforeSend: function() {
        //             $('.submit_cli_add_cls').html(
        //                 '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> aguarde...'
        //             );
        //             $('#submit_id_cli_add').attr('disabled', 'disabled');
        //         },

        //         success: function(data) {
        //             $('.submit_cli_add_cls').html('<i class="fa fa-save"></i> Salvar');
        //             $('#submit_id_cli_add').attr('disabled', false);

        //             if (data.error == 'yes') {
        //                 Swal.fire({
        //                     position: 'top-end',
        //                     icon: 'error',
        //                     title: 'Ops! Existem campos com erros, verifique por favor...',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //                 $('#cli_o_nome_obra_error').text(data.cli_o_nome_obra_error);
        //                 $('#cli_o_cnpj_error').text(data.cli_o_cnpj_error);
        //                 $('#cli_o_datainicial_error').text(data.cli_o_datainicial_error);
        //                 $('#cli_o_datafinal_error').text(data.cli_o_datafinal_error);
        //                 $('#cli_o_cep_error').text(data.cli_o_cep_error);
        //                 $('#cli_o_uf_error').text(data.cli_o_uf_error);
        //                 $('#cli_o_city_error').text(data.cli_o_city_error);
        //                 $('#cli_o_address_error').text(data.cli_o_address_error);
        //                 $('#cli_o_number_error').text(data.cli_o_number_error);
        //                 $('#cli_o_neighborhood_error').text(data.cli_o_neighborhood_error);
        //                 $('#objeto_ob_error').text(data.objeto_ob_error);

        //             } else {
        //                 $('#message').html(data.message);
        //                 Swal.fire({
        //                     position: 'top-end',
        //                     icon: 'success',
        //                     title: 'OK! Registro efetuado com sucesso.',
        //                     showConfirmButton: false,
        //                     timer: 1500
        //                 });
        //                 datatale_clientes.ajax.reload();
        //                 //$('#sample_table').DataTable().ajax.reload();
        //                 setTimeout(function() {
        //                     $('#message').html('');
        //                 }, 5000);
        //             }
        //         }
        //     })
        // });

        function todasObrasCadastroFrentes() {
            $.ajax({
                url: '<?= site_url('/cadastros/lista-obras') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="frt_obra"]').empty();
                    $('select[name="frt_obra"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#frt_obra').append('<option value="' + data['id'] + '">' + data['obras_local'] + '</option>');
                    });
                }
            });
        }

        /** ====================================cadstro de frentes ====================================================*/
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

    });
</script>