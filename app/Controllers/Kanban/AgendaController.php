<?php

namespace App\Controllers\Kanban;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;

class AgendaController extends BaseController
{
	public function __construct()
    {
        if (session()->get('role') != "KANBAN") {
            echo 'Accesso negado!';
            exit;
        }
    }

	public function index($page = 'agenda_trabalho')
	{
		if ( ! is_file(APPPATH.'/Views/kanban/pages/agenda/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$id_c = session()->get('id');
		$model_user = new ConsultasGeralModel();

		$data=['title' => $model_user->listaDadosUsuario($id_c)]; // Capitalize the first letter
	
		return view('kanban/pages/agenda/'.$page, $data);
	}
}
