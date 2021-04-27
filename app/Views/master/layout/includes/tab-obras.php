<!-- jquery validation -->

<div class="card-header ui-sortable-handle">
    <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Sales
    </h3>
    <div class="card-tools">
        <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#sales-chart" data-toggle="tab">Cadastrar</a>
            </li>
        </ul>
    </div>
</div><!-- /.card-header -->

<div class="card-body">
    <div class="tab-content p-0">
        <!-- Morris chart - Sales -->
        <div class="chart tab-pane active" id="revenue-chart">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Data Inicial</th>
                        <th>Data Final</th>
                        <th style="width: 40px">Label</th>
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

        <div class="chart tab-pane" id="sales-chart">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cadastrar cliente</h3>
                </div>
                <!-- /form cadastro clientes -->
                    <?= $this->include('master\layout\components\002_components_form_obras_cliente');?>
                <!-- / end form cadastro clientes -->
            </div>

        </div>
    </div>
</div><!-- /.card-body -->
<!-- /.card -->