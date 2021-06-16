<?php

namespace App\Controllers\Rh\MaoObra;

use App\Controllers\BaseController;
use App\Models\TipoMaoDeObraModel;
use monken\TablesIgniter;


class MaoObraController extends BaseController
{

	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }
	
	public function getMaoObras()
	{
		$crudModel = new TipoMaoDeObraModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($crudModel->noticeTable())
			->setDefaultOrder("id_tmo", "DESC")
			->setSearch(["nome_tmo", "description_tmo"])
			->setOrder(["id_tmo", "nome_tmo", "description_tmo",])
			->setOutput(["id_tmo", "nome_tmo", "description_tmo", $crudModel->button()]);
		return $data_table->getDatatable();
	}
	public function index()
	{
		if ($this->request->getMethod() === 'post') {
			$name_mao_obra_error = '';
			$descricao_mao_obra_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'name_mao_obra' => ['label' => 'nome', 'rules' => 'required|max_length[40]|is_unique[tipomaodeobras.nome_tmo]'],
				'descricao_mao_obra' => ['label' => 'descrição', 'rules' => 'required']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('name_mao_obra')) {
					$name_mao_obra_error = $validation->getError('name_mao_obra');
				}

				if ($validation->getError('descricao_mao_obra')) {
					$descricao_mao_obra_error = $validation->getError('descricao_mao_obra');
				}
			} else {
				$success = 'yes';
				$model = new TipoMaoDeObraModel();

				$model->save([
					'nome_tmo'		  =>	$this->request->getVar('name_mao_obra'),
					'description_tmo' =>	$this->request->getVar('descricao_mao_obra'),
				]);

				$message = '<div class="alert alert-success">Mão de obra adicionada com sucesso!</div>';
			}

			$output = array(
				'name_mao_obra_error'		=>	$name_mao_obra_error,
				'descricao_mao_obra_error'	=>	$descricao_mao_obra_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**pega mao de obra */
	public function getMaoDeObraUnica()
	{
		if($this->request->getVar('id'))
        {
            $model = new TipoMaoDeObraModel();
            $user_data = $model->where('id_tmo', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**altera dados da mão de obra */
	public function alteraMaoObraDados()
	{
		if ($this->request->getMethod() === 'post') {
			$nome_tmo_error = '';
			$description_tmo_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'nome_tmo' => ['label' => 'nome', 'rules' => 'required|max_length[40]'],
				'description_tmo' => ['label' => 'descrição', 'rules' => 'required']

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('nome_tmo')) {
					$nome_tmo_error = $validation->getError('nome_tmo');
				}

				if ($validation->getError('description_tmo')) {
					$description_tmo_error = $validation->getError('description_tmo');
				}
			} else {
				$success = 'yes';
				$model = new TipoMaoDeObraModel();

				$model->save([
					'id_tmo'		  =>	$this->request->getVar('hidden_id_up_mao_obra'),
					'nome_tmo'		  =>	$this->request->getVar('nome_tmo'),
					'description_tmo' =>	$this->request->getVar('description_tmo'),
				]);

				$message = '<div class="alert alert-success">Mão de obra alterada com sucesso!</div>';
			}

			$output = array(
				'nome_tmo_error'		=>	$nome_tmo_error,
				'description_tmo_error'	=>	$description_tmo_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	/**delete mão de obra */
	public function delMaoObraOne(int $id)
	{
		if($id)
        {
            $crudModel = new TipoMaoDeObraModel();
            $crudModel->where('id_tmo', $id)->delete($id);
            echo 'Mão de obra deletada com sucesso!';
        }
	}
}
