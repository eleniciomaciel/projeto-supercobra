<?php

namespace App\Models;

use CodeIgniter\Model;

class KanbanHistoreProjetoModel extends Model
{
	protected $table                = 'kanbanhistoreprojetos';
	protected $primaryKey           = 'kb_histor_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['kb_histor_fk_usuario','kb_histor_fk_kanban','kb_histor_nome_projeto','kb_histor_data_inicial','kb_histor_data_final','kb_histor_status','kb_histor_detalhes_projeto','kb_histor_justificativa_mudanca'];

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
}
