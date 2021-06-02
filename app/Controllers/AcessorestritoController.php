<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\FuncionarioModel;
use App\Models\CargosModel;
use App\Models\AcessousuariosModel;
use App\Models\ObrasModel;
use App\Models\FrentesModel;
use App\Models\DepartamentosModel;

class AcessorestritoController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "ADMIN") {
            echo 'Access denied';
            exit;
        }
    }
	
	public function index()
	{
		$model_frentes = new FrentesModel();
		$data = [
			'frentes' => $model_frentes->getFrentes()
		];
		return view('welcome_message', $data);
		
	}
	public function geraAcesso(int $id = null)
	{
		$page = 'dados_usuario';
		$model = new FuncionarioModel();
		$cargos = new CargosModel();
		
		if ( ! is_file(APPPATH.'/Views/master/layout/pages/acessos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
			'title' =>'Dados do colaborador',
			'ddf' => $model->getFuncionarios($id),
			'list_cargos' => $cargos->getCargos(),
			
		]; // Capitalize the first letter
		echo view('master/layout/pages/acessos/'.$page, $data);
	}

	/**altera dados do usuário */
	public function updateUsuario($id)
	{
		$model = new FuncionarioModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'nome_user' 		=> ['label' => 'Usuario', 'rules' => 'required|min_length[3]|max_length[100]'],
			'cargo_user' 		=> ['label' => 'Cargo', 'rules' => 'required'],
			'email_user' 		=> ['label' => 'Email', 'rules' => 'required|valid_email'],
			'matricula_user' 	=> ['label' => 'Matrícula', 'rules' => 'required|min_length[3]|max_length[50]']
		])) {
			$model->save([
				'f_id'              => $id,
				'f_nome' 			=> $this->request->getPost('nome_user'),
				'f_cargo'  			=> $this->request->getPost('cargo_user'),
				'f_email_pessoal'  	=> strtolower($this->request->getPost('email_user')),
				'f_codigo'  		=> $this->request->getPost('matricula_user'),
			]);

			$session = session();
			$session->setFlashdata("success_users_up", "Usuario alterado com sucesso!");
			return redirect()->back();
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	/**visualiza painel do login */
	public function viewDadosLogin(int $id = null)
	{
		$page = 'logi_usuario';
		$model = new FuncionarioModel();
		$cargos = new CargosModel();
		$login = new AcessousuariosModel();
		$obras = new ObrasModel();
		$frentes = new FrentesModel();
		$departamento = new DepartamentosModel();

		if ( ! is_file(APPPATH.'/Views/master/layout/pages/acessos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
			'title' =>'Gerar dados de acesso',
			'ddf' => $model->getFuncionarios($id),
			'list_cargos' => $cargos->getCargos(),
			'usuarios_login' => $login->getUsuarioAcesso($id),
			'obras' => $obras->getObras(),
			'frentes' => $frentes->getFrentes(),
			'cargos' => $cargos->getCargos(),
			'depart' => $departamento->getDepartamentos(),
		]; // Capitalize the first letter
		echo view('master/layout/pages/acessos/'.$page, $data);
	}

	public function criaUsuarioLogin(int $id)
	{
		//dd($_POST);
		$model = new AcessousuariosModel();
		if ($this->request->getMethod() === 'post' && $this->validate([
			'email_user_acesso' 	=> ['label' => 'E-mail', 'rules' => 'required|valid_email|is_unique[acessousuarios.au_login_corp]'],
			
			'senha_user_acesso'     => ['label' => 'Senha', 'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/]',
            'errors' => [
                'regex_match' => 'Insira uma senha de [8 a 15] caracteres que contêm pelo menos uma letra minúscula, uma letra maiúscula, um dígito numérico e um caractere especial.'
            ]],
			
			'obra_user_acesso' 		=> ['label' => 'OBRA', 'rules' => 'required'],
			
			'frente_user_acesso' 		=> ['label' => 'FRENTE DE TRABALHO', 'rules' => 'required'],
			
			'id_usuario_acesso' 	=> ['label' => 'ID USUÁRIO', 'rules' => 'required|is_unique[acessousuarios.au_fk_usuario_corp]',
            'errors' => [
                'is_unique' => 'Esse usuário já foi cadastrado no sistema.',
            ]],
			
			'user_nivel_cat' 	=> ['label' => 'Nível', 'rules' => 'required'],
			
			'cargo_user' 	=> ['label' => 'Cargo', 'rules' => 'required'],
		])) {

			$model->save([
				'au_fk_usuario_corp'        => $id,
				'au_login_corp' 			=> strtolower($this->request->getVar('email_user_acesso')),
				'au_passwword'  			=> password_hash($this->request->getVar('senha_user_acesso'), PASSWORD_DEFAULT),
				'au_fk_cargo'  			=> $this->request->getVar('cargo_user'),
				'au_fk_frente'  			=> $this->request->getVar('frente_user_acesso'),
				'au_fk_obra'  				=> $this->request->getVar('obra_user_acesso'),
				'au_fk_departamento_func'  => $this->request->getVar('user_depatamento'),
				'au_token_active'  			=> md5(uniqid(rand(), true)),
				'au_token_expiracao'  		=> date("Y-m-d", strtotime('+ 1 days')),
				'au_status'  				=> '1',
				'role'  					=> $this->request->getVar('user_nivel_cat'),
			]);

			$to = strtolower($this->request->getVar('email_user_acesso'));

			$this->sendMailToActive($to, $id);
			$session = session();
			$session->setFlashdata("success_users_cria_user", "Usuario criado com sucesso!");
			return redirect()->back();
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	/**altera dados do status do usuário */
	public function alteraStatusUsuario(int $id)
	{
		$model = new AcessousuariosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'up_acc_email' 		=> ['label' => 'E-mail', 'rules' => 'required|valid_email|is_unique[acessousuarios.au_login_corp]'],
			'up_acc_cargo' 		=> ['label' => 'CARGO', 'rules' => 'required'],
			'up_acc_obra' 		=> ['label' => 'OBRA', 'rules' => 'required'],
			'up_acc_frente' 	=> ['label' => 'FRENTE DE TRABALHO', 'rules' => 'required'],
			'up_acc_status' 	=> ['label' => 'STATUS', 'rules' => 'required']
		])) {
			$model->save([
				'au_id'        				=> $id,
				'au_login_corp' 			=> strtolower($this->request->getPost('up_acc_email')),
				'au_fk_cargo'  				=> $this->request->getPost('up_acc_cargo'),
				'au_fk_frente'  			=> $this->request->getPost('up_acc_frente'),
				'au_fk_obra'  				=> $this->request->getPost('up_acc_obra'),
				'au_token_active'  			=> md5(uniqid(rand(), true)),
				'au_token_expiracao'  		=> date("Y-m-d", strtotime('+ 1 days')),
				'au_status'  				=> $this->request->getPost('up_acc_status'),
			]);

			$session = session();
			$session->setFlashdata("success_users_cria_user_update", "Dados de acesso alterado com sucesso!");
			return redirect()->back();
		} else {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}
	}

	/**envia email */
	public function sendMailToActive($mail_to, $id)
	{
		$email = \Config\Services::email();

		$model_funcionario = new FuncionarioModel();
		$data['send_user'] = $model_funcionario->getFuncionariosId($id);

		$templateMessage =  view('email-public/template-mail.php', $data);
		$email->setFrom('obraseletricidade@outlook.com', 'Bem vindo ao SYS-IO');
		$email->setTo($mail_to);

		$email->setSubject('Confirmação de acesso SGI-IO');
		$email->setMessage($templateMessage);

		if ($email->send()) {
			return true;
		}else {
			return false;
		}
	}
}
