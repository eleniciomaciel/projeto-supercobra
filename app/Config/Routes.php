<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->match(['get', 'post'], '/', 'Home::index', ["filter" => "noauth"]);
$routes->match(['get', 'post'], 'valida-acesso', 'Home::login', ["filter" => "noauth"]);
// Admin routes


$routes->group("cadastros", ["filter" => "auth"], function ($routes) {
    $routes->post('cadastro_obras', 'Obras::index');
    $routes->get('ver-obra/(:num)', 'Obras::verObra/$1');
    $routes->get('lista-obras', 'Obras::listaObrasSelect');
});


$routes->group("clientes", ["filter" => "auth"], function ($routes) {
    $routes->match(['get', 'post'], 'lista_todos_clientes_mt', 'Clientes::getCustomers');
    $routes->match(['get', 'post'], 'cadastrar', 'Clientes::cadastrar');
    $routes->get('visualizar-cliente/(:num)', 'Clientes::verAlterar/$1');
    $routes->get('lista-clientes', 'Clientes::listaClientes');
    $routes->post('atualizar-dados-Cliente', 'Clientes::atualizarCliente');
});


$routes->group("frentes", ["filter" => "auth"], function ($routes) {
    $routes->post('criar_frentes','Frentes::cadastroFrentes');
    $routes->get('lista-frentes','Frentes::listaFrentes');
    $routes->get('lista_todas_frentes_obras','Obras::listaObras');
});



$routes->group('centocusto', ["filter" => "auth"], function($routes)
{
    $routes->get('add-cento-custo', 'Centocusto::index');
    $routes->post('save-cento-custo', 'Centocusto::adicionaCentoCusto');
    $routes->get('lista_todos_cc', 'Centocusto::listaCentoCusto');
    $routes->get('ver-cento-custo/(:num)', 'Centocusto::visualizaCentoCusto/$1');
    $routes->post('altera-cento-custo', 'Centocusto::alteraCentoCusto');
    $routes->get('status-cento-custo/(:num)', 'Centocusto::visualizaStatusCentoCusto/$1');
    $routes->post('altera-status_cento-custo/(:num)', 'Centocusto::alterarStatusCentoCusto/$1');
    $routes->post('deleta_cc', 'Centocusto::deleteCentoCusto');
});

$routes->group('usuario_admin', ["filter" => "auth"], function($routes)
{
    $routes->get('add', 'FuncionarioController::index');
    $routes->post('salva_usuarios', 'FuncionarioController::createUsuario');
    $routes->get('lista_usuarios', 'FuncionarioController::listaUsuarios');
});


$routes->group('usuario_acesso', ["filter" => "auth"], function($routes)
{
    $routes->get('criar-login_usuario/(:num)', 'AcessorestritoController::geraAcesso/$1');
    $routes->post('altera_usuario/(:num)', 'AcessorestritoController::updateUsuario/$1');
    $routes->get('login_usuario/(:num)', 'AcessorestritoController::viewDadosLogin/$1');
    $routes->post('gera_acesso_usuarios/(:num)', 'AcessorestritoController::criaUsuarioLogin/$1');
    $routes->post('altera-status-login/(:num)', 'AcessorestritoController::alteraStatusUsuario/$1');
});

