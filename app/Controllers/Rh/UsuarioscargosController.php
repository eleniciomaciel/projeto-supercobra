<?php

namespace App\Controllers\Rh;

use App\Models\FuncionarioModel;
use App\Models\CargofuncoesModel;
use App\Models\DepartamentosModel;
use App\Models\AtividadesModel;
use App\Models\UsuarioscargosModel;
use monken\TablesIgniter;

use App\Controllers\BaseController;

class UsuarioscargosController extends BaseController
{
	public function index()
	{
		$id_frente = session()->get('log_frente');
		$list = new FuncionarioModel();
		$model_funcionarios_frente = $list->getFuncionariosFrente($id_frente);
		echo json_encode($model_funcionarios_frente);
	}

	//seleciona cargo com dunção
	public function selctFuncao()
	{
		$list = new CargofuncoesModel();
		$model = $list->findAll();
		echo json_encode($model);
	}

	/**seleciona departamentos */
	public function selctDepartamento()
	{
		$list = new DepartamentosModel();
		$model = $list->findAll();
		echo json_encode($model);
	}

	/**seleciona departamentos */
	public function selctAtividade()
	{
		$list = new AtividadesModel();
		$model = $list->findAll();
		echo json_encode($model);
	}

	/**usuario cadstra funcionario no cargo */
	public function cadastrarCargoFunconario()
	{
		if ($this->request->getMethod() === 'post') {
			helper(['form', 'url']);
			$funcionario_select_error = '';
			$select_cargo_e_funcoes_error = '';
			$select_departamentos_all_error = '';
			$select_atividades_all_error = '';
			$compositor_description_error = '';
			$rh_cadastro_error = '';


			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'rh_cadastro' 				=> ['label' => 'sua identificação', 'rules' => 'required'],
				'funcionario_select' 		=> ['label' => 'funcionario', 'rules' => 'required'],
				'select_cargo_e_funcoes' 	=> ['label' => 'cargo', 'rules' => 'required'],
				'select_departamentos_all' 	=> ['label' => 'departamento', 'rules' => 'required'],
				'select_atividades_all' 	=> ['label' => 'atividades', 'rules' => 'required'],
				'compositor_description' 	=> ['label' => 'descrição', 'rules' => 'required'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('funcionario_select')) {
					$funcionario_select_error = $validation->getError('funcionario_select');
				}

				if ($validation->getError('select_cargo_e_funcoes')) {
					$select_cargo_e_funcoes_error = $validation->getError('select_cargo_e_funcoes');
				}

				if ($validation->getError('select_departamentos_all')) {
					$select_departamentos_all_error = $validation->getError('select_departamentos_all');
				}

				if ($validation->getError('select_atividades_all')) {
					$select_atividades_all_error = $validation->getError('select_atividades_all');
				}
				if ($validation->getError('compositor_description')) {
					$compositor_description_error = $validation->getError('compositor_description');
				}
				if ($validation->getError('rh_cadastro')) {
					$rh_cadastro_error = $validation->getError('rh_cadastro');
				}

			} else {
				$success = 'yes';
				$model = new UsuarioscargosModel();
				$model->save([
					'uc_fk_id_rh_que_cadastratou'	=>	$this->request->getVar('rh_cadastro'),
					'uc_fk_id_funcionario'			=>	$this->request->getVar('funcionario_select'),
					'uc_fk_id_cargo'				=>	$this->request->getVar('select_cargo_e_funcoes'),
					'uc_fk_id_departamento'			=>	$this->request->getVar('select_departamentos_all'),
					'uc_fk_id_atividade'			=>	$this->request->getVar('select_atividades_all'),
					'uc_description'				=>	$this->request->getVar('compositor_description'),
				]);

				$message = '<div class="alert alert-success">Funcionario adicionado ao cargo com sucesso!</div>';
			}

			$output = array(
				'funcionario_select_error'		=>	$funcionario_select_error,
				'select_cargo_e_funcoes_error'	=>	$select_cargo_e_funcoes_error,
				'select_departamentos_all_error'=>	$select_departamentos_all_error,
				'select_atividades_all_error'	=>	$select_atividades_all_error,
				'compositor_description_error'	=>	$compositor_description_error,
				'rh_cadastro_error'				=>	$rh_cadastro_error,


				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**listando dos as funções cadastradas */
	public function getListFuncionariosFuncao()
	{
		$model = new UsuarioscargosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable())
			->setDefaultOrder("uc_id", "DESC")
			->setSearch(["f_nome", "cf_nome_cargo_funcao", "dep_name", "titulo_nome"])
			->setOrder(["uc_id", "f_nome", "cf_nome_cargo_funcao", "dep_name", "titulo_nome"])
			->setOutput(["created_at", "f_nome", "cf_nome_cargo_funcao", "dep_name", "titulo_nome", $model->button()]);
		return $data_table->getDatatable();
	}
}
