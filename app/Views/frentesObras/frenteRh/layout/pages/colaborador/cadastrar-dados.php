<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pré Cadastro</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="/admin_rh/inserir-funcionario" method="POST" id="form_novo_colaborador">
            <?= csrf_field() ?>

            <div class="card-body">

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Dados Pessoais</legend>

                    <div class="form-group">
                        <label for="x_add_colab_nome">Nome Completo do colaborador(a):</label>
                        <input type="text" class="form-control" name="x_add_colab_nome" name="x_add_colab_nome" placeholder="Ex.: Ana Silva">
                        <span id="x_add_colab_nome_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="x_add_colab_conjuge">Nome do Cônjuge:</label>
                        <input type="text" class="form-control" name="x_add_colab_conjuge" id="x_add_colab_conjuge" placeholder="Ex.: Pedro Silva">
                        <span id="x_add_colab_conjuge_nome_error" class="text-danger"></span>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="x_add_colab_codigo">Código:</label>
                            <input type="text" class="form-control" name="x_add_colab_codigo" id="x_add_colab_codigo" placeholder="Ex.: 12345">
                            <span id="x_add_colab_codigo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="x_add_colab_matricula">Matrícula:</label>
                            <input type="text" class="form-control" name="x_add_colab_matricula" id="x_add_colab_matricula" placeholder="Ex.: 12345">
                            <span id="x_add_colab_matricula_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_sexo">Sexo:</label>
                            <select name="add_colab_sexo" id="add_colab_sexo" class="form-control select2bs4">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                            <span id="add_colab_sexo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_estado_civil">Estado Civil:</label>
                            <select name="add_colab_estado_civil" id="add_colab_estado_civil" class="form-control select2EstadoCivil">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Solteiro(a)">Solteiro(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                                <option value="Divorciado(a)">Divorciado(a)</option>
                                <option value="Viuvo(a)">Viúvo(a)</option>
                                <option value="Outros">Outros</option>
                            </select>
                            <span id="add_colab_estado_civil_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_escolaridade">Grau de instrução:</label>
                            <select name="add_colab_escolaridade" id="add_colab_escolaridade" class="form-control select2GrauInstrucai">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="0">Analfabeto</option>
                                <option value="1">Ensino fundamental incompleto</option>
                                <option value="2">Ensino fundamental completo</option>
                                <option value="3">Ensino médio incompleto</option>
                                <option value="4">Ensino médio completo</option>
                                <option value="5">Superior incompleto (graduação)</option>
                                <option value="6">Superior completo (graduação)</option>
                                <option value="7">Pós-graduação</option>
                                <option value="8">MPE</option>
                                <option value="9">Mestrado</option>
                                <option value="10">Doutorado</option>
                                <option value="11">Pós-Doutorado</option>
                            </select>
                            <span id="add_colab_escolaridade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_nacionalidade">Nacionalidade:</label>
                            <select name="add_colab_nacionalidade" id="add_colab_nacionalidade" class="form-control select2Nacionalidade">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Brasileira(a)">Brasileira(a)</option>
                                <option value="Estrangeira(a)">Estrangeira(a)</option>
                            </select>
                            <span id="add_colab_nacionalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_naturalidade">Naturalidade:</label>
                            <input type="text" class="form-control" name="add_colab_naturalidade" id="add_colab_naturalidade" placeholder="Ex.: Salvador">
                            <span id="add_colab_naturalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_naturalidade">UF da Naturalidade:</label>
                            <select name="add_colab_uf_naturalidade" id="add_colab_uf_naturalidade" class="form-control select2Estados">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option value="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_uf_naturalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_data_nacimento">Data de nascimento:</label>
                            <input type="date" class="form-control" name="add_colab_data_nacimento" id="add_colab_data_nacimento">
                            <span id="add_colab_data_nacimento_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_nome_mae">Nome da Mãe:</label>
                            <input type="text" class="form-control" name="add_colab_nome_mae" id="add_colab_nome_mae" placeholder="Ex.: Maria Silva">
                            <span id="add_colab_nome_mae_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_do_pai">Nome do Pai:</label>
                            <input type="text" class="form-control" name="add_colab_do_pai" id="add_colab_do_pai" placeholder="Ex.: Paulo Silva">
                            <span id="add_colab_do_pai_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Contatos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_pricipal">Contato Principal:</label>
                            <input type="text" class="form-control" name="add_colab_contato_pricipal" id="add_colab_contato_pricipal" placeholder="(00)9 0000-0000">
                            <span id="add_colab_contato_pricipal_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_alternativo">Contato Alternativo</label>
                            <input type="text" class="form-control" name="add_colab_contato_alternativo" id="add_colab_contato_alternativo" placeholder="(00)9 0000-0000">
                            <span id="add_colab_contato_alternativo_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_familiar">Contato Familiar</label>
                            <input type="text" class="form-control" name="add_colab_contato_familiar" id="add_colab_contato_familiar" placeholder="(00)9 0000-0000">
                            <span id="add_colab_contato_familiar_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_email_pessoal">Email Pessoal:</label>
                            <input type="email" class="form-control" name="add_colab_email_pessoal" id="add_colab_email_pessoal" placeholder="Ex.: eu@email.com">
                            <span id="add_colab_email_pessoal_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Endereço</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_cep_moradia">CEP:</label>
                            <input type="text" class="form-control" name="add_colab_cep_moradia" id="add_colab_cep_moradia" placeholder="00-000-000">
                            <span id="add_colab_cep_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_uf_moradia">UF</label>
                            <input type="text" class="form-control" name="add_colab_uf_moradia" id="add_colab_uf_moradia" placeholder="Ex.: BA" readonly>
                            <span id="add_colab_uf_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_cidade_moradia">Cidade:</label>
                            <input type="text" class="form-control" name="add_colab_cidade_moradia" id="add_colab_cidade_moradia" placeholder="Ex.: Salvador" readonly>
                            <span id="add_colab_cidade_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_bairro_moraddia">Bairro:</label>
                            <input type="text" class="form-control" name="add_colab_bairro_moraddia" id="add_colab_bairro_moraddia" placeholder="Ex.:  Centro">
                            <span id="add_colab_bairro_moraddia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_rua_moradia">Rua:</label>
                            <input type="text" class="form-control" name="add_colab_rua_moradia" id="add_colab_rua_moradia" placeholder="Ex.: Rua Santa Clara">
                            <span id="add_colab_rua_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_numero_moradia">Número:</label>
                            <input type="number" class="form-control" name="add_colab_numero_moradia" id="add_colab_numero_moradia" placeholder="Ex.: 01">
                            <span id="add_colab_numero_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="add_colab_complemento_morada">Complemento:</label>
                            <input type="text" class="form-control" name="add_colab_complemento_morada" id="add_colab_complemento_morada" placeholder="Ex.: Próximo a Praça...">
                            <span id="add_colab_complemento_morada_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_numero_rg">Número do RG:</label>
                            <input type="number" class="form-control" name="add_colab_doc_numero_rg" id="add_colab_doc_numero_rg" placeholder="Ex.: 94949494">
                            <span id="add_colab_doc_numero_rg_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_orgao_emissor_rg">Emissor do RG:</label>
                            <select name="add_colab_doc_orgao_emissor_rg" id="add_colab_doc_orgao_emissor_rg" class="form-control select2EmissorRG">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="SSP/UF">SSP/UF</option>
                                <option value="Cartório Civil">Cartório Civil</option>
                                <option value="Polícia Federal">Polícia Federal</option>
                                <option value="DETRAN">DETRAN</option>
                                <option value="ABNC">ABNC</option>
                                <option value="CGPI/DUREX/DPF">CGPI/DUREX/DPF</option>
                                <option value="CGPI">CGPI</option>
                                <option value="CGPMAF">CGPMAF</option>
                                <option value="CNIG">CNIG</option>
                                <option value="CNT">CNT</option>
                                <option value="COREN">COREN</option>
                                <option value="CORECON">CORECON</option>
                                <option value="CRA">CRA</option>
                                <option value="CRAS">CRAS</option>
                                <option value="CRB">CRB</option>
                                <option value="CRC">CRC</option>
                                <option value="CRE">CRE</option>
                                <option value="CREA">CREA</option>
                                <option value="CRECI">CRECI</option>
                                <option value="CREFIT">CREFIT</option>
                                <option value="CRESS">CRESS</option>
                                <option value="CRF">CRF</option>
                                <option value="CRM">CRM</option>
                                <option value="CRN">CRN</option>
                                <option value="CRO">CRO</option>
                                <option value="CRP">CRP</option>
                                <option value="CRPRE">CRPRE</option>
                                <option value="CRQ">CRQ</option>
                                <option value="CRRC">CRRC</option>
                                <option value="CRMV">CRMV</option>
                                <option value="CSC">CSC</option>
                                <option value="CTPS">CTPS</option>
                                <option value="DIC">DIC</option>
                                <option value="DIREX">DIREX</option>
                                <option value="DPMAF">DPMAF</option>
                                <option value="DPT">DPT</option>
                                <option value="DST">DST</option>
                                <option value="FGTS">FGTS</option>
                                <option value="FIPE">FIPE</option>
                                <option value="FLS">FLS</option>
                                <option value="GOVGO">GOVGO</option>
                                <option value="CLA">CLA</option>
                                <option value="IFP">IFP</option>
                                <option value="IGP">IGP</option>
                                <option value="IICCECF/RO">IICCECF/RO</option>
                                <option value="IIMG">IIMG</option>
                                <option value="IML">IML</option>
                                <option value="IPC">IPC</option>
                                <option value="IPF">IPF</option>
                                <option value="MAE">MAE</option>
                                <option value="MEX">MEX</option>
                                <option value="MMA">MMA</option>
                                <option value="OAB">OAB</option>
                                <option value="OMB">OMB</option>
                                <option value="PCMG">PCMG</option>
                                <option value="PMMG">PMMG</option>
                                <option value="POF ou DPF">POF ou DPF</option>
                                <option value="POM">POM</option>
                                <option value="SDS">SDS</option>
                                <option value="SNJ">SNJ</option>
                                <option value="SECC">SECC</option>
                                <option value="SEJUSP">SEJUSP</option>
                                <option value="SES ou EST">SES ou EST</option>
                                <option value="SESP">SESP</option>
                                <option value="SJS">SJS</option>
                                <option value="SJTC">SJTC</option>
                                <option value="SJTS">SJTS</option>
                                <option value="SPTC">SPTC</option>
                            </select>
                            <span id="add_colab_doc_orgao_emissor_rg_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_data_rg_emissao">Data de Emissão do RG:</label>
                            <input type="date" class="form-control" name="add_colab_doc_data_rg_emissao" id="add_colab_doc_data_rg_emissao">
                            <span id="add_colab_doc_data_rg_emissao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_uf_rg">UF de Emissão do RG:</label>
                            <select name="add_colab_doc_uf_rg" id="add_colab_doc_uf_rg" class="form-control select2EmissorRG2">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option value="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_doc_uf_rg_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_titulo_numero">N° do Título:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_numero" id="add_colab_titulo_numero" placeholder="Ex.: 123456">
                            <span id="add_colab_titulo_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_zona">Zona:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_zona" id="add_colab_titulo_zona" placeholder="Ex.: 1234">
                            <span id="add_colab_titulo_zona_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_sessao">Sessão:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_sessao" id="add_colab_titulo_sessao" placeholder="Ex.: 444">
                            <span id="add_colab_titulo_sessao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_titulo_data_emissao">Data de Emissão:</label>
                            <input type="date" class="form-control" name="add_colab_titulo_data_emissao" id="add_colab_titulo_data_emissao">
                            <span id="add_colab_titulo_data_emissao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_uf_emissao">UF de Emissão:</label>
                            <select name="add_colab_titulo_uf_emissao" id="add_colab_titulo_uf_emissao" class="form-control select2TituloUf">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option value="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_titulo_uf_emissao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_cpf_numero">Número do CPF:</label>
                            <input type="text" class="form-control" name="add_colab_cpf_numero" id="add_colab_cpf_numero" placeholder="Ex.: 94949494">
                            <span id="add_colab_cpf_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_numero_pis">Número do PIS:</label>
                            <input type="number" class="form-control" name="add_colab_numero_pis" id="add_colab_numero_pis" placeholder="Ex.: 94949494">
                            <span id="add_colab_numero_pis_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_reservista_numero">Número do Reservista:</label>
                            <input type="number" class="form-control" name="add_colab_reservista_numero" id="add_colab_reservista_numero" placeholder="12345567">
                            <span id="add_colab_reservista_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_sus_numero">Número do SUS:</label>
                            <input type="number" class="form-control" name="add_colab_sus_numero" id="add_colab_sus_numero" placeholder="Ex.: 94949494">
                            <span id="add_colab_sus_numero_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos CTPS/FGTS</legend>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_numero">Número da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_numero" id="add_colab_ctps_numero" placeholder="Ex.: 94949494">
                            <span id="add_colab_ctps_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_serie">Série da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_serie" id="add_colab_ctps_serie" placeholder="Ex.: 94949494">
                            <span id="add_colab_ctps_serie_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_data_emissao">Data de Emissão da CTPS:</label>
                            <input type="date" class="form-control" name="add_colab_data_emissao">
                            <span id="add_colab_data_emissao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_emissor">UF da CTPS:</label>
                            <select name="add_colab_uf_emissor" id="add_colab_uf_emissor" class="form-control select2UfCTPS">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option value="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_uf_emissor_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="add_colab_fgts_categoria">Categoria do FGTS:</label>
                            <select name="add_colab_fgts_categoria" id="add_colab_fgts_categoria" class="form-control select2CTPScategoria">
                                <option selected disabled>Selecione aqui...</option>
                                <?php for ($i = 1; $i <= 27; $i++) {
                                ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                                } ?>

                            </select>
                            <span id="add_colab_fgts_categoria_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="add_colab_fgts_codigo">Código do FGTS:</label>
                            <input type="text" class="form-control" name="add_colab_fgts_codigo" id="add_colab_fgts_codigo" placeholder="Ex.: 12346">
                            <span id="add_colab_fgts_codigo_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Uniformes/Tipo Sanguinio</legend>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="add_colab_uniforme_tamanho">Uniforme:</label>
                            <select name="add_colab_uniforme_tamanho" id="add_colab_uniforme_tamanho" class="form-control select2TamanhoRoupa">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="PP">PP</option>
                                <option value="P">P</option>
                                <option value="M">M</option>
                                <option value="G">G</option>
                                <option value="GG">GG</option>
                                <option value="XGG">XGG</option>
                                <option value="G1">G1</option>
                                <option value="G2">G2</option>
                            </select>
                            <span id="add_colab_uniforme_tamanho_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_uniforme_calca">Calça:</label>
                            <select name="add_colab_uniforme_calca" id="add_colab_uniforme_calca" class="form-control select2Calca">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="PP">PP</option>
                                <option value="P">P</option>
                                <option value="M">M</option>
                                <option value="G">G</option>
                                <option value="GG">GG</option>
                                <option value="XGG">XGG</option>
                                <option value="G1">G1</option>
                                <option value="G2">G2</option>
                            </select>
                            <span id="add_colab_uniforme_calca_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_tipo_sangue">Tipo Sanguíneo:</label>
                            <select name="add_colab_tipo_sangue" id="add_colab_tipo_sangue" class="form-control select2Sangue">
                                <option selected disabled>Selecioen aqui...</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <span id="add_colab_tipo_sangue_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Funcionais</legend>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_cargo">Cargo:</label>
                            <select name="add_colab_funcao_cargo" id="add_colab_funcao_cargo" class="form-control select2CargoTrocaFuncaoTodas">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($funcao) && is_array($funcao)) : ?>
                                    <?php foreach ($funcao as $func_dd) : ?>
                                        <option value="<?= esc($func_dd['id_cargo']) ?>"><?= esc($func_dd['cargo_nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>...</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_funcao_cargo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_cargo">Encarregado:</label>
                            <select name="add_colab_funcao_cargo" id="add_colab_funcao_cargo" class="form-control select2CargoTrocaFuncaoTodas">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($funcao) && is_array($funcao)) : ?>
                                    <?php foreach ($funcao as $func_dd) : ?>
                                        <option value="<?= esc($func_dd['id_cargo']) ?>"><?= esc($func_dd['cargo_nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>...</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_funcao_cargo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_situacao">Situação:</label>
                            <select name="add_colab_funcao_situacao" id="add_colab_funcao_situacao" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                            <span id="add_colab_funcao_situacao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_admissao_data">Admissão:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_admissao_data" id="add_colab_funcao_admissao_data">
                            <span id="add_colab_funcao_admissao_data_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_desligamento_data">Desligamento:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_desligamento_data">
                            <span id="add_colab_funcao_desligamento_data_data_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_hora_extra_fixa">Hor. Ext. Fix.:</label>
                            <select name="add_colab_funcao_hora_extra_fixa" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sin">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_hora_extra_fixa_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_salario">Salário:</label>
                            <input type="text" class="form-control" name="add_colab_funcao_salario" placeholder="Ex.: 1.000,00">
                            <span id="add_colab_funcao_salario_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_pagamento">Tipo de Pagamento:</label>
                            <select name="add_colab_funcao_tipo_pagamento" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Mensal">Mensal</option>
                                <option value="Quizenal">Quizenal</option>
                                <option value="Semanal">Semanal</option>
                            </select>
                            <span id="add_colab_funcao_tipo_pagamento_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_salario">Tipo de Salário:</label>
                            <select name="add_colab_funcao_tipo_salario" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Mensalista">Mensalista</option>
                            </select>
                            <span id="add_colab_funcao_tipo_salario_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_departamento">Departamento:</label>
                            <select name="add_colab_funcao_departamento" id="add_colab_funcao_departamento" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($departamento) && is_array($departamento)) : ?>
                                    <?php foreach ($departamento as $ver_dep) : ?>
                                        <option value="<?= esc($ver_dep['id']) ?>"><?= esc($ver_dep['dep_name']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected>Sem departamento cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_funcao_departamento_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_cento_de_custo">Cento de Custo:</label>
                            <select name="add_colab_cento_de_custo" class="form-control select2FuncionarioCC" name="colab_form_nome" id="colab_form_nome">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($list_c_custo) && is_array($list_c_custo)) : ?>
                                    <?php foreach ($list_c_custo as $ver_cc) : ?>
                                        <option value="<?= esc($ver_cc['id_cc']) ?>"><?= esc($ver_cc['numero_cc']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Não há CC registrado para sua frente.</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_cento_de_custo_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_hora_extras">Horas trabalhadas:</label>
                            <select name="add_colab_funcao_hora_extras" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_hora_extras_error" class="text-danger"></span>
                        </div>

                        <!-- <div class="form-group col-md-2">
                            <label for="add_colab_funcao_encarregado">Enc.:</label>
                            <select name="add_colab_funcao_encarregado" class="form-control">
                                <option selected disabled>Choose...</option>
                                <option>...</option>
                            </select>
                            <span id="add_colab_funcao_encarregado_error" class="text-danger"></span>
                        </div> -->

                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_periculosidade">Periculosidade:</label>
                            <select name="add_colab_funcao_periculosidade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_periculosidade_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_insalubridade">Insalubridade:</label>
                            <select name="add_colab_funcao_insalubridade" id="add_colab_funcao_insalubridade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_insalubridade_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_desconto_sindical">Desc.: Sindical:</label>
                            <select name="add_colab_funcao_desconto_sindical" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_desconto_sindical_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_ps">PS.:</label>
                            <select name="add_colab_funcao_ps" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="sim">Sim</option>
                                <option value="nao">Não</option>
                            </select>
                            <span id="add_colab_funcao_ps_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Aeroporto</legend>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="add_colab_cep_aeroporto">Cep:</label>
                            <input type="text" class="form-control" name="add_colab_cep_aeroporto" id="add_colab_cep_aeroporto">
                            <span id="add_colab_cep_aeroporto_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_eroporto">UF:</label>
                            <input type="text" class="form-control" name="add_colab_uf_eroporto" id="add_colab_uf_eroporto" placeholder="Ex.: SP" readonly>
                            <span id="add_colab_uf_eroporto_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="add_colab_cidade_aeroporto">Cidade:</label>
                            <input type="text" class="form-control" name="add_colab_cidade_aeroporto" id="add_colab_cidade_aeroporto" placeholder="Ex.: São Paulo" readonly>
                            <span id="add_colab_cidade_aeroporto_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Outros</legend>
                    <div class="form-row">

                        <div class="form-group col-md-5">
                            <label for="add_colab_outros_local_trabalho">Local de Trabalho:</label>
                            <select name="add_colab_outros_local_trabalho" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($list_frente) && is_array($list_frente)) : ?>
                                    <?php foreach ($list_frente as $item_frentes) : ?>
                                        <option value="<?= esc($item_frentes['id_ft']) ?>"><?= esc($item_frentes['nome_ft']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Não ha frentes cadastradas...</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_outros_local_trabalho_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_outros_tipo_moradia">Tipo de moradia:</label>
                            <select name="add_colab_outros_tipo_moradia" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Alojamento">Alojamento</option>
                                <option value="Casa">Casa</option>
                                <option value="Hotel">Hotel</option>
                                <option value="República">República</option>
                                <option value="Pousada">Pousada</option>
                            </select>
                            <span id="add_colab_outros_tipo_moradia_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_status">Status do Cadastro:</label>
                            <select name="add_colab_status" id="add_colab_status" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Ativo">Concuído</option>
                                <option value="Desativado">Com pendência para revisão</option>
                            </select>
                            <span id="add_colab_status_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="add_colab_outros_observacao">Observações:</label>
                            <textarea class="form-control" name="add_colab_outros_observacao" rows="3" placeholder="Digite aqui..."></textarea>
                            <span id="add_colab_outros_observacao_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

            </div>
            <!-- /.card-body -->
            <input type="hidden" name="obra_quem_cadastra" value="<?= session()->get('log_obra') ?>">
            <input type="hidden" name="frente_quem_cadastra" value="<?= session()->get('log_frente') ?>">


            <div class="card-footer">
                <button type="submit" class="cls_add_colab_f btn btn-primary" id="id_add_colab_f"><i class="fa fa-save"></i> Salvar</button>
                <a href="/admin_rh/cadastro-colaboradores" class="btn btn-success"><i class="fa fa-reply-all"></i> Voltar</a>
            </div>
        </form>
        <br>
        <div class="col-12">
            <span id="message_add_funcionario"></span>
        </div>
    </div>
    <!-- /.card -->
</section>
<?= $this->endSection() ?>