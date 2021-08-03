<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_qualidade/home-qualidade" class="btn btn-info"><i class="fas fa-reply-all"></i> Voltar</a>
    <br><br>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrar Documento</h3>
        </div>
        <!-- /.card-header -->
        <?php $validation = \Config\Services::validation(); ?>

        <br>
        <div class="col-12">
            <?php
            if (session()->getFlashdata('success_doc_cadastro')) {
            ?>
                <div class="hide_documentos">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> OK!</h5>
                        <?php echo session()->getFlashdata('success_doc_cadastro') ?>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>


        <!-- form start -->
        <form action="/admin_qualidade/adiciona-documento-qualidade" method="POST">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="doc_descricao">Descrição do Documento</label>
                    <textarea class="form-control" name="doc_descricao" id="summernote2" rows="3" placeholder="Digite aqui..."><?= old('doc_descricao') ?></textarea>
                    <!-- Error -->
                    <?php if ($validation->getError('doc_descricao')) { ?>
                        <div class='text-danger mt-2'>
                            <?= $error = $validation->getError('doc_descricao'); ?>
                        </div>
                    <?php } ?>
                </div>

                <h5>Quando apresentar</h5>
                <br>
                <div class="form-row">

                    <div class="col-9">
                        <label for="">Categoria:</label>
                        <select class="form-control select2bs4" name="doc_categoria" id="doc_categoria">
                            <option selected disabled>Selecione aqui...</option>

                            <?php if (!empty($list_categoria) && is_array($list_categoria)) : ?>
                                <?php foreach ($list_categoria as $news_select_cat) : ?>
                                    <option value="<?= esc($news_select_cat['ql_id']) ?>"><?= esc(strip_tags($news_select_cat['ql_description'])) ?></option>
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
                        <input type="text" name="doc_revisao" class="form-control" placeholder="Ex.: 1" value="<?= old('doc_revisao') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('doc_revisao')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('doc_revisao'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-6">
                        <label for="">Na contratação:</label>
                        <input type="text" name="doc_nacontratacao" class="form-control" placeholder="Ex.: X" value="<?= old('doc_nacontratacao') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('doc_nacontratacao')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('doc_nacontratacao'); ?>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="col-6">
                        <label for="">Periodicamente:</label>
                        <input type="text" name="doc_periodicidade" class="form-control" placeholder="Ex.: Quando revalidados" value="<?= old('doc_periodicidade') ?>">
                        <!-- Error -->
                        <?php if ($validation->getError('doc_periodicidade')) { ?>
                            <div class='text-danger mt-2'>
                                <?= $error = $validation->getError('doc_periodicidade'); ?>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>

            <input type="hidden" name="id_de_quem_cadastra_doc" value="<?= session()->get('id') ?>">
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Salvar
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
    });

    setTimeout(function() {
        $('.hide_documentos').html('');
    }, 2000);

    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    });
</script>
<?= $this->endSection() ?>