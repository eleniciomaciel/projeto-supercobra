<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ObrasModel;

class Obras extends Controller
{
	protected $request;
	public function __construct(){
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
	}

	public function index()
	{
		helper(['form', 'url']);

		$local_input_error = '';
		$data_inicio_error = '';
		$data_encerra_error = '';
		$cep_input_error = '';
		$input_state_uf_error = '';
		$input_cidade_error = '';
		$int_rua_error = '';
		$int_numero_error = '';
		$int_bairro_error = '';
		$int_cliente_error = '';
		$obra_status_error = '';
		$obs_obra_error = '';
		$error = 'no';
		$success = 'no';
		$message = '';

		$error = $this->validate([
			
			'local_input' 	=> ['label' => 'Local', 'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[100]|is_unique[obras.obras_local]'],
			'data_inicio' 	=> ['label' => 'data inicial', 'rules' => 'required|valid_date'],
			'data_encerra' 	=> ['label' => 'data final', 'rules' => 'required|valid_date'],
			'cep_input' 	=> ['label' => 'CEP', 'rules' => 'required|exact_length[10]'],
			'input_state_uf'=> ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
			'input_cidade' 	=> ['label' => 'Cidade', 'rules' => 'required'],
			'int_rua' 		=> ['label' => 'Rua', 'rules' => 'required|min_length[2]|max_length[80]'],
			'int_numero' 	=> ['label' => 'Número', 'rules' => 'required|min_length[1]|max_length[3]|integer'],
			'int_bairro' 	=> ['label' => 'Bairro', 'rules' => 'required|min_length[2]|max_length[50]'],
			'int_cliente' 	=> ['label' => 'Cliente', 'rules' => 'required'],
			'obra_status' 	=> ['label' => 'Status', 'rules' => 'required'],
			'obs_obra' 		=> ['label' => 'Observações', 'rules' => 'required'],
		]);

		if (!$error) {
			$error = 'yes';
			$validation = \Config\Services::validation();
			
			if ($validation->getError('local_input')) {
				$local_input_error = $validation->getError('local_input');
			}

			if ($validation->getError('data_inicio')) {
				$data_inicio_error = $validation->getError('data_inicio');
			}

			if ($validation->getError('data_encerra')) {
				$data_encerra_error = $validation->getError('data_encerra');
			}

			if ($validation->getError('cep_input')) {
				$cep_input_error = $validation->getError('cep_input');
			}
			if ($validation->getError('input_state_uf')) {
				$input_state_uf_error = $validation->getError('input_state_uf');
			}
			if ($validation->getError('input_cidade')) {
				$input_cidade_error = $validation->getError('input_cidade');
			}
			if ($validation->getError('int_rua')) {
				$int_rua_error = $validation->getError('int_rua');
			}
			if ($validation->getError('int_numero')) {
				$int_numero_error = $validation->getError('int_numero');
			}
			if ($validation->getError('int_bairro')) {
				$int_bairro_error = $validation->getError('int_bairro');
			}
			if ($validation->getError('int_cliente')) {
				$int_cliente_error = $validation->getError('int_cliente');
			}
			if ($validation->getError('obra_status')) {
				$obra_status_error = $validation->getError('obra_status');
			}
			if ($validation->getError('obs_obra')) {
				$obs_obra_error = $validation->getError('obs_obra');
			}
		} else {
			$success = 'yes';
			$ObrasModel = new ObrasModel();
			
			$ObrasModel->save([
				'obras_local'		=>	$this->request->getVar('local_input'),
				'data_inicio'			=>	$this->request->getVar('data_inicio'),
				'data_fim'			=>	$this->request->getPost('data_encerra'),
				'obras_cep'		=>	$this->request->getPost('cep_input'),
				'obras_estado'		=>	$this->request->getPost('input_state_uf'),
				'obras_cidade'	=>	$this->request->getPost('input_cidade'),
				'obras_endereco'		=>	$this->request->getPost('int_rua'),
				'obras_numero'		=>	$this->request->getPost('int_numero'),
				'obras_bairro'		=>	$this->request->getPost('int_bairro'),
				'obras_cliente'	=>	$this->request->getPost('int_cliente'),
				'status'			=>	$this->request->getPost('obra_status'),
				'obras_description'			=>	$this->request->getPost('obs_obra'),
			]);

				$message = '<div class="alert alert-success">Obra criada com sucesso!</div>';
		}
		$output = array(
			'local_input_error'		=>	$local_input_error,
			'data_inicio_error'		=>	$data_inicio_error,
			'data_encerra_error'	=>	$data_encerra_error,
			'cep_input_error'		=>	$cep_input_error,
			'input_state_uf_error'	=>	$input_state_uf_error,
			'input_cidade_error'	=>	$input_cidade_error,
			'int_rua_error'			=>	$int_rua_error,
			'int_numero_error'		=>	$int_numero_error,
			'int_bairro_error'		=>	$int_bairro_error,
			'int_cliente_error'		=>	$int_cliente_error,
			'obra_status_error'		=>	$obra_status_error,
			'obs_obra_error'		=>	$obs_obra_error,
			'error'					=>	$error,
            'success'				=>	$success,
            'message'				=>	$message
		);

		echo json_encode($output);
	}

	/**lista todas as obras */
	public function listaObras()
	{
		$list = new ObrasModel();
		$todasObras = $list->getObras();
		foreach ($todasObras as $obraLista) {
			$listaResultados[] = [

				$obraLista['obras_local'],
				date('d/m/Y', strtotime($obraLista['data_inicio'])),
				date('d/m/Y', strtotime($obraLista['data_fim'])),
				$obraLista['obras_estado'],
				$obraLista['obras_cidade'],
				$obraLista['status'],
				'<div class="btn-group dropleft">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Opções
				</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="'.$obraLista['id'].'">Visualizar</a>
						<a class="dropdown-item" href="'.$obraLista['id'].'">Status</a>
						<a class="dropdown-item" href="'.$obraLista['id'].'">Alterar</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="'.$obraLista['id'].'">Deletar</a>
					</div>
				</div>'
			];
			
		}
		$todasObras = [
			'data' => $listaResultados
		];
		echo json_encode($todasObras);
	}
}

