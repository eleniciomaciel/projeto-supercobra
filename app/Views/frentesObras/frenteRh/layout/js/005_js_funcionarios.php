<script>
    $(document).ready(function() {

        todasFuncionariosSelect();
        selectCargoComFuncao();
        selectAtividades();
        selectDepartamentos();

        $('#lista_funcioanrios_frente').DataTable({
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
                url: "<?php echo site_url("/admin_rh/ler_funcionarios_por_frente"); ?>",
                type: "GET",
            }
        });

        $('#form_novo_colaborador').on('submit', function(event) {
            event.preventDefault();

           

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_add_colab_f').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_colab_f').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('#id_add_colab_f').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_colab_f').attr('disabled', false);

                    if (data.error == 'yes') {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Formulário com erro(s), verifique por gentileza.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#x_add_colab_nome_error').text(data.x_add_colab_nome_error);
                        $('#x_add_colab_conjuge_nome_error').text(data.x_add_colab_conjuge_nome_error);
                        $('#x_add_colab_codigo_error').text(data.x_add_colab_codigo_error);

                        $('#x_add_colab_matricula_error').text(data.x_add_colab_matricula_error);
                        $('#add_colab_sexo_error').text(data.add_colab_sexo_error);
                        $('#add_colab_estado_civil_error').text(data.add_colab_estado_civil_error);

                        $('#add_colab_escolaridade_error').text(data.add_colab_escolaridade_error);
                        $('#add_colab_nacionalidade_error').text(data.add_colab_nacionalidade_error);
                        $('#add_colab_naturalidade_error').text(data.add_colab_naturalidade_error);

                        $('#add_colab_uf_naturalidade_error').text(data.add_colab_uf_naturalidade_error);
                        $('#add_colab_data_nacimento_error').text(data.add_colab_data_nacimento_error);
                        $('#add_colab_nome_mae_error').text(data.add_colab_nome_mae_error);
                        $('#add_colab_do_pai_error').text(data.add_colab_do_pai_error);

                        $('#add_colab_contato_pricipal_error').text(data.add_colab_contato_pricipal_error);
                        $('#add_colab_contato_alternativo_error').text(data.add_colab_contato_alternativo_error);
                        $('#add_colab_contato_familiar_error').text(data.add_colab_contato_familiar_error);
                        $('#add_colab_email_pessoal_error').text(data.add_colab_email_pessoal_error);

                        //endereço pessoal
                        $('#add_colab_cep_moradia_error').text(data.add_colab_cep_moradia_error);
                        $('#add_colab_uf_moradia_error').text(data.add_colab_uf_moradia_error);
                        $('#add_colab_cidade_moradia_error').text(data.add_colab_cidade_moradia_error);
                        $('#add_colab_bairro_moraddia_error').text(data.add_colab_bairro_moraddia_error);
                        $('#add_colab_rua_moradia_error').text(data.add_colab_rua_moradia_error);
                        $('#add_colab_numero_moradia_error').text(data.add_colab_numero_moradia_error);
                        $('#add_colab_complemento_morada_error').text(data.add_colab_complemento_morada_error);

                        //documentos
                        $('#add_colab_doc_numero_rg_error').text(data.add_colab_doc_numero_rg_error);
                        $('#add_colab_doc_orgao_emissor_rg_error').text(data.add_colab_doc_orgao_emissor_rg_error);
                        $('#add_colab_doc_data_rg_emissao_error').text(data.add_colab_doc_data_rg_emissao_error);
                        $('#add_colab_doc_uf_rg_error').text(data.add_colab_doc_uf_rg_error);
                        $('#add_colab_titulo_numero_error').text(data.add_colab_titulo_numero_error);
                        $('#add_colab_titulo_zona_error').text(data.add_colab_titulo_zona_error);
                        $('#add_colab_titulo_sessao_error').text(data.add_colab_titulo_sessao_error);
                        $('#add_colab_titulo_data_emissao_error').text(data.add_colab_titulo_data_emissao_error);
                        $('#add_colab_titulo_uf_emissao_error').text(data.add_colab_titulo_uf_emissao_error);
                        $('#add_colab_cpf_numero_error').text(data.add_colab_cpf_numero_error);
                        $('#add_colab_numero_pis_error').text(data.add_colab_numero_pis_error);
                        $('#add_colab_reservista_numero_error').text(data.add_colab_reservista_numero_error);
                        $('#add_colab_sus_numero_error').text(data.add_colab_sus_numero_error);

                        //CTPS--FGTS
                        $('#add_colab_ctps_numero_error').text(data.add_colab_ctps_numero_error);
                        $('#add_colab_ctps_serie_error').text(data.add_colab_ctps_serie_error);
                        $('#add_colab_data_emissao_error').text(data.add_colab_data_emissao_error);
                        $('#add_colab_uf_emissor_error').text(data.add_colab_uf_emissor_error);
                        $('#add_colab_fgts_categoria_error').text(data.add_colab_fgts_categoria_error);
                        $('#add_colab_fgts_codigo_error').text(data.add_colab_fgts_codigo_error);

                        //UNIFORME -- TIPO SANGUE
                        $('#add_colab_uniforme_tamanho_error').text(data.add_colab_uniforme_tamanho_error);
                        $('#add_colab_uniforme_calca_error').text(data.add_colab_uniforme_calca_error);
                        $('#add_colab_tipo_sangue_error').text(data.add_colab_tipo_sangue_error);

                         //FUNCIONAIS
                        $('#add_colab_funcao_cargo_error').text(data.add_colab_funcao_cargo_error);
                        $('#add_colab_funcao_situacao_error').text(data.add_colab_funcao_situacao_error);
                        $('#add_colab_funcao_admissao_data_error').text(data.add_colab_funcao_admissao_data_error);

                        $('#add_colab_funcao_desligamento_data_data_error').text(data.add_colab_funcao_desligamento_data_data_error);
                        $('#add_colab_funcao_hora_extra_fixa_error').text(data.add_colab_funcao_hora_extra_fixa_error);
                        $('#add_colab_funcao_salario_error').text(data.add_colab_funcao_salario_error);

                        $('#add_colab_funcao_tipo_pagamento_error').text(data.add_colab_funcao_tipo_pagamento_error);
                        $('#add_colab_funcao_tipo_salario_error').text(data.add_colab_funcao_tipo_salario_error);
                        $('#add_colab_funcao_departamento_error').text(data.add_colab_funcao_departamento_error);

                        $('#add_colab_cento_de_custo_error').text(data.add_colab_cento_de_custo_error);
                        $('#add_colab_funcao_hora_extras_error').text(data.add_colab_funcao_hora_extras_error);
                        $('#add_colab_funcao_encarregado_error').text(data.add_colab_funcao_encarregado_error);

                        $('#add_colab_funcao_periculosidade_error').text(data.add_colab_funcao_periculosidade_error);
                        $('#add_colab_funcao_insalubridade_error').text(data.add_colab_funcao_insalubridade_error);
                        $('#add_colab_funcao_desconto_sindical_error').text(data.add_colab_funcao_desconto_sindical_error);
                        $('#add_colab_funcao_ps_error').text(data.add_colab_funcao_ps_error);

                        //Aeroporto
                        $('#add_colab_cep_aeroporto_error').text(data.add_colab_cep_aeroporto_error);
                        $('#add_colab_uf_eroporto_error').text(data.add_colab_uf_eroporto_error);
                        $('#add_colab_cidade_aeroporto_error').text(data.add_colab_cidade_aeroporto_error);

                        //Outros
                        $('#add_colab_outros_local_trabalho_error').text(data.add_colab_outros_local_trabalho_error);
                        $('#add_colab_outros_tipo_moradia_error').text(data.add_colab_outros_tipo_moradia_error);
                        $('#add_colab_outros_observacao_error').text(data.add_colab_outros_observacao_error);

                    } else {

                        //limpa
                        $('#x_add_colab_nome_error').text('');
                        $('#x_add_colab_conjuge_nome_error').text('');
                        $('#x_add_colab_codigo_error').text('');

                        $('#x_add_colab_matricula_error').text('');
                        $('#add_colab_sexo_error').text('');
                        $('#add_colab_estado_civil_error').text('');

                        $('#add_colab_escolaridade_error').text('');
                        $('#add_colab_nacionalidade_error').text('');
                        $('#add_colab_naturalidade_error').text('');

                        $('#add_colab_uf_naturalidade_error').text('');
                        $('#add_colab_data_nacimento_error').text('');
                        $('#add_colab_nome_mae_error').text('');
                        $('#add_colab_do_pai_error').text('');

                        //contato
                        $('#add_colab_contato_pricipal_error').text('');
                        $('#add_colab_contato_alternativo_error').text('');
                        $('#add_colab_contato_familiar_error').text('');
                        $('#add_colab_email_pessoal_error').text('');

                        //endereço pessola
                        $('#add_colab_cep_moradia_error').text('');
                        $('#add_colab_uf_moradia_error').text('');
                        $('#add_colab_cidade_moradia_error').text('');
                        $('#add_colab_bairro_moraddia_error').text('');
                        $('#add_colab_rua_moradia_error').text('');
                        $('#add_colab_numero_moradia_error').text('');
                        $('#add_colab_complemento_morada_error').text('');
                        
                        //documentos
                        $('#add_colab_doc_numero_rg_error').text('');
                        $('#add_colab_doc_orgao_emissor_rg_error').text('');
                        $('#add_colab_doc_data_rg_emissao_error').text('');
                        $('#add_colab_doc_uf_rg_error').text('');
                        $('#add_colab_titulo_numero_error').text('');
                        $('#add_colab_titulo_zona_error').text('');
                        $('#add_colab_titulo_sessao_error').text('');
                        $('#add_colab_titulo_data_emissao_error').text('');
                        $('#add_colab_titulo_uf_emissao_error').text('');
                        $('#add_colab_cpf_numero_error').text('');
                        $('#add_colab_numero_pis_error').text('');
                        $('#add_colab_reservista_numero_error').text('');
                        $('#add_colab_sus_numero_error').text('');

                        //CTPS--FGTS
                        $('#add_colab_ctps_numero_error').text('');
                        $('#add_colab_ctps_serie_error').text('');
                        $('#add_colab_data_emissao_error').text('');
                        $('#add_colab_uf_emissor_error').text('');
                        $('#add_colab_fgts_categoria_error').text('');
                        $('#add_colab_fgts_codigo_error').text('');

                        //UNIFORME -- TIPO SANGUE
                        $('#add_colab_uniforme_tamanho_error').text('');
                        $('#add_colab_uniforme_calca_error').text('');
                        $('#add_colab_tipo_sangue_error').text('');

                        //FUNCIONAIS
                        $('#add_colab_funcao_cargo_error').text('');
                        $('#add_colab_funcao_situacao_error').text('');
                        $('#add_colab_funcao_admissao_data_error').text('');

                        $('#add_colab_funcao_desligamento_data_data_error').text('');
                        $('#add_colab_funcao_hora_extra_fixa_error').text('');
                        $('#add_colab_funcao_salario_error').text('');

                        $('#add_colab_funcao_tipo_pagamento_error').text('');
                        $('#add_colab_funcao_tipo_salario_error').text('');
                        $('#add_colab_funcao_departamento_error').text('');

                        $('#add_colab_cento_de_custo_error').text('');
                        $('#add_colab_funcao_hora_extras_error').text('');
                        $('#add_colab_funcao_encarregado_error').text('');
                        
                        $('#add_colab_funcao_periculosidade_error').text('');
                        $('#add_colab_funcao_insalubridade_error').text('');
                        $('#add_colab_funcao_desconto_sindical_error').text('');
                        $('#add_colab_funcao_ps_error').text('');

                        //Aeroporto
                        $('#add_colab_cep_aeroporto_error').text('');
                        $('#add_colab_uf_eroporto_error').text('');
                        $('#add_colab_cidade_aeroporto_error').text('');

                        //Outros
                        $('#add_colab_outros_local_trabalho_error').text('');
                        $('#add_colab_outros_tipo_moradia_error').text('');
                        $('#add_colab_outros_observacao_error').text('');



                        $('#message_add_funcionario').html(data.message);
                        $('#lista_funcioanrios_frente').DataTable().ajax.reload();
                        $('#form_novo_colaborador')[0].reset();
                        setTimeout(function() {
                            $('#message_add_funcionario').html('');
                        }, 3000);
                    }
                }
            })
        });

        /**altera dados do uisuário tipo funcionario */
        $('#form_update_colaborador').on('submit', function(event) {
            event.preventDefault();

           

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#id_up_colab_f').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_colab_f').attr('disabled', 'disabled');
                },
                success: function(data) {

                    $('#id_up_colab_f').html('<i class="fas fa-sync-alt"></i> Alterar');
                    $('.cls_up_colab_f').attr('disabled', false);

                    if (data.error == 'yes') {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Formulário com erro(s), verifique por gentileza.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        $('#x_add_colab_nome_error_up').text(data.x_add_colab_nome_error_up);
                        $('#x_add_colab_conjuge_nome_error_up').text(data.x_add_colab_conjuge_nome_error_up);
                        $('#x_add_colab_codigo_error_up').text(data.x_add_colab_codigo_error_up);

                        $('#x_add_colab_matricula_error_up').text(data.x_add_colab_matricula_error_up);
                        $('#add_colab_sexo_error_up').text(data.add_colab_sexo_error_up);
                        $('#add_colab_estado_civil_error_up').text(data.add_colab_estado_civil_error_up);

                        $('#add_colab_escolaridade_error_up').text(data.add_colab_escolaridade_error_up);
                        $('#add_colab_nacionalidade_error_up').text(data.add_colab_nacionalidade_error_up);
                        $('#add_colab_naturalidade_error_up').text(data.add_colab_naturalidade_error_up);

                        $('#add_colab_uf_naturalidade_error_up').text(data.add_colab_uf_naturalidade_error_up);
                        $('#add_colab_data_nacimento_error_up').text(data.add_colab_data_nacimento_error_up);
                        $('#add_colab_nome_mae_error_up').text(data.add_colab_nome_mae_error_up);
                        $('#add_colab_do_pai_error_up').text(data.add_colab_do_pai_error_up);

                        $('#add_colab_contato_pricipal_error_up').text(data.add_colab_contato_pricipal_error_up);
                        $('#add_colab_contato_alternativo_error_up').text(data.add_colab_contato_alternativo_error_up);
                        $('#add_colab_contato_familiar_error_up').text(data.add_colab_contato_familiar_error_up);
                        $('#add_colab_email_pessoal_error_up').text(data.add_colab_email_pessoal_error_up);

                        //endereço pessoal
                        $('#add_colab_cep_moradia_error_up').text(data.add_colab_cep_moradia_error_up);
                        $('#add_colab_uf_moradia_error_up').text(data.add_colab_uf_moradia_error_up);
                        $('#add_colab_cidade_moradia_error_up').text(data.add_colab_cidade_moradia_error_up);
                        $('#add_colab_bairro_moraddia_error_up').text(data.add_colab_bairro_moraddia_error_up);
                        $('#add_colab_rua_moradia_error_up').text(data.add_colab_rua_moradia_error_up);
                        $('#add_colab_numero_moradia_error_up').text(data.add_colab_numero_moradia_error_up);
                        $('#add_colab_complemento_morada_error_up').text(data.add_colab_complemento_morada_error_up);

                        //documentos
                        $('#add_colab_doc_numero_rg_error_up').text(data.add_colab_doc_numero_rg_error_up);
                        $('#add_colab_doc_orgao_emissor_rg_error_up').text(data.add_colab_doc_orgao_emissor_rg_error_up);
                        $('#add_colab_doc_data_rg_emissao_error_up').text(data.add_colab_doc_data_rg_emissao_error_up);
                        $('#add_colab_doc_uf_rg_error_up').text(data.add_colab_doc_uf_rg_error_up);
                        $('#add_colab_titulo_numero_error_up').text(data.add_colab_titulo_numero_error_up);
                        $('#add_colab_titulo_zona_error_up').text(data.add_colab_titulo_zona_error_up);
                        $('#add_colab_titulo_sessao_error_up').text(data.add_colab_titulo_sessao_error_up);
                        $('#add_colab_titulo_data_emissao_error_up').text(data.add_colab_titulo_data_emissao_error_up);
                        $('#add_colab_titulo_uf_emissao_error_up').text(data.add_colab_titulo_uf_emissao_error_up);
                        $('#add_colab_cpf_numero_error_up').text(data.add_colab_cpf_numero_error_up);
                        $('#add_colab_numero_pis_error_up').text(data.add_colab_numero_pis_error_up);
                        $('#add_colab_reservista_numero_error_up').text(data.add_colab_reservista_numero_error_up);
                        $('#add_colab_sus_numero_error_up').text(data.add_colab_sus_numero_error_up);

                        //CTPS--FGTS
                        $('#add_colab_ctps_numero_error_up').text(data.add_colab_ctps_numero_error_up);
                        $('#add_colab_ctps_serie_error_up').text(data.add_colab_ctps_serie_error_up);
                        $('#add_colab_data_emissao_error_up').text(data.add_colab_data_emissao_error_up);
                        $('#add_colab_uf_emissor_error_up').text(data.add_colab_uf_emissor_error_up);
                        $('#add_colab_fgts_categoria_error_up').text(data.add_colab_fgts_categoria_error_up);
                        $('#add_colab_fgts_codigo_error_up').text(data.add_colab_fgts_codigo_error_up);

                        //UNIFORME -- TIPO SANGUE
                        $('#add_colab_uniforme_tamanho_error_up').text(data.add_colab_uniforme_tamanho_error_up);
                        $('#add_colab_uniforme_calca_error_up').text(data.add_colab_uniforme_calca_error_up);
                        $('#add_colab_tipo_sangue_error_up').text(data.add_colab_tipo_sangue_error_up);

                         //FUNCIONAIS
                        $('#add_colab_funcao_cargo_error_up').text(data.add_colab_funcao_cargo_error_up);
                        $('#add_colab_funcao_situacao_error_up').text(data.add_colab_funcao_situacao_error_up);
                        $('#add_colab_funcao_admissao_data_error_up').text(data.add_colab_funcao_admissao_data_error_up);

                        $('#add_colab_funcao_desligamento_data_data_error_up').text(data.add_colab_funcao_desligamento_data_data_error_up);
                        $('#add_colab_funcao_hora_extra_fixa_error_up').text(data.add_colab_funcao_hora_extra_fixa_error_up);
                        $('#add_colab_funcao_salario_error_up').text(data.add_colab_funcao_salario_error_up);

                        $('#add_colab_funcao_tipo_pagamento_error_up').text(data.add_colab_funcao_tipo_pagamento_error_up);
                        $('#add_colab_funcao_tipo_salario_error_up').text(data.add_colab_funcao_tipo_salario_error_up);
                        $('#add_colab_funcao_departamento_error_up').text(data.add_colab_funcao_departamento_error_up);

                        $('#add_colab_cento_de_custo_error_up').text(data.add_colab_cento_de_custo_error_up);
                        $('#add_colab_funcao_hora_extras_error_up').text(data.add_colab_funcao_hora_extras_error_up);
                        $('#add_colab_funcao_encarregado_error_up').text(data.add_colab_funcao_encarregado_error_up);

                        $('#add_colab_funcao_periculosidade_error_up').text(data.add_colab_funcao_periculosidade_error_up);
                        $('#add_colab_funcao_insalubridade_error_up').text(data.add_colab_funcao_insalubridade_error_up);
                        $('#add_colab_funcao_desconto_sindical_error_up').text(data.add_colab_funcao_desconto_sindical_error_up);
                        $('#add_colab_funcao_ps_error_up').text(data.add_colab_funcao_ps_error_up);

                        //Aeroporto
                        $('#add_colab_cep_aeroporto_error_up').text(data.add_colab_cep_aeroporto_error_up);
                        $('#add_colab_uf_eroporto_error_up').text(data.add_colab_uf_eroporto_error_up);
                        $('#add_colab_cidade_aeroporto_error_up').text(data.add_colab_cidade_aeroporto_error_up);

                        //Outros
                        $('#add_colab_outros_local_trabalho_error_up').text(data.add_colab_outros_local_trabalho_error_up);
                        $('#add_colab_outros_tipo_moradia_error_up').text(data.add_colab_outros_tipo_moradia_error_up);
                        $('#add_colab_outros_observacao_error_up').text(data.add_colab_outros_observacao_error_up);

                    } else {

                        //limpa
                        $('#x_add_colab_nome_error_up').text('');
                        $('#x_add_colab_conjuge_nome_error_up').text('');
                        $('#x_add_colab_codigo_error_up').text('');

                        $('#x_add_colab_matricula_error_up').text('');
                        $('#add_colab_sexo_error_up').text('');
                        $('#add_colab_estado_civil_error_up').text('');

                        $('#add_colab_escolaridade_error_up').text('');
                        $('#add_colab_nacionalidade_error_up').text('');
                        $('#add_colab_naturalidade_error_up').text('');

                        $('#add_colab_uf_naturalidade_error_up').text('');
                        $('#add_colab_data_nacimento_error_up').text('');
                        $('#add_colab_nome_mae_error_up').text('');
                        $('#add_colab_do_pai_error_up').text('');

                        //contato
                        $('#add_colab_contato_pricipal_error_up').text('');
                        $('#add_colab_contato_alternativo_error_up').text('');
                        $('#add_colab_contato_familiar_error_up').text('');
                        $('#add_colab_email_pessoal_error_up').text('');

                        //endereço pessola
                        $('#add_colab_cep_moradia_error_up').text('');
                        $('#add_colab_uf_moradia_error_up').text('');
                        $('#add_colab_cidade_moradia_error_up').text('');
                        $('#add_colab_bairro_moraddia_error_up').text('');
                        $('#add_colab_rua_moradia_error_up').text('');
                        $('#add_colab_numero_moradia_error_up').text('');
                        $('#add_colab_complemento_morada_error_up').text('');
                        
                        //documentos
                        $('#add_colab_doc_numero_rg_error_up').text('');
                        $('#add_colab_doc_orgao_emissor_rg_error_up').text('');
                        $('#add_colab_doc_data_rg_emissao_error_up').text('');
                        $('#add_colab_doc_uf_rg_error_up').text('');
                        $('#add_colab_titulo_numero_error_up').text('');
                        $('#add_colab_titulo_zona_error_up').text('');
                        $('#add_colab_titulo_sessao_error_up').text('');
                        $('#add_colab_titulo_data_emissao_error_up').text('');
                        $('#add_colab_titulo_uf_emissao_error_up').text('');
                        $('#add_colab_cpf_numero_error_up').text('');
                        $('#add_colab_numero_pis_error_up').text('');
                        $('#add_colab_reservista_numero_error_up').text('');
                        $('#add_colab_sus_numero_error_up').text('');

                        //CTPS--FGTS
                        $('#add_colab_ctps_numero_error_up').text('');
                        $('#add_colab_ctps_serie_error_up').text('');
                        $('#add_colab_data_emissao_error_up').text('');
                        $('#add_colab_uf_emissor_error_up').text('');
                        $('#add_colab_fgts_categoria_error_up').text('');
                        $('#add_colab_fgts_codigo_error_up').text('');

                        //UNIFORME -- TIPO SANGUE
                        $('#add_colab_uniforme_tamanho_error_up').text('');
                        $('#add_colab_uniforme_calca_error_up').text('');
                        $('#add_colab_tipo_sangue_error_up').text('');

                        //FUNCIONAIS
                        $('#add_colab_funcao_cargo_error_up').text('');
                        $('#add_colab_funcao_situacao_error_up').text('');
                        $('#add_colab_funcao_admissao_data_error_up').text('');

                        $('#add_colab_funcao_desligamento_data_data_error_up').text('');
                        $('#add_colab_funcao_hora_extra_fixa_error_up').text('');
                        $('#add_colab_funcao_salario_error_up').text('');

                        $('#add_colab_funcao_tipo_pagamento_error_up').text('');
                        $('#add_colab_funcao_tipo_salario_error_up').text('');
                        $('#add_colab_funcao_departamento_error_up').text('');

                        $('#add_colab_cento_de_custo_error_up').text('');
                        $('#add_colab_funcao_hora_extras_error_up').text('');
                        $('#add_colab_funcao_encarregado_error_up').text('');
                        
                        $('#add_colab_funcao_periculosidade_error_up').text('');
                        $('#add_colab_funcao_insalubridade_error_up').text('');
                        $('#add_colab_funcao_desconto_sindical_error_up').text('');
                        $('#add_colab_funcao_ps_error_up').text('');

                        //Aeroporto
                        $('#add_colab_cep_aeroporto_error_up').text('');
                        $('#add_colab_uf_eroporto_error_up').text('');
                        $('#add_colab_cidade_aeroporto_error_up').text('');

                        //Outros
                        $('#add_colab_outros_local_trabalho_error_up').text('');
                        $('#add_colab_outros_tipo_moradia_error_up').text('');
                        $('#add_colab_outros_observacao_error_up').text('');



                        $('#message_up_funcionario').html(data.message);
                        $('#lista_funcioanrios_frente').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_up_funcionario').html('');
                        }, 3000);
                    }
                }
            })
        });

         /**seleciona os funcionarios */
         function todasFuncionariosSelect() {
            $.ajax({
                url: '<?= site_url('/admin_rh/list_funcionarios_select') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="funcionario_select"]').empty();
                    $('select[name="funcionario_select"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#funcionario_select').append('<option value="' + data['f_id'] + '">' + data['f_nome'] + '</option>');
                    });
                }
            });
        }

         /**seleciona os funcionarios */
         function selectCargoComFuncao() {
            $.ajax({
                url: '<?= site_url('/admin_rh/list_funcionarios_funcao') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="select_cargo_e_funcoes"]').empty();
                    $('select[name="select_cargo_e_funcoes"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#select_cargo_e_funcoes').append('<option value="' + data['id'] + '">' + data['cf_nome_cargo_funcao'] + '</option>');
                    });
                }
            });
        }

        /**seleciona os departamentos */
        function selectDepartamentos() {
            $.ajax({
                url: '<?= site_url('/admin_rh/list_funcionarios_departamento') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="select_departamentos_all"]').empty();
                    $('select[name="select_departamentos_all"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#select_departamentos_all').append('<option value="' + data['id'] + '">' + data['dep_name'] + '</option>');
                    });
                }
            });
        }

         /**seleciona os departamentos */
         function selectAtividades() {
            $.ajax({
                url: '<?= site_url('/admin_rh/list_funcionarios_atividade') ?>',
                method: 'get',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    $('select[name="select_atividades_all"]').empty();
                    $('select[name="select_atividades_all"]').append('<option selected disabled>Selecione aqui...</option>');

                    $.each(response, function(index, data) {
                        $('#select_atividades_all').append('<option value="' + data['id'] + '">' + data['titulo_nome'] + '</option>');
                    });
                }
            });
        }

        $(document).on('click', '.cl_func_view', function() {
            var id = $(this).data('id');
           
            $.ajax({
                url: "<?php echo site_url('/admin_rh/listaDadosColaborador'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {

                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#gender').val(data.gender);

                    $('#usuariosFuncionarioModal').modal('show');
                    $('#hidden_id').val(id);
                }
            })
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            if (confirm("Are you sure you want to remove it?")) {
                $.ajax({
                    url: "<?php echo base_url('/ajax_crud/delete'); ?>",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#message').html(data);
                        $('#lista_funcioanrios_frente').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message').html('');
                        }, 5000);
                    }
                })
            }
        });
    });
</script>