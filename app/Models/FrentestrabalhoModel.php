<?php

namespace App\Models;

use CodeIgniter\Model;

class FrentestrabalhoModel extends Model
{
	protected $table                = 'frentestrabalho';
	protected $primaryKey           = 'id_ftbr';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nome_ftbr','description_ftbr'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('frentestrabalho');

		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="showFrenterab btn btn-info" data-id="'.$row['id_ftbr'].'"><i class="fas fa-eye"></i></button>
				<button type="button" class="deleteFrenterab btn btn-danger" data-id="'.$row['id_ftbr'].'"><i class="fas fa-trash"></i></button>
			</div>
				';
		};

		return $action_button;
	}
}
