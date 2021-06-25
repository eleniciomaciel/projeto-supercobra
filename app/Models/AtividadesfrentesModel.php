<?php

namespace App\Models;

use CodeIgniter\Model;

class AtividadesfrentesModel extends Model
{
	protected $table                = 'atividades_frentes';
	protected $primaryKey           = 'atv_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['atv_descricao'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('atividades_frentes');
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="view_active_f btn btn-success" data-id="'.$row['atv_id'].'" titile="Visualizar"><i class="fa fa-eye"></i></button>
				<button type="button" class="delete_active_f btn btn-danger" data-id="'.$row['atv_id'].'" titile="Deletar"><i class="fa fa-trash"></i></button>
			</div>
				';
		};
		return $action_button;
	}
}
