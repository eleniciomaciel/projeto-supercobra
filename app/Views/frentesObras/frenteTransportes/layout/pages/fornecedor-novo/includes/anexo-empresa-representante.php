<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Anexar emprese ao representante</h3>
    </div>
    <?= form_open('Transporte/FornecedorNovoController/cadastraAuxiliarRepresentante', array('id' => 'form_auxiluiar')) ?>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <label for="">Consultar Empresas:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search-plus"></i></span>
                    </div>
                    <input type="search" class="form-control" name="search_empresa_cnpj" id="search_empresa_cnpj" placeholder="Digite o CNPJ aqui...">
                </div>
                <span class="text-danger error-text search_empresa_cnpj_error"></span>
            </div>

            <div class="col-6">
                <label for="">Consultar Representantes:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search-plus"></i></span>
                    </div>
                    <input type="search" class="form-control" name="search_representante" id="search_representante" placeholder="Digite o CPF aqui...">
                </div>
                <span class="text-danger error-text search_representante_error"></span>
            </div>
        </div>

        <input type="hidden" name="userid_hide" id="userid_hide">
        <input type="hidden" name="userid_representante_hide" id="userid_representante_hide">
        <br>
        <div class="row">
            <div class="input-group">
                <button type="submit" class="cls_add_empresa_representante btn btn-primary btn-flat" id="btn_add_empresa_representante">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </div>

    </div>
    </form>

    <!-- /.card-body -->
</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Empresas/Fornecedor</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <table class="table table-striped" id="list_empresas_fornacedores_findAll" style="width: 100%;">
            <thead>
                <tr>
                    <th>CNPJ</th>
                    <th>EMPRESA</th>
                    <th>REPRESENTANTE</th>
                    <th>EMAIL</th>
                    <th style="width: 40px">Ações</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/component/001-bancos') ?>
<?= $this->include('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/component/002-documentos') ?>
