<?php

namespace App\Controllers\Rh;

use App\Controllers\BaseController;

class RhController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "RH") {
            echo view('/');
            exit;
        }
    }
	public function index($page = 'home-rh')
	{
		if ( ! is_file(APPPATH.'/Views/frentesObras/frenteRh/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
	
		$data['title'] = ucfirst($page); // Capitalize the first letter
		echo view('frentesObras/frenteRh/'.$page, $data);
	}
}
