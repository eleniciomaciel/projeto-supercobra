<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">

    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Cadastro da empresa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?= form_open('Transporte/FornecedorNovoController/alteraCadastraEmpresa', array('id' => 'form_empresa_up')) ?>
        <div class="card-body">

            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="empr_nome">Razão Social/Nome</label>
                    <input type="text" class="form-control" name="empr_nome" id="empr_nome" value="<?= esc($dd_empresa['ef_razao_social']) ?>" placeholder="Ex.: Consócios Carros">
                    <span class="text-danger error-text empr_nome_error"></span>
                </div>
            </div>

            <div class="form-row">

                <div class="form-group col-md-6">
                    <label for="enpr_cnae">CNAE:</label>
                    <input type="text" class="form-control" name="enpr_cnae" id="enpr_cnae" placeholder="Ex.: 12..33" value="<?= esc($dd_empresa['ef_cnae']) ?>">
                    <span class="text-danger error-text enpr_cnae_error"></span>
                </div>

                <div class="form-group col-md-6">
                    <label for="enpr_classificacao_empresa">Classificação Empresarial</label>
                    <select class="form-control" name="enpr_classificacao_empresa" id="enpr_classificacao_empresa">
                        <option value="Empresa de Pequeno Porte (EPP)" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'Empresa de Pequeno Porte (EPP)') {
                                                                            echo 'selected';
                                                                        } ?>>Empresa de Pequeno Porte (EPP)</option>
                        <option value="Empresário Individual" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'Empresário Individual') {
                                                                    echo 'selected';
                                                                } ?>>Empresário Individual</option>
                        <option value="EIRELI" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'EIRELI') {
                                                    echo 'selected';
                                                } ?>>EIRELI</option>
                        <option value="Microempresa (ME)" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'Microempresa (ME)') {
                                                                echo 'selected';
                                                            } ?>>Microempresa (ME)</option>
                        <option value="Microempreendedor individual – MEI" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'Microempreendedor individual – MEI') {
                                                                                echo 'selected';
                                                                            } ?>>Microempreendedor individual – MEI</option>
                        <option value="Sociedade Limitada" <?php if ($dd_empresa['ef_classificacao_empresa'] == 'Sociedade Limitada') {
                                                                echo 'selected';
                                                            } ?>>Sociedade Limitada</option>
                    </select>
                    <span class="text-danger error-text enpr_classificacao_empresa_error"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="empre_cnpj">CNPJ:</label>
                    <input type="text" class="form-control" name="empre_cnpj" id="empre_cnpj" placeholder="00.000.000/0001-00" value="<?= esc($dd_empresa['ef_cnpj']) ?>">
                    <span class="text-danger error-text empre_cnpj_error"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="empr_incricao_estadual">Inscrição Estadual</label>
                    <input type="text" class="form-control" name="empr_incricao_estadual" id="empr_incricao_estadual" placeholder="Ex.: 1234567890" value="<?= esc($dd_empresa['ef_incricao_estadual']) ?>">
                    <span class="text-danger error-text empr_incricao_estadual_error"></span>
                </div>

                <div class="form-group col-md-4">
                    <label for="empr_incricao_municiapl">Inscrição Municipal</label>
                    <input type="text" class="form-control" name="empr_incricao_municiapl" id="empr_incricao_municiapl" placeholder="Ex.: 1234567890" value="<?= esc($dd_empresa['ef_incricao_municial']) ?>">
                    <span class="text-danger error-text empr_incricao_municiapl_error"></span>
                </div>

                <div class="form-group col-md-3">
                    <label for="empr_cep">CEP:</label>
                    <input type="text" class="form-control" name="empr_cep" id="empr_cep" placeholder="00.000-000" value="<?= esc($dd_empresa['ef_cep']) ?>">
                    <span class="text-danger error-text empr_cep_error"></span>
                </div>
                <div class="form-group col-md-2">
                    <label for="empr_uf">UF:</label>
                    <input type="text" class="form-control" name="empr_uf" id="empr_uf" placeholder="Ex.: MG" value="<?= esc($dd_empresa['ef_uf']) ?>">
                    <span class="text-danger error-text empr_uf_error"></span>
                </div>
                <div class="form-group col-md-7">
                    <label for="empr_cidade">Cidade:</label>
                    <input type="text" class="form-control" name="empr_cidade" id="empr_cidade" value="<?= esc($dd_empresa['ef_cidade']) ?>" placeholder="Ex.: Ana Silva">
                    <span class="text-danger error-text empr_cidade_error"></span>
                </div>

                <div class="form-group col-md-5">
                    <label for="empr_bairro">Bairro:</label>
                    <input type="text" class="form-control" name="empr_bairro" id="empr_bairro" placeholder="Ex.: Centro" value="<?= esc($dd_empresa['ef_bairro']) ?>">
                    <span class="text-danger error-text empr_bairro_error"></span>
                </div>

                <div class="form-group col-md-7">
                    <label for="empr_endereco">Endereço:</label>
                    <input type="text" class="form-control" name="empr_endereco" id="empr_endereco" placeholder="Ex.: Rua Ana Maria" value="<?= esc($dd_empresa['ef_endereco']) ?>">
                    <span class="text-danger error-text empr_endereco_error"></span>
                </div>

                <div class="form-group col-12">
                    <label for="empr_observacao">Observação:</label>
                    <textarea class="form-control" name="empr_observacao" id="empr_observacao" placeholder="Digite aqui..." rows="3"> <?= esc($dd_empresa['ef_description']) ?></textarea>
                    <span class="text-danger error-text empr_observacao_error"></span>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <input type="hidden" name="id_empresa_cadastro" value="<?= esc($dd_empresa['ef_id']) ?>">

        <div class="card-footer">
            <button type="submit" class="cls_add_empresa_update btn btn-danger" id="btn_add_empresa_update">
                <i class="fas fa-save"></i> Alterar
            </button>
        </div>
        </form>

    </div>

</section>


<?= $this->endSection() ?>
<?= $this->section('script_dados_empresa') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#fort_cep').mask("00.000-000", {
            placeholder: "00.000-000"
        });
        $('#fort_cpf').mask("000.000-000-00", {
            placeholder: "000.000-000-00"
        });

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#fort_endereco").val("");
            $("#fort_bairro").val("");
            $("#fort_cidade").val("");
            $("#fort_uf").val("");
            $("#ibge").val("");
        }

        //Quando o campo cep perde o foco.
        $("#fort_cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#fort_endereco").val("...");
                    $("#fort_bairro").val("...");
                    $("#fort_cidade").val("...");
                    $("#fort_uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#fort_endereco").val(dados.logradouro);
                            $("#fort_bairro").val(dados.bairro);
                            $("#fort_cidade").val(dados.localidade);
                            $("#fort_uf").val(dados.uf);
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
    });
</script>

<script>
    $(document).ready(function() {

        $("#form_empresa_up").submit(function(e) {
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
                    $('#btn_add_empresa_update').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...');
                    $('.cls_add_empresa_update').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_empresa_update').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_empresa_update').attr('disabled', false);
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
    function forceInputUppercase(e) {
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        e.target.value = e.target.value.toUpperCase();
        e.target.setSelectionRange(start, end);
    }

    document.getElementById("fort_name").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_bairro").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_endereco").addEventListener("keyup", forceInputUppercase, false);
    document.getElementById("fort_observacao").addEventListener("keyup", forceInputUppercase, false);
</script>

<?= $this->endSection() ?>