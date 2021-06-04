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
