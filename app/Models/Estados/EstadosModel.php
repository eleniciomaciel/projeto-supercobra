<?php

namespace App\Models\Estados;

use CodeIgniter\Model;

class EstadosModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'estados';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [];


	public function getEstados($slug = false)
	{
		if ($slug === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->where(['id' => $slug])
			->first();
	}
}
