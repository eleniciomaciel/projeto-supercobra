<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;

class SolicitacaoMateriaisEquipamentosServicosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "TRANSPORTE") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'solicitacao-materiais-equipamentos-servicos')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['title'] = ucfirst($page); 
		echo view('frentesObras/frenteTransportes/layout/pages/solicitacaoMateriaisEquipamentosServicos/'.$page, $data);
	}
}
