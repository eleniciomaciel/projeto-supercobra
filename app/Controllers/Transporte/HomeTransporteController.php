<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;


class HomeTransporteController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "TRANSPORTE") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'home-transporte')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
	
		echo view('frentesObras/frenteTransportes/'.$page, $data);
	}

	public function pageEfetivo($page = 'home-efetivo-list')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/layout/pages/efetivo/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
	
		echo view('frentesObras/frenteTransportes/layout/pages/efetivo/'.$page, $data);
	}

	/**lista toast habilitação vencidas */
	public function listHabilitacaoVencidaFrente()
	{
		$id_frente = session()->get('log_frente');
		$model = new FuncionarioModel();
		$status = $model->getHabilitacaoUser($id_frente);
		echo json_encode($status);
	}
}
