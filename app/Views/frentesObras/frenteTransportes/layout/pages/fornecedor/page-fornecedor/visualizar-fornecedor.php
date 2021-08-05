<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transporte-fornecedor/fornecedor" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br><br>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_update_error_cadastro')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Vixe!</h5>
                    <?php echo session()->getFlashdata('fornecedor_update_error_cadastro') ?>
                </div>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="col-12">
        <?php
        if (session()->getFlashdata('fornecedor_update_success')) {
        ?>
            <div class="hide_up_smes">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('fornecedor_update_success') ?>
                </div>
            </div>

        <?php
        }
        ?>
        <br>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-hospital-user mr-1"></i>
                    Painel dos forncedores
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-paste"></i> Dados do fornecedor</a>
                        </li>
                    </ul>
                </div>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="tab-pane active" id="revenue-chart">

                        <!-- /.card-header -->
                        <?php $validation = \Config\Services::validation(); ?>


                        <!-- form start -->
                        <?= form_open('Transporte/FornecedorController/cadstroAlteraFornecedor/'.$dd_fornecedor['for_id']) ?>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="fort_name">Nome:</label>
                                <input type="text" class="form-control" name="fort_name" id="fort_name" placeholder="Ex.: Ana Silva" value="<?= esc($dd_fornecedor['for_responsavel']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_name')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_name'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="for_email">Email:</label>
                                <input type="email" class="form-control" name="for_email" id="for_email" placeholder="Ex.: ana@email.com" value="<?= esc($dd_fornecedor['for_email']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('for_email')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('for_email'); ?>
                                    </div>
                                <?php } ?>
                            </div>


                            <div class="form-group col-md-4">
                                <label for="fort_telefone">Telefone:</label>
                                <input type="tel" class="form-control" name="fort_telefone" id="fort_telefone" placeholder="Ex.: (00) 3632-9877" value="<?= esc($dd_fornecedor['for_telefone']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_telefone')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_telefone'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fort_cpf">CPF:</label>
                                <input type="text" class="form-control" name="fort_cpf" id="fort_cpf" value="<?= esc($dd_fornecedor['for_cnpj']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_cpf')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_cpf'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-3">
                                <label for="fort_cep">CEP:</label>
                                <input type="text" class="form-control" name="fort_cep" id="fort_cep" value="<?= esc($dd_fornecedor['for_cep']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_cep')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_cep'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="fort_uf">UF:</label>
                                <input type="text" class="form-control" name="fort_uf" id="fort_uf" readonly value="<?= esc($dd_fornecedor['for_uf']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_uf')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_uf'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fort_cidade">Cidade:</label>
                                <input type="text" class="form-control" name="fort_cidade" id="fort_cidade" readonly value="<?= esc($dd_fornecedor['for_cidade']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_cidade')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_cidade'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="fort_bairro">Bairro:</label>
                                <input type="text" class="form-control" name="fort_bairro" id="fort_bairro" placeholder="Ex.: Luiz Sena" value="<?= esc($dd_fornecedor['for_bairro']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_bairro')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_bairro'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-8">
                                <label for="fort_endereco">Endereço:</label>
                                <input type="text" class="form-control" name="fort_endereco" id="fort_endereco" placeholder="Ex.:Rua da Matriz, nº 500" value="<?= esc($dd_fornecedor['for_endereco']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('fort_endereco')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_endereco'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="fort_observacao">Observações:</label>
                                <textarea class="form-control" name="fort_observacao" id="fort_observacao" rows="3" placeholder="Digite aqui..."><?= esc($dd_fornecedor['for_description']) ?></textarea>
                                <!-- Error -->
                                <?php if ($validation->getError('fort_observacao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('fort_observacao'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="fort_obra" value="<?= session()->get('log_obra') ?>">
                        <input type="hidden" name="fort_frente" value="<?= session()->get('log_frente') ?>">
                        <input type="hidden" name="fort_usuario" value="<?= session()->get('id') ?>">

                        <div class="card-footer">
                            <div class="id_btn_fornecedor"></div>
                            <button type="submit" class="btn btn-danger" id="btnSubmit_Fornecedor">
                                <i class="fas fa-save"></i> Alterar
                            </button>
                        </div>
                        </form>

                    </div>
                </div>
            </div><!-- /.card-body -->
        </div>

</section>


<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
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
    $(function() {
        setTimeout(function() {
            $('.hide_up_smes').html('');
        }, 3000);
    })
</script>
<script>
    $(document).ready(function() {
        $("#btnSubmit_Fornecedor").click(function() {
            $(this).hide();
            $('.id_btn_fornecedor').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Alterando, aguarde...</button>');
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