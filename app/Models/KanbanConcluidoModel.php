<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanConcluidoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kanban_concluido';
	protected $primaryKey           = 'cl_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['cl_fk_usuario','cl_fk_projeto','cl_nome_backlog','cl_ativ_descricao','cl_status','data_migracao_do_backlog','cl_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	/**deleta a fase do backlog */
	public function deleteFaseHomologacao($id)
	{
		$builder = $this->db->table('kanban_homologacao');
		$builder->where('hml_nome_backlog', $id);
		return $builder->delete();
	}
}
