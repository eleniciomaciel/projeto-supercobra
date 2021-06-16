<?php

namespace App\Controllers\Rh\Exames;

use App\Controllers\BaseController;
use App\Models\ExamesContratuaisModel;
use App\Models\ExamesOcupacionaisRiscosModel;
use App\Models\CargofuncoesModel;
use App\Models\CargosModel;
use App\Models\ConsultasGeralModel;
use App\Models\ExamesModel;
use monken\TablesIgniter;

class ExamesClinicosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }
	
	public function index($page = 'home-exames')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/examesClinicos/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model = new CargosModel();
		$model_cargos = new CargofuncoesModel();
		$data = [
			'title' =>	'Informações dos exames Clínicos',
			'funf' 	=> 	$model_cargos->findAll(),
			'carg' 	=> 	$model->findAll(),
		]; // Capitalize the first letter

		return view('frentesObras/frenteRh/layout/pages/examesClinicos/' . $page, $data);
	}

	/**cadastra exames contratuais */
	public function addExameContratual()
	{
		if ($this->request->getMethod() === 'post') {
			$exc_name_error = '';
			$exc_descricao_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'exc_name' => ['label' => 'nome', 'rules' => 'required|max_length[50]|is_unique[examescontratuais.ect_nome]'],
				'exc_descricao' => ['label' => 'descrição', 'rules' => 'required|max_length[100]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('exc_name')) {
					$exc_name_error = $validation->getError('exc_name');
				}

				if ($validation->getError('exc_descricao')) {
					$exc_descricao_error = $validation->getError('exc_descricao');
				}
			} else {
				$success = 'yes';
				$crudModel = new ExamesContratuaisModel();

				$crudModel->save([
					'fk_user_ect'		=>	$this->request->getVar('hidden_usuario_cad_exc'),
					'ect_nome'			=>	$this->request->getVar('exc_name'),
					'ect_description'	=>	$this->request->getVar('exc_descricao'),

				]);

				$message = '<div class="alert alert-success">Cadastro efetuado com sucesso!</div>';
			}

			$output = array(
				'exc_name_error'		=>	$exc_name_error,
				'exc_descricao_error'	=>	$exc_descricao_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**lista exames contartuais */
	public function listExamesContratuais()
	{
		$model = new ExamesContratuaisModel();
		$data_table = new TablesIgniter();
		$data_table->setTable($model->noticeTable())
			->setDefaultOrder("id", "DESC")
			->setSearch(["ect_nome", "ect_description"])
			->setOrder(["id", "ect_nome", "ect_description"])
			->setOutput(["created_at", "ect_nome", "ect_description", $model->button()]);
		return $data_table->getDatatable();
	}

	/**lista dados do exame */
	public function getDadosExame()
	{
		if ($this->request->getVar('id')) {
			$crudModel = new ExamesContratuaisModel();
			$user_data = $crudModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}

	/**altera cadastro dos exames */
	public function uPExameContratual()
	{
		if ($this->request->getMethod() === 'post') {
			$ect_nome_error = '';
			$ect_description_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'ect_nome' => ['label' => 'nome', 'rules' => 'required|max_length[50]'],
				'ect_description' => ['label' => 'descrição', 'rules' => 'required|max_length[100]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('ect_nome')) {
					$ect_nome_error = $validation->getError('ect_nome');
				}

				if ($validation->getError('ect_description')) {
					$ect_description_error = $validation->getError('ect_description');
				}
			} else {
				$success = 'yes';
				$crudModel = new ExamesContratuaisModel();

				$crudModel->save([
					'id'				=>	$this->request->getVar('hidden_id_contrat_exame'),
					'ect_nome'			=>	$this->request->getVar('ect_nome'),
					'ect_description'	=>	$this->request->getVar('ect_description'),

				]);

				$message = '<div class="alert alert-success">Cadastro alterado com sucesso!</div>';
			}

			$output = array(
				'ect_nome_error'		=>	$ect_nome_error,
				'ect_description_error'	=>	$ect_description_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**delete exame contratual */
	public function deleteExamesContratuais()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$crudModel = new ExamesContratuaisModel();
			$crudModel->where('id', $id)->delete($id);
			echo 'Dados deletado com sucesso!';
		}
	}


	/** *********************************************************************************** */
	//RISCO DE ACIDENTES

	/**cadastra exames contratuais */
	public function addRisco()
	{
		if ($this->request->getMethod() === 'post') {
			$risco_funcao_error = '';
			$risco_nome_error = '';
			$risco_grau_error = '';
			$risco_descricao_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'risco_funcao' => ['label' => 'função', 'rules' => 'required'],
				'risco_nome' => ['label' => 'nome do risco', 'rules' => 'required|max_length[50]'],
				'risco_grau' => ['label' => 'grau', 'rules' => 'required|in_list[Nenhum,Acidentais,Biológicos,Ergonômicos,Físicos,Mecânicos,Químicos]'],
				'risco_descricao' => ['label' => 'descrição', 'rules' => 'required|max_length[100]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('risco_funcao')) {
					$risco_funcao_error = $validation->getError('risco_funcao');
				}

				if ($validation->getError('risco_nome')) {
					$risco_nome_error = $validation->getError('risco_nome');
				}

				if ($validation->getError('risco_grau')) {
					$risco_grau_error = $validation->getError('risco_grau');
				}

				if ($validation->getError('risco_descricao')) {
					$risco_descricao_error = $validation->getError('risco_descricao');
				}
			} else {
				$success = 'yes';
				$crudModel = new ExamesOcupacionaisRiscosModel();

				$crudModel->save([
					'fk_user_eor'			=>	$this->request->getVar('hidden_usuario_cad_exc_risc'),
					'fk_funcao_eor'			=>	$this->request->getVar('risco_funcao'),
					'eor_nome'				=>	$this->request->getVar('risco_nome'),
					'eor_grau_risco'		=>	$this->request->getVar('risco_grau'),
					'eor_combo_risco'		=>	$this->request->getVar('exc_descricao'),
					'eor_description_risco'	=>	$this->request->getVar('risco_descricao'),
				]);

				$message = '<div class="alert alert-success">Cadastro efetuado com sucesso!</div>';
			}

			$output = array(
				'risco_funcao_error'		=>	$risco_funcao_error,
				'risco_nome_error'			=>	$risco_nome_error,
				'risco_grau_error'			=>	$risco_grau_error,
				'risco_descricao_error'		=>	$risco_descricao_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**lista exames riscos */
	public function listRiscosTrabalho()
	{
		$model_risco = new ExamesOcupacionaisRiscosModel();
		$data_table = new TablesIgniter();
		$data_table->setTable($model_risco->noticeTable())
			->setDefaultOrder("cargo_nome", "DESC")
			->setSearch(["cargo_nome", "eor_nome", "eor_grau_risco"])
			->setOrder(["cargo_nome", "eor_nome", "eor_grau_risco"])
			->setOutput(["cargo_numero", "cargo_nome", "eor_nome", "eor_grau_risco", $model_risco->button()]);
		return $data_table->getDatatable();
	}

	/**visualiza exmes riscos */
	public function verExamesRiscoa()
	{
		if ($this->request->getVar('id')) {
			$model_risco = new ExamesOcupacionaisRiscosModel();
			$user_data = $model_risco->where('id_r', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}

	/**altera dados do risco */
	public function alteraRisco()
	{
		if ($this->request->getMethod() === 'post') {
			$fk_funcao_eor_error = '';
			$eor_nome_error = '';
			$eor_grau_risco_error = '';
			$eor_description_risco_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'fk_funcao_eor' => ['label' => 'função', 'rules' => 'required'],
				'eor_nome' => ['label' => 'nome do risco', 'rules' => 'required|max_length[50]'],
				'eor_grau_risco' => ['label' => 'grau', 'rules' => 'required|in_list[Nenhum,Acidentais,Biológicos,Ergonômicos,Físicos,Mecânicos,Químicos]'],
				'eor_description_risco' => ['label' => 'descrição', 'rules' => 'required|max_length[500]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('fk_funcao_eor')) {
					$fk_funcao_eor_error = $validation->getError('fk_funcao_eor');
				}

				if ($validation->getError('eor_nome')) {
					$eor_nome_error = $validation->getError('eor_nome');
				}

				if ($validation->getError('eor_grau_risco')) {
					$eor_grau_risco_error = $validation->getError('eor_grau_risco');
				}

				if ($validation->getError('eor_description_risco')) {
					$eor_description_risco_error = $validation->getError('eor_description_risco');
				}
			} else {
				$success = 'yes';
				$crudModel = new ExamesOcupacionaisRiscosModel();

				$crudModel->save([
					'id_r'					=>	$this->request->getVar('hidden_id_risco_exame_up'),
					'fk_funcao_eor'			=>	$this->request->getVar('fk_funcao_eor'),
					'eor_nome'				=>	$this->request->getVar('eor_nome'),
					'eor_grau_risco'		=>	$this->request->getVar('eor_grau_risco'),
					'eor_combo_risco'		=>	$this->request->getVar('exc_descricao'),
					'eor_description_risco'	=>	$this->request->getVar('eor_description_risco'),
				]);

				$message = '<div class="alert alert-success">Cadastro alterado com sucesso!</div>';
			}

			$output = array(
				'fk_funcao_eor_error'		=>	$fk_funcao_eor_error,
				'eor_nome_error'			=>	$eor_nome_error,
				'eor_grau_risco_error'			=>	$eor_grau_risco_error,
				'eor_description_risco_error'		=>	$eor_description_risco_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}
	/**delete riscos */
	public function deleteRiscos()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$crudModel = new ExamesOcupacionaisRiscosModel();
			$crudModel->where('id_r', $id)->delete($id);
			echo 'Risco deletado com sucesso!';
		}
	}

	/**lista os exames do contrato no select */
	public function listaExamesContratuaisSelect()
	{
		$list = new ExamesContratuaisModel();
		$todasExamesContratuais = $list->findAll();
		echo json_encode($todasExamesContratuais);
	}

	/**lista os exames do contrato riscos no select */
	public function listaExamesRiscosSelect()
	{
		$modal = new ExamesOcupacionaisRiscosModel();
		$todasExamesRiscos = $modal->findAll();
		echo json_encode($todasExamesRiscos);
	}

	/**lista funções da categoria de riscos */
	public function getfuncoesCargos()
	{
		$this->model = new ConsultasGeralModel();
		$postData = array(
			'id_func' => $this->request->getVar('id_func'),
		);
		$data = $this->model->getRiscosFuncao($postData);
		echo json_encode($data);
	}

	/**adiciona dados do exame tipo combo */
	public function adicinaComboExames()
	{
		if ($this->request->getMethod() === 'post') {
			$exm_contrato_error = '';
			$todas_funcao_para_risco_error = '';
			$select_carg_func_risco_error = '';
			$final_exam_name_error = '';
			$exames_mes_valor_error = '';
			$final_exame_desc_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'exm_contrato' => ['label' => 'tipo de contrato', 'rules' => 'required'],
				'todas_funcao_para_risco' => ['label' => 'função', 'rules' => 'required'],
				'select_carg_func_risco' => ['label' => 'função de risco', 'rules' => 'required'],
				'final_exam_name' => ['label' => 'nome do exame', 'rules' => 'required|max_length[50]'],
				'exames_mes_valor' => ['label' => 'periodicidade', 'rules' => 'required|integer'],
				'final_exame_desc' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('exm_contrato')) {
					$exm_contrato_error = $validation->getError('exm_contrato');
				}

				if ($validation->getError('todas_funcao_para_risco')) {
					$todas_funcao_para_risco_error = $validation->getError('todas_funcao_para_risco');
				}

				if ($validation->getError('select_carg_func_risco')) {
					$select_carg_func_risco_error = $validation->getError('select_carg_func_risco');
				}

				if ($validation->getError('final_exam_name')) {
					$final_exam_name_error = $validation->getError('final_exam_name');
				}

				if ($validation->getError('exames_mes_valor')) {
					$exames_mes_valor_error = $validation->getError('exames_mes_valor');
				}

				if ($validation->getError('final_exame_desc')) {
					$final_exame_desc_error = $validation->getError('final_exame_desc');
				}
			} else {
				$success = 'yes';
				$model = new ExamesModel();

				$model->save([
					'ex_fk_tipo_contato'=>	$this->request->getVar('exm_contrato'),
					'ex_fk_funcao'		=>	$this->request->getVar('todas_funcao_para_risco'),
					'ex_fk_risco'		=>	$this->request->getVar('select_carg_func_risco'),
					'ex_tipo_exame'		=>	$this->request->getVar('final_exam_name'),
					'ex_validade_meses'	=>	$this->request->getVar('exames_mes_valor'),
					'ex_description'	=>	$this->request->getVar('final_exame_desc'),
				]);

				$message = '<div class="alert alert-success">Cadastro inserido com sucesso!</div>';
			}

			$output = array(
				'exm_contrato_error'			=>	$exm_contrato_error,
				'todas_funcao_para_risco_error'	=>	$todas_funcao_para_risco_error,
				'select_carg_func_risco_error'	=>	$select_carg_func_risco_error,
				'final_exam_name_error'			=>	$final_exam_name_error,
				'exames_mes_valor_error'		=>	$exames_mes_valor_error,
				'final_exame_desc_error'		=>	$final_exame_desc_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**lista todos os exames com seus combos */
	public function getExamesCombo()
	{
		$model = new ExamesModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable())
				   ->setDefaultOrder("id_ex", "DESC")
				   ->setSearch(["ect_nome", "cargo_nome", "eor_nome", "ex_tipo_exame", "ex_validade_meses"])
				   ->setOrder(["ect_nome", "cargo_nome", "eor_nome", "ex_tipo_exame", "ex_validade_meses"])
				   ->setOutput(["ect_nome", "cargo_nome", "eor_nome", "ex_tipo_exame", "ex_validade_meses", $model->button()]);
		return $data_table->getDatatable();
	}

	/**lista funções da categoria de riscos */
	public function getListExames()
	{
		if($this->request->getVar('id'))
        {
            $model = new ExamesModel();
            $user_data = $model->where('id_ex', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**lista os exames do contrato riscos no select */
	public function listaRiscosFuncaoSelect()
	{
		$modal = new ExamesOcupacionaisRiscosModel();
		$todasExamesRiscos = $modal->examesAtividadesRiscos();
		echo json_encode($todasExamesRiscos);
	}

	/**adiciona dados do exame tipo combo */
	public function alteraComboExames()
	{
		if ($this->request->getMethod() === 'post') {
			$exm_contrato_combo_up_error = '';
			$ex_fk_funcao_error = '';
			$exm_riscos_funcao_ajax_error = '';
			$ex_tipo_exame_error = '';
			$ex_validade_meses_error = '';
			$ex_description = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'exm_contrato_combo_up' => ['label' => 'tipo de contrato', 'rules' => 'required'],
				'ex_fk_funcao' => ['label' => 'função', 'rules' => 'required'],
				'exm_riscos_funcao_ajax' => ['label' => 'função de risco', 'rules' => 'required'],
				'ex_tipo_exame' => ['label' => 'nome do exame', 'rules' => 'required|max_length[50]'],
				'ex_validade_meses' => ['label' => 'periodicidade', 'rules' => 'required|integer'],
				'ex_description' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('exm_contrato_combo_up')) {
					$exm_contrato_combo_up_error = $validation->getError('exm_contrato_combo_up');
				}

				if ($validation->getError('ex_fk_funcao')) {
					$ex_fk_funcao_error = $validation->getError('ex_fk_funcao');
				}

				if ($validation->getError('exm_riscos_funcao_ajax')) {
					$exm_riscos_funcao_ajax_error = $validation->getError('exm_riscos_funcao_ajax');
				}

				if ($validation->getError('ex_tipo_exame')) {
					$ex_tipo_exame_error = $validation->getError('ex_tipo_exame');
				}

				if ($validation->getError('ex_validade_meses')) {
					$ex_validade_meses_error = $validation->getError('ex_validade_meses');
				}

				if ($validation->getError('ex_description')) {
					$ex_description = $validation->getError('ex_description');
				}
			} else {
				$success = 'yes';
				$model = new ExamesModel();

				$model->save([
					'id_ex'				=>	$this->request->getVar('hidden_id_exame_combo'),
					'ex_fk_tipo_contato'=>	$this->request->getVar('exm_contrato_combo_up'),
					'ex_fk_funcao'		=>	$this->request->getVar('ex_fk_funcao'),
					'ex_fk_risco'		=>	$this->request->getVar('exm_riscos_funcao_ajax'),
					'ex_tipo_exame'		=>	$this->request->getVar('ex_tipo_exame'),
					'ex_validade_meses'	=>	$this->request->getVar('ex_validade_meses'),
					'ex_description'	=>	$this->request->getVar('ex_description'),
				]);

				$message = '<div class="alert alert-success">Cadastro inserido com sucesso!</div>';
			}

			$output = array(
				'exm_contrato_combo_up_error'			=>	$exm_contrato_combo_up_error,
				'ex_fk_funcao_error'	=>	$ex_fk_funcao_error,
				'exm_riscos_funcao_ajax_error'	=>	$exm_riscos_funcao_ajax_error,
				'ex_tipo_exame_error'			=>	$ex_tipo_exame_error,
				'ex_validade_meses_error'		=>	$ex_validade_meses_error,
				'ex_description'		=>	$ex_description,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**deleta combo exames */
	public function deleteExamesCombo()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $crudModel = new ExamesModel();
            $crudModel->where('id_ex', $id)->delete($id);
            echo 'Exame deletado com sucesso!';
        }
	}
}
