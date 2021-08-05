<!-- Modal -->
<div class="modal fade" id="empresaDadosDoFornecedorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dados da empresa do fornedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <?= form_open('Transporte/FornecedorController/alteraEmpresaDoFornecedor', array('id' => 'form_altera_empresa_fornecedor')) ?>
                <div class="card-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="ef_razao_social">Razão Social/Nome</label>
                            <input type="text" class="form-control" name="ef_razao_social" id="ef_razao_social" placeholder="Ex.: Consócios Carros">
                            <span class="text-danger error-text ef_razao_social_error"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputPassword4">Empresário/Socio:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-cog"></i></span>
                                </div>
                                <select class="form-control col-xs-2" name="ef_tipo_dono" id="ef_tipo_dono" style="max-width: 10em;">
                                    <option selected disabled>Selecione aqui...</option>
                                    <option value="proprietario">Proprietário</option>
                                    <option value="socio">Sócio</option>
                                </select>
                                <input type="text" name="ef_nome_dono" id="ef_nome_dono" aria-label="Last name" class="form-control" placeholder="Ex.: Ana Silva" value="<?= esc($dd_fornecedor['for_responsavel']) ?>">
                            </div>
                            <span class="text-danger error-text ef_tipo_dono_error"></span>
                            <span class="text-danger error-text ef_nome_dono_error"></span>
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="ef_cnae">CNAE:</label>
                            <input type="text" class="form-control" name="ef_cnae" id="ef_cnae" placeholder="Ex.: 12..33">
                            <span class="text-danger error-text ef_cnae_error"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ef_classificacao_empresa">Classificação Empresarial</label>
                            <select class="form-control" name="ef_classificacao_empresa" id="ef_classificacao_empresa">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="">Empresa de Pequeno Porte (EPP)</option>
                                <option value="Empresário Individual">Empresário Individual</option>
                                <option value="EIRELI">EIRELI</option>
                                <option value="Microempresa (ME)">Microempresa (ME)</option>
                                <option value="Microempreendedor individual – MEI">Microempreendedor individual – MEI</option>
                                <option value="Sociedade Limitada">Sociedade Limitada</option>
                            </select>
                            <span class="text-danger error-text ef_classificacao_empresa_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="ef_cnpj">CNPJ:</label>
                            <input type="text" class="form-control" name="ef_cnpj" id="ef_cnpj" placeholder="Ex.: 54.845.918/0001-60">
                            <span class="text-danger error-text ef_cnpj_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="ef_incricao_estadual">Inscrição Estadual</label>
                            <input type="text" class="form-control" name="ef_incricao_estadual" id="ef_incricao_estadual" placeholder="Ex.: 1234567890">
                            <span class="text-danger error-text ef_incricao_estadual_error"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="ef_incricao_municial">Inscrição Municipal</label>
                            <input type="text" class="form-control" name="ef_incricao_municial" id="ef_incricao_municial" placeholder="Ex.: 1234567890">
                            <span class="text-danger error-text ef_incricao_municial_error"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="ef_cep">CEP:</label>
                            <input type="text" class="form-control" name="ef_cep" id="ef_cep" placeholder="Ex.: Ana Silva">
                            <span class="text-danger error-text ef_cep_error"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="ef_uf">UF:</label>
                            <input type="text" class="form-control" name="ef_uf" id="ef_uf" placeholder="Ex.: MG" readonly>
                            <span class="text-danger error-text ef_uf_error"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="ef_cidade">Cidade:</label>
                            <input type="text" class="form-control" name="ef_cidade" id="ef_cidade" readonly placeholder="Ex.: Ana Silva">
                            <span class="text-danger error-text ef_cidade_error"></span>
                        </div>

                        <div class="form-group col-md-5">
                            <label for="ef_bairro">Bairro:</label>
                            <input type="text" class="form-control" name="ef_bairro" id="ef_bairro" placeholder="Ex.: Centro">
                            <span class="text-danger error-text ef_bairro_error"></span>
                        </div>

                        <div class="form-group col-md-7">
                            <label for="ef_endereco">Endereço:</label>
                            <input type="text" class="form-control" name="ef_endereco" id="ef_endereco" placeholder="Ex.: Rua Ana Maria">
                            <span class="text-danger error-text ef_endereco_error"></span>
                        </div>

                        <div class="form-group col-12">
                            <label for="ef_description">Observação:</label>
                            <textarea class="form-control" name="ef_description" placeholder="Digite aqui..." id="ef_description" rows="3"></textarea>
                            <span class="text-danger error-text ef_description_error"></span>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <input type="hidden" name="id_de_quen_cadastrou" value="<?= session()->get('id') ?>">
                <input type="hidden" name="id_empresa" id="hidden_id_empresa_up_fornecedor">

                <div class="card-footer">
                    <button type="submit" class="cls_update_empresa btn btn-danger" id="id_btn_update_empresa">
                        <i class="fas fa-save"></i> Alterar
                    </button>
                </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>