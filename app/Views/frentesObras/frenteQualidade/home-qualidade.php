<?= $this->extend('frentesObras/frenteQualidade/layout/template/base_layout') ?>

<?= $this->section('content') ?>

<div class="col-12">
  <?php
  if (session()->getFlashdata('success_delete_cat')) {
  ?>
    <span class="hide_delete_doc">
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> OK!</h5>
        <?php echo session()->getFlashdata('success_delete_cat') ?>
      </div>
    </span>
  <?php
  }

  if (session()->getFlashdata('delete_doc_cadastro')) {
  ?>
    <span class="hide_delete_doc">
      <div class="alert alert-danger alert-dismissible" id="">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> OK!</h5>
        <?php echo session()->getFlashdata('delete_doc_cadastro') ?>
      </div>
    </span>
  <?php
  }

  ?>
</div>

<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-12 connectedSortable">

  <div class="card card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Documentos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Versões do Documento</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Categorias</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="custom-tabs-three-tabContent">
        <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

          <table class="table table-sm" id="example_print">
            <thead>
              <tr>
                <th>Data</th>
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($lt_doc) && is_array($lt_doc)) : ?>

                <?php foreach ($lt_doc as $news_doc) : ?>

                  <tr>
                    <td><?= esc(date('d/m/Y', strtotime($news_doc['updated_at']))) ?></td>
                    <td><?= esc(strip_tags($news_doc['qld_description'])) ?></td>
                    <td><?= esc(strip_tags($news_doc['ql_description'])) ?></td>
                    <td>
                      <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Opções
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="/admin_qualidade/visualizar-documento/<?= esc($news_doc['qld_id'], 'url') ?>"><i class="fas fa-eye"></i> Visualizar</a>
                          <a class="dropdown-item" href="/admin_qualidade/revisar-documento/<?= esc($news_doc['qld_id'], 'url') ?>"><i class="fas fa-redo-alt"></i> Revisão</a>
                          <a class="dropdown-item" href="/admin_qualidade/deletar-documento/<?= esc($news_doc['qld_id'], 'url') ?>"><i class="fas fa-trash"></i> Deletar</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>

              <?php else : ?>
                <tr>
                  <td colspan="4" class="text-center">Não ha categoria cadastrada</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>

        </div>
        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">


          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>DESCRIÇÂO</th>
                <th>DATA</th>
                <th>JUSTIFICATIVA</th>
              </tr>
            </thead>
            <tbody>

              <?php if (!empty($lt_store) && is_array($lt_store)) : ?>

                <?php foreach ($lt_store as $news_store) : ?>

                  <tr>
                    <td><?= esc($news_store['st_origem']) ?></td>
                    <td><?= esc(strip_tags($news_store['st_descricao'])) ?></td>
                    <td><?= esc($news_store['st_data']) ?></td>
                    <td><?= esc(strip_tags($news_store['st_justificativa'])) ?></span></td>
                  </tr>

                <?php endforeach; ?>

              <?php else : ?>
                <tr>
                  <td colspan="4" class="text-center">Sem mudanças registradas</td>
                </tr>
              <?php endif ?>
            </tbody>
          </table>

        </div>
        <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                Categorias
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th>Descrição</th>
                    <th>Data do Cadastro</th>
                    <th>Data da Alteração</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>

                  <?php if (!empty($lt_categoria) && is_array($lt_categoria)) : ?>

                    <?php foreach ($lt_categoria as $news_cat) : ?>

                      <tr>
                        <td><?= esc(strip_tags($news_cat['ql_description'])) ?></td>
                        <td><?= esc(date('d/m/Y', strtotime($news_cat['created_at']))) ?></td>
                        <td><?= esc(date('d/m/Y', strtotime($news_cat['updated_at']))) ?></td>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Opções
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="/admin_qualidade/visualizar-categoria/<?= esc($news_cat['ql_id'], 'url') ?>"><i class="fas fa-eye"></i> Visualizar</a>
                              <a class="dropdown-item" href="/admin_qualidade/deletar-categoria/<?= esc($news_cat['ql_id'], 'url') ?>"><i class="fas fa-trash"></i> Deletar</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>

                  <?php else : ?>
                    <tr>
                      <td colspan="4" class="text-center">Não ha categoria cadastrada</td>
                    </tr>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
    <!-- /.card -->
  </div>

  <!-- /.card -->
</section>
<!-- right col -->
<?= $this->endSection() ?>
<?= $this->section('script_toast_transporte') ?>
<script>
  $(document).ready(function() {
    setTimeout(function() {
      $('.hide_delete_doc').html('');
    }, 2500);

    $('#example_print').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
      },
      dom: 'Bfrtip',
      select: true,
      colReorder: true,
      exportOptions: {
        columns: [0, 1, 2]
      },
      buttons: [{
        extend: 'collection',
        text: 'Exportar',
        buttons: [{
            extend: 'copy',
            exportOptions: {
              columns: [0, 1, 2, ':visible']
            }
          },
          {
            extend: 'excel',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'pdf',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          {
            extend: 'print',
            exportOptions: {
              columns: [0, 1, 2]
            }
          },
          'colvis',
        ]
      }]
    });

  });
</script>
<?= $this->endSection() ?>