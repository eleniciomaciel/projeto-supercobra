<?php

namespace App\Controllers\Rh\Documentos;

use App\Controllers\BaseController;
use App\Models\FuncionarioModel;
use App\Models\DocfuncionarioModel;
use App\Models\Estados\EstadosModel;
use App\Models\HistoricocnhModel;
use monken\TablesIgniter;


class DocumentosController extends BaseController
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
		$page = 'documentos-funcionario';
		$model = new FuncionarioModel();
		if ( ! is_file(APPPATH.'Views/frentesObras/frenteRh/layout/pages/documentos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
		$data = [
					'title' => 'Historico documentais',
					'fun_dd' => $model->find($id),
				]; // Capitalize the first letter
	
		echo view('frentesObras/frenteRh/layout/pages/documentos/'.$page, $data);
	}

	/**salva arquivo do usuário */
	public function uploadDocumentoColaborador(int $id)
	{
         
        $model = new DocfuncionarioModel();
    
		$validateImage = $this->validate([
            'profileImage' => [
                "rules" => "uploaded[profileImage]|max_size[profileImage,10240]|is_image[profileImage]|mime_in[profileImage,image/jpg,image/jpeg,image/gif,image/png,image/pdf]",
				"label" => "Profile Image",
            ],
        ]);
    
        $response = [
            'success' => false,
            'data' => '',
            'msg' => "Não foi possível carregar a imagem"
        ];

        if ($validateImage) {
            $imageFile = $this->request->getFile('profileImage');
            $imageFile->move(WRITEPATH . 'uploads');

            $data = [
				'doc_fk_funcioanrio' 	=> $id,
				'doc_fk_obra' 	        =>  $this->request->getVar("col_dod_obra"),
				'doc_fk_frente' 	    => $this->request->getVar("col_dod_frente"),
				'doc_descricao' 		=> $this->request->getVar("desc_doc"),
				'doc_arquivo' 			=> $imageFile->getClientName(),
			];

			 $save = $model->save($data);

            $response = [
                'success' => true,
                'data' => $save,
                'msg' => "Imagem carregada com sucesso"
            ];
        }

        return $this->response->setJSON($response);
	}

    /**lista documentos */
    public function listaDocUser(int $id)
    {
        $model = new DocfuncionarioModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($model->noticeTable($id))
				   ->setDefaultOrder("doc_id", "DESC")
				   ->setSearch(["doc_descricao",])
				   ->setOrder(["doc_id", "doc_descricao",])
				   ->setOutput(["created_at", "doc_descricao", $model->button()]);
		return $data_table->getDatatable();
    }

    /**download do arquivo */
    public function download(string $arquivo)
    {
        $caminho = WRITEPATH . 'uploads/';//equal writable/uploads/$arquivo
         return $this->response->download($caminho.$arquivo, null);
    }

    /**deleta arquivo fake */
    public function deleteDocUser()
    {
        if($this->request->getVar('id'))
        {
            $id = $this->request->getVar('id');
            $model = new DocfuncionarioModel();
            $model->where('doc_id', $id)->delete($id);
            echo 'Documento deletado com sucesso!';
        }
    }

    /** ========================================== habilitação ============================== */
    public function habilitacao(int $id)
    {
        $page = 'documentos-habilitacao';
		$model = new FuncionarioModel();
        $estado = new EstadosModel();
        $list_doc_habil = new HistoricocnhModel();
		if ( ! is_file(APPPATH.'Views/frentesObras/frenteRh/layout/pages/documentos/'.$page.'.php'))
		{
			throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
		}
        
		$data = [
					'title'     => 'Dados da habilitação',
					'fun_dd'    => $model->find($id),
                    'estados'   => $estado->getEstados(),
				]; 
        
		echo view('frentesObras/frenteRh/layout/pages/documentos/'.$page, $data);
    }

    public function atualizaCnh(int $id)
    {

        $model = new FuncionarioModel();

        if ($this->request->getMethod() === 'post' && $this->validate([

            'cnh_numero' => ['label' => 'nº da cnh', 'rules' => 'required|integer|min_length[1]|max_length[30]'],
            'cnh_categoria' => ['label' => 'categoria da cnh', 'rules' => 'required'],
            'cnh_emissor' => ['label' => 'emissor da cnh', 'rules' => 'required'],
            'cnh_uf' => ['label' => 'uf da cnh', 'rules' => 'required'],
            'cnh_data_emissao' => ['label' => 'data de emissão da cnh', 'rules' => 'required|valid_date'],
            'cnh_data_vencimento' => ['label' => 'data de vencimento da cnh', 'rules' => 'required|valid_date'],
            'cnh_data_primeira' => ['label' => 'data da primeira cnh', 'rules' => 'required|valid_date'],

        ])) {
            $model->save([
                'f_id'                  => $id,
                'f_cnh_numero'          => $this->request->getPost('cnh_numero'),
                'f_cnh_categoria'       => $this->request->getPost('cnh_categoria'),
                'f_cnh_emissor'         => $this->request->getPost('cnh_emissor'),
                'f_cnh_uf'              => $this->request->getPost('cnh_uf'),
                'f_cnh_data_emissao'    => $this->request->getPost('cnh_data_emissao'),
                'f_cnh_data_vencimento' => $this->request->getPost('cnh_data_vencimento'),
                'f_cnh_data_primeira'   => $this->request->getPost('cnh_data_primeira'),
            ]);

            session()->setFlashdata('message_dados_user_cnh', 'Dados cadastrado com sucesso!');
            session()->setFlashdata('alert-class', 'alert-success');
            return redirect()->to('/Rh/Documentos/DocumentosController/habilitacao/'.$id);
        } else {
            return redirect()->back()->withInput(['validation' => $this->validator, ]);
        }
    }

    public function inseri_nova_cnh(int $id)
    {
        // Validation
        $input = $this->validate([
            'file_doc_cnh' => 'uploaded[file_doc_cnh]|max_size[file_doc_cnh,10240]|ext_in[file_doc_cnh,jpg,jpeg,docx,pdf],'
        ]);

        if (!$input) { // Not valid
            $data['validation'] = $this->validator;
            $page = 'documentos-habilitacao';
            $model = new FuncionarioModel();
            $estado = new EstadosModel();
            $data = [
                        'title' => 'Dados da habilitação',
                        'fun_dd' => $model->find($id),
                        'estados' => $estado->getEstados()
                    ]; 
        
            return view('frentesObras/frenteRh/layout/pages/documentos/'.$page, $data);
        } else { // Valid

            if ($file = $this->request->getFile('file_doc_cnh')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $model_file = new HistoricocnhModel();
                    $name = $file->getName();
                    $ext = $file->getClientExtension();

                    $newName = $file->getRandomName();

                    $file->move(WRITEPATH . 'uploads/file_cnh', $newName);

                    $model_file->save([
                        'fk_usuario_cnh' =>  $this->request->getPost('id_user_cnh'),
                        'file_cnh'  => $newName,
                    ]);
                    session()->setFlashdata('message_file', 'Arquivo enviado com sucesso!');
                    session()->setFlashdata('alert-class', 'alert-success');
                    session()->setFlashdata('extension', $ext);
                } else {
                    // Set Session
                    session()->setFlashdata('message_file', 'Falha ao subir arquivo.');
                    session()->setFlashdata('alert-class', 'alert-danger');
                }
            }
        }
        return redirect()->to('/Rh/Documentos/DocumentosController/habilitacao/'.$id);
    }

    /**lista documentos cnh */
    public function listCNH($id)
    {
        $model = new HistoricocnhModel();
		$data_table = new TablesIgniter();
        
		$data_table->setTable($model->noticeTable($id))
				   ->setDefaultOrder("id", "DESC")
				   ->setSearch(["created_at", "fk_usuario_cnh"])
				   ->setOrder(["id", "created_at", "fk_usuario_cnh"])
				   ->setOutput(["created_at", "file_cnh", $model->button()]);
		return $data_table->getDatatable();
    }

    /**download cnh */
    /**download do arquivo */
    public function baixarDadosCNH(string $arquivo)
    {
        $caminho = WRITEPATH . 'uploads/file_cnh/';//equal writable/uploads/$arquivo
         return $this->response->download($caminho.$arquivo, null);
    }

    public function deleteOneCnh()
    {
        if($this->request->getVar('id_del_cnh'))
        {
            $id = $this->request->getVar('id_del_cnh');
            $model = new HistoricocnhModel();
            $model->where('id', $id)->delete($id);
            echo 'Arquivo deletado com sucesso!';
        }
    }
}
