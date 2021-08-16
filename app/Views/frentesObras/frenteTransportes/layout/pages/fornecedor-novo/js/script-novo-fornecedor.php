<script>
    $(document).ready(function() {
        $('#empr_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#empre_cnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
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
         * lista ajax empresa
         */
        $('#lista_empresas_em_search').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [],
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("Transporte/FornecedorNovoController/consultaEmpresas"); ?>",
                type: "GET",
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
                            $('#lista_empresas_em_search').DataTable().ajax.reload();
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
    });
</script>
<script>
    function forceInputUppercase(e) {
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.setSelectionRange(start, end);
    }

    document.getElementById("empr_observacao").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("empr_nome").addEventListener("keyup", forceInputUppercase, false);
</script>

<script>
    $(document).ready(function() {
        $('#fort_cpf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });

        /**
         * cadastro do representante
         */

        $("#form_representante").submit(function(e) {
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
                    $('#btn_add_representante').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_representante').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_representante').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_representante').attr('disabled', false);
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

    });
</script>

<script>
    $(document).ready(function() {

        $('#fort_cpf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });

        /**
         *
         * lista registro das empresas
         */

        $('#list_empresas_fornacedores_findAll').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [0, "desc"],
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url("Transporte/FornecedorNovoController/listaFornecedorEmpresas"); ?>",
                type: "GET",
            }
        });

        $('#postsBanco').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
        });
        /**
         * consulta empresas
         */

        $(function() {
            $("#search_empresa_cnpj").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '<?php echo base_url('Transporte/FornecedorNovoController/consultaEmpresa'); ?>',
                        type: "GET",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        delay: 2000,
                        success: function(data) {
                            if (data.length < 1) {
                                var data = [{
                                    label: 'Empresa não encontrado',
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
                        $('#search_empresa_cnpj').val(ui.item.id);
                        $('#userid_hide').val(ui.item.id);
                        //window.location.href = '<?= site_url('transporte-fornecedor/empresas-fornecedor') ?>' +'/'+ ui.item.id;
                    }
                }
            });
        });

        /**
         * consulta representante consultaCpf
         */

        $(function() {
            $("#search_representante").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '<?php echo base_url('Transporte/FornecedorNovoController/consultaCpf'); ?>',
                        type: "GET",
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        delay: 2000,
                        success: function(data) {
                            if (data.length < 1) {
                                var data = [{
                                    label: 'Representante não encontrado',
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
                        $('#search_representante').val(ui.item.id);
                        $('#userid_representante_hide').val(ui.item.id);
                        //window.location.href = '<?= site_url('transporte-fornecedor/empresas-fornecedor') ?>' +'/'+ ui.item.id;
                    }
                }
            });
        });


        /**
         * cadastra empresas e representantes
         */
        $("#form_auxiluiar").submit(function(e) {
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
                    $('#btn_add_empresa_representante').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_empresa_representante').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_empresa_representante').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_empresa_representante').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();
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
         * cadastro banco e lista banco
         */
        $(document).on('click', '.empresacontaBanco', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getListaEmpresaBancos'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    let empresa_nome = data['ef_razao_social'];
                    $('#razao_empresa').html(empresa_nome);

                    $('#listaCadastroBancoModal').modal('show');
                    $('#hidden_id_empresaConta').val(data.faer_fk_empresa);
                    let param = data['faer_fk_empresa']
                    lerBanco(param)
                }

            })
        });

        /**
         * lista conta da empresa
         */
        function lerBanco(param) {
            $.ajax({
                url: "<?php echo base_url("Transporte/FornecedorNovoController/viewBanco"); ?>",
                type: "GET",
                cache: false,
                data: {
                    param: param
                },
                success: function(dataResult) {
                    $("#table_data").html(dataResult);
                }
            });
        };

        /**
         * cadastra conta bancaria da empresa
         */
        $("#form_add_cb").submit(function(e) {
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
                    $('#btn_add_conta_empresa').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_conta_empresa').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_conta_empresa').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_conta_empresa').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            $(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();
                            //$('#postsBanco').DataTable().ajax.reload();
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
         * lista dados do banco
         */
        $(document).on('click', '.meuBancoGet', function() {

            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getDadosBanco'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#cbf_banco').val(data.cbf_banco);
                    $('#cbf_tipo_conta').val(data.cbf_tipo_conta);
                    $('#cbf_agencia').val(data.cbf_agencia);
                    $('#cbf_numero_conta').val(data.cbf_numero_conta);
                    $('#cbf_digito_conta').val(data.cbf_digito_conta);
                    $('#cbf_Observacoes_conta').val(data.cbf_Observacoes_conta);
                    $('#bancoVerAlterarModal').modal('show');
                    $('#hidden_id_banco_alterar').val(id);
                }

            })
        });

        /**
         * cadastra conta bancaria da empresa
         */
        $("#form_update_cb").submit(function(e) {
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
                    $('#btn_add_conta_empresa_up').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_conta_empresa_up').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_conta_empresa_up').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_conta_empresa_up').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();

                            $('#bancoVerAlterarModal').modal('hide');
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
         * delete conta
         */
        $(document).on('click', '.delBanco', function() {

            let id = $(this).data('id');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo base_url('Transporte/FornecedorNovoController/deleteBanco'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            )
                            $('#bancoVerAlterarModal').modal('hide');
                        }
                    });
                }
            });
        });


        /**
         * sobe modal documentos
         */
        $(document).on('click', '.empreaDocumentos', function() {
            var id_empresa_doc = $(this).data('id');
            $('#edocEmpresasModal').modal('show');
            $('#hidden_id_empresa_doc').val(id_empresa_doc);
            lerDocumentosEmpresa(id_empresa_doc)
        });

        /**
         * inserir documentos no cadastro
         */
        // Ajax form submission with image

        $('#id_inserirDocumentoEmpresa').on('submit', function(e) {

            e.preventDefault();
            var parametro = $("input[name='hidden_id_empresa_doc']").val();
            if ($('#profileImage').val() == '') {
                alert("Selecione uma imagem por favor.");
                document.getElementById("id_inserirDocumentoEmpresa").reset();
                return false;
            } else {
                $.ajax({
                    url: "<?php echo base_url('Transporte/FornecedorNovoController/inserirDocumentoEmpresa'); ?>",
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#btn_add_doc_upload').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                        $('.cls_add_doc_upload').attr('disabled', 'disabled');
                    },
                    success: function(res) {
                        console.log(res.success);
                        if (res.success == true) {
                            $('#alertMsg').html(res.msg);
                            $('#alertMessage').show();
                        } else if (res.success == false) {
                            $('#alertMsg').html(res.msg);
                            $('#alertMessage').show();
                        }

                        setTimeout(function() {
                            $('#alertMsg').html('');
                            $('#alertMessage').hide();
                        }, 4000);

                        $('#btn_add_doc_upload').html('<i class="fa fa-save"></i> Salvar');
                        $('.cls_add_doc_upload').attr('disabled', false);
                        document.getElementById("id_inserirDocumentoEmpresa").reset();
                        lerDocumentosEmpresa(parametro);
                    }
                });
            }
        });

        /**
         * lista documentos da empresa
         */

        function lerDocumentosEmpresa(param) {

            $.ajax({
                url: "<?php echo base_url("Transporte/FornecedorNovoController/getDocumentosempesa"); ?>",
                type: "GET",
                cache: false,
                data: {
                    param: param
                },
                success: function(dataResult) {

                    $("#table_data_documentos_empresa").html(dataResult);
                }
            });
        };

        /**
         * delete dados documento
         */
        $(document).on('click', '.delDucumentoOne_ss', function() {
            var id = $(this).data('id');
            var iddoc = $(this).data('iddoc');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar o procedimento isso será definitivo!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/FornecedorNovoController/deleteDocOneEMpresa_ss'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                            lerDocumentosEmpresa(iddoc);
                        }
                    });
                }
            });
        });

        /**
         * delete auxiliar
         */
        $(document).on('click', '.empresaDelete', function() {
            let id = $(this).data('id');

            Swal.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar o procedimento isso será definitivo!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/FornecedorNovoController/deleteEmpresaAuxiliar'); ?>",
                        method: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'OK',
                                data,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });

    });
