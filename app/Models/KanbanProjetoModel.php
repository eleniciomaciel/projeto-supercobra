<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanProjetoModel extends Model
{
	protected $table                = 'kanban_projeto';
	protected $primaryKey           = 'kbp_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['kbp_fk_usuario','kbp_nome_projeto','kbp_data_inicial','kbp_data_final','kbp_status','kbp_detalhes_projeto'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getProject($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->where(['kbp_id' => $id])
			->first();
	}
}
