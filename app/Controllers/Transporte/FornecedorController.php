<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;
use App\Database\Migrations\FornecedorDocumentosEmpresarial;
use App\Models\FornecedorveiculosModel;
use monken\TablesIgniter;
use App\Models\FornecedorContaModel;
use App\Models\FornecedorDocumentosModel;
use App\Models\FornecedorempresaModel;
use CodeIgniter\HTTP\RequestInterface;

class FornecedorController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "TRANSPORTE") {
			echo view('/');
			exit;
		}
	}

	public function index($page = 'Home-Fornecedor')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/' . $page);
	}

	/**visualiza dados do fornecedor */
	public function dadosFornecedor(int $id = null)
	{
		$page = 'visualizar-fornecedor';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$data = [
			'dd_fornecedor' => $model_fornecedor->where('for_id', $id)->first()
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page, $data);
	}

	/**contas do fornecedor */
	public function contasFornecedor(int $id)
	{
		$page = 'contas-fornecedor';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$model_conta = new FornecedorContaModel();
		$data = [
			'dd_fornecedor' => $model_fornecedor->where('for_id', $id)->first(),
			'list_contas' => $model_conta->where('cbf_fornecedor_fk', $id)->findAll()
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page, $data);
	}

	/**visualiza dados do fornecedor */
	public function documentosFornecedor(int $id = null)
	{
		$page = 'documentos-fornecedor';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$model_docs_fornecedor = new FornecedorDocumentosModel();
		$data = [
			'dd_fornecedor' => $model_fornecedor->where('for_id', $id)->first(),
			'list_docs' => $model_docs_fornecedor->where('fk_id_fornecedor', $id)->findAll(),
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page, $data);
	}

	/**visualiza empresas do fornecedor */
	public function empresasFornecedor(int $id = null)
	{
		$page = 'empresas-fornecedor';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$model_docs_fornecedor = new FornecedorDocumentosModel();
		$data = [
			'dd_fornecedor' => $model_fornecedor->where('for_id', $id)->first(),
			'list_docs' => $model_docs_fornecedor->where('fk_id_fornecedor', $id)->findAll(),
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/page-fornecedor/' . $page, $data);
	}


	/**visualiza contratos do fornecedor */
	public function contratosFornecedor(int $id = null)
	{
		$page = 'empresa-documentos';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteTransportes/layout/pages/fornecedor/includes/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_fornecedor = new FornecedorveiculosModel();
		$model_docs_fornecedor = new FornecedorDocumentosModel();
		$data = [
			'dd_fornecedor' => $model_fornecedor->where('for_id', $id)->first(),
			'list_docs' => $model_docs_fornecedor->where('fk_id_fornecedor', $id)->findAll(),
		]; 

		return view('frentesObras/frenteTransportes/layout/pages/fornecedor/includes/' . $page, $data);
	}

	/**
	 * =============================================================================================
	 */


	public function cadstroFornecedor()
	{
		$model = new FornecedorveiculosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'fort_name' => ['label' => 'nome do fornecedor', 'rules' => 'required|max_length[100]|is_unique[fornecedorveiculos.for_responsavel]'],
			'fort_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|valid_email|is_unique[fornecedorveiculos.for_email]'],
			'fort_telefone' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_cpf' => ['label' => 'cpf', 'rules' => 'required|exact_length[14]'],
			'fort_cep' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
			'fort_uf' => ['label' => 'estado', 'rules' => 'required|exact_length[2]'],
			'fort_cidade' => ['label' => 'cidade', 'rules' => 'required|max_length[100]'],
			'fort_bairro' => ['label' => 'bairro', 'rules' => 'required|max_length[100]'],
			'fort_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
			'fort_observacao' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
			'fort_obra' => ['label' => 'obra', 'rules' => 'required'],
			'fort_frente' => ['label' => 'frente', 'rules' => 'required'],
			'fort_usuario' => ['label' => 'usuário', 'rules' => 'required'],
		])) {
			$model->save([
				'for_fk_obra' => $this->request->getPost('fort_obra'),
				'for_fk_frente'  => $this->request->getPost('fort_frente'),
				'for_fk_usuario'  => $this->request->getPost('fort_usuario'),
				'for_responsavel'  => $this->request->getPost('fort_name'),
				'for_email'  => strtotime($this->request->getPost('fort_email')),
				'for_telefone'  => $this->request->getPost('fort_telefone'),
				'for_cnpj'  => $this->request->getPost('fort_cpf'),
				'for_cep'  => $this->request->getPost('fort_cep'),
				'for_uf'  => $this->request->getPost('fort_uf'),
				'for_cidade'  => $this->request->getPost('fort_cidade'),
				'for_bairro'  => $this->request->getPost('fort_bairro'),
				'for_endereco'  => $this->request->getPost('fort_endereco'),
				'for_description'  => $this->request->getPost('fort_observacao'),
			]);

			$session = session();
			$session->setFlashdata("fornecedor_success", "Fornecedor criado com sucesso!");
			return redirect()->back();
		} else {
			$session = session();
			$session->setFlashdata("fornecedor_error_cadastro", "Existem alguns campos com error, verifique no formulário e corrija por favor!");
			return redirect()->back()->withInput();
		}
	}

	/**altera dados do foenecedor */
	public function cadstroAlteraFornecedor(int $id)
	{
		$model = new FornecedorveiculosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'fort_name' => ['label' => 'nome do fornecedor', 'rules' => 'required|max_length[100]'],
			'for_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|valid_email'],
			'fort_telefone' => ['label' => 'telefone', 'rules' => 'required|max_length[20]'],
			'fort_cpf' => ['label' => 'cpf', 'rules' => 'required|exact_length[14]'],
			'fort_cep' => ['label' => 'cep', 'rules' => 'required|exact_length[10]'],
			'fort_uf' => ['label' => 'estado', 'rules' => 'required|exact_length[2]'],
			'fort_cidade' => ['label' => 'cidade', 'rules' => 'required|max_length[100]'],
			'fort_bairro' => ['label' => 'bairro', 'rules' => 'required|max_length[100]'],
			'fort_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
			'fort_observacao' => ['label' => 'observação', 'rules' => 'required|max_length[500]'],
			'fort_obra' => ['label' => 'obra', 'rules' => 'required'],
			'fort_frente' => ['label' => 'frente', 'rules' => 'required'],
			'fort_usuario' => ['label' => 'usuário', 'rules' => 'required'],
		])) {
			$model->save([
				'for_id' => $id,
				'for_fk_obra' => $this->request->getPost('fort_obra'),
				'for_fk_frente'  => $this->request->getPost('fort_frente'),
				'for_fk_usuario'  => $this->request->getPost('fort_usuario'),
				'for_responsavel'  => $this->request->getPost('fort_name'),
				'for_email'  => $this->request->getPost('for_email'),
				'for_telefone'  => $this->request->getPost('fort_telefone'),
				'for_cnpj'  => $this->request->getPost('fort_cpf'),
				'for_cep'  => $this->request->getPost('fort_cep'),
				'for_uf'  => $this->request->getPost('fort_uf'),
				'for_cidade'  => $this->request->getPost('fort_cidade'),
				'for_bairro'  => $this->request->getPost('fort_bairro'),
				'for_endereco'  => $this->request->getPost('fort_endereco'),
				'for_description'  => $this->request->getPost('fort_observacao'),
			]);

			$session = session();
			$session->setFlashdata("fornecedor_update_success", "Fornecedor alterado com sucesso!");
			return redirect()->back();
		} else {
			$session = session();
			$session->setFlashdata("fornecedor_update_error_cadastro", "Existem alguns campos com error para ser processado a alteração, verifique no formulário e corrija por favor!");
			return redirect()->back()->withInput();
		}
	}
	/**lista fornecedor ajax */
	public function listaFornecedorAjax()
	{
		
		$model = new FornecedorveiculosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable())
				   ->setDefaultOrder("for_responsavel", "DESC")
				   ->setSearch(["for_responsavel", "for_telefone", "for_email", "for_cidade"])
				   ->setOrder(["for_responsavel", "for_telefone", "for_email", "for_cidade"])
				   ->setOutput(["for_responsavel", "for_telefone", "for_email", "for_cidade", $model->button()]);
		return $data_table->getDatatable();
	}

	/**cadastra conta bancaria */

	/**altera dados do foenecedor */
	public function cadastroContaFornecedor()
	{
		$model = new FornecedorContaModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'fornecedor_banco' => ['label' => 'banco', 'rules' => 'required|max_length[50]'],
			'fb_tipo_conta' => ['label' => 'tipo de conta', 'rules' => 'required'],
			'fb_agencia' => ['label' => 'agencia', 'rules' => 'required|integer|min_length[2]|max_length[20]'],
			'fb_numero_conta' => ['label' => 'nº da conta', 'rules' => 'required|integer|min_length[2]|max_length[14]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'fb_digito_agencia' => ['label' => 'dígito da conta', 'rules' => 'required|integer|min_length[2]|max_length[5]'],
			'fb_observacao' => ['label' => 'observações da conta', 'rules' => 'required'],
		])) {
			$model->save([
				'cbf_fornecedor_fk' 	=> $this->request->getPost('fb_id_fornecedor'),
				'cbf_obra_fk'  			=> $this->request->getPost('fb_obra'),
				'cbf_frente_fk'  		=> $this->request->getPost('fb_frente'),
				'cbf_banco'  			=> $this->request->getPost('fornecedor_banco'),
				'cbf_tipo_conta'  		=> $this->request->getPost('fb_tipo_conta'),
				'cbf_agencia'  			=> $this->request->getPost('fb_agencia'),
				'cbf_numero_conta'  	=> $this->request->getPost('fb_numero_conta'),
				'cbf_digito_conta'  	=> $this->request->getPost('fb_digito_agencia'),
				'cbf_Observacoes_conta' => $this->request->getPost('fb_observacao'),
			]);

			$session = session();
			$session->setFlashdata("fornecedor_conta_add_success", "Conta adicionada com sucesso!");
			return redirect()->back();
		} else {
			$session = session();
			$session->setFlashdata("fornecedor_add_conta_error_cadastro", "Existem alguns campos com error para ser processado o salvamento dos dados fonrnecidos, verifique no formulário e corrija por favor!");
			return redirect()->back()->withInput();
		}
	}

	/**lista dados do banco no modal */
	public function getDadosBancoModal()
	{
		if($this->request->getVar('id_c'))
        {
            $model_conta = new FornecedorContaModel();
            $user_data = $model_conta->where('cbf_id', $this->request->getVar('id_c'))->first();
            echo json_encode($user_data);
        }
	}

	/**alterar configuração */
	public function alteraContaFornecedor()
	{
		$model = new FornecedorContaModel();
		$validation =  \Config\Services::validation();
		$this->validate([
			'up_banco_for' => ['label' => 'banco', 'rules' => 'required|max_length[50]'],
			'cbf_tipo_conta' => ['label' => 'tipo de conta', 'rules' => 'required'],
			'up_agencia_for' => ['label' => 'agencia', 'rules' => 'required|integer|min_length[2]|max_length[20]'],
			'up_numconta_for' => ['label' => 'nº da conta', 'rules' => 'required|integer|min_length[2]|max_length[14]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'up_digito_for' => ['label' => 'dígito da conta', 'rules' => 'required|integer|min_length[2]|max_length[5]'],
			'up_observacao_for' => ['label' => 'observações da conta', 'rules' => 'required'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$query = $model->save([
				'isc_id' 				=> $this->request->getPost('hidden_id_banco'),
				'cbf_banco'  			=> $this->request->getPost('up_banco_for'),
				'cbf_tipo_conta'  		=> $this->request->getPost('cbf_tipo_conta'),
				'cbf_agencia'  			=> $this->request->getPost('up_agencia_for'),
				'cbf_numero_conta'  	=> $this->request->getPost('up_numconta_for'),
				'cbf_digito_conta'  	=> $this->request->getPost('up_digito_for'),
				'cbf_Observacoes_conta' => $this->request->getPost('up_observacao_for'),
			]);

			if ($query) {
				echo json_encode(['code'=> 1, 'msg'=>'Banco alterado com sucesso!']);
			} else {
				echo json_encode(['code'=> 0, 'msg'=>'Bnanco não pode ser alterado!']);
			}
		}
	}

	/**deleta conta do fornecedor */
	public function deleteContaFornecedor()
	{
		if($this->request->getVar('id_del_conta'))
        {
            $id = $this->request->getVar('id_del_conta');
            $model = new FornecedorContaModel();
            $model->where('cbf_id', $id)->delete($id);
            echo 'Conta deletada com sucesso!';
        }
	}

	public function cadastroDocuemntosFornecedor()
	{
		if ($this->request->getMethod() == "post") {

			$rules = [
				"doc_descricao_fornecedor" => [
					"rules" =>"required|max_length[500]",
					"label" => "Descrição"
				],
				"doc_file_fornecedor" => [
					"rules" => "uploaded[doc_file_fornecedor]|max_size[doc_file_fornecedor,1024]|ext_in[doc_file_fornecedor,png,jpg,pdf]",
					"label" => "Documento",
				],
			];

			if (!$this->validate($rules)) {
				  return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
			} else {

				$file = $this->request->getFile("doc_file_fornecedor");

				$session = session();
				$newName = $file->getRandomName();

				if ($file) {
					$file->move("uploads/file_doc_fornnecedor", $newName);
					$model = new FornecedorDocumentosModel();

					$data = [
						"fk_id_fornecedor" => $this->request->getVar("doc_id_fornecedor"),
						"fk_id_operador" => $this->request->getVar("operador_usuario"),
						"fd_descricao" => $this->request->getVar("doc_descricao_fornecedor"),
						'fd_documento' =>  $newName,
						
					];

					if ($model->insert($data)) {
						$session->setFlashdata("success_uploaded_doc_fornecedor", "Arquivo adicionado com sucesso!");
					} else {
						$session->setFlashdata("error_uploaded_doc_fornecedor", "Falha ao subir arquivo.");
					}
				}
			}
			return redirect()->back();
		}
		return redirect()->back();
	}

	/**download de arquivos documentos */
	public function baixarDocumentosFornecedor(string $arquivo)
	{
		$caminho = ROOTPATH . 'public/uploads/file_doc_fornnecedor/'; //equal writable/uploads/$arquivo
		return $this->response->download($caminho . $arquivo, null);
	}

	public function deletaDocumentosFornecedor(int $id)
	{
		$session = session();
		$builder = new FornecedorDocumentosModel();
		$builder->delete(['fd_id' => $id]);
		$session->setFlashdata("delete_file", "Arquivo deletado com sucesso!");
		return redirect()->back();
	}

	/**
	 * cadastro da empresa
	 */
	public function cadastraEmpresaDoFornecedor()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'empr_nome' => ['label' => 'nome', 'rules' => 'required|max_length[255]'],
			'empr_topo_de_dono' => ['label' => 'classificação de propriédade', 'rules' => 'required'],
			'empr_socio_dono' => ['label' => 'nome do propriétário/dono', 'rules' => 'required|min_length[2]|max_length[20]'],
			'enpr_cnae' => ['label' => 'cnae', 'rules' => 'required|min_length[2]|max_length[14]'],
			'enpr_classificacao_empresa' => ['label' => 'classificação da empresa', 'rules' => 'required'],
			'empre_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'empr_incricao_estadual' => ['label' => 'incriççao estadual', 'rules' => 'required|max_length[50]'],
			'empr_incricao_municiapl' => ['label' => 'incrição municipal', 'rules' => 'required|max_length[50]'],
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
				'ef_fk_fornecedor'  		=> $this->request->getPost('id_fornecedor'),
				'ef_razao_social'  			=> $this->request->getPost('empr_nome'),
				'ef_tipo_dono'  			=> $this->request->getPost('empr_topo_de_dono'),
				'ef_nome_dono'  			=> $this->request->getPost('empr_socio_dono'),
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
				echo json_encode(['code'=> 1, 'msg'=>'Empresa adicionada com sucesso!']);
			} else {
				echo json_encode(['code'=> 0, 'msg'=>'A empresa não pode ser criada, desculpe!']);
			}
		}
	}

	/**lista fornecedor ajax */
	public function listaEmpresaFornecedorAjax()
	{
		$model = new FornecedorempresaModel();
		$data_table = new TablesIgniter();
		if ($this->request->getVar('id_fornecedor')) {
			$id = $this->request->getVar('id_fornecedor');
			$data_table->setTable($model->noticeTable($id))
				->setDefaultOrder("created_at", "DESC")
				->setSearch(["created_at","ef_razao_social", "ef_cnpj", "ef_uf", "ef_cidade"])
				->setOrder(["created_at","ef_razao_social", "ef_cnpj", "ef_uf", "ef_cidade"])
				->setOutput(["created_at","ef_razao_social", "ef_cnpj", "ef_uf", "ef_cidade", $model->button()]);
			return $data_table->getDatatable();
		}
	}

	/**lista dados do fornecedor empresa */
	public function getDadosEmpresaFornecedor()
	{
		if($this->request->getVar('id_emp_forn'))
        {
            $model = new FornecedorempresaModel();
            $user_data = $model->where('ef_id', $this->request->getVar('id_emp_forn'))->first();
            echo json_encode($user_data);
        }
	}

	public function alteraEmpresaDoFornecedor()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'ef_razao_social' => ['label' => 'nome', 'rules' => 'required|max_length[255]'],
			'ef_tipo_dono' => ['label' => 'classificação de propriédade', 'rules' => 'required'],
			'ef_nome_dono' => ['label' => 'nome do propriétário/dono', 'rules' => 'required|min_length[2]|max_length[100]'],
			'ef_cnae' => ['label' => 'cnae', 'rules' => 'required|min_length[2]|max_length[14]'],
			'ef_classificacao_empresa' => ['label' => 'classificação da empresa', 'rules' => 'required'],
			'ef_cnpj' => ['label' => 'cnpj', 'rules' => 'required|exact_length[18]|is_unique[fornecedor_conta_bancaria.cbf_numero_conta]'],
			'ef_incricao_estadual' => ['label' => 'incriççao estadual', 'rules' => 'required|max_length[50]'],
			'ef_incricao_municial' => ['label' => 'incrição municipal', 'rules' => 'required|max_length[50]'],
			'ef_cep' => ['label' => 'cep', 'rules' => 'required'],
			'ef_uf' => ['label' => 'uf', 'rules' => 'required|exact_length[2]'],
			'ef_cidade' => ['label' => 'cidade', 'rules' => 'required|max_length[50]'],
			'ef_bairro' => ['label' => 'bairro', 'rules' => 'required|max_length[80]'],
			'ef_endereco' => ['label' => 'endereço', 'rules' => 'required|max_length[100]'],
			'ef_description' => ['label' => 'observações', 'rules' => 'required|max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new FornecedorempresaModel();
			$query = $model->save([
				'ef_id' 					=> $this->request->getPost('id_empresa'),
				'ef_fk_quem_cadastrou' 		=> $this->request->getPost('id_de_quen_cadastrou'),
				'ef_razao_social'  			=> $this->request->getPost('ef_razao_social'),
				'ef_tipo_dono'  			=> $this->request->getPost('ef_tipo_dono'),
				'ef_nome_dono'  			=> $this->request->getPost('ef_nome_dono'),
				'ef_cnae'  					=> $this->request->getPost('ef_cnae'),
				'ef_classificacao_empresa'  => $this->request->getPost('ef_classificacao_empresa'),
				'ef_cnpj' 					=> $this->request->getPost('ef_cnpj'),
				'ef_incricao_estadual' 		=> $this->request->getPost('ef_incricao_estadual'),
				'ef_incricao_municial' 		=> $this->request->getPost('ef_incricao_municial'),
				'ef_cep' 					=> $this->request->getPost('ef_cep'),
				'ef_uf' 					=> $this->request->getPost('ef_uf'),
				'ef_cidade' 				=> $this->request->getPost('ef_cidade'),
				'ef_bairro' 				=> $this->request->getPost('ef_bairro'),
				'ef_endereco' 				=> $this->request->getPost('ef_endereco'),
				'ef_description' 			=> $this->request->getPost('ef_description'),
			]);

			if ($query) {
				echo json_encode(['code'=> 1, 'msg'=>'Empresa alterada com sucesso!']);
			} else {
				echo json_encode(['code'=> 0, 'msg'=>'A empresa não pode ser alterada, desculpe!']);
			}
		}
	}

	/**delete empresa do fornecedor */
	public function deleteEmpresaFornecedor()
	{
		if($this->request->getVar('id_emp_for'))
        {
            $id = $this->request->getVar('id_emp_for');
            $crudModel = new FornecedorempresaModel();
            $crudModel->where('ef_id', $id)->delete();
            echo 'Empresa deletada com sucesso!';
        }
	}

	/**
	 * salva documentos da empresa
	 */
	public function ajaxSearch()
    {  
		$data = [];
        $builder = new FornecedorempresaModel();
		$query = $builder->like('ef_razao_social', $this->request->getVar('term'))
		->select('ef_id, ef_razao_social')
		->limit(10)->get();
		$data = $query->getResult();
		echo json_encode($data);
    }

	public function consultaEmpresa()
    {  
		if (!$this->request->isAJAX()) {
			exit('Página não encontrada');
		}
		$builder = new FornecedorempresaModel();
		$empresa = $builder->pesquisarEmpresa($this->request->getGet('term'));
		$retorno = [];

		foreach ($empresa as $key) {
			$data['id'] = $key->ef_fk_fornecedor;
			$data['value'] = $key->ef_razao_social;
			$retorno[] = $data;
		}
		return $this->response->setJSON($retorno);
    }
}
