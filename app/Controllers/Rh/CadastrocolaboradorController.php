<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\Estados\EstadosModel;
class CadastrocolaboradorController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'cadastro-colaborador')
	{
		if (!is_file(APPPATH . 'Views/frentesObras/frenteRh/layout/pages/colaborador/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['title'] = ucfirst($page); 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}

	public function cadastro($page = 'cadastrar-dados')
	{
		$estados = new EstadosModel();
		if (!is_file(APPPATH . 'Views/frentesObras/frenteRh/layout/pages/colaborador/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['estados'] = $estados->getEstados(); 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}
}