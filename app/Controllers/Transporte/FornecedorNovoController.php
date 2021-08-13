<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;
use App\Models\FornecedorempresaModel;
use App\Models\FornecedorveiculosModel;
use App\Models\FornecedorAuxiliarEmpresaRepresentanteModel;
use monken\TablesIgniter;
use App\Models\FornecedorContaModel;
use App\Models\FornecedorDocumentosModel;

class FornecedorNovoController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "TRANSPORTE") {
			echo view('/');
			exit;
		}
	}

	public function index($page = 'painel-cadastro')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor-novo/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		return view('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/' . $page);
	}

	/**
	 * cadastro da empresa
	 */
	public function cadastraEmpresaDoFornecedor()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'empr_nome' => ['label' => 'nome', 'rules' => 'required|max_length[255]'],
			'enpr_cnae' => ['label' => 'cnae', 'rules' => 'min_length[2]|max_length[14]'],
			'enpr_classificacao_empresa' => ['label' => 'classificação da empresa', 'rules' => 'required'],
			'empre_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'empr_incricao_estadual' => ['label' => 'incriççao estadual', 'rules' => 'max_length[50]'],
			'empr_incricao_municiapl' => ['label' => 'incrição municipal', 'rules' => 'max_length[50]'],
			'empr_cep' => ['label' => 'cep', 'rules' => 'required'],
			'empr_uf' => ['label' => 'uf', 'rules' => 'required|exact_length[2]'],
			'empr_cidade' => ['label' => 'cidade', 'rules' => 'required|max_length[50]'],
			'empr_bairro' => ['label' => 'bairro', 'rules' => 'required|max_length[80]'],
			'empr_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
			'empr_observacao' => ['label' => 'observações', 'rules' => 'required|max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorempresaModel();
			$query = $model->save([
				'ef_fk_quem_cadastrou' 		=> $this->request->getPost('id_de_quen_cadastrou'),
				'ef_razao_social'  			=> $this->request->getPost('empr_nome'),
				'ef_cnae'  					=> $this->request->getPost('enpr_cnae'),
				'ef_classificacao_empresa'  => $this->request->getPost('enpr_classificacao_empresa'),
				'ef_cnpj' 					=> $this->request->getPost('empre_cnpj'),
				'ef_incricao_estadual' 		=> $this->request->getPost('empr_incricao_estadual'),
				'ef_incricao_municial' 		=> $this->request->getPost('empr_incricao_municiapl'),
				'ef_cep' 					=> $this->request->getPost('empr_cep'),
				'ef_uf' 					=> $this->request->getPost('empr_uf'),
				'ef_cidade' 				=> $this->request->getPost('empr_cidade'),
				'ef_bairro' 				=> $this->request->getPost('empr_bairro'),
				'ef_endereco' 				=> $this->request->getPost('empr_endereco'),
				'ef_description' 			=> $this->request->getPost('empr_observacao'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Empresa adicionada com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A empresa não pode ser criada, desculpe!']);
			}
		}
	}


	/**
	 * cadastra representante
	 */

	public function cadastraRepresentante()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'fort_name' => ['label' => 'nome do fornecedor', 'rules' => 'required|max_length[100]|is_unique[fornecedorveiculos.for_responsavel]'],
			'fort_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|valid_email|is_unique[fornecedorveiculos.for_email]'],
			'fort_telefone' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_telefone2' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_cpf' => [
				'label' => 'cpf', 'rules' => 'required|validaCpf|exact_length[14]|is_unique[fornecedorveiculos.for_cnpj]',
				'errors' => [
					'validaCpf' => 'O cpf está com formato incorreto.'
				]
			],
			'fort_observacao' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
			'fort_obra' => ['label' => 'obra', 'rules' => 'required'],
			'fort_frente' => ['label' => 'frente', 'rules' => 'required'],
			'fort_usuario' => ['label' => 'usuário', 'rules' => 'required'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorveiculosModel();
			$query = $model->save([
				'for_fk_obra' 		=> $this->request->getPost('fort_obra'),
				'for_fk_frente'  	=> $this->request->getPost('fort_frente'),
				'for_fk_usuario'  	=> $this->request->getPost('fort_usuario'),
				'for_responsavel'  	=> $this->request->getPost('fort_name'),
				'for_email'  		=> strtolower($this->request->getPost('fort_email')),
				'for_telefone'  	=> $this->request->getPost('fort_telefone'),
				'for_telefone2'  	=> $this->request->getPost('fort_telefone2'),
				'for_cnpj'  		=> $this->request->getPost('fort_cpf'),
				'for_description'  	=> $this->request->getPost('fort_observacao'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Representante adicionada com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A cadastro não pode ser criada, desculpe!']);
			}
		}
	}

	/**
	 * busca empresa pelo cnpj
	 */
	public function consultaEmpresa()
	{
		if (!$this->request->isAJAX()) {
			exit('Página não encontrada');
		}
		$builder = new FornecedorempresaModel();
		$empresa = $builder->pesquisarCnpjEmpresa($this->request->getGet('term'));
		$retorno = [];

		foreach ($empresa as $key) {
			$data['id'] = $key->ef_id;
			$data['value'] = $key->ef_cnpj;
			$retorno[] = $data;
		}
		return $this->response->setJSON($retorno);
	}

	public function consultaCpf()
	{
		if (!$this->request->isAJAX()) {
			exit('Página não encontrada');
		}
		$builder = new FornecedorveiculosModel();
		$empresa = $builder->pesquisarCpfRepresentante($this->request->getGet('term'));
		$retorno = [];

		foreach ($empresa as $key) {
			$data['id'] = $key->for_id;
			$data['value'] = $key->for_responsavel;
			$retorno[] = $data;
		}
		return $this->response->setJSON($retorno);
	}

	public function cadastraAuxiliarRepresentante()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'userid_representante_hide' => [
				'label' => 'empresa', 'rules' => 'required',
				'errors' => [
					'required' => 'escolha uma {field}.'
				]
			],
			'userid_hide' => [
				'label' => 'representante', 'rules' => 'required',
				'errors' => [
					'required' => 'escolha um {field}.',
				]
			],

			'search_empresa_cnpj' => [
				'label' => 'empresa', 'rules' => 'required',
				'errors' => [
					'required' => 'escolha uma {field}.'
				]
			],
			'search_representante' => [
				'label' => 'representante', 'rules' => 'required|evenVericaExistesDoisCadastros[userid_representante_hide,userid_hide]',
				'errors' => [
					'required' => 'escolha um {field}.',
					'evenVericaExistesDoisCadastros' => 'O {field} já foi cadastrado com essa empresa, adicione em outra por favor.'
				]
			],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorAuxiliarEmpresaRepresentanteModel();
			$query = $model->save([
				'faer_fk_representante' => $this->request->getPost('userid_representante_hide'),
				'faer_fk_empresa'  		=> $this->request->getPost('userid_hide'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Cadastro adicionada com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A cadastro não pode ser criada, desculpe!']);
			}
		}
	}

	public function listaFornecedorEmpresas()
	{
		$model = new FornecedorAuxiliarEmpresaRepresentanteModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable())
			->setDefaultOrder("ef_cnpj", "DESC")
			->setSearch(["ef_cnpj", "ef_razao_social", "for_responsavel", "for_email"])
			->setOrder(["ef_cnpj", "ef_razao_social", "for_responsavel", "for_email"])
			->setOutput(["ef_cnpj", "ef_razao_social", "for_responsavel", "for_email", $model->button()]);
		return $data_table->getDatatable();
	}

	public function getListaEmpresaBancos()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		if ($this->request->getVar('id')) {
			$model = new FornecedorAuxiliarEmpresaRepresentanteModel();
			$user_data = $model->join('fornecedor_empresas', 'fornecedor_empresas.ef_id = fornecedor_auxiliar_e_r.faer_fk_empresa')->where('faer_id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}

	/**
	 * adiciona conta bancaria
	 */

	public function adicionaContaBanco()
	{
		$model = new FornecedorContaModel();
		$validation =  \Config\Services::validation();
		$this->validate([
			'banco' => ['label' => 'banco', 'rules' => 'required|max_length[30]'],
			'tipo_de_conta' => ['label' => 'tipo de conta', 'rules' => 'required'],
			'agencia' => ['label' => 'agência', 'rules' => 'required|integer|max_length[5]'],
			'numero_conta' => ['label' => 'número da conta', 'rules' => 'required|min_length[2]|max_length[14]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'digito_conta' => ['label' => 'dígito da conta', 'rules' => 'required|max_length[5]'],
			'observacao_conta' => ['label' => 'observações da conta', 'rules' => 'required'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$query = $model->save([
				'cbf_empresa_fk'  		=> $this->request->getPost('hidden_id_empresaConta'),
				'cbf_banco'  			=> $this->request->getPost('banco'),
				'cbf_tipo_conta'  		=> $this->request->getPost('tipo_de_conta'),
				'cbf_agencia'  			=> $this->request->getPost('agencia'),
				'cbf_numero_conta'  	=> $this->request->getPost('numero_conta'),
				'cbf_digito_conta'  	=> $this->request->getPost('digito_conta'),
				'cbf_Observacoes_conta' => $this->request->getPost('observacao_conta'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Banco adicionado com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'Bnanco não pode ser adicionado!']);
			}
		}
	}

	/**
	 * lista bancos das empresas
	 */
	public function getBancoEmpresa()
	{
		$model = new FornecedorContaModel();
		$data_table = new TablesIgniter();
		$id =  $this->request->getVar('param');
		$data_table->setTable($model->noticeTable($id))
				   ->setDefaultOrder("cbf_banco", "DESC")
				   ->setSearch(["cbf_banco", "cbf_tipo_conta", "cbf_agencia","cbf_numero_conta"])
				   ->setOrder(["cbf_banco", "cbf_tipo_conta", "cbf_agencia", "cbf_numero_conta"])
				   ->setOutput(["cbf_banco", "cbf_tipo_conta", "cbf_agencia", "cbf_numero_conta", $model->button()]);
		return $data_table->getDatatable();
	}

	public function viewBanco()
	{
		$model = new FornecedorContaModel();
		$id = $this->request->getGet('param');
		$data = $model->where('cbf_empresa_fk', $id)->findAll();
		if ($data) :
			foreach ($data as $post) :
			echo    '<tr>
						<td>' . $post["cbf_banco"] . '</td>
						<td>' . $post["cbf_tipo_conta"] . '</td>
						<td>' . $post["cbf_agencia"] . '</td>
						<td>' . $post["cbf_numero_conta"] . '</td>
						<td>
							<div class="btn-group dropleft">
								<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opções
								</button>
								<div class="dropdown-menu">
									<a href="javascript:void(0);"  class="meuBancoGet dropdown-item" data-id="'.$post["cbf_id"].'"><i class="fas fa-eye"></i> Visualizar</a>
								<div class="dropdown-divider"></div>
									<a href="javascript:void(0);" class="delBanco dropdown-item" data-id="'.$post["cbf_id"].'"><i class="fas fa-trash"></i> Deletar</a>
								</div>
							</div>
						</td>
						<td>
					</tr>';
			endforeach;
		endif;
	}

	/**
	 * lista dados do banco
	 */
	public function getDadosBanco()
	{
		if($this->request->getVar('id'))
        {
            $model = new FornecedorContaModel();
            $user_data = $model->where('cbf_id', $this->request->getVar('id'))->first();
            echo json_encode($user_data);
        }
	}

	/**
	 * adiciona conta bancaria
	 */

	public function atualizaContaBanco()
	{
		$model = new FornecedorContaModel();
		$validation =  \Config\Services::validation();
		$this->validate([
			'cbf_banco' => ['label' => 'banco', 'rules' => 'required|max_length[30]'],
			'cbf_tipo_conta' => ['label' => 'tipo de conta', 'rules' => 'required'],
			'cbf_agencia' => ['label' => 'agência', 'rules' => 'required|integer|max_length[5]'],
			'cbf_numero_conta' => ['label' => 'número da conta', 'rules' => 'required|min_length[2]|max_length[14]'],
			'cbf_digito_conta' => ['label' => 'dígito da conta', 'rules' => 'required|max_length[5]'],
			'cbf_Observacoes_conta' => ['label' => 'observações da conta', 'rules' => 'required'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$query = $model->save([
				'cbf_id'  				=> $this->request->getPost('hidden_id_banco_alterar'),
				'cbf_banco'  			=> $this->request->getPost('cbf_banco'),
				'cbf_tipo_conta'  		=> $this->request->getPost('cbf_tipo_conta'),
				'cbf_agencia'  			=> $this->request->getPost('cbf_agencia'),
				'cbf_numero_conta'  	=> $this->request->getPost('cbf_numero_conta'),
				'cbf_digito_conta'  	=> $this->request->getPost('cbf_digito_conta'),
				'cbf_Observacoes_conta' => $this->request->getPost('cbf_Observacoes_conta'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Banco alterado com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'Bnanco não pode ser alterado!']);
			}
		}
	}

	/**
	 * delete conta
	 */
	public function deleteBanco()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new FornecedorContaModel();
            $model->where('cbf_id', $id)->delete($id);
            echo 'Banco deletado com sucesso';
        }
	}

	/**
	 * cadastr documento da empresa
	 */
	public function inserirDocumentoEmpresa()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		if ($this->request->getMethod() == "post") {

			$rules = [
				"doc_descricao" => "required",
				"profileImage" => [
					"rules" => "uploaded[profileImage]|max_size[profileImage,1024]|ext_in[profileImage,png,jpg,pdf]",
					"label" => "Profile Image",
				],
			];

			if (!$this->validate($rules)) {

				$response = [
					'success' => false,
					'msg' => "O arquivo não está no formato Doc, PDF ou ultrapassou o limite de 1024-MB ",
				];

				return $this->response->setJSON($response);
			} else {

				$file = $this->request->getFile('profileImage');

				$profile_image = $file->getName();

				// Renaming file before upload
				$temp = explode(".",$profile_image);
				$newfilename = round(microtime(true)) . '.' . end($temp);

				if ($file->move("uploads/file_doc_fornnecedor", $newfilename)) {

					$studentModel = new FornecedorDocumentosModel();

					$data = [
						"fk_id_fornecedor" => $this->request->getVar("hidden_id_empresa_doc"),
						"fd_descricao" => $this->request->getVar("doc_descricao"),
						"fd_documento" => $newfilename,
					];

					if ($studentModel->insert($data)) {

						$response = [
							'success' => true,
							'msg' => "Arquivo salvo com sucesso",
						];
					} else {

						$response = [
							'success' => false,
							'msg' => "Falha ao criar aluno",
						];
					}

					return $this->response->setJSON($response);
				} else {

					$response = [
						'success' => false,
						'msg' => "Falha ao carregar imagem",
					];

					return $this->response->setJSON($response);
				}
			}
		}
	}

	/**
	 * lista documentos da empresa
	 */

	public function getDocumentosempesa()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		$model = new FornecedorDocumentosModel();
		$id = $this->request->getGet('param');
		$data = $model->where('fk_id_fornecedor', $id)->findAll();
		if ($data) :
			foreach ($data as $post) :
			echo    '<tr>
						<td>' . $post["fd_id"] . '</td>
						<td>' . $post["fd_descricao"] . '</td>
						<td>
							<div class="btn-group dropleft">
								<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opções
								</button>
								<div class="dropdown-menu">
									<a href="'.base_url('Transporte/FornecedorNovoController/baixarDocumentosEmpresa/'.$post["fd_documento"]).'"  class="meuBancoGet dropdown-item"><i class="fas fa-cloud-download-alt"></i> Download</a>
								<div class="dropdown-divider"></div>
									<a href="javascript:void(0);" class="delDucumentoOne_ss dropdown-item" data-id="'.$post["fd_id"].'" data-iddoc="'.$post["fk_id_fornecedor"].'"><i class="fas fa-trash"></i> Deletar</a>
								</div>
							</div>
						</td>
						<td>
					</tr>';
			endforeach;
		endif;
	}

	/**download de arquivos documentos */
	public function baixarDocumentosEmpresa(string $arquivo)
	{
		$caminho = ROOTPATH . 'public/uploads/file_doc_fornnecedor/'; //equal writable/uploads/$arquivo
		return $this->response->download($caminho . $arquivo, null);
	}

	public function deleteDocOneEMpresa_ss()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new FornecedorDocumentosModel();
            $model->where('fd_id', $id)->delete();
            echo 'Documento deletado com sucesso';
        }
	}

	/**
	 * delete auxiliar empresa
	 */
	public function deleteEmpresaAuxiliar()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new FornecedorAuxiliarEmpresaRepresentanteModel();
            $model->where('faer_id', $id)->delete();
            echo 'Processo deletado com sucesso';
        }
	}

	/**
	 * consultar dados da empresa
	 */
	public function consultarEmpresa(int $id = null)
	{
		$page = 'ver-dados-da-empresa';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorempresaModel();
		$data = [
			'dd_empresa' => $model_fornecedor->where('ef_id', $id)->first(),
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/' . $page, $data);
	}

	/**
	 * consultar dados da empresa
	 */
	public function consultarRepresentante(int $id = null)
	{
		$page = 'ver-dados-do-representante';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$data = [
			'dd_representante' => $model_fornecedor->where('for_id', $id)->first(),
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor-novo/includes/' . $page, $data);
	}

	/**
	 * cadastro da empresa
	 */
	public function alteraCadastraEmpresa()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'empr_nome' => ['label' => 'nome', 'rules' => 'required|max_length[255]'],
			'enpr_cnae' => ['label' => 'cnae', 'rules' => 'min_length[2]|max_length[14]'],
			'enpr_classificacao_empresa' => ['label' => 'classificação da empresa', 'rules' => 'required'],
			'empre_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]'],
			'empr_incricao_estadual' => ['label' => 'incriççao estadual', 'rules' => 'max_length[50]'],
			'empr_incricao_municiapl' => ['label' => 'incrição municipal', 'rules' => 'max_length[50]'],
			'empr_cep' => ['label' => 'cep', 'rules' => 'required'],
			'empr_uf' => ['label' => 'uf', 'rules' => 'required|exact_length[2]'],
			'empr_cidade' => ['label' => 'cidade', 'rules' => 'required|max_length[50]'],
			'empr_bairro' => ['label' => 'bairro', 'rules' => 'required|max_length[80]'],
			'empr_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
			'empr_observacao' => ['label' => 'observações', 'rules' => 'required|max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorempresaModel();
			$query = $model->save([
				'ef_id' 					=> $this->request->getPost('id_empresa_cadastro'),
				'ef_razao_social'  			=> $this->request->getPost('empr_nome'),
				'ef_cnae'  					=> $this->request->getPost('enpr_cnae'),
				'ef_classificacao_empresa'  => $this->request->getPost('enpr_classificacao_empresa'),
				'ef_cnpj' 					=> $this->request->getPost('empre_cnpj'),
				'ef_incricao_estadual' 		=> $this->request->getPost('empr_incricao_estadual'),
				'ef_incricao_municial' 		=> $this->request->getPost('empr_incricao_municiapl'),
				'ef_cep' 					=> $this->request->getPost('empr_cep'),
				'ef_uf' 					=> $this->request->getPost('empr_uf'),
				'ef_cidade' 				=> $this->request->getPost('empr_cidade'),
				'ef_bairro' 				=> $this->request->getPost('empr_bairro'),
				'ef_endereco' 				=> $this->request->getPost('empr_endereco'),
				'ef_description' 			=> $this->request->getPost('empr_observacao'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Empresa alterada com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A empresa não pode ser alterada, desculpe!']);
			}
		}
	}
/**
	 * cadastra representante
	 */

	public function cadastroAlterarRepresentante()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'fort_name' => ['label' => 'nome do fornecedor', 'rules' => 'required|max_length[100]'],
			'fort_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|valid_email'],
			'fort_telefone' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_telefone2' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_cpf' => [
				'label' => 'cpf', 'rules' => 'required|validaCpf|exact_length[14]',
				'errors' => [
					'validaCpf' => 'O cpf está com formato incorreto.'
				]
			],
			'fort_observacao' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorveiculosModel();
			$query = $model->save([
				'for_id'  			=> $this->request->getPost('id_representante_one'),
				'for_responsavel'  	=> $this->request->getPost('fort_name'),
				'for_email'  		=> strtolower($this->request->getPost('fort_email')),
				'for_telefone'  	=> $this->request->getPost('fort_telefone'),
				'for_telefone2'  	=> $this->request->getPost('fort_telefone2'),
				'for_cnpj'  		=> $this->request->getPost('fort_cpf'),
				'for_description'  	=> $this->request->getPost('fort_observacao'),
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Representante alterado com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A cadastro não pode ser alterado, desculpe!']);
			}
		}
	}

	public function consultaEmpresas()
	{
		$model = new FornecedorAuxiliarEmpresaRepresentanteModel();

		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTableConsulta())
				   ->setDefaultOrder("ef_id", "DESC")
				   ->setSearch(["ef_razao_social", "ef_cnpj"])
				   ->setOrder(["ef_id", "ef_razao_social", "ef_cnpj"])
				   ->setOutput(["ef_razao_social","ef_cnpj", $model->buttonConsulta()]);
		return $data_table->getDatatable();
	}

}
