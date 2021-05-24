<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use App\Models\CentocustoModel;
use monken\TablesIgniter;

class RhccController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'cento_custo_rh')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteRh/layout/pages/cento_custo/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$model = new DepartamentosModel();
		$data['departamentos'] = $model->findAll();
		echo view('frentesObras/frenteRh/layout/pages/cento_custo/'.$page, $data);
	}

	public function addNewCc()
	{
		if($this->request->getMethod() === 'post')
		{
			
			helper(['form', 'url']);
			$cc_name_error = '';
            $dep_cc_error = '';
            $cc_dec_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'cc_name' => ['label' => 'número do cento de custo', 'rules' => 'required|integer|is_unique[cento_custo.numero_cc]',
				'errors' => [
					'required' => 'Digite um {field}.',
					'integer' => 'O {field} deve ser um valor inteiro.',
					'is_unique' => 'Esse {field} já está em uso.',
				]],
				'dep_cc' => ['label' => 'departamento', 'rules' => 'required',
				'errors' => [
					'required' => 'Selecione um {field} para receber o cento de custo.'
				]],
				'cc_dec' => ['label' => 'descrição', 'rules' => 'required|max_length[100]',
				'errors' => [
					'required' => 'Forneça uma {field}.',
					'max_length' => 'A {field} não pode ter mais de 100 caracteres.',
				]],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('cc_name'))
            	{
            		$cc_name_error = $validation->getError('cc_name');
            	}

            	if($validation->getError('dep_cc'))
            	{
            		$dep_cc_error = $validation->getError('dep_cc');
            	}

            	if($validation->getError('cc_dec'))
            	{
            		$cc_dec_error = $validation->getError('cc_dec');
            	}
            }
            else
            {
            	$success = 'yes';
            	$crudModel = new CentocustoModel();
            		$crudModel->save([
            			'numero_cc'			=>	$this->request->getVar('cc_name'),
            			'descricao_cc'		=>	$this->request->getVar('cc_dec'),
            			'fk_obra_cc'		=>	$this->request->getVar('id_fk_obrar'),
            			'fk_frente_cc'		=>	$this->request->getVar('id_fk_frent'),
            			'fk_departamento'	=>	$this->request->getVar('dep_cc'),
            			'observacao_cc'		=>	$this->request->getVar('cc_dec'),
            		]);

            		$message = '<div class="alert alert-success">Cento de custo adicionado com sucesso!</div>';
            }

            $output = array(
            	'cc_name_error'	=>	$cc_name_error,
            	'dep_cc_error'	=>	$dep_cc_error,
            	'cc_dec_error'	=>	$cc_dec_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	/**lista dados do cento de custo */
	public function lista_cc_rh_frente()	
	{
		$id = session()->get('log_frente');
		$modelcc = new CentocustoModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($modelcc->noticeTable($id))
			->setDefaultOrder("id_cc", "DESC")
			->setSearch(["numero_cc","dep_name","status_cc", "descricao_cc"])
			->setOrder(["id_cc", "numero_cc","dep_name","status_cc", "descricao_cc"])
			->setOutput(["created_at", "numero_cc","dep_name",$modelcc->status(), "descricao_cc", $modelcc->button()]);
		return $data_table->getDatatable();
	}

	/**lista dados do cc */
	public function lista_info_cc()
	{
		if($this->request->getVar('id'))
        {
            $model_cc = new CentocustoModel();
            $user_data = $model_cc->where('id_cc', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	public function alteraDados_cc()
	{
		if($this->request->getMethod() === 'post')
		{
			
			helper(['form', 'url']);
			$new_numero_ccrh_error = '';
            $new_departamento_ccrh_error = '';
            $new_descricao_ccrh_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'new_numero_ccrh' => ['label' => 'número do cento de custo', 'rules' => 'required|integer',
				'errors' => [
					'required' => 'Digite um {field}.',
					'integer' => 'O {field} deve ser um valor inteiro.',
				]],
				'new_departamento_ccrh' => ['label' => 'departamento', 'rules' => 'required',
				'errors' => [
					'required' => 'Selecione um {field} para receber o cento de custo.'
				]],
				'new_descricao_ccrh' => ['label' => 'descrição', 'rules' => 'required|max_length[100]',
				'errors' => [
					'required' => 'Forneça uma {field}.',
					'max_length' => 'A {field} não pode ter mais de 100 caracteres.',
				]],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('new_numero_ccrh'))
            	{
            		$new_numero_ccrh_error = $validation->getError('new_numero_ccrh');
            	}

            	if($validation->getError('new_departamento_ccrh'))
            	{
            		$new_departamento_ccrh_error = $validation->getError('new_departamento_ccrh');
            	}

            	if($validation->getError('new_descricao_ccrh'))
            	{
            		$new_descricao_ccrh_error = $validation->getError('new_descricao_ccrh');
            	}
            }
            else
            {
            	$success = 'yes';
            	$model = new CentocustoModel();
            		$model->save([
						'id_cc' 			=>	$this->request->getVar('new_id_cc'),
            			'numero_cc'			=>	$this->request->getVar('new_numero_ccrh'),
            			'descricao_cc'		=>	$this->request->getVar('new_descricao_ccrh'),
            			'fk_departamento'	=>	$this->request->getVar('new_departamento_ccrh'),
            			'observacao_cc'		=>	$this->request->getVar('new_descricao_ccrh'),
            		]);

            		$message = '<div class="alert alert-success">Cento de custo adicionado com sucesso!</div>';
            }

            $output = array(
            	'new_numero_ccrh_error'	=>	$new_numero_ccrh_error,
            	'new_departamento_ccrh_error'	=>	$new_departamento_ccrh_error,
            	'new_descricao_ccrh_error'	=>	$new_descricao_ccrh_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	/**altera status do cc */
	public function alteraStatusDoCc()
	{
		$id 	= $this->request->getVar('id_st');
		$status = $this->request->getVar('statu');
		$model = new CentocustoModel();

		if (isset($id) && $status == 'active') {
			$data = [
				'status_cc' => 'inactive',
			];
            $model->update($id, $data);
            echo 'Status inativado com sucesso!';
		}elseif (isset($id) && $status == 'inactive') {
			$data = [
				'status_cc' => 'active',
			];
			$model->update($id, $data);
			echo 'Status ativado com sucesso!';
		}
	}
}
