<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'exames';
	protected $primaryKey           = 'id_ex';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['ex_fk_tipo_contato','ex_fk_funcao','ex_fk_risco','ex_tipo_exame','ex_validade_meses','ex_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('exames');
		$builder->select('*');
		$builder->join('examescontratuais', 'examescontratuais.id = exames.ex_fk_tipo_contato');
		$builder->join('cargofuncoes', 'cargofuncoes.id = exames.ex_fk_funcao');
		$builder->join('examesocupacionaisriscos', 'examesocupacionaisriscos.id_r = exames.ex_fk_risco');
		//$query = $builder;

		//$builder = $this->db->table('exames');
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
				<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
					<button type="button" class="ViewExamesCombo btn btn-info" data-id="'.$row['id_ex'].'"><i class="fas fa-eye"></i></button>
					<button type="button" class="deleteExamesCombo btn btn-danger" data-id="'.$row['id_ex'].'"><i class="fas fa-trash"></i></button>
				</div>
				';
		};

		return $action_button;
	}
}
