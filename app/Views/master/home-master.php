<?= $this->extend('master/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<!-- Left col -->
<section class="col-lg-6 connectedSortable">
  <!-- TO DO List -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Obras
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-sm">
        <thead>
          <tr>
            <th style="width: 10px">Estado</th>
            <th>Local</th>
            <th>Cidade</th>
            <th style="width: 40px">Início</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Update software</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
              </div>
            </td>
            <td><span class="badge bg-danger">55%</span></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Clean database</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
              </div>
            </td>
            <td><span class="badge bg-warning">70%</span></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Cron job running</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
              </div>
            </td>
            <td><span class="badge bg-primary">30%</span></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Fix and squish bugs</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </td>
            <td><span class="badge bg-success">90%</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#obras_right_modal">
          <i class="fas fa-plus"></i> Cdastrar
      </button>
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- /.Left col -->
<!-- right col (We are only adding the ID to make the widgets sortable)-->
<section class="col-lg-6 connectedSortable">

  <!-- TO DO List -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        Cento de custo
      </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-sm">
        <thead>
          <tr>
            <th style="width: 10px">Data</th>
            <th>Número</th>
            <th>Descrição</th>
            <th style="width: 40px">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Update software</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
              </div>
            </td>
            <td><span class="badge bg-danger">55%</span></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>Clean database</td>
            <td>
              <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
              </div>
            </td>
            <td><span class="badge bg-warning">70%</span></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Cron job running</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
              </div>
            </td>
            <td><span class="badge bg-primary">30%</span></td>
          </tr>
          <tr>
            <td>4.</td>
            <td>Fix and squish bugs</td>
            <td>
              <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
              </div>
            </td>
            <td><span class="badge bg-success">90%</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Cadastrar</button>
    </div>
  </div>
  <!-- /.card -->
</section>
<!-- right col -->
<?= $this->endSection() ?>