$routes->group("admin_master", ["filter" => "auth"], function ($routes) {
    $routes->get("gestao_master", "Home::adminPanel");
});
// RH routes
$routes->group("admin_rh", ["filter" => "auth"], function ($routes) {
    $routes->get("gestao_rh", "Rh/RhController::index");
    //cargos
    $routes->get("cargos-rh", "Rh/CargosrhController::index");
    $routes->get("cadastrar-cargo", "Rh/CargosrhController::cadastroCargo");
    $routes->get("lista_funcoes_cadastradas", "Rh/CargosrhController::list_funcoesCargos");
    $routes->post("cadastra_funcao", "Rh/CargosrhController::cadastroFuncaoCargos");
    $routes->get("verDadosFuncao", "Rh/CargosrhController::visualizaUmaFuncao");
    $routes->post("altera_funcao", "Rh/CargosrhController::alteraUmaFuncao");
    $routes->get("deleta_funcao", "Rh/CargosrhController::deletaUmaFuncao");
    $routes->get("lista-funcoes_select", "Rh/CargosrhController::listaCargosSelect");
    $routes->post("cadastra_cargos_e_funcoes", "Rh/CargosrhController::cadastraCarfosEfuncoes");
    $routes->get("lista_cargos_e_funcoes", "Rh/CargosrhController::list_funcoesCargosGeral");
    $routes->get("lista_um_cargos", "Rh/CargosrhController::visualizaUmaCargoEfuncao");
    $routes->post("altera_cargo_funcao", "Rh/CargosrhController::alteraUmCargoEfuncao");
    $routes->get("deleteCursoRh", "Rh/CargosrhController::deletaUmCargoEfuncao");
    $routes->get("todoCargosFuncRh", "Rh/CargosrhController::list_funcoesCargosGeralTodos");

    $routes->get("cadastro_cnh/(:num)", "Rh/Documentos/DocumentosController::habilitacao/$1"); 

    /**departamentos */
    $routes->get("lista_departamentos", "Rh/DepartamentosController::index");
    $routes->post("cadastra_departamentos", "Rh/DepartamentosController::addDepartamento");
    $routes->get("get_departamento_dados", "Rh/DepartamentosController::DadosDepartamento");
    $routes->post("altera_depatamento", "Rh/DepartamentosController::alteraDadosDepartamento");
    $routes->get("deleta_depatamento", "Rh/DepartamentosController::deletaDadosDepartamento");
/**cc */
    $routes->get("lista-cento-custo", "Rh/RhccController::index");
    $routes->post("adiciona_rh_cc", "Rh/RhccController::addNewCc");
    $routes->get("lista_cc_da_frente", "Rh/RhccController::lista_cc_rh_frente");
    $routes->get("getListDados_cc", "Rh/RhccController::lista_info_cc");
    $routes->post("altera_novo_rh_cc", "Rh/RhccController::alteraDados_cc");
    $routes->get("altera_status_do_cc", "Rh/RhccController::alteraStatusDoCc");
/**cadastro do colaborador */
    $routes->get("cadastro-colaboradores", "Rh/CadastrocolaboradorController::index");
    $routes->get("cadastrar-dados", "Rh/CadastrocolaboradorController::cadastro");
    $routes->post("inserir-funcionario", "Rh/CadastrocolaboradorController::addNovoFuncionario");
    $routes->get("ler_funcionarios_por_frente", "Rh/CadastrocolaboradorController::listFuncionarios");
    $routes->get("atualiza-cadastro-do-funcionario/(:num)", "Rh/CadastrocolaboradorController::visualizaDadosCadastrado/$1");
    $routes->post("altera-funcionario", "Rh/CadastrocolaboradorController::alteraCadastroFuncionario");
/**dados de atividades do rh */
    $routes->get("lista_atividades", "Rh/AtividadesController::index");
    $routes->post("add_atividade", "Rh/AtividadesController::adicionaAtividade");
    $routes->get("dados_atividade", "Rh/AtividadesController::dadosDaAtividade");
    $routes->post("altera_atividade", "Rh/AtividadesController::alteraDadosAtividade");
    $routes->get("delete_atividade", "Rh/AtividadesController::deletaDadosAtividade");
/**selecct do funcionario lista dinamica */
    $routes->get("list_funcionarios_select", "Rh/UsuarioscargosController::index");
    $routes->get("list_funcionarios_funcao", "Rh/UsuarioscargosController::selctFuncao");
    $routes->get("list_funcionarios_departamento", "Rh/UsuarioscargosController::selctDepartamento");
    $routes->get("list_funcionarios_atividade", "Rh/UsuarioscargosController::selctAtividade");
/** cria dados dados do funcionario a obra */
    $routes->post("cria-funcionario_cargo", "Rh/UsuarioscargosController::cadastrarCargoFunconario");
    $routes->get("lista_tabela_funcionarios_cargos", "Rh/UsuarioscargosController::getListFuncionariosFuncao");
/**DOCUMENTOS DO COLABORADOR */
    $routes->get("colaborador-documentos/(:num)", "Rh/Documentos/DocumentosController::index/$1");
    $routes->post("cadastra-arquivo/(:num)", "Rh/Documentos/DocumentosController::uploadDocumentoColaborador/$1");
//$routes->get("lista-documentos/(:num)", "Rh/Documentos/DocumentosController::listaDocUser/$1"); 
    $routes->get("delete_file_doc", "Rh/Documentos/DocumentosController::deleteDocUser"); 

});

$routes->group('arquivos_cnh', ["filter" => "auth"], function($routes)
{
    $routes->add('upload_cnh/(:num)', 'Rh\Documentos\DocumentosController::inseri_nova_cnh/$1');
    $routes->get("cadastro_cnh/(:num)", "Rh\Documentos\DocumentosController::habilitacao/$1"); 
    $routes->get("list_my_cnh/(:num)", "Rh\Documentos\DocumentosController::listCNH/$1"); 
    $routes->add("carrega_cnh_download/(:num)", "Rh\Documentos\DocumentosController::download_cnh/$1"); 
});

/**cliniacas e exames */
$routes->group('exames', ["filter" => "auth"], function($routes)
{
    $routes->get('lista_clinicas', 'Rh\Clinica\ClinicaController::index');
    $routes->post('cadastra-clinica', 'Rh\Clinica\ClinicaController::addClinica');
    $routes->get('lista_clinicas_frentes', 'Rh\Clinica\ClinicaController::listClinicas');
    $routes->get('getClinica', 'Rh\Clinica\ClinicaController::dadosClinica');
    $routes->post('cadastra_altera_clinica', 'Rh\Clinica\ClinicaController::alteraDadosClinicaOne');
    $routes->get('delete_clinica', 'Rh\Clinica\ClinicaController::deleteDadosClinicaOne');

	/**exames config */
    $routes->get('configuracao_exames', 'Rh\Exames\ExamesClinicosController::index');
    $routes->post('cadastra_exames_contratual_ativo', 'Rh\Exames\ExamesClinicosController::addExameContratual');
    $routes->get('list_exames_contratuais', 'Rh\Exames\ExamesClinicosController::listExamesContratuais');
    $routes->get('get_exames_contartual_modal', 'Rh\Exames\ExamesClinicosController::getDadosExame');
	$routes->post('altera_exames_contratual_ativo', 'Rh\Exames\ExamesClinicosController::uPExameContratual');
	$routes->get('delete_exames_contratual_ativo', 'Rh\Exames\ExamesClinicosController::deleteExamesContratuais');

	$routes->post('adiciona_risco_em_grau', 'Rh\Exames\ExamesClinicosController::addRisco');
	$routes->get('list_risco_em_grau', 'Rh\Exames\ExamesClinicosController::listRiscosTrabalho');
	$routes->get('get_exames_riscos', 'Rh\Exames\ExamesClinicosController::verExamesRiscoa');
	$routes->post('alterar_risco_em_grau', 'Rh\Exames\ExamesClinicosController::alteraRisco');
	$routes->get('delete_risco_em_grau', 'Rh\Exames\ExamesClinicosController::deleteRiscos');
	$routes->get('listSelectExamesContrato', 'Rh\Exames\ExamesClinicosController::listaExamesContratuaisSelect');
	$routes->get('listSelectExamesRiscos', 'Rh\Exames\ExamesClinicosController::listaExamesRiscosSelect');
	$routes->get('list_funcao_cargos_riscos', 'Rh\Exames\ExamesClinicosController::getfuncoesCargos');
	
    $routes->get('get_lista_exames_combo', 'Rh\Exames\ExamesClinicosController::getExamesCombo');
    $routes->get('get_lista_one_exames', 'Rh\Exames\ExamesClinicosController::getListExames');
    $routes->get('get_lista_funcao_select', 'Rh\Exames\ExamesClinicosController::listaRiscosFuncaoSelect');
    $routes->post('altera_exames_combo', 'Rh\Exames\ExamesClinicosController::alteraComboExames');
    $routes->get('get_deleteExames', 'Rh\Exames\ExamesClinicosController::deleteExamesCombo');

    $routes->get('riscos-exames', 'Rh\Clinica\ClinicaController::pageConfiguraRascosExames');

    $routes->post('adiciona_combo', 'Rh\Exames\ExamesClinicosController::adicinaComboExames');
    $routes->post('adiciona-exames-cargos', 'Rh\Exames\ExamesClinicosController::adicinaComboExamesTwo');
});

$routes->group('banco', ["filter" => "auth"], function($routes)
{
    $routes->get('page-banco/(:num)', 'Rh\Banco\BancoController::bancoPage/$1');
    $routes->post('cadastro_banco', 'Rh\Banco\BancoController::adicionarBanco');
    $routes->get('get-bancos', 'Rh\Banco\BancoController::listaBancosCadastrados');
    $routes->get('get_list_nacos_select', 'Rh\Banco\BancoController::listaSelectBancos');
    $routes->get('listaOneBanco', 'Rh\Banco\BancoController::dadoBanco');
    $routes->post('altera_dados_banco', 'Rh\Banco\BancoController::alteraBanco');
    $routes->get('deleta_banco', 'Rh\Banco\BancoController::deleteBanco');
    $routes->post('criar-conta_usuario_bancaria', 'Rh\Banco\BancoController::addContaUsuarioBanco');
    $routes->get('getContas_funcionarios/(:num)', 'Rh\Banco\BancoController::listaContasFuncionarios/$1');
    $routes->get('getDadosConta', 'Rh\Banco\BancoController::getContaUsuario');
    $routes->post('conta_usuario_bancaria_alterar', 'Rh\Banco\BancoController::alterarContaUsuarioBanco');
    $routes->get('deleta_conta_usuario', 'Rh\Banco\BancoController::deleteContaUsuario');
    $routes->get('alter_status', 'Rh\Banco\BancoController::alterarStatusContaUsuario');
    $routes->get('get_toast_vence_conta', 'Rh\Banco\BancoController::avisosVencimentosContaBanco');
    $routes->get('get_toast_habilitacao_vencida', 'Rh\CadastrocolaboradorController::listHabilitacaoVencidaFrente');
    $routes->get("visualiza_minha_cnh/(:num)", "Rh\Documentos\DocumentosController::habilitacao/$1"); 
});



/**painel do aso */
$routes->group('aso', ["filter" => "auth"], function($routes)
{
    $routes->get('gerar-aso/(:num)', 'Rh\Aso\AsoController::index/$1');
    $routes->get('lista_cargos', 'Rh\Aso\AsoController::getTodasFuncoes');
    $routes->get('seleciona_riscos_cargos', 'Rh\Aso\AsoController::getRiscosCargos');
    $routes->get('composicao-exames/(:num)', 'Rh\Aso\AsoController::listTiposExamesJaConfigurados/$1');
    $routes->get('lista_exames_retorno_aso/(:num)', 'Rh\Aso\AsoController::listExamesJoin/$1');

    $routes->get('lista_cargos_modal', 'Rh\Aso\AsoController::getListModalCargos');
    $routes->get('lista_cargos_funcoes_modal', 'Rh\Aso\AsoController::getListModalCargosFuncoes');
    $routes->get('lista_exames_combo_modal', 'Rh\Aso\AsoController::getListModalExames');
});

/**área de acesso */
$routes->group('dados_pessoais', ["filter" => "auth"], function($routes)
{
    $routes->get('meus-dados/(:num)', 'Rh\Acesso\AcessoController::index/$1');
    $routes->post('altera-dados-foto/(:num)', 'Rh\Acesso\AcessoController::alteraFoto/$1');
    $routes->post('altera_acesso_senha/(:num)', 'Rh\Acesso\AcessoController::alteraMeuAcesso/$1');
   
});


/**MÃO DE OBRA */
$routes->group('mao_obra', ["filter" => "auth"], function($routes)
{
    $routes->post('adiciona-mao-obra', 'Rh\MaoObra\MaoObraController::index');
    $routes->get('lista_mao_obras', 'Rh\MaoObra\MaoObraController::getMaoObras');
    $routes->get('getMaoObraOne', 'Rh\MaoObra\MaoObraController::getMaoDeObraUnica');
    $routes->post('altera_names-mao-obra', 'Rh\MaoObra\MaoObraController::alteraMaoObraDados');
    $routes->get('deleta_mao_obra/(:num)', 'Rh\MaoObra\MaoObraController::delMaoObraOne/$1');
});
/**adiciona novas frentes */
$routes->group('frentes_trabalho', ["filter" => "auth"], function($routes)
{
    $routes->post('adiciona-frentes-trabalho', 'Rh\FrenteTrabalho\FrentesTrabalhosController::index');
    $routes->get('lista_frente_trabalho', 'Rh\FrenteTrabalho\FrentesTrabalhosController::getFrentesTrabalho');
    $routes->get('getFrenteTrabalho', 'Rh\FrenteTrabalho\FrentesTrabalhosController::getFrentesTrabOne');
    $routes->post('altera_frente_frabalho', 'Rh\FrenteTrabalho\FrentesTrabalhosController::novaFrente');
    $routes->get('deleta_front_work/(:num)', 'Rh\FrenteTrabalho\FrentesTrabalhosController::delFrontWorkOne/$1');
});

/**adiciona novas frentes */
$routes->group('transferencia', ["filter" => "auth"], function($routes)
{
    $routes->get('funcionario-transfere/(:num)', 'Rh\Transfer\TransferenciaFuncionarioController::index/$1');
    $routes->post('processa-transferencia/(:num)', 'Rh\Transfer\TransferenciaFuncionarioController::createTransfer/$1');
});


/**controle de frotas */
$routes->group('frota', ["filter" => "auth"], function($routes)
{
    $routes->get('controle', 'Admin\FrotaController::index');
    $routes->post('adiciona_fornecedor', 'Admin\FrotaController::adicionaFornecedorFrota');
    $routes->get('page-fornecedor-veiculo', 'Admin\FrotaController::fornecedorVeiculo');
    $routes->get('page-fornecedor-oficina', 'Admin\FrotaController::fornecedorOficina');
    $routes->get('page-despesas', 'Admin\FrotaController::lancarDespesas');
    $routes->get('alterar-fornecedor/(:any)', 'Admin\FrotaController::visuliazaStoreFornecedorCarro/$1');
    $routes->post('altera-fornecedor/(:num)', 'Admin\FrotaController::alteraStoreFornecedorCarro/$1');
    $routes->get('deletar-fornecedor/(:num)', 'Admin\FrotaController::deleteFornecedor/$1');

    $routes->add('page-localizacao', 'Admin\FrotaController::localizacaoTransferencia');
    //$routes->get('lista_localizacao-veiculo-pelo-cc', 'Admin\FrotaController::listaLocalizacaoCarros');
});

/**controle veiculos */
$routes->group('veiculos', ["filter" => "auth"], function($routes)
{
    $routes->get('visualizar/(:num)', 'Admin\VeiculosController::verDados_veiculo/$1');
    $routes->get('deletar/(:num)', 'Admin\VeiculosController::deleteVeiculo/$1');
});

/**controle de oficinas */
$routes->group('oficina', ["filter" => "auth"], function($routes)
{
    $routes->get('visualizar/(:num)', 'Admin\OficinaController::visualizarOficina/$1');
    $routes->get('deletar/(:num)', 'Admin\OficinaController::deleteOficina/$1');
});



