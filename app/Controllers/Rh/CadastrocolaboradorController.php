<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\Estados\EstadosModel;
use App\Models\CargofuncoesModel;
use App\Models\CargosModel;
use App\Models\DepartamentosModel;

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
		$estados 		= new EstadosModel();
		$funcao 		= new CargosModel();
		$departamento  	= new DepartamentosModel();

		if (!is_file(APPPATH . 'Views/frentesObras/frenteRh/layout/pages/colaborador/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
			'estados' 		=> $estados->getEstados(),
			'funcao'  		=> $funcao->findAll(),
			'departamento'  => $departamento->findAll(),
		]; 
		echo view('frentesObras/frenteRh/layout/pages/colaborador/' . $page, $data);
	}
}
