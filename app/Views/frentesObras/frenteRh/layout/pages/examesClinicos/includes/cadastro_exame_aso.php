<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->

    <div class="card" style="position: relative; left: 0px; top: 0px;">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="fas fa-hospital"></i> <?= esc($title) ?>
            </h3>
            <div class="card-tools">
                <ul class="nav nav-pills ml-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab"><i class="fas fa-file-medical-alt"></i> Tipos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sales-chart" data-toggle="tab"><i class="fas fa-notes-medical"></i> Exam.: Riscos</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#comb-cont" data-toggle="tab"><i class="fas fa-user-md"></i> Exames</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#config-aso" data-toggle="tab"><i class="fas fa-file-signature"></i> Congif.: ASO</a>
                    </li>

                </ul>
            </div>
        </div><!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_contratuais') ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="sales-chart">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_riscos_ocupacionais', $carg) ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="comb-cont">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_combo', $funf) ?>
                    </div>
                </div>

                <div class="chart tab-pane" id="config-aso">
                    <div class="chartjs-size-monitor">
                        <?= $this->include('frentesObras/frenteRh/layout/pages/examesClinicos/includes/exames_config_aso', $carg) ?>
                    </div>
                </div>
            </div>
        </div><!-- /.card-body -->
    </div>
    <!-- /.card -->


    <!-- Modal -->



</section>
<?= $this->include('frentesObras/frenteRh/layout/components/005_popap_config_exames', $carg) ?>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<!-- Jquery Validate -->

<script>
    $(document).ready(function() {
       

    });
</script>
<?= $this->endSection() ?>