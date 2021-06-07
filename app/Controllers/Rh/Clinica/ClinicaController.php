<?php

namespace App\Controllers\Rh\Clinica;
use App\Models\ClinicasModel;
use monken\TablesIgniter;

use App\Controllers\BaseController;

class ClinicaController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'home-clinica')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/clinicas/'.$page.'.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$data = [
			'title' =>'Informações das clinicas'
		]; // Capitalize the first letter

		return view('frentesObras/frenteRh/layout/pages/clinicas/' . $page, $data);
	}

	/**cadastra frente */
	public function addClinica()
	{
		if($this->request->getMethod() === 'post')
		{
			$clinica_nome_error = '';
            $clinica_responsavel_error = '';
            $clinica_email_error = '';
            $clinica_email_error = '';
            $clinica_tel_error = '';
            $clinica_cnpj_error = '';
            $clinica_cep_error = '';
            $clinica_uf_error = '';
            $clinica_city_error = '';
            $clinica_bairro_error = '';
            $clinica_endereco_error = '';
            $clinica_observacao_error = '';

            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
            			'clinica_nome' => ['label' => 'nome da clínica', 'rules' => 'required|min_length[5]|max_length[100]'],
						'clinica_responsavel' => ['label' => 'nome do responsável', 'rules' => 'required|min_length[5]|max_length[100]'],
						'clinica_email' => ['label' => 'email da clínica', 'rules' => 'required|valid_email|is_unique[clinicas.cli_email]|max_length[60]'],
						'clinica_tel' => ['label' => 'telefone', 'rules' => 'required|min_length[10]|max_length[15]|is_unique[clinicas.cli_telefone]'],
						'clinica_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]|is_unique[clinicas.cli_cnpj]'],
						'clinica_cep' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
						'clinica_uf' => ['label' => 'uf', 'rules' => 'required|exact_length[2]'],
						'clinica_city' => ['label' => 'cidade', 'rules' => 'required|min_length[5]|max_length[100]'],
						'clinica_bairro' => ['label' => 'bairro', 'rules' => 'required|min_length[5]|max_length[100]'],
						'clinica_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
						'clinica_observacao' => ['label' => 'observação', 'rules' => 'required|max_length[300]'],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('clinica_nome'))
            	{
            		$clinica_nome_error = $validation->getError('clinica_nome');
            	}

            	if($validation->getError('clinica_responsavel'))
            	{
            		$clinica_responsavel_error = $validation->getError('clinica_responsavel');
            	}

            	if($validation->getError('clinica_email'))
            	{
            		$clinica_email_error = $validation->getError('clinica_email');
            	}
				if($validation->getError('clinica_tel'))
            	{
            		$clinica_tel_error = $validation->getError('clinica_tel');
            	}
				if($validation->getError('clinica_cnpj'))
            	{
            		$clinica_cnpj_error = $validation->getError('clinica_cnpj');
            	}
				if($validation->getError('clinica_cep'))
            	{
            		$clinica_cep_error = $validation->getError('clinica_cep');
            	}
				if($validation->getError('clinica_uf'))
            	{
            		$clinica_uf_error = $validation->getError('clinica_uf');
            	}
				if($validation->getError('clinica_city'))
            	{
            		$clinica_city_error = $validation->getError('clinica_city');
            	}
				if($validation->getError('clinica_bairro'))
            	{
            		$clinica_bairro_error = $validation->getError('clinica_bairro');
            	}
				if($validation->getError('clinica_endereco'))
            	{
            		$clinica_endereco_error = $validation->getError('clinica_endereco');
            	}
				if($validation->getError('clinica_observacao'))
            	{
            		$clinica_observacao_error = $validation->getError('clinica_observacao');
            	}
            }
            else
            {
            	$success = 'yes';
            	$crudModel = new ClinicasModel();
            		$crudModel->save([
            			'fk_frente'		=>	$this->request->getVar('clinica_frente'),
            			'cli_nome'		=>	$this->request->getVar('clinica_nome'),
            			'cli_responsavel'=>	$this->request->getVar('clinica_responsavel'),
            			'cli_cnpj'		=>	$this->request->getVar('clinica_cnpj'),
            			'cli_telefone'	=>	$this->request->getVar('clinica_tel'),
            			'cli_email'		=>	strtolower($this->request->getVar('clinica_email')),
            			'cli_cep'		=>	$this->request->getVar('clinica_cep'),
            			'cli_estado'	=>	$this->request->getVar('clinica_uf'),
            			'cli_cidade'	=>	$this->request->getVar('clinica_city'),
            			'cli_bairro'	=>	$this->request->getVar('clinica_bairro'),
            			'cli_endereco'	=>	$this->request->getVar('clinica_endereco'),
            			'cli_dias_1'	=>	$this->request->getVar('seg'),
            			'cli_dias_2'	=>	$this->request->getVar('ter'),
            			'cli_dias_3'	=>	$this->request->getVar('qua'),
            			'cli_dias_4'	=>	$this->request->getVar('qui'),
            			'cli_dias_5'	=>	$this->request->getVar('sex'),
            			'cli_dias_6'	=>	$this->request->getVar('sab'),
            			'cli_dias_7'	=>	$this->request->getVar('dom'),
            			'cli_observacoes'=>	$this->request->getVar('clinica_observacao'),
            		]);

            		$message = '<div class="alert alert-success">Clinica inserida com sucesso!</div>';
            }

            $output = array(
            	'clinica_nome_error'		=>	$clinica_nome_error,
            	'clinica_responsavel_error'	=>	$clinica_responsavel_error,
            	'clinica_email_error'		=>	$clinica_email_error,
            	'clinica_tel_error'			=>	$clinica_tel_error,
            	'clinica_cnpj_error'		=>	$clinica_cnpj_error,
            	'clinica_cep_error'			=>	$clinica_cep_error,
            	'clinica_uf_error'			=>	$clinica_uf_error,
            	'clinica_city_error'		=>	$clinica_city_error,
            	'clinica_bairro_error'		=>	$clinica_bairro_error,
            	'clinica_endereco_error'	=>	$clinica_endereco_error,
            	'clinica_observacao_error'	=>	$clinica_observacao_error,

            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	/**lista clinicas frentes */
	public function listClinicas()
	{
		$id_frente = session()->get('log_frente');
		$model = new ClinicasModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable($id_frente))
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["cli_nome", "cli_telefone", "cli_email", "cli_cidade"])
				   ->setOrder(["cli_nome", "cli_telefone", "cli_email", "cli_cidade"])
				   ->setOutput(["created_at", "cli_nome", "cli_telefone", "cli_email", "cli_cidade", $model->button()]);
		return $data_table->getDatatable();
	}

	/**lista dados da clínica */
	public function dadosClinica()
	{
		if($this->request->getVar('id'))
        {
            $crudModel = new ClinicasModel();
            $user_data = $crudModel->where('id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**altera dados da cline um */
	public function alteraDadosClinicaOne()
	{
		if($this->request->getMethod() === 'post')
		{
			$clinica_nome_x_error = '';
            $clinica_responsavel_x_error = '';
            $clinica_email_x_error = '';
            $clinica_email_x_error = '';
            $clinica_tel_x_error = '';
            $clinica_cnpj_x_error = '';
            $clinica_cep_x_error = '';
            $clinica_uf_x_error = '';
            $clinica_city_x_error = '';
            $clinica_bairro_x_error = '';
            $clinica_endereco_x_error = '';
            $clinica_observacao_x_error = '';

            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
            			'cli_nome' => ['label' => 'nome da clínica', 'rules' => 'required|min_length[5]|max_length[100]'],
						'cli_responsavel' => ['label' => 'nome do responsável', 'rules' => 'required|min_length[5]|max_length[100]'],
						'cli_email' => ['label' => 'email da clínica', 'rules' => 'required|valid_email|max_length[60]'],
						'cli_telefone' => ['label' => 'telefone', 'rules' => 'required|min_length[10]|max_length[15]'],
						'cli_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]'],
						'cli_cep' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
						'cli_estado' => ['label' => 'uf', 'rules' => 'required|exact_length[2]'],
						'cli_cidade' => ['label' => 'cidade', 'rules' => 'required|min_length[10]|max_length[100]'],
						'cli_bairro' => ['label' => 'bairro', 'rules' => 'required|min_length[5]|max_length[100]'],
						'cli_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
						'cli_observacoes' => ['label' => 'observação', 'rules' => 'required|max_length[300]'],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('cli_nome'))
            	{
            		$clinica_nome_x_error = $validation->getError('cli_nome');
            	}

            	if($validation->getError('cli_responsavel'))
            	{
            		$clinica_responsavel_x_error = $validation->getError('cli_responsavel');
            	}

            	if($validation->getError('cli_email'))
            	{
            		$clinica_email_x_error = $validation->getError('cli_email');
            	}
				if($validation->getError('cli_telefone'))
            	{
            		$clinica_tel_x_error = $validation->getError('cli_telefone');
            	}
				if($validation->getError('cli_cnpj'))
            	{
            		$clinica_cnpj_x_error = $validation->getError('cli_cnpj');
            	}
				if($validation->getError('cli_cep'))
            	{
            		$clinica_cep_x_error = $validation->getError('cli_cep');
            	}
				if($validation->getError('cli_estado'))
            	{
            		$clinica_uf_x_error = $validation->getError('cli_estado');
            	}
				if($validation->getError('cli_cidade'))
            	{
            		$clinica_city_x_error = $validation->getError('cli_cidade');
            	}
				if($validation->getError('cli_bairro'))
            	{
            		$clinica_bairro_x_error = $validation->getError('cli_bairro');
            	}
				if($validation->getError('cli_endereco'))
            	{
            		$clinica_endereco_x_error = $validation->getError('cli_endereco');
            	}
				if($validation->getError('cli_observacoes'))
            	{
            		$clinica_observacao_x_error = $validation->getError('cli_observacoes');
            	}
            }
            else
            {
            	$success = 'yes';
            	$crudModel = new ClinicasModel();
            		$crudModel->save([
            			'id'		=>	$this->request->getVar('hidden_id_clinica'),
            			'cli_nome'		=>	$this->request->getVar('cli_nome'),
            			'cli_responsavel'=>	$this->request->getVar('cli_responsavel'),
            			'cli_cnpj'		=>	$this->request->getVar('cli_cnpj'),
            			'cli_telefone'	=>	$this->request->getVar('cli_telefone'),
            			'cli_email'		=>	strtolower($this->request->getVar('cli_email')),
            			'cli_cep'		=>	$this->request->getVar('cli_cep'),
            			'cli_estado'	=>	$this->request->getVar('cli_estado'),
            			'cli_cidade'	=>	$this->request->getVar('cli_cidade'),
            			'cli_bairro'	=>	$this->request->getVar('cli_bairro'),
            			'cli_endereco'	=>	$this->request->getVar('cli_endereco'),
            			'cli_dias_1'	=>	$this->request->getVar('cli_dias_1'),
            			'cli_dias_2'	=>	$this->request->getVar('cli_dias_2'),
            			'cli_dias_3'	=>	$this->request->getVar('cli_dias_3'),
            			'cli_dias_4'	=>	$this->request->getVar('cli_dias_4'),
            			'cli_dias_5'	=>	$this->request->getVar('cli_dias_5'),
            			'cli_dias_6'	=>	$this->request->getVar('cli_dias_6'),
            			'cli_dias_7'	=>	$this->request->getVar('cli_dias_7'),
            			'cli_observacoes'=>	$this->request->getVar('cli_observacoes'),
            		]);

            		$message = '<div class="alert alert-success">Clinica alterado com sucesso!</div>';
            }

            $output = array(
            	'clinica_nome_x_error'		=>	$clinica_nome_x_error,
            	'clinica_responsavel_x_error'	=>	$clinica_responsavel_x_error,
            	'clinica_email_x_error'		=>	$clinica_email_x_error,
            	'clinica_tel_x_error'			=>	$clinica_tel_x_error,
            	'clinica_cnpj_x_error'		=>	$clinica_cnpj_x_error,
            	'clinica_cep_x_error'			=>	$clinica_cep_x_error,
            	'clinica_uf_x_error'			=>	$clinica_uf_x_error,
            	'clinica_city_x_error'		=>	$clinica_city_x_error,
            	'clinica_bairro_x_error'		=>	$clinica_bairro_x_error,
            	'clinica_endereco_x_error'	=>	$clinica_endereco_x_error,
            	'clinica_observacao_x_error'	=>	$clinica_observacao_x_error,

            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}

	public function deleteDadosClinicaOne()
	{
		if($this->request->getVar('id_cli'))
        {
            $id = $this->request->getVar('id_cli');
            $model = new ClinicasModel();
            $model->where('id', $id)->delete($id);
            echo 'Clinica deletada com sucesso!';
        }
	}
}
