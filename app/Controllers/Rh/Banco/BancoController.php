<?php

namespace App\Controllers\Rh\Banco;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\BancosModel;
use App\Models\BancousuariosModel;
use monken\TablesIgniter;

class BancoController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "RH") {
			echo view('/');
			exit;
		}
	}

	public function bancoPage( int $id)
	{
		$page = 'home-banco';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/banco/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$funcionario = new FuncionarioModel();
		$data = [
			'title' => 'Informações das banco',
			'funcionario' => $funcionario->getFuncionariosId($id),
		];
		//dd($data);
//$crudModel->where('f_id', $id)->first();
		return view('frentesObras/frenteRh/layout/pages/banco/' . $page, $data);
	}

	public function adicionarBanco()
	{
		if ($this->request->getMethod() === 'post') {
			$nome_banco_error = '';
			$numero_banco_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'nome_banco' => ['label' => 'nome do banco', 'rules' => 'required|max_length[100]|is_unique[bancos.b_nome]'],
				'numero_banco' => ['label' => 'número do banco', 'rules' => 'required|numeric|max_length[3]|min_length[1]|is_unique[bancos.b_numero]']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('nome_banco')) {
					$nome_banco_error = $validation->getError('nome_banco');
				}

				if ($validation->getError('numero_banco')) {
					$numero_banco_error = $validation->getError('numero_banco');
				}
			} else {
				$success = 'yes';

				$crudModel = new BancosModel();
				$crudModel->save([
					'b_nome'	=>	$this->request->getVar('nome_banco'),
					'b_numero'	=>	$this->request->getVar('numero_banco')
				]);

				$message = '<div class="alert alert-success">Banco adicionado com sucesso!</div>';
			}

			$output = array(
				'nome_banco_error'	=>	$nome_banco_error,
				'numero_banco_error'	=>	$numero_banco_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	public function listaBancosCadastrados()
	{
		$model_banco = new BancosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model_banco->noticeTable())
			->setDefaultOrder("id_b", "DESC")
			->setSearch(["b_nome", "b_numero"])
			->setOrder(["id_b", "b_nome", "b_numero"])
			->setOutput(["b_nome", "b_numero", $model_banco->button()]);
		return $data_table->getDatatable();
	}

	public function listaSelectBancos()
	{
		$list = new BancosModel();
		$todasExamesContratuais = $list->findAll();
		echo json_encode($todasExamesContratuais);
	}

	public function dadoBanco()
	{
		if ($this->request->getVar('id')) {
			$crudModel = new BancosModel();
			$user_data = $crudModel->where('id_b', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}

	public function alteraBanco()
	{
		if ($this->request->getMethod() === 'post') {
			$b_nome_error = '';
			$b_numero_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'b_nome' => ['label' => 'nome do banco', 'rules' => 'required|max_length[100]'],
				'b_numero' => ['label' => 'número do banco', 'rules' => 'required|numeric|max_length[3]|min_length[1]']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('b_nome')) {
					$b_nome_error = $validation->getError('b_nome');
				}

				if ($validation->getError('b_numero')) {
					$b_numero_error = $validation->getError('b_numero');
				}
			} else {
				$success = 'yes';

				$crudModel = new BancosModel();
				$crudModel->save([
					'id_b' => $this->request->getVar('hidden_id_banco'),
					'b_nome'	=>	$this->request->getVar('b_nome'),
					'b_numero'	=>	$this->request->getVar('b_numero')
				]);

				$message = '<div class="alert alert-success">Banco alterado com sucesso!</div>';
			}

			$output = array(
				'b_nome_error'	=>	$b_nome_error,
				'b_numero_error'	=>	$b_numero_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	public function deleteBanco()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$crudModel = new BancosModel();
			$crudModel->where('id_b', $id)->delete($id);
			echo 'Banco deletado com sucesso!';
		}
	}

	public function addContaUsuarioBanco()
	{
		if ($this->request->getMethod() === 'post') {
			
			$select_banco_cad_error = '';
			$us_tipo_conta_error = '';
			$ub_agenco_error = '';
			$up_digito_agencia_error = '';
			$ub_numero_conta_error = '';
			$bu_digito_conta_error = '';
			$bu_status_conta_error = '';
			$bu_tutular_conta_error = '';
			$bu_data_vencimento_conta_error = '';
			$bu_observacao_conta_error = '';
			$frente_id_error = '';


			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'select_banco_cad' 			=> ['label' => 'banco', 'rules' => 'required'],
				'ub_tipo_conta' 			=> ['label' => 'tipo de cota bb', 'rules' => 'required'],
				'ub_agenco' 				=> ['label' => 'agência', 'rules' => 'required|max_length[40]'],
				'up_digito_agencia' 		=> ['label' => 'dígito da agencia', 'rules' => 'required|max_length[20]|integer'],
				'ub_numero_conta' 			=> ['label' => 'nº da agência', 'rules' => 'required|max_length[20]|integer'],
				'bu_digito_conta' 			=> ['label' => 'dígito da conta', 'rules' => 'required|max_length[3]|integer'],
				'bu_status_conta' 			=> ['label' => 'status da conta', 'rules' => 'required'],
				'bu_tutular_conta' 			=> ['label' => 'titular da conta', 'rules' => 'required'],
				'bu_data_vencimento_conta' 	=> ['label' => 'data de vencimento', 'rules' => 'required|valid_date'],
				'bu_observacao_conta' 		=> ['label' => 'Observação', 'rules' => 'required'],
				'frente_id' 		        => ['label' => 'Frente', 'rules' => 'required'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('select_banco_cad')) {
					$select_banco_cad_error = $validation->getError('select_banco_cad');
				}

				if ($validation->getError('ub_tipo_conta')) {
					$us_tipo_conta_error = $validation->getError('ub_tipo_conta');
				}

				if ($validation->getError('ub_agenco')) {
					$ub_agenco_error = $validation->getError('ub_agenco');
				}

				if ($validation->getError('up_digito_agencia')) {
					$up_digito_agencia_error = $validation->getError('up_digito_agencia');
				}

				if ($validation->getError('ub_numero_conta')) {
					$ub_numero_conta_error = $validation->getError('ub_numero_conta');
				}

				if ($validation->getError('bu_digito_conta')) {
					$bu_digito_conta_error = $validation->getError('bu_digito_conta');
				}

				if ($validation->getError('bu_status_conta')) {
					$bu_status_conta_error = $validation->getError('bu_status_conta');
				}

				if ($validation->getError('bu_tutular_conta')) {
					$bu_tutular_conta_error = $validation->getError('bu_tutular_conta');
				}

				if ($validation->getError('bu_data_vencimento_conta')) {
					$bu_data_vencimento_conta_error = $validation->getError('bu_data_vencimento_conta');
				}

				if ($validation->getError('bu_observacao_conta')) {
					$bu_observacao_conta_error = $validation->getError('bu_observacao_conta');
				}
				if ($validation->getError('frente_id')) {
					$frente_id_error = $validation->getError('frente_id');
				}
			} else {
				$success = 'yes';
				$mdel_banco_usuario = new BancousuariosModel();
					$mdel_banco_usuario->save([
						'fk_funcionario_bu'			=>	$this->request->getVar('bu_usuario_conta'),
						'fk_banco_bu'				=>	$this->request->getVar('select_banco_cad'),
						'fk_frente_bu'				=>	$this->request->getVar('frente_id'),
						'tipo_conta_bu'				=>	$this->request->getVar('ub_tipo_conta'),
						'agencia_bu'				=>	$this->request->getVar('ub_agenco'),
						'digito_agencia_bu'			=>	$this->request->getVar('up_digito_agencia'),
						'numero_conta_bu'			=>	$this->request->getVar('ub_numero_conta'),
						'digito_conta_bu'			=>	$this->request->getVar('bu_digito_conta'),
						'status_conta_bu'			=>	$this->request->getVar('bu_status_conta'),
						'titular_status_bu'			=>	$this->request->getVar('bu_tutular_conta'),
						'data_vencimento_conta_bu'	=>	$this->request->getVar('bu_data_vencimento_conta'),
						'observacao_bu'				=>	$this->request->getVar('bu_observacao_conta'),
					]);

					$message = '<div class="alert alert-success">Conta bancária adicionada com sucesso!</div>';
			}

			$output = array(
				'select_banco_cad_error'			=>	$select_banco_cad_error,
				'us_tipo_conta_error'				=>	$us_tipo_conta_error,
				'ub_agenco_error'					=>	$ub_agenco_error,
				'up_digito_agencia_error'			=>	$up_digito_agencia_error,
				'ub_numero_conta_error'				=>	$ub_numero_conta_error,
				'bu_digito_conta_error'				=>	$bu_digito_conta_error,
				'bu_status_conta_error'				=>	$bu_status_conta_error,
				'bu_tutular_conta_error'			=>	$bu_tutular_conta_error,
				'bu_data_vencimento_conta_error'	=>	$bu_data_vencimento_conta_error,
				'bu_observacao_conta_error'			=>	$bu_observacao_conta_error,
				'frente_id_error'					=>	$frente_id_error,


				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**contas dos usuários */
	public function listaContasFuncionarios(int $id)
	{
		$model_banco_usuarios = new BancousuariosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model_banco_usuarios->noticeTable($id))
				   ->setDefaultOrder("id_bu", "DESC")
				   ->setSearch(["b_nome", "agencia_bu", "numero_conta_bu", "digito_agencia_bu", "tipo_conta_bu", "status_conta_bu"])
				   ->setOrder(["b_nome", "agencia_bu", "numero_conta_bu", "digito_agencia_bu", "tipo_conta_bu", "status_conta_bu"])
				   ->setOutput(["b_nome", "agencia_bu", "numero_conta_bu", "digito_agencia_bu", "tipo_conta_bu", "status_conta_bu", $model_banco_usuarios->button()]);
		return $data_table->getDatatable();
	}

	public function getContaUsuario()
	{
		if ($this->request->getVar('id')) {
			$crudModel = new BancousuariosModel();
			$user_data = $crudModel->where('id_bu', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}

	public function alterarContaUsuarioBanco()
	{
		if ($this->request->getMethod() === 'post') {
			
			$fk_banco_bu_error = '';
			$tipo_conta_bu_error = '';
			$agencia_bu_error = '';
			$digito_agencia_bu_error = '';
			$numero_conta_bu_error = '';
			$digito_conta_bu_error = '';
			$status_conta_bu_error = '';
			$titular_status_bu_error = '';
			$data_vencimento_conta_bu_error = '';
			$observacao_bu_error = '';


			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'fk_banco_bu' 				=> ['label' => 'banco', 'rules' => 'required'],
				'tipo_conta_bu' 			=> ['label' => 'tipo de cota', 'rules' => 'required'],
				'agencia_bu' 				=> ['label' => 'agência', 'rules' => 'required|max_length[40]'],
				'digito_agencia_bu' 		=> ['label' => 'dígito da agencia', 'rules' => 'required|max_length[20]|integer'],
				'numero_conta_bu' 			=> ['label' => 'nº da agência', 'rules' => 'required|max_length[20]|integer'],
				'digito_conta_bu' 			=> ['label' => 'dígito da conta', 'rules' => 'required|max_length[3]|integer'],
				'status_conta_bu' 			=> ['label' => 'status da conta', 'rules' => 'required'],
				'titular_status_bu' 		=> ['label' => 'titular da conta', 'rules' => 'required'],
				'data_vencimento_conta_bu' 	=> ['label' => 'data de vencimento', 'rules' => 'required|valid_date'],
				'observacao_bu' 			=> ['label' => 'Observação', 'rules' => 'required'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('fk_banco_bu')) {
					$fk_banco_bu_error = $validation->getError('fk_banco_bu');
				}

				if ($validation->getError('tipo_conta_bu')) {
					$tipo_conta_bu_error = $validation->getError('tipo_conta_bu');
				}

				if ($validation->getError('agencia_bu')) {
					$agencia_bu_error = $validation->getError('agencia_bu');
				}

				if ($validation->getError('digito_agencia_bu')) {
					$digito_agencia_bu_error = $validation->getError('digito_agencia_bu');
				}

				if ($validation->getError('numero_conta_bu')) {
					$numero_conta_bu_error = $validation->getError('numero_conta_bu');
				}

				if ($validation->getError('digito_conta_bu')) {
					$digito_conta_bu_error = $validation->getError('digito_conta_bu');
				}

				if ($validation->getError('status_conta_bu')) {
					$status_conta_bu_error = $validation->getError('status_conta_bu');
				}

				if ($validation->getError('titular_status_bu')) {
					$titular_status_bu_error = $validation->getError('titular_status_bu');
				}

				if ($validation->getError('data_vencimento_conta_bu')) {
					$data_vencimento_conta_bu_error = $validation->getError('data_vencimento_conta_bu');
				}

				if ($validation->getError('observacao_bu')) {
					$observacao_bu_error = $validation->getError('observacao_bu');
				}
			} else {
				$success = 'yes';
				$mdel_banco_usuario = new BancousuariosModel();
					$mdel_banco_usuario->save([
						'id_bu'						=>	$this->request->getVar('hidden_id_conta_user'),
						'fk_banco_bu'				=>	$this->request->getVar('fk_banco_bu'),
						'tipo_conta_bu'				=>	$this->request->getVar('tipo_conta_bu'),
						'agencia_bu'				=>	$this->request->getVar('agencia_bu'),
						'digito_agencia_bu'			=>	$this->request->getVar('digito_agencia_bu'),
						'numero_conta_bu'			=>	$this->request->getVar('numero_conta_bu'),
						'digito_conta_bu'			=>	$this->request->getVar('digito_conta_bu'),
						'status_conta_bu'			=>	$this->request->getVar('status_conta_bu'),
						'titular_status_bu'			=>	$this->request->getVar('titular_status_bu'),
						'data_vencimento_conta_bu'	=>	$this->request->getVar('data_vencimento_conta_bu'),
						'observacao_bu'				=>	$this->request->getVar('observacao_bu'),
					]);

					$message = '<div class="alert alert-success">Conta bancária alterado com sucesso!</div>';
			}

			$output = array(
				'fk_banco_bu_error'					=>	$fk_banco_bu_error,
				'tipo_conta_bu_error'				=>	$tipo_conta_bu_error,
				'agencia_bu_error'					=>	$agencia_bu_error,
				'digito_agencia_bu_error'			=>	$digito_agencia_bu_error,
				'numero_conta_bu_error'				=>	$numero_conta_bu_error,
				'digito_conta_bu_error'				=>	$digito_conta_bu_error,
				'status_conta_bu_error'				=>	$status_conta_bu_error,
				'titular_status_bu_error'			=>	$titular_status_bu_error,
				'data_vencimento_conta_bu_error'	=>	$data_vencimento_conta_bu_error,
				'observacao_bu_error'				=>	$observacao_bu_error,


				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	public function deleteContaUsuario()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $crudModel = new BancousuariosModel();
            $crudModel->where('id_bu', $id)->delete($id);
            echo 'Conta do funcionario deletada com sucesso!';
        }
	}

	public function alterarStatusContaUsuario()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
			$model = new BancousuariosModel();
			
			$data = [
				'status_conta_bu' => 'Ativa',
			];
            $model->update($id, $data);
            echo 'Status alterado com sucesso!';
        }
	}

	/**avisos de vencimentos */
	public function avisosVencimentosContaBanco()
	{
		$id_frente = session()->get('log_frente');
		$model = new BancousuariosModel();
		$status = $model->getBanco_frente($id_frente);
		echo json_encode($status);
	}
}
