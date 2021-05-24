<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\AtividadesModel;
use monken\TablesIgniter;

class AtividadesController extends BaseController
{
	public function index()
	{
		$model_atividades = new AtividadesModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($model_atividades->noticeTable())
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["titulo_nome", "titulo_description"])
				   ->setOrder(["id", "titulo_nome", "titulo_description"])
				   ->setOutput(["titulo_nome", "titulo_description", $model_atividades->button()]);
		return $data_table->getDatatable();
	}

	public function adicionaAtividade()
	{
		if($this->request->getMethod() === 'post')
		{
			$ativ_name_error = '';
            $ativ_descricao_error = '';
            $ativ_id_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'ativ_name' 		=> ['label' => 'atividade', 'rules' => 'required|min_length[3]|max_length[30]|is_unique[atividades.titulo_nome]'],
				'ativ_descricao' 	=> ['label' => 'descrição', 'rules' => 'required|min_length[5]|max_length[30]'],
				'id_cadastrador' 	=> ['label' => 'ID', 'rules' => 'required'],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('ativ_name'))
            	{
            		$ativ_name_error = $validation->getError('ativ_name');
            	}

            	if($validation->getError('ativ_descricao'))
            	{
            		$ativ_descricao_error = $validation->getError('ativ_descricao');
            	}
				if($validation->getError('id_cadastrador'))
            	{
            		$ativ_id_error = $validation->getError('id_cadastrador');
            	}
            }
            else
            {
            	$success = 'yes';
            	$model_atividades = new AtividadesModel();
            		$model_atividades->save([
						'titulo_fk_author'		=> 	$this->request->getVar('id_cadastrador'),
            			'titulo_nome'			=>	strtoupper($this->request->getVar('ativ_name'))	,
            			'titulo_description'	=>	strtoupper($this->request->getVar('ativ_descricao'))	,
            			
            		]);
            		$message = '<div class="alert alert-success">Atividade alterada com sucesso!</div>';
            }
            $output = array(
            	'ativ_name_error'		=>	$ativ_name_error,
            	'ativ_descricao_error'	=>	$ativ_descricao_error,
            	'ativ_id_error'			=>	$ativ_id_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );
            echo json_encode($output);
		}
	}

	/**lista dados da atividade */
	public function dadosDaAtividade()
	{
		if ($this->request->getVar('id')) {
			$atividade_model = new AtividadesModel();
			$user_data = $atividade_model->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	/**altera dados da atividade */
	public function alteraDadosAtividade()
	{
		if($this->request->getMethod() === 'post')
		{
			$titulo_nome_error = '';
            $titulo_description_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'titulo_nome' 		=> ['label' => 'atividade', 'rules' => 'required|min_length[3]|max_length[30]|is_unique[atividades.titulo_nome]'],
				'titulo_description' 	=> ['label' => 'descrição', 'rules' => 'required|min_length[5]|max_length[30]'],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('titulo_nome'))
            	{
            		$titulo_nome_error = $validation->getError('titulo_nome');
            	}

            	if($validation->getError('titulo_description'))
            	{
            		$titulo_description_error = $validation->getError('titulo_description');
            	}
            }
            else
            {
            	$success = 'yes';
            	$model_atividades = new AtividadesModel();
            		$model_atividades->save([
						'id' 				=> $this->request->getVar('hidden_id_atividade'),
						'titulo_nome'		=>strtoupper($this->request->getVar('titulo_nome')),
            			'titulo_description'=>strtoupper($this->request->getVar('titulo_description'))	,
            			
            		]);
            		$message = '<div class="alert alert-success">Atividade alterada com sucesso!</div>';
            }
            $output = array(
            	'titulo_nome_error'			=>	$titulo_nome_error,
            	'titulo_description_error'	=>	$titulo_description_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );
            echo json_encode($output);
		}
	}

	/**delata dados da atividade */
	public function deletaDadosAtividade()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new AtividadesModel();
            $model->delete($id);
            echo 'Atividade delatada com sucesso!';
        }
    
	}
}
