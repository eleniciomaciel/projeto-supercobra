<?php

namespace App\Models\Departamento;

use CodeIgniter\Model;

class DepartamentosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'departamentos';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes 		= true;
	protected $protectFields        = true;
	protected $allowedFields        = ['dep_name','dep_description'];

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

	public function noticeTable()
	{
		$builder = $this->db->table('departamentos');
		return $builder;
	}
	public function button()
	{
		$action_button = function($row){
			return '
			<div class="btn-group btn-group-sm">
				<a href="#" class="visualizarDepartamento btn btn-info" data-id="'.$row['id'].'">
					<i class="fas fa-eye"></i>
				</a>
				<a href="#" class="deleteDepartamento btn btn-danger" data-id="'.$row['id'].'">
					<i class="fas fa-trash"></i>
				</a>
			</div>
				';
		};
		return $action_button;
	}
}
