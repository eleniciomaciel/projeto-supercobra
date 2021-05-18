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
        <form>
            <div class="card-body">

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Dados pessoal</legend>

                    <div class="form-group">
                        <label for="add_colab_nome">Nome Completo do colaborador(a):</label>
                        <input type="text" class="form-control" name="add_colab_nome" placeholder="Ex.: Ana Silva">
                    </div>

                    <div class="form-group">
                        <label for="add_colab_conjuge">Nome do Cônjuge:</label>
                        <input type="text" class="form-control" name="add_colab_conjuge" placeholder="Ex.: Pedro Silva">
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="add_colab_codigo">Código:</label>
                            <input type="text" class="form-control" name="add_colab_codigo" placeholder="Ex.: 12345">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_matricula">Matrícula:</label>
                            <input type="text" class="form-control" name="add_colab_matricula" placeholder="Ex.: 12345">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_sexo">Sexo:</label>
                            <select name="add_colab_sexo" class="form-control select2bs4">
                                <option selected disabled>Selecione aqui...</option>
                                <option>Sim</option>
                                <option>Não</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_estado_civil">Estado Civil:</label>
                            <select name="add_colab_estado_civil" class="form-control select2EstadoCivil">
                                <option selected disabled>Selecione aqui...</option>
                                <option>Solteiro(a)</option>
                                <option>Casado(a)</option>
                                <option>Divorciado(a)</option>
                                <option>Viúvo(a)</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_escolaridade">Grau de instrução:</label>
                            <select name="add_colab_escolaridade" class="form-control select2GrauInstrucai">
                                <option selected disabled>Selecione aqui...</option>
                                <option>Analfabeto</option>
                                <option>Ensino fundamental incompleto</option>
                                <option>Ensino fundamental completo</option>
                                <option>Ensino médio incompleto</option>
                                <option>Ensino médio completo</option>
                                <option>Superior incompleto (graduação)</option>
                                <option>Superior completo (graduação)</option>
                                <option>Pós-graduação</option>
                                <option>MPE</option>
                                <option>Mestrado</option>
                                <option>Doutorado</option>
                                <option>Pós-Doutorado</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_nacionalidade">Nacionalidade:</label>
                            <select name="add_colab_nacionalidade" class="form-control select2Nacionalidade">
                                <option selected>Selecione aqui...</option>
                                <option>Brasileira</option>
                                <option>Estrangeira</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_naturalidade">Naturalidade:</label>
                            <input type="text" class="form-control" name="add_colab_naturalidade" placeholder="Ex.: Salvador">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_naturalidade">UF da Naturalidade:</label>
                            <select name="add_colab_uf_naturalidade" class="form-control select2Estados">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_data_nacimento">Data de nascimento:</label>
                            <input type="date" class="form-control" name="add_colab_data_nacimento">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_nome_mae">Nome da Mãe:</label>
                            <input type="text" class="form-control" name="add_colab_nome_mae" placeholder="Ex.: Maria Silva">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_do_pai">Nome do Pai:</label>
                            <input type="text" class="form-control" name="add_colab_do_pai" placeholder="Ex.: Paulo Silva">
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Contatos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_pricipal">Contato Principal:</label>
                            <input type="text" class="form-control" name="add_colab_contato_pricipal" placeholder="(00)9 0000-0000">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_alternativo">Contato Alternativo</label>
                            <input type="text" class="form-control" name="add_colab_contato_alternativo" placeholder="(00)9 0000-0000">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_familiar">Contato Familiar</label>
                            <input type="text" class="form-control" name="add_colab_contato_familiar" placeholder="(00)9 0000-0000">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_email_pessoal">Email Pessoal:</label>
                            <input type="email" class="form-control" name="add_colab_email_pessoal" placeholder="Ex.: eu@email.com">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Endereço</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_cep_moradia">CEP:</label>
                            <input type="text" class="form-control" name="add_colab_cep_moradia" id="add_colab_cep_moradia" placeholder="00-000-000">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_uf_moradia">UF</label>
                            <input type="text" class="form-control" name="add_colab_uf_moradia" id="add_colab_uf_moradia" placeholder="Ex.: BA" readonly>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_cidade_moradia">Cidade:</label>
                            <input type="text" class="form-control" name="add_colab_cidade_moradia" id="add_colab_cidade_moradia" placeholder="Ex.: Salvador" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_bairro_moraddia">Bairro:</label>
                            <input type="text" class="form-control" name="add_colab_bairro_moraddia" id="add_colab_bairro_moraddia" placeholder="Ex.:  Centro">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_rua_moradia">Rua:</label>
                            <input type="emaul" class="form-control" name="add_colab_rua_moradia" id="add_colab_rua_moradia" placeholder="Ex.: Rua Santa Clara">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_numero_moradia">Número:</label>
                            <input type="emaul" class="form-control" name="add_colab_numero_moradia" placeholder="Ex.: 01">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="add_colab_complemento_morada">Complemento:</label>
                            <input type="emaul" class="form-control" name="add_colab_complemento_morada" placeholder="Ex.: Próximo a Praça...">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_numero_rg">Número do RG:</label>
                            <input type="number" class="form-control" id="add_colab_doc_numero_rg" placeholder="Ex.: 94949494">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_orgao_emissor_rg">Emissor do RG:</label>
                            <select name="add_colab_doc_orgao_emissor_rg" class="form-control select2EmissorRG">
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
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_data_rg_emissao">Data de Emissão do RG:</label>
                            <input type="date" class="form-control" name="add_colab_doc_data_rg_emissao">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_uf_rg">UF de Emissão do RG:</label>
                            <select name="add_colab_doc_uf_rg" class="form-control select2EmissorRG2">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_titulo_numero">N° do Título:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_numero" placeholder="Ex.: 123456">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_zona">Zona:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_zona" placeholder="Ex.: 1234">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_sessao">Sessão:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_sessao" placeholder="Ex.: 444">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_data_emissao">Data de Emissão:</label>
                            <input type="date" class="form-control" name="add_colab_titulo_data_emissao">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_uf_emissao">UF de Emissão:</label>
                            <select name="add_colab_titulo_uf_emissao" class="form-control select2TituloUf">
                                <option selected>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_cpf_numero">Número do CPF:</label>
                            <input type="text" class="form-control" name="add_colab_cpf_numero" id="add_colab_cpf_numero" placeholder="Ex.: 94949494">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_numero_pis">Número do PIS:</label>
                            <input type="number" class="form-control" name="add_colab_numero_pis" placeholder="Ex.: 94949494">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_reservista_numero">Número do Reservista:</label>
                            <input type="date" class="form-control" name="add_colab_reservista_numero" placeholder="12345567">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_sus_numero">Número do SUS:</label>
                            <input type="number" class="form-control" name="add_colab_sus_numero" placeholder="Ex.: 94949494">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos CTPS/FGTS</legend>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_numero">Número da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_numero" placeholder="Ex.: 94949494">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_serie">Série da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_serie" placeholder="Ex.: 94949494">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_data_emissao">Data de Emissão da CTPS:</label>
                            <input type="date" class="form-control" name="add_colab_data_emissao">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_emissor">UF da CTPS:</label>
                            <select name="add_colab_uf_emissor" class="form-control select2UfCTPS">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>"><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="add_colab_fgts_categoria">Categoria do FGTS:</label>
                            <select name="add_colab_fgts_categoria" class="form-control select2CTPScategoria">
                                <option selected>Selecione aqui...</option>
                                <?php for ($i = 1; $i <= 27; $i++) {
                                ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                <?php
                                } ?>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="add_colab_fgts_codigo">Código do FGTS:</label>
                            <input type="text" class="form-control" name="add_colab_fgts_codigo" placeholder="Ex.: 12346">
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Uniformes/Tipo Sanguinio</legend>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="add_colab_uniforme_tamanho">Uniforme:</label>
                            <select name="add_colab_uniforme_tamanho" class="form-control select2TamanhoRoupa">
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
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_uniforme_calca">Calça:</label>
                            <select name="add_colab_uniforme_calca" class="form-control select2Calca">
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
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_tipo_sangue">Tipo Sanguíneo:</label>
                            <select name="add_colab_tipo_sangue" class="form-control select2Sangue">
                                <option selected>Selecioen aqui...</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Funcionais</legend>
                    <div class="form-row">

                        <div class="form-group col-md-8">
                            <label for="add_colab_funcao_cargo">Função:</label>
                            <select name="add_colab_funcao_cargo" class="form-control select2CargoTrocaFuncaoTodas">
                            <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($funcao) && is_array($funcao)) : ?>
                                    <?php foreach ($funcao as $func_dd) : ?>
                                        <option value="<?= esc($func_dd['id_cargo']) ?>"><?= esc($func_dd['cargo_nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option>...</option>
                                <?php endif ?>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_situacao">Situação:</label>
                            <select name="add_colab_funcao_situacao" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_admissao_data">Admissão:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_admissao_data">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_desligamento_data">Desligamento:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_desligamento_data">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_hora_extra_fixa">Hor. Ext. Fix.:</label>
                            <select name="add_colab_funcao_hora_extra_fixa" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Não">Não</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_salario">Salário:</label>
                            <input type="text" class="form-control" id="add_colab_funcao_salario" placeholder="Ex.: 1.000,00">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_pagamento">Tipo de Pagamento:</label>
                            <select name="add_colab_funcao_tipo_pagamento" class="form-control">
                                <option selected>Selecione aqui...</option>
                                <option value="Mensal">Mensal</option>
                                <option value="Quizenal">Quizenal</option>
                                <option value="Semanal">Senamal</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_salario">Tipo de Salário:</label>
                            <select name="add_colab_funcao_tipo_salario" class="form-control">
                                <option selected>Selecione aqui...</option>
                                <option value="Mensalista">Mensalista</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_departamento">Departamento:</label>
                            <select name="add_colab_funcao_departamento" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_cento_de_custo">Cento de Custo:</label>
                            <select name="add_colab_cento_de_custo" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_funcao_hora_extras">Horas trabalhadas:</label>
                            <select name="add_colab_funcao_hora_extras" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Nao">Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_funcao_encarregado">Enc.:</label>
                            <select name="add_colab_funcao_encarregado" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_periculosidade">Periculosidade:</label>
                            <select name="add_colab_funcao_periculosidade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Nao">Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_insalubridade">Insalubridade:</label>
                            <select name="add_colab_funcao_insalubridade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Nao">Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_desconto_sindical">Desc.: Sindical:</label>
                            <select name="add_colab_funcao_desconto_sindical" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Nao">Não</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_ps">PS.:</label>
                            <select name="add_colab_funcao_ps" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim">Sim</option>
                                <option value="Nao">Não</option>
                            </select>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Aeroporto</legend>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="add_colab_aeroporto_cidade">Cidade:</label>
                            <select name="add_colab_aeroporto_cidade" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="add_colab_aeroporto_uf">UF:</label>
                            <select name="add_colab_aeroporto_uf" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Outros</legend>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="add_colab_outros_local_trabalho">Local de Trabalho:</label>
                            <select name="add_colab_outros_local_trabalho" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="add_colab_outros_tipo_moradia">Tipo de moradia:</label>
                            <select id="add_colab_outros_tipo_moradia" class="form-control">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="add_colab_outros_observacao">Observações:</label>
                            <textarea class="form-control" id="add_colab_outros_observacao" rows="3" placeholder="Digite aqui..."></textarea>
                        </div>

                    </div>
                </fieldset>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Salvar</button>
                <a href="/admin_rh/cadastro-colaboradores" class="btn btn-success"><i class="fa fa-reply-all"></i> Voltar</a>
            </div>
        </form>
    </div>
    <!-- /.card -->
</section>
<?= $this->endSection() ?>