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
            <div class="table table-responsive">
                <table class="table table-striped" id="todos_clientes">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>CNPJ</th>
                            <th>Data Inicial</th>
                            <th>Data Final</th>
                            <th>Estado</th>
                            <th>Cidade</th>
                            <th style="width: 40px">Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="chart tab-pane" id="sales-chart">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cadastrar cliente</h3>
                </div>
                <!-- /form cadastro clientes -->
                <?= $this->include('master/layout/components/002_components_form_obras_cliente'); ?>
                <!-- / end form cadastro clientes -->
            </div>

        </div>
    </div>
</div><!-- /.card-body -->
<!-- /.card -->