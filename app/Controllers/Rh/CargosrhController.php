<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\CargosModel;
use monken\TablesIgniter;

class CargosrhController extends BaseController
{
	public function __construct() {
        $this->security =  \Config\Services::security();
	}
	public function index($page = 'lista-cargos')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/cargos/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$model = new CargosModel();
		$data = [
			'title' => 'Listagem dos cargos',
			'list_cargos' => $model->getCargos()
		]; // Capitalize the first letter
		echo view('frentesObras/frenteRh/layout/pages/cargos/' . $page, $data);
	}

	/**cadastro do cargo */
	public function cadastroCargo($page = 'cadastro-cargos')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/cargos/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$model = new CargosModel();
		$data = [
			'title' => 'Cadastro de funções e cargos'
		]; // Capitalize the first letter
		echo view('frentesObras/frenteRh/layout/pages/cargos/' . $page, $data);
	}

	/**listando dos as funções cadastradas */
	public function list_funcoesCargos()
	{
		$crudModel = new CargosModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
				   ->setDefaultOrder("id_cargo", "DESC")
				   ->setSearch(["cargo_nome", "cargo_description"])
				   ->setOrder(["id_cargo", "cargo_nome", "cargo_description"])
				   ->setOutput(["id_cargo", "cargo_nome", "cargo_description", $crudModel->button()]);
		return $data_table->getDatatable();
	}
	/**Cadastro de funções */
	public function cadastroFuncaoCargos()
	{
		if ($this->request->getMethod() === 'post') {

			$fun_funcao_error = '';
			$fun_descricao_error = '';
			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'fun_funcao' => ['label' => 'FUNÇÃO', 'rules' => 'required|max_length[100]|is_unique[cargos.cargo_nome]',
				'errors' => [
					'required' => 'A {field} não pode ir vazia.',
					'is_unique' => 'Essa {field} já foi cadastrada.',
				]],
				'fun_descricao' => ['label' => 'DESCRIÇÃO DA FUNÇÃO', 'rules' => 'required',
				'errors' => [
					'required' => 'A {field} não pode está vazia.'
				]],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('fun_funcao')) {
					$fun_funcao_error = $validation->getError('fun_funcao');
				}

				if ($validation->getError('fun_descricao')) {
					$fun_descricao_error = $validation->getError('fun_descricao');
				}
			} else {
				$success = 'yes';
				$crudModel = new CargosModel();
					$crudModel->save([
						'cargo_nome'			=>	strtoupper($this->request->getVar('fun_funcao')),
						'cargo_description'		=>	strtoupper($this->request->getVar('fun_descricao')),
					]);
					$message = '<div class="alert alert-success">Função adicionada com sucesso.</div>';
			}
			$output = array(
				'fun_funcao_error'		=>	$fun_funcao_error,
				'fun_descricao_error'	=>	$fun_descricao_error,
				'error'					=>	$error,
				'success'				=>	$success,
				'message'				=>	$message
			);
			echo json_encode($output);
		}
	}

	public function visualizaUmaFuncao()
	{
		if($this->request->getVar('id'))
        {
            $crudModel = new CargosModel();
            $user_data = $crudModel->where('id_cargo', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**altera dados da função */
	public function alteraUmaFuncao()
	{
		if ($this->request->getMethod() === 'post') {

			$fun_funcao_up_error = '';
			$fun_descricao_up_error = '';
			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'fun_funcao_up' => ['label' => 'FUNÇÃO', 'rules' => 'required|max_length[100]|is_unique[cargos.cargo_nome]',
				'errors' => [
					'required' => 'A {field} não pode ir vazia.',
					'is_unique' => 'Essa {field} já foi cadastrada.',
				]],
				'fun_descricao_up' => ['label' => 'DESCRIÇÃO DA FUNÇÃO', 'rules' => 'required',
				'errors' => [
					'required' => 'A {field} não pode está vazia.'
				]],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('fun_funcao_up')) {
					$fun_funcao_up_error = $validation->getError('fun_funcao_up');
				}

				if ($validation->getError('fun_descricao_up')) {
					$fun_descricao_up_error = $validation->getError('fun_descricao_up');
				}
			} else {
				$success = 'yes';
				$crudModel = new CargosModel();
					$crudModel->save([
						'id_cargo' 					=> $this->request->getVar('hidden_id'),
						'cargo_nome'			=>	strtoupper($this->request->getVar('fun_funcao_up')),
						'cargo_description'		=>	strtoupper($this->request->getVar('fun_descricao_up')),
					]);
					$message = '<div class="alert alert-success">Função alterada com sucesso.</div>';
			}
			$output = array(
				'fun_funcao_up_error'		=>	$fun_funcao_up_error,
				'fun_descricao_up_error'	=>	$fun_descricao_up_error,
				'error'					=>	$error,
				'success'				=>	$success,
				'message'				=>	$message
			);
			echo json_encode($output);
		}
	}

	/**deleta função */
	public function deletaUmaFuncao()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $crudModel = new CargosModel();
            $crudModel->where('id_cargo', $id)->delete($id);
            echo 'Função deletada com sucesso!';
        }
	}

	/**lista os cargos no select */
	public function listaCargosSelect()
	{
		$list = new CargosModel();
		$todasObras = $list->getCargos();
		echo json_encode($todasObras);
	}
}
