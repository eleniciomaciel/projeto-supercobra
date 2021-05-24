<?php

namespace App\Models;

use CodeIgniter\Model;

class CentocustoModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cento_custo';
	protected $primaryKey           = 'id_cc';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['numero_cc','descricao_cc','fk_obra_cc','status_cc','fk_departamento','created_at','updated_at','deleted_at','fk_frente_cc','fk_departamento','observacao_cc'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getCentocusto($id = false)
	{
		if ($id === false) {
			return $this->asArray()
			->join('obras', 'obras.id = cento_custo.fk_obra_cc')
			->findAll();
		}

		return $this->asArray()
			->join('obras', 'obras.id = cento_custo.fk_obra_cc')
			->where(['id_cc' => $id])
			->first();
	}

	public function getFrenteCC($id_frente)
	{
		return $this->asArray()
			->where(['fk_frente_cc' => $id_frente])
			->findAll();
	}

	public function noticeTable($frente)
	{
		$builder = $this->db->table('cento_custo');
		$builder->select('*');
		$builder->join('departamentos', 'departamentos.id = cento_custo.fk_departamento');
		$builder->where('fk_frente_cc', $frente);
		return $builder;
	}
	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm">
				<button type="button" class="visualizarRH_cc_admin_panel btn btn-info" data-id="'.$row['id_cc'].'" title="Visualizar Cento de Custo.">
					<i class="fas fa-eye"></i>
				</button>
				<a href="#" class="statusRH_cc btn btn-danger" data-id="'.$row['id_cc'].'" data-statu="'.$row['status_cc'].'" title="Desativar Cento de Custo.">
					<i class="fas fa-power-off"></i>
				</a>
			</div>
				';
		};
		return $action_button;
	}

	public function status()
	{
		$action_status = function($row){
			return $row['status_cc'] == 'active' ? '<span class="badge bg-success">Ativo</span>':'<span class="badge bg-danger">Inativo</span>';
		};
		return $action_status;
	}
}
