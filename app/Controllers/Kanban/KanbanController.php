<?php

namespace App\Controllers\Kanban;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;
use App\Models\KanbanProjetoModel;
use App\Models\KanbanHistoreProjetoModel;
use App\Models\BacklogModel;
use App\Models\KanbanAtividadesBacklog;
use App\Models\KanbanHomologacaoModel;
use App\Models\KanbanToFazendoModel;
use App\Models\KanbanConcluidoModel;


class KanbanController extends BaseController
{
	public function __construct()
    {
		
        if (session()->get('role') != "KANBAN") {
            echo 'Accesso negado!';
            exit;
        }
    }

	public function index($page = 'home-kanban')
	{
		if (!is_file(APPPATH . '/Views/kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$id = session()->get('id');
		$model_user = new ConsultasGeralModel();
		$m_projeto = new KanbanProjetoModel();
		$data = [
			'title' => $model_user->listaDadosUsuario($id),
			'listProjetos' => $m_projeto->findAll()
		];
		return view('kanban/' . $page, $data);
	}

	/**pagina de cadasto do projeto */
	public function pageProjeto($page = 'projeto-kanban')
	{
		if (!is_file(APPPATH . '/Views/kanban/pages/kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$id = session()->get('id');
		$model_user = new ConsultasGeralModel();
		$m_projeto = new KanbanProjetoModel();
		$data = [
			'title' => $model_user->listaDadosUsuario($id),
			'listProjetos' => $m_projeto->findAll()
		];
		return view('kanban/pages/kanban/' . $page, $data);
	}

	public function salvaProjeto()
	{
		
		$model = new KanbanProjetoModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'kan_pro_nome' => ['label' => 'nome do projeto', 'rules' => 'required|max_length[30]|is_unique[kanban_projeto.kbp_nome_projeto]'],
			'kan_pro_data_inicial' => ['label' => 'data inicial', 'rules' => 'required|valid_date'],
			'kan_pro_data_final' => ['label' => 'data final', 'rules' => 'required|valid_date'],
			'kan_pro_descricao' => ['label' => 'descrição do projeto', 'rules' => 'required'],
			]))
		{
			$model->save([
				'kbp_fk_usuario' 		=> $this->request->getPost('id_usuario_kanban'),
				'kbp_nome_projeto'  	=> $this->request->getPost('kan_pro_nome'),
				'kbp_data_inicial'  	=> $this->request->getPost('kan_pro_data_inicial'),
				'kbp_data_final'  		=> $this->request->getPost('kan_pro_data_final'),
				'kbp_detalhes_projeto'  => $this->request->getPost('kan_pro_descricao'),
			]);
			$this->emailCrarProjeto();
			session()->setFlashdata('success_proj', 'Projeto cadastrado com sucesso.');
			return redirect()->back();
		}
		else
		{
			session()->setFlashdata('error_proj', 'Existem erros no cadastro, verifique por favor.');
			return redirect()->back()->withInput();
		}
	}

	

	public function verProjeto(int $id)
	{
		$m_projeto = new KanbanProjetoModel();
		$data['news'] = $m_projeto->getProject($id);
		if (empty($data['news']))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Esse item não foi encontrado para essa consultas: '. $id);
		}
		
		$page = 'visualiza-projeto-kanban';
		if (!is_file(APPPATH . '/Views/kanban/pages/kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$id_c = session()->get('id');
		$model_user = new ConsultasGeralModel();
		$model_backlog = new BacklogModel();
		
		$data = [
			'title' => $model_user->listaDadosUsuario($id_c),
			'listProjetos' => $m_projeto->findAll(),
			'ddProjetos' => $m_projeto->where('kbp_id', $id)->first(),
			'list_backlog' => $model_backlog->where('bl_fk_projeto', $id)->findAll(),
		];
		return view('kanban/pages/kanban/' . $page, $data);
	}

	/**alterar projeto */
	public function alterarProjeto(int $id)
	{
		
		$model = new KanbanProjetoModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'kan_pro_nome' => ['label' => 'nome do projeto', 'rules' => 'required|max_length[30]'],
			'kan_pro_controle_versao' => ['label' => 'justificativa da mudança', 'rules' => 'required|max_length[30]'],
			'kan_pro_data_inicial' => ['label' => 'data inicial', 'rules' => 'required|valid_date'],
			'kan_pro_data_final' => ['label' => 'data final', 'rules' => 'required|valid_date'],
			'kan_pro_status' => ['label' => 'data final', 'rules' => 'required'],
			'kan_pro_descricao' => ['label' => 'descrição do projeto', 'rules' => 'required'],
			]))
		{
			$model->save([
				'kbp_id' 				=> $id,
				'kbp_fk_usuario' 		=> $this->request->getPost('id_usuario_kanban'),
				'kbp_nome_projeto'  	=> $this->request->getPost('kan_pro_nome'),
				'kbp_data_inicial'  	=> $this->request->getPost('kan_pro_data_inicial'),
				'kbp_data_final'  		=> $this->request->getPost('kan_pro_data_final'),
				'kbp_status'  		=> $this->request->getPost('kan_pro_status'),
				'kbp_detalhes_projeto'  => $this->request->getPost('kan_pro_descricao'),
			]);
			$id =  $id;
			$origin_name =  $this->request->getPost('origin_name');
			$origin_data_inicial =  $this->request->getPost('origin_data_inicial');
			$origin_data_final =  $this->request->getPost('origin_data_final');
			$origin_descricao =  $this->request->getPost('origin_descricao');
			$id_usuario_kanban =  $this->request->getPost('id_usuario_kanban');
			$kan_pro_controle_versao =  $this->request->getPost('kan_pro_controle_versao');
			$kan_pro_status =  $this->request->getPost('kan_pro_status');

			$this->kanbanHistoryProjeto($id,$origin_name,$origin_data_inicial,$origin_data_final,$origin_descricao,$id_usuario_kanban,$kan_pro_controle_versao,$kan_pro_status);
			session()->setFlashdata('success_proj_up', 'Projeto alterado com sucesso.');
			return redirect()->back();
		}
		else
		{
			session()->setFlashdata('error_proj_up', 'Existem erros no cadastro, verifique por favor.');
			return redirect()->back()->withInput();
		}
	}

	/**salva versão do projeto */
	public function kanbanHistoryProjeto($id,$origin_name,$origin_data_inicial,$origin_data_final,$origin_descricao,$id_usuario_kanban,$kan_pro_controle_versao,$kan_pro_status)
	{
		$model = new KanbanHistoreProjetoModel();
		$data = [
			'kb_histor_fk_usuario' 			=> $id_usuario_kanban,
			'kb_histor_fk_kanban'  			=> $id,
			'kb_histor_nome_projeto'  			=> $origin_name,
			'kb_histor_data_inicial'  			=> $origin_data_inicial,
			'kb_histor_data_final'  			=> $origin_data_final,
			'kb_histor_status'  				=> $kan_pro_status,
			'kb_histor_detalhes_projeto'  		=> $origin_descricao,
			'kb_histor_justificativa_mudanca'  	=> $kan_pro_controle_versao,
		];
		return $model->insert($data);
	}

	/** visualiza projeto kanban */
	public function verKanbanProjeto(int $id)
	{
		
		$m_projeto = new KanbanProjetoModel();
		$m_projeto->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$data['news'] = $m_projeto->getProject($id);
		if (empty($data['news']))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Esse item não foi encontrado para essa consultas: '. $id);
		}
		
		$page = 'atividade-kanban';
		if (!is_file(APPPATH . '/Views/kanban/pages/etapas-kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$id_c = session()->get('id');
		$model_user = new ConsultasGeralModel();
		$model_backlog = new BacklogModel();
		$model_backlog_atividades = new KanbanAtividadesBacklog();
		$model_to_fazendo = new KanbanToFazendoModel();
		$model_homologacao = new KanbanHomologacaoModel();
		$model_concluidos = new KanbanConcluidoModel();
		
		$data = [
			'title' => $model_user->listaDadosUsuario($id_c),
			'listProjetos' => $m_projeto->findAll(),
			'ddProjetos' => $m_projeto->where('kbp_id', $id)->first(),
			'list_backlog' => $model_backlog->getBackLog($id),
			'list_atividade_backlog' => $model_backlog_atividades->where('ativ_bl_fk_projeto', $id)->first(),
			'ativ_backlog' => $model_backlog_atividades->getAtividadesBackLog(),

			//TO FAZENDO
			'list_backlog_to_fazendo' => $model_to_fazendo->getBackLogToFazendo($id),//passando o id do projeto
			'list_to_fazendo_atividades' => $model_to_fazendo->getAtividadesToFazendo($id),

			//HOMOLOGAÇÃO
			#LISTA HOLOLOGAÇÃO
			'list_homologacao' => $model_homologacao->where('hml_fk_projeto',$id)->groupBy("hml_nome_backlog")->findAll(),
			'homologacao_atividades' => $model_homologacao->where('hml_fk_projeto',$id)->findAll(),
			//PROJETO CONCLUÍDOS
			'lista_concluidos' => $model_concluidos->where('cl_fk_projeto', $id)->groupBy("cl_nome_backlog")->findAll(),
			'list_concluida_atividades' => $model_concluidos->where('cl_fk_projeto', $id)->findAll()
		];

		//dd($data['list_atividade_backlog']);
		return view('kanban/pages/etapas-kanban/' . $page, $data);
	}

	/**pagina de backlog */
	public function paginaBackLog(int $id)
	{
		$page = 'atividade-backlog';
		if (!is_file(APPPATH . '/Views/kanban/pages/etapas-kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_user = new ConsultasGeralModel();
		$model_backlog = new BacklogModel();
		$model_backlog_atividades = new KanbanAtividadesBacklog();
		$id_c = session()->get('id');
		$data = [
			'title' => $model_user->listaDadosUsuario($id_c),
			'meu_kanban_atividades' => $model_backlog_atividades->where('ativ_bl_fk_backlog', $id)->findAll(),
			'meu_backlog' => $model_backlog->where('bl_id', $id)->first(),
		];
		return view('kanban/pages/etapas-kanban/' . $page, $data);
	}

	/**salva backlog projeto */
	public function salvaBacklogProjeto()
	{
		$model = new BacklogModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'backlog_name' => ['label' => 'nome do backlog', 'rules' => 'required|max_length[100]|is_unique[kanban_backlog.bl_fk_projeto]'],
			'backlog_description' => ['label' => 'objetivo do backlog', 'rules' => 'required'],
			'backlog_data_inicial' => ['label' => 'data inicial', 'rules' => 'required|valid_date'],
			'backlog_data_final' => ['label' => 'data final', 'rules' => 'required|valid_date'],
			]))
		{
			$model->save([
				'bl_fk_usuario' 		=> $this->request->getPost('id_usuario_bl'),
				'bl_fk_projeto'  	=> $this->request->getPost('id_projeto_bl'),
				'bl_nome_backlog'  	=> $this->request->getPost('backlog_name'),
				'bl_data_inicial'  		=> $this->request->getPost('backlog_data_inicial'),
				'bl_data_final'  		=> $this->request->getPost('backlog_data_final'),
				'bl_description'  => $this->request->getPost('backlog_description'),
			]);
			session()->setFlashdata('success_backlog', 'Backlog adicionado com sucesso.');
			return redirect()->back();
		}
		else
		{
			session()->setFlashdata('error_backlog', 'Existem erros no cadastro, verifique por favor.');
			return redirect()->back()->withInput();
		}
	}

	/**salva atividades do backlog */
	public function salvaAtividadeBacklog()
	{
		$model = new KanbanAtividadesBacklog();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'ativ_backlog_name' => ['label' => 'nome da atividade', 'rules' => 'required|max_length[100]'],
			]))
		{
			$model->save([
				'ativ_bl_fk_usuario' 	=> $this->request->getPost('id_do_backlog_usuario'),
				'ativ_bl_fk_projeto'  	=> $this->request->getPost('id_do_projeto'),
				'ativ_bl_fk_backlog'  	=> $this->request->getPost('id_do_backlog'),
				'ativ_descricao'  		=> $this->request->getPost('ativ_backlog_name'),
			]);
			session()->setFlashdata('success_ativ_backlog', 'Atividade do Backlog adicionado com sucesso.');
			return redirect()->back();
		}
		else
		{
			session()->setFlashdata('error_ativ_backlog', 'Existem erros no cadastro, verifique por favor.');
			return redirect()->back()->withInput();
		}
	}

	/**inicia nova tarefa */
	public function iniciaTarefaParaToFazendo(int $id)
	{

		$page = 'visualiza-iniciar-tarefa';
		if (!is_file(APPPATH . '/Views/kanban/pages/etapas-kanban/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_user = new ConsultasGeralModel();
		$model_backlog_atividades = new KanbanAtividadesBacklog();
		$id_c = session()->get('id');
		$data = [
			'nova_fase' => $model_backlog_atividades->getAtividadesBackLog($id),
			'nova_fase_list' => $model_backlog_atividades->where('ativ_bl_fk_backlog', $id)->findAll(),
			'title' => $model_user->listaDadosUsuario($id_c),
		];
		return view('kanban/pages/etapas-kanban/' . $page, $data);
	}

	/**passa de faze do Backlog para TO FAZENDO */
	public function faseBacklogParaToFazendo()
	{
		
		if ($this->request->getMethod() === 'post') 
		{
			$model_backlog_atividades = new KanbanAtividadesBacklog();
			$id =  $this->request->getPost('tofaz_projeto');
			$model = new KanbanToFazendoModel();
			$teste =  $this->request->getPost('tofaz_name_atividades');
			$id_bl_delete =  $this->request->getVar('tofaz_backlog');
			
			foreach ($teste as $key => $value) {
				$data = [
					'to_faz_fk_usuario' 		=> $_POST['tofaz_usuario'],
					'to_faz_fk_projeto'  		=> $_POST['tofaz_projeto'],
					'to_faz_fk_backlog'  		=> $_POST['tofaz_backlog'],
					'to_faz_nome_backlog'  		=> $_POST['tofaz_nome_backlog'],
					'ativ_descricao'  			=> $value,
					'data_migracao_do_backlog'  => $_POST['tofaz_datacriado'],
				];
				$model->save($data);
			}
			$model_backlog_atividades->deleteFaseBacklog($id_bl_delete);
			$model_backlog_atividades->deleteBacklog($id_bl_delete);
			session()->setFlashdata('success_new_task', 'A nova tarefa foi iniciada com sucesso.');
			$this->emailCrarProjeto();
			return redirect()->to(site_url('kanban/gerar-processo-kanban/'.$id));
		}
	}
	public function emailCrarProjeto()
	{
		$email = \Config\Services::email();

		$templateMessage =  view('email-public/email-aviso1-kanban.php');
		$email->setFrom('obraseletricidade@outlook.com', 'Projeto Obras Elétrica');
		$email->setTo('wsoares@grupocobra.com.br');
		//$email->setTo('eleniciosouza7@gmail.com');

		$email->setSubject('Etapa de projeto');
		$email->setMessage($templateMessage);

		if ($email->send()) {
			return true;
		}else {
			return false;
		}
	}
	
}
