<?php
namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use monken\TablesIgniter;

class DepartamentosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }
	
	public function index()
	{
		$departamento = new DepartamentosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($departamento->noticeTable())
			->setDefaultOrder("id", "DESC")
			->setSearch(["dep_name", "dep_description"])
			->setOrder(["id", "dep_name", "dep_description"])
			->setOutput(["created_at", "dep_name", "dep_description", $departamento->button()]);
		return $data_table->getDatatable();
	}

    public function addDepartamento()
    {
        if ($this->request->getMethod() === 'post') {

			$dep_new_nome_departamento_error = '';
			$dep_new_descricao_departamento_error = '';
			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'dep_new_nome_departamento' => ['label' => 'DEPARTAMENTO', 'rules' => 'required|max_length[50]|is_unique[departamentos.dep_name]',
				'errors' => [
					'required' => 'A {field} não pode ir vazia.',
					'is_unique' => 'Esse {field} já foi cadastrada.',
				]],
				'dep_new_descricao_departamento' => ['label' => 'DESCRIÇÃO DO DEPARTAMENTO', 'rules' => 'required',
				'errors' => [
					'required' => 'O {field} não pode está vazia.'
				]],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('dep_new_nome_departamento')) {
					$dep_new_nome_departamento_error = $validation->getError('dep_new_nome_departamento');
				}

				if ($validation->getError('dep_new_descricao_departamento')) {
					$dep_new_descricao_departamento_error = $validation->getError('dep_new_descricao_departamento');
				}
			} else {
				$success = 'yes';
				$crudModel = new DepartamentosModel();
					$crudModel->save([
						'dep_name'			=>	strtoupper($this->request->getVar('dep_new_nome_departamento')),
						'dep_description'		=>	strtoupper($this->request->getVar('dep_new_descricao_departamento')),
					]);
					$message = '<div class="alert alert-success">Departamento adicionado com sucesso!</div>';
			}
			$output = array(
				'dep_new_nome_departamento_error'		=>	$dep_new_nome_departamento_error,
				'dep_new_descricao_departamento_error'	=>	$dep_new_descricao_departamento_error,
				'error'					=>	$error,
				'success'				=>	$success,
				'message'				=>	$message
			);
			echo json_encode($output);
		}
    }

    /**ver dados do departamento */
    public function DadosDepartamento()
    {
        if($this->request->getVar('id'))
        {
            $dp_model = new DepartamentosModel();
            $user_data = $dp_model->where('id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
    }

    /**altera dados do departamento */
    public function alteraDadosDepartamento()
    {
        if ($this->request->getMethod() === 'post') {

			$dep_nme_error = '';
			$dp_descricao_error = '';
			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'dep_nme' => ['label' => 'DEPARTAMENTO', 'rules' => 'required|max_length[50]|is_unique[departamentos.dep_name]',
				'errors' => [
					'required' => 'A {field} não pode ir vazia.',
					'is_unique' => 'Esse {field} já foi cadastrada.',
				]],
				'dp_descricao' => ['label' => 'DESCRIÇÃO DO DEPARTAMENTO', 'rules' => 'required',
				'errors' => [
					'required' => 'O {field} não pode está vazia.'
				]],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('dep_nme')) {
					$dep_nme_error = $validation->getError('dep_nme');
				}

				if ($validation->getError('dp_descricao')) {
					$dp_descricao_error = $validation->getError('dp_descricao');
				}
			} else {
				$success = 'yes';
				$crudModel = new DepartamentosModel();
					$crudModel->save([
                        'id'                => $this->request->getPost('hidden_id_dep'),
						'dep_name'			=>	strtoupper($this->request->getPost('dep_nme')),
						'dep_description'	=>	strtoupper($this->request->getPost('dp_descricao')),
					]);
					$message = '<div class="alert alert-success">Departamento alterado com sucesso!</div>';
			}
			$output = array(
				'dep_nme_error'		    =>	$dep_nme_error,
				'dp_descricao_error'	=>	$dp_descricao_error,
				'error'					=>	$error,
				'success'				=>	$success,
				'message'				=>	$message
			);
			echo json_encode($output);
		}
    }
    /**deleta departamento */
    public function deletaDadosDepartamento()
    {
        if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new DepartamentosModel();
            $model->delete($id);
            echo 'Departamento deletado com sucesso!';
        }
    }
}
