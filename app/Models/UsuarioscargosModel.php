<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioscargosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'usuarioscargos';
	protected $primaryKey           = 'uc_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['uc_fk_id_rh_que_cadastratou','uc_fk_id_funcionario','uc_fk_id_cargo','uc_fk_id_departamento','uc_fk_id_atividade','uc_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('usuarioscargos');
		$builder->select('*');
		$builder->join('funcionarios', 'funcionarios.f_id = usuarioscargos.uc_fk_id_funcionario');
		$builder->join('cargofuncoes', 'cargofuncoes.id = usuarioscargos.uc_fk_id_cargo');
		$builder->join('departamentos', 'departamentos.id = usuarioscargos.uc_fk_id_departamento');
		$builder->join('atividades', 'atividades.id = usuarioscargos.uc_fk_id_atividade');
		return $builder;

		// $builder = $this->db->table('usuarioscargos');
		// $builder = $this->join('funcionarios', 'funcionarios.f_id = usuarioscargos.uc_fk_id_funcionario');
		// return $builder;
	}

	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group">
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Opções
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="#"><i class="fa fa-eye"></i>&nbsp;Visualizar</a>
					<a class="dropdown-item" href="#"><i class="fas fa-user-edit"></i>&nbsp;Alterar</a>
					<a class="dropdown-item" href="#"><i class="fas fa-search-plus"></i>&nbsp;Consultar</a>
				<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#"><i class="fas fa-power-off"></i>&nbsp;Desativar</a>
				</div>
			</div>
				';
		};

		return $action_button;
	}
}
