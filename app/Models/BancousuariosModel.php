<?php

namespace App\Models;

use CodeIgniter\Model;

class BancousuariosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'bancousuarios';
	protected $primaryKey           = 'id_bu';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['fk_funcionario_bu','fk_banco_bu','fk_frente_bu','tipo_conta_bu','agencia_bu','digito_agencia_bu','numero_conta_bu','digito_conta_bu','status_conta_bu','titular_status_bu','data_vencimento_conta_bu','observacao_bu'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getBanco_frente($id_frente)
	{
		$data_hoje = date('Y-m-d');
		$sql = 'SELECT * FROM bancousuarios  INNER JOIN funcionarios ON bancousuarios.fk_funcionario_bu = funcionarios.f_id WHERE fk_frente_bu = "'.$id_frente.'" AND data_vencimento_conta_bu <= "'.$data_hoje.'";';
		$query =  $this->db->query($sql);
		return $query->getResult();
	}

	public function noticeTable($id)
	{
		$builder = $this->db->table('bancousuarios');
		$builder->select('*');
		$builder->join('bancos', 'bancos.id_b = bancousuarios.fk_banco_bu');
		$builder->where('fk_funcionario_bu', $id);
		return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			if ($row['status_conta_bu'] == 'Ativa') {
				return '
				<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
					<button type="button" class="clickBancoUser btn btn-success" data-id="'.$row['id_bu'].'" title="Vidualizar dados da conta"><i class="fa fa-eye"></i></button>
					<button type="button" class="clickBancoAtivaCOntaUser btn btn-warning" data-id="'.$row['id_bu'].'"><i class="fa fa-star" title="Status da conta"></i></button>
					<button type="button" class="deleteBancoUser btn btn-danger" data-id="'.$row['id_bu'].'" title="Deletar conta"><i class="fa fa-power-off"></i></button>
				</div>
				';
			}
			return '
				<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
					<button type="button" class="clickBancoUser btn btn-secondary " data-id="'.$row['id_bu'].'" title="Vidualizar dados da conta" disabled><i class="fa fa-eye"></i></button>
					<button type="button" class="clickBancoAtivaCOntaUser btn btn-warning" data-id="'.$row['id_bu'].'"><i class="fa fa-star" title="Status da conta"></i></button>
					<button type="button" class="deleteBancoUser btn btn-secondary " data-id="'.$row['id_bu'].'" title="Deletar conta" disabled><i class="fa fa-power-off"></i></button>
				</div>
				';
		};

		return $action_button;
	}
}
