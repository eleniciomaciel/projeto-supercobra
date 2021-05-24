<?php

namespace App\Models;

use CodeIgniter\Model;

class AtividadesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'atividades';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['titulo_fk_author','titulo_nome','titulo_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = true;
	protected $cleanValidationRules = true;

	public function noticeTable()
	{
		$builder = $this->db->table('atividades');
		return $builder;
	}

	public function button()
	{
		$action_button = function ($row) {
			return '
			<div class="btn-group btn-group-sm">
				<button type="button" class="visualizarAtividade btn btn-info" data-id="'.$row['id'].'" title="Visualizar dados da Atividade">
					<i class="fas fa-eye"></i>
				</button>
				<button type="button" class="deleteAtividade btn btn-danger" data-id="'.$row['id'].'" title="Deletar Atividade">
					<i class="fas fa-trash"></i>
				</button>
			</div>
				';
		};

		return $action_button;
	}
}
