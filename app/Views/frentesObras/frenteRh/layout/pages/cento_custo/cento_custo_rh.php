<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
   
    <!-- TO DO List -->
    <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Cento de Custo</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab"><i class="fas fa-folder-open"></i> CC Cadastrados</a></li>
                  <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab"><i class="fas fa-folder-plus"></i> Cadastrar</a></li>
      
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <?=$this->include('frentesObras/frenteRh/layout/pages/cento_custo/includes/list_cc_crud');?>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_2">
                    <?=$this->include('frentesObras/frenteRh/layout/pages/cento_custo/includes/cad_cc');?>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
    <!-- /.card -->
</section>
<?= $this->endSection() ?>