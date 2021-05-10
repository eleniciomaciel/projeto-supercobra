<?php

namespace App\Controllers;
use App\Models\FrentesModel;
use App\Models\AcessousuariosModel;
class Home extends BaseController
{
	public function index()
	{
		$model_frentes = new FrentesModel();
		$data = [
			'frentes' => $model_frentes->getFrentes()
		];
		return view('welcome_message', $data);
	}

	public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
				'email' => ['label' => 'Login Pessoal', 'rules' => 'required|min_length[6]|max_length[50]|valid_email',
				'errors' => [
					'required' => 'Ops! Digite um email válido.'
				]],
				'password' => ['label' => 'Senha de Acesso', 'rules' => 'required|regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/]|validateUser[email,password]',
				'errors' => [
					'required' => 'Ops! Digite uma senha.',
					'validateUser' => 'Ops! Senha não encontrada.',
					'regex_match' => 'Ops! Senha fora do padrão.',
				]]

            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email ou senha não coincidem",
                ],
            ];

			if (!$this->validate($rules, $errors)) {

				$model_frentes = new FrentesModel();
				$data = [
					'frentes' => $model_frentes->getFrentes()
				];
				return view('welcome_message', $data, [
					"validation" => $this->validator,
				]);

            } else {
                $model = new AcessousuariosModel();

                $user = $model->where('au_login_corp', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if($user['role'] == "ADMIN"){

                    //return redirect()->to(base_url('admin_master'));
                    return redirect()->route('admin_master/gestao_master');

                }elseif($user['role'] == "RH"){

                    return redirect()->to(base_url('admin_rh'));
                }
            }
        }
        return view('/');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' 			=> $user['au_fk_usuario_corp'],
            'fk_cargo' 		=> $user['au_fk_cargo'],
            'fk_obra' 		=> $user['au_fk_obra'],
            'login_use' 	=> $user['au_login_corp'],
            'isLoggedIn' 	=> true,
            "role" 			=> $user['role'],
        ];
        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

	public function adminPanel()
	{
		
		return view('master/home-master');
	}

	
}
