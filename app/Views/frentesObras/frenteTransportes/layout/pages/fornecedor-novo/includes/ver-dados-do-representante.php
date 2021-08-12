<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">

    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Cadastro do Representante</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?=form_open('Transporte/FornecedorNovoController/cadastroAlterarRepresentante', array('id'=>'form_altera_representante'))?>
            <div class="card-body">
                <div class="form-row">

                    <div class="form-group col-md-12">
                        <label for="fort_name">Nome:</label>
                        <input type="text" class="form-control" name="fort_name" id="fort_name" placeholder="Ex.: Ana Silva" value="<?= esc($dd_representante['for_responsavel']) ?>">
                        <span class="text-danger error-text fort_name_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fort_email">Email:</label>
                        <input type="email" class="form-control" name="fort_email" id="fort_email" placeholder="Ex.: ana@email.com" value="<?= esc($dd_representante['for_email']) ?>">
                        <span class="text-danger error-text fort_email_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fort_cpf">CPF:</label>
                        <input type="text" class="form-control" name="fort_cpf" id="fort_cpf" placeholder="000.000-000-00" value="<?= $dd_representante['for_cnpj'] ?>">
                        <span class="text-danger error-text fort_cpf_error"></span>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="fort_telefone">Telefone:</label>
                        <input type="tel" class="form-control" name="fort_telefone" id="fort_telefone" placeholder="Ex.: (00) 3632-9877" value="<?= esc($dd_representante['for_telefone']) ?>">
                        <span class="text-danger error-text fort_telefone_error"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fort_telefone2">Telefone 2:</label>
                        <input type="tel" class="form-control" name="fort_telefone2" id="fort_telefone2" placeholder="Ex.: (00) 3632-9877" value="<?= esc($dd_representante['for_telefone2']) ?>">
                        <span class="text-danger error-text fort_telefone2_error"></span>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="fort_observacao">Observações:</label>
                        <textarea class="form-control" name="fort_observacao" id="fort_observacao" rows="3" placeholder="Digite aqui..."><?= esc($dd_representante['for_description']) ?></textarea>
                        <span class="text-danger error-text fort_observacao_error"></span>
                    </div>

                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_representante_one" value="<?= esc($dd_representante['for_id']) ?>">

                <div class="card-footer">
                    <div class="id_btn_fornecedor"></div>
                    <button type="submit" class="cls_add_representante_one_up btn btn-danger" id="btn_add_representante_one_up">
                        <i class="fas fa-save"></i> Alterar
                    </button>
                </div>
            </div>
        </form>

    </div>

</section>


<?= $this->endSection() ?>
<?= $this->section('script_dados_representante') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.11.2/jquery.mask.min.js" integrity="sha512-Y/GIYsd+LaQm6bGysIClyez2HGCIN1yrs94wUrHoRAD5RSURkqqVQEU6mM51O90hqS80ABFTGtiDpSXd2O05nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $('#fort_cpf').mask("000.000.000-00", {
            placeholder: "000.000.000-00"
        });

        /**
         * cadastro do representante
         */

        $("#form_altera_representante").submit(function(e) {
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
                    $('#btn_add_representante_one_up').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');
                    $('.cls_add_representante_one_up').attr('disabled', 'disabled');
                },
                success: function(data) {
                    $('#btn_add_representante_one_up').html('<i class="fa fa-save"></i> Salvar');
                    $('.cls_add_representante_one_up').attr('disabled', false);
                    if ($.isEmptyObject(data.error)) {
                        if (data.code == 1) {
                            //$(form)[0].reset();
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