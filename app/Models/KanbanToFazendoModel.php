<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanToFazendoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kanban_tofazendo';
	protected $primaryKey           = 'to_faz_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['to_faz_fk_usuario', 'to_faz_fk_projeto', 'to_faz_fk_backlog', 'to_faz_nome_backlog', 'ativ_descricao', 'to_faz_status', 'data_migracao_do_backlog'];

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

	public function getToFazendo($id = false)
	{
		return $this->asArray()
			->where(['to_faz_id' => $id])
			->first();
	}

	public function getAtividadesToFazendo($id)
	{
		return $this->asArray()
			->where(['to_faz_fk_projeto' => $id])
			->findAll();
	}

	public function getBackLogToFazendo($id)
	{
		$builder = $this->db->table('kanban_tofazendo');
		$builder->select('*');
		 $builder->groupBy("to_faz_nome_backlog");
		$builder->where('to_faz_fk_projeto', $id);
		$query =  $builder->get();
		return $query->getResultArray();
	}

	public function listaTarefastoFazendo($id)
	{
		$builder = $this->db->table('kanban_tofazendo');
		$builder->select('*');
		$builder->where('to_faz_fk_backlog', $id);
		$query =  $builder->get();
		return $query->getResultArray();
	}
}
