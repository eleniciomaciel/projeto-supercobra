<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <a href="/admin_qualidade/home-qualidade" class="btn btn-info"><i class="fas fa-reply-all"></i> Voltar</a>
    <br><br>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastrar categoria</h3>
        </div>
        <!-- /.card-header -->
        <?php $validation = \Config\Services::validation(); ?>
        <!-- Error -->
        <div class="col-12">
            <?php if ($validation->getError('descricao_categoria')) { ?>
                <div class='alert alert-danger mt-2'>
                    <i class="icon fas fa-exclamation-triangle"></i> <?= $error = $validation->getError('descricao_categoria'); ?>
                </div>
            <?php } ?>
        </div>

        <br>
        <div class="col-12">
            <?php
            if (session()->getFlashdata('success_cat')) {
            ?>
                <div class="hide_categoria">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> OK!</h5>
                        <?php echo session()->getFlashdata('success_cat') ?>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>


        <!-- form start -->
        <form action="/admin_qualidade/adiciona-categoria" method="POST">
            <?= csrf_field() ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="descricao_categoria">Tipo de Fornecedor</label>
                    <textarea class="form-control" name="descricao_categoria" id="summernote" rows="3" placeholder="Digite aqui..."><?= old('descricao_categoria') ?></textarea>
                </div>
            </div>

            <input type="hidden" name="id_de_quem_cadastra" value=" <?= session()->get('id') ?>">
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
        })
    });
    setTimeout(function() {
        $('.hide_categoria').html('');
    }, 2000);
</script>
<?= $this->endSection() ?>