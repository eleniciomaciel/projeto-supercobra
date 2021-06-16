<?php

namespace App\Controllers\Rh\Aso;

use App\Controllers\BaseController;

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
}
