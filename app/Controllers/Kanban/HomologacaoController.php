<?php

namespace App\Controllers\Kanban;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;
use App\Models\KanbanToFazendoModel;
use App\Models\KanbanHomologacaoModel;
use App\Models\KanbanConcluidoModel;

class HomologacaoController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "KANBAN") {
            echo 'Accesso negado!';
            exit;
        }
    }

	public function index($id_projeto, $id_backlog)
	{
		$page = 'painel-status-da-homologacao';
		if (!is_file(APPPATH . '/Views/kanban/pages/kanbanHomologacao/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_user = new ConsultasGeralModel();
		$model_to_homologando = new KanbanHomologacaoModel();
		$model_to_homologando->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
		$id_c = session()->get('id');
		$data = [
			'dd_projeto' => $model_to_homologando->where('hml_fk_backlog',$id_backlog)->groupBy("hml_fk_backlog")->first(),
			'list_homolocacao' => $model_to_homologando->where('hml_fk_backlog', $id_backlog)->findAll(),
			'title' => $model_user->listaDadosUsuario($id_c),
		];
		return view('kanban/pages/kanbanHomologacao/' . $page, $data);
	}

	public function atualizaEtapa(int $id)
	{
		$page = 'painel-etapa-homologacao';
		if (!is_file(APPPATH . '/Views/kanban/pages/kanbanHomologacao/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_user = new ConsultasGeralModel();
		$model_to_homologando = new KanbanHomologacaoModel();
		$id_c = session()->get('id');
		$data = [
			'dd_projeto' => $model_to_homologando->where('hml_id',$id)->first(),
			'title' => $model_user->listaDadosUsuario($id_c),
		];
		return view('kanban/pages/kanbanHomologacao/' . $page, $data);
	}

	/**atualiza etapa status */
	public function alteraStatusTarefa(int $id)
	{
		$model = new KanbanHomologacaoModel();
		if ($this->request->getMethod() === 'post')
		{
			$return_projeto=$this->request->getPost('return_projeto');
			$return_back_log=$this->request->getPost('return_back_log');
			
			$model->save([
				'hml_id' => $id,
				'hml_status'  => $this->request->getPost('status_hologa'),
				'hml_description'  => $this->request->getPost('homologa_observe'),
			]);
			return redirect()->to(site_url('/kanban-homologacao/painel-de-homologacao-status/'.$return_projeto.'/'.$return_back_log));
		}
	}

	/**faze final da etapa */
	public function fazeCluido()
	{
		if ($this->request->getMethod() === 'post') 
		{
			$model = new KanbanConcluidoModel();

			$id =  $this->request->getPost('c_projeto');
			$teste =  $this->request->getPost('c_descricao');
			$v_observe =  $this->request->getPost('c_observacao');
			$v_status =  $this->request->getPost('c_status');
			$id_bl_delete =  $this->request->getVar('c_n_backlog');
			
			foreach ($teste as $key => $value) {
				$data = [
					'cl_fk_usuario' 			=> $_POST['c_usuario'],
					'cl_fk_projeto'  			=> $_POST['c_projeto'],
					'cl_nome_backlog'  			=> $_POST['c_n_backlog'],
					'cl_ativ_descricao'  		=> $value,
					'cl_status'  				=> $v_status[$key],
					'data_migracao_do_backlog'  => $_POST['c_dt_migracao'],
					'cl_description'  			=> $v_observe[$key],
				];
				$model->save($data);
			}
			$model->deleteFaseHomologacao($id_bl_delete);
			session()->setFlashdata('success_new_nomologa_concluido', 'Etapa para faze de cpmclusão realizado com sucesso!');
			return redirect()->to(site_url('kanban/gerar-processo-kanban/'.$id));
			//return redirect()->back();
		}
	}
}
