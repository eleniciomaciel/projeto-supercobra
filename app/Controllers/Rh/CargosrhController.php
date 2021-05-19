<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\CargosModel;
use monken\TablesIgniter;
use App\Models\CargofuncoesModel;

class CargosrhController extends BaseController
{
	public function __construct() {
        $this->security =  \Config\Services::security();
		if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
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

	/**cadastra cargos e funcoes */
	public function cadastraCarfosEfuncoes()
	{
		if ($this->request->getMethod() === 'post') 
		{
			$func_select_error = '';
            $cargo_new_nome_error = '';
            $cargo_new_descricao_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'func_select' 			=> ['label' => 'FUNÇÃO', 'rules' => 'required'],
				'cargo_new_nome' 		=> ['label' => 'CARGO', 'rules' => 'required|min_length[3]|max_length[50]|is_unique[cargofuncoes.cf_nome_cargo_funcao]'],
				'cargo_new_descricao' 	=> ['label' => 'DESCRIÇÃO', 'rules' => 'required|min_length[10]']
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('func_select'))
            	{
            		$func_select_error = $validation->getError('func_select');
            	}
            	if($validation->getError('cargo_new_nome'))
            	{
            		$cargo_new_nome_error = $validation->getError('cargo_new_nome');
            	}
            	if($validation->getError('cargo_new_descricao'))
            	{
            		$cargo_new_descricao_error = $validation->getError('cargo_new_descricao');
            	}
            }
            else
            {
            	$success = 'yes';
            	$crudModel = new CargofuncoesModel();
            		$crudModel->save([
            			'cf_fk_funcao'					=>	$this->request->getVar('func_select'),
            			'cf_nome_cargo_funcao'			=>	$this->request->getVar('cargo_new_nome'),
            			'cf_description_cargo_funcao'	=>	$this->request->getVar('cargo_new_descricao')
            		]);
            		$message = '<div class="alert alert-success">Cargo adicioando com sucesso!</div>';
            }

            $output = array(
            	'func_select_error'			=>	$func_select_error,
            	'cargo_new_nome_error'		=>	$cargo_new_nome_error,
            	'cargo_new_descricao_error'	=>	$cargo_new_descricao_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	/********************************      lista dados cargo *******************************/
	/**listando dos as funções cadastradas */
	public function list_funcoesCargosGeral()
	{
		$crudModel = new CargofuncoesModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["cf_nome_cargo_funcao", "cf_description_cargo_funcao"])
				   ->setOrder(["id", "cf_nome_cargo_funcao", "cf_description_cargo_funcao"])
				   ->setOutput(["cargo_nome", "cf_nome_cargo_funcao", "cf_description_cargo_funcao", $crudModel->button()]);
		return $data_table->getDatatable();
	}

	/**mostra dados do curço com função */
	public function visualizaUmaCargoEfuncao()
	{
		if($this->request->getVar('id'))
        {
            $crudModel = new CargofuncoesModel();
            $user_data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**altera cargo e função */
	public function alteraUmCargoEfuncao()
	{
		if ($this->request->getMethod() === 'post') 
		{
			$cargos_select_error = '';
            $fc_cargo_up_error = '';
            $fc_descricao_up_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'cargos_select' 			=> ['label' => 'FUNÇÃO', 'rules' => 'required'],
				'fc_cargo_up' 		=> ['label' => 'CARGO', 'rules' => 'required|min_length[3]|max_length[50]|is_unique[cargofuncoes.cf_nome_cargo_funcao]'],
				'fc_descricao_up' 	=> ['label' => 'DESCRIÇÃO', 'rules' => 'required|min_length[10]']
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('cargos_select'))
            	{
            		$cargos_select_error = $validation->getError('cargos_select');
            	}
            	if($validation->getError('fc_cargo_up'))
            	{
            		$fc_cargo_up_error = $validation->getError('fc_cargo_up');
            	}
            	if($validation->getError('fc_descricao_up'))
            	{
            		$fc_descricao_up_error = $validation->getError('fc_descricao_up');
            	}
            }
            else
            {
            	$success = 'yes';
            	$crudModel = new CargofuncoesModel();
            		$crudModel->save([
            			'id'							=>	$this->request->getVar('hidden_id_cargo'),
            			'cf_fk_funcao'					=>	$this->request->getVar('cargos_select'),
            			'cf_nome_cargo_funcao'			=>	$this->request->getVar('fc_cargo_up'),
            			'cf_description_cargo_funcao'	=>	$this->request->getVar('fc_descricao_up')
            		]);
            		$message = '<div class="alert alert-success">Cargo altrado com sucesso!</div>';
            }

            $output = array(
            	'cargos_select_error'	=>	$cargos_select_error,
            	'fc_cargo_up_error'		=>	$fc_cargo_up_error,
            	'fc_descricao_up_error'	=>	$fc_descricao_up_error,
            	'error'					=>	$error,
            	'success'				=>	$success,
            	'message'				=>	$message
            );

            echo json_encode($output);
		}
	}

	/**deleta curso rh */
	public function deletaUmCargoEfuncao()
	{
		if ($this->request->getVar('id_dl')) {
			$id = $this->request->getVar('id_dl');
			$cargo = new CargofuncoesModel();
			$cargo->where('id', $id)->delete($id);
			echo 'Cargo deletado com sucesso!';
		}
	}

	/**listando dos as funções cadastradas */
	public function list_funcoesCargosGeralTodos()
	{
		$crudModel = new CargofuncoesModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
			->setDefaultOrder("id", "DESC")
			->setSearch(["cf_nome_cargo_funcao", "cf_description_cargo_funcao"])
			->setOrder(["id", "cf_nome_cargo_funcao", "cf_description_cargo_funcao"])
			->setOutput(["created_at", "cargo_nome", "cf_nome_cargo_funcao", "cf_description_cargo_funcao", $crudModel->button()]);
		return $data_table->getDatatable();
	}
}
