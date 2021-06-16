<?php

namespace App\Controllers\Rh\Acesso;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\AcessousuariosModel;

class AcessoController extends BaseController
{
	public function __construct()
	{
		if (session()->get('role') != "RH") {
			echo view('/');
			exit;
		}
	}

	public function index(int $id)
	{
		$page = 'home-acesso';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/acesso_usuario/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$model_funcionario = new FuncionarioModel();
		$data = [
			'title' => 'Dados de acesso',
			'dd_funcionario' => $model_funcionario->where('f_id', $id)->first()
		];
		//dd($data);
		//$crudModel->where('f_id', $id)->first();
		return view('frentesObras/frenteRh/layout/pages/acesso_usuario/' . $page, $data);
	}

	public function alteraFoto(int $id)
	{

		$db = \Config\Database::connect();
		$builder = $db->table('acessousuarios');

		$validated = $this->validate([
			'file_perfil' => [
				'uploaded[file_perfil]',
				'mime_in[file_perfil,image/jpg,image/jpeg,image/gif,image/png]',

			],
		]);

		$msg = 'Selecione uma imagem válida';

		if ($validated) {
			$avatar = $this->request->getFile('file_perfil');
			$avatar->move(WRITEPATH . 'uploads/perfil');

			$data = [
				'au_foto' =>  $avatar->getClientName(),
			];

			$builder->update($data, ['au_id' => $id]);
			$msg = 'Foto salva com sucesso, faça logout para visualizara alteração.';
		}
		return redirect()->back()->with('msg', $msg);
	}

	public function alteraMeuAcesso(int $id)
	{
		$model = new AcessousuariosModel();

		if ($this->request->getMethod() === 'post' && $this->validate([
			'meu_email_pessoal' => [
				'label' => 'E-mail pessoal', 'rules' => 'required|valid_email',
				'errors' => [
					'required' => 'O {field} é obrigatório',
					'valid_email' => 'O {field} dever ser tipo válido'
				]
			],
			'minha_nova_senha' => [
				'label' => 'Senha', 'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/]',
				'errors' => [
					'required' => 'A {field} é brigatório',
					'regex_match' => 'A {field} deve conter letras maiúsculas e minúscula, números e caracteres especiais, tipo: #$@%&* e ter de 8 a 15 caracteres.',
				]
			]
		])) {
			$model->save([
				'au_id' => $id,
				'au_login_corp' => $this->request->getPost('meu_email_pessoal'),
				'au_passwword'  => password_hash($this->request->getPost('minha_nova_senha'), PASSWORD_DEFAULT),
			]);
			$session = session();
			$session->setFlashdata("success_acc", "Dados alterado com sucesso!");
			return redirect()->back();
		} else {

			return redirect()->back()->withInput(['validation' => $this->validator]);
		}
	}
}
