<?php
namespace App\Controllers\Rh;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use monken\TablesIgniter;

class DepartamentosController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }
	
	public function index()
	{
		$departamento = new DepartamentosModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($departamento->noticeTable())
			->setDefaultOrder("id", "DESC")
			->setSearch(["dep_name", "dep_description"])
			->setOrder(["id", "dep_name", "dep_description"])
			->setOutput(["created_at", "dep_name", "dep_description", $departamento->button()]);
		return $data_table->getDatatable();
	}
}
