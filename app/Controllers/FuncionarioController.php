<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\CargosModel;
use App\Models\DepartamentosModel;
use App\Models\ObrasModel;
use App\Models\FrentesModel;
use App\Models\CentocustoModel;

class FuncionarioController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "ADMIN") {
            echo 'Access denied';
            exit;
        }
    }
	
	public function index($page = 'novos-usuarios')
	{
		if (!is_file(APPPATH . '/Views/master/layout/pages/usuarios/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$cargos = new CargosModel();
		$departamento = new DepartamentosModel();
		$obras = new ObrasModel();
		$frentes = new FrentesModel();
		$cc = new CentocustoModel();

		$data = [
			'list_cargos' => $cargos->getCargos(),
			'list_departamentos' => $departamento->getDepartamentos(),
			'list_obras' => $obras->getObras(),
			'list_frentes' => $frentes->getFrentes(),
			'list_cc' => $cc->getTodosCc(),
			'title' => 'Cadastrar usuarios'
		];
		echo view('master/layout/pages/usuarios/' . $page, $data);
	}

	public function createUsuario()
	{
		$model = new FuncionarioModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'nome_user' 				=> ['label' => 'Usuario', 'rules' => 'required|min_length[3]|max_length[100]|is_unique[funcionarios.f_nome]'],
			'cargo_user' 				=> ['label' => 'Cargo', 'rules' => 'required'],
			'email_user' 				=> ['label' => 'Email', 'rules' => 'required|valid_email|is_unique[funcionarios.f_email_pessoal]'],
			'matricula_user' 			=> ['label' => 'Matrícula', 'rules' => 'required|min_length[3]|max_length[50]|is_unique[funcionarios.f_codigo]'],
			'user_departamento' 		=> ['label' => 'Departamento', 'rules' => 'required'],
			'user_obra'					=> ['label' => 'Obra', 'rules' => 'required'],
			'user_frente'				=> ['label' => 'Frente', 'rules' => 'required'],
			'user_cento_de_custo_cc' 	=> ['label' => 'Cento de Custo', 'rules' => 'required'],
		])) {
			$model->save([
				'f_nome' 			=> $this->request->getPost('nome_user'),
				'f_codigo'  		=> $this->request->getPost('matricula_user'),
				'f_email_pessoal'  	=> strtolower($this->request->getPost('email_user')),
				'f_cargo'  			=> $this->request->getPost('cargo_user'),
				'f_fk_obra'  			=> $this->request->getPost('user_obra'),
				'f_Fk_frente'  			=> $this->request->getPost('user_frente'),
				'f_fk_cento_custo'  	=> $this->request->getPost('user_cento_de_custo_cc'),
				'f_fk_id_departamento'  => $this->request->getPost('user_departamento'),
				
			]);

			$session = session();
			$session->setFlashdata("success_users", "Usuario cadastrado cadastrado com sucesso!");
			return redirect()->route('usuario_admin/add');
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	/**lista todas as obras */
	public function listaUsuarios()
	{
		$list = new FuncionarioModel();
		$todasFuncionarios = $list->getFuncionarios();
		foreach ($todasFuncionarios as $usuarios) {
			$listaResultados[] = [

				$usuarios['f_nome'],
				date('d/m/Y', strtotime($usuarios['created_at'])),
				$usuarios['f_email_pessoal'],
				$usuarios['cargo_nome'],
				$usuarios['f_status'],
				'<div class="btn-group dropleft">
				<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Opções
				</button>
					<div class="dropdown-menu">

						<a class="dropdown-item" href="/usuario_acesso/login_usuario/' . esc($usuarios['f_id']) . '">
							<i class="fas fa-unlock-alt"></i> Gerar acesso
						</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="usuario_acesso/desativar-acesso' . esc($usuarios['f_id']) . '">
							<i class="fa fa-trash"></i> Desativar
						</a>
					</div>
				</div>'
			];
		}
		$todasFuncionarios = [
			'data' => $listaResultados
		];
		echo json_encode($todasFuncionarios);
	}
}