/**cliniacas e exames */
$routes->group('riscosexames', ["filter" => "auth"], function($routes)
{
    $routes->get('configuracao-exames', 'Rh\Aso\AsoController::pageConfiguraRascosExames');
    $routes->get('lista_exames', 'Rh\Aso\AsoController::selecionaExames');
    $routes->get('cargos_all', 'Rh\Aso\AsoController::selecionaCargo');
    $routes->get('get_dados_usuario_exames_riscos/(:num)', 'Rh\Aso\AsoController::getDadosExamesCargos/$1');
    $routes->post('alterar-exame-aso', 'Rh\Aso\AsoController::alteraExameConfAso');
    $routes->get('delete_exames_config_aso', 'Rh\Aso\AsoController::deleteExameConfAso');
});


/**controle de oficinas */
$routes->group('atividades', ["filter" => "auth"], function($routes)
{
    $routes->post('atividades_frentes', 'Admin\AtividadesController::index');
    $routes->get('getLista_atividades_frentes', 'Admin\AtividadesController::listaAtividadesFrentes');
    $routes->get('one_atividades', 'Admin\AtividadesController::getAtividade');
    $routes->post('atividades_frentes_alterar', 'Admin\AtividadesController::alteraFrenteAtividade');
    $routes->get('delete_atividade', 'Admin\AtividadesController::deleteAtividade');
});


/**controle qualidade */
$routes->group('admin_qualidade', ["filter" => "auth"], function($routes)
{
    $routes->add('home-qualidade', 'Qualidade\HomeQualidadeController::index');
    $routes->add('categoria-de-documentos', 'Qualidade\HomeQualidadeController::categoriaDocuemnto');
    $routes->post('adiciona-categoria', 'Qualidade\HomeQualidadeController::adicionacategoriaDocuemnto');
    $routes->get('visualizar-categoria/(:num)', 'Qualidade\HomeQualidadeController::vertegoriaDocuemnto/$1');
    $routes->post('alterar-categoria/(:num)', 'Qualidade\HomeQualidadeController::alterarCategoriaDocuemnto/$1');
    $routes->get('deletar-categoria/(:num)', 'Qualidade\HomeQualidadeController::deleteCategoria/$1');
    $routes->get('cadastrar-documentos', 'Qualidade\HomeQualidadeController::cadastroDocumento');
    $routes->post('adiciona-documento-qualidade', 'Qualidade\HomeQualidadeController::adicionaDocuemnto');
    $routes->get('visualizar-documento/(:num)', 'Qualidade\HomeQualidadeController::verDocumento/$1');
    $routes->get('revisar-documento/(:num)', 'Qualidade\HomeQualidadeController::alteraPageDocumento/$1');
    $routes->post('alterar-documento-qualidade/(:num)', 'Qualidade\HomeQualidadeController::alteraDocuemnto/$1');
    $routes->get('deletar-documento/(:num)', 'Qualidade\HomeQualidadeController::deletaDocumento/$1');
    $routes->get('perfil-de-acesso', 'Qualidade\HomeQualidadeController::meuPerfil');
    $routes->post('atualiza-foto-acesso/(:num)', 'Qualidade\HomeQualidadeController::alteraFoto/$1');
    $routes->post('dados-acesso_atulizar', 'Qualidade\HomeQualidadeController::atualizaLoginESenha');
});

/**controle de oficinas */
$routes->group('transposte', ["filter" => "auth"], function($routes)
{
    $routes->add('efetivo-transporte', 'Transporte\HomeTransporteController::pageEfetivo');
});


