<?= $this->extend('frentesObras/frenteTransportes/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-12 connectedSortable">
    <div class="col-12">
        <div class="card card-primary card-outline card-tabs">
            <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true"><i class="fas fa-clipboard"></i> Cadastrar Solicitação</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false"><i class="fas fa-list-ol"></i> Listagem da Solicitação</a>
                    </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false"><i class="fas fa-car-side"></i> Efetivo Geral</a>
                    </li> -->
                    <!-- 
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false"><i class="fas fa-car-crash"></i> Manutenção local</a>
                    </li> -->

                </ul>
            </div>

            <br>
            <div class="col-12">
                <?php
                if (session()->getFlashdata('success_smes_add')) {
                ?>
                    <div class="hide_add_smes">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                            <?php echo session()->getFlashdata('success_smes_add') ?>
                        </div>
                    </div>

                <?php
                }

                if (session()->getFlashdata('delete_msg_solicitacao')) {
                ?>
                    <div class="hide_add_smes">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> OK!</h5>
                            <?php echo session()->getFlashdata('delete_msg_solicitacao') ?>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">SOCITAÇÃO DE MATERIAIS/EQUIPAMENTOS/SERVIÇOS</h3>
                            </div>
                            <!-- /.card-header -->
                            <?php $validation = \Config\Services::validation(); ?>
                            <!-- form start -->
                            <form action="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/index') ?>" method="POST">
                                <?= csrf_field() ?>

                                <div class="card-body">

                                    <div class="form-row">

                                        <div class="col-md-6 mb-3">
                                            <label for="s_revisao">REV.</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="">Rev:</span>
                                                </div>
                                                <input type="number" name="s_rev_numero" min="1" class="form-control" placeholder="Ex.: 4" value="<?= old('s_rev_numero') ?>">

                                                <input type="text" class="form-control" name="s_codigo_revisao" placeholder="Ex.: IGE-5000-003-1-2" value="<?= old('s_codigo_revisao') ?>">

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
                                                <input type="date" class="form-control" name="s_data" value="<?= old('s_data') ?>">
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
                                                <input type="text" class="form-control" name="s_sequencia" placeholder="Ex.: 0001" value="<?= old('s_sequencia') ?>">
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
                                            <input type="text" class="form-control" name="s_local_entrega" placeholder="Ex.: CORINTO-MG" value="<?= old('s_local_entrega') ?>">
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
                                                <input type="text" class="form-control" name="s_solicitado_por" placeholder="Ex.: Ana Silva" value="<?= old('s_solicitado_por') ?>">
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
                                            <textarea class="form-control" name="s_aplicacao" id="summernote" placeholder="Digite aqui..." rows="3"><?= old('s_aplicacao') ?></textarea>
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
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">
                                        <i class="fas fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Código</th>
                                    <th scope="col">Aplicação</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (!empty($lista_doc_servicos) && is_array($lista_doc_servicos)) : ?>

                                    <?php foreach ($lista_doc_servicos as $list_docs) : ?>

                                        <tr>
                                            <th><?= esc(date('d/m/Y', strtotime($list_docs['datetime']))) ?></th>
                                            <td><?= esc($list_docs['smes_sequencia_numerica']) ?></td>
                                            <td><?= esc(strip_tags($list_docs['smes_aplicacao'])) ?></td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Opções
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="/transposte-solicitacao-material-equipamentos-servicos/visualizar-solicitacao/<?= esc($list_docs['smes_id'], 'url') ?>"><i class="fas fa-eye"></i> Alterar</a>
                                                        <a class="dropdown-item" href="/transposte-solicitacao-material-equipamentos-servicos/adicionar-itens/<?= esc($list_docs['smes_id'], 'url') ?>"><i class="fas fa-sitemap"></i> Add Itens</a>
                                                        <a class="dropdown-item" href="/transposte-solicitacao-material-equipamentos-servicos/adicionar-arquivos/<?= esc($list_docs['smes_id'], 'url') ?>"><i class="fas fa-folder"></i> Add Arquivos</a>
                                                        <a class="dropdown-item" href="/transposte-solicitacao-material-equipamentos-servicos/visualizar-arquivo/<?= esc($list_docs['smes_id'], 'url') ?>" target="__blank"><i class="fas fa-file-pdf"></i> PDF</a>
                                                        <a class="dropdown-item" href="#"><i class="fas fa-print"></i> Doc. Digitalizado</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="<?= base_url('Transporte/SolicitacaoMateriaisEquipamentosServicos/deleteSolicitacaoCompra/' . $list_docs['smes_id']); ?>"><i class="fas fa-trash"></i> Deletar</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                <?php else : ?>
                                    <tr>
                                        <th colspan="4" class="text-center text-muted">Sem solicitações para essa frente</th>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                    </div>

                    <!-- <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div> -->
                    <!--
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                    </div> -->

                </div>
            </div>
            <!-- /.card -->
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
            $('.hide_add_smes').html('');
        }, 3000);
    })
</script>
<?= $this->endSection() ?>