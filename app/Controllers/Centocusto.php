<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObrasModel;
use App\Models\CentocustoModel;

class Centocusto extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "ADMIN") {
            echo 'Access denied';
            exit;
        }
    }
	
	public function index($page = 'page-centocusto')
	{
		if (!is_file(APPPATH . '/Views/master/layout/pages/cento_custo/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$obras = new ObrasModel();
		$data['list_ob'] = $obras->getObras(); // Capitalize the first letter
		echo view('master/layout/pages/cento_custo/' . $page, $data);
	}

	/**salva cento custo */
	public function adicionaCentoCusto()
	{
		$model = new CentocustoModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'neu_numero_cc' => ['label' => 'Número do cento de custo', 'rules' => 'required|max_length[100]|is_unique[cento_custo.numero_cc]'],
			'new_descricao_cc' => ['label' => 'Descricao', 'rules' => 'required|max_length[100]'],
			'new_obra_cc' => ['label' => 'Obra', 'rules' => 'required'],
			'new_status_cc' => ['label' => 'status', 'rules' => 'required']
		])) {
			$model->save([
				'numero_cc' => $this->request->getPost('neu_numero_cc'),
				'descricao_cc'  => $this->request->getPost('new_descricao_cc'),
				'fk_obra_cc'  => $this->request->getPost('new_obra_cc'),
				'status_cc'  => $this->request->getPost('new_status_cc'),
			]);

			$obras = new ObrasModel();
			$data['list_ob'] = $obras->getObras();
			$session = session();
			$session->setFlashdata("success_cento_cc", "Cento de custo adicionado com sucesso!");
			echo view('master/layout/pages/cento_custo/page-centocusto', $data);
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	/**lista todas as obras */
	public function listaCentoCusto()
	{
		$list = new CentocustoModel();
		$todas_cc = $list->getCentocusto();
		foreach ($todas_cc as $ccLista) {
			$listaResultados[] = [

				$ccLista['numero_cc'],
				$ccLista['descricao_cc'],
				$ccLista['obras_local'],
				$ccLista['status_cc'] == 'active' ? "<span class='badge badge-pill badge-success'>Ativo</span>" : ($ccLista['status_cc'] == 'inactive' ? "<span class='badge badge-pill badge-warning'>Pendente</span>" : "<span class='badge badge-pill badge-danger'>Suspenso</span>"),
				date('d/m/Y', strtotime($ccLista['created_at'])),
				'<div class="btn-group dropleft">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Opções
				</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="/centocusto/ver-cento-custo/' . esc($ccLista['id_cc']) . '"><i class="fa fa-eye"></i> Visualizar</a>
						<a class="dropdown-item" href="/centocusto/status-cento-custo/' . $ccLista['id_cc'] . '"><i class="fa fa-star"></i> Status</a>
						<div class="dropdown-divider"></div>
						<a class="deleteCCusto dropdown-item" id="'. $ccLista['id_cc'].'"><i class="fa fa-trash"></i> Deletar</a>
					</div>
				</div>'
			];
		}
		$todas_cc = [
			'data' => $listaResultados
		];
		echo json_encode($todas_cc);
	}

	/**visualiza cento de custo */
	public function visualizaCentoCusto(int $id = null)
	{
		$list = new CentocustoModel();
		$obras = new ObrasModel();
		$todas_cc['list_ob'] = $obras->getObras();
		$todas_cc['dd_cc'] = $list->getCentocusto($id);
		if (empty($todas_cc['dd_cc'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi possível encontrar o valor do cento de custo: ' . $id);
		}
		echo view('master/layout/pages/cento_custo/ver-centocusto', $todas_cc);
	}

	public function alteraCentoCusto()
	{
		$model = new CentocustoModel();
		$id = $this->request->getPost('id_do_cc');
		if ($this->request->getMethod() === 'post' && $this->validate([
			'neu_numero_cc_up' => ['label' => 'Número do cento de custo', 'rules' => 'required|max_length[100]'],
			'new_descricao_cc_up' => ['label' => 'Descricao', 'rules' => 'required|max_length[100]'],
			'new_obra_cc_up' => ['label' => 'Obra', 'rules' => 'required'],

		])) {
			$model->save([
				'id_cc' => $id,
				'numero_cc' => $this->request->getPost('neu_numero_cc_up'),
				'descricao_cc'  => $this->request->getPost('new_descricao_cc_up'),
				'fk_obra_cc'  => $this->request->getPost('new_obra_cc_up'),
			]);

			$obras = new ObrasModel();

			$list = new CentocustoModel();
			$obras = new ObrasModel();
			$todas_cc['list_ob'] = $obras->getObras();
			$todas_cc['dd_cc'] = $list->getCentocusto($id);

			$session = session();
			$session->setFlashdata("success_cento_v_cc", "Cento de custo atualizado com sucesso!");
			echo view('master/layout/pages/cento_custo/ver-centocusto', $todas_cc);
			
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	public function visualizaStatusCentoCusto(int $id)
	{
		$list = new CentocustoModel();
		$todas_cc['dd_cc'] = $list->getCentocusto($id);
		if (empty($todas_cc['dd_cc'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Não foi possível encontrar o valor do status docento de custo: ' . $id);
		}
		echo view('master/layout/pages/cento_custo/ver-status-centocusto', $todas_cc);
	}

	public function alterarStatusCentoCusto(int $id)	
	{
		$model = new CentocustoModel();
		$id = $this->request->getPost('id_do_cc');
		if ($this->request->getMethod() === 'post' && $this->validate([
			'up_status_cc' => ['label' => 'Status', 'rules' => 'required'],

		])) {
			$model->save([
				'id_cc' => $id,
				'status_cc' => $this->request->getPost('up_status_cc'),
			]);

			$obras = new ObrasModel();

			$list = new CentocustoModel();
			$obras = new ObrasModel();
			$todas_cc['dd_cc'] = $list->getCentocusto($id);

			$session = session();
			$session->setFlashdata("success_cento_ust_cc", "Status do Cento de custo atualizado com sucesso!");
			echo view('master/layout/pages/cento_custo/ver-status-centocusto', $todas_cc);
			
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}
	/**delete ceto custo */
	public function deleteCentoCusto()
	{
        if($this->request->getVar('user_id'))
        {
            $id = $this->request->getVar('user_id');
            $crudModel = new CentocustoModel();
            $crudModel->delete($id);
            echo 'Cento de custo deletado co sucesso!';
		}

	}
}
