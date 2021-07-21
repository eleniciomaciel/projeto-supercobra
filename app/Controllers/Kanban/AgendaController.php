<?php

namespace App\Controllers\Kanban;

use App\Controllers\BaseController;
use App\Models\ConsultasGeralModel;
use App\Models\KanbanagendaModel;

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

	public function lerDadosDaAgenda()
	{
		$agenda = new KanbanagendaModel();
		// on page load this ajax code block will be run
		$data = $agenda->where([
			'start >=' => $this->request->getVar('start'),
			'end <='=> $this->request->getVar('end')
		])->findAll();

		return json_encode($data);
	}

	public function ajax()
    {
        $event = new KanbanagendaModel();
        switch ($this->request->getVar('type')) {
                // For add EventModel
            case 'add':
                $data = [
                    'title' => $this->request->getVar('title'),
                    'start' => $this->request->getVar('start'),
                    'end' => $this->request->getVar('end'),
                ];
                $event->insert($data);
                return json_encode($event);
                break;
                // For update EventModel        
            case 'update':
                $data = [
                    'title' => $this->request->getVar('title'),
                    'start' => $this->request->getVar('start'),
                    'end' => $this->request->getVar('end'),
                ];
                $event_id = $this->request->getVar('id');
                
                $event->update($event_id, $data);
                return json_encode($event);
                break;
                // For delete EventModel    
            case 'delete':
                $event_id = $this->request->getVar('id');
                $event->delete($event_id);
                return json_encode($event);
                break;
            default:
                break;
        }
    }

	public function novaAgenda()
	{
		if($this->request->getMethod() === 'post')
		{
			$title_error = '';
            $start_error = '';
            $end_error = '';
            $error = 'no';
            $success = 'no';
            $message = '';

            $error = $this->validate([
				'title' => ['label' => 'Descrição', 'rules' => 'required|max_length[50]'],
				'start' => ['label' => 'Data inicial', 'rules' => 'required|valid_date'],
				'end' => ['label' => 'Data final', 'rules' => 'required|valid_date'],
            ]);

            if(!$error)
            {
            	$error = 'yes';
            	$validation = \Config\Services::validation();
            	if($validation->getError('title'))
            	{
            		$title_error = $validation->getError('title');
            	}

            	if($validation->getError('start'))
            	{
            		$start_error = $validation->getError('start');
            	}

            	if($validation->getError('end'))
            	{
            		$end_error = $validation->getError('end');
            	}
            }
            else
            {
            	$success = 'yes';
				$crudModel = new KanbanagendaModel();
            		$crudModel->save([
            			'title'		=>	$this->request->getVar('title'),
            			'start'		=>	$this->request->getVar('start'),
            			'end'		=>	$this->request->getVar('end')
            		]);

            		$message = '<div class="alert alert-success">Agenda criada com sucesso!</div>';
            }

            $output = array(
            	'title_error'	=>	$title_error,
            	'start_error'	=>	$start_error,
            	'end_error'		=>	$end_error,
            	'error'			=>	$error,
            	'success'		=>	$success,
            	'message'		=>	$message
            );

            echo json_encode($output);
		}
	}
}
