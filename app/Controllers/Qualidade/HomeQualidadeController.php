<?php

namespace App\Controllers\Qualidade;

use App\Controllers\BaseController;
use App\Models\QualidadeCategoriaModel;
use App\Models\QualidadeDocumentosModel;
use App\Models\StoreQualidadeDocumentoModel;
use App\Models\ConsultasGeralModel;
use App\Models\AcessousuariosModel;
use App\Models\FuncionarioModel;


class HomeQualidadeController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "QUALIDADE") {
			echo 'Access denied';
			exit;
		}
	}

	public function index($page = 'home-qualidade')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		
		$categoria = new QualidadeCategoriaModel();
		$documentos = new QualidadeDocumentosModel;
		$store = new StoreQualidadeDocumentoModel();
		
		$data = [
			'lt_categoria' => $categoria->getCategoria(),
			'lt_doc' => $documentos->getDocumentos(),
			'lt_store' => $store->findAll(),
		]; 
		echo view('frentesObras/frenteQualidade/' . $page, $data);
	}

	public function categoriaDocuemnto($page = 'cadastra-categoria-documento')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/categoria/' . $page . '.php')) {
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$id = session()->get('id');
		$model_user = new ConsultasGeralModel();

		$data['user_dd'] = $model_user->listaDadosUsuario($id); // Capitalize the first letter
		echo view('frentesObras/frenteQualidade/layout/pages/categoria/' . $page, $data);
	}

	public function adicionacategoriaDocuemnto()
	{
		$model = new QualidadeCategoriaModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'descricao_categoria' => ['label' => 'tipo de fornecedor', 'rules' => 'required|is_unique[qualidadecategorias.ql_description]'],
			'id_de_quem_cadastra' => ['label' => 'ID', 'rules' => 'required']

		])) {
			$model->save([
				'ql_user_fk' 		=> $this->request->getPost('id_de_quem_cadastra'),
				'ql_description'  	=> $this->request->getPost('descricao_categoria'),
				
			]);
			session()->setFlashdata('success_cat', 'Registro cadastrado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}

	/**visualizar categoria */
	public function vertegoriaDocuemnto(int $id)
	{
		$page = 'altera-categoria-documento';
		$model = new QualidadeCategoriaModel();
		$data['news'] = $model->getCategoria($id);
		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('A categoria não foi encontrada com esse id: ' . $id);
		}

		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/categoria/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['dd_categoria'] = $model->getCategoria($id);
		echo view('frentesObras/frenteQualidade/layout/pages/categoria/' . $page, $data);
	}

	/**alterar  categoria */
	public function alterarCategoriaDocuemnto(int $id)
	{
		$model = new QualidadeCategoriaModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'descricao_categoria' => ['label' => 'tipo de fornecedor', 'rules' => 'required|is_unique[qualidadecategorias.ql_description]',
            'errors' => [
                'required' => 'O campo {field} deve ser fornecido algum valor',
                'is_unique' => 'O campo {field} deve conter algum valor novo para ser conclído o processo de alteração.',
            ]],
			'id_de_quem_cadastra' => ['label' => 'ID', 'rules' => 'required']

		])) {
			$model->save([
				'ql_id' 		=> $id,
				'ql_user_fk' 		=> $this->request->getPost('id_de_quem_cadastra'),
				'ql_description'  	=> $this->request->getPost('descricao_categoria'),
				
			]);
			session()->setFlashdata('success_alterar_cat', 'Registro alterado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}

	public function deleteCategoria($id)
    {
        $model = new QualidadeCategoriaModel();
        $model->where('ql_id', $id)->delete();
        session()->setFlashdata('success_delete_cat', 'Registro deletado com sucesso.');
		return redirect()->back();
    }

	/**cadastro de documentos */
	public function cadastroDocumento($page = 'cadastra-documento')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/categoria/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$model = new QualidadeCategoriaModel;
		$data = ['list_categoria' => $model->findAll()]; // Capitalize the first letter
		echo view('frentesObras/frenteQualidade/layout/pages/categoria/' . $page, $data);
	}

	/**adiciona documentos qualidade */
	public function adicionaDocuemnto()
	{
		$model = new QualidadeDocumentosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'doc_descricao' => ['label' => 'descrição do documento', 'rules' => 'required'],
			'doc_categoria' => ['label' => 'categoria do documento', 'rules' => 'required'],
			'doc_revisao' => ['label' => 'nº da revisão', 'rules' => 'required|integer|max_length[5]'],
			'doc_nacontratacao' => ['label' => 'na contratação', 'rules' => 'required|max_length[5]'],
			'doc_periodicidade' => ['label' => 'periodicidade', 'rules' => 'required|max_length[100]'],

		])) {
			$model->save([
				'qld_fk_categoria' 		=> $this->request->getPost('doc_categoria'),
				'qld_fk_usuario'  		=> $this->request->getPost('id_de_quem_cadastra_doc'),
				'qld_contratacao'  		=> $this->request->getPost('doc_nacontratacao'),
				'qld_periodicamente'  	=> $this->request->getPost('doc_periodicidade'),
				'qld_versao'  			=> $this->request->getPost('doc_revisao'),
				'qld_description'  		=> $this->request->getPost('doc_descricao'),
				
			]);
			session()->setFlashdata('success_doc_cadastro', 'Registro cadastrado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}

	public function verDocumento(int $id)
	{
		$page = 'visualiza-documento';
		$model = new QualidadeCategoriaModel();
		$documento =  new QualidadeDocumentosModel();
		$data['news'] = $documento->getDocumentos($id);
		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O documento não foi encontrada com esse id: ' . $id);
		}

		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/categoria/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['list_categoria'] = $model->findAll();
		$data['dd_doc'] = $documento->getDocumentos($id);
		echo view('frentesObras/frenteQualidade/layout/pages/categoria/' . $page, $data);
	}

	public function alteraPageDocumento(int $id)
	{
		$page = 'alterar-documento';
		$model = new QualidadeCategoriaModel();
		$documento =  new QualidadeDocumentosModel();
		$data['news'] = $documento->getDocumentos($id);
		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O documento não foi encontrada com esse id: ' . $id);
		}

		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/categoria/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data['list_categoria'] = $model->findAll();
		$data['dd_doc'] = $documento->getDocumentos($id);
		echo view('frentesObras/frenteQualidade/layout/pages/categoria/' . $page, $data);
	}

	
	/**adiciona documentos qualidade */
	public function alteraDocuemnto(int $id)
	{
		$model = new QualidadeDocumentosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'qld_description' => ['label' => 'descrição do documento', 'rules' => 'required|is_unique[qualidadedocumentos.qld_description]',
            'errors' => [
                'is_unique' => 'É necessário fazer uma alteração para concluí o processo de revisão.'
            ]],
			'doc_categoria' => ['label' => 'categoria do documento', 'rules' => 'required'],
			'qld_versao' => ['label' => 'nº da revisão', 'rules' => 'required|integer|max_length[5]|validateQuantidade[id_documento,qld_versao]',
            'errors' => [
                'validateQuantidade' => 'Ops! A versão não pode ser igual ou menor que a versão atual .'
            ]],
			'qld_periodicamente' => ['label' => 'perioticidade', 'rules' => 'required|max_length[100]'],
			'qld_contratacao' => ['label' => 'Nº da contratação', 'rules' => 'required|max_length[100]'],
			'porquemuda' => ['label' => 'periodicidade', 'rules' => 'required|max_length[250]',
            'errors' => [
                'required' => 'Ops! Forneça uma justificativa para essa mudança.',
                'max_length' => 'Você ultrapassou o limite de caracteres que é de 255.',
            ]],

		])) {
			$model->save([
				'qld_id' 				=> $id,
				'qld_fk_categoria' 		=> $this->request->getPost('doc_categoria'),
				'qld_fk_usuario'  		=> $this->request->getPost('id_de_quem_altera'),
				'qld_contratacao'  		=> $this->request->getPost('qld_contratacao'),
				'qld_periodicamente'  	=> $this->request->getPost('qld_periodicamente'),
				'qld_description'  		=> $this->request->getPost('qld_description'),
				'qld_justifica'  		=> $this->request->getPost('porquemuda'),
				
			]);
			$numero_revisão = $this->request->getVar('qld_versao');
			
			$this->alteraValorRevisão($numero_revisão);

			$st_descricao = $this->request->getVar('descricao');
			$st_versao = $this->request->getVar('versao');
			$id_preocesso = $this->request->getVar('id_processo');
			$ultima_mudanca = $this->request->getVar('ultima_mudanca');
			$justificativa_anterior = $this->request->getVar('justificativa_anterior');

			$this->atualizaAlteracaoDocumento($st_descricao,$st_versao,$id_preocesso,$ultima_mudanca,$justificativa_anterior);
			
			session()->setFlashdata('success_doc_cadastro', 'Registro alterado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}

	/**altera cadastro documento */
	public function alteraValorRevisão($numero_revisão)
	{
		$model = new QualidadeDocumentosModel();
		$model->set('qld_versao', $numero_revisão);
		return $model->update();
	}

	/**deleta documento */
	public function deletaDocumento(int $id)
	{
		$documento =  new QualidadeDocumentosModel();
		$data['news'] = $documento->getDocumentos($id);
		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('O documento não foi encontrada com esse id: ' . $id);
		}
		$documento->delete(['qld_id' => $id]);
		session()->setFlashdata('delete_doc_cadastro', 'Registro deletado com sucesso.');
		return redirect()->back();
	}

	public function atualizaAlteracaoDocumento($st_descricao,$st_versao,$id_preocesso,$ultima_mudanca,$justificativa_anterior)
	{
		$model = new StoreQualidadeDocumentoModel();
		return $model->save([
			'st_origem' 		=> $id_preocesso,
			'st_descricao' 		=> $st_descricao,
			'st_data'  			=> $ultima_mudanca,
			'st_justificativa'  => $justificativa_anterior,
			'st_versao'  		=> $st_versao,
		]);
	}

	/**pagina de perfil de acesso */
	public function meuPerfil($page = 'perfil-acesso')
	{

		if (!is_file(APPPATH . '/Views/frentesObras/frenteQualidade/layout/pages/perfil/'.$page.'.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$id = session()->get('id');

		$model_user = new ConsultasGeralModel();
		$data['user_dd'] = $model_user->listaDadosUsuario($id); // Capitalize the first letter
		echo view('frentesObras/frenteQualidade/layout/pages/perfil/'.$page, $data);
	}

	public function alteraFoto(int $id)
	{
		if ($this->request->getMethod() !== 'post') {
			return redirect()->back();
		}

		$validated = $this->validate([
			'avatar' => [
				'uploaded[avatar]',
				'mime_in[avatar,image/jpg,image/jpeg,image/gif,image/png]',
				'max_size[avatar,4096]',
			],
		]);

		if ($validated) {
			$avatar = $this->request->getFile('avatar');
			$nova_nome = $avatar->getRandomName($avatar);

			$avatar->move(ROOTPATH . 'public/uploads/perfil', $nova_nome);
			$model = new AcessousuariosModel();

			$model->save([
				'au_id' => $id,
				'au_foto'  => $avatar->getName()
			]);

			session()->setFlashdata('success_imagem_ok', 'Imagem adicionada com sucesso.');
			return redirect()->back();
		}
		session()->setFlashdata('failed_imagem_error', 'Ops, erro ao subir a imagem. Use os formatos jpg, png, gif, jpeg e 4096 de tamanho.');
		return redirect()->back()->withInput();
	}

	public function atualizaLoginESenha()
	{
		$model = new AcessousuariosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'usr_email' => ['label' => 'descrição do documento', 'rules' => 'required|min_length[6]|max_length[50]|valid_email'],
			'urs_pw' => ['label' => 'Senha', 'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/]',
			'errors' => [
				'required' => 'Ops! Digite uma senha.',
				'regex_match' => 'Ops! Senha fora do padrão. Deve conter de 8 a 15 caracteres com números, letras maiúscas minúscula.',
			]],

		])) {
			$model->save([
				'au_id' 		=> $this->request->getPost('urs_usuario'),
				'au_login_corp'  		=> $this->request->getPost('usr_email'),
				'au_passwword'  		=> password_hash($this->request->getPost('urs_pw'), PASSWORD_DEFAULT),
				
			]);
			session()->setFlashdata('success_atualiz_perfil_user', 'Registro alterado com sucesso.');
			return redirect()->back();
		} else {
			return redirect()->back()->withInput();
		}
	}
}
