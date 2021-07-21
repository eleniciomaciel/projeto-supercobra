<?php

namespace App\Controllers\Kanban;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;
use App\Models\KanbanProjetoModel;
use App\Models\KanbanToFazendoModel;
use App\Models\KanbanAtividadesBacklog;
use App\Models\KanbanHomologacaoModel;

class ToFazendoController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "KANBAN") {
            echo 'Accesso negado!';
            exit;
        }
    }

	public function index($id_backlog, $id_to_fazendo)
	{
		$page = 'toFazendoAdiciona';
		if (!is_file(APPPATH . '/Views/kanban/pages/kanbanToFazendo/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$id = session()->get('id');
		$model_user = new ConsultasGeralModel();
		$m_projeto = new KanbanProjetoModel();
		$m_lista_to_fazendo = new KanbanToFazendoModel();
		$data = [
			'title' => $model_user->listaDadosUsuario($id),
			'listProjetos' => $m_projeto->findAll(),
			'listToFazendo' => $m_lista_to_fazendo->where('to_faz_id', $id_to_fazendo)->first(),
			'lacoToFazendo' => $m_lista_to_fazendo->listaTarefastoFazendo($id_backlog),
		];
		return view('kanban/pages/kanbanToFazendo/' . $page, $data);
	}

	public function salvaAtividadeToFazendo()
	{
		$model = new KanbanToFazendoModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'to_faz_nome_etapa' => ['label' => 'nome da atividade', 'rules' => 'required|max_length[100]'],
			]))
		{
			$model->save([
				'to_faz_fk_projeto' 	=> $this->request->getPost('id_toFaz_add_projeto'),
				'to_faz_fk_backlog'  	=> $this->request->getPost('id_toFaz_add_backlog'),
				'to_faz_nome_backlog'  	=> $this->request->getPost('id_toFaz_add_nome_bk'),
				'ativ_descricao'  		=> $this->request->getPost('to_faz_nome_etapa'),
			]);
			session()->setFlashdata('success_to_faz_', 'Atividade adicionada com sucesso.');
			return redirect()->back();
		}
		else
		{
			session()->setFlashdata('error_to_faz_', 'Existem erros no cadastro, verifique por favor.');
			return redirect()->back()->withInput();
		}
	}

	public function alteraTarefaOne()
	{
		$model_to_fazendo = new KanbanToFazendoModel();
		$id = $this->request->getVar('id');
		$state = $this->request->getVar('checkbox');

		if ($state == TRUE) {
			$model_to_fazendo->save([
				'to_faz_id' => $id,
				'to_faz_status' => '1',
			]);
			echo 'Etapa marcada como concluída.';
		}else {
			$model_to_fazendo->save([
				'to_faz_id' => $id,
				'to_faz_status' => '0',
			]);
			echo 'Etapa marcada como Pendente.';
		}
	}

	/**painel de homologação */
	public function painelDeHomologacao($id_to_fazendo, $id_do_backlog_em_tofazendo)
	{
		$page = 'painel-to-fazendo-para-homologacao';
		if (!is_file(APPPATH . '/Views/kanban/pages/kanbanToFazendo/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_user = new ConsultasGeralModel();
		$model_to_fazendo = new KanbanToFazendoModel();
		$id_c = session()->get('id');
		$data = [
			'nova_fase' => $model_to_fazendo->getToFazendo($id_to_fazendo),
			'nova_fase_list' => $model_to_fazendo->where('to_faz_fk_backlog', $id_do_backlog_em_tofazendo)->findAll(),
			'title' => $model_user->listaDadosUsuario($id_c),
		];
		return view('kanban/pages/kanbanToFazendo/' . $page, $data);
	}

	/**passa de faze do Backlog para TO FAZENDO */
	public function faseHomologacao()
	{
		
		if ($this->request->getMethod() === 'post') 
		{
			$model_hml = new KanbanHomologacaoModel();
			$id 			=  	$this->request->getPost('tofaz_projeto');
			$teste 			=  $this->request->getPost('tofaz_name_atividades');
			$id_bl_delete 	=  $this->request->getPost('tofaz_backlog');
			$checkbox 		= $this->request->getPost('status_ckeckbox[]');
			
			foreach ($teste as $key => $value) {
				$data = [
					'hml_fk_usuario' 			=> $_POST['tofaz_usuario'],
					'hml_fk_projeto'  			=> $_POST['tofaz_projeto'],
					'hml_fk_backlog'  			=> $_POST['tofaz_backlog'],
					'hml_nome_backlog'  		=> $_POST['tofaz_nome_backlog'],
					'hml_ativ_descricao'  		=> $value,
					'hml_status'  				=> $checkbox[$key],
					'data_migracao_do_backlog'  => $_POST['tofaz_datacriado'],
				];
				$model_hml->save($data);
			}
			$model_hml->deleteFaseTofazendo($id_bl_delete);
			$this->emailCrarProjetoToFazendo();
			session()->setFlashdata('success_new_add_hml', 'Fase de homologação iniciada com sucesso.');
			return redirect()->to(site_url('kanban/gerar-processo-kanban/'.$id));
		}
	}

	public function emailCrarProjetoToFazendo()
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
