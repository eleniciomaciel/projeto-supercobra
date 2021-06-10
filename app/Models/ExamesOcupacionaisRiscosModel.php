<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamesOcupacionaisRiscosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'examesocupacionaisriscos';
	protected $primaryKey           = 'id_r';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['fk_user_eor','fk_funcao_eor', 'eor_nome', 'eor_grau_risco', 'eor_combo_risco', 'eor_description_risco'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('examesocupacionaisriscos');
		$builder->join('cargofuncoes', 'cargofuncoes.id = examesocupacionaisriscos.fk_funcao_eor');
		return $builder;
	}

	public function examesAtividadesRiscos() {
		$sql = 'SELECT * FROM examesocupacionaisriscos AS t1 INNER JOIN cargofuncoes t2 ON t1.fk_funcao_eor = t2.id';
		$query =  $this->db->query($sql);
		return $query->getResult();
	  }

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
				<button type="button" class="ViewTisco btn btn-info" data-id="'.$row['id_r'].'"><i class="fas fa-eye"></i></button>
				<button type="button" class="deleteRisco btn btn-danger" data-id="'.$row['id_r'].'"><i class="fas fa-trash"></i></button>
			</div>
				';
		};

		return $action_button;
	}

}
