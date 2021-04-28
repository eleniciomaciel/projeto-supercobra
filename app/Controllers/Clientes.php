<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
	public function cadastrar()
	{
		$cli_o_nome_obra_error = '';
		$cli_o_cnpj_error = '';
		$cli_o_datainicial_error = '';
		$cli_o_datafinal_error = '';
		$cli_o_cep_error = '';
		$cli_o_uf_error = '';
		$cli_o_city_error = '';
		$cli_o_address_error = '';
		$cli_o_number_error = '';
		$cli_o_neighborhood_error = '';
		$objeto_ob_error = '';
		$error = 'no';
		$success = 'no';
		$message = '';

		$error = $this->validate([

			'cli_o_nome_obra' 		=> ['label' => 'Nome da obra', 'rules' => 'required|alpha_numeric_space|min_length[3]|max_length[100]|is_unique[clientes.nome_cli]'],
			'cli_o_cnpj' 			=> ['label' => 'CNPJ', 'rules' => 'required|exact_length[18]|is_unique[clientes.cnpj_cli]'],
			'cli_o_datainicial'		=> ['label' => 'Data Inicial', 'rules' => 'required|valid_date'],
			'cli_o_datafinal' 		=> ['label' => 'Data Final', 'rules' => 'required|valid_date'],
			'cli_o_cep'				=> ['label' => 'CEP', 'rules' => 'required|exact_length[10]'],
			'cli_o_uf' 				=> ['label' => 'UF', 'rules' => 'required|exact_length[2]'],
			'cli_o_city' 			=> ['label' => 'Cidade', 'rules' => 'required|min_length[2]|max_length[80]'],
			'cli_o_address' 		=> ['label' => 'Endereço', 'rules' => 'required|min_length[1]|max_length[100]'],
			'cli_o_number' 			=> ['label' => 'Número', 'rules' => 'required|max_length[5]|integer'],
			'cli_o_neighborhood' 	=> ['label' => 'Bairro', 'rules' => 'required|min_length[2]|max_length[100]'],
			'objeto_ob' 			=> ['label' => 'Obeto da Obra', 'rules' => 'required|min_length[2]'],
		]);

		if (!$error) {
			$error = 'yes';
			$validation = \Config\Services::validation();

			if ($validation->getError('cli_o_nome_obra')) {
				$cli_o_nome_obra_error = $validation->getError('cli_o_nome_obra');
			}

			if ($validation->getError('cli_o_cnpj')) {
				$cli_o_cnpj_error = $validation->getError('cli_o_cnpj');
			}

			if ($validation->getError('cli_o_datainicial')) {
				$cli_o_datainicial_error = $validation->getError('cli_o_datainicial');
			}

			if ($validation->getError('cli_o_datafinal')) {
				$cli_o_datafinal_error = $validation->getError('cli_o_datafinal');
			}
			if ($validation->getError('cli_o_cep')) {
				$cli_o_cep_error = $validation->getError('cli_o_cep');
			}
			if ($validation->getError('cli_o_uf')) {
				$cli_o_uf_error = $validation->getError('cli_o_uf');
			}
			if ($validation->getError('cli_o_city')) {
				$cli_o_city_error = $validation->getError('cli_o_city');
			}
			if ($validation->getError('cli_o_address')) {
				$cli_o_address_error = $validation->getError('cli_o_address');
			}
			if ($validation->getError('cli_o_number')) {
				$cli_o_number_error = $validation->getError('cli_o_number');
			}
			if ($validation->getError('cli_o_neighborhood')) {
				$cli_o_neighborhood_error = $validation->getError('cli_o_neighborhood');
			}
			if ($validation->getError('objeto_ob')) {
				$objeto_ob_error = $validation->getError('objeto_ob');
			}
		} else {
			$success = 'yes';
			$clientes = new ClientesModel();

			$clientes->save([
				'nome_cli'			=>	$this->request->getVar('cli_o_nome_obra'),
				'cnpj_cli'			=>	$this->request->getVar('cli_o_cnpj'),
				'data_inicio_cli'	=>	$this->request->getPost('cli_o_datainicial'),
				'data_final_cli'	=>	$this->request->getPost('cli_o_datafinal'),
				'cep_cli'			=>	$this->request->getPost('cli_o_cep'),
				'uf_cli'			=>	$this->request->getPost('cli_o_uf'),
				'cidade_cli'		=>	$this->request->getPost('cli_o_city'),
				'endereco_cli'		=>	$this->request->getPost('cli_o_address'),
				'numero_cli'		=>	$this->request->getPost('cli_o_number'),
				'bairro_cli'		=>	$this->request->getPost('cli_o_neighborhood'),
				'description_cli'	=>	$this->request->getPost('objeto_ob'),
				'datetime'			=>	date('Y-m-d'),
			]);

			$message = '<div class="alert alert-success">Obra criada com sucesso!</div>';
		}
		$output = array(
			'cli_o_nome_obra_error'		=>	$cli_o_nome_obra_error,
			'cli_o_cnpj_error'			=>	$cli_o_cnpj_error,
			'cli_o_datainicial_error'	=>	$cli_o_datainicial_error,
			'cli_o_datafinal_error'		=>	$cli_o_datafinal_error,
			'cli_o_cep_error'			=>	$cli_o_cep_error,
			'cli_o_uf_error'			=>	$cli_o_uf_error,
			'cli_o_city_error'			=>	$cli_o_city_error,
			'cli_o_address_error'		=>	$cli_o_address_error,
			'cli_o_number_error'		=>	$cli_o_number_error,
			'cli_o_neighborhood_error'	=>	$cli_o_neighborhood_error,
			'objeto_ob_error'			=>	$objeto_ob_error,
			'error'						=>	$error,
			'success'					=>	$success,
			'message'					=>	$message
		);

		echo json_encode($output);
	}

	/**lista clientes das obras */
	public function getCustomers()
	{
		$clientesModel = new ClientesModel();
		$clientesModel->select("id_cli,nome_cli,data_inicio_cli,data_final_cli,uf_cli,cidade_cli,cnpj_cli,endereco_cli,uf_cli");
		$clientes = $clientesModel->findAll();
		foreach ($clientes as $key) {
			$resultado[] = [
				$key['nome_cli'],
				$key['cnpj_cli'],
				date('d/m/Y', strtotime($key['data_inicio_cli'])),
				date('d/m/Y', strtotime($key['data_final_cli'])),
				$key['uf_cli'],
				$key['cidade_cli'],
				'<div class="btn-group dropleft">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-layer-group"></i>  Opções
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="/visualizar-cliente/' . esc($key['id_cli']) . '">
						<i class="fas fa-eye"></i> Visualizar
					</a>
					<a class="dropdown-item" href="/status-cliente/' . esc($key['id_cli']) . '">
						<i class="fas fa-unlock-alt"></i>  Status
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="/deletar-cliente/' . esc($key['id_cli']) . '">
						<i class="fas fa-power-off"></i> Deletar
					</a>
				</div>
			  </div>',

			];
		}
		$clientes = [
			'data' => $resultado
		];
		echo json_encode($clientes);
	}

	/**visualiza para alterar dados */
	public function verAlterar($id = NULL)
	{
		$model = new ClientesModel();
		$data['info'] = $model->getUsers($id);
		if (empty($data['info'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuário não encontrado: ' . $id);
		}
		$data['info'];
		echo view('master/layout/pages/clientes/visualizaCliente', $data);
	}
	/**altera dados do cliente */
	public function atualizarCliente()
	{
		$model = new ClientesModel();
		$id = $this->request->getPost('id_cliente_up');
		$data['info'] = $model->getUsers($id);

		if (empty($data['info'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuário não encontrado: ' . $id);
		}

		$data = [
			'nome_cli' 			=> $this->request->getPost('new_nome_cleinete'),
			'cnpj_cli'    		=> $this->request->getPost('new_cnpj'),
			'data_inicio_cli'   => $this->request->getPost('new_data_inicial'),
			'data_final_cli'    => $this->request->getPost('new_data_final'),
			'cep_cli'    		=> $this->request->getPost('new_cep'),
			'uf_cli'    		=> $this->request->getPost('new_estado'),
			'cidade_cli'    	=> $this->request->getPost('new_cidade'),
			'endereco_cli'    	=> $this->request->getPost('new_endereco'),
			'numero_cli'    	=> $this->request->getPost('new_numero'),
			'bairro_cli'    	=> $this->request->getPost('new_bairro'),
			'description_cli'   => $this->request->getPost('new_objeto'),
		];
		$model->update($id, $data);
		$session = session();
		$session->setFlashdata("success", "Cliente atualizado com sucesso!");
		return redirect()->to(base_url('visualizar-cliente/'.$id));
	}
	/**lista todos os clientes */
	public function listaClientes()
	{
		$list = new ClientesModel();
		$todasClientes = $list->getUsers();
		echo json_encode($todasClientes);
	}
}
