<?php

namespace App\Models;

use CodeIgniter\Model;

class CargofuncoesModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cargofuncoes';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['cf_fk_funcao','cf_nome_cargo_funcao','cf_description_cargo_funcao','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function noticeTable()
	{
		$builder = $this->db->table('cargofuncoes');
		$builder->select('*');
		$builder->join('cargos', 'cargos.id_cargo = cargofuncoes.cf_fk_funcao');
		return $builder;
	}
	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm">
				<a href="#" class="visualizarCargosAjax btn btn-info" data-id="'.$row['id'].'">
					<i class="fas fa-eye"></i>
				</a>

				<a href="#" class="deleteCargosAjax btn btn-danger" data-id="'.$row['id'].'">
					<i class="fas fa-trash"></i>
				</a>
			</div>
				';
		};
		return $action_button;
	}
}
