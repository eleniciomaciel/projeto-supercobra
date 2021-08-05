<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;
use App\Models\SolicitacaoMaterialEquipamentosServicosModel;
use App\Models\SolicitaitenscompraModel;
use App\Models\SolicitacaoarquivoModel;

class SolicitacaoMateriaisEquipamentosServicos extends BaseController
{
	public function index()
	{
		$model = new SolicitacaoMaterialEquipamentosServicosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			's_rev_numero' => ['label' => 'nº revisão', 'rules' => 'required|integer'],
			's_codigo_revisao' => ['label' => 'nº código da revisão', 'rules' => 'required|max_length[30]'],
			's_data' => ['label' => 'data', 'rules' => 'required|valid_date'],
			's_obras_abreviacao' => ['label' => 'sequencia', 'rules' => 'required'],
			's_usuario_departamento' => ['label' => 'sequencia', 'rules' => 'required'],
			's_sequencia' => [
				'label' => 'sequencia', 'rules' => 'required|max_length[50]|integer|validateRequestMaterialsEquipmentServices[s_usuario_departamento,s_ano_registro, s_sequencia]',
				'errors' => [
					'validateRequestMaterialsEquipmentServices' => 'Essa {field} já foi cadastrada.'
				]
			],
			's_local_entrega' => ['label' => 'local de entrega', 'rules' => 'required|max_length[100]'],
			's_aplicacao' => ['label' => 'aplicacao', 'rules' => 'required'],
			's_solicitado_por' => ['label' => 'solicitado', 'rules' => 'required|max_length[100]'],
		])) {
			$montagem_sequencia = $this->request->getPost('s_obras_abreviacao') . "- " . $this->request->getPost('s_sequencia') . "/" . date('Y');
			$model->save([
				'smes_departamento_fk' 						=> $this->request->getPost('s_usuario_departamento'),
				'smes_usuarios_solicitante_fk'  			=> $this->request->getPost('s_usuario_solicitante'),
				'smes_frente_solicitante_fk'  				=> $this->request->getPost('s_usuario_frente'),
				'smes_obra_solicitante_fk'  				=> $this->request->getPost('s_usuario_obra'),
				'smes_cargo_solicitante_fk'  				=> $this->request->getPost('s_usuario_cargo'),
				'smes_local_entrega'  						=> $this->request->getPost('s_local_entrega'),
				'smes_documento_qualidade_revisao_numero'  	=> $this->request->getPost('s_rev_numero'),
				'smes_documento_qualidade_codigo_revisao'  	=> $this->request->getPost('s_codigo_revisao'),
				'smes_solicitado_por'  						=> $this->request->getPost('s_solicitado_por'),
				'smes_sequencia_numerica'  					=> $montagem_sequencia,
				'smes_sequencia_numerica_original'  		=> $this->request->getPost('s_sequencia'),
				'smes_aplicacao'  							=> $this->request->getPost('s_aplicacao'),
				'smes_ano_registro'  						=> $this->request->getPost('s_ano_registro'),
				'datetime'  								=> $this->request->getPost('s_data'),
			]);
			session()->setFlashdata('success_smes_add', 'Registro cadastrado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}

	public function alterarSolicitacao(int $id)
	{
		$model = new SolicitacaoMaterialEquipamentosServicosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			's_rev_numero' => ['label' => 'nº revisão', 'rules' => 'required|integer'],
			's_codigo_revisao' => ['label' => 'nº código da revisão', 'rules' => 'required|max_length[30]'],
			's_data' => ['label' => 'data', 'rules' => 'required|valid_date'],
			's_obras_abreviacao' => ['label' => 'sequencia', 'rules' => 'required'],
			's_usuario_departamento' => ['label' => 'sequencia', 'rules' => 'required'],
			's_sequencia' => ['label' => 'sequencia', 'rules' => 'required|max_length[50]|integer'],
			's_local_entrega' => ['label' => 'local de entrega', 'rules' => 'required|max_length[100]'],
			's_aplicacao' => ['label' => 'aplicacao', 'rules' => 'required'],
			's_solicitado_por' => ['label' => 'solicitado', 'rules' => 'required|max_length[100]'],
		])) {
			$montagem_sequencia = $this->request->getPost('s_obras_abreviacao') . "- " . $this->request->getPost('s_sequencia') . "/" . date('Y');
			$model->save([
				'smes_id' 									=> $id,
				'smes_departamento_fk' 						=> $this->request->getPost('s_usuario_departamento'),
				'smes_usuarios_solicitante_fk'  			=> $this->request->getPost('s_usuario_solicitante'),
				'smes_frente_solicitante_fk'  				=> $this->request->getPost('s_usuario_frente'),
				'smes_obra_solicitante_fk'  				=> $this->request->getPost('s_usuario_obra'),
				'smes_cargo_solicitante_fk'  				=> $this->request->getPost('s_usuario_cargo'),
				'smes_local_entrega'  						=> $this->request->getPost('s_local_entrega'),
				'smes_documento_qualidade_revisao_numero'  	=> $this->request->getPost('s_rev_numero'),
				'smes_documento_qualidade_codigo_revisao'  	=> $this->request->getPost('s_codigo_revisao'),
				'smes_solicitado_por'  						=> $this->request->getPost('s_solicitado_por'),
				'smes_sequencia_numerica'  					=> $montagem_sequencia,
				'smes_sequencia_numerica_original'  		=> $this->request->getPost('s_sequencia'),
				'smes_aplicacao'  							=> $this->request->getPost('s_aplicacao'),
				'smes_ano_registro'  						=> $this->request->getPost('s_ano_registro'),
				'datetime'  								=> $this->request->getPost('s_data'),
			]);
			session()->setFlashdata('success_smes_up', 'Registro alterado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}


	public function solicitacaoItensCompra()
	{
		$model = new SolicitaitenscompraModel();

		//$test = implode(",",$this->request->getPost('itens_mas'));
		//dd($_POST['itens_mas']);
		if ($this->request->getMethod() === 'post' && $this->validate([

			'iten_unidade' => [
				'label'  => 'unidade',
				'rules'  => 'required|max_length[2]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'A {field} deve ter no máximo 2 caracteres',
				]
			],
			'iten_quantidade' => [
				'label'  => 'quantidade',
				'rules'  => 'required|max_length[10]|integer',
				'errors' => [
					'required' => 'A {field} devem ser escolhidas',
					'max_length' => 'A {field} deve ter no máximo 10 caracteres',
					'integer' => 'As {field} devem ser valor numérico inteiro não nulo?',
				]
			],
			'itens_descricao' => [
				'label'  => 'descrição',
				'rules'  => 'required',
				'errors' => [
					'required' => 'A {field} devem ser preeenchida.'
				]
			],
			'itens_mas.*' => [
				'label'  => 'requisito do meio ambiente',
				'rules'  => 'required',
				'errors' => [
					'required' => 'O {field} deve ser preenchido.'
				]
			],
			'itens_cc.*' => [
				'label'  => 'cento de custo',
				'rules'  => 'required',
				'errors' => [
					'required' => 'O {field} devem ser escolhidas.'
				]
			],
			'iten_data' => [
				'label'  => 'data',
				'rules'  => 'required|valid_date',
				'errors' => [
					'required' => 'A {field} devem ser escolhidas.',
					'valid_date' => 'A {field} devem ser válida.',
				]
			],
			'iten_observacao' => [
				'label'  => 'observação',
				'rules'  => 'required',
				'errors' => [
					'required' => 'A {field} devem ser preenchida.'
				]
			],
			'id_solicitante' => [
				'label'  => 'solicitante',
				'rules'  => 'required',
				'errors' => [
					'required' => 'O {field} deve exitir.'
				]
			],
			'id_solicitacao' => [
				'label'  => 'solicitação',
				'rules'  => 'required',
				'errors' => [
					'required' => 'A {field} deveexistir.'
				]
			]
		])) {
			$itens_qualidade = implode(",", $this->request->getPost('itens_mas'));
			$itens_cc = implode(",", $this->request->getPost('itens_cc'));

			$model->save([
				'isc_id_fk_solicitacao_compra' 	=> $this->request->getPost('id_solicitacao'),
				'isc_fk_id_solicitante'  		=> $this->request->getPost('id_solicitante'),
				'isc_unidade'  					=> strtoupper($this->request->getPost('iten_unidade')),
				'isc_quantidade'  				=> $this->request->getPost('iten_quantidade'),
				'isc_descricao_da_requisicao'  	=> $this->request->getPost('itens_descricao'),
				'isc_requisito_meio_ambiente'  	=> $itens_qualidade,
				'isc_cento_custo'  				=> $itens_cc,
				'isc_data_necessidade'  		=> $this->request->getPost('iten_data'),
				'isc_observacoes'  				=> $this->request->getPost('iten_observacao'),
			]);
			session()->setFlashdata('success_message_iten', 'Registro alterado com sucesso.');
			return redirect()->back();
		} else {
			session()->setFlashdata('error_message_iten', 'Ops! Registro não pode ser salvo, verifique por favor..');
			return redirect()->back()->withInput();
		}
	}

	public function getViewItenSolicitacao()
	{
		if ($this->request->getVar('id_iten')) {
			$model = new SolicitaitenscompraModel();
			$user_data = $model->where('isc_id', $this->request->getVar('id_iten'))->first();
			echo json_encode($user_data);
		}
	}

	/**alterar configuração */
	public function alterasolicitacaoItensCompra()
	{
		$model = new SolicitaitenscompraModel();
		$validation =  \Config\Services::validation();
		$this->validate([
			'isc_unidade' => [
				'label'  => 'unidade',
				'rules'  => 'required|max_length[2]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'A {field} deve ter no máximo 2 caracteres',
				]
			],
			'isc_quantidade' => [
				'label'  => 'quantidade',
				'rules'  => 'required|max_length[2]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'A {field} deve ter no máximo 2 caracteres',
				]
			],
			'isc_descricao_da_requisicao' => [
				'label'  => 'descrição da requisição',
				'rules'  => 'required|max_length[100]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'A {field} deve ter no máximo 100 caracteres',
				]
			],
			'isc_requisito_meio_ambiente' => [
				'label'  => 'requisitos do meio ambiente',
				'rules'  => 'required|max_length[500]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'O {field} deve ter no máximo 500 caracteres',
				]
			],
			'isc_cento_custo' => [
				'label'  => 'cento de custo',
				'rules'  => 'required',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
				]
			],
			'isc_data_necessidade' => [
				'label'  => 'data',
				'rules'  => 'required|valid_date',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'valid_date' => 'A {field} deve ser válida',
				]
			],
			'isc_observacoes' => [
				'label'  => 'observações',
				'rules'  => 'required|max_length[500]',
				'errors' => [
					'required' => 'A {field} deve ser preenchido',
					'max_length' => 'A {field} deve ter no máximo 500 caracteres',
				]
			],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$query = $model->save([
				'isc_id' 						=> $this->request->getPost('hidden_id_iten'),
				'isc_unidade'  					=> strtoupper($this->request->getPost('isc_unidade')),
				'isc_quantidade'  				=> $this->request->getPost('isc_quantidade'),
				'isc_descricao_da_requisicao'  	=> $this->request->getPost('isc_descricao_da_requisicao'),
				'isc_requisito_meio_ambiente'  	=> $this->request->getPost('isc_requisito_meio_ambiente'),
				'isc_cento_custo'  				=> $this->request->getPost('isc_cento_custo'),
				'isc_data_necessidade'  		=> $this->request->getPost('isc_data_necessidade'),
				'isc_observacoes'  				=> $this->request->getPost('isc_observacoes'),
			]);

			if ($query) {
				echo json_encode(['code'=> 1, 'msg'=>'Iten alterado com sucesso!']);
			} else {
				echo json_encode(['code'=> 0, 'msg'=>'Iten não pode ser alterado!']);
			}
		}
	}

	public function deleteIten()
	{
		if($this->request->getVar('id_del_i'))
        {
			$model = new SolicitaitenscompraModel();
            $id = $this->request->getVar('id_del_i');
			$model->delete(['isc_id' => $id]);
            echo 'Iten deletado com sucesso';
        }
	}

	public function myForm()
	{
		$builder = new SolicitacaoarquivoModel();

		$validated = $this->validate([
			'customFileInput' => ['customFileInput' => 'uploaded[customFileInput]|max_size[customFileInput,10240]|ext_in[customFileInput,png,jpg,jpeg,docx,pdf],'],
		]);

		$msg = 'Selecione um arquivo tipo pdf';

		if ($validated) {
			$avatar = $this->request->getFile('customFileInput');
			$avatar->move(WRITEPATH . 'uploads/file_solicitacao');

			$data = [
				'doc_solic_arquivo_nome'  => $avatar->getClientMimeType(),
				'doc_solic_descricao' =>  $avatar->getClientName(),
			];

			$save = $builder->insert($data);
			$msg = 'Arquivo adicionado com sucesso!';
		}
		return redirect()->back()->with('msg', $msg);
	}

	# Method to submit form

	public function uploadArquivo()
	{
		if ($this->request->getMethod() == "post") {

			$rules = [
				"descricao_doc_solicitacao" => [
					"rules" =>"required|min_length[9]|max_length[500]",
					"label" => "Descrição"
				],
				"profile_image" => [
					"rules" => "uploaded[profile_image]|max_size[profile_image,1024]|ext_in[profile_image,png,jpg,pdf]",
					"label" => "Documento",
				],
			];

			if (!$this->validate($rules)) {
				  return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
			} else {

				$file = $this->request->getFile("profile_image");

				$session = session();
				$newName = $file->getRandomName();

				if ($file) {
					$file->move("uploads/file_solicitacao", $newName);
					$model = new SolicitacaoarquivoModel();

					$data = [
						"doc_solic_id_fk_solicitacao" => $this->request->getVar("id_arquivo"),
						'doc_solic_arquivo_nome' =>  $newName,
						"doc_solic_descricao" => $this->request->getVar("descricao_doc_solicitacao"),
					];

					if ($model->insert($data)) {
						$session->setFlashdata("success_uploaded", "Arquivo adicionado com sucesso!");
					} else {
						$session->setFlashdata("error_uploaded", "Falha ao subir arquivo.");
					}
				}
			}
			return redirect()->back();
		}
		return redirect()->back();
	}

	/**download de arquivos documentos */
	public function baixarDadosSolicitacao(string $arquivo)
    {
        $caminho = ROOTPATH . 'public/uploads/file_solicitacao/';//equal writable/uploads/$arquivo
         return $this->response->download($caminho.$arquivo, null);
    }

	/**deleta arquivo */
	public function deleteArquivoSolicitacao()
    {
        if($this->request->getVar('id_del_as'))
        {
            $id = $this->request->getVar('id_del_as');
            $model = new SolicitacaoarquivoModel();
            $model->where('doc_solic_id', $id)->delete($id);
            echo 'Arquivo deletado com sucesso!';
        }
    }

	public function deleteSolicitacaoCompra(int $id = null)
	{
		$model = new SolicitacaoMaterialEquipamentosServicosModel();
		$data['dados'] = $model->where('smes_id', $id)->first();
		if (empty($data['dados']) || $data['dados'] === NULL) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Essa solicitação não foi encontrada: '. $id);
		}

		$model->delete($id);
		$session = session();
		$session->setFlashdata("delete_msg_solicitacao", "Solicitação deletada com sucesso!");
		return redirect()->back();

	}
}
