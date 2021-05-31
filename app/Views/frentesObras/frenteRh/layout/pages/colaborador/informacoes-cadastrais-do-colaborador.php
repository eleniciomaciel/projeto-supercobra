<?= $this->extend('frentesObras/frenteRh/layout/template/base_layout') ?>

<?= $this->section('content') ?>
<section class="col-lg-12 connectedSortable">
    <!-- TO DO List -->
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Cadastro do colaborador</h3>
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
                        <input type="text" class="form-control" name="x_add_colab_nome" name="x_add_colab_nome" value="<?= esc($dd_funcionarios['f_nome']) ?>">
                        <span id="x_add_colab_nome_error" class="text-danger"></span>
                    </div>

                    <div class="form-group">
                        <label for="x_add_colab_conjuge">Nome do Cônjuge:</label>
                        <input type="text" class="form-control" name="x_add_colab_conjuge" id="x_add_colab_conjuge"  value="<?= esc($dd_funcionarios['f_conjugue']) ?>">
                        <span id="x_add_colab_conjuge_nome_error" class="text-danger"></span>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="x_add_colab_codigo">Código:</label>
                            <input type="text" class="form-control" name="x_add_colab_codigo" id="x_add_colab_codigo"  value="<?= esc($dd_funcionarios['f_codigo']) ?>">
                            <span id="x_add_colab_codigo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="x_add_colab_matricula">Matrícula:</label>
                            <input type="text" class="form-control" name="x_add_colab_matricula" id="x_add_colab_matricula"  value="<?= esc($dd_funcionarios['f_matricula']) ?>">
                            <span id="x_add_colab_matricula_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_sexo">Sexo:</label>
                            <select name="add_colab_sexo" id="add_colab_sexo" class="form-control select2bs4">
                                <option value="Masculino" <?php if($dd_funcionarios['f_sexo'] == "Masculino"){echo "selected";} ?>>Masculino</option>
                                <option value="Feminino" <?php if($dd_funcionarios['f_sexo'] == "Feminino"){echo "selected";} ?>>Feminino</option>
                            </select>
                            <span id="add_colab_sexo_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_estado_civil">Estado Civil:</label>
                            <select name="add_colab_estado_civil" id="add_colab_estado_civil" class="form-control select2EstadoCivil">
                                <option value="Solteiro(a)" <?php if($dd_funcionarios['f_estado_civil'] == 'Solteiro(a)'){echo 'selected';} ?>>Solteiro(a)</option>
                                <option value="Casado(a)" <?php if($dd_funcionarios['f_estado_civil'] == 'Casado(a)'){echo 'selected';} ?>>Casado(a)</option>
                                <option value="Divorciado(a)" <?php if($dd_funcionarios['f_estado_civil'] == 'Divorciado(a)'){echo 'selected';} ?>>Divorciado(a)</option>
                                <option value="Viúvo(a)" <?php if($dd_funcionarios['f_estado_civil'] == 'Viúvo(a)'){echo 'selected';} ?>>Viúvo(a)</option>
                                <option value="Outros" <?php if($dd_funcionarios['f_estado_civil'] == 'Outros'){echo 'selected';} ?>>Outros</option>
                            </select>
                            <span id="add_colab_estado_civil_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_escolaridade">Grau de instrução:</label>
                            <select name="add_colab_escolaridade" id="add_colab_escolaridade" class="form-control select2GrauInstrucai">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="0" <?php if($dd_funcionarios['f_grau_instrucao'] == '0'){echo 'selected';} ?>>Analfabeto</option>
                                <option value="1" <?php if($dd_funcionarios['f_grau_instrucao'] == '1'){echo 'selected';} ?>>Ensino fundamental incompleto</option>
                                <option value="2" <?php if($dd_funcionarios['f_grau_instrucao'] == '2'){echo 'selected';} ?>>Ensino fundamental completo</option>
                                <option value="3" <?php if($dd_funcionarios['f_grau_instrucao'] == '3'){echo 'selected';} ?>>Ensino médio incompleto</option>
                                <option value="4" <?php if($dd_funcionarios['f_grau_instrucao'] == '4'){echo 'selected';} ?>>Ensino médio completo</option>
                                <option value="5" <?php if($dd_funcionarios['f_grau_instrucao'] == '5'){echo 'selected';} ?>>Superior incompleto (graduação)</option>
                                <option value="6" <?php if($dd_funcionarios['f_grau_instrucao'] == '6'){echo 'selected';} ?>>Superior completo (graduação)</option>
                                <option value="7" <?php if($dd_funcionarios['f_grau_instrucao'] == '7'){echo 'selected';} ?>>Pós-graduação</option>
                                <option value="8" <?php if($dd_funcionarios['f_grau_instrucao'] == '8'){echo 'selected';} ?>>MPE</option>
                                <option value="9" <?php if($dd_funcionarios['f_grau_instrucao'] == '9'){echo 'selected';} ?>>Mestrado</option>
                                <option value="10" <?php if($dd_funcionarios['f_grau_instrucao'] == '10'){echo 'selected';} ?>>Doutorado</option>
                                <option value="11" <?php if($dd_funcionarios['f_grau_instrucao'] == '11'){echo 'selected';} ?>>Pós-Doutorado</option>
                            </select>
                            <span id="add_colab_escolaridade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_nacionalidade">Nacionalidade:</label>
                            <select name="add_colab_nacionalidade" id="add_colab_nacionalidade" class="form-control select2Nacionalidade">
                                <option value="Brasileira(a)" <?php if($dd_funcionarios['f_nacionalidade'] == 'Brasileira(a)'){echo 'selected';} ?>>Brasileira(a)</option>
                                <option value="Estrangeira(a)" <?php if($dd_funcionarios['f_nacionalidade'] == 'Estrangeira(a)'){echo 'selected';} ?>>Estrangeira(a)</option>
                            </select>
                            <span id="add_colab_nacionalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_naturalidade">Naturalidade:</label>
                            <input type="text" class="form-control" name="add_colab_naturalidade" id="add_colab_naturalidade" value="<?= esc($dd_funcionarios['f_nacionalidade']) ?>">
                            <span id="add_colab_naturalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_naturalidade">UF da Naturalidade:</label>
                            <select name="up_add_colab_uf_naturalidade" id="up_add_colab_uf_naturalidade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['uf']) ?>" <?php if ($uf['id'] == $dd_funcionarios['f_nacionalidade_uf']) {echo 'selected';}?>><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_uf_naturalidade_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_data_nacimento">Data de nascimento:</label>
                            <input type="date" class="form-control" name="add_colab_data_nacimento" id="add_colab_data_nacimento" value="<?= esc($dd_funcionarios['f_data_nascimento']) ?>">
                            <span id="add_colab_data_nacimento_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_nome_mae">Nome da Mãe:</label>
                            <input type="text" class="form-control" name="add_colab_nome_mae" id="add_colab_nome_mae" value="<?= esc($dd_funcionarios['f_mae']) ?>">
                            <span id="add_colab_nome_mae_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_do_pai">Nome do Pai:</label>
                            <input type="text" class="form-control" name="add_colab_do_pai" id="add_colab_do_pai" value="<?= esc($dd_funcionarios['f_pai']) ?>">
                            <span id="add_colab_do_pai_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Contatos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_pricipal">Contato Principal:</label>
                            <input type="text" class="form-control" name="add_colab_contato_pricipal" id="add_colab_contato_pricipal" value="<?= esc($dd_funcionarios['f_telefone_pessoal']) ?>">
                            <span id="add_colab_contato_pricipal_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_alternativo">Contato Alternativo</label>
                            <input type="text" class="form-control" name="add_colab_contato_alternativo" id="add_colab_contato_alternativo" value="<?= esc($dd_funcionarios['f_contato_alternativo']) ?>">
                            <span id="add_colab_contato_alternativo_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_contato_familiar">Contato Familiar</label>
                            <input type="text" class="form-control" name="add_colab_contato_familiar" id="add_colab_contato_familiar" value="<?= esc($dd_funcionarios['f_telefone_contato']) ?>">
                            <span id="add_colab_contato_familiar_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_email_pessoal">Email Pessoal:</label>
                            <input type="email" class="form-control" name="add_colab_email_pessoal" id="add_colab_email_pessoal" value="<?= esc($dd_funcionarios['f_email_pessoal']) ?>">
                            <span id="add_colab_email_pessoal_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Endereço</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_cep_moradia">CEP:</label>
                            <input type="text" class="form-control" name="add_colab_cep_moradia" id="add_colab_cep_moradia" value="<?= esc($dd_funcionarios['f_cep']) ?>">
                            <span id="add_colab_cep_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_uf_moradia">UF</label>
                            <input type="text" class="form-control" name="add_colab_uf_moradia" id="add_colab_uf_moradia" value="<?= esc($dd_funcionarios['f_estado']) ?>" readonly>
                            <span id="add_colab_uf_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_cidade_moradia">Cidade:</label>
                            <input type="text" class="form-control" name="add_colab_cidade_moradia" id="add_colab_cidade_moradia" value="<?= esc($dd_funcionarios['f_cidade']) ?>" readonly>
                            <span id="add_colab_cidade_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_bairro_moraddia">Bairro:</label>
                            <input type="text" class="form-control" name="add_colab_bairro_moraddia" id="add_colab_bairro_moraddia" value="<?= esc($dd_funcionarios['f_bairro']) ?>">
                            <span id="add_colab_bairro_moraddia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="add_colab_rua_moradia">Rua:</label>
                            <input type="text" class="form-control" name="add_colab_rua_moradia" id="add_colab_rua_moradia" value="<?= esc($dd_funcionarios['f_endereco']) ?>">
                            <span id="add_colab_rua_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_numero_moradia">Número:</label>
                            <input type="number" class="form-control" name="add_colab_numero_moradia" id="add_colab_numero_moradia" value="<?= esc($dd_funcionarios['f_numero_casa']) ?>">
                            <span id="add_colab_numero_moradia_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="add_colab_complemento_morada">Complemento:</label>
                            <input type="text" class="form-control" name="add_colab_complemento_morada" id="add_colab_complemento_morada" value="<?= esc($dd_funcionarios['f_endereco_complemento']) ?>">
                            <span id="add_colab_complemento_morada_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos</legend>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_numero_rg">Número do RG:</label>
                            <input type="number" class="form-control" name="add_colab_doc_numero_rg" id="add_colab_doc_numero_rg" value="<?= esc($dd_funcionarios['f_rg_numero']) ?>">
                            <span id="add_colab_doc_numero_rg_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_orgao_emissor_rg">Emissor do RG:</label>
                            <select name="add_colab_doc_orgao_emissor_rg" id="add_colab_doc_orgao_emissor_rg" class="form-control">
                                <option value="SSP/UF" <?php if($dd_funcionarios['f_rg_emissor'] == 'SSP/UF'){echo 'selected';}?>>SSP/UF</option>
                                <option value="Cartório Civil" <?php if($dd_funcionarios['f_rg_emissor'] == 'Cartório Civil'){echo 'selected';}?>>Cartório Civil</option>
                                <option value="Polícia Federal" <?php if($dd_funcionarios['f_rg_emissor'] == 'Polícia Federal'){echo 'selected';}?>>Polícia Federal</option>
                                <option value="DETRAN" <?php if($dd_funcionarios['f_rg_emissor'] == 'DETRAN'){echo 'selected';}?>>DETRAN</option>
                                <option value="ABNC" <?php if($dd_funcionarios['f_rg_emissor'] == 'ABNC'){echo 'selected';}?>>ABNC</option>
                                <option value="CGPI/DUREX/DPF" <?php if($dd_funcionarios['f_rg_emissor'] == 'CGPI/DUREX/DPF'){echo 'selected';}?>>CGPI/DUREX/DPF</option>
                                <option value="CGPI" <?php if($dd_funcionarios['f_rg_emissor'] == 'CGPI'){echo 'selected';}?>>CGPI</option>
                                <option value="CGPMAF" <?php if($dd_funcionarios['f_rg_emissor'] == 'CGPMAF'){echo 'selected';}?>>CGPMAF</option>
                                <option value="CNIG" <?php if($dd_funcionarios['f_rg_emissor'] == 'CNIG'){echo 'selected';}?>>CNIG</option>
                                <option value="CNT" <?php if($dd_funcionarios['f_rg_emissor'] == 'CNT'){echo 'selected';}?>>CNT</option>
                                <option value="COREN" <?php if($dd_funcionarios['f_rg_emissor'] == 'COREN'){echo 'selected';}?>>COREN</option>
                                <option value="CORECON" <?php if($dd_funcionarios['f_rg_emissor'] == 'CORECON'){echo 'selected';}?>>CORECON</option>
                                <option value="CRA" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRA'){echo 'selected';}?>>CRA</option>
                                <option value="CRAS" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRAS'){echo 'selected';}?>>CRAS</option>
                                <option value="CRB" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRB'){echo 'selected';}?>>CRB</option>
                                <option value="CRC" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRC'){echo 'selected';}?>>CRC</option>
                                <option value="CRE" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRE'){echo 'selected';}?>>CRE</option>
                                <option value="CREA" <?php if($dd_funcionarios['f_rg_emissor'] == 'CREA'){echo 'selected';}?>>CREA</option>
                                <option value="CRECI" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRECI'){echo 'selected';}?>>CRECI</option>
                                <option value="CREFIT" <?php if($dd_funcionarios['f_rg_emissor'] == 'CREFIT'){echo 'selected';}?>>CREFIT</option>
                                <option value="CRESS" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRESS'){echo 'selected';}?>>CRESS</option>
                                <option value="CRF" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRF'){echo 'selected';}?>>CRF</option>
                                <option value="CRM" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRM'){echo 'selected';}?>>CRM</option>
                                <option value="CRO" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRO'){echo 'selected';}?>>CRO</option>
                                <option value="CRP" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRP'){echo 'selected';}?>>CRP</option>
                                <option value="CRPRE" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRPRE'){echo 'selected';}?>>CRPRE</option>
                                <option value="CRQ" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRQ'){echo 'selected';}?>>CRQ</option>
                                <option value="CRRC" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRRC'){echo 'selected';}?>>CRRC</option>
                                <option value="CRMV" <?php if($dd_funcionarios['f_rg_emissor'] == 'CRMV'){echo 'selected';}?>>CRMV</option>
                                <option value="CSC" <?php if($dd_funcionarios['f_rg_emissor'] == 'CSC'){echo 'selected';}?>>CSC</option>
                                <option value="CTPS" <?php if($dd_funcionarios['f_rg_emissor'] == 'CTPS'){echo 'selected';}?>>CTPS</option>
                                <option value="DIC" <?php if($dd_funcionarios['f_rg_emissor'] == 'DIC'){echo 'selected';}?>>DIC</option>
                                <option value="DIREX" <?php if($dd_funcionarios['f_rg_emissor'] == 'DIREX'){echo 'selected';}?>>DIREX</option>
                                <option value="DPMAF" <?php if($dd_funcionarios['f_rg_emissor'] == 'DPMAF'){echo 'selected';}?>>DPMAF</option>
                                <option value="DPT" <?php if($dd_funcionarios['f_rg_emissor'] == 'DPT'){echo 'selected';}?>>DPT</option>
                                <option value="DST" <?php if($dd_funcionarios['f_rg_emissor'] == 'DST'){echo 'selected';}?>>DST</option>
                                <option value="FGTS" <?php if($dd_funcionarios['f_rg_emissor'] == 'FGTS'){echo 'selected';}?>>FGTS</option>
                                <option value="FIPE" <?php if($dd_funcionarios['f_rg_emissor'] == 'FIPE'){echo 'selected';}?>>FIPE</option>
                                <option value="FLS" <?php if($dd_funcionarios['f_rg_emissor'] == 'FLS'){echo 'selected';}?>>FLS</option>
                                <option value="GOVGO" <?php if($dd_funcionarios['f_rg_emissor'] == 'GOVGO'){echo 'selected';}?>>GOVGO</option>
                                <option value="CLA" <?php if($dd_funcionarios['f_rg_emissor'] == 'CLA'){echo 'selected';}?>>CLA</option>
                                <option value="IFP" <?php if($dd_funcionarios['f_rg_emissor'] == 'IFP'){echo 'selected';}?>>IFP</option>
                                <option value="IGP" <?php if($dd_funcionarios['f_rg_emissor'] == 'IGP'){echo 'selected';}?>>IGP</option>
                                <option value="IICCECF/RO" <?php if($dd_funcionarios['f_rg_emissor'] == 'IICCECF/RO'){echo 'selected';}?>>IICCECF/RO</option>
                                <option value="IIMG" <?php if($dd_funcionarios['f_rg_emissor'] == 'IIMG'){echo 'selected';}?>>IIMG</option>
                                <option value="IML" <?php if($dd_funcionarios['f_rg_emissor'] == 'IML'){echo 'selected';}?>>IML</option>
                                <option value="IPC" <?php if($dd_funcionarios['f_rg_emissor'] == 'IPC'){echo 'selected';}?>>IPC</option>
                                <option value="IPF" <?php if($dd_funcionarios['f_rg_emissor'] == 'IPF'){echo 'selected';}?>>IPF</option>
                                <option value="MAE" <?php if($dd_funcionarios['f_rg_emissor'] == 'MAE'){echo 'selected';}?>>MAE</option>
                                <option value="MEX" <?php if($dd_funcionarios['f_rg_emissor'] == 'MEX'){echo 'selected';}?>>MEX</option>
                                <option value="MMA" <?php if($dd_funcionarios['f_rg_emissor'] == 'MMA'){echo 'selected';}?>>MMA</option>
                                <option value="OAB" <?php if($dd_funcionarios['f_rg_emissor'] == 'OAB'){echo 'selected';}?>>OAB</option>
                                <option value="OMB" <?php if($dd_funcionarios['f_rg_emissor'] == 'OMB'){echo 'selected';}?>>OMB</option>
                                <option value="PCMG" <?php if($dd_funcionarios['f_rg_emissor'] == 'PCMG'){echo 'selected';}?>>PCMG</option>
                                <option value="PMMG" <?php if($dd_funcionarios['f_rg_emissor'] == 'PMMG'){echo 'selected';}?>>PMMG</option>
                                <option value="POF ou DPF" <?php if($dd_funcionarios['f_rg_emissor'] == 'POF ou DPF'){echo 'selected';}?>>POF ou DPF</option>
                                <option value="POM" <?php if($dd_funcionarios['f_rg_emissor'] == 'POM'){echo 'selected';}?>>POM</option>
                                <option value="SDS" <?php if($dd_funcionarios['f_rg_emissor'] == 'SDS'){echo 'selected';}?>>SDS</option>
                                <option value="SNJ" <?php if($dd_funcionarios['f_rg_emissor'] == 'SNJ'){echo 'selected';}?>>SNJ</option>
                                <option value="SECC" <?php if($dd_funcionarios['f_rg_emissor'] == 'SECC'){echo 'selected';}?>>SECC</option>
                                <option value="SEJUSP" <?php if($dd_funcionarios['f_rg_emissor'] == 'SEJUSP'){echo 'selected';}?>>SEJUSP</option>
                                <option value="SES ou EST" <?php if($dd_funcionarios['f_rg_emissor'] == 'SES ou EST'){echo 'selected';}?>>SES ou EST</option>
                                <option value="SESP" <?php if($dd_funcionarios['f_rg_emissor'] == 'SESP'){echo 'selected';}?>>SESP</option>
                                <option value="SJS" <?php if($dd_funcionarios['f_rg_emissor'] == 'SJS'){echo 'selected';}?>>SJS</option>
                                <option value="SJTC" <?php if($dd_funcionarios['f_rg_emissor'] == 'SJTC'){echo 'selected';}?>>SJTC</option>
                                <option value="SJTS" <?php if($dd_funcionarios['f_rg_emissor'] == 'SJTS'){echo 'selected';}?>>SJTS</option>
                                <option value="SPTC" <?php if($dd_funcionarios['f_rg_emissor'] == 'SPTC'){echo 'selected';}?>>SPTC</option>
                            </select>
                            <span id="add_colab_doc_orgao_emissor_rg_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_data_rg_emissao">Data de Emissão do RG:</label>
                            <input type="date" class="form-control" name="add_colab_doc_data_rg_emissao" id="add_colab_doc_data_rg_emissao"" value="<?= esc($dd_funcionarios['f_rg_data_emissao']) ?>">
                            <span id="add_colab_doc_data_rg_emissao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_doc_uf_rg">UF de Emissão do RG:</label>
                            <select name="add_colab_doc_uf_rg" id="add_colab_doc_uf_rg" class="form-control select2EmissorRG2">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>" <?php if($uf['id'] ==  $dd_funcionarios['f_rg_uf']){echo 'selected';}?>><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_doc_uf_rg_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_titulo_numero">N° do Título:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_numero" id="add_colab_titulo_numero" value="<?= esc($dd_funcionarios['f_titulo_eleitor_numero']) ?>">
                            <span id="add_colab_titulo_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_zona">Zona:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_zona" id="add_colab_titulo_zona" value="<?= esc($dd_funcionarios['f_titulo_eleitor_nona']) ?>">
                            <span id="add_colab_titulo_zona_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_sessao">Sessão:</label>
                            <input type="number" class="form-control" name="add_colab_titulo_sessao" id="add_colab_titulo_sessao" value="<?= esc($dd_funcionarios['f_titulo_eleitor_sessao']) ?>">
                            <span id="add_colab_titulo_sessao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_titulo_data_emissao">Data de Emissão:</label>
                            <input type="date" class="form-control" name="add_colab_titulo_data_emissao" id="add_colab_titulo_data_emissao" value="<?= esc($dd_funcionarios['f_titulo_eleitor_data_emissao']) ?>">
                            <span id="add_colab_titulo_data_emissao_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="add_colab_titulo_uf_emissao">UF de Emissão:</label>
                            <select name="add_colab_titulo_uf_emissao" id="add_colab_titulo_uf_emissao" class="form-control select2TituloUf">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>"  <?php if($uf['id'] ==  $dd_funcionarios['f_titulo_eleitor_uf']){echo 'selected';}?>><?= esc($uf['nome']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Sem estados cadastrados</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_titulo_uf_emissao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_cpf_numero">Número do CPF:</label>
                            <input type="text" class="form-control" name="add_colab_cpf_numero" id="add_colab_cpf_numero" value="<?= esc($dd_funcionarios['f_cpf']) ?>">
                            <span id="add_colab_cpf_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_numero_pis">Número do PIS:</label>
                            <input type="number" class="form-control" name="add_colab_numero_pis" id="add_colab_numero_pis" value="<?= esc($dd_funcionarios['f_pis']) ?>">
                            <span id="add_colab_numero_pis_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_reservista_numero">Número do Reservista:</label>
                            <input type="number" class="form-control" name="add_colab_reservista_numero" id="add_colab_reservista_numero" value="<?= esc($dd_funcionarios['f_numero_reservista']) ?>">
                            <span id="add_colab_reservista_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_sus_numero">Número do SUS:</label>
                            <input type="number" class="form-control" name="add_colab_sus_numero" id="add_colab_sus_numero" value="<?= esc($dd_funcionarios['f_numero_cartao_sus']) ?>">
                            <span id="add_colab_sus_numero_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Documentos CTPS/FGTS</legend>
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_numero">Número da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_numero" id="add_colab_ctps_numero" value="<?= esc($dd_funcionarios['f_ctps_numero']) ?>">
                            <span id="add_colab_ctps_numero_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_ctps_serie">Série da CTPS:</label>
                            <input type="number" class="form-control" name="add_colab_ctps_serie" id="add_colab_ctps_serie" value="<?= esc($dd_funcionarios['f_ctps_numero_serie']) ?>">
                            <span id="add_colab_ctps_serie_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_data_emissao">Data de Emissão da CTPS:</label>
                            <input type="date" class="form-control" name="add_colab_data_emissao" value="<?= esc($dd_funcionarios['f_ctps_data_emissao']) ?>">
                            <span id="add_colab_data_emissao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_emissor">UF da CTPS:</label>
                            <select name="add_colab_uf_emissor" id="add_colab_uf_emissor" class="form-control select2UfCTPS">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($estados) && is_array($estados)) : ?>
                                    <?php foreach ($estados as $uf) : ?>
                                        <option id="<?= esc($uf['id']) ?>" <?php if($uf['id'] ==  $dd_funcionarios['f_ctps_uf']){echo 'selected';}?>><?= esc($uf['nome']) ?></option>
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
                                <?php for ($i = 1; $i <= 27; $i++) {
                                ?>
                                    <option value="<?php echo $i ?>" <?php if($i == $dd_funcionarios['f_fgts_categoria']){echo 'selected';}?>><?php echo $i ?></option>
                                <?php
                                } ?>

                            </select>
                            <span id="add_colab_fgts_categoria_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="add_colab_fgts_codigo">Código do FGTS:</label>
                            <input type="text" class="form-control" name="add_colab_fgts_codigo" id="add_colab_fgts_codigo" value="<?= esc($dd_funcionarios['f_fgts_codigo']) ?>">
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
                                <option value="PP" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'PP'){echo 'selected';}?>>PP</option>
                                <option value="P" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'P'){echo 'selected';}?>>P</option>
                                <option value="M" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'M'){echo 'selected';}?>>M</option>
                                <option value="G" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'G'){echo 'selected';}?>>G</option>
                                <option value="GG" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'GG'){echo 'selected';}?>>GG</option>
                                <option value="XGG" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'XGG'){echo 'selected';}?>>XGG</option>
                                <option value="G1" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'G1'){echo 'selected';}?>>G1</option>
                                <option value="G2" <?php if($dd_funcionarios['f_uniforme_camisa'] == 'G2'){echo 'selected';}?>>G2</option>
                            </select>
                            <span id="add_colab_uniforme_tamanho_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_uniforme_calca">Calça:</label>
                            <select name="add_colab_uniforme_calca" id="add_colab_uniforme_calca" class="form-control select2Calca">
                            <option value="PP" <?php if($dd_funcionarios['f_uniforme_calca'] == 'PP'){echo 'selected';}?>>PP</option>
                                <option value="P" <?php if($dd_funcionarios['f_uniforme_calca'] == 'P'){echo 'selected';}?>>P</option>
                                <option value="M" <?php if($dd_funcionarios['f_uniforme_calca'] == 'M'){echo 'selected';}?>>M</option>
                                <option value="G" <?php if($dd_funcionarios['f_uniforme_calca'] == 'G'){echo 'selected';}?>>G</option>
                                <option value="GG" <?php if($dd_funcionarios['f_uniforme_calca'] == 'GG'){echo 'selected';}?>>GG</option>
                                <option value="XGG" <?php if($dd_funcionarios['f_uniforme_calca'] == 'XGG'){echo 'selected';}?>>XGG</option>
                                <option value="G1" <?php if($dd_funcionarios['f_uniforme_calca'] == 'G1'){echo 'selected';}?>>G1</option>
                                <option value="G2" <?php if($dd_funcionarios['f_uniforme_calca'] == 'G2'){echo 'selected';}?>>G2</option>
                            </select>
                            <span id="add_colab_uniforme_calca_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_tipo_sangue">Tipo Sanguíneo:</label>
                            <select name="add_colab_tipo_sangue" id="add_colab_tipo_sangue" class="form-control select2Sangue">
                                <option selected disabled>Selecioen aqui...</option>
                                <option value="A+" <?php if($dd_funcionarios['f_tipo_sangue'] == 'A+'){echo 'selected';}?>>A+</option>
                                <option value="A-" <?php if($dd_funcionarios['f_tipo_sangue'] == 'A-'){echo 'selected';}?>>A-</option>
                                <option value="B+" <?php if($dd_funcionarios['f_tipo_sangue'] == 'B+'){echo 'selected';}?>>B+</option>
                                <option value="B-" <?php if($dd_funcionarios['f_tipo_sangue'] == 'B-'){echo 'selected';}?>>B-</option>
                                <option value="AB+" <?php if($dd_funcionarios['f_tipo_sangue'] == 'AB+'){echo 'selected';}?>>AB+</option>
                                <option value="AB-" <?php if($dd_funcionarios['f_tipo_sangue'] == 'AB-'){echo 'selected';}?>>AB-</option>
                                <option value="O+" <?php if($dd_funcionarios['f_tipo_sangue'] == 'O+'){echo 'selected';}?>>O+</option>
                                <option value="O-" <?php if($dd_funcionarios['f_tipo_sangue'] == 'O-'){echo 'selected';}?>>O-</option>
                            </select>
                            <span id="add_colab_tipo_sangue_error" class="text-danger"></span>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Funcionais</legend>
                    <div class="form-row">

                        <div class="form-group col-md-8">
                            <label for="add_colab_funcao_cargo">Função:</label>
                            <select name="add_colab_funcao_cargo" id="add_colab_funcao_cargo" class="form-control select2CargoTrocaFuncaoTodas">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($funcao) && is_array($funcao)) : ?>
                                    <?php foreach ($funcao as $func_dd) : ?>
                                        <option value="<?= esc($func_dd['id_cargo']) ?>" <?php if($func_dd['id_cargo'] == $dd_funcionarios['f_cargo']){echo 'selected';}?>><?= esc($func_dd['cargo_nome']) ?></option>
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
                                <option value="Ativo" <?php if($dd_funcionarios['f_situacao'] == 'Ativo'){echo 'selected';}?>>Ativo</option>
                                <option value="Inativo" <?php if($dd_funcionarios['f_situacao'] == 'Inativo'){echo 'selected';}?>>Inativo</option>
                            </select>
                            <span id="add_colab_funcao_situacao_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_admissao_data">Admissão:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_admissao_data" id="add_colab_funcao_admissao_data" value="<?= esc($dd_funcionarios['f_admissao']) ?>">
                            <span id="add_colab_funcao_admissao_data_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_desligamento_data">Desligamento:</label>
                            <input type="date" class="form-control" name="add_colab_funcao_desligamento_data" value="<?= esc($dd_funcionarios['f_desligamento']) ?>">
                            <span id="add_colab_funcao_desligamento_data_data_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_hora_extra_fixa">Hor. Ext. Fix.:</label>
                            <select name="add_colab_funcao_hora_extra_fixa" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim" <?php if($dd_funcionarios['f_desligamento'] == ''){echo 'selected';}?>>Sim</option>
                                <option value="Não" <?php if($dd_funcionarios['f_desligamento'] == ''){echo 'selected';}?>>Não</option>
                            </select>
                            <span id="add_colab_funcao_hora_extra_fixa_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_salario">Salário:</label>
                            <input type="text" class="form-control" name="add_colab_funcao_salario" placeholder="Ex.: 1.000,00" value="<?= esc($dd_funcionarios['f_salario']) ?>">
                            <span id="add_colab_funcao_salario_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_pagamento">Tipo de Pagamento:</label>
                            <select name="add_colab_funcao_tipo_pagamento" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Mensal" <?php if($dd_funcionarios['f_tipo_pagamento'] == 'Mensal'){echo 'selected';}?>>Mensal</option>
                                <option value="Quizenal" <?php if($dd_funcionarios['f_tipo_pagamento'] == 'Quizenal'){echo 'selected';}?>>Quizenal</option>
                                <option value="Semanal" <?php if($dd_funcionarios['f_tipo_pagamento'] == 'Semanal'){echo 'selected';}?>>Semanal</option>
                            </select>
                            <span id="add_colab_funcao_tipo_pagamento_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_tipo_salario">Tipo de Salário:</label>
                            <select name="add_colab_funcao_tipo_salario" class="form-control">
                                <option value="Mensalista" selected>Mensalista</option>
                            </select>
                            <span id="add_colab_funcao_tipo_salario_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="add_colab_funcao_departamento">Departamento:</label>
                            <select name="add_colab_funcao_departamento" class="form-control select2DepartamentosTodas">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($departamento) && is_array($departamento)) : ?>
                                    <?php foreach ($departamento as $ver_dep) : ?>
                                        <option value="<?= esc($ver_dep['id']) ?>" <?php if($ver_dep['id'] == $dd_funcionarios['f_fk_id_departamento']){echo 'selected';}?>><?= esc($ver_dep['dep_name']) ?></option>
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
                                        <option value="<?= esc($ver_cc['id_cc']) ?>" <?php if($ver_cc['id_cc'] ==  $dd_funcionarios['f_fk_cento_custo']){echo 'selected';}?>><?= esc($ver_cc['numero_cc']) ?></option>
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
                                <option value="Sim" <?php if($dd_funcionarios['f_horas_trabalho'] == 'sim'){echo 'selected';}?>>Sim</option>
                                <option value="Nao" <?php if($dd_funcionarios['f_horas_trabalho'] == 'nao'){echo 'selected';}?>>Não</option>
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
                                <option value="Sim" <?php if($dd_funcionarios['f_periculosidade'] == 'sim'){echo 'selected';}?>>Sim</option>
                                <option value="Nao" <?php if($dd_funcionarios['f_periculosidade'] == 'nao'){echo 'selected';}?>>Não</option>
                            </select>
                            <span id="add_colab_funcao_periculosidade_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_insalubridade">Insalubridade:</label>
                            <select name="add_colab_funcao_insalubridade" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim" <?php if($dd_funcionarios['f_insalubridade'] == 'sim'){echo 'selected';}?>>Sim</option>
                                <option value="Nao" <?php if($dd_funcionarios['f_insalubridade'] == 'nao'){echo 'selected';}?>>Não</option>
                            </select>
                            <span id="add_colab_funcao_insalubridade_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_desconto_sindical">Desc.: Sindical:</label>
                            <select name="add_colab_funcao_desconto_sindical" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim" <?php if($dd_funcionarios['f_desconto_sindical'] == 'sim'){echo 'selected';}?>>Sim</option>
                                <option value="Nao" <?php if($dd_funcionarios['f_desconto_sindical'] == 'nao'){echo 'selected';}?>>Não</option>
                            </select>
                            <span id="add_colab_funcao_desconto_sindical_error" class="text-danger"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="add_colab_funcao_ps">PS.:</label>
                            <select name="add_colab_funcao_ps" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Sim" <?php if($dd_funcionarios['f_ps'] == 'sim'){echo 'selected';}?>>Sim</option>
                                <option value="Nao" <?php if($dd_funcionarios['f_ps'] == 'nao'){echo 'selected';}?>>Não</option>
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
                            <input type="text" class="form-control" name="add_colab_cep_aeroporto" id="add_colab_cep_aeroporto" value="<?= esc($dd_funcionarios['f_aeroporto_cep']) ?>">
                            <span id="add_colab_cep_aeroporto_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="add_colab_uf_eroporto">UF:</label>
                            <input type="text" class="form-control" name="add_colab_uf_eroporto" id="add_colab_uf_eroporto" value="<?= esc($dd_funcionarios['f_aeroporto_uf']) ?>" readonly>
                            <span id="add_colab_uf_eroporto_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="add_colab_cidade_aeroporto">Cidade:</label>
                            <input type="text" class="form-control" name="add_colab_cidade_aeroporto" id="add_colab_cidade_aeroporto" value="<?= esc($dd_funcionarios['f_aeroporto_cidade']) ?>" readonly>
                            <span id="add_colab_cidade_aeroporto_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Outros</legend>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="add_colab_outros_local_trabalho">Local de Trabalho:</label>
                            <select name="add_colab_outros_local_trabalho" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <?php if (!empty($list_frente) && is_array($list_frente)) : ?>
                                    <?php foreach ($list_frente as $item_frentes) : ?>
                                        <option value="<?= esc($item_frentes['id_ft']) ?>"<?php if($item_frentes['id_ft'] == $dd_funcionarios['f_fk_local_trabalho']){echo 'selected';}?>><?= esc($item_frentes['nome_ft']) ?></option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option selected disabled>Não ha frentes cadastradas...</option>
                                <?php endif ?>
                            </select>
                            <span id="add_colab_outros_local_trabalho_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="add_colab_outros_tipo_moradia">Tipo de moradia:</label>
                            <select name="add_colab_outros_tipo_moradia" class="form-control">
                                <option selected disabled>Selecione aqui...</option>
                                <option value="Alojamento" <?php if($dd_funcionarios['f_tipo_moradia'] == 'Alojamento'){echo 'selected';}?>>Alojamento</option>
                                <option value="Casa" <?php if($dd_funcionarios['f_tipo_moradia'] == 'Casa'){echo 'selected';}?>>Casa</option>
                                <option value="Hotel" <?php if($dd_funcionarios['f_tipo_moradia'] == 'Hotel'){echo 'selected';}?>>Hotel</option>
                                <option value="República" <?php if($dd_funcionarios['f_tipo_moradia'] == 'República'){echo 'selected';}?>>República</option>
                                <option value="Pousada" <?php if($dd_funcionarios['f_tipo_moradia'] == 'Pousada'){echo 'selected';}?>>Pousada</option>
                            </select>
                            <span id="add_colab_outros_tipo_moradia_error" class="text-danger"></span>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="add_colab_outros_observacao">Observações:</label>
                            <textarea class="form-control" name="add_colab_outros_observacao" rows="3" placeholder="Digite aqui..."><?= esc($dd_funcionarios['f_description']) ?></textarea>
                            <span id="add_colab_outros_observacao_error" class="text-danger"></span>
                        </div>

                    </div>
                </fieldset>

            </div>
            <!-- /.card-body -->
            <input type="hidden" name="obra_quem_cadastra" value="<?= session()->get('log_obra') ?>">
            <input type="hidden" name="frente_quem_cadastra" value="<?= session()->get('log_frente') ?>">


            <div class="card-footer">
                <button type="submit" class="cls_add_colab_f btn btn-danger" id="id_add_colab_f"><i class="fas fa-sync-alt"></i> Alterar</button>
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