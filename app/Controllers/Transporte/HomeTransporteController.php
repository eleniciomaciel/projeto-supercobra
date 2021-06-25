<?php

namespace App\Controllers\Transporte;

use App\Controllers\BaseController;

class HomeTransporteController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "TRANSPORTE") {
            echo view('/');
            exit;
        }
    }

	public function index($page = 'home-transporte')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteTransportes/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
	
		echo view('frentesObras/frenteTransportes/'.$page, $data);
	}
}
