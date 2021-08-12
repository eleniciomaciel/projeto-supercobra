<!-- Modal -->
<div class="modal fade" id="edocEmpresasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Documentos da empresa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="invoice p-3 mb-3">
                    <div class="row">

                        <!-- accepted payments column -->
                        <div class="card card-primary col-12">
                            <div class="card-header">
                                <h3 class="card-title">Cadastrar documento</h3>
                            </div>
                            <!-- /.card-header -->
                            <br>
                            <div id="alertMessage" class="alert alert-warning mb-3" style="display: none">
                                <span id="alertMsg"></span>
                            </div>

                            <!-- form start -->
                            <form method="post" id="id_inserirDocumentoEmpresa" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="doc_descricao">Descrição do documento:</label>
                                        <input type="text" class="form-control" name="doc_descricao" id="doc_descricao" required>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="profileImage" id="profileImage">
                                        <label class="custom-file-label" for="customFile">Selecionar arquivo...</label>
                                    </div>
                                    <script>
                                        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
                                            var fileName = document.getElementById("profileImage").files[0].name;
                                            var nextSibling = e.target.nextElementSibling
                                            nextSibling.innerText = fileName
                                        })
                                    </script>
                                </div>
                                <!-- /.card-body -->
                                <input type="hidden" name="hidden_id_empresa_doc" id="hidden_id_empresa_doc">
                                <div class="card-footer">
                                    <button type="submit" class="cls_add_doc_upload btn btn-primary" id="btn_add_doc_upload">
                                        <i class="fas fa-save"></i> Salvar
                                    </button>
                                </div>

                            </form>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descrição</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="table_data_documentos_empresa">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>