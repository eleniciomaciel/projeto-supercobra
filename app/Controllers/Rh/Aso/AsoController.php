<?php

namespace App\Controllers\Rh\Aso;

use App\Controllers\BaseController;
use App\Models\CargofuncoesModel;
use App\Models\ConsultasGeralModel;
use App\Models\ExamesModel;
use App\Models\ExamesContratuaisModel;
use App\Models\CargosModel;
use App\Models\ExamescargosModel;


class AsoController extends BaseController
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
		$page = 'home-aso';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/aso/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
			'title' => 'Informações das banco',
		];
		//dd($data);
		//$crudModel->where('f_id', $id)->first();
		return view('frentesObras/frenteRh/layout/pages/aso/' . $page, $data);
	}

	public function getTodasFuncoes() 
	{
        $this->cargo_model = new CargofuncoesModel();
        $getData = array(
            'id_c' => $this->request->getVar('id_cargo_aso'),
        );
        $data = $this->cargo_model->getCargosFuncoesAso($getData);
        echo json_encode($data);
    }
	
	public function getRiscosCargos()
	{
		$this->model_exames_riscos = new ConsultasGeralModel();
        $postData = array(
            'id_risc' => $this->request->getVar('id_cargo_risco'),
        );
        $data = $this->model_exames_riscos->getRiscosFuncaoCargo($postData);
        echo json_encode($data);
	}

	public function listTiposExamesJaConfigurados(int $id)
	{
		
		$page = 'home-aso';
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/aso/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$model = new ExamesModel();
		$model_tipo = new ExamesContratuaisModel();
		$model_tipos_usados = new ConsultasGeralModel();
		$cargo_model = new CargosModel();
		//dd(count($model_tipo));
		$data = [
			'title' => 'Riscos e Exames (função)',
			'list_dd' => $model->where('ex_fk_funcao', $id)->findAll(),
			'list_tipos' => $model_tipo->findAll(),
			'list_tipos_usados' => $model_tipos_usados->getExamesRiscos($id),
			'list_cargo' => $cargo_model->getCargos($id),
		];
		return view('frentesObras/frenteRh/layout/pages/aso/' . $page, $data);
	}

	public function pageConfiguraRascosExames($page = 'config_riscos_exames_aso')
	{
		
		if (!is_file(APPPATH . '/Views/frentesObras/frenteRh/layout/pages/aso/includes/' . $page . '.php')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}

		$data = [
			'title' => 'Riscos e Exames (função)',
		];
		return view('frentesObras/frenteRh/layout/pages/aso/includes/' . $page, $data);
	}

	public function selecionaExames()
	{
		$model = new ExamesModel();
		$id = $this->request->getVar('id_exames');
		$user_data = $model->where('ex_fk_funcao', $id)->findAll();
		echo json_encode($user_data);
	}

	public function selecionaCargo()
	{
		$model = new CargosModel();
		$user_data = $model->findAll();
		echo json_encode($user_data);
	}

	public function listExamesJoin(int $id)
	{
		$model = new ExamescargosModel();
		$user_data = $model->getCargosFuncoes($id);
		echo json_encode($user_data);
	}

	public function getDadosExamesCargos(int $id)
	{
		if($id)
        {
            $model = new ExamescargosModel();
            $user_data = $model->where('ef_id', $id)->first();
            echo json_encode($user_data);
        }
	}

	/**lista todos os cargos */
	public function getListModalCargos() 
	{
        $this->modal = new CargosModel();
        $data = $this->modal->findAll();
        echo json_encode($data);
    }
	/**lista todas as funções */

	public function getListModalCargosFuncoes() 
	{
		$this->modal = new CargofuncoesModel();
        $data = $this->modal->findAll();
        echo json_encode($data);
    }

	public function getListModalExames() 
	{
		$this->modal = new ExamesModel();
        $data = $this->modal->findAll();
        echo json_encode($data);
    }

	public function alteraExameConfAso()
	{
		if ($this->request->getMethod() === 'post') {
			$select_modal_cargoaso_cf_error = '';
			$select_modal_cargoa_funcoes_so_cf_error = '';
			$select_modal_exames_cf_error = '';
			$ef_dias_1_error = '';
			$ef_dias_2_error = '';

			$error = 'no';
			$success = 'no';
			$message = '';

			$error = $this->validate([
				'select_modal_cargoaso_cf' => ['label' => 'cargo', 'rules' => 'required'],
				'select_modal_cargoa_funcoes_so_cf' => ['label' => 'função', 'rules' => 'required'],
				'select_modal_exames_cf' => ['label' => 'exames', 'rules' => 'required'],
				'ef_dias_1' => ['label' => '1º P/D', 'rules' => 'required|integer'],
				'ef_dias_2' => ['label' => '1º P/D', 'rules' => 'required|integer'],
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('select_modal_cargoaso_cf')) {
					$select_modal_cargoaso_cf_error = $validation->getError('select_modal_cargoaso_cf');
				}

				if ($validation->getError('select_modal_cargoa_funcoes_so_cf')) {
					$select_modal_cargoa_funcoes_so_cf_error = $validation->getError('select_modal_cargoa_funcoes_so_cf');
				}

				if ($validation->getError('select_modal_exames_cf')) {
					$select_modal_exames_cf_error = $validation->getError('select_modal_exames_cf');
				}

				if ($validation->getError('ef_dias_1')) {
					$ef_dias_1_error = $validation->getError('ef_dias_1');
				}

				if ($validation->getError('ef_dias_2')) {
					$ef_dias_2_error = $validation->getError('ef_dias_2');
				}
			} else {
				$success = 'yes';
				$model = new ExamescargosModel();

				$model->save([
					'ef_id'					=>	$this->request->getVar('hidden_id_altera_exame_aso_up'),
					'ef_fk_funcao'			=>	$this->request->getVar('select_modal_cargoaso_cf'),
					'ef_fk_cargos_funcoes'	=>	$this->request->getVar('select_modal_cargoa_funcoes_so_cf'),
					'ef_ek_exame'			=>	$this->request->getVar('select_modal_exames_cf'),
					'ef_tipos_ad'			=>	$this->request->getVar('checked1'),
					'ef_tipos_d'			=>	$this->request->getVar('checked2'),
					'ef_tipos_p'			=>	$this->request->getVar('checked3'),
					'ef_tipos_m'			=>	$this->request->getVar('checked4'),
					'ef_tipos_r'			=>	$this->request->getVar('checked5'),
					'ef_tipos_is'			=>	$this->request->getVar('checked6'),
					'ef_dias_1'				=>	$this->request->getVar('ef_dias_1'),
					'ef_dias_2'				=>	$this->request->getVar('ef_dias_2'),
				]);

				$message = '<div class="alert alert-success">Cadastro alterado com sucesso!</div>';
			}

			$output = array(
				'select_modal_cargoaso_cf_error'			=>	$select_modal_cargoaso_cf_error,
				'select_modal_cargoa_funcoes_so_cf_error'	=>	$select_modal_cargoa_funcoes_so_cf_error,
				'select_modal_exames_cf_error'				=>	$select_modal_exames_cf_error,
				'ef_dias_1_error'							=>	$ef_dias_1_error,
				'ef_dias_2_error'							=>	$ef_dias_2_error,

				'error'			=>	$error,
				'success'		=>	$success,
				'message'		=>	$message
			);

			echo json_encode($output);
		}
	}

	public function deleteExameConfAso()
	{
		if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $crudModel = new ExamescargosModel();
            $crudModel->where('ef_id', $id)->delete($id);
            echo 'Processo realizado com sucesso!';
        }
	}
}
