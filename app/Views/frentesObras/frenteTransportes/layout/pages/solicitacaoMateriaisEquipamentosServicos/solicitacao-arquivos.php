<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <a href="/transposte-solicitacao-material-equipamentos-servicos/solicitacao-mes" class="btn bg-gradient-danger btn-flat">
            <i class="fas fa-reply-all"></i> Voltar
        </a>
        <br><br>

        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> Adicionar itens a nota.
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Painel de atividades</h5>


                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">

                        <div class="hide_up_upload_file_msg col-12">
                            <?php
                            if (session()->getFlashdata('success_uploaded')) : ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                                    <?php echo session()->getFlashdata('success_uploaded') ?>
                                </div>
                            <?php elseif (session()->getFlashdata('error_uploaded')) : ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> OK!</h5>
                                    <?php echo session()->getFlashdata('error_uploaded') ?>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div class="col-md-8">
                            <p class="text-center">
                                <strong>Listagem dos arquivos</strong>
                            </p>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Histórico de documentos</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Descrição</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php if (!empty($list_docs) && is_array($list_docs)) : ?>


                                                <?php foreach ($list_docs as $news_doc) : ?>
                                                    <tr>
                                                        <td><?= date('d/m/Y', strtotime($news_doc['created_em'])) ?></td>
                                                        <td><?= esc($news_doc['doc_solic_descricao']) ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/baixarDadosSolicitacao/' . esc($news_doc['doc_solic_arquivo_nome'])) ?>" target="__blank" class="btn btn-primary btn-sm" title="Baixar Aquivo"><i class="fas fa-cloud-download-alt"></i></a>
                                                                <button type="button" class="deleteArquivoSolicita btn btn-danger btn-sm" data-id="<?= esc($news_doc['doc_solic_id']) ?>" title="Deletar Aquivo"><i class="fas fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Não há arquivos cadastrados</td>
                                                </tr>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Formulário de cadastro</strong>
                            </p>

                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Arquivar documento</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <?= form_open_multipart('Transporte/SolicitacaoMateriaisEquipamentosServicos/uploadArquivo') ?>
                                <div class="card-body">

                                    <?php if (session()->has('errors')) : ?>
                                        <ul class="alert alert-danger">
                                            <?php foreach (session('errors') as $error) : ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php endif ?>

                                    <div class="form-group">
                                        <label for="descricao_doc_solicitacao">Descrição do documento</label>
                                        <textarea class="form-control" name="descricao_doc_solicitacao" id="descricao_doc_solicitacao" rows="3"><?= old('descricao_doc_solicitacao') ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile">Adicionar arquivo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="profile_image" id="customFileInput" aria-describedby="customFileInput">
                                                <label class="custom-file-label" for="customFileInput">Selecionar arquivo</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button" id="customFileInput">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <script>
                                    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                        var name = document.getElementById("customFileInput").files[0].name;
                                        var nextSibling = e.target.nextElementSibling
                                        nextSibling.innerText = name
                                    })
                                </script>
                                <input type="hidden" name="id_arquivo" value="<?= esc($solicitacao['smes_id']) ?>">
                                <div class="card-footer">
                                    <button type="submit" class="add_btn_up_da_solitacao btn btn-primary" id="btnSubmiUpload_file">
                                        <i class="fas fa-save"></i> Arquivar</button>
                                </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./card-body -->
            </div>

            <!-- /.row -->
        </div>


    </div>

</section>
<?= $this->endSection() ?>
<?= $this->section('script_geral_transporte') ?>

<script>
    $(document).ready(function() {


        $("#btnSubmiUpload_file").click(function() {
            $('.add_btn_up_da_solitacao').html('<div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div> Salvando, aguarde...');

        });

        $(document).on('click', '.deleteArquivoSolicita', function() {
            var id_del_as = $(this).data('id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Deseja deletar?',
                text: "Ao confirmar essa ação será permanente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, deletar',
                cancelButtonText: 'Não, cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "<?php echo base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/deleteArquivoSolicitacao'); ?>",
                        method: "GET",
                        data: {
                            id_del_as: id_del_as
                        },
                        success: function(data) {
                            swalWithBootstrapButtons.fire(
                                'Deletado!',
                                data,
                                'success'
                            );
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'Você desistiu de cancelar',
                        'error'
                    )
                }
            });
        });


    });
</script>

<script>
    $(function() {
        setTimeout(function() {
            $('.hide_up_upload_file_msg').html('');
        }, 3000);
    })
</script>
<?= $this->endSection() ?>