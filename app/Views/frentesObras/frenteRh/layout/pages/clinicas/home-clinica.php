<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->

    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-id-card"></i> <?= esc($title) ?>
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-clinic-medical"></i> Clínicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-clipboard"></i> Cadastrar</a>
                    </li>
                </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart">
                    <div class="chartjs-size-monitor">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap" id="list_clinicas_frentes" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Clínica</th>
                                                    <th>Telefone</th>
                                                    <th>Email</th>
                                                    <th>Cidade</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>

                    </div>
                </div>

                <div class="chart tab-pane" id="sales-chart">
                    <div class="chartjs-size-monitor">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Dados da Clínica</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/exames/cadastra-clinica" method="POST" id="forn_add_clinica">
                                <?= csrf_field() ?>
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="clinica_nome">Nome Fantasia da Clinica</label>
                                        <input type="text" class="form-control" name="clinica_nome" placeholder="Ex.: Clínica do Trabalho">
                                        <span id="clinica_nome_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="clinica_responsavel">Nome do responsável</label>
                                        <input type="text" class="form-control" name="clinica_responsavel" placeholder="Ex.: João Dias">
                                        <span id="clinica_responsavel_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="cli_email">Email:</label>
                                            <input type="email" class="form-control" name="clinica_email" placeholder="Ex.: clinica@email.com">
                                            <span id="clinica_email_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="cli_tel">Telefone:</label>
                                            <input type="tel" class="form-control" name="clinica_tel" id="clinica_tel">
                                            <span id="clinica_tel_error" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="cli_cnpj">CNPJ</label>
                                            <input type="text" class="form-control" name="clinica_cnpj" id="clinica_cnpj">
                                            <span id="clinica_cnpj_error" class="text-danger"></span>
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label for="inputZip">Cep:</label>
                                            <input type="text" class="form-control" name="clinica_cep" id="clinica_cep">
                                            <span id="clinica_cep_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="inputState">UF</label>
                                            <input type="text" class="form-control" name="clinica_uf" id="clinica_uf" readonly>
                                            <span id="clinica_uf_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="inputCity">Cidade</label>
                                            <input type="text" class="form-control" name="clinica_city" id="clinica_city" readonly>
                                            <span id="clinica_city_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="cli_tel">Bairro:</label>
                                            <input type="tel" class="form-control" name="clinica_bairro" id="clinica_bairro">
                                            <span id="clinica_bairro_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="cli_cnpj">Endereço:</label>
                                            <input type="text" class="form-control" name="clinica_endereco" id="clinica_endereco">
                                            <span id="clinica_endereco_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-12">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="seg" id="seg" value="seg" checked>
                                                <label class="form-check-label" for="inlineCheckbox1">Segunda feira:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="ter" id="ter" value="ter" checked>
                                                <label class="form-check-label" for="inlineCheckbox2">Terça feira:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="qua" value="qua" id="qua" checked>
                                                <label class="form-check-label" for="inlineCheckbox3">Quarta feira:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="qui" id="qui" value="qui" checked>
                                                <label class="form-check-label" for="inlineCheckbox3">Quinta feira:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="sex" id="sex" value="sex" checked>
                                                <label class="form-check-label" for="inlineCheckbox3">Sexta feira:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="sab" id="sab" value="sab">
                                                <label class="form-check-label" for="inlineCheckbox3">Sábado:</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="dom" id="dom" value="dom">
                                                <label class="form-check-label" for="inlineCheckbox3">Domingo:</label>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="clinica_observacao">Observações</label>
                                            <textarea class="form-control" name="clinica_observacao" id="clinica_observacao" rows="3"></textarea>
                                            <span id="clinica_observacao_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="clinica_frente" value="<?= session()->get('log_frente') ?>">
                                <div class="card-footer">
                                    <button type="submit" class="cls_add_clinica btn btn-primary" id="id_add_clinica">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                            <br>
                            <span id="message_add_clinica"></span>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->


    <!-- Modal -->
    <div class="modal fade" id="modalClinica" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Cadastro da Clínica</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dados da Clínica</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="/exames/cadastra_altera_clinica" method="POST" id="forn_altera_clinica_one">
                            <?= csrf_field() ?>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="clinica_nome">Nome Fantasia da Clinica</label>
                                    <input type="text" class="form-control" name="cli_nome" id="cli_nome" placeholder="Ex.: Clínica do Trabalho">
                                    <span id="cli_nome_x_error" class="text-danger"></span>
                                </div>

                                <div class="form-group">
                                    <label for="cli_responsavel">Nome do responsável</label>
                                    <input type="text" class="form-control" name="cli_responsavel" id="cli_responsavel" placeholder="Ex.: João Dias">
                                    <span id="cli_responsavel_responsavel_x_error" class="text-danger"></span>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="cli_email">Email:</label>
                                        <input type="email" class="form-control" name="cli_email" id="cli_email" placeholder="Ex.: clinica@email.com">
                                        <span id="cli_email_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cli_telefone">Telefone:</label>
                                        <input type="tel" class="form-control" name="cli_telefone" id="cli_telefone">
                                        <span id="cli_telefone_x_error" class="text-danger"></span>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cli_cnpj">CNPJ</label>
                                        <input type="text" class="form-control" name="cli_cnpj" id="cli_cnpj">
                                        <span id="cli_cnpj_x_error" class="text-danger"></span>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-2">
                                        <label for="cli_cep">Cep:</label>
                                        <input type="text" class="form-control" name="cli_cep" id="cli_cep">
                                        <span id="cli_cep_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="cli_estado">UF</label>
                                        <input type="text" class="form-control" name="cli_estado" id="cli_estado" readonly>
                                        <span id="cli_estado_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cli_cidade">Cidade</label>
                                        <input type="text" class="form-control" name="cli_cidade" id="cli_cidade" readonly>
                                        <span id="cli_cidade_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cli_bairro">Bairro:</label>
                                        <input type="tel" class="form-control" name="cli_bairro" id="cli_bairro">
                                        <span id="cli_bairro_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="cli_endereco">Endereço:</label>
                                        <input type="text" class="form-control" name="cli_endereco" id="cli_endereco">
                                        <span id="cli_endereco_x_error" class="text-danger"></span>
                                    </div>

                                    <div class="form-group col-md-12">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_1" id="cli_dias_1" value="seg">
                                            <label class="form-check-label" for="inlineCheckbox1">Segunda feira:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_2" id="cli_dias_2" value="ter">
                                            <label class="form-check-label" for="inlineCheckbox2">Terça feira:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_3" id="cli_dias_3" value="qua">
                                            <label class="form-check-label" for="inlineCheckbox3">Quarta feira:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_4" id="cli_dias_4" value="qui">
                                            <label class="form-check-label" for="inlineCheckbox3">Quinta feira:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_5" id="cli_dias_5" value="sex">
                                            <label class="form-check-label" for="inlineCheckbox3">Sexta feira:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_6" id="cli_dias_6" value="sab">
                                            <label class="form-check-label" for="inlineCheckbox3">Sábado:</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="cli_dias_7" id="cli_dias_7" value="dom">
                                            <label class="form-check-label" for="inlineCheckbox3">Domingo:</label>
                                        </div>

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="cli_observacoes">Observações</label>
                                        <textarea class="form-control" name="cli_observacoes" id="cli_observacoes" rows="3"></textarea>
                                        <span id="cli_observacoes_x_error" class="text-danger"></span>
                                    </div>

                                    <input type="hidden" name="hidden_id_clinica" id="hidden_id_clinica">

                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="cls_up_clinica btn btn-primary" id="id_up_clinica">
                                    <i class="fa fa-save"></i> Salvar
                                </button>
                            </div>
                        </form>
                        <br>
                        <span id="message_up_clinica"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {
        $('#clinica_tel').mask("(00)0000-0000", {
            placeholder: "(00)0000-0000"
        });
        $('#clinica_cnpj').mask("00.000.000/0001-00", {
            placeholder: "00.000.000/0001-00"
        });
        $('#clinica_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });

        /**via cep */
        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#clinica_endereco").val("");
            $("#clinica_bairro").val("");
            $("#clinica_city").val("");
            $("#clinica_uf").val("");
        }

        //Quando o campo cep perde o foco.
        $("#clinica_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#clinica_endereco").val("...");
                    $("#clinica_bairro").val("...");
                    $("#clinica_city").val("...");
                    $("#clinica_uf").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#clinica_endereco").val(dados.logradouro);
                            $("#clinica_bairro").val(dados.bairro);
                            $("#clinica_city").val(dados.localidade);
                            $("#clinica_uf").val(dados.uf);
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

        $('#list_clinicas_frentes').DataTable({
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
                url: "<?php echo base_url("/exames/lista_clinicas_frentes"); ?>",
                type: "GET",
            }
        });

        /**formulario de cadastro da c~inica */
        $('#forn_add_clinica').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('#id_add_clinica').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_add_clinica').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_add_clinica').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_clinica').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você possuí alguns error que precisam ser corrigidos.',
                            showConfirmButton: false,
                            timer: 2300
                        });
                        $('#clinica_nome_error').text(data.clinica_nome_error);
                        $('#clinica_responsavel_error').text(data.clinica_responsavel_error);
                        $('#clinica_email_error').text(data.clinica_email_error);
                        $('#clinica_tel_error').text(data.clinica_tel_error);
                        $('#clinica_cnpj_error').text(data.clinica_cnpj_error);
                        $('#clinica_cep_error').text(data.clinica_cep_error);
                        $('#clinica_uf_error').text(data.clinica_uf_error);
                        $('#clinica_city_error').text(data.clinica_city_error);
                        $('#clinica_bairro_error').text(data.clinica_bairro_error);
                        $('#clinica_endereco_error').text(data.clinica_endereco_error);
                        $('#clinica_observacao_error').text(data.clinica_observacao_error);

                    } else {
                        $('#message_add_clinica').html(data.message);

                        $('#clinica_nome_error').text('');
                        $('#clinica_responsavel_error').text('');
                        $('#clinica_email_error').text('');
                        $('#clinica_tel_error').text('');
                        $('#clinica_cnpj_error').text('');
                        $('#clinica_cep_error').text('');
                        $('#clinica_uf_error').text('');
                        $('#clinica_city_error').text('');
                        $('#clinica_bairro_error').text('');
                        $('#clinica_endereco_error').text('');
                        $('#clinica_observacao_error').text('');
                        $('#forn_add_clinica')[0].reset();
                        $('#list_clinicas_frentes').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_add_clinica').html('');
                        }, 1500);
                    }
                }
            })
        });

        /**lista dados da clinica */
        $(document).on('click', '.viewClinica', function() {
            var id = $(this).data('id');
            $.ajax({
                url: "<?php echo site_url('/exames/getClinica'); ?>",
                method: "GET",
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: {
                    id: id
                },
                dataType: 'JSON',

                success: function(data) {
                    $('#cli_nome').val(data.cli_nome);
                    $('#cli_responsavel').val(data.cli_responsavel);
                    $('#cli_cnpj').val(data.cli_cnpj);
                    $('#cli_telefone').val(data.cli_telefone);
                    $('#cli_email').val(data.cli_email);
                    $('#cli_cep').val(data.cli_cep);
                    $('#cli_estado').val(data.cli_estado);
                    $('#cli_cidade').val(data.cli_cidade);
                    $('#cli_bairro').val(data.cli_bairro);
                    $('#cli_endereco').val(data.cli_endereco);

                    let day_one = data['cli_dias_1'];
                    if (day_one) {
                        $('#cli_dias_1').attr("checked", "checked");
                    } else {
                        $('#cli_dias_1').removeAttr('checked');
                    }

                    let day_two = data['cli_dias_2'];
                    if (day_two) {
                        $('#cli_dias_2').attr("checked", "checked");
                    } else {
                        $('#cli_dias_2').removeAttr('checked');
                    }

                    let = day_tree = data['cli_dias_3'];
                    if (day_tree) {
                        $('#cli_dias_3').attr("checked", "checked");
                    } else {
                        $('#cli_dias_3').removeAttr('checked');
                    }

                    let day_four = data['cli_dias_4'];
                    if (day_four) {
                        $('#cli_dias_4').attr("checked", "checked");
                    } else {
                        $('#cli_dias_4').removeAttr('checked');
                    }


                    let day_five = data['cli_dias_5'];
                    if (day_five) {
                        $('#cli_dias_5').attr("checked", "checked");
                    } else {
                        $('#cli_dias_5').removeAttr('checked');
                    }


                    let day_six = data['cli_dias_6'];
                    if (day_six) {
                        $('#cli_dias_6').attr("checked", "checked");
                    } else {
                        $('#cli_dias_6').removeAttr('checked');
                    }


                    let day_seven = data['cli_dias_7'];
                    if (day_seven) {
                        $('#cli_dias_7').attr("checked", "checked");
                    } else {
                        $('#cli_dias_7').removeAttr('checked');
                    }


                    $('#cli_observacoes').val(data.cli_observacoes);
                    $('#modalClinica').modal('show');
                    $('#hidden_id_clinica').val(id);
                }
            })
        });

        /**altera dados do cadastro */
        /**formulario de cadastro da c~inica */
        $('#forn_altera_clinica_one').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                data: $(this).serialize(),
                dataType: "JSON",

                beforeSend: function() {
                    $('#id_up_clinica').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Aguarde... </button>');
                    $('.cls_up_clinica').attr('disabled', 'disabled');
                },

                success: function(data) {
                    $('#id_up_clinica').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_up_clinica').attr('disabled', false);

                    if (data.error == 'yes') {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: 'Ops! Você possuí alguns error que precisam ser corrigidos.',
                            showConfirmButton: false,
                            timer: 2300
                        });
                        $('#clinica_nome_x_error').text(data.clinica_nome_x_error);
                        $('#clinica_responsavel_x_error').text(data.clinica_responsavel_x_error);
                        $('#clinica_email_x_error').text(data.clinica_email_x_error);
                        $('#clinica_tel_x_error').text(data.clinica_tel_x_error);
                        $('#clinica_cnpj_x_error').text(data.clinica_cnpj_x_error);
                        $('#clinica_cep_x_error').text(data.clinica_cep_x_error);
                        $('#clinica_uf_x_error').text(data.clinica_uf_x_error);
                        $('#clinica_city_x_error').text(data.clinica_city_x_error);
                        $('#clinica_bairro_x_error').text(data.clinica_bairro_x_error);
                        $('#clinica_endereco_x_error').text(data.clinica_endereco_x_error);
                        $('#clinica_observacao_x_error').text(data.clinica_observacao_x_error);

                    } else {
                        $('#message_up_clinica').html(data.message);
                        $('#list_clinicas_frentes').DataTable().ajax.reload();
                        setTimeout(function() {
                            $('#message_up_clinica').html('');
                        }, 1500);
                    }
                }
            })
        });

        /**delete fake clinica */
        $(document).on('click', '.deleteClinica', function() {
            let id_cli = $(this).data('id');


            Swal.fire({
                title: 'Deseja deletar?',
                text: "Essa ação será de forma permanente!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, deletar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('/exames/delete_clinica'); ?>",
                        method: "GET",
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        data: {
                            id_cli: id_cli
                        },
                        success: function(data) {
                            $('#list_clinicas_frentes').DataTable().ajax.reload();
                            Swal.fire(
                                'OK!',
                                data,
                                'success'
                            );
                        }
                    })
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>