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
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getCargos($id = false)
	{
		if ($id === false)
		{
			return $this->findAll();
		}
	
		return $this->asArray()
					->where(['id_cargo' => $id])
					->first();
	}
}
