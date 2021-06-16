<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoMaoDeObraModel extends Model
{
	protected $table                = 'tipomaodeobras';
	protected $primaryKey           = 'id_tmo';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nome_tmo','description_tmo'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('tipomaodeobras');

		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="viewMaoObra btn btn-info" data-id="'.$row['id_tmo'].'"><i class="fas fa-eye"></i></button>
				<button type="button" class="deleteMaoObra btn btn-danger" data-id="'.$row['id_tmo'].'"><i class="fas fa-trash"></i></button>
			</div>
				';
		};

		return $action_button;
	}
}
