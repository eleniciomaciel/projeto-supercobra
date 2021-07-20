<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanAtividadesBacklog extends Model
{
	protected $table                = 'kanban_atividade_backlog';
	protected $primaryKey           = 'ativ_bl_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['ativ_bl_fk_usuario','ativ_bl_fk_projeto','ativ_bl_fk_backlog','ativ_descricao','ativ_bl_status'];

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

	public function getAtividadesBackLog($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->join('kanban_backlog', 'kanban_backlog.bl_id = kanban_atividade_backlog.ativ_bl_fk_backlog')
			->where(['ativ_bl_fk_backlog' => $id])
			->first();
	}

	/**deleta a fase do backlog */
	public function deleteFaseBacklog($id)
	{
		$builder=$this->db->table('kanban_atividade_backlog');
		$builder->where('ativ_bl_fk_backlog', $id);
		return $builder->delete();

	}

	public function deleteBacklog($id)
	{
		$builder=$this->db->table('kanban_backlog');
		$builder->where('bl_id', $id);
		return $builder->delete();

	}
}
