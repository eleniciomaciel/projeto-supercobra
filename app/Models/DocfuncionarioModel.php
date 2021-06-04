<?php

namespace App\Models;

use CodeIgniter\Model;

class DocfuncionarioModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'documentos_colaborador';
	protected $primaryKey           = 'doc_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['doc_fk_funcioanrio','doc_fk_obra','doc_fk_frente','doc_descricao','doc_arquivo'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable($id)
	{
		$builder = $this->db->table('documentos_colaborador');
		$builder->where('doc_fk_funcioanrio', $id);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<a href="/Rh/Documentos/DocumentosController/download/'.esc($row['doc_arquivo']).'" target="_blank" class="btn btn-primary" title="Baixar arquivo">
					<i class="fas fa-cloud-download-alt"></i>
				</a>

				<button type="button" class="del_doc btn btn-danger" title="Deletar arquivo" data-id="'.$row['doc_id'].'">
					<i class="fas fa-trash"></i>
				</button>
			</div>
				';
		};

		return $action_button;
	}
}
