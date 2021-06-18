<?php

namespace App\Controllers\Rh\Aso;

use App\Controllers\BaseController;
use App\Models\CargofuncoesModel;
use App\Models\ConsultasGeralModel;
use App\Models\ExamesModel;


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

	public function listTiposExamesJaConfigurados()
	{
		$output = '';
		$query = '';

		$model = new ExamesModel();

		if ($this->request->getVar('query')) {
			$query = $this->request->getVar('query');
		}
		
		$data = $model->where('id_b', $query)->first();

		$output .= '
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
				<tr>
					<th>Customer Name</th>
					<th>Address</th>
					<th>City</th>
					<th>Postal Code</th>
					<th>Country</th>
				</tr>';
		if ($data->num_rows() > 0) {
			foreach ($data->result() as $row) {
				$output .= '
				<tr>
					<td>' . $row->CustomerName . '</td>
					<td>' . $row->Address . '</td>
					<td>' . $row->City . '</td>
					<td>' . $row->PostalCode . '</td>
					<td>' . $row->Country . '</td>
				</tr>';
			}
		} else {
			$output .= '<tr>
							<td colspan="5">No Data Found</td>
						</tr>';
		}
		$output .= '</table>';
		echo $output;
	}
}
