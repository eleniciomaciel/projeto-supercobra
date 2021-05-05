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
$routes->get('/', 'Home::index');

$routes->get('/admin-panel','Home::adminPanel');
$routes->post('cadastro_obras','Obras::index');
$routes->get('ver-obra/(:num)','Obras::verObra/$1');
$routes->get('lista-obras','Obras::listaObrasSelect');

$routes->match(['get', 'post'], 'clientes/cadastrar', 'Clientes::cadastrar');
$routes->get('visualizar-cliente/(:num)','Clientes::verAlterar/$1');
$routes->get('lista-clientes','Clientes::listaClientes');

$routes->post('criar_frentes','Frentes::cadastroFrentes');
$routes->get('lista-frentes','Frentes::listaFrentes');

$routes->group('centocusto', function($routes)
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
