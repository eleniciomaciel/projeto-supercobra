<?php

namespace App\Models;

use CodeIgniter\Model;

class QualidadeCategoriaModel extends Model
{
	protected $table                = 'qualidadecategorias';
	protected $primaryKey           = 'ql_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['ql_user_fk','ql_description'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	public function getCategoria($id = false)
	{
		if ($id === false) {
			return $this->findAll();
		}

		return $this->asArray()
			->where(['ql_id' => $id])
			->first();
	}
}