</script>

<script>
    /**
     * mascara dos formularios
     */
    $(function() {
        $('#query_company').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });

        $('#consult_representative').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });
    });

    /**
     * sonculta empresa
     */
    $(function() {
        $("#query_company").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo base_url('Transporte/FornecedorNovoController/consultaEmpresa'); ?>',
                    type: "GET",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    delay: 2000,
                    success: function(data) {
                        if (data.length < 1) {
                            var data = [{
                                label: 'Empresa não encontrado',
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
                    window.location.href = '<?= site_url('transporte-novo-fornecedor/dados-da-empresa') ?>' + '/' + ui.item.id;
                }
            }
        });
    });


    /**
     * consulta representantes
     */
    $(function() {
        $("#consult_representative").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo base_url('Transporte/FornecedorNovoController/consultaCpf'); ?>',
                    type: "GET",
                    data: {
                        term: request.term
                    },
                    dataType: "json",
                    delay: 2000,
                    success: function(data) {
                        if (data.length < 1) {
                            var data = [{
                                label: 'Representante não encontrado',
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
                    '',
                    window.location.href = '<?= site_url('transporte-novo-fornecedor/dados-do-representante') ?>' + '/' + ui.item.id;
                }
            }
        });

        /**
         * lista daado da empresa visualizar
         */
        $(document).on('click', '.empresaConsultaVer', function() {

            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getOneEmpresa'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    let razao_nome = data['ef_razao_social'];
                    $('#ef_razao_social_x').html(razao_nome);

                    let clasifficacao = data['ef_classificacao_empresa'];
                    $('#classificacao_empresa').html(clasifficacao);

                    let cnpj = data['ef_cnpj'];
                    $('#cnpj').html(cnpj);

                    let insc_estudual = data['ef_incricao_estadual'];
                    $('#incricao_estadual').html(insc_estudual);

                    let insc_municipal = data['ef_incricao_municial']
                    $('#incricao_municial').html(insc_municipal);

                    let cep = data['ef_cep'];
                    $('#cep').html(cep);

                    let ef_uf = data['ef_uf'];
                    $('#uf').html(ef_uf);

                    let ef_cidade = data['ef_cidade'];
                    $('#ef_cidade').html(ef_cidade);

                    let ef_bairro = data['ef_bairro'];
                    $('#ef_bairro').html(ef_bairro);

                    let ef_endereco = data['ef_endereco'];
                    $('#endereco').html(ef_endereco);


                    $('#ef_description').val(data.ef_description);

                    $('#empresaEyeModal').modal('show');
                    $('#hidden_id_banco_alterar').val(id);

                    lerDonosEmpresa(id);
                }

            })
        });

        /**
         * lista dados dos donos da empresa
         */
        function lerDonosEmpresa(param) {

            $.ajax({
                url: "<?php echo base_url("Transporte/FornecedorNovoController/getDonosEmpresa"); ?>",
                type: "GET",
                cache: false,
                data: {
                    param: param
                },
                success: function(dataResult) {

                    $("#table_data_donos_empresa").html(dataResult);
                }
            });
        };

        /**
         * opções de alterações dados empresa radio button
         */
        $(document).on('click', '.empreaConsultaEditar', function() {

            let id = $(this).data('id');
            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getOneEmpresa'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#form_button_radio')[0].reset();
                    $('#hidden_id_alteraEmpresa').val(id);
                    $('#hidden_id_altera_representante').val(id);
                    $('#editarAlteracoesCrudModal').modal('show');
                }

            })
        });


        /**
         * seleciona dados da empresa para alterar
         */

        $(document).on('click', '.editEmployerOne', function() {

            let id = $(this).attr("value");

            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getOneEmpresa'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {

                    $('#new_responsavel').val(data.ef_razao_social);
                    $('#new_ef_cnae').val(data.ef_cnae);
                    $('#new_ef_classificacao_empresa').val(data.ef_classificacao_empresa);
                    $('#new_ef_cnpj').val(data.ef_cnpj);
                    $('#new_ef_incricao_estadual').val(data.ef_incricao_estadual);
                    $('#new_ef_incricao_municial').val(data.ef_incricao_municial);
                    $('#new_ef_cep').val(data.ef_cep);
                    $('#new_ef_uf').val(data.ef_uf);
                    $('#new_ef_cidade').val(data.ef_cidade);
                    $('#new_ef_bairro').val(data.ef_bairro);
                    $('#new_ef_endereco').val(data.ef_endereco);
                    $('#new_ef_description').val(data.ef_description);
                    $('#hidden_id_empresa_onde').val(id);
                    $('#dadosEMpresaEditOptionModal').modal('show');
                    $('#form_button_radio')[0].reset();
                }

            })
        });

        /**
         * altera dados da empresa
         */
        $("#form_update_new_empresa_100").submit(function(e) {
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
                    $('#btn_new_empresa_100').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_new_empresa_100').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_new_empresa_100').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_new_empresa_100').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();

                            $('#bancoVerAlterarModal').modal('hide');
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
         * opções de alterações dados empresa radio button
         */
        $(document).on('click', '.editMultipleOneRepresentanteOne', function() {

            let id = $(this).attr("value");

            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getOneEmpresa'); ?>",
                method: "GET",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#form_button_radio')[0].reset();

                    let myEmpresa = data['ef_razao_social'];
                    $('#minha_empresa').html(myEmpresa);

                    $('#hidden_id_alteraEmpresa').val(id);
                    $('#hidden_id_altera_representante').val(id);
                    listRepresentatividade(id)
                    $('#selecionaDadosRepresentanteSelect').modal('show');
                }
            })
        });

        /**
         * função que lista no select os representantes das empresas
         */
        function listRepresentatividade(param) {
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getSelectRepresentantes'); ?>" + '/' + param,
                success: function(res) {
                    if (res) {
                        $("#selectDinamycRepresents").empty();
                        $("#selectDinamycRepresents").append('<option>Selecione aqui...</option>');
                        var dataObj = jQuery.parseJSON(res);
                        if (dataObj) {
                            $(dataObj).each(function() {
                                $("#selectDinamycRepresents").append('<option value="' + this.for_id + '">' + this.for_responsavel + '</option>');
                            });
                        } else {
                            $("#selectDinamycRepresents").empty();
                        }
                    } else {
                        $("#selectDinamycRepresents").empty();
                    }
                }
            });
        }


        /**
         * lista dados dos representantes quando alterado no cotão de select
         */

        $('#selectDinamycRepresents').change(function() {
            var countryID = $(this).val();

            $.ajax({
                url: "<?php echo base_url('Transporte/FornecedorNovoController/getRepresentsOneList'); ?>" + '/' + countryID,
                method: "GET",
                data: {
                    countryID: countryID
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#new_resp').val(data.for_responsavel);
                    $('#new_resp_email').val(data.for_email);
                    $('#new_resp_cpf').val(data.for_cnpj);
                    $('#new_resp_telefone1').val(data.for_telefone);
                    $('#new_resp_relefone2').val(data.for_telefone2);
                    $('#new_resp_descricao').val(data.for_description);
                    $('#new_up_resp_id_represents').val(data.for_id);
                }
            });
        });

        /**
         * altera dados do representasnte
         */
        $("#form_new_represets_altera1001").submit(function(e) {
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
                    $('#btn_new_represets_1001').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...');
                    $('.cls_new_represents_100').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_new_represets_1001').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_new_represents_100').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
                            Swal.fire(
                                'OK!',
                                data.msg,
                                'success'
                            );
                            $('#list_empresas_fornacedores_findAll').DataTable().ajax.reload();

                            $('#bancoVerAlterarModal').modal('hide');
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


        // <div class="overlay">
        //     <i class="fas fa-2x fa-sync fa-spin"></i>
        // </div>
    });
</script>