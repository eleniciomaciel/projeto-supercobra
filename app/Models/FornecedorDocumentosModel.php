<?php

namespace App\Models;

use CodeIgniter\Model;

class FornecedorDocumentosModel extends Model
{
	protected $table                = 'fornecedor_documentos';
	protected $primaryKey           = 'fd_id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = true;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'fk_id_fornecedor',
		'fk_id_operador',
		'fd_descricao',
		'fd_documento',
	];

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	
}
