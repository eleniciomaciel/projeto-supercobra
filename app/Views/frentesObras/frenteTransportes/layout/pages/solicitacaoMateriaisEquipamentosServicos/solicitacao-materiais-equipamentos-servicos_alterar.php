<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transposte-solicitacao-material-equipamentos-servicos/solicitacao-mes" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br><br>
        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
            <br>
            <div class="col-12">
                <?php
                if (session()->getFlashdata('success_smes_up')) {
                ?>
                    <div class="hide_up_smes">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                            <?php echo session()->getFlashdata('success_smes_up') ?>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>


            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">SOCITAÇÃO DE MATERIAIS/EQUIPAMENTOS/SERVIÇOS</h3>
                </div>
                <!-- /.card-header -->
                <?php $validation = \Config\Services::validation(); ?>
                <!-- form start -->
                <form action="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/alterarSolicitacao/' . $lista_doc_servicos['smes_id']) ?>" method="POST">
                    <?= csrf_field() ?>

                    <div class="card-body">

                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <label for="s_revisao">REV.</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="">Rev:</span>
                                    </div>
                                    <input type="number" name="s_rev_numero" min="1" class="form-control" placeholder="Ex.: 4" value="<?= esc($lista_doc_servicos['smes_documento_qualidade_revisao_numero']) ?>">

                                    <input type="text" class="form-control" name="s_codigo_revisao" placeholder="Ex.: IGE-5000-003-1-2" value="<?= esc($lista_doc_servicos['smes_documento_qualidade_codigo_revisao']) ?>">

                                </div>
                                <!-- Error -->
                                <?php if ($validation->getError('s_rev_numero')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_rev_numero'); ?>
                                    </div>
                                <?php } ?>
                                <!-- Error -->
                                <?php if ($validation->getError('s_codigo_revisao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_codigo_revisao'); ?>
                                    </div>
                                <?php } ?>
                            </div>


                            <div class="col-md-3 mb-3">
                                <label for="s_data">Data</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="s_data" value="<?= esc($lista_doc_servicos['datetime']) ?>">
                                </div>
                                <!-- Error -->
                                <?php if ($validation->getError('s_data')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_data'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="s_sequencia">Sequência</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><?= esc($user_obra['obras_abreviacao']) ?></span>
                                    </div>
                                    <input type="text" class="form-control" name="s_sequencia" placeholder="Ex.: 0001" value="<?= esc($lista_doc_servicos['smes_sequencia_numerica_original']) ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><?= date('Y') ?></span>
                                    </div>
                                </div>
                                <!-- Error -->
                                <?php if ($validation->getError('s_sequencia')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_sequencia'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-row">


                            <div class="col-md-6 mb-3">
                                <label for="s_local_entrega">Local de Entrega:</label>
                                <input type="text" class="form-control" name="s_local_entrega" placeholder="Ex.: CORINTO-MG" value="<?= esc($lista_doc_servicos['smes_local_entrega']) ?>">
                                <!-- Error -->
                                <?php if ($validation->getError('s_local_entrega')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_local_entrega'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="s_solicitado_por">Solicitado por:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend2"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="s_solicitado_por" placeholder="Ex.: Ana Silva" value="<?= esc($lista_doc_servicos['smes_solicitado_por']) ?>">
                                </div>
                                <!-- Error -->
                                <?php if ($validation->getError('s_solicitado_por')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_solicitado_por'); ?>
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <label for="exampleFormControlTextarea1">Aplicação:</label>
                                <textarea class="form-control" name="s_aplicacao" id="summernote" placeholder="Digite aqui..." rows="3"><?= esc($lista_doc_servicos['smes_aplicacao']) ?></textarea>
                                <!-- Error -->
                                <?php if ($validation->getError('s_aplicacao')) { ?>
                                    <div class='text-danger mt-2'>
                                        <?= $error = $validation->getError('s_aplicacao'); ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="s_obras_abreviacao" value="<?= esc($user_obra['obras_abreviacao']) ?>">
                    <input type="hidden" name="s_usuario_solicitante" value="<?= session()->get('id') ?>">
                    <input type="hidden" name="s_usuario_cargo" value="<?= session()->get('log_cargo') ?>">
                    <input type="hidden" name="s_usuario_frente" value="<?= session()->get('log_frente') ?>">
                    <input type="hidden" name="s_usuario_obra" value="<?= session()->get('log_obra') ?>">
                    <input type="hidden" name="s_usuario_departamento" value="<?= session()->get('log_departamento') ?>">
                    <input type="hidden" name="s_ano_registro" value="<?= date('Y') ?>">

                    <div class="card-footer">
                        <div class="id_btn_solitacao"></div>
                        <button type="submit" class="btn btn-danger" id="btnSubmit">
                            <i class="fas fa-save"></i> Alterar
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>
<script>
    $(document).ready(function() {
        $("#btnSubmit").click(function() {
            $(this).hide();
            $('.id_btn_solitacao').html('<button type="button" class="btn btn-outline-primary" disabled><div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando...</button>');
        });
    });
</script>

<script>
    $(function() {
        // Summernote
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        setTimeout(function() {
            $('.hide_up_smes').html('');
        }, 3000);
    })
</script>
<?= $this->endSection() ?>