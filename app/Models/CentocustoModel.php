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
	protected $allowedFields        = ['numero_cc','descricao_cc','fk_obra_cc','status_cc','created_at','updated_at','deleted_at'];

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
}
