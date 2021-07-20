<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanHomologacaoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kanban_homologacao';
	protected $primaryKey           = 'hml_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['hml_fk_usuario','hml_fk_projeto','hml_fk_backlog','hml_nome_backlog','hml_ativ_descricao','hml_status','data_migracao_do_backlog','hml_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
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

	/**deleta a fase do backlog */
	public function deleteFaseTofazendo($id)
	{
		$builder = $this->db->table('kanban_tofazendo');
		$builder->where('to_faz_fk_backlog', $id);
		return $builder->delete();
	}
}
