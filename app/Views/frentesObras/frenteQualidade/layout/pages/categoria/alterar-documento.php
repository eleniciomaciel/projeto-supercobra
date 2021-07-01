<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_qualidade/home-qualidade" class="btn btn-info"><i class="fas fa-reply-all"></i> Voltar</a>
    <br><br>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Alterar Documento</h3>
        </div>
        <!-- /.card-header -->
        <?php $validation = \Config\Services::validation(); ?>

        <br>
        <div class="col-12">
            <?php
            if (session()->getFlashdata('success_doc_cadastro')) {
            ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                    <?php echo session()->getFlashdata('success_doc_cadastro') ?>
                </div>
            <?php
            }
            ?>
        </div>


        <!-- form start -->
        <form action="/admin_qualidade/alterar-documento-qualidade/<?=esc($dd_doc['qld_id'])?>" method="POST" id="form_add_revisao">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="qld_description">Descrição do Documento</label>
                    <textarea class="form-control" name="qld_description" id="summernote2" rows="3" placeholder="Digite aqui..."><?=esc($dd_doc['qld_description'])?></textarea>
                    <!-- Error -->
                    <?php if ($validation->getError('qld_description')) { ?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('qld_description'); ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="form-row">

                    <div class="col-9">
                        <label for="">Categoria:</label>
                        <select class="form-control" name="doc_categoria" id="doc_categoria">
                            <option selected disabled>Selecione aqui...</option>

                            <?php if (!empty($list_categoria) && is_array($list_categoria)) : ?>
                                <?php foreach ($list_categoria as $news_select_cat) : ?>
                                    <option value="<?= esc($news_select_cat['ql_id'])?>" <?php if($news_select_cat['ql_id'] == $dd_doc['qld_fk_categoria']){echo 'selected';}?>><?= esc(strip_tags($news_select_cat['ql_description'])) ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option selected disabled>Sem categoria registradas</option>
                            <?php endif ?>
                        </select>
                        <!-- Error -->
                        <?php if ($validation->getError('doc_categoria')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('doc_categoria'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-3">
                        <label for="">Nº da revisão:</label>
                        <input type="number" name="qld_versao" id="qld_versao" class="form-control" placeholder="Ex.: 1" value="<?=esc($dd_doc['qld_versao'])?>">
                        <!-- Error -->
                        <?php if ($validation->getError('qld_versao')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('qld_versao'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="value_original" value="<?=esc($dd_doc['qld_versao'])?>">

                    <div class="col-6">
                        <label for="">Na contratação:</label>
                        <input type="text" name="qld_contratacao" class="form-control" placeholder="Ex.: X" value="<?=esc($dd_doc['qld_contratacao'])?>">
                        <!-- Error -->
                        <?php if ($validation->getError('qld_contratacao')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('qld_contratacao'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-6">
                        <label for="">Periodicamente:</label>
                        <input type="text" name="qld_periodicamente" class="form-control" placeholder="Ex.: Quando revalidados" value="<?=esc($dd_doc['qld_periodicamente'])?>">
                        <!-- Error -->
                        <?php if ($validation->getError('qld_periodicamente')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('qld_periodicamente'); ?>
                            </div>
                        <?php } ?>
                    </div>

<hr>
                    <div class="form-group col-12">
                    <label for="porquemuda">Por que muda?</label>
                    <textarea class="form-control" name="porquemuda" id="porquemuda" rows="3"><?=esc($dd_doc['qld_justifica'])?></textarea>
                    <!-- Error -->
                    <?php if ($validation->getError('porquemuda')) { ?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('porquemuda'); ?>
                        </div>
                    <?php } ?>
                </div>

                </div>
            </div>

            <input type="hidden" name="id_de_quem_altera" value=" <?= session()->get('id') ?>">
            <input type="hidden" name="id_documento" value="<?=esc($dd_doc['qld_id'])?>">
            <!-- /.card-body -->
            <!-- /.ORIGINAIS -->
            <input type="hidden" name="descricao" value="<?=esc($dd_doc['qld_description'])?>">
            <input type="hidden" name="versao" value="<?=esc($dd_doc['qld_versao'])?>">
            <input type="hidden" name="id_processo" value="<?=esc($dd_doc['qld_id'])?>">
            <input type="hidden" name="ultima_mudanca" value="<?=esc($dd_doc['updated_at'])?>">
            <input type="hidden" name="justificativa_anterior" value="<?=esc($dd_doc['qld_justifica'])?>">

            <div class="card-footer">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-save"></i> Alterar
                </button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<?= $this->endSection() ?>
<?= $this->section('script_toast_transporte') ?>
<script>
    $(function() {
        // Summernote
        $('#summernote2').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        })
        $('#porquemuda').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        })
    });

    $('#form_add_revisao').ready(function(){
        var vl_origin = $('#value_original').val();
        var vl_input = $('#qld_versao').val();
        if (vl_input <= vl_origin ) {
            document.getElementById("s").innerHTML = "O valor da revisão não pode ser menor e nem igual que a revisão atual!";
            return false
        }

    });
</script>
<?= $this->endSection() ?>