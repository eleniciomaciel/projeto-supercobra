<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamesContratuaisModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'examescontratuais';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['fk_user_ect','ect_nome','ect_description','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	
	public function noticeTable()
	{
		$builder = $this->db->table('examescontratuais');
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="verExameContratua btn btn-info" data-id="'.$row['id'].'"><i class="fas fa-eye"></i></button>
				<button type="button" class="deleteExameContratua btn btn-danger" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></button>
			</div>
				';
		};

		return $action_button;
	}
}
