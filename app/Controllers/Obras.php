<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Controllers\BaseController;
use App\Models\ObrasModel;

class Obras extends Controller
{

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
			'local_input'     		=> 'required|alpha_numeric_space|min_length[3]|max_length[100]|is_unique[obras.obras_local]',
			'data_inicio'        	=> 'required|valid_date',
			'data_encerra'     		=> 'required|valid_date',
			'cep_input'     		=> 'required|exact_length[10]',
			'input_state_uf'     	=> 'required|exact_length[2]',
			'input_cidade'     		=> 'required',
			'int_rua'     		    => 'required|min_length[2]|max_length[80]',
			'int_numero'     		=> 'required|min_length[1]|max_length[3]|integer',
			'int_bairro'     		=> 'required|min_length[2]|max_length[50]',
			'int_cliente' 	        => 'required',
			'obra_status' 			=> 'required',
			'obs_obra' 				=> 'required',
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
				'data_fim'			=>	$this->request->getVar('email'),
				'obras_cep'			=>	$this->request->getPost('gender'),
				'obras_estado'		=>	$this->request->getPost('gender'),
				'obras_cidade'		=>	$this->request->getPost('gender'),
				'obras_endereco'	=>	$this->request->getPost('gender'),
				'obras_numero'		=>	$this->request->getPost('gender'),
				'obras_bairro'		=>	$this->request->getPost('gender'),
				'obras_cliente'		=>	$this->request->getPost('gender'),
				'obras_description'	=>	$this->request->getPost('gender'),
				'datetime'			=>	$this->request->getPost('gender'),
				'gender'			=>	$this->request->getPost('gender'),
				'gender'			=>	$this->request->getPost('gender'),
			]);

				$message = '<div class="alert alert-success">User Data Added</div>';
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
}

