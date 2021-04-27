<script>
$(document).ready(function() {
    $('#cli_o_cep').inputmask('99.999-999', {
        'placeholder': '00.000-000'
    });
    $('#cli_o_cnpj').inputmask('99.999.999/9999-99', {
        'placeholder': '00.000.000/0001-00'
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#cli_o_address").val("");
        $("#cli_o_neighborhood").val("");
        $("#cli_o_city").val("");
        $("#cli_o_uf").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cli_o_cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if (validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#cli_o_address").val("...");
                $("#cli_o_neighborhood").val("...");
                $("#cli_o_city").val("...");
                $("#cli_o_uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#cli_o_address").val(dados.logradouro);
                        $("#cli_o_neighborhood").val(dados.bairro);
                        $("#cli_o_city").val(dados.localidade);
                        $("#cli_o_uf").val(dados.uf);
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
    $('#form_cadastro_cliente').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: $(this).closest('form').attr('action'),
            method: $(this).closest('form').attr('method'),
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            data: $(this).serialize(),
            dataType: "JSON",

            beforeSend: function() {
                $('.submit_cli_add_cls').html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> aguarde...'
                    );
                $('#submit_id_cli_add').attr('disabled', 'disabled');
            },

            success: function(data) {
                $('.submit_cli_add_cls').html('<i class="fa fa-save"></i> Salvar');
                $('#submit_id_cli_add').attr('disabled', false);

                if (data.error == 'yes') {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Ops! Existem campos com erros, verifique por favor...',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#cli_o_nome_obra_error').text(data.cli_o_nome_obra_error);
                    $('#cli_o_cnpj_error').text(data.cli_o_cnpj_error);
                    $('#cli_o_datainicial_error').text(data.cli_o_datainicial_error);
                    $('#cli_o_datafinal_error').text(data.cli_o_datafinal_error);
                    $('#cli_o_cep_error').text(data.cli_o_cep_error);
                    $('#cli_o_uf_error').text(data.cli_o_uf_error);
                    $('#cli_o_city_error').text(data.cli_o_city_error);
                    $('#cli_o_address_error').text(data.cli_o_address_error);
                    $('#cli_o_number_error').text(data.cli_o_number_error);
                    $('#cli_o_neighborhood_error').text(data.cli_o_neighborhood_error);
                    $('#objeto_ob_error').text(data.objeto_ob_error);

                } else {
                    $('#message').html(data.message);
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'OK! Registro efetuado com sucesso.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    //$('#sample_table').DataTable().ajax.reload();
                    setTimeout(function() {
                        $('#message').html('');
                    }, 5000);
                }
            }
        })
    });
});
</script>