<?php

namespace App\Models;

use CodeIgniter\Model;

class QualidadeDocumentosModel extends Model
{
	protected $table                = 'qualidadedocumentos';
	protected $primaryKey           = 'qld_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['qld_fk_categoria','qld_fk_usuario','qld_contratacao','qld_periodicamente','qld_versao','qld_description','qld_justifica'];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	public function getDocumentos($id = false)
	{
		if ($id === false) {
			$builder = $this->table('qualidadedocumentos');
			$builder->select('*');
			$builder->join('qualidadecategorias', 'qualidadecategorias.ql_id = qualidadedocumentos.qld_fk_categoria');
			return $builder->get()->getResultArray();
		}

		return $this->asArray()
			->where(['qld_id' => $id])
			->first();
	}
}
