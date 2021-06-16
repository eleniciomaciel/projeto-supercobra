<?php

namespace App\Controllers\Rh\FrenteTrabalho;

use App\Controllers\BaseController;
use App\Models\FrentestrabalhoModel;
use monken\TablesIgniter;

class FrentesTrabalhosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function getFrentesTrabalho()
	{
		$crudModel = new FrentestrabalhoModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
			->setDefaultOrder("id_ftbr", "DESC")
			->setSearch(["nome_ftbr", "description_ftbr"])
			->setOrder(["id_ftbr", "nome_ftbr", "description_ftbr",])
			->setOutput(["id_ftbr", "nome_ftbr", "description_ftbr", $crudModel->button()]);
		return $data_table->getDatatable();
	}

	public function index()
	{
		if ($this->request->getMethod() === 'post') {
			$name_frentes_trabalho_error = '';
			$descricao_frentes_trabalho_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'name_frentes_trabalho' => ['label' => 'frente', 'rules' => 'required|max_length[80]|is_unique[frentestrabalho.nome_ftbr]'],
				'descricao_frentes_trabalho' => ['label' => 'descrição', 'rules' => 'required']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('name_frentes_trabalho')) {
					$name_frentes_trabalho_error = $validation->getError('name_frentes_trabalho');
				}

				if ($validation->getError('descricao_frentes_trabalho')) {
					$descricao_frentes_trabalho_error = $validation->getError('descricao_frentes_trabalho');
				}
			} else {
				$success = 'yes';
				$model = new FrentestrabalhoModel();

				$model->save([
					'nome_ftbr'		  =>	$this->request->getVar('name_frentes_trabalho'),
					'description_ftbr' =>	$this->request->getVar('descricao_frentes_trabalho'),
				]);

				$message = '<div class="alert alert-success">Frente de trabalho adicionada com sucesso!</div>';
			}

			$output = array(
				'name_frentes_trabalho_error'		=>	$name_frentes_trabalho_error,
				'descricao_frentes_trabalho_error'	=>	$descricao_frentes_trabalho_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**lista frente de trabalho one */
	public function getFrentesTrabOne()
	{
		if($this->request->getVar('id'))
        {
            $model = new FrentestrabalhoModel();
            $user_data = $model->where('id_ftbr', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**nova frente alterada */
	public function novaFrente()
	{
		if ($this->request->getMethod() === 'post') {
			$nome_ftbr_error = '';
			$description_ftbr_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'nome_ftbr' => ['label' => 'frente', 'rules' => 'required|max_length[80]|is_unique[frentestrabalho.nome_ftbr]'],
				'description_ftbr' => ['label' => 'descrição', 'rules' => 'required']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('nome_ftbr')) {
					$nome_ftbr_error = $validation->getError('nome_ftbr');
				}

				if ($validation->getError('description_ftbr')) {
					$description_ftbr_error = $validation->getError('description_ftbr');
				}
			} else {
				$success = 'yes';
				$model = new FrentestrabalhoModel();

				$model->save([
					'id_ftbr'		  =>	$this->request->getVar('hidden_id_up_frente_Trab'),
					'nome_ftbr'		  =>	$this->request->getVar('nome_ftbr'),
					'description_ftbr' =>	$this->request->getVar('description_ftbr'),
				]);

				$message = '<div class="alert alert-success">Frente de trabalho alterada com sucesso!</div>';
			}

			$output = array(
				'nome_ftbr_error'			=>	$nome_ftbr_error,
				'description_ftbr_error'	=>	$description_ftbr_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**delete frente de trabalo */
	public function delFrontWorkOne($id)
	{
		if($id)
        {
            $crudModel = new FrentestrabalhoModel();
            $crudModel->where('id_ftbr', $id)->delete($id);
            echo 'Deletada de trabalho deletada com sucesso!';
        }
	}
}
