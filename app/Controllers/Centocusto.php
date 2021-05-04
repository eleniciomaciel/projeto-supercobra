<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObrasModel;
use App\Models\CentocustoModel;
class Centocusto extends BaseController
{
	public function index($page = 'page-centocusto')
	{
		if ( ! is_file(APPPATH.'/Views/master/layout/pages/cento_custo/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$obras = new ObrasModel();
		$data['list_ob'] =$obras->getObras(); // Capitalize the first letter
		echo view('master/layout/pages/cento_custo/'.$page, $data);
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
			]))
		{
			$model->save([
				'numero_cc' => $this->request->getPost('neu_numero_cc'),
				'descricao_cc'  =>$this->request->getPost('new_descricao_cc'),
				'fk_obra_cc'  =>$this->request->getPost('new_obra_cc'),
				'status_cc'  => $this->request->getPost('new_status_cc'),
			]);

			$obras = new ObrasModel();
			$data['list_ob'] =$obras->getObras(); 
			$session = session();
			$session->setFlashdata("success_cento_cc", "Cento de custo adicionado com sucesso!");
			echo view('master/layout/pages/cento_custo/page-centocusto', $data);
		}
		else
		{
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}
}
