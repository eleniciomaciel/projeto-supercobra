<?php

namespace App\Models;

use CodeIgniter\Model;

class BacklogModel extends Model
{
	protected $table                = 'kanban_backlog';
	protected $primaryKey           = 'bl_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['bl_fk_usuario','bl_fk_projeto','bl_nome_backlog','bl_data_inicial','bl_data_final','bl_status','bl_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function getBackLog($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			//->join('kanban_atividade_backlog', 'kanban_atividade_backlog.ativ_bl_fk_backlog = kanban_backlog.bl_id')
			->where(['bl_fk_projeto' => $id])
			->findAll();
	}
}
