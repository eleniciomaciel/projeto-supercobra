<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_qualidade/home-qualidade" class="btn btn-info"><i class="fas fa-reply-all"></i> Voltar</a>
    <br><br>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Visualização do Documento</h3>
        </div>

        <!-- form start -->
        <form>
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="qld_description">Descrição do Documento</label>
                    <textarea class="form-control" name="qld_description" id="summernote2" rows="3" placeholder="Digite aqui..."><?=esc($dd_doc['qld_description'])?></textarea>
                </div>

                <h5>Quando apresentar</h5>
                <br>
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
                        
                    </div>

                    <div class="col-3">
                        <label for="">Nº da revisão:</label>
                        <input type="text" name="qld_versao" class="form-control" placeholder="Ex.: 1" value="<?=esc($dd_doc['qld_versao'])?>">
                        
                    </div>

                    <div class="col-6">
                        <label for="">Na contratação:</label>
                        <input type="text" name="qld_contratacao" class="form-control" placeholder="Ex.: X" value="<?=esc($dd_doc['qld_contratacao'])?>">
                        
                    </div>

                    <div class="col-6">
                        <label for="">Periodicamente:</label>
                        <input type="text" name="qld_periodicamente" class="form-control" placeholder="Ex.: Quando revalidados" value="<?=esc($dd_doc['qld_periodicamente'])?>">
                        
                    </div>

                </div>
            </div>

            <!-- /.card-body -->
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
    })
</script>
<?= $this->endSection() ?>