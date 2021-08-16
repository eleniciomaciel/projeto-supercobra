<?php

namespace App\Controllers\Rh\Medicos;

use App\Controllers\BaseController;
use App\Models\MedicoPcmsoModel;

class PcmsoController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'home-pcmso')
	{
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/medicos-pcmso/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		echo view('frentesObras/frenteRh/layout/pages/medicos-pcmso/' . $page);
	}
	
	public function cadastraMedicoPcmso()
	{
		$validation =  \Config\Services::validation();
		$this->validate([
			'med_name' => ['label' => 'nome do médico(a)', 'rules' => 'required|max_length[100]'],
			'med_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|max_length[60]|valid_email|is_unique[medicopcmsos.medic_pcmso_email]'],
			'med_crm' => ['label' => 'crm', 'rules' => 'required|max_length[30]|is_unique[medicopcmsos.medic_pcmso_crm]'],
			'med_descricao' => ['label' => 'descrição', 'rules' => 'max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new MedicoPcmsoModel();
			$query = $model->save([
				'medic_fk_pcmso_quem_cadastrou' => $this->request->getPost('id_quem_cadastra_medic'),
				'medic_pcmso_nome'  			=> $this->request->getPost('med_name'),
				'medic_pcmso_email'  			=> strtolower($this->request->getPost('med_email')),
				'medic_pcmso_crm'  				=> $this->request->getPost('med_crm'),
				'medic_pcmso_description'  		=> $this->request->getPost('med_descricao')
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Cadastro criado com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A cadastro não pode ser alterado, desculpe!']);
			}
		}
	}

	public function getListaMedicos()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}
		$model = new MedicoPcmsoModel();
		$data = $model->where('medic_pcmso_status','Ativo')->findAll();

		if ($data) {
			foreach ($data as $post) {
				echo '
				<tr>
					<td>'.$post["medic_pcmso_nome"].'</td>
					<td>'.$post["medic_pcmso_email"].'</td>
					<td>'.$post["medic_pcmso_crm"].'</td>
					<td>
					<div class="btn-group">
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Opções
						</button>
						<div class="dropdown-menu">
							<a class="verMedicoEaltera dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-eye"></i> Visualizar</a>
							<a class="statusMedico dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-edit"></i> Status</a>
							<div class="dropdown-divider"></div>
							<a class="deleteMedicalOne dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-trash"></i> Deletar</a>
						</div>
					</div>
					</td>
				</tr>
				';
			}
		} else {
			echo '
			
			<tr>
				<td class="text-muted text-center" colspan="4">Sem registros cadastrados.</td>
			</tr>
			';
		}
		
	}

	/**
	 * visualiza cadastro do médico
	 */
	public function getMedico()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}
		
		if($this->request->getVar('id_medic'))
        {
            $crudModel = new MedicoPcmsoModel();
            $user_data = $crudModel->where('medic_pcmso_id', $this->request->getVar('id_medic'))->first();
            echo json_encode($user_data);
        }
	}

	public function alteraCadastraMedicoPcmso()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		$validation =  \Config\Services::validation();
		$this->validate([
			'medic_pcmso_nome' => ['label' => 'nome do médico(a)', 'rules' => 'required|max_length[100]'],
			'medic_pcmso_email' => ['label' => 'email', 'rules' => 'required|min_length[10]|max_length[60]|valid_email'],
			'medic_pcmso_crm' => ['label' => 'crm', 'rules' => 'required|max_length[30]'],
			'medic_pcmso_description' => ['label' => 'descrição', 'rules' => 'max_length[500]'],
		]);

		if ($validation->run() == FALSE) {
			$errors = $validation->getErrors();
			echo json_encode(['code' => 0, 'error' => $errors]);
		} else {
			$model = new MedicoPcmsoModel();
			$query = $model->save([
				'medic_pcmso_id' 				=> $this->request->getPost('hidden_id_medic'),
				'medic_pcmso_nome'  			=> $this->request->getPost('medic_pcmso_nome'),
				'medic_pcmso_email'  			=> strtolower($this->request->getPost('medic_pcmso_email')),
				'medic_pcmso_crm'  				=> $this->request->getPost('medic_pcmso_crm'),
				'medic_pcmso_description'  		=> $this->request->getPost('medic_pcmso_description')
			]);

			if ($query) {
				echo json_encode(['code' => 1, 'msg' => 'Cadastro alterado com sucesso!']);
			} else {
				echo json_encode(['code' => 0, 'msg' => 'A cadastro não pode ser alterado, desculpe!']);
			}
		}
	}

	public function alterastatusMedicoPcmso()
	{
		$model = new MedicoPcmsoModel();
		$model->save([
			'medic_pcmso_id' => $this->request->getPost('hidden_id_medic_state'),
			'medic_pcmso_status'  => $this->request->getPost('medic_pcmso_status'),
		]);
		echo "Status alterado com sucesso";
	}

	public function delMedicalOne()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}

		if($this->request->getVar('id_medic_del'))
        {
            $id = $this->request->getVar('id_medic_del');
            $model = new MedicoPcmsoModel();
            $model->where('medic_pcmso_id', $id)->delete();
            echo 'Médico deletado com sucesso!';
        }
	}

	/**
	 * lista medicos inativos
	 */
	public function getListaMedicosInativados()
	{
		if (!$this->request->isAJAX()) {
			exit('Pagina não encontrada');
		}
		$model = new MedicoPcmsoModel();
		$data = $model->where('medic_pcmso_status','Suspenso')->findAll();

		if ($data) {
			foreach ($data as $post) {
				echo '
				<tr>
					<td>'.$post["medic_pcmso_nome"].'</td>
					<td>'.$post["medic_pcmso_email"].'</td>
					<td>'.$post["medic_pcmso_crm"].'</td>
					<td>
					<div class="btn-group">
						<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Opções
						</button>
						<div class="dropdown-menu">
							<a class="verMedicoEaltera dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-eye"></i> Visualizar</a>
							<a class="statusMedico dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-edit"></i> Status</a>
								<div class="dropdown-divider"></div>
							<a class="deleteMedicalOne dropdown-item" href="#" data-id="'.$post["medic_pcmso_id"].'"><i class="fas fa-trash"></i> Deletar</a>
						</div>
					</div>
					</td>
				</tr>
				';
			}
		} else {
			echo '
			
			<tr>
				<td class="text-muted text-center" colspan="4">Sem registros cadastrados.</td>
			</tr>
			';
		}
		
	}
}