/**controle de kanban */
$routes->group('kanban', ["filter" => "auth"], function($routes)
{
    $routes->add('projeto-kanban', 'Kanban\KanbanController::index');
    $routes->add('cadastrar-projeto', 'Kanban\KanbanController::pageProjeto');
    $routes->post('salvar-projeto', 'Kanban\KanbanController::salvaProjeto');
    $routes->get('projetos-list-one/(:num)', 'Kanban\KanbanController::verProjeto/$1');
    $routes->get('gerar-processo-kanban/(:num)', 'Kanban\KanbanController::verKanbanProjeto/$1');
    $routes->get('adiciona-atividades-do-backlog/(:num)', 'Kanban\KanbanController::paginaBackLog/$1');
    $routes->post('savaBacklog', 'Kanban\KanbanController::salvaBacklogProjeto');
    $routes->get('iniciar-tarefa/(:num)', 'Kanban\KanbanController::iniciaTarefaParaToFazendo/$1');
});

/**controle de kanban */
$routes->group('kanban_to_fazendo', ["filter" => "auth"], function($routes)
{
    $routes->get('adiciona-atividades-to-fazendo/(:num)/(:num)', 'Kanban\ToFazendoController::index/$1/$2');
    $routes->get('muda-estado-da-tarefa', 'Kanban\ToFazendoController::alteraTarefaOne');
    $routes->get('iniciar-processo-de-homolocacao/(:num)/(:num)', 'Kanban\ToFazendoController::painelDeHomologacao/$1/$2');
});

/**hologação de kanban */
$routes->group('kanban-homologacao', ["filter" => "auth"], function($routes)
{
    $routes->get('painel-de-homologacao-status/(:num)/(:num)', 'Kanban\HomologacaoController::index/$1/$2');
    $routes->get('atualizar-etapa-homologacao/(:num)', 'Kanban\HomologacaoController::atualizaEtapa/$1');
});

/**hologação de kanban */
$routes->group('kanban-agenda', ["filter" => "auth"], function($routes)
{
    $routes->get('agenda-de-trabalho', 'Kanban\AgendaController::index');
    $routes->get('event', 'Kanban\AgendaController::lerDadosDaAgenda');
    $routes->match(['get', 'post'], 'eventAjax', 'Kanban\AgendaController::ajax');
});

/**controle de oficinas */
$routes->group('admin_transporte', ["filter" => "auth"], function($routes)
{
    $routes->get('home-transporte', 'Transporte\HomeTransporteController::index');
});

/**controle de compras carro */
$routes->group('transposte-solicitacao-material-equipamentos-servicos', ["filter" => "auth"], function($routes)
{
    $routes->add('solicitacao-mes', 'Transporte\SolicitacaoMateriaisEquipamentosServicosController::index');
    $routes->add('visualizar-solicitacao/(:num)', 'Transporte\SolicitacaoMateriaisEquipamentosServicosController::verSolicitacao/$1');
    $routes->add('adicionar-itens/(:num)', 'Transporte\SolicitacaoMateriaisEquipamentosServicosController::addItens/$1');
    $routes->add('adicionar-arquivos/(:num)', 'Transporte\SolicitacaoMateriaisEquipamentosServicosController::paginaArquivos/$1');
    $routes->add('visualizar-arquivo/(:num)', 'Transporte\SolicitacaoMateriaisEquipamentosServicosController::paginaArquivosPdf/$1');
});

/**controle de oficinas */
$routes->group('transporte-fornecedor', ["filter" => "auth"], function($routes)
{
    $routes->add('fornecedor', 'Transporte\FornecedorController::index');
    $routes->get('dados-fornecedor/(:num)', 'Transporte\FornecedorController::dadosFornecedor/$1');
    $routes->get('contas-fornecedor/(:num)', 'Transporte\FornecedorController::contasFornecedor/$1');
    $routes->get('documentos-fornecedor/(:num)', 'Transporte\FornecedorController::documentosFornecedor/$1');
    $routes->get('empresas-fornecedor/(:num)', 'Transporte\FornecedorController::empresasFornecedor/$1');
    $routes->get('contratos-fornecedor/(:num)', 'Transporte\FornecedorController::contratosFornecedor/$1');
});

$routes->get('logout', 'Home::logout');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
