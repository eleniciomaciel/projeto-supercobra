<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            Painel geral de obras e frentes
        </h3>
    </div>
    <div class="card-body">
        <h4>Painel funcional</h4>
        <div class="row">
            <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Obras</a>
                    <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Frentes</a>
                    <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Cadastrar frentes</a>
                    <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Frentes concluídas</a>
                </div>
            </div>
            <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                    <div class="tab-pane text-left fade active show" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">

                        <div class="card-body p-0">
                            <br>
                            <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#obras_right_modal">
                                <i class="fas fa-plus"></i> Cadastrar
                            </button>
                            <table class="table table-striped" id="list_todas_obras" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Obra/Frente</th>
                                        <th>Data Inicial</th>
                                        <th>Data Final</th>
                                        <th>UF</th>
                                        <th>Cidade</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Frentes cadastradas</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table table-responsive">
                                    <table class="table table-striped" id="todos_frentes" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Clientes</th>
                                                <th>Obras</th>
                                                <th>Nome da frente</th>
                                                <th>Data Inicial</th>
                                                <th>Data Final</th>
                                                <th>UF</th>
                                                <th>Cidade</th>
                                                <th>Cep</th>
                                                <th>Opções</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                    <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Cadastro das frentes</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="/criar_frentes/" method="POST" id="criar_novas_frentes">

                                <div class="card-body">

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="frt_cliente">Cliente:</label>
                                            <select name="frt_cliente" id="frt_cliente" class="form-control"></select>
                                            <span id="frt_cliente_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="frt_obra">Obra:</label>
                                            <select name="frt_obra" id="frt_obra" class="form-control"></select>
                                            <span id="frt_obra_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="frt_projeto_nome">Nome do projeto:</label>
                                            <input type="text" class="form-control" name="frt_projeto_nome" id="frt_projeto_nome">
                                            <span id="frt_projeto_nome_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="frt_dataInicial">Data Inicial:</label>
                                            <input type="date" class="form-control" name="frt_dataInicial" id="frt_dataInicial">
                                            <span id="frt_dataInicial_error" class="text-danger"></span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="frt_datafinal">Data Final:</label>
                                            <input type="date" class="form-control" name="frt_datafinal" id="frt_datafinal">
                                            <span id="frt_datafinal_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-2">
                                            <label for="frt_cep">Cep:</label>
                                            <input type="text" class="form-control" name="frt_cep" id="frt_cep">
                                            <span id="frt_cep_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="frt_estado">Estado</label>
                                            <input type="text" class="form-control" name="frt_estado" id="frt_estado">
                                            <span id="frt_estado_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="frt_cidade">Cidade</label>
                                            <input type="text" class="form-control" name="frt_cidade" id="frt_cidade">
                                            <span id="frt_cidade_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="frt_bairros">Bairro:</label>
                                            <input type="text" class="form-control" name="frt_bairros" id="frt_bairros" placeholder="Ex.: Centro">
                                            <span id="frt_bairros_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-5">
                                            <label for="frt_endereco">Endereço:</label>
                                            <input type="text" class="form-control" name="frt_endereco" id="frt_endereco" placeholder="Ex.: Rua Vinte Ver">
                                            <span id="frt_endereco_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="frt_numeros">Número:</label>
                                            <input type="number" class="form-control" name="frt_numeros" id="frt_numeros" placeholder="Ex.: 20">
                                            <span id="frt_numeros_error" class="text-danger"></span>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="frt_observacoes">Observações:</label>
                                            <textarea class="form-control" name="frt_observacoes" id="frt_observacoes" rows="3" placeholder="Digite aqui..."></textarea>
                                            <span id="frt_observacoes_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="submit_frt_add_cls btn btn-primary" id="submit_id_frt_add">
                                        <i class="fa fa-save"></i> Salvar
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Striped Full Width Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Task</th>
                                            <th>Progress</th>
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
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>