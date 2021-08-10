<?=form_open('Transporte/FornecedorController/cadastraEmpresaDoFornecedor', array('id'=>'form_empresa_fornecedor'))?>
    <div class="card-body">

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="empr_nome">Razão Social/Nome</label>
                <input type="text" class="form-control" name="empr_nome" id="empr_nome" placeholder="Ex.: Consócios Carros">
                <span class="text-danger error-text empr_nome_error"></span>
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword4">Empresário/Socio:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                    </div>
                    <select class="form-control col-xs-2" name="empr_topo_de_dono" id="empr_topo_de_dono" style="max-width: 10em;">
                        <option selected disabled>Selecione aqui...</option>
                        <option value="proprietario">Proprietário</option>
                        <option value="socio">Sócio</option>
                    </select>
                    <input type="text" name="empr_socio_dono" aria-label="Last name" class="form-control" placeholder="Ex.: Ana Silva" value="<?= esc($dd_fornecedor['for_responsavel']) ?>">
                </div>
                <span class="text-danger error-text empr_topo_de_dono_error"></span>
                <span class="text-danger error-text empr_socio_dono_error"></span>
            </div>
        </div>

        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="enpr_cnae">CNAE:</label>
                <input type="text" class="form-control" name="enpr_cnae" id="enpr_cnae" placeholder="Ex.: 12..33">
                <span class="text-danger error-text enpr_cnae_error"></span>
            </div>

            <div class="form-group col-md-6">
                <label for="enpr_classificacao_empresa">Classificação Empresarial</label>
                <select class="form-control" name="enpr_classificacao_empresa" id="enpr_classificacao_empresa">
                    <option selected disabled>Selecione aqui...</option>
                    <option value="Empresa de Pequeno Porte (EPP)">Empresa de Pequeno Porte (EPP)</option>
                    <option value="Empresário Individual">Empresário Individual</option>
                    <option value="EIRELI">EIRELI</option>
                    <option value="Microempresa (ME)">Microempresa (ME)</option>
                    <option value="Microempreendedor individual – MEI">Microempreendedor individual – MEI</option>
                    <option value="Sociedade Limitada">Sociedade Limitada</option>
                </select>
                <span class="text-danger error-text enpr_classificacao_empresa_error"></span>
            </div>

            <div class="form-group col-md-4">
                <label for="empre_cnpj">CNPJ:</label>
                <input type="text" class="form-control" name="empre_cnpj" id="empre_cnpj" placeholder="Ex.: 54.845.918/0001-60">
                <span class="text-danger error-text empre_cnpj_error"></span>
            </div>

            <div class="form-group col-md-4">
                <label for="empr_incricao_estadual">Inscrição Estadual</label>
                <input type="text" class="form-control" name="empr_incricao_estadual" id="empr_incricao_estadual" placeholder="Ex.: 1234567890">
                <span class="text-danger error-text empr_incricao_estadual_error"></span>
            </div>

            <div class="form-group col-md-4">
                <label for="empr_incricao_municiapl">Inscrição Municipal</label>
                <input type="text" class="form-control" name="empr_incricao_municiapl" id="empr_incricao_municiapl" placeholder="Ex.: 1234567890">
                <span class="text-danger error-text empr_incricao_municiapl_error"></span>
            </div>

            <div class="form-group col-md-3">
                <label for="empr_cep">CEP:</label>
                <input type="text" class="form-control" name="empr_cep" id="empr_cep" placeholder="Ex.: Ana Silva">
                <span class="text-danger error-text empr_cep_error"></span>
            </div>
            <div class="form-group col-md-2">
                <label for="empr_uf">UF:</label>
                <input type="text" class="form-control" name="empr_uf" id="empr_uf" placeholder="Ex.: MG" readonly>
                <span class="text-danger error-text empr_uf_error"></span>
            </div>
            <div class="form-group col-md-7">
                <label for="empr_cidade">Cidade:</label>
                <input type="text" class="form-control" name="empr_cidade" id="empr_cidade" readonly placeholder="Ex.: Ana Silva">
                <span class="text-danger error-text empr_cidade_error"></span>
            </div>

            <div class="form-group col-md-5">
                <label for="empr_bairro">Bairro:</label>
                <input type="text" class="form-control" name="empr_bairro" id="empr_bairro" placeholder="Ex.: Centro">
                <span class="text-danger error-text empr_bairro_error"></span>
            </div>

            <div class="form-group col-md-7">
                <label for="empr_endereco">Endereço:</label>
                <input type="text" class="form-control" name="empr_endereco" id="empr_endereco" placeholder="Ex.: Rua Ana Maria">
                <span class="text-danger error-text empr_endereco_error"></span>
            </div>

            <div class="form-group col-12">
                <label for="empr_observacao">Observação:</label>
                <textarea class="form-control" name="empr_observacao" placeholder="Digite aqui..." id="empr_observacao" rows="3"></textarea>
                <span class="text-danger error-text empr_observacao_error"></span>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
    <input type="hidden" name="id_de_quen_cadastrou" value="<?= session()->get('id') ?>">
    <input type="hidden" name="id_fornecedor" value="<?= esc($dd_fornecedor['for_id']) ?>">

    <div class="card-footer">
        <button type="submit" class="cls_add_empresa btn btn-primary" id="btn_add_empresa">
            <i class="fas fa-save"></i> Salvar
        </button>
    </div>
</form>