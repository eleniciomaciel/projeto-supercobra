<?php

namespace App\Controllers\Rh\Transfer;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\ObrasModel;
use App\Models\FrentesModel;
use App\Models\ConsultasGeralModel;
use App\Models\CargosModel;



class TransferenciaFuncionarioController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "RH") {
			echo view('/');
			exit;
		}
	}

	public function index(int $id)
	{
		$page = 'home-transferencia';

		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/transferencia/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model = new FuncionarioModel();
		$modelObra = new ObrasModel();
		$modelfrente = new FrentesModel();
		$model_consult = new ConsultasGeralModel();
		$model_cargos = new CargosModel();

		$data = [
			'title' 			=>	'Transferência do colaborador',
			'dd_user_t' 		=> 	$model->where('f_id', $id)->first(),
			'view_obra' 		=> 	$modelObra->orderBy('obras_local', 'ASC')->findAll(),
			'view_frente' 		=> 	$modelfrente->orderBy('nome_ft', 'ASC')->findAll(),
			'view_User_dado' 	=> 	$model_consult->getLocadosUsuario($id),
			'view_cargos' 		=> 	$model_cargos->getCargos(),
		];

		return view('frentesObras/frenteRh/layout/pages/transferencia/' . $page, $data);
	}

	public function createTransfer(int $id)
	{
		try {
			$model = new FuncionarioModel();
			if ($this->request->getMethod() === 'post' && $this->validate([
				't_obra' 	=> ['label' => 'Obra', 'rules' => 'required'],
				't_frente' 	=> ['label' => 'Frente', 'rules' => 'required'],
				't_cargo' 	=> ['label' => 'Cargo', 'rules' => 'required'],
			])) {

				$model->save([
					'f_id' 			=> $id,
					'f_cargo' 		=> $this->request->getPost('t_cargo'),
					'f_fk_obra'  	=> $this->request->getPost('t_obra'),
					'f_Fk_frente'  	=> $this->request->getPost('t_frente'),
				]);

				session()->setFlashdata('message', 'Transferencia relizada com sucesso!');
				session()->setFlashdata('alert-class', 'alert-success');
				return redirect()->back();
			} else {
				return redirect()->back()->withInput();
			}
		} catch (\Throwable $e) {
			die($e->getMessage());
		}
	}
}
