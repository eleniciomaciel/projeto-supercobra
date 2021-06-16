<?php

namespace App\Models;

use CodeIgniter\Model;

class CargosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'cargos';
	protected $primaryKey           = 'id_cargo';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['cargo_nome','cargo_description','cargo_numero','datetime','created_at','updated_at','deleted_at'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getCargos($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->where(['id_cargo' => $id])
			->first();
	}

	public function noticeTable()
	{
		$builder = $this->db->table('cargos');
		return $builder;
	}
	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm">
				<a href="#" class="visualizarFuncao btn btn-info" data-id="'.$row['id_cargo'].'">
					<i class="fas fa-eye"></i>
				</a>
				<a href="#" class="deleteFuncao btn btn-danger" data-id="'.$row['id_cargo'].'">
					<i class="fas fa-trash"></i>
				</a>
			</div>
				';
		};
		return $action_button;
	}
}
