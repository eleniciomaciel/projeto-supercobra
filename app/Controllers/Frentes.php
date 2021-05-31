<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FrentesModel;
class Frentes extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "ADMIN") {
            echo 'Access denied';
            exit;
        }
    }
	
	public function cadastroFrentes()
	{
		$frt_cliente_error = '';
		$frt_obra_error = '';
		$frt_projeto_nome_error = '';
		$frt_dataInicial_error = '';
		$frt_datafinal_error = '';
		$frt_cep_error = '';
		$frt_estado_error = '';
		$frt_bairros_error = '';
		$frt_cidade_error = '';
		$frt_endereco_error = '';
		$frt_numeros_error = '';
		$frt_observacoes_error = '';
		$error = 'no';
		$success = 'no';
		$message = '';

		$error = $this->validate([

			'frt_cliente' 			=> ['label' => 'Cliente', 'rules' => 'required'],
			'frt_obra' 				=> ['label' => 'Obra', 'rules' => 'required'],
			'frt_projeto_nome'		=> ['label' => 'Nome da frente', 'rules' => 'required|min_length[3]|max_length[100]|is_unique[frentes.nome_ft]'],
			'frt_dataInicial'		=> ['label' => 'Data Inicial', 'rules' => 'required|valid_date'],
			'frt_datafinal' 		=> ['label' => 'Data Final', 'rules' => 'required|valid_date'],
			'frt_cep' 				=> ['label' => 'Cep', 'rules' => 'required|min_length[1]|exact_length[10]'],
			'frt_estado' 			=> ['label' => 'Estado', 'rules' => 'required|exact_length[2]'],
			'frt_cidade' 			=> ['label' => 'Cidade', 'rules' => 'required'],
			'frt_bairros' 			=> ['label' => 'Bairro', 'rules' => 'required|min_length[2]|max_length[100]'],
			'frt_endereco' 			=> ['label' => 'Endereço', 'rules' => 'required|min_length[2]|max_length[100]'],
			'frt_numeros' 			=> ['label' => 'Número', 'rules' => 'required|integer'],
			'frt_observacoes' 		=> ['label' => 'Observações', 'rules' => 'required|min_length[2]'],
		]);

		if (!$error) {
			$error = 'yes';
			$validation = \Config\Services::validation();

			if ($validation->getError('frt_cliente')) {
				$frt_cliente_error = $validation->getError('frt_cliente');
			}

			if ($validation->getError('frt_obra')) {
				$frt_obra_error = $validation->getError('frt_obra');
			}

			if ($validation->getError('frt_projeto_nome')) {
				$frt_projeto_nome_error = $validation->getError('frt_projeto_nome');
			}

			if ($validation->getError('frt_dataInicial')) {
				$frt_dataInicial_error = $validation->getError('frt_dataInicial');
			}
			if ($validation->getError('frt_datafinal')) {
				$frt_datafinal_error = $validation->getError('frt_datafinal');
			}
			if ($validation->getError('frt_cep')) {
				$frt_cep_error = $validation->getError('frt_cep');
			}
			if ($validation->getError('frt_estado')) {
				$frt_estado_error = $validation->getError('frt_estado');
			}
			if ($validation->getError('frt_cidade')) {
				$frt_cidade_error = $validation->getError('frt_cidade');
			}
			if ($validation->getError('frt_bairros')) {
				$frt_bairros_error = $validation->getError('frt_bairros');
			}

			if ($validation->getError('frt_endereco')) {
				$frt_endereco_error = $validation->getError('frt_endereco');
			}
			if ($validation->getError('frt_numeros')) {
				$frt_numeros_error = $validation->getError('frt_numeros');
			}
			if ($validation->getError('frt_observacoes')) {
				$frt_observacoes_error = $validation->getError('frt_observacoes');
			}

		} else {
			$success = 'yes';
			$clientes = new FrentesModel();

			$clientes->save([
				'cliente_fk_id_ft'		=>	$this->request->getVar('frt_cliente'),
				'obra_fk_id_ft'			=>	$this->request->getVar('frt_obra'),
				'nome_ft'				=>	$this->request->getPost('frt_projeto_nome'),
				'data_inicial_ft'		=>	$this->request->getPost('frt_dataInicial'),
				'data_final_ft'			=>	$this->request->getPost('frt_datafinal'),
				'cep_ft'				=>	$this->request->getPost('frt_cep'),
				'estado_uf_ft'			=>	$this->request->getPost('frt_estado'),
				'cidade_ft'				=>	$this->request->getPost('frt_cidade'),
				'bairro_ft'				=>	$this->request->getPost('frt_bairros'),
				'endereco_ft'			=>	$this->request->getPost('frt_endereco'),
				'numero_ft'				=>	$this->request->getPost('frt_numeros'),
				'ponto_referencia_ft'	=>	$this->request->getPost('frt_observacoes'),
			]);

			$message = '<div class="alert alert-success">Obra criada com sucesso!</div>';
		}
		$output = array(
			'frt_cliente_error'			=>	$frt_cliente_error,
			'frt_obra_error'			=>	$frt_obra_error,
			'frt_projeto_nome_error'	=>	$frt_projeto_nome_error,
			'frt_dataInicial_error'		=>	$frt_dataInicial_error,
			'frt_datafinal_error'		=>	$frt_datafinal_error,
			'frt_cep_error'				=>	$frt_cep_error,
			'frt_estado_error'			=>	$frt_estado_error,
			'frt_cidade_error'			=>	$frt_cidade_error,
			'frt_bairros_error'			=>	$frt_bairros_error,
			'frt_endereco_error'		=>	$frt_endereco_error,
			'frt_numeros_error'			=>	$frt_numeros_error,
			'frt_observacoes_error'		=>	$frt_observacoes_error,
			'error'						=>	$error,
			'success'					=>	$success,
			'message'					=>	$message
		);

		echo json_encode($output);
	}

	/**lista todas as obras */
	public function listaFrentes()
	{
		$list = new FrentesModel();
		$todasFrentes = $list->getFrentes();
		foreach ($todasFrentes as $frentesList) {
			$listaResultados[] = [

				$frentesList['nome_cli'],
				$frentesList['obras_local'],
				$frentesList['nome_ft'],
				date('d/m/Y', strtotime($frentesList['data_inicial_ft'])),
				date('d/m/Y', strtotime($frentesList['data_final_ft'])),
				$frentesList['estado_uf_ft'],
				$frentesList['cidade_ft'],
				$frentesList['cep_ft'],
				'<div class="btn-group dropleft">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Opções
				</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/cadastros/ver-obra/'.esc($frentesList['id_ft']).'"><i class="fa fa-eye"></i> Visualizar</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="'.$frentesList['id_ft'].'"><i class="fa fa-trash"></i> Deletar</a>
					</div>
				</div>'
			];
			
		}
		$todasFrentes = [
			'data' => $listaResultados
		];
		echo json_encode($todasFrentes);
	}
}
