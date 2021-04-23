<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->

<div class="col-md-12">
  <div class="card card-outline card-warning">
    <div class="card-header">
      <h3 class="card-title">Gestão de Atividades</h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: block;">


      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Dados do Clinete</a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Obras/Frente</a>
          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Licenças</a>
          <a class="nav-item nav-link" id="nav-cento_custo-tab" data-toggle="tab" href="#nav-cento_custo" role="tab" aria-controls="nav-contact" aria-selected="false">Cento Custo</a>
          <a class="nav-item nav-link" id="nav-contratos-tab" data-toggle="tab" href="#nav-contratos" role="tab" aria-controls="nav-contratos" aria-selected="false">Contratos</a>
          <a class="nav-item nav-link" id="nav-usuarios-tab" data-toggle="tab" href="#nav-usuarios" role="tab" aria-controls="nav-usuarios" aria-selected="false">Usuários</a>
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">

        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
           <?= $this->include('master\layout\includes\tab-obras') ?>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <?= $this->include('master\layout\includes\tab-frentes') ?>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
          <?= $this->include('master\layout\includes\tab-licencas') ?>
        </div>

        <div class="tab-pane fade" id="nav-cento_custo" role="tabpanel" aria-labelledby="nav-cento_custo-tab">
          <?= $this->include('master\layout\includes\tab-cento_custo') ?>
        </div>

        <div class="tab-pane fade" id="nav-contratos" role="tabpanel" aria-labelledby="nav-contratos-tab">
        <?= $this->include('master\layout\includes\tab-contratos') ?>
        </div>

        <div class="tab-pane fade" id="nav-usuarios" role="tabpanel" aria-labelledby="nav-usuarios-tab">
          <?= $this->include('master\layout\includes\tab-users') ?>
        </div>
      </div>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<?= $this->endSection() ?